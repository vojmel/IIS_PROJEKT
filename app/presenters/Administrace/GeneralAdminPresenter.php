<?php

namespace App\Presenters;

use App\Model\GeneralManager;
use App\Model\LekManager;
use Nette;
use Mesour\DataGrid\NetteDbDataSource,
    Mesour\DataGrid\Grid,
    Mesour\DataGrid\Components\Link;
use Mesour\DataGrid\Components\Button;
use Nette\Application\UI\Form;
use Tracy\Debugger;


class GeneralAdminPresenter extends DefaultAdminPresenter
{
    /** @var  GeneralManager */
    protected $modelManager;

    /** @var string sit z adresy */
    protected $site = 'SIT'; // 'lek'

    /** @var array Nadpisy u stranek */
    protected $nadpisy = array(
        "default"   => 'Léky',
        "edit"      => 'Editace léku: ', // + id editovaneho
        "add"       => 'Přidání léku:',
        "select"    => 'Vybrat leky: ',
    );

    /** @var array Zpravy */
    protected $messages = array(
        "INSERT_OK" => "Lek byl přidán.",
        "INSERT_BAD" => "Lek se nepodařilo přidat",
        "UPDATE_OK" => "Lek byl upraven.",
        "UPDATE_BAD" => "Lek se nepodařilo upravit.",
    );

    /** @var string Sblona pro editovani */
    protected $templateForEdit;

    /** @var string Sblona pro pridani noveho */
    protected $templateForAdd;



    public function __construct()
    {
        $this->templateForAdd = __DIR__.'/templates/general/addItem.latte';
        $this->templateForEdit = "".__DIR__."/templates/general/editItem.latte";
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

        /** @var Nette\Bridges\ApplicationLatte\Template $template */
        $template = $this->template;
        $template->setFile(__DIR__ . '/templates/general/allItems.latte');

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
    }


    public function beforeRenderSelect()
    {
        die();
        $this->setLayout(__DIR__ . '/templates/selectItemLayout.latte');
    }


    // Pro jednoduchou podminku z adresy
    private $addWhereForColumn      = false;
    private $addWhereForColumnName  = "";
    private $addWhereForColumnVal   = "";

    /**
     * Render pro selektovani itemu
     *
     * @param $one
     */
    public function renderSelect($one, $inc, $columnNameForWhere, $valueForWhere) {

        // Omezeni na jeden radek
        $this->showPocetSelected = true;
        if ($one) {
            if ($one == 'true') {
                $this->showPocetSelected = false;
            }
        }

        // Pridavani do selektovanych id
        $incIds = false;
        if ($inc) {
            if ($inc == 'true') {
                $incIds = true;
            }
        }

        // Jednoducha podminka
        if ($columnNameForWhere) {
            $this->addWhereForColumn = true;
            $this->addWhereForColumnName = $columnNameForWhere;
            $this->addWhereForColumnVal = $valueForWhere;
        }

        /** @var Nette\Bridges\ApplicationLatte\Template $template */
        $template = $this->template;
        $template->setFile(__DIR__ . '/templates/general/selectItem.latte');

        $this->template->site       = $this->site;
        $this->template->nadpis     = $this->nadpisy["select"];
        $this->template->showNumbers = ($this->showPocetSelected)? 'true':'false';
        $this->template->showNumberBool = $this->showPocetSelected;
        $this->template->inc        = ($incIds)? 'true':'false';
    }


    protected function addBasicWhereFromURL(){
        return $this->addWhereForColumn;
    }


    protected $showPocetSelected = true;
    protected $showSelectedItems = false;
    /**
     * Pro vzpis vyselectovanych itemu
     *
     * @param $array - pole vsech vyselectovanych itemu  (format:  id:pocet,id:pocet)
     */
    public function renderSelecteditems($show, $showPocet) {

        $this->showSelectedItems = true;

        $this->processSelectedItems($show); // ziskani id a poctu ze stringu

        if ($showPocet) {
            if ($showPocet == "1") {
                $this->showPocetSelected = true;
            }
            else if ($showPocet == "0"){
                $this->showPocetSelected = false;
            }
        }
        else {
            $this->showPocetSelected = false;
        }

        /** @var Nette\Bridges\ApplicationLatte\Template $template */
        $template = $this->template;
        $template->setFile(__DIR__ . '/templates/general/selectedItems.latte');
        $this->template->showNumbers = ($this->showPocetSelected)? 'true':'false';
    }


