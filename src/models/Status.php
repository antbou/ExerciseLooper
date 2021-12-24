<?php

namespace Looper\models;

use Core\models\Model;
use Core\traits\FindBySlug;

class Status extends Model
{
    use FindBySlug;
    public string $value;
    public string $slug;

    protected string $table = 'status';
}
