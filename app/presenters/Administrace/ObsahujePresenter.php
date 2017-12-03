<?php

namespace App\Presenters;

use App\Model\DoplatekManager;
use App\Model\LekManager;
use App\Model\ObsahujeManager;
use App\Model\PredpisManager;
use Nette;
use Mesour\DataGrid\NetteDbDataSource,
    Mesour\DataGrid\Grid,
    Mesour\DataGrid\Components\Link;
use Mesour\DataGrid\Components\Button;
use Nette\Application\UI\Form;

class ObsahujePresenter extends GeneralPresenter
{

    public $lekManager;
    public $predpisManager;

    public function __construct(ObsahujeManager $predpisnaManager, LekManager $lekManager, PredpisManager $predpisManager)
    {
        parent::__construct();

        $this->modelManager = $predpisnaManager;
        $this->lekManager = $lekManager;
        $this->predpisnaManager = $predpisManager;

        $this->site = 'predpisna';
        $this->nadpisy = array(
            "default"   => 'Predpisu na lék',
            "edit"      => 'Editace Predpisu na lék: ', // + id editovaneho
            "add"       => 'Přidání Predpisu na lék:',
            "select"    => 'Vybrat Predpisu na lék: ',
        );
        $this->messages = array(
            "INSERT_OK" => "Predpisu na lék byl přidán.",
            "INSERT_BAD" => "Predpisu na lék se nepodařilo přidat",
            "UPDATE_OK" => "Predpisu na lék byl upraven.",
            "UPDATE_BAD" => "Predpisu na lék se nepodařilo upravit.",
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
