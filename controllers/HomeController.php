<?php

class HomeController
{
    public function show()
    {
        Http::response('home/index');
    }
}
