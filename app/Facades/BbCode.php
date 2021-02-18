<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class BbCode extends Facade
{
    /***
    * @inheritdoc
    */
    protected static function getFacadeAccessor()
    {
        return 'bbcode';
    }
}
