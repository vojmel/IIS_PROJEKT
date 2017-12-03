<?php

namespace App\Presenters;

use App\Model\ProdejManager;
use App\Model\PobockaManager;
use App\Model\LekarnikManager;
use Nette;
use Mesour\DataGrid\NetteDbDataSource,
    Mesour\DataGrid\Grid,
    Mesour\DataGrid\Components\Link;
use Mesour\DataGrid\Components\Button;
use Nette\Application\UI\Form;

class ProdejPresenter extends GeneralPresenter
{
    public $pobockaManager;
    public $lekarnikManager;

    public function __construct(ProdejManager $prodejManager, PobockaManager $pobockaManager, LekarnikManager $lekarnikManager)
    {
        parent::__construct();

        $this->modelManager = $prodejManager;
        $this->pobockaManager = $pobockaManager;
        $this->lekarnikManager = $lekarnikManager;

        $this->site = 'prodej';
        $this->nadpisy = array(
            "default"   => 'Prodeje',
            "edit"      => 'Editace prodeje: ', // + id editovaneho
            "add"       => 'Přidání prodeje:',
            "select"    => 'Vybrat prodej: ',
        );
        $this->messages = array(
            "INSERT_OK" => "ProdejLeku byl přidán.",
            "INSERT_BAD" => "ProdejLeku se nepodařilo přidat",
            "UPDATE_OK" => "ProdejLeku byl upraven.",
            "UPDATE_BAD" => "ProdejLeku se nepodařilo upravit.",
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


        $grid->addNumber('lekarnikID', 'Id lékarníka');


        $grid->addTemplate('lekarnikID', 'Lékárník')
            ->setCallbackArguments(array($this))
            ->setTemplate(__DIR__ . '/templates/Column/_itemName.latte') // or instanceof UI\ITemplate
            ->setCallback(function($data, Nette\Application\UI\ITemplate $template, $presenter) {
                $template->id = $data['lekarnikID'];
                $template->nazev = $presenter->lekarnikManager->getName($data['lekarnikID']);
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
        $form->addText("datum", "Datum: ")
            ->setAttribute("placeholder", "dd.mm.rrrr")
            ->setRequired(true)
            ->addRule($form::PATTERN, "Datum musí být ve formátu dd.mm.rrrr", "(0[1-9]|[12][0-9]|3[01])\.(0[1-9]|1[012])\.(19|20)\d\d");

        $form->addSelectItem('lekarnikID', 'Lékárník: ', 'lekarnik')
            ->setSearchOne(true)
            ->setRequired('Field "Lékárník" is required.')
            ->setButtonLabel("Vybrat Lékárníka");

        $form->addSelectItem('pobockaID', 'Pobočka: ', 'pobocka')
            ->setSearchOne(true)
            ->setRequired('Field "Pobočka" is required.')
            ->setButtonLabel("Vybrat pobočku");





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
        $values['datum'] = date('d.m.Y', $values['datum']->getTimestamp());

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
        $data["datum"] = Nette\DateTime::from($data["datum"]);
        return $data;
    }
}
