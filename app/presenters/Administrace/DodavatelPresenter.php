<?php
/**
 * Created by PhpStorm.
 * User: Meluzin
 * Date: 02.12.2017
 * Time: 22:43
 */

namespace App\Presenters;

use App\Model\DodavatelManager;
use App\Presenters\GeneralAdminPresenter;
use Mesour\DataGrid\NetteDbDataSource,
    Mesour\DataGrid\Grid,
    Mesour\DataGrid\Components\Link;
use Mesour\DataGrid\Components\Button;
use Nette\Application\UI\Form;

class DodavatelPresenter extends GeneralAdminPresenter
{


    public function __construct(DodavatelManager $dodavatelManager)
    {
        parent::__construct();

        $this->modelManager = $dodavatelManager;

        $this->site = 'dodavatel';
        $this->nadpisy = array(
            "default"   => 'Dodavatelé',
            "edit"      => 'Editace dodavatele: ', // + id editovaneho
            "add"       => 'Přidání dodavatele:',
            "select"    => 'Vybrat dodavatele: ',
        );
        $this->messages = array(
            "INSERT_OK" => "Dodavatel byl přidán.",
            "INSERT_BAD" => "Dodavatel se nepodařilo přidat",
            "UPDATE_OK" => "Dodavatel byl upraven.",
            "UPDATE_BAD" => "Dodavatel se nepodařilo upravit.",
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


        $grid->addNumber('ICO', 'IČO')
            ->setThousandsSeparator(false);

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

        // Cislo
        $form->addText('ICO', 'IČO:', 11)
            ->setHtmlType('number')
            ->setRequired(true);


        // dlouhe cislo
        $form->addText('adresa', 'Adresa')
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
