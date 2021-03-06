<?php
/**
 * Created by PhpStorm.
 * User: Meluzin
 * Date: 03.12.2017
 * Time: 19:14
 */

namespace App\Presenters;

use Nette;
use Mesour\DataGrid\NetteDbDataSource,
    Mesour\DataGrid\Grid;


class AdministracePresenter extends DefaultAdminPresenter
{
    /** @var Nette\Database\Context */
    private $database;

    public function __construct(Nette\Database\Context $database)
    {
        $this->database = $database;
    }

    public function renderDefault()
    {
    }
}
