<?php
/**
 * Created by PhpStorm.
 * User: Meluzin
 * Date: 02.12.2017
 * Time: 21:43
 */

namespace App\Presenters;

use App\Model\LekManager;
use Nette;
use Mesour\DataGrid\NetteDbDataSource,
    Mesour\DataGrid\Grid;
use Mesour\DataGrid\Components\Button,
    Mesour\DataGrid\Components\Link;


abstract class DefaultAdminPresenter extends Nette\Application\UI\Presenter
{

    public function beforeRender()
    {
        // Je prihlasen?
        if ( ! $this->getUser()->isLoggedIn()) {
            $this->flashMessage('Pro přístup do této sekce, musíš být přihlášený.', 'warning');
            $this->redirect('Sign:in');
        }

        // Je to admin?
        if ($this->getUser()->getIdentity()->roleID != 1) {
            $this->flashMessage('Pro přístup do této sekce, musíš být administrator..', 'warning');
            $this->redirect('Sign:in');
        }

        parent::beforeRender(); // nezapomeňte volat metodu předka, stejně jako u startup()
        $this->template->menuItems = array(
            'Léky' => 'Lek:',
            'Dodavatelé' => 'Dodavatel:',
            'Lékárníci' => 'Lekarnik:',
            'Pobočky' => 'Pobocka:',
            'Pojišťovny' => 'Pojistovna:',
            'Prodeje' => 'Prodej:',
            'Sortiment' => 'Sortiment:',
            'Rezervace' => 'Rezervace:',
            'Předpisy' => 'Predpis:',
            'Doplatek na lek' => 'Doplatek:',
            'Uskladnění' => 'Uskladnen:',
            'Správa uživatelů' => 'Uzivatel:',
            'Správa rolí' => 'Role:',
            'Seznamy položek' => 'Seznampolozek:',
            'Předpis na' => 'Predpisna:',
            'Objednávka' => 'Objednavka:',
            'Obsah Objednavky' => 'Objednavkaobsahuje:',
            'Obsahuje' => 'Obsahuje:',
        );


        // add button
        $button = new Button();
        $button->setPresenter($this);
        $button->setPresenter($this)
            ->setType('btn-default')
            ->setTitle('Odhlasid')
            ->setAttribute('href', new Link('Sign:out'));

        $this->template->logout = $button;

        $this->template->user = $this->getUser();
    }
}