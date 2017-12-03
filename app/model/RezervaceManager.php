<?php
/**
 * Model leku
 */

namespace App\Model;


class RezervaceManager extends GeneralManager
{
    protected $tableName = 'rezervace';
    protected $pkColumn = 'rezervaceID';
}