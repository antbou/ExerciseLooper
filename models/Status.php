<?php

namespace Looper\models;

use Looper\core\models\Model;
use Looper\core\traits\FindBySlug;

class Status extends Model
{
    use FindBySlug;
    public string $value;
    public string $slug;

    protected string $table = 'status';
}
