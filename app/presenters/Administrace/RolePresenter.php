<?php
/**
 * Created by PhpStorm.
 * User: Meluzin
 * Date: 03.12.2017
 * Time: 17:50
 */

namespace App\Presenters;


use App\Model\RoleManager;
use Nette;
use Mesour\DataGrid\NetteDbDataSource,
    Mesour\DataGrid\Grid,
    Mesour\DataGrid\Components\Link;
use Mesour\DataGrid\Components\Button;
use Nette\Application\UI\Form;

class RolePresenter  extends GeneralAdminPresenter
{

    public function __construct(RoleManager $roleManager)
    {
        parent::__construct();

        $this->modelManager = $roleManager;
        $this->site = 'role';
        $this->nadpisy = array(
            "default"   => 'Správa rolí',
            "edit"      => 'Editace role: ', // + id editovaneho
            "add"       => 'Přidání role:',
            "select"    => 'Vybrat role: ',
        );
        $this->messages = array(
            "INSERT_OK" => "Role byla přidána.",
            "INSERT_BAD" => "Roli se nepodařilo přidat",
            "UPDATE_OK" => "Role byla upravena.",
            "UPDATE_BAD" => "Roli se nepodařilo upravit.",
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
        $grid->addNumber('roleID', 'Id');
        $grid->addText('jmeno', 'Jméno');
        $grid->addText('definice', 'Popis');

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

        $form->addText('jmeno', 'Jméno role:', 50)
            ->setRequired(true);

        $form->addText('definice', 'Definice:', 400)
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
