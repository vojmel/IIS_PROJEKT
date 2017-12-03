<?php
/**
 * Created by PhpStorm.
 * User: Meluzin
 * Date: 02.12.2017
 * Time: 23:08
 */

namespace App\Model;


class ObjednavkaManager extends GeneralManager
{
    protected $tableName = 'objednavka';
    protected $pkColumn = 'objednavkaID';
}