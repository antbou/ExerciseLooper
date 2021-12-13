<?php

namespace Looper\models;

use Core\models\Model;
use Core\traits\FindBySlug;

class State extends Model
{
    use FindBySlug;
    public string $name;
    public string $slug;

    protected string $table = 'states';
}
