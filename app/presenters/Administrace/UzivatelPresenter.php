<?php
/**
 * Created by PhpStorm.
 * User: Meluzin
 * Date: 03.12.2017
 * Time: 17:50
 */

namespace App\Presenters;


use App\Model\LekarnikManager;
use App\Model\RoleManager;
use App\Model\UzivatelManager;
use App\Model\DoplatekManager;
use App\Model\LekManager;
use App\Model\PojistovnaManager;
use Nette;
use Mesour\DataGrid\NetteDbDataSource,
    Mesour\DataGrid\Grid,
    Mesour\DataGrid\Components\Link;
use Mesour\DataGrid\Components\Button;
use Nette\Application\UI\Form;

class UzivatelPresenter  extends GeneralPresenter
{

    public $roleManager;
    public $lekarnikManager;
    public $uzivatelManager;

    public function __construct(UzivatelManager $manager, RoleManager $roleManager, LekarnikManager $lekarnikManager, UzivatelManager $uzivatelManager)
    {
        parent::__construct();

        $this->modelManager = $manager;
        $this->roleManager = $roleManager;
        $this->lekarnikManager = $lekarnikManager;
        $this->uzivatelManager = $uzivatelManager;

        $this->site = 'uzivatel';
        $this->nadpisy = array(
            "default"   => 'Správa uživatelů',
            "edit"      => 'Editace uživatele: ', // + id editovaneho
            "add"       => 'Přidání uživatele:',
            "select"    => 'Vybrat uživatele: ',
        );
        $this->messages = array(
            "INSERT_OK" => "Uživatel byl přidán.",
            "INSERT_BAD" => "Uživatele se nepodařilo přidat",
            "UPDATE_OK" => "Uživatel byl upraven.",
            "UPDATE_BAD" => "Uživatele se nepodařilo upravit.",
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
        $grid->addNumber('uzivatelID', 'Id');

        $grid->addText('username', 'Login');


        $grid->addNumber('roleID', 'Role Id');

        $grid->addTemplate('roleID', 'Role nazev')
            ->setCallbackArguments(array($this))
            ->setTemplate(__DIR__ . '/templates/Column/_itemName.latte') // or instanceof UI\ITemplate
            ->setCallback(function($data, Nette\Application\UI\ITemplate $template, $presenter) {
                $template->id = $data['uzivatelID'];
                $template->nazev = $presenter->roleManager->getName($data['uzivatelID']);
            });


        $grid->addNumber('lekarnikID', 'Lekarnik Id');

        $grid->addTemplate('lekarnikID', 'Lekarnik nazev')
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

        $form->addText('username', 'Uživatelské jméno:', 50)
            ->setRequired(true);

        $form->addPassword('password', 'Heslo: *', 20)
            ->setOption('description', 'Alespoň 6 znaků')
            ->addRule(Form::FILLED, 'Vyplňte Vaše heslo')
            ->addRule(Form::MIN_LENGTH, 'Heslo musí mít alespoň %d znaků.', 6);

        $form->addPassword('password2', 'Heslo znovu: *', 20)
            ->addConditionOn($form['password'], Form::VALID)
            ->addRule(Form::FILLED, 'Heslo znovu')
            ->addRule(Form::EQUAL, 'Hesla se neshodují.', $form['password']);

        $form->addSelectItem('roleID', 'Role: ', 'role')
            ->setSearchOne(true)
            ->setRequired('Field "Role" is required.')
            ->setButtonLabel("Vybrat roli");


        $form->addSelectItem('lekarnikID', 'Lékárník: ', 'lekarnik')
            ->setSearchOne(true)
            ->setRequired('Field "Lékárník" is required.')
            ->setButtonLabel("Vybrat lékárníka");


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
        $values['password'] = '';
        $values['password2'] = '';
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
        $data['password'] = $this->uzivatelManager->generatePassword($data['password']);
        unset($data['password2']);
        return $data;
    }
}
