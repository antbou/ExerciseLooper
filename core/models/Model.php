<?php

namespace Core\models;

use Core\traits\ClassToTable;
use Core\traits\GetChildrenProperties;

abstract class Model extends Repository
{

    use GetChildrenProperties, ClassToTable;

    public ?int $id;
    protected string $table;

    public function __construct()
    {
        $this->table = ($this->table) ?? self::getShortName(static::class);
    }

    /**
     * create db record from object
     *
     * @return boolean
     */
    public function create(): bool
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
            $this->id = Database::insert($query, $this->toArray());
            return true;
        } catch (\PDOException $Exception) {
            return false;
        }
    }

    /**
     * Removes the object from the database
     *
     * @return boolean
     */
    public function delete(): bool
    {
        try {
            Database::execute("DELETE FROM {$this->table} WHERE id = :id", ['id' => $this->id]);
            return true;
        } catch (\PDOException $Exception) {
            return false;
        }
    }

    /**
     * update the object in the database
     *
     * @return boolean
     */
    public function update(): bool
    {
        $fields  = [];

        foreach ($this->toArray() as $field => $fieldsBind) {

            if ($field !== 'id') {
                $fields[] = "$field=:$field";
            }
        }

        $fields = implode(',', $fields);

        $query = "UPDATE {$this->table} SET $fields WHERE id=:id";

        try {
            return Database::execute($query, $this->toArray());
        } catch (\PDOException $Exception) {
            return false;
        }
    }
}
