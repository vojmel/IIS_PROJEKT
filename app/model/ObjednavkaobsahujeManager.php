<?php
/**
 * Created by PhpStorm.
 * User: Meluzin
 * Date: 02.12.2017
 * Time: 23:08
 */

namespace App\Model;


class ObjednavkaobsahujeManager extends GeneralManager
{
    protected $tableName = 'objednavkaobsahuje';
    protected $pkColumn = 'objednavkaobsahujeID';

    public function setNewObsahuje($objednavkaID, $newObsahuje){


        // smazani starych
        $this->database->table('objednavkaobsahuje')
            ->where('objednavkaID = ?', $objednavkaID)
            ->delete();

        // Zpracujeme leky
        $items = explode(',', $newObsahuje);
        $lekArr = array();
        if (count($newObsahuje) > 0) {
            foreach ($items as $item) {
                // rozdeleni na id a pocet   id:pocet
                $parts = explode(':', $item);
                if (count($parts) > 0) {
                    $id = $parts[0];
                    $pocet = 1;
                    if (count($parts) > 1) {
                        $pocet = $parts[1];
                    }
                    $lekArr[] = array($id, $pocet);
                }
            }
        }


        // pridame leky
        foreach ($lekArr as $lek) {

            $lekDb = $this->database->table('lek')->get($lek[0]);

            if ($lekDb) {
                $values['cena']     = $lekDb->cena;
                $values['mnozstvi'] = $lek[1];
                $values['lekID']    = $lekDb->lekID;
                $values['objednavkaID'] = $objednavkaID;

                if ( ! $this->add($values)) {
                    return false;
                }
            }
        }

        return true;
    }
}