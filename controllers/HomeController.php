<?php

namespace Looper\controllers;

use Looper\core\services\Http;

class HomeController
{
    public function show()
    {
        Http::response('home/index');
    }
}
