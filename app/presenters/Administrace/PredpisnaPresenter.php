<?php

namespace App\Presenters;

use App\Model\PredpisnaManager;
use App\Model\LekManager;
use App\Model\PredpisManager;
use Nette;
use Mesour\DataGrid\NetteDbDataSource,
    Mesour\DataGrid\Grid,
    Mesour\DataGrid\Components\Link;
use Mesour\DataGrid\Components\Button;
use Nette\Application\UI\Form;

class PredpisnaPresenter extends GeneralPresenter
{

    public $lekManager;
    public $predpisManager;

    public function __construct(PredpisnaManager $predpisnaManager, LekManager $lekManager, PredpisManager $predpisManager)
    {
        parent::__construct();

        $this->modelManager = $predpisnaManager;
        $this->lekManager = $lekManager;
        $this->predpisManager = $predpisManager;

        $this->site = 'predpisna';
        $this->nadpisy = array(
            "default"   => 'Předpisy na léky',
            "edit"      => 'Editace léku z předpisu: ', // + id editovaneho
            "add"       => 'Přidání léku k předpisu: ',
            "select"    => 'Vybrat léku z předpisu: ',
        );
        $this->messages = array(
            "INSERT_OK" => "Predpisu na lék byl přidán.",
            "INSERT_BAD" => "Predpisu na lék se nepodařilo přidat",
            "UPDATE_OK" => "Predpisu na lék byl upraven.",
            "UPDATE_BAD" => "Predpisu na lék se nepodařilo upravit.",
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

        $grid->addNumber('predpisnaID', 'ID Předpisu na');

        $grid->addNumber('predpisID', 'ID Předpisu');

        $grid->addNumber('lekID', 'Id léku');

        $grid->addTemplate('lekID', 'Lék nazev')
            ->setCallbackArguments(array($this))
            ->setTemplate(__DIR__ . '/templates/Column/_itemName.latte') // or instanceof UI\ITemplate
            ->setCallback(function($data, Nette\Application\UI\ITemplate $template, PredpisnaPresenter $presenter) {
                $template->id = $data['lekID'];
                $template->nazev = $presenter->lekManager->getName($data['lekID']);
            });


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
        $form->addSelectItem('predpisID', 'Předpis: ', 'predpis')
            ->setSearchOne(true)
            ->setRequired('Field "Předpis" is required.')
            ->setButtonLabel("Vybrat předpis");


        $form->addSelectItem('lekID', 'Lék: ', 'lek')
            ->setSearchOne(true)
            ->setRequired('Field "Lék" is required.')
            ->setButtonLabel("Vybrat lék");


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
