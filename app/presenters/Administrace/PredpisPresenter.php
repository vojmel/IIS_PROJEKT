<?php

namespace App\Presenters;

use App\Model\PredpisManager;
use App\Model\PojistovnaManager;
use Nette;
use Mesour\DataGrid\NetteDbDataSource,
    Mesour\DataGrid\Grid,
    Mesour\DataGrid\Components\Link;
use Mesour\DataGrid\Components\Button;
use Nette\Application\UI\Form;

class PredpisPresenter extends GeneralPresenter
{
    public $pojistovnaManager;

    public function __construct(PredpisManager $predpisManager, PojistovnaManager $pojistovnaManager)
    {
        parent::__construct();

        $this->modelManager = $predpisManager;
        $this->pojistovnaManager = $pojistovnaManager;

        $this->site = 'predpis';
        $this->nadpisy = array(
            "default"   => 'Předpisy léků',
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

//        $grid->addNumber('pojistovnaID', 'ID Číslo pojišťovny')
//            ->setThousandsSeparator(false);

        $grid->addTemplate('cisloPojistovny', 'Číslo pojišťovny')
            ->setCallbackArguments(array($this))
            ->setTemplate(__DIR__ . '/templates/Column/_itemName.latte') // or instanceof UI\ITemplate
            ->setCallback(function($data, Nette\Application\UI\ITemplate $template, $presenter) {
                $template->id = $data['pojistovnaID'];
                $template->nazev = $presenter->pojistovnaManager->getNumber($data['pojistovnaID']);
            });

        $grid->addTemplate('pojistovnaID', 'Pojišťovna nazev')
            ->setCallbackArguments(array($this))
            ->setTemplate(__DIR__ . '/templates/Column/_itemName.latte') // or instanceof UI\ITemplate
            ->setCallback(function($data, Nette\Application\UI\ITemplate $template, $presenter) {
                $template->id = $data['pojistovnaID'];
                $template->nazev = $presenter->pojistovnaManager->getName($data['pojistovnaID']);
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
        $form->addText('cisloPredpisu', 'Číslo předpisu: ', 11)
            ->setHtmlType('number')
            ->setRequired(true);

        // Text
        $form->addText('jmenoZakaznika', 'Jméno zákazníka: ', 100)
            ->setRequired(true);

        $form->addText('prijmeniZakaznika', 'Příjmení zákazníka: ', 100)
            ->setRequired(true);

        $form->addText('rodneCisloZakaznika', 'Rodné Číslo zákazníka:', 20)
            ->setHtmlType('number')
            ->setRequired(true);

//        $form->addText('prodejID', 'Číslo prodeje: ', 11)
//            ->setHtmlType('number')
//            ->setRequired(true);

        $form->addSelectItem('prodejID', 'Prodej: ', 'prodej')
            ->setSearchOne(true)
            ->setRequired('Field "Prodej" is required.')
            ->setButtonLabel("Vybrat prodej");


        $form->addSelectItem('pojistovnaID', 'Pojišťovna: ', 'pojistovna')
            ->setSearchOne(true)
            ->setRequired('Field "Pojišťovna" is required.')
            ->setButtonLabel("Vybrat pojišťovnu");


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
