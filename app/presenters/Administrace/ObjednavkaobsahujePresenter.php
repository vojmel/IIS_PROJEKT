<?php

namespace App\Presenters;

use App\Model\ObjednavkaManager;
use App\Model\LekManager;
use App\Model\ObjednavkaobsahujeManager;
use Nette;
use Mesour\DataGrid\NetteDbDataSource,
    Mesour\DataGrid\Grid,
    Mesour\DataGrid\Components\Link;
use Mesour\DataGrid\Components\Button;
use Nette\Application\UI\Form;

class ObjednavkaobsahujePresenter extends GeneralAdminPresenter
{

    public $lekManager;
    public $objednavkaManager;

    public function __construct(ObjednavkaobsahujeManager $objednavkaobsahujeManager, LekManager $lekManager, ObjednavkaManager $objednavkaManager)
    {
        parent::__construct();

        $this->modelManager = $objednavkaobsahujeManager;
        $this->lekManager = $lekManager;
        $this->objednavkaManager = $objednavkaManager;

        $this->site = 'objednavkaobsahuje';
        $this->nadpisy = array(
            "default"   => 'Obsahy objednávek',
            "edit"      => 'Editace obsahu objednávky: ', // + id editovaneho
            "add"       => 'Přidání obsahu do objednávky:',
            "select"    => 'Vybrání obsahu objednávky:',
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
        $grid->addNumber('objednavkaobsahujeID', 'Id obsahu objednavky');

        $grid->addNumber('objednavkaID', 'Id objednávky');

        $grid->addNumber('lekID', 'Id léku');

        $grid->addTemplate('lekID', 'Lék nazev')
            ->setCallbackArguments(array($this))
            ->setTemplate(__DIR__ . '/templates/Column/_itemName.latte') // or instanceof UI\ITemplate
            ->setCallback(function($data, Nette\Application\UI\ITemplate $template, ObjednavkaobsahujePresenter $presenter) {
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
        $form->addSelectItem('objednavkaID', 'Objednávka: ', 'objednavka')
            ->setSearchOne(true)
            ->setRequired('Field "Objednávka" is required.')
            ->setButtonLabel("Vybrat objednávku");


        $form->addSelectItem('lekID', 'Lék: ', 'lek')
            ->setSearchOne(true)
            ->setRequired('Field "Lék" is required.')
            ->setButtonLabel("Vybrat lék");


        // Cislo
        $form->addText('cena', 'Cena:', 38)
            ->setHtmlType('number')
            ->setRequired(true);


        // Cislo
        $form->addText('mnozstvi', 'Množství:', 11)
            ->setHtmlType('number')
            ->setRequired(true);



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
