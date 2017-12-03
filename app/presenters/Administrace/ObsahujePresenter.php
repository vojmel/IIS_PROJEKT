<?php

namespace App\Presenters;

use App\Model\LekManager;
use App\Model\ObsahujeManager;
use App\Model\PredpisManager;
use App\Model\RezervaceManager;
use Nette;
use Mesour\DataGrid\NetteDbDataSource,
    Mesour\DataGrid\Grid,
    Mesour\DataGrid\Components\Link;
use Mesour\DataGrid\Components\Button;
use Nette\Application\UI\Form;

class ObsahujePresenter extends GeneralPresenter
{

    public $lekManager;
    public $rezervaceManager;

    public function __construct(ObsahujeManager $obsahujeManager, LekManager $lekManager, RezervaceManager $rezervaceManager)
    {
        parent::__construct();

        $this->modelManager = $obsahujeManager;
        $this->lekManager = $lekManager;
        $this->rezervaceManager = $rezervaceManager;

        $this->site = 'obsahuje';
        $this->nadpisy = array(
            "default"   => 'Obsahuje',
            "edit"      => 'Editace objednavka Obsahuje: ', // + id editovaneho
            "add"       => 'Přidání Predpisu na lék:',
            "select"    => 'Vybrat Predpisu na lék: ',
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
        $grid->addNumber('obsahujeID', 'Id');

        $grid->addNumber('lekID', 'Id léku');

        $grid->addTemplate('lekID', 'Lék nazev')
            ->setCallbackArguments(array($this))
            ->setTemplate(__DIR__ . '/templates/Column/_itemName.latte') // or instanceof UI\ITemplate
            ->setCallback(function($data, Nette\Application\UI\ITemplate $template, ObsahujePresenter $presenter) {
                $template->id = $data['lekID'];
                $template->nazev = $presenter->lekManager->getName($data['lekID']);
            });

        $grid->addNumber('rezervaceID', 'Id rezervace');

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
