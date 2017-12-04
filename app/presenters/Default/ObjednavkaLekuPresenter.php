<?php
/**
 * Created by PhpStorm.
 * User: Meluzin
 * Date: 04.12.2017
 * Time: 19:56
 */

namespace App\Presenters;

use App\Model\DodavatelManager;
use App\Model\ObjednavkaManager;
use App\Model\ObjednavkaobsahujeManager;
use App\Model\PobockaManager;
use App\Model\LekarnikManager;
use Nette;
use Mesour\DataGrid\NetteDbDataSource,
    Mesour\DataGrid\Grid,
    Mesour\DataGrid\Components\Link;
use Mesour\DataGrid\Components\Button;
use Nette\Application\UI\Form;

class ObjednavkaLekuPresenter extends GeneralDefaultPresenter
{
    public $pobockaManager;
    public $dodavatelManager;
    public $objednavkaManager;
    public $objednavkaobsahujeManager;

    public function __construct(ObjednavkaobsahujeManager $objednavkaobsahujeManager, ObjednavkaManager $objednavkaManager, PobockaManager $pobockaManager, DodavatelManager $dodavatelManager)
    {
        parent::__construct();

        $this->modelManager = $objednavkaManager;
        $this->pobockaManager = $pobockaManager;
        $this->dodavatelManager = $dodavatelManager;
        $this->objednavkaManager = $objednavkaManager;
        $this->objednavkaobsahujeManager = $objednavkaobsahujeManager;

        $this->site = 'objednavka';
        $this->nadpisy = array(
            "default"   => 'Objednávky léků',
            "edit"      => 'Editace obsahu objednávky: ', // + id editovaneho
            "add"       => 'Přidání obsahu objednávky:',
            "select"    => 'Vybrat obsahu objednávky: ',
        );
        $this->messages = array(
            "INSERT_OK" => "Obsah objednávky byl přidán.",
            "INSERT_BAD" => "Obsah objednávky se nepodařilo přidat",
            "UPDATE_OK" => "Obsah objednávky byl upraven.",
            "UPDATE_BAD" => "Obsah objednávky se nepodařilo upravit.",
        );


        $this->templateForAdd = __DIR__.'/templates/ObjednavkaLeku/addState1.latte';
        $this->templateForEdit = "".__DIR__."/templates/ObjednavkaLeku/edit.latte";
    }

    /**
     * Definice sloupccu
     *
     * @param Grid $grid
     * @return Grid
     */
    protected function defineColumnsForDatagrid($grid)
    {
        $grid->addNumber('objednavkaID', 'Id');

        $grid->addDate('datupObjednani', 'Datum objednání')
            ->setFormat('j.n.Y H:i:s');

        $grid->addDate('datupDoruceni', 'Datum doručení')
            ->setFormat('j.n.Y H:i:s');

        $grid->addNumber('pobockaID', 'Číslo pobočky');

        $grid->addTemplate('pobockaID', 'Pobočka')
            ->setCallbackArguments(array($this))
            ->setTemplate(__DIR__ . '/templates/Column/_itemName.latte') // or instanceof UI\ITemplate
            ->setCallback(function($data, Nette\Application\UI\ITemplate $template, $presenter) {
                $template->id = $data['pobockaID'];
                $template->nazev = $presenter->pobockaManager->getName($data['pobockaID']);
            });


        $grid->addNumber('dodavatelID', 'Id dodavatele');

        $grid->addTemplate('dodavatelID', 'Dodavatel')
            ->setCallbackArguments(array($this))
            ->setTemplate(__DIR__ . '/templates/Column/_itemName.latte') // or instanceof UI\ITemplate
            ->setCallback(function($data, Nette\Application\UI\ITemplate $template, ObjednavkaLekuPresenter $presenter) {
                $template->id = $data['dodavatelID'];
                $template->nazev = $presenter->dodavatelManager->getName($data['dodavatelID']);
            });


        return $grid;
    }

    /**
     * Definice inputu pro editaci na new
     *
     * @param $form
     * @return mixed
     */
    protected function defineInputsForForm($form)
    {
        // Datum
        $form->addText("datupObjednani", "Datum objednání: ")
            ->setAttribute("placeholder", "dd.mm.rrrr")
            ->setRequired(true)
            ->addRule($form::PATTERN, "Datum musí být ve formátu dd.mm.rrrr", "(0[1-9]|[12][0-9]|3[01])\.(0[1-9]|1[012])\.(19|20)\d\d");

        $form->addText("datupDoruceni", "Datum doručení: ")
            ->setAttribute("placeholder", "dd.mm.rrrr")
            ->setRequired(true)
            ->addRule($form::PATTERN, "Datum musí být ve formátu dd.mm.rrrr", "(0[1-9]|[12][0-9]|3[01])\.(0[1-9]|1[012])\.(19|20)\d\d");

        $form->addSelectItem('pobockaID', 'Pobočka: ', 'pobocka')
            ->setSearchOne(true)
            ->setRequired('Field "Pobočka" is required.')
            ->setButtonLabel("Vybrat pobočku");

        $form->addSelectItem('dodavatelID', 'Dodavatel: ', 'dodavatel')
            ->setSearchOne(true)
            ->setRequired('Field "Dodavatel" is required.')
            ->setButtonLabel("Vybrat dodavatele");

        // vybrane leky k objednavce
        $form->addHidden('vybraneLekyIds')
            ->setRequired('Je potřeba vybrat nějaké léky.');

        return $form;
    }

    /**
     * Zmena hodnot pred editaci
     *
     * @param polozky $values
     * @return upravene hodnoty
     */
    protected function changeValuesBeforeEdit($values)
    {
        $values['datupObjednani'] = date('d.m.Y', $values['datupObjednani']->getTimestamp());
        $values['datupDoruceni'] = date('d.m.Y', $values['datupDoruceni']->getTimestamp());

        // select vybranych leku k objednavce
        $values['vybraneLekyIds'] = $this->objednavkaManager->getPolozky($values['objednavkaID']);

        return $values;
    }

    /**
     * Zmena hodnot pred poslanim do databaze
     *
     * @param $data
     * @return mixed
     */
    protected function changeValuesAfterEdit($data)
    {
        // oprava datumu pro zapis do db
        $data["datupObjednani"] = Nette\DateTime::from($data["datupObjednani"]);
        $data["datupObjednani"]->modify('+14 seconds');
        $data["datupDoruceni"] = Nette\DateTime::from($data["datupDoruceni"]);

        return $data;
    }

    /**
     * Zmena zpracovani po odeslani obednavky
     */
    public function postFormAddSucceeded($form, $values)
    {
        $values = $this->changeValuesAfterEdit($values);

        // EDITACE?
        if ($this->getParameter('id')) {

            $leky = $values['vybraneLekyIds'];
            unset($values['vybraneLekyIds']);


            // update dane objednavky
            // Existence?
            $item = $this->modelManager->getSpecific($values[$this->modelManager->getPkColumn()]);
            if ($item) {

                if (! $this->objednavkaobsahujeManager->setNewObsahuje($this->getParameter('id'), $leky) ) {
                    $this->flashMessage('Nepodařilo se upravit leky pro objednávku.', 'warning');
                    $this->redirect('default');
                    return;
                }

                if ($item->update($values)) {
                    $this->flashMessage($this->messages["UPDATE_OK"], 'success');
                }
                else {
                    $this->flashMessage($this->messages["UPDATE_BAD"], 'warning');
                    $this->redirect('default');
                    return;
                }
            }
        }

        // INSERT?
        else {

            /*
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

            $this->flashMessage('Nový prodej byl vytvořen.', 'success');*/
        }
        $this->redirect('default');
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
                'onclick' => "getPutValueInt('vybraneLekyIds', 'vybraneLekyIds');", /*  pridani presunuti aktualnich hodnot vybranych prvku  */
            ))->setHtml('<span style="font-size:16px; margin-right: 15px;" class="pull-left hidden-xs showopacity glyphicon glyphicon-floppy-saved"></span> Uložit prodej');


        $form->onSuccess[] = array($this, 'postFormAddSucceeded');


        return $form;
    }
}