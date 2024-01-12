<?php

declare(strict_types=1);

use Scolmore\InRiver\InRiver;

if (! function_exists('InRiver')) {
    function InRiver(): InRiver
    {
        return app(InRiver::class);
    }
}
