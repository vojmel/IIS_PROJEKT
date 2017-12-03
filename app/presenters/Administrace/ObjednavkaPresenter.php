<?php

namespace App\Presenters;

use App\Model\DodavatelManager;
use App\Model\ObjednavkaManager;
use App\Model\PobockaManager;
use App\Model\LekarnikManager;
use Nette;
use Mesour\DataGrid\NetteDbDataSource,
    Mesour\DataGrid\Grid,
    Mesour\DataGrid\Components\Link;
use Mesour\DataGrid\Components\Button;
use Nette\Application\UI\Form;

class ObjednavkaPresenter extends GeneralAdminPresenter
{
    public $pobockaManager;
    public $dodavatelManager;

    public function __construct(ObjednavkaManager $objednavkaManager, PobockaManager $pobockaManager, DodavatelManager $dodavatelManager)
    {
        parent::__construct();

        $this->modelManager = $objednavkaManager;
        $this->pobockaManager = $pobockaManager;
        $this->dodavatelManager = $dodavatelManager;

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
            ->setCallback(function($data, Nette\Application\UI\ITemplate $template, ObjednavkaPresenter $presenter) {
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
        $data["datupDoruceni"] = Nette\DateTime::from($data["datupDoruceni"]);
        return $data;
    }
}
