<?php
/**
 * Model leku
 */

namespace App\Model;


use Nette\DateTime;

class ProdejManager extends GeneralManager
{
    protected $tableName = 'prodej';
    protected $pkColumn = 'prodejID';

    public function getAllFromLekarnik($lekarnikID) {

        return $this->database->table($this->tableName)->where("lekarnikID = ?", $lekarnikID);
    }

    public function addFromIds($leky, $pobockaID, $lekarnikID){

        // Vytvorime prodej
        $values['lekarnikID'] = $lekarnikID;
        $values['datum'] = DateTime::from(date("Y-m-d H:i:s"));
        $values['pobockaID'] = $pobockaID;

        $prodejId = $this->add($values);
        if ( ! $prodejId) {
            return false;
        }

        $prodejId = $prodejId->prodejID;

        // povytvarime leky
        return $this->createPolozkyProPdrodej($pobockaID, $prodejId, $leky);
    }



    public function createPolozkyProPdrodej($pobockaID, $prodejId, $leky) {

        // Zpracujeme leky
        $items = explode(',', $leky);
        $lekArr = array();
        if (count($leky) > 0) {
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

                $valuesLek['cena'] = $lekDb->cena; // get actual cenu
                $valuesLek['mnozstvi'] = $lek[1];
                $valuesLek['prodejID'] = $prodejId;
                $valuesLek['lekID'] = $lek[0];

                // add do prodeje
                if ( ! $this->database->table('seznampolozek')->insert($valuesLek)) {
                    // todo Je potreba?
                    return false;
                }

                // oddelani ze skladu
                if ( ! UskladnenManager::removeFromSklad($this->database, $lek[0], $pobockaID, $lek[1])) {
                    // todo error: Je potreba?
                    //die('delete uskladneno');
                }
            }
        }
        return true;
    }



    public function getPolozky($prodejID) {
        $prodej = $this->getSpecific($prodejID);
        if ($prodej) {
            $ret = array();

            // get polozky
            $polozky = $this->database->table('seznampolozek')->where('prodejID = ?', $prodejID);
            foreach ($polozky as $polozka) {
                $ret[] = $polozka->lekID.":".$polozka->mnozstvi;
            }

            return join(',', $ret);

        }
        return "";
    }


    public function update($prodejID, $vybraneLeky) {
        // $this->getParameter('id'), $values['vybraneLekyIds']
        $prodej = $this->database->table('prodej')->get($prodejID);
        if (! $prodej) {
            return false;
        }


        // projdeme all polozky puvodniho prodeje
        $polozkyPuvodni = $this->database->table('uskladnen')->where('pobockaID = ?', $prodej->pobockaID);



        foreach ($polozkyPuvodni as $polozka) {
            // vsechny je smazene
            SeznampolozekManager::removePolozku($this->database, $prodejID, $polozka->lekID);
        }

        //dump($prodej);
        //dump($polozkyPuvodni);
        //dump($vybraneLeky);
        //die();

        // pridame all polozky noveho prodeje
        return $this->createPolozkyProPdrodej($prodej->pobockaID, $prodejID, $vybraneLeky);
    }
}