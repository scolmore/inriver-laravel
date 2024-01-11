<?php

declare(strict_types=1);

namespace Scolmore\InRiver\Resources\Model;

use Scolmore\InRiver\Resources\AbstractResource;

class Model extends AbstractResource
{
    protected string $endpoint = 'model';

    /**
     * Returns available entity types.
     *
     * @param  string  $entityTypeIds optional, filter types using comma separated list.
     * @return array
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Model/GetAllEntityTypesV101
     */
    public function getAllEntityTypes(string $entityTypeIds = ''): array
    {
        return $this->inRiver()->request(
            method: 'GET',
            endpoint: $this->endpoint('/entitytypes')
        );
    }
}
