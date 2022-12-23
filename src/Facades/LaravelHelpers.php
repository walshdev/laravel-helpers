<?php

namespace Walshdev\LaravelHelpers\Facades;

use Illuminate\Support\Facades\Facade;

class LaravelHelpers extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'laravel-helpers';
    }
}
