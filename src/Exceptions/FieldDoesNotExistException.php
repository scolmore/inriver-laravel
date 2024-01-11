<?php

declare(strict_types=1);

namespace Scolmore\InRiver\Exceptions;

use Exception;

class FieldDoesNotExistException extends Exception
{
    public function __construct(string $field)
    {
        parent::__construct("Field {$field} does not exist on this entity.");
    }
}
