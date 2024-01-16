<?php

declare(strict_types=1);

namespace Scolmore\InRiver\Resources\Model;

use Scolmore\InRiver\Exceptions\InRiverException;
use Scolmore\InRiver\Objects\Model\RestrictedFieldObject;

readonly class RestrictedFields
{
    public function __construct(
        private Model $model
    ) {}

    /**
     * @throws InRiverException
     */
    public function list(): array
    {
        $fieldPermissions = $this->model->getAllRestrictedFieldPermission();

        return collect($fieldPermissions)
            ->map(fn (array $fieldPermission) => new RestrictedFieldObject($fieldPermission))
            ->toArray();
    }

    public function new(): RestrictedFieldObject
    {
        return new RestrictedFieldObject([]);
    }

    /**
     * @throws InRiverException
     */
    public function get(int $restrictedFieldId): RestrictedFieldObject
    {
        $restrictedField = $this->model->getRestrictedFieldPermission($restrictedFieldId);

        return new RestrictedFieldObject($restrictedField);
    }

    /**
     * @throws InRiverException
     */
    public function delete(int $restrictedFieldId): RestrictedFieldObject
    {
        return $this->model->deleteRestrictedFieldPermission($restrictedFieldId);
    }
}
