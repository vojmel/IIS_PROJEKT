<?php
/**
 * Model leku
 */

namespace App\Model;


class PobockaManager extends GeneralManager
{
    protected $tableName = 'pobocka';
    protected $pkColumn = 'pobockaID';

    public function getName($id){
        $item = $this->getSpecific($id);
        if ($item) {
            return $item->nazev;
        }
        return "";
    }
}