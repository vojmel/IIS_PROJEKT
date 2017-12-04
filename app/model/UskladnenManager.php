<?php
/**
 * Model leku
 */

namespace App\Model;
use Exception;
use Nette;


class UskladnenManager extends GeneralManager
{
    protected $tableName = 'uskladnen';
    protected $pkColumn = 'uskladnenID';


    public static function removeFromSklad(Nette\Database\Context  $db, $lekID, $pobockaID, $pocet) {

        $uskladneni = $db->table('uskladnen')
            ->where("lekID = ?", $lekID)
            ->where("pobockaID = ?", $pobockaID);

        foreach ($uskladneni as $jedenLekNaSklade) {
            if ($jedenLekNaSklade) {
                $mnozstvi = $jedenLekNaSklade->mnozstvi - $pocet;
                return $jedenLekNaSklade->update(array('mnozstvi' => $mnozstvi));
            }
        }

        return null;
    }

    public static function addToSklad(Nette\Database\Context  $db, $lekID, $pobockaID, $pocet) {

        $uskladneni = $db->table('uskladnen')
            ->where("lekID = ?", $lekID)
            ->where("pobockaID = ?", $pobockaID);

        //echo 'USkladneni add: '.$lekID. "  pobocka:".$pobockaID;

        foreach ($uskladneni as $jedenLekNaSklade) {
            if ($jedenLekNaSklade) {

                $mnozstvi = $jedenLekNaSklade->mnozstvi + $pocet;
                return $jedenLekNaSklade->update(array('mnozstvi' => $mnozstvi));
            }
        }

        return null;
    }
}