<?php
/**
 * Created by PhpStorm.
 * User: Meluzin
 * Date: 02.12.2017
 * Time: 21:43
 */

namespace App\Presenters;

use Nette;
use Mesour\DataGrid\NetteDbDataSource,
    Mesour\DataGrid\Grid;


abstract class DefaultAdminPresenter extends Nette\Application\UI\Presenter
{
    public function beforeRender()
    {
        parent::beforeRender(); // nezapomeňte volat metodu předka, stejně jako u startup()
        $this->template->menuItems = array(
            'Domů' => 'Homepage:',
            'Léky' => 'Lek:',
            'Dodavatelé' => 'Dodavatel:',
            'Lékárníci' => 'Lekarnik:',
            'Pobočky' => 'Pobocka:',
            'Pojišťovna' => 'Pojistovna:',
        );
    }
}