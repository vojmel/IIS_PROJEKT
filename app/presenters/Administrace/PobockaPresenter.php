<?php

namespace App\Presenters;

use App\Model\PobockaManager;
use Nette;
use Mesour\DataGrid\NetteDbDataSource,
    Mesour\DataGrid\Grid,
    Mesour\DataGrid\Components\Link;
use Mesour\DataGrid\Components\Button;
use Nette\Application\UI\Form;

class PobockaPresenter extends GeneralPresenter
{

    public function __construct(PobockaManager $pobockaManager)
    {
        $this->modelManager = $pobockaManager;

        $this->site = 'lek';
        $this->nadpisy = array(
            "default"   => 'Pobočky',
            "edit"      => 'Editace pobočky: ', // + id editovaneho
            "add"       => 'Přidání pobočky:',
            "select"    => 'Vybrat pobočku: ',
        );
        $this->messages = array(
            "INSERT_OK" => "Pobočka byla přidána.",
            "INSERT_BAD" => "Pobočku se nepodařilo přidat",
            "UPDATE_OK" => "Pobočka byla upravena.",
            "UPDATE_BAD" => "Pobočku se nepodařilo upravit.",
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
        $grid->addNumber('pobockaID', 'Id');

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
