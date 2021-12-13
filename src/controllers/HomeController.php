<?php

namespace Looper\controllers;

use Core\services\Http;

class HomeController
{
    public function show()
    {
        return Http::response('home/index');
    }
}
