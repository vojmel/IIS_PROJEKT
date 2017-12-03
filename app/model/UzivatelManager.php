<?php
/**
 * Created by PhpStorm.
 * User: Meluzin
 * Date: 02.12.2017
 * Time: 23:08
 */

namespace App\Model;


class UzivatelManager extends GeneralManager
{
    protected $tableName = 'uzivatel';
    protected $pkColumn = 'uzivatelID';

    public static $user_salt = "Akls809)(*(";

    public function register($data) {
        unset($data["password2"]);

        $data["roleID"] = 1;
        $data["lekarnikID"] = 1;

        $data["password"] = sha1($data["password"] . self::$user_salt);

        return $this->add($data);
    }

    public function generatePassword($passwordIn){
        return sha1($passwordIn . self::$user_salt);
    }
}