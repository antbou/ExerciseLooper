<?php

namespace Looper\models;

use Looper\core\models\Model;

class State extends Model
{
    public string $name;
    public string $slug;

    protected string $table = 'states';
}
