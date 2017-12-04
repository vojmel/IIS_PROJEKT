<?php
/**
 * Model leku
 */

namespace App\Model;


class LekarnikManager extends GeneralManager
{
    protected $tableName = 'lekarnik';
    protected $pkColumn = 'lekarnikID';

    public function getName($id){
        $item = $this->getSpecific($id);
        if ($item) {
            return $item->jmeno." ".$item->prijmeni;
        }
        return "";
    }

    public function getPobockaID($id){
        $item = $this->getSpecific($id);
        if ($item) {
            return $item->pobockaID;
        }
        return "";
    }
}