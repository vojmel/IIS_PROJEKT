<?php
/**
 * Obecny model
 *
 */


namespace App\Model;
use Nette;

class GeneralManager
{

    protected $tableName = 'tableName';
    protected $pkColumn = 'pkColumn';

    /**
     * @var Nette\Database\Context
     */
    protected $database;

    public function __construct(Nette\Database\Context $database) {
        $this->database = $database;
    }

    public function getAll() {
        return $this->database->table($this->tableName);
    }

    public function getSpecific($id) {
        return $this->database->table($this->tableName)->get($id);// ->where($this->pkColumn.' =', $id);
    }

    public function add($values) {
        return $this->database->table($this->tableName)->insert($values);
    }

    public function delete($id) {
        $row = $this->getSpecific($id);
        if ($row) {
            return $row->delete();
        }
        return null;
    }

    public function getPkColumn() {
        return $this->pkColumn;
    }
}