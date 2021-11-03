<?php

namespace Looper\core\models;

use Looper\core\models\Database;

abstract class Model
{
    protected $table;

    public function __construct()
    {
        $this->pdo = Database::getPdo();
    }
}
