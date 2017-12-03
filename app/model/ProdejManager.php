<?php
/**
 * Model leku
 */

namespace App\Model;


class ProdejManager extends GeneralManager
{
    protected $tableName = 'prodej';
    protected $pkColumn = 'prodejID';

    public function getAllFromLekarnik($lekarnikID) {

        return $this->database->table($this->tableName)->where("lekarnikID = ?", $lekarnikID);
    }
}