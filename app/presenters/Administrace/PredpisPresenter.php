<?php

namespace App\Presenters;

use App\Model\PredpisManager;
use Nette;
use Mesour\DataGrid\NetteDbDataSource,
    Mesour\DataGrid\Grid,
    Mesour\DataGrid\Components\Link;
use Mesour\DataGrid\Components\Button;
use Nette\Application\UI\Form;

class PredpisPresenter extends GeneralPresenter
{

    public function __construct(PredpisManager $predpisManager)
    {
        parent::__construct();

        $this->modelManager = $predpisManager;

        $this->site = 'predpis';
        $this->nadpisy = array(
            "default"   => 'Předpisy',
            "edit"      => 'Editace předpisu: ', // + id editovaneho
            "add"       => 'Přidání předpisu:',
            "select"    => 'Vybrat předpis: ',
        );
        $this->messages = array(
            "INSERT_OK" => "Předpis byl přidán.",
            "INSERT_BAD" => "Předpis se nepodařilo přidat",
            "UPDATE_OK" => "Předpis byl upraven.",
            "UPDATE_BAD" => "Předpis se nepodařilo upravit.",
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
        $grid->addNumber('predpisID', 'Id');

        $grid->addNumber('cisloPredpisu', 'Číslo předpisu')
            ->setThousandsSeparator(false);

        $grid->addText('jmenoZakaznika', 'Jméno zákazníka');

        $grid->addText('prijmeniZakaznika', 'Příjmení zákazníka');

        $grid->addNumber('rodneCisloZakaznika', 'Rodné číslo zákazníka')
            ->setThousandsSeparator(false);

        $grid->addNumber('prodejID', 'Číslo prodeje')
            ->setThousandsSeparator(false);

        $grid->addNumber('pojistovnaID', 'Číslo pojišťovny')
            ->setThousandsSeparator(false);


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
        $form->addText('cisloPredpisu', 'Číslo předpisu: ', 11)
            ->setHtmlType('number')
            ->setRequired(true);

        // Text
        $form->addText('jmenoZakaznika', 'Jméno zákazníka: ', 100)
            ->setRequired(true);

        $form->addText('prijmeniZakaznika', 'Příjmení zákazníka: ', 100)
            ->setRequired(true);

        $form->addText('rodneCislo', 'Rodné Číslo zákazníka:', 20)
            ->setHtmlType('number')
            ->setRequired(true);

        ///TODO PRIDAT ABY BYL VYBER ZE SEZNAMU

        $form->addText('prodejID', 'Číslo prodeje: ', 11)
            ->setHtmlType('number')
            ->setRequired(true);

        $form->addText('pojistovnaID', 'Číslo pojistovny: ', 11)
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
