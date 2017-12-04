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

    public function getLeky($objednavkaID) {
        return $this->database->table('objednavkaobsahuje')->where('objednavkaID = ?', $objednavkaID);
    }

    public function getPolozky($objednavkaID) {
        $objednavka = $this->getSpecific($objednavkaID);
        if ($objednavka) {
            $ret = array();

            // get polozky
            $polozky = $this->getLeky($objednavkaID);
            foreach ($polozky as $polozka) {
                $ret[] = $polozka->lekID.":".$polozka->mnozstvi;
            }

            return join(',', $ret);

        }
        return "";
    }
}