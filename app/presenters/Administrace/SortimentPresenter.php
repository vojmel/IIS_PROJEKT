<?php

namespace App\Presenters;

use App\Model\SortimentManager;
use App\Model\LekManager;
use App\Model\ProdejManager;
use App\Model\UskladnenManager;
use Nette;
use Mesour\DataGrid\NetteDbDataSource,
    Mesour\DataGrid\Grid,
    Mesour\DataGrid\Components\Link;
use Mesour\DataGrid\Components\Button;
use Nette\Application\UI\Form;

class SortimentPresenter extends GeneralPresenter
{
    public $lekManager;
    public $prodejManager;

    public function __construct(SortimentManager $sortimentManager, LekManager $lekManager, ProdejManager $prodejManager)
    {
        parent::__construct();

        $this->modelManager = $sortimentManager;
        $this->lekManager = $lekManager;
        $this->prodejManager = $prodejManager;

        $this->site = 'sortiment';
        $this->nadpisy = array(
            "default"   => 'sortimenty',
            "edit"      => 'Editace sortimentu: ', // + id editovaneho
            "add"       => 'Přidání sortimentu:',
            "select"    => 'Vybrat sortiment: ',
        );
        $this->messages = array(
            "INSERT_OK" => "Sortiment byl přidán.",
            "INSERT_BAD" => "Sortiment se nepodařilo přidat",
            "UPDATE_OK" => "Sortiment byl upraven.",
            "UPDATE_BAD" => "Sortiment se nepodařilo upravit.",
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
        $grid->addNumber('sortimentID', 'ID sortimentu');

        $grid->addTemplate('lekID', 'Lék nazev')
            ->setCallbackArguments(array($this))
            ->setTemplate(__DIR__ . '/templates/Column/_itemName.latte') // or instanceof UI\ITemplate
            ->setCallback(function($data, Nette\Application\UI\ITemplate $template, SortimentPresenter $presenter) {
                $template->id = $data['lekID'];
                $template->nazev = $presenter->lekManager->getName($data['lekID']);
            });


        $grid->addNumber('cena', 'Cena');
        $grid->addNumber('dodavatelID', 'Dodavatel');




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

