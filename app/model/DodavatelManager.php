<?php
/**
 * Created by PhpStorm.
 * User: Meluzin
 * Date: 02.12.2017
 * Time: 22:41
 */

namespace App\Model;


class DodavatelManager extends GeneralManager
{
    protected $tableName = 'dodavatel';
    protected $pkColumn = 'dodavatelID';

    public function getName($id){
        $item = $this->getSpecific($id);
        if ($item) {
            return $item->nazev;
        }
        return "";
    }
}