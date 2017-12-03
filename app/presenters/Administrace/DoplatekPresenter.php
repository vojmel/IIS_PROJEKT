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

    private $lekManager;
    private $pojistovnaManager;

    public function __construct(DoplatekManager $doplatekManager, LekManager $lekManager, PojistovnaManager $pojistovnaManager)
    {

        $this->modelManager = $doplatekManager;
        $this->lekManager = $lekManager;
        $this->pojistovnaManager = $pojistovnaManager;

        $this->site = 'doplatek';
        $this->nadpisy = array(
            "default"   => 'Doplatek',
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

        // Nastaveni sablon
        $this->templateForEdit = $this->templateForAdd = __DIR__ . '/templates/Doplatek/add&edit.latte';
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

        $grid->addTemplate('pojistovnaID', 'Pojišťovna')
            ->setTemplate(__DIR__ . '/templates/Column/_pojistovnaName.latte') // or instanceof UI\ITemplate
            ->setCallback(function($data, Nette\Application\UI\ITemplate $template) {
                $template->pojistovnaID = $data['pojistovnaID'];
                $template->nazev = $this->pojistovnaManager->getName($data['pojistovnaID']);
            });

        $grid->addTemplate('lekID', 'Lék')
            ->setTemplate(__DIR__ . '/templates/Column/_lekName.latte') // or instanceof UI\ITemplate
            ->setCallback(function($data, Nette\Application\UI\ITemplate $template) {
                $template->lekID = $data['lekID'];
                $template->nazev = $this->lekManager->getName($data['lekID']);
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


        $form->addSelectItem('pojistovnaID', 'Pojišťovna: ', 'pojistovna', true);


        $form->addText('lekID', 'Lék id:', 38)
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
