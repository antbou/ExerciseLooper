<?php

namespace Looper\core\models;

use Looper\core\models\Database;
use Looper\core\models\traits\Children;
use Looper\models\Exercise;

abstract class Model
{
    abstract function setId(int $id): Exercise;

    use Children;

    protected $table;

    public function __construct()
    {
        $this->pdo = Database::getPdo();
    }

    public function create(): bool // create db record from object
    {

        $fields = [];
        $fieldsBind = [];
        foreach ($this->toArray() as $field => $value) {
            $fields[] = $field;
            $fieldsBind[] = ":$field";
        }

        $fields = implode(',', $fields);
        $fieldsBind = implode(',', $fieldsBind);
        $query = "INSERT INTO {$this->table} ($fields) VALUES ($fieldsBind)";

        try {
            $this->setId(Database::insert($query, $this->toArray()));
            return true;
        } catch (\PDOException $Exception) {
            return false;
        }
    }
}
