<?php

declare(strict_types=1);

namespace Scolmore\InRiver\Resources\Workarea;

use Scolmore\InRiver\Exceptions\InRiverException;
use Scolmore\InRiver\Resources\AbstractResource;

class WorkareaFolders extends AbstractResource
{
    protected string $endpoint = 'workareafolders';

    /**
     * Get workarea folders.
     *
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Workarea/WorkareaFolders
     */
    public function workareaFolders(
        bool $includeCreatedByMe = true,
        bool $includeShared = true,
        string $forUsername = ''
    ): array {
        return $this->inRiver()->request(
            method: 'GET',
            endpoint: $this->endpoint(),
            data: [
                'includeCreatedByMe' => $includeCreatedByMe ? 'true' : 'false',
                'includeShared' => $includeShared ? 'true' : 'false',
                'forUsername' => $forUsername,
            ]
        );
    }
}
