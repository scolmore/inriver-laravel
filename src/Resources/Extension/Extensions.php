<?php

declare(strict_types=1);

namespace Scolmore\InRiver\Resources\Extension;

use Scolmore\InRiver\Resources\AbstractResource;

class Extensions extends AbstractResource
{
    protected string $endpoint = 'extensions';

    /**
     * Return a list of all extensions that have been added to the environment.
     *
     * @return array
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Extension/GetAllExtensions
     */
    public function getAllExtensions(): array
    {
        return $this->inRiver()->request(
            method: 'GET',
            endpoint: $this->endpoint
        );
    }
}
