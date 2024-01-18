<?php

declare(strict_types=1);

namespace Scolmore\InRiver\Resources\Syndicate;

use Scolmore\InRiver\Exceptions\InRiverException;
use Scolmore\InRiver\Resources\AbstractResource;

class Syndicate extends AbstractResource
{
    protected string $endpoint = 'syndications';

    /**
     * Get all syndication's.
     *
     * @return array
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Syndicate/Syndications
     */
    public function syndications(): array
    {
        return $this->inRiver()->request(
            method: 'GET',
            endpoint: $this->endpoint()
        );
    }

    /**
     * Run Syndicate.
     *
     * @param  int  $syndicationId
     * @return null
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Syndicate/RunSyndicate
     */
    public function runSyndicate(int $syndicationId): null
    {
        return $this->inRiver()->request(
            method: 'POST',
            endpoint: $this->endpoint("/{$syndicationId}:run")
        );
    }
}
