<?php

namespace App\Presenters;

use App\Model\LekarnikManager;
use Nette;
use Mesour\DataGrid\NetteDbDataSource,
    Mesour\DataGrid\Grid,
    Mesour\DataGrid\Components\Link;
use Mesour\DataGrid\Components\Button;
use Nette\Application\UI\Form;

class LekarnikPresenter extends GeneralPresenter
{

    public function __construct(LekarnikManager $lekManager)
    {
        $this->modelManager = $lekManager;

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


        ///TODO stav pracovniho pomeru prepis

        $grid->addTemplate('stavPracovnbihoPomeru', 'Zaměstnán')
            ->setTemplate(__DIR__ . '/templates/Column/_bool.latte') // or instanceof UI\ITemplate
            ->setCallback(function($data, Nette\Application\UI\ITemplate $template) {
                $template->state = $data['stavPracovnbihoPomeru'];
            });


        $grid->addTemplate('pobockaID', 'Pobočka')
            ->setTemplate(__DIR__ . '/templates/Column/_pobockaName.latte') // or instanceof UI\ITemplate
            ->setCallback(function($data, Nette\Application\UI\ITemplate $template) {
                $template->pobockaID = $data['pobockaID'];
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

        $form->addText('pobockaID', 'ID pobočky:', 11)
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
