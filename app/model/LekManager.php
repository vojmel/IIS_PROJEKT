<?php
/**
 * Model leku
 */

namespace App\Model;


class LekManager extends GeneralManager
{
    protected $tableName = 'lek';
    protected $pkColumn = 'lekID';

    public function getName($lekID){
        $lek = $this->getSpecific($lekID);
        if ($lek) {
            return $lek->nazev;
        }
        return "";
    }
}