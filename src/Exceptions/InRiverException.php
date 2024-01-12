<?php

declare(strict_types=1);

namespace Scolmore\InRiver\Exceptions;

use Exception;

class InRiverException extends Exception
{
    public function __construct(array $response)
    {
        $message = 'InRiver API returned an error - ';

        foreach ($response as $key => $value) {
            $message .= "{$key}: {$value} ";
        }

        parent::__construct($message);
    }
}
