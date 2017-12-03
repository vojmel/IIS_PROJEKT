<?php

namespace App\Presenters;

use App\Model\ProdejManager;
use Nette;
use Mesour\DataGrid\NetteDbDataSource,
    Mesour\DataGrid\Grid,
    Mesour\DataGrid\Components\Link;
use Mesour\DataGrid\Components\Button;
use Nette\Application\UI\Form;

class ProdejPresenter extends GeneralPresenter
{

    public function __construct(ProdejManager $prodejManager)
    {
        parent::__construct();

        $this->modelManager = $prodejManager;

        $this->site = 'prodej';
        $this->nadpisy = array(
            "default"   => 'Prodeje',
            "edit"      => 'Editace prodeje: ', // + id editovaneho
            "add"       => 'Přidání prodeje:',
            "select"    => 'Vybrat prodej: ',
        );
        $this->messages = array(
            "INSERT_OK" => "Prodej byl přidán.",
            "INSERT_BAD" => "Prodej se nepodařilo přidat",
            "UPDATE_OK" => "Prodej byl upraven.",
            "UPDATE_BAD" => "Prodej se nepodařilo upravit.",
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
        $grid->addNumber('prodejID', 'Id');

        $grid->addDate('datum', 'Datum prodeje')
            ->setFormat('j.n.Y H:i:s');

        $grid->addNumber('pobockaID', 'Pobočka');
        $grid->addNumber('lekarnikID', 'Uskutečnil');


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
        // Datum
        $form->addText("datumExpirace", "Datum expirace: ")
            ->setAttribute("placeholder", "dd.mm.rrrr")
            ->setRequired(true)
            ->addRule($form::PATTERN, "Datum musí být ve formátu dd.mm.rrrr", "(0[1-9]|[12][0-9]|3[01])\.(0[1-9]|1[012])\.(19|20)\d\d");

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
        $values['datumExpirace'] = date('d.m.Y', $values['datumExpirace']->getTimestamp());

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
        // oprava datumu pro zapis do db
        $data["datumExpirace"] = Nette\DateTime::from($data["datumExpirace"]);
        return $data;
    }
}
