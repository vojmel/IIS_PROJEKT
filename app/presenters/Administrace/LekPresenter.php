<?php

namespace App\Presenters;

use App\Model\LekManager;
use Nette;
use Mesour\DataGrid\NetteDbDataSource,
    Mesour\DataGrid\Grid,
    Mesour\DataGrid\Components\Link;
use Mesour\DataGrid\Components\Button;
use Nette\Application\UI\Form;

class LekPresenter extends GeneralAdminPresenter
{

    public function __construct(LekManager $lekManager)
    {
        parent::__construct();

        $this->modelManager = $lekManager;

        $this->site = 'lek';
        $this->nadpisy = array(
            "default"   => 'Léky',
            "edit"      => 'Editace léku: ', // + id editovaneho
            "add"       => 'Přidání léku:',
            "select"    => 'Vybrat leky: ',
        );
        $this->messages = array(
            "INSERT_OK" => "Lek byl přidán.",
            "INSERT_BAD" => "Lek se nepodařilo přidat",
            "UPDATE_OK" => "Lek byl upraven.",
            "UPDATE_BAD" => "Lek se nepodařilo upravit.",
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
        $grid->addNumber('lekID', 'Id');

        $grid->addText('nazev', 'Název');

        $grid->addDate('datumExpirace', 'Datum expirace')
            ->setFormat('j.n.Y H:i:s');

        $grid->addNumber('cena', 'Cena')
            ->setDecimals(2)
            ->setDecimalPoint(',')
            ->setThousandsSeparator(' ');

        $grid->addNumber('carovyKod', 'Čárový kód')
            ->setThousandsSeparator(' ');


        $grid->addTemplate('napredpis', 'Na předpis')
            ->setCallbackArguments(array($this))
            ->setTemplate(__DIR__ . '/templates/Column/_bool.latte') // or instanceof UI\ITemplate
            ->setCallback(function($data, Nette\Application\UI\ITemplate $template, $presenter) {
                $template->state = $data['napredpis'];
            });

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

        // Cislo
        $form->addText('cena', 'Cena:', 38)
            ->setHtmlType('number')
            ->setRequired(true);

        // Check box
        $form->addCheckbox('napredpis', 'Na předpis: ');

        // Datum
        $form->addText("datumExpirace", "Datum expirace: ")
            ->setAttribute("placeholder", "dd.mm.rrrr")
            ->setRequired(false)
            ->addRule($form::PATTERN, "Datum musí být ve formátu dd.mm.rrrr", "(0[1-9]|[12][0-9]|3[01])\.(0[1-9]|1[012])\.(19|20)\d\d");

        // dlouhe cislo
        $form->addText('carovyKod', 'Čárový kód')
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
