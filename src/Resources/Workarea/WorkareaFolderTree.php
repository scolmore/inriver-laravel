<?php

declare(strict_types=1);

namespace Scolmore\InRiver\Resources\Workarea;

use Scolmore\InRiver\Exceptions\InRiverException;
use Scolmore\InRiver\Resources\AbstractResource;

class WorkareaFolderTree extends AbstractResource
{
    protected string $endpoint = 'workareafoldertree';

    /**
     * Get workarea folder tree.
     *
     * @param  bool  $includeCreatedByMe
     * @param  bool  $includeShared
     * @param  string  $forUsername
     * @return array
     * @throws InRiverException
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Workarea/WorkareaFolderTree
     */
    public function workareaFolderTree(
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
