<?php

namespace App\Presenters;

use App\Model\DoplatekManager;
use App\Model\LekManager;
use App\Model\PojistovnaManager;
use Nette;
use Mesour\DataGrid\NetteDbDataSource,
    Mesour\DataGrid\Grid,
    Mesour\DataGrid\Components\Link;
use Mesour\DataGrid\Components\Button;
use Nette\Application\UI\Form;

class DoplatekPresenter extends GeneralPresenter
{

    public $lekManager;
    public $pojistovnaManager;

    public function __construct(DoplatekManager $doplatekManager, LekManager $lekManager, PojistovnaManager $pojistovnaManager)
    {
        parent::__construct();

        $this->modelManager = $doplatekManager;
        $this->lekManager = $lekManager;
        $this->pojistovnaManager = $pojistovnaManager;

        $this->site = 'doplatek';
        $this->nadpisy = array(
            "default"   => 'Doplatky na leky',
            "edit"      => 'Editace doplatku: ', // + id editovaneho
            "add"       => 'Přidání doplatku:',
            "select"    => 'Vybrat doplatek: ',
        );
        $this->messages = array(
            "INSERT_OK" => "Doplatek byl přidán.",
            "INSERT_BAD" => "Doplatek se nepodařilo přidat",
            "UPDATE_OK" => "Doplatek byl upraven.",
            "UPDATE_BAD" => "Doplatek se nepodařilo upravit.",
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
        $grid->addNumber('doplatekID', 'Id');

        $grid->addNumber('pojistovnaID', 'Id pojišťovny');


        $grid->addNumber('lekID', 'Id léku');

        $grid->addTemplate('lekID', 'Název léku')
            ->setCallbackArguments(array($this))
            ->setTemplate(__DIR__ . '/templates/Column/_itemName.latte') // or instanceof UI\ITemplate
            ->setCallback(function($data, Nette\Application\UI\ITemplate $template, DoplatekPresenter $presenter) {
                $template->id = $data['lekID'];
                $template->nazev = $presenter->lekManager->getName($data['lekID']);
            });

        $grid->addTemplate('pojistovnaID', 'Název pojišťovny')
            ->setCallbackArguments(array($this))
            ->setTemplate(__DIR__ . '/templates/Column/_itemName.latte') // or instanceof UI\ITemplate
            ->setCallback(function($data, Nette\Application\UI\ITemplate $template, $presenter) {
                $template->id = $data['pojistovnaID'];
                $template->nazev = $presenter->pojistovnaManager->getName($data['pojistovnaID']);
            });



        $grid->addNumber('cena', 'Cena')
            ->setDecimals(2)
            ->setDecimalPoint(',')
            ->setThousandsSeparator(' ');

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


        $form->addSelectItem('pojistovnaID', 'Pojišťovna: ', 'pojistovna')
            ->setSearchOne(true)
            ->setRequired('Field "Pojišťovna" is required.')
            ->setButtonLabel("Vybrat pojišťovnu");


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
