<?php
/**
 * Model leku
 */

namespace App\Model;


class PojistovnaManager extends GeneralManager
{
    protected $tableName = 'pojistovna';
    protected $pkColumn = 'pojistovnaID';

    public function getName($id){
        $item = $this->getSpecific($id);
        if ($item) {
            return $item->nazev;
        }
        return "";
    }
}