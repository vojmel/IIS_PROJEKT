<?php

namespace App\Presenters;

use App\Model\PobockaManager;
use App\Model\LekManager;
use App\Model\UskladnenManager;
use Nette;
use Mesour\DataGrid\NetteDbDataSource,
    Mesour\DataGrid\Grid,
    Mesour\DataGrid\Components\Link;
use Mesour\DataGrid\Components\Button;
use Nette\Application\UI\Form;

class UskladnenPresenter extends GeneralPresenter
{
    public $lekManager;
    public $pobockaManager;

    public function __construct(UskladnenManager $uskladnenManager, LekManager $lekManager, PobockaManager $pobockaManager)
    {
        parent::__construct();

        $this->modelManager = $uskladnenManager;
        $this->lekManager = $lekManager;
        $this->pobockaManager = $pobockaManager;

        $this->site = 'uskladnen';
        $this->nadpisy = array(
            "default"   => 'Uskladněné léky',
            "edit"      => 'Editace uskladnění: ', // + id editovaneho
            "add"       => 'Přidání uskladnění:',
            "select"    => 'Vybrat uskladnění: ',
        );
        $this->messages = array(
            "INSERT_OK" => "Uskladnění bylo přidáno.",
            "INSERT_BAD" => "Uskladnění se nepodařilo přidat",
            "UPDATE_OK" => "Uskladnění bylo upraveno.",
            "UPDATE_BAD" => "Uskladnění se nepodařilo upravit.",
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
        $grid->addNumber('uskladnenID', 'ID Uskladnění');

        $grid->addNumber('lekID', 'Id léku');

        $grid->addTemplate('lekID', 'Název léku')
            ->setCallbackArguments(array($this))
            ->setTemplate(__DIR__ . '/templates/Column/_itemName.latte') // or instanceof UI\ITemplate
            ->setCallback(function($data, Nette\Application\UI\ITemplate $template, UskladnenPresenter $presenter) {
                $template->id = $data['lekID'];
                $template->nazev = $presenter->lekManager->getName($data['lekID']);
            });


        $grid->addNumber('pobockaID', 'Číslo pobočky');

        $grid->addTemplate('pobockaID', 'Pobočka')
            ->setCallbackArguments(array($this))
            ->setTemplate(__DIR__ . '/templates/Column/_itemName.latte') // or instanceof UI\ITemplate
            ->setCallback(function($data, Nette\Application\UI\ITemplate $template, $presenter) {
                $template->id = $data['pobockaID'];
                $template->nazev = $presenter->pobockaManager->getName($data['pobockaID']);
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
