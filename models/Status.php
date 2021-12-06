<?php

namespace Looper\models;

use Looper\core\models\Model;

class Status extends Model
{
    public string $value;
    public string $slug;

    protected string $table = 'status';
}
