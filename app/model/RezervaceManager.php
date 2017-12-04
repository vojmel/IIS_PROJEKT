<?php
/**
 * Model leku
 */

namespace App\Model;


class RezervaceManager extends GeneralManager
{
    protected $tableName = 'rezervace';
    protected $pkColumn = 'rezervaceID';

    public function getLeky($rezervaceID) {
        return $this->database->table('obsahuje')->where('rezervaceID = ?', $rezervaceID);
    }

    public function setVyzvednuto($rezervaceID) {

        $item = $this->getSpecific($rezervaceID);
        if ($item) {
            $item->update([
                'vyzvednuto' => 1
            ]);
        }
    }
}