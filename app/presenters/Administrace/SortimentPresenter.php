<?php

namespace App\Presenters;

use App\Model\SortimentManager;
use Nette;
use Mesour\DataGrid\NetteDbDataSource,
    Mesour\DataGrid\Grid,
    Mesour\DataGrid\Components\Link;
use Mesour\DataGrid\Components\Button;
use Nette\Application\UI\Form;

class SortimentPresenter extends GeneralPresenter
{

    public function __construct(SortimentManager $sortimentManager)
    {
        parent::__construct();

        $this->modelManager = $sortimentManager;

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
        $grid->addNumber('lekID', 'Lék');
        $grid->addNumber('cena', 'Cena');
        $grid->addNumber('dodavatelID', 'Dodavatel');
        $grid->addNumber('sortimentID', 'ID sortimentu');


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
        $form->addText('cena', 'Cena:', 38)
            ->setHtmlType('number')
            ->setRequired(true);

        ///TODO LIST POBOCEK
        ///TODO LIST ZAMESTNANCU KDO PRODEJ USKUTECNIL
        ///TODO automaticky vytvaret datum  prodeje


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
