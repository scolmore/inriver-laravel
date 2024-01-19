<?php

declare(strict_types=1);

namespace Scolmore\InRiver\Resources\Workarea;

use Scolmore\InRiver\Exceptions\InRiverException;
use Scolmore\InRiver\Resources\AbstractResource;

class WorkareaFolder extends AbstractResource
{
    protected string $endpoint = 'workareafolder';

    /**
     * Returns a list of entities in a workarea folder.
     *
     * @param  string  $workAreaFolderId
     * @return array
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Workarea/WorkareaQueryResult
     */
    public function workareaQueryResult(string $workAreaFolderId): array
    {
        return $this->inRiver()->request(
            method: 'GET',
            endpoint: $this->endpoint("/{$workAreaFolderId}/entitylist")
        );
    }
}
