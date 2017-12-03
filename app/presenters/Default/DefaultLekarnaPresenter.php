<?php
/**
 * Created by PhpStorm.
 * User: Meluzin
 * Date: 02.12.2017
 * Time: 21:31
 */

namespace App\Presenters;

use Nette;
use Mesour\DataGrid\NetteDbDataSource,
    Mesour\DataGrid\Grid;


abstract class DefaultLekarnaPresenter extends DefaultPresenter
{
    public function beforeRender()
    {
        parent::beforeRender(); // nezapomeňte volat metodu předka, stejně jako u startup()

        // Je prihlasen?
        if ( ! $this->getUser()->isLoggedIn()) {
            $this->flashMessage('Pro přístup do této sekce, musíš být přihlášený.', 'warning');
            $this->redirect('Sign:in');
        }
    }
}