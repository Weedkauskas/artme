<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class EmailHelperFacade extends Facade {

    protected static function resolveFacade($name)
    {
        return app()[$name];
    }

    public static function __callStatic($method, $args)
    {
        return (self::resolveFacade('Helper'))->$method(...$args);
    }
}
