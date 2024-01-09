<?php

declare(strict_types=1);

namespace Scolmore\InRiver\Facades;

use Illuminate\Support\Facades\Facade;

class InRiver extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'inriver';
    }
}
