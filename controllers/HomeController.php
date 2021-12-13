<?php

namespace Looper\controllers;

use Looper\core\services\Http;

class HomeController
{
    public function show()
    {
        return Http::response('home/index');
    }
}
