<?php
/**
 * Created by PhpStorm.
 * User: Meluzin
 * Date: 03.12.2017
 * Time: 20:05
 */

namespace App\Presenters;

use App\Model\LekarnikManager;
use App\Model\PobockaManager;
use App\Model\ProdejManager;
use App\Model\RezervaceManager;
use Nette;
use Mesour\DataGrid\NetteDbDataSource,
    Mesour\DataGrid\Grid;
use Mesour\DataGrid\Components\Button;
use
    Mesour\DataGrid\Components\Link;
use Nette\Application\UI\Form;


class ProdejLekuPresenter extends DefaultLekarnaPresenter
{
    /** @var  GeneralManager */
    protected $modelManager;

    /** @var string sit z adresy */
    protected $site = 'SIT'; // 'lek'

    /** @var array Nadpisy u stranek */
    protected $nadpisy = array(
        "default"   => 'Prodej',
        "edit"      => 'Editace prodeje id: ', // + id editovaneho
        "add"       => 'Přidání prodeje:',
        "select"    => 'Vybrat prodej: ',
    );

    /** @var array Zpravy */
    protected $messages = array(
        "INSERT_OK" => "ProdejLeku byl přidán.",
        "INSERT_BAD" => "ProdejLeku se nepodařilo přidat",
        "UPDATE_OK" => "ProdejLeku byl upraven.",
        "UPDATE_BAD" => "ProdejLeku se nepodařilo upravit.",
    );

    /** @var string Sblona pro editovani */
    protected $templateForEdit;

    /** @var string Sblona pro pridani noveho */
    protected $templateForAdd;


    public $lekarnikManager;
    public $pobockaManager;
    public $rezervaceManager;
    public $prodejManager;

    public function __construct(ProdejManager $prodejManager, LekarnikManager $lekarnikManager, PobockaManager $pobockaManager, RezervaceManager $rezervaceManager)
    {
        $this->modelManager = $prodejManager;
        $this->lekarnikManager = $lekarnikManager;
        $this->pobockaManager = $pobockaManager;
        $this->rezervaceManager = $rezervaceManager;
        $this->prodejManager = $prodejManager;

        $this->templateForAdd = __DIR__.'/templates/ProdejLeku/add.latte';
        $this->templateForEdit = "".__DIR__."/templates/ProdejLeku/edit.latte";
    }


    /**
     * Renderovani defaultni stranky
     */
    public function renderDefault()
    {
        // add button
        $button = new Button();
        $button->setPresenter($this);
        $button->setPresenter($this)
            ->setType('btn-success')
            ->setIcon('glyphicon-plus')
            ->setTitle('Přidat')
            ->setAttribute('href', new Link('add'));

        $this->template->button = $button;


        $this->template->nadpis = $this->nadpisy['default'];
    }

    /**
     * Render editace
     *
     * @param $id id pro editaci
     */
    public function renderEdit($id) {

        /** @var Nette\Bridges\ApplicationLatte\Template $template */
        $template = $this->template;
        $template->setFile($this->templateForEdit);

        $item = $this->getModelManager()->getSpecific($id);
        if (!$item) {
            $this->error('Prvek nebyl nalezen.');
        }

        $this->template->nadpis = $this->nadpisy['edit'].$id;

        // add button
        $buttonBack = new Button();
        $buttonBack->setPresenter($this);
        $buttonBack->setPresenter($this)
            ->setType('btn-primary')
            ->setIcon('glyphicon-arrow-left')
            ->setTitle('Zpět')
            ->setAttribute('href', new Link('default'));

        $template->prodej = $item;
        $template->lekarnikJmeno = $this->lekarnikManager->getName($item->lekarnikID);
        $template->pobockaJmeno = $this->pobockaManager->getName($item->pobockaID);

        $this->template->buttonBack = $buttonBack;
    }

    /**
     * Render pro pridani leku
     */
    public function renderAdd() {

        /** @var Nette\Bridges\ApplicationLatte\Template $template */
        $template = $this->template;
        $template->setFile($this->templateForAdd);

        $this->template->nadpis = $this->nadpisy['add'];

        $buttonBack = new Button();
        $buttonBack->setPresenter($this);
        $buttonBack->setPresenter($this)
            ->setType('btn-primary')
            ->setIcon('glyphicon-arrow-left')
            ->setTitle('Zpět')
            ->setAttribute('href', new Link('default'));

        $this->template->buttonBack = $buttonBack;

        $lekarnik = $this->lekarnikManager->getSpecific($this->getUser()->identity->lekarnikID);
        if ($lekarnik) {
            $template->pobockaID = $lekarnik->pobockaID;
        }
        else {
            $this->flashMessage('Nebyl nalezen váš účet. Kontaktujte správce.');
            $this->redirect(200, 'default');
        }
    }


    /**
     * Zmena hodnot pred vypisem do editacniho formu
     *
     * @param $values polozky jako pole
     * @return upravene polozky
     */
    protected function changeValuesBeforeEdit($values) {

        $values['vybraneLekyIds'] = $this->prodejManager->getPolozky($values['prodejID']);

        return $values;
    }


    /**
     * Vlastni uprava polozek pro editaci
     * jeste pred editaci
     * @return pole s upravenyma polozkama
     */
    protected function beforeEditChangeValues($polozky){
        return $this->changeValuesBeforeEdit($polozky);
    }


    /**
     * Action handler pro editaci
     *
     * @param $id
     */
    public function actionEdit($id) {

        $item = $this->modelManager->getSpecific($id);
        if (!$item) {
            $this->error('Prvek nebyl nalezen.');
        }

        // Hidden pk
        $this['addForm']->addHidden($this->getModelManager()->getPkColumn());

        // Uzivatelska zmena polozek
        $upravenePolozky = $this->beforeEditChangeValues($item->toArray());

        $this['addForm']->setDefaults($upravenePolozky);
    }

    /**
     * Bylo kliknuto na delete v default
     *
     * @param $id id prvku
     */
    public function handleDelete($id)
    {
        // delete ok
        if ($this->modelManager->delete($id) == 1) {
            // ok
            $this->flashMessage('Položka s id:'.$id.' byla smazána.', 'success');
        }
        else {
            $this->flashMessage('Položku s id:'.$id.' se nepodařilo smazet.', 'warning');
        }
    }

    /**
     * Definovani sloupci pro datagrid
     *
     * @param $grid grid
     * @return mixed grid
     */
    protected function defineColumnsForDatagrid($grid) {


        $grid->addNumber('prodejID', 'Id');

        $grid->addDate('datum', 'Datum prodeje')
            ->setFormat('j.n.Y H:i:s');

        $grid->addNumber('pobockaID', 'Číslo pobočky');

        $grid->addTemplate('pobockaID', 'Pobočka')
            ->setCallbackArguments(array($this))
            ->setTemplate(__DIR__ . '/templates/Column/_itemName.latte') // or instanceof UI\ITemplate
            ->setCallback(function($data, Nette\Application\UI\ITemplate $template, $presenter) {
                $template->id = $data['pobockaID'];
                $template->nazev = $presenter->pobockaManager->getName($data['pobockaID']);
            });


        return $grid;
    }


    /**
     * Uzivatelsky definovane sloupce do datagridu
     *
     * @param $grid
     * @return mixed
     */
    protected function addColumnsToGrid($grid) {

        return $this->defineColumnsForDatagrid($grid);
    }


    /**
     * Inicializace gridu
     *
     * @param $name
     * @return Grid
     */
    protected function createDataGrid($name) {
        // Set source
        $source = new NetteDbDataSource($this->getModelManager()->getAllFromLekarnik($this->getUser()->identity->lekarnikID));
        $source->setPrimaryKey($this->getModelManager()->getPkColumn());


        // Create grid
        $grid = new Grid($this, $name);
        $grid->enablePager(10, 15, 3, 2);

        $grid->setLocale('cs');

        $grid->setEmptyText('Tabulka je prazdna'); // Kdyz nic
        $grid->setPrimaryKey($this->getModelManager()->getPkColumn());

        $grid->setDataSource($source);

        return $grid;
    }

    /**
     * Pridani tlacitek na editaci a smazani do gridu
     *
     * @param $grid
     * @return mixed
     */
    protected function addActionsToGrid($grid) {
        // Upravovaci tlacitka
        $actions = $grid->addActions('');

        $actions->addButton()
            ->setType('btn-primary')
            ->setIcon('glyphicon-pencil')
            ->setTitle('Edit')
            ->setAttribute('href', new Link('edit', array(
                'id' => '{' . $this->getModelManager()->getPkColumn() . '}'
            )));

        $actions->addButton()
            ->setType('btn-danger')
            ->setIcon('glyphicon-trash')
            ->setConfirm('Opravdu chcete smazat?')
            ->setTitle('Delete')
            ->setAttribute('href', new Link('delete!', array(
                'id' => '{' . $this->getModelManager()->getPkColumn() . '}'
            )));

        return $grid;
    }


    /**
     * Vytvoreni komponenty gridu
     *
     * @param $name
     * @return Grid|mixed
     */
    protected function createComponentDatagrid($name)
    {
        $grid = $this->createDataGrid($name); // vytvoreni

        $grid->enableFilter(); // Enagle filtrace

        $grid = $this->addActionsToGrid($grid); // pridani delete a update btn

        $grid = $this->addColumnsToGrid($grid); // pridani sloupecku

        return $grid;
    }

    /**
     * Definovani inputu pro formular
     *
     * @param $form
     */
    protected function defineInputsForForm(Form $form) {


        $form->addHidden('vybraneLekyIds')
            ->setRequired('Je potřeba vybrat nějaké léky.');

        $form->addHidden('vybraneRezervaceIds');


        return $form;
    }

    /**
     * Uzivatelske nastaveni inputu do formulare
     *
     */
    protected function addInputsToForm($form) {
        return $this->defineInputsForForm($form);
    }


    /**
     * Vytvoreni formulare
     *
     * @return Form
     */
    protected function createComponentAddForm()
    {
        $form = new Form;

        $form = $this->addInputsToForm($form);

        // Submit button
        $form->addSubmit('save', 'Uložit prodej')
            ->setValidationScope(true)
            ->getControlPrototype()
                ->setName('button')
                ->addAttributes(array(
                        'class' => 'btn btn-success',
                        'onclick' => "getPutValueInt('vybraneLekyIds', 'vybraneLekyIds');getPutValueInt('vybraneRezervaceIds', 'vybraneRezervaceIds');", /*  pridani presunuti aktualnich hodnot vybranych prvku  */
                    ))->setHtml('<span style="font-size:16px; margin-right: 15px;" class="pull-left hidden-xs showopacity glyphicon glyphicon-floppy-saved"></span> Uložit prodej');

        $form->onSuccess[] = array($this, 'postFormAddSucceeded');


        return $form;
    }


    /**
     * Editace dat pred poslanim do databaze
     *
     * @param $data
     * @return mixed
     */
    protected function changeValuesAfterEdit($data) {

        return $data;
    }





    /**
     * Zpracovani formulare po uspesnem odeslani
     *
     * @param $form
     * @param $values
     */
    public function postFormAddSucceeded($form, $values)
    {
        $values = $this->changeValuesAfterEdit($values);

        // ziskani informaci o Lekarniku
        $lekarnikID = $this->getUser()->identity->lekarnikID;
        $pobockaID = $this->lekarnikManager->getPobockaID($lekarnikID);
        if ( ! $pobockaID) {
            // todo error
            $this->flashMessage('Nejste na zadne pobocče. Kontaktujte správce.', 'warning');
            $this->redirect('default');
            return;
        }

        // EDITACE?
        if ($this->getParameter('id')) {
            if ( ! $this->prodejManager->update($this->getParameter('id'), $values['vybraneLekyIds'])) {
                $this->flashMessage('Nepovedl se editovat prodej.', 'warning');
                $this->redirect('default');
                return;
            }

            $this->flashMessage('Prodej byl upraven.', 'success');
        }

        // INSERT?
        else {

            // zalozit novy prodej
            if ( ! $this->prodejManager->addFromIds($values['vybraneLekyIds'], $pobockaID, $lekarnikID)) {

                $this->flashMessage('Nepovedl se založit nový prodej.', 'warning');
                $this->redirect('default');
                return;
            }

            // rezervace vyzvednuto nastavit na ano
            $rezervace = $values['vybraneRezervaceIds'];
            if (count($rezervace) > 0) {
                $rezervaceArr = explode(',', $rezervace);

                foreach ($rezervaceArr as $rez) {
                    $rez = explode(':', $rez);
                    $this->rezervaceManager->setVyzvednuto($rez[0]);
                }
            }

            $this->flashMessage('Nový prodej byl vytvořen.', 'success');
        }
        $this->redirect('default');
    }


    public function getModelManager() {
        return $this->modelManager;
    }

}

