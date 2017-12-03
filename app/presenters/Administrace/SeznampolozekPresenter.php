<?php

namespace App\Presenters;

use App\Model\DoplatekManager;
use App\Model\LekManager;
use App\Model\PojistovnaManager;
use App\Model\ProdejManager;
use App\Model\SeznampolozekManager;
use Nette;
use Mesour\DataGrid\NetteDbDataSource,
    Mesour\DataGrid\Grid,
    Mesour\DataGrid\Components\Link;
use Mesour\DataGrid\Components\Button;
use Nette\Application\UI\Form;

class SeznampolozekPresenter extends GeneralPresenter
{

    public $lekManager;
    public $prodejManager;

    public function __construct(SeznampolozekManager $seznampolozekManager, LekManager $lekManager, ProdejManager $prodejManager)
    {
        parent::__construct();

        $this->modelManager = $seznampolozekManager;
        $this->lekManager = $lekManager;
        $this->prodejManager = $prodejManager;

        $this->site = 'seznampolozek';
        $this->nadpisy = array(
            "default"   => 'Položky prodeje',
            "edit"      => 'Editace seznamu položek: ', // + id editovaneho
            "add"       => 'Přidání seznamu položek:',
            "select"    => 'Vybrat seznam položek: ',
        );
        $this->messages = array(
            "INSERT_OK" => "Seznam položek byl přidán.",
            "INSERT_BAD" => "Seznam položek se nepodařilo přidat",
            "UPDATE_OK" => "Seznam položek byl upraven.",
            "UPDATE_BAD" => "Seznam položek se nepodařilo upravit.",
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
        $grid->addNumber('seznampolozekID', 'Id');

        $grid->addNumber('prodejID', 'Id prodeje');

        $grid->addNumber('lekID', 'Lék Id');

        $grid->addTemplate('lekID', 'Lék nazev')
            ->setCallbackArguments(array($this))
            ->setTemplate(__DIR__ . '/templates/Column/_itemName.latte') // or instanceof UI\ITemplate
            ->setCallback(function($data, Nette\Application\UI\ITemplate $template, SeznampolozekPresenter $presenter) {
                $template->id = $data['lekID'];
                $template->nazev = $presenter->lekManager->getName($data['lekID']);
            });

        $grid->addNumber('cena', 'Cena')
            ->setDecimals(2)
            ->setDecimalPoint(',')
            ->setThousandsSeparator(' ');

        $grid->addNumber('mnozstvi', 'Množství');

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

        // Cislo
        $form->addText('cena', 'Cena:', 38)
            ->setHtmlType('number')
            ->setRequired(true);


        // Cislo
        $form->addText('mnozstvi', 'Množství:', 11)
            ->setHtmlType('number')
            ->setRequired(true);

        $form->addSelectItem('prodejID', 'Prodej: ', 'prodej')
            ->setSearchOne(true)
            ->setRequired('Field "Prodej" is required.')
            ->setButtonLabel("Vybrat prodej");


        $form->addSelectItem('lekID', 'Lék: ', 'lek')
            ->setSearchOne(true)
            ->setRequired('Field "Lék" is required.')
            ->setButtonLabel("Vybrat lék");


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
        return $data;
    }
}
