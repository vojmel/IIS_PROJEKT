<?php

namespace App\Presenters;

use App\Model\RezervaceManager;
use App\Model\PobockaManager;
use App\Model\LekarnikManager;
use Nette;
use Mesour\DataGrid\NetteDbDataSource,
    Mesour\DataGrid\Grid,
    Mesour\DataGrid\Components\Link;
use Mesour\DataGrid\Components\Button;
use Nette\Application\UI\Form;

class RezervacePresenter extends GeneralPresenter
{
    public $pobockaManager;
    public $lekarnikManager;

    public function __construct(RezervaceManager $rezervaceManager, PobockaManager $pobockaManager, LekarnikManager $lekarnikManager)
    {
        parent::__construct();

        $this->modelManager = $rezervaceManager;
        $this->pobockaManager = $pobockaManager;
        $this->lekarnikManager = $lekarnikManager;

        $this->site = 'rezervace';
        $this->nadpisy = array(
            "default"   => 'Rezervace léků',
            "edit"      => 'Editace rezervace: ', // + id editovaneho
            "add"       => 'Přidání rezervace:',
            "select"    => 'Vybrat rezervaci: ',
        );
        $this->messages = array(
            "INSERT_OK" => "Rezervace byla přidána.",
            "INSERT_BAD" => "Rezervaci se nepodařilo přidat",
            "UPDATE_OK" => "Rezervace byla upravena.",
            "UPDATE_BAD" => "Rezervaci se nepodařilo upravit.",
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
        $grid->addNumber('rezervaceID', 'Id');

        $grid->addText('jmenoZakaznika', 'Jméno zakaznika');

        $grid->addDate('datumExpirace', 'Datum expirace')
            ->setFormat('j.n.Y H:i:s');

        $grid->addTemplate('vyzvednuto', 'Vyzvednuto')
            ->setCallbackArguments(array($this))
            ->setTemplate(__DIR__ . '/templates/Column/_bool.latte') // or instanceof UI\ITemplate
            ->setCallback(function($data, Nette\Application\UI\ITemplate $template, $presenter) {
                $template->state = $data['vyzvednuto'];
            });

        $grid->addNumber('pobockaID', 'Pobočka');

        $grid->addTemplate('pobockaID', 'Pobočka')
            ->setCallbackArguments(array($this))
            ->setTemplate(__DIR__ . '/templates/Column/_itemName.latte') // or instanceof UI\ITemplate
            ->setCallback(function($data, Nette\Application\UI\ITemplate $template, $presenter) {
                $template->id = $data['pobockaID'];
                $template->nazev = $presenter->pobockaManager->getName($data['pobockaID']);
            });

        $grid->addNumber('lekarnikID', 'Lekarník');

        $grid->addTemplate('lekarnikID', 'Lékárník')
            ->setCallbackArguments(array($this))
            ->setTemplate(__DIR__ . '/templates/Column/_itemName.latte') // or instanceof UI\ITemplate
            ->setCallback(function($data, Nette\Application\UI\ITemplate $template, $presenter) {
                $template->id = $data['lekarnikID'];
                $template->nazev = $presenter->lekarnikManager->getName($data['lekarnikID']);
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
        $form->addText('jmenoZakaznika', 'Jméno zákazníka', 200)
            ->setRequired(true);

        // Datum
        $form->addText("datumExpirace", "Datum expirace: ")
            ->setAttribute("placeholder", "dd.mm.rrrr")
            ->setRequired(false)
            ->addRule($form::PATTERN, "Datum musí být ve formátu dd.mm.rrrr", "(0[1-9]|[12][0-9]|3[01])\.(0[1-9]|1[012])\.(19|20)\d\d");

        $form->addSelectItem('lekarnikID', 'Lékárník: ', 'lekarnik')
            ->setSearchOne(true)
            ->setRequired('Field "Lékárník" is required.')
            ->setButtonLabel("Vybrat Lékárníka");

        $form->addSelectItem('pobockaID', 'Pobočka: ', 'pobocka')
            ->setSearchOne(true)
            ->setRequired('Field "Pobočka" is required.')
            ->setButtonLabel("Vybrat pobočku");

        // Check box
        $form->addCheckbox('vyzvednuto', 'Vyzvednuto: ');

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
