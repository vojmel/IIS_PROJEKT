<?php

namespace App\Presenters;

use App\Model\PojistovnaManager;
use Nette;
use Mesour\DataGrid\NetteDbDataSource,
    Mesour\DataGrid\Grid,
    Mesour\DataGrid\Components\Link;
use Mesour\DataGrid\Components\Button;
use Nette\Application\UI\Form;

class PojistovnaPresenter extends GeneralPresenter
{

    public function __construct(PojistovnaManager $pojistovnaManager)
    {
        parent::__construct();

        $this->modelManager = $pojistovnaManager;

        $this->site = 'pojistovna';
        $this->nadpisy = array(
            "default"   => 'Pojišťovny',
            "edit"      => 'Editace pojišťovny: ', // + id editovaneho
            "add"       => 'Přidání pojišťovny:',
            "select"    => 'Vybrat pojišťovnu: ',
        );
        $this->messages = array(
            "INSERT_OK" => "Pojišťovna byla přidána.",
            "INSERT_BAD" => "Pojišťovnu se nepodařilo přidat",
            "UPDATE_OK" => "Pojišťovna byla upravena.",
            "UPDATE_BAD" => "Pojišťovnu se nepodařilo upravit.",
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
        $grid->addNumber('pojistovnaID', 'Id');

        $grid->addNumber('cisloPojistovny', 'Číslo pojišťovny');

        $grid->addNumber('ICO', 'IČO')
            ->setThousandsSeparator(false);

        $grid->addText('nazev', 'Název');

        $grid->addText('adresa', 'Adresa');

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
        // Text
        $form->addText('nazev', 'Název:', 100)
            ->setRequired(true);

        $form->addText('adresa', 'Adresa:', 400)
            ->setRequired(true);

        $form->addText('cisloPojistovny', 'Číslo pojištovny:', 11)
            ->setHtmlType('number')
            ->setRequired(true);

        $form->addText('ICO', 'IČO:', 11)
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
