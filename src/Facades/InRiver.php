<?php

namespace Scolmore\InRiver\Facades;

use Illuminate\Support\Facades\Facade;

class InRiver extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'inriver';
    }
}
