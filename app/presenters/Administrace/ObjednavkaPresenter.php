<?php

namespace App\Presenters;

use App\Model\ObjednavkaManager;
use Nette;
use Mesour\DataGrid\NetteDbDataSource,
    Mesour\DataGrid\Grid,
    Mesour\DataGrid\Components\Link;
use Mesour\DataGrid\Components\Button;
use Nette\Application\UI\Form;

class ObjednavkaPresenter extends GeneralPresenter
{

    public function __construct(ObjednavkaManager $objednavkaManager)
    {
        $this->modelManager = $objednavkaManager;

        $this->site = 'objednavka';
        $this->nadpisy = array(
            "default"   => 'Objednávka',
            "edit"      => 'Editace objednávky: ', // + id editovaneho
            "add"       => 'Přidání objednávky:',
            "select"    => 'Vybrat objednávku: ',
        );
        $this->messages = array(
            "INSERT_OK" => "Objednávka byla přidána.",
            "INSERT_BAD" => "Objednávku se nepodařilo přidat",
            "UPDATE_OK" => "Objednávka byla upravena.",
            "UPDATE_BAD" => "Objednávku se nepodařilo upravit.",
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
//        $grid->addNumber('objednavkaID', 'Id');
//
//        $grid->addText('jmenoZakaznika', 'jmenoZakaznika');
//
//        $grid->addDate('datumObjednani', 'Datum objednání')
//
//
//        $grid->addDate('datumDoruceni', 'Datum doručení')
//            ->setFormat('j.n.Y H:i:s');
//
//        $grid->addTemplate('vyzvednuto', 'Vyzvednuto')
//            ->setTemplate(__DIR__ . '/templates/Column/_bool.latte') // or instanceof UI\ITemplate
//            ->setCallback(function($data, Nette\Application\UI\ITemplate $template) {
//                $template->state = $data['vyzvednuto'];
//            });
//
//        ///TODO FIX MEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEE
//        $grid->addNumber('pobockaID', 'Pobočka');
//        $grid->addNumber('lekarnikID', 'Lekarník');




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

        // dlouhe cislo
        $form->addText('pobockaID', 'Pobočka')
            ->setHtmlType('number')
            ->setRequired(true);

        // dlouhe cislo
        $form->addText('lekarnikID', 'Lékárník')
            ->setHtmlType('number')
            ->setRequired(true);

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
