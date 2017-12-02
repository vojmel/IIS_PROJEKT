<?php
/**
 * Created by PhpStorm.
 * User: Meluzin
 * Date: 02.12.2017
 * Time: 22:43
 */

namespace App\Presenters;

use App\Model\DodavatelManager;
use App\Presenters\GeneralPresenter;
use Mesour\DataGrid\NetteDbDataSource,
    Mesour\DataGrid\Grid,
    Mesour\DataGrid\Components\Link;
use Mesour\DataGrid\Components\Button;
use Nette\Application\UI\Form;

class DodavatelPresenter extends GeneralPresenter
{


    public function __construct(DodavatelManager $dodavatelManager)
    {
        $this->modelManager = $dodavatelManager;

        $this->site = 'dodavatel';
        $this->nadpisy = array(
            "default"   => 'Dodavatelé',
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
     * http://grid.mesour.com/version2/
     *
     * @param Grid $grid
     * @return Grid
     */
    protected function defineColumnsForDatagrid($grid)
    {
        $grid->addNumber('dodavatelID', 'Id');

        $grid->addText('nazev', 'Název');

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
