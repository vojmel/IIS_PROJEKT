<?php
/**
 * Created by PhpStorm.
 * User: Meluzin
 * Date: 02.12.2017
 * Time: 23:08
 */

namespace App\Model;


class RoleManager extends GeneralManager
{
    protected $tableName = 'role';
    protected $pkColumn = 'roleID';

    public function getName($id){
        $item = $this->getSpecific($id);
        if ($item) {
            return $item->jmeno;
        }
        return "";
    }
}