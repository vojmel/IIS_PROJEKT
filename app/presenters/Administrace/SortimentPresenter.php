<?php

namespace App\Presenters;

use App\Model\SortimentManager;
use App\Model\LekManager;
use App\Model\DodavatelManager;
use App\Model\UskladnenManager;
use Nette;
use Mesour\DataGrid\NetteDbDataSource,
    Mesour\DataGrid\Grid,
    Mesour\DataGrid\Components\Link;
use Mesour\DataGrid\Components\Button;
use Nette\Application\UI\Form;

class SortimentPresenter extends GeneralAdminPresenter
{
    public $lekManager;
    public $dodavatelManager;

    public function __construct(SortimentManager $sortimentManager, LekManager $lekManager, DodavatelManager $dodavatelManager)
    {
        parent::__construct();

        $this->modelManager = $sortimentManager;
        $this->lekManager = $lekManager;
        $this->dodavatelManager = $dodavatelManager;

        $this->site = 'sortiment';
        $this->nadpisy = array(
            "default"   => 'Sortimenty dodavatelů',
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
        $grid->addNumber('sortimentID', 'Id sortimentu');

        $grid->addNumber('lekID', 'Id léku');

        $grid->addTemplate('lekID', 'Lék nazev')
            ->setCallbackArguments(array($this))
            ->setTemplate(__DIR__ . '/templates/Column/_itemName.latte') // or instanceof UI\ITemplate
            ->setCallback(function($data, Nette\Application\UI\ITemplate $template, SortimentPresenter $presenter) {
                $template->id = $data['lekID'];
                $template->nazev = $presenter->lekManager->getName($data['lekID']);
            });

        $grid->addNumber('dodavatelID', 'Id dodavatele');

        $grid->addTemplate('dodavatelID', 'Dodavatel')
            ->setCallbackArguments(array($this))
            ->setTemplate(__DIR__ . '/templates/Column/_itemName.latte') // or instanceof UI\ITemplate
            ->setCallback(function($data, Nette\Application\UI\ITemplate $template, SortimentPresenter $presenter) {
                $template->id = $data['dodavatelID'];
                $template->nazev = $presenter->dodavatelManager->getName($data['dodavatelID']);
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
        $form->addSelectItem('lekID', 'Lék: ', 'lek')
            ->setSearchOne(true)
            ->setRequired('Field "Lék" is required.')
            ->setButtonLabel("Vybrat Lék");

        $form->addSelectItem('dodavatelID', 'Dodavatel: ', 'dodavatel')
            ->setSearchOne(true)
            ->setRequired('Field "Dodavatel" is required.')
            ->setButtonLabel("Vybrat dodavatele");

        $form->addText('cena', 'Cena:', 38)
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

