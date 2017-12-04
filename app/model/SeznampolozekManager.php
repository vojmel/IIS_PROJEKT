<?php
/**
 * Model leku
 */

namespace App\Model;


class SeznampolozekManager extends GeneralManager
{
    protected $tableName = 'seznampolozek';
    protected $pkColumn = 'seznampolozekID';

    public static function removePolozku($db, $prodejID, $lekID) {

        $polozky = $db->table('seznampolozek')
            ->where('prodejID = ?', $prodejID)
            ->where('lekID = ?', $lekID);

        foreach ($polozky as $polozka) {

            $prodej = $db->table('prodej')->get($prodejID);
            if ($prodej) {

                // add to sklad
                if (UskladnenManager::addToSklad($db, $lekID, $prodej->pobockaID, $polozka->mnozstvi)) {
                    // delete odl
                    $polozka->delete();
                }
            }
        }
    }
}