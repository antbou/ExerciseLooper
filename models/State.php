<?php

namespace Looper\models;

use Looper\core\models\Model;
use Looper\core\traits\FindBySlug;

class State extends Model
{
    use FindBySlug;
    public string $name;
    public string $slug;

    protected string $table = 'states';
}
