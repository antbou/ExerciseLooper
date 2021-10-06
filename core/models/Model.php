<?php

namespace Looper\core\models;

use Looper\core\models\Database;

abstract class Model
{
    private $pdo;
    protected $table;

    public function __construct()
    {
        $this->pdo = Database::getPdo();
    }

    /**
     * Sauvegarde les propriétés de l'objet en base de donnée
     *
     * @param array $attributes
     * @return void
     */
    protected function saveObject(array $attributes)
    {
        $sql = null;

        // Lorsque l'object n'existe pas en base de donnée
        if (is_null($attributes['id'])) {

            // Transforme le tableau en string et sépare les valeurs avec une ,
            $fields = implode(',', array_keys($attributes));

            // Transforme le tableau en string et préfixe les valeurs avec un : toujours en les séparant avec une ,
            $fieldsBind = implode(',', preg_filter('/^/', ':', array_keys($attributes)));

            $sql = "INSERT INTO $this->table($fields) VALUES ($fieldsBind)";
        } else { // Lorsque l'object existe en base de donnée

            $attributesWithoutId[] = $attributes;

            $fields = [];

            // Préfixe chaque clef du tableau avec la valeur de la clef suivant de " = :" ce qui donne id = :id
            foreach (array_keys(array_shift($attributesWithoutId)) as $key) {
                $fields[] = $key . ' = :' . $key;
            }

            $fields = implode(',', $fields);

            $sql = "UPDATE $this->table SET $fields WHERE id = :id";
        }

        $this->execute($sql, $attributes);
    }

    private function execute(string $query, array $params)
    {
        $sth = $this->pdo->prepare($query);

        return $sth->execute($params);
    }
}
