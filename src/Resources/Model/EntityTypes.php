<?php

declare(strict_types=1);

namespace Scolmore\InRiver\Resources\Model;

use Scolmore\InRiver\Exceptions\InRiverException;
use Scolmore\InRiver\Objects\Model\EntityTypeObject;

readonly class EntityTypes
{
    public function __construct(
        private Model $model
    ) {
    }

    /**
     * @throws InRiverException
     */
    public function list(string $entityTypeIds = ''): array
    {
        return $this->model->getAllEntityTypes($entityTypeIds);
    }

    /**
     * @throws InRiverException
     */
    public function new(): EntityTypeObject
    {
        return new EntityTypeObject([]);
    }

    /**
     * @throws InRiverException
     */
    public function get(string $entityType): EntityTypeObject
    {
        $response = $this->model->getEntityType($entityType);

        return new EntityTypeObject($response);
    }
}
