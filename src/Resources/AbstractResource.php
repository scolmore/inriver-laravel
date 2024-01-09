<?php

declare(strict_types=1);

namespace Scolmore\InRiver\Resources;

use Scolmore\InRiver\InRiver;

abstract class AbstractResource
{
    private InRiver $inRiver;

    protected string $endpoint;

    public function __construct(InRiver $inRiver)
    {
        $this->inRiver = $inRiver;
    }

    public function endpoint(?string $extra = null): string
    {
        return $extra
            ? "{$this->endpoint}{$extra}"
            : $this->endpoint;
    }

    public function inRiver(): InRiver
    {
        return $this->inRiver;
    }
}
