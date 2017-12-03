<?php

namespace App\Presenters;

use App\Model\LekarnikManager;
use App\Model\PobockaManager;
use Nette;
use Mesour\DataGrid\NetteDbDataSource,
    Mesour\DataGrid\Grid,
    Mesour\DataGrid\Components\Link;
use Mesour\DataGrid\Components\Button;
use Nette\Application\UI\Form;

class LekarnikPresenter extends GeneralPresenter
{
    public $pobockaManager;

    public function __construct(LekarnikManager $predpisManager, PobockaManager $pobockaManager)
    {
        parent::__construct();

        $this->modelManager = $predpisManager;
        $this->pobockaManager = $pobockaManager;

        $this->site = 'lekarnik';
        $this->nadpisy = array(
            "default"   => 'Lékárníci',
            "edit"      => 'Editace lékárníka: ', // + id editovaneho
            "add"       => 'Přidání lékárníka:',
            "select"    => 'Vybrat lékárníka: ',
        );
        $this->messages = array(
            "INSERT_OK" => "Lékárník byl přidán.",
            "INSERT_BAD" => "Lékárníka se nepodařilo přidat",
            "UPDATE_OK" => "Lékárník byl upraven.",
            "UPDATE_BAD" => "Lékárníka se nepodařilo upravit.",
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
        $grid->addNumber('lekarnikID', 'Id');

        $grid->addText('jmeno', 'Jméno');

        $grid->addText('prijmeni', 'Příjmení');

        $grid->addText('adresa', 'Adresa');

        $grid->addDate('datumNarozeni', 'Datum narození')
            ->setFormat('j.n.Y');

        $grid->addNumber('rodneCislo', 'Rodné číslo')
            ->setThousandsSeparator(false);

        $grid->addTemplate('stavPracovnbihoPomeru', 'Zaměstnán')
            ->setCallbackArguments(array($this))
            ->setTemplate(__DIR__ . '/templates/Column/_bool.latte') // or instanceof UI\ITemplate
            ->setCallback(function($data, Nette\Application\UI\ITemplate $template, $presenter) {
                $template->state = $data['stavPracovnbihoPomeru'];
            });

        $grid->addNumber('pobockaID', 'Pobočka id')
            ->setThousandsSeparator(false);


        $grid->addTemplate('pobockaID', 'Pobočka nazev')
            ->setCallbackArguments(array($this))
            ->setTemplate(__DIR__ . '/templates/Column/_itemName.latte') // or instanceof UI\ITemplate
            ->setCallback(function($data, Nette\Application\UI\ITemplate $template, $presenter) {
                $template->id = $data['pobockaID'];
                $template->nazev = $presenter->pobockaManager->getName($data['pobockaID']);
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
        $form->addText('jmeno', 'Jméno:', 100)
            ->setRequired(true);

        $form->addText('prijmeni', 'Příjmení:', 100)
            ->setRequired(true);

        $form->addText('adresa', 'Adresa:', 400)
            ->setRequired(true);

        $form->addText("datumNarozeni", "Datum narození: ")
            ->setAttribute("placeholder", "dd.mm.rrrr")
            ->setRequired(true)
            ->addRule($form::PATTERN, "Datum musí být ve formátu dd.mm.rrrr", "(0[1-9]|[12][0-9]|3[01])\.(0[1-9]|1[012])\.(19|20)\d\d");


        $form->addText('rodneCislo', 'Rodné Číslo:', 20)
            ->setHtmlType('number')
            ->setRequired(true);

        // Check box
        $form->addCheckbox('stavPracovnbihoPomeru', 'Zaměstnán: ');

        $form->addSelectItem('pobockaID', 'Pobočka: ', 'pobocka')
            ->setSearchOne(true)
            ->setRequired('Field "Pobočka" is required.')
            ->setButtonLabel("Vybrat pobočku");



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
        $values['datumNarozeni'] = date('d.m.Y', $values['datumNarozeni']->getTimestamp());
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
        $data["datumNarozeni"] = Nette\DateTime::from($data["datumNarozeni"]);
        return $data;
    }
}
