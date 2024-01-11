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
        $this->inRiver()->version = '1.0.1';

        return $this->inRiver()->request(
            method: 'GET',
            endpoint: $this->endpoint('/entitytypes')
        );
    }

    /**
     * Adds an entity type.
     *
     * @param  string  $id
     * @param  string  $name
     * @param  bool  $isLinkedEntityType
     * @return array
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Model/AddEntityType
     */
    public function addEntityType(string $id, string $name, bool $isLinkedEntityType): array
    {
        $this->inRiver()->version = '1.0.1';

        return $this->inRiver()->request(
            method: 'POST',
            endpoint: $this->endpoint('/entitytypes'),
            data: [
                'id' => $id,
                'name' => $name,
                'isLinkedEntityType' => $isLinkedEntityType,
            ]
        );
    }
}
