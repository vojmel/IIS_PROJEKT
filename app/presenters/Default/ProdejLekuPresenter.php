<?php
/**
 * Created by PhpStorm.
 * User: Meluzin
 * Date: 03.12.2017
 * Time: 20:05
 */

namespace App\Presenters;

use Nette;
use Mesour\DataGrid\NetteDbDataSource,
    Mesour\DataGrid\Grid;


class ProdejLekuPresenter extends DefaultPresenter
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