    /**
     * Zmena hodnot pred vypisem do editacniho formu
     *
     * @param $values polozky jako pole
     * @return upravene polozky
     */
    protected function changeValuesBeforeEdit($values) {
        die("changeValuesBeforeEdit not implemented");
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


    ///
    ///
    /// Vybirani prvku START
    ///
    ///
    protected $selectedItems = array();
    /**
     * Pronde string z adresy a predela ho na pole
     *
     * @param $array
     */
    protected function processSelectedItems($array) {

        $items = explode(',', $array);
        if (count($array) > 0) {
            foreach ($items as $item) {
                // rozdeleni na id a pocet   id:pocet
                $parts = explode(':', $item);
                if (count($parts) > 0) {
                    $id = $parts[0];
                    $pocet = 1;
                    if (count($parts) > 1) {
                        $pocet = $parts[1];
                    }
                    $this->selectedItems[] = array($id, $pocet);
                }
                else {
                    echo "wrong";
                }
            }
        }
        else {
            if ($this->haveToFilter()) {
                "-9999999999";
            }
        }
    }

    protected function haveToFilter(){
        return $this->showSelectedItems;
    }

    protected function generateWhere() {

        $ret = array();
        // id:pocet  ->    0 id      1 pocet
        foreach ($this->selectedItems as $item) {
            $ret[] = $item[0];
        }
        return $ret;
    }

    protected function getPocetForId($id){

        // id:pocet  ->    0 id      1 pocet
        foreach ($this->selectedItems as $item) {
            if ($item[0] == $id) {
                return $item[1];
            }
        }
        return 0;
    }

    protected function createComponentSelectedItemsDatagrid($name)
    {

        $grid = $this->createDataGrid($name); // vytvoreni

        $grid = $this->addColumnsToGrid($grid); // pridani sloupecku

        if ($this->showPocetSelected) {
            // pridani postu itemu
            $grid->addTemplate('pocet', 'Počet')
                ->setCallbackArguments(array($this))
                ->setTemplate(__DIR__ . '/templates/Column/_number.latte')
                ->setCallback(function($data, Nette\Application\UI\ITemplate $template, $presenter) {
                    $template->value = $presenter->getPocetForId($data[$presenter->getModelManager()->getPkColumn()]);
                });
        }
        return $grid;
    }


    /**
     * Definovani sloupci pro datagrid
     *
     * @param $grid grid
     * @return mixed grid
     */
    protected function defineColumnsForDatagrid($grid) {

        die('defineColumnsForDatagrid not implemented');
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
        $source = new NetteDbDataSource($this->getModelManager()->getAll());
        $source->setPrimaryKey($this->getModelManager()->getPkColumn());

        if ($this->haveToFilter()) {
            $source->where($this->getModelManager()->getPkColumn(), $this->generateWhere());
        }

        // Pridani jednoduche podminky z URL
        if ($this->addBasicWhereFromURL()) {
            $source->where($this->addWhereForColumnName." = ?", $this->addWhereForColumnVal);
        }


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
     * Datagrid pro select itemu
     *
     * @param $name
     * @return Grid
     */
    protected function createComponentSelectDatagrid($name)
    {
        $grid = $this->createDataGrid($name); // vytvoreni

        $grid->enableFilter(); // Enagle filtrace

        // pridani check boxu
        $grid->addTemplate('checkbox', '')
            ->setCallbackArguments(array($this))
            ->setTemplate(__DIR__ . '/templates/Column/_checkBox.latte')
            ->setCallback(function($data, Nette\Application\UI\ITemplate $template, $presenter) {
                $template->id = $data[$presenter->getModelManager()->getPkColumn()];
            });

        $grid = $this->addColumnsToGrid($grid); // pridani sloupecku

        if ($this->showPocetSelected) {
            // pridani selectu postu itemu
            $grid->addTemplate('pocet', 'Počet')
                ->setCallbackArguments(array($this))
                ->setTemplate(__DIR__ . '/templates/Column/_numberOfItems.latte')
                ->setCallback(function ($data, Nette\Application\UI\ITemplate $template,$presenter) {
                    $template->id = $data[$presenter->getModelManager()->getPkColumn()];
                });
        }

        return $grid;
    }

    /**
     * Definovani inputu pro formular
     *
     * @param $form
     */
    protected function defineInputsForForm($form) {

        die('defineInputsForForm not implemented.');
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
        $form->addSubmit('send', 'Uložit');
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

        die('changeValuesAfterEdit not implemented.');
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

        $insert = false;

        // Editace?
        if ($this->getParameter('id')) {
            // Existence?
            $item = $this->modelManager->getSpecific($values[$this->modelManager->getPkColumn()]);
            if ($item) {
                if ($item->update($values)) {
                    $this->flashMessage($this->messages["UPDATE_OK"], 'success');
                    $insert = true;
                }
                else {
                    $this->flashMessage($this->messages["UPDATE_BAD"], 'warning');
                    $insert = true;
                }
            }
        }

        // Insert
        if ( ! $insert) {
            if ($this->modelManager->add($values) != null) {
                $this->flashMessage($this->messages["INSERT_OK"], 'success');
            }
            else {
                $this->flashMessage($this->messages["INSERT_BAD"], 'warning');
            }
        }

        $this->redirect('default');
    }




    public function getModelManager() {
        return $this->modelManager;
    }

}
