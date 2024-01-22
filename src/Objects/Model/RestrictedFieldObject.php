<?php

declare(strict_types=1);

namespace Scolmore\InRiver\Objects\Model;

use Scolmore\InRiver\Exceptions\InRiverException;

class RestrictedFieldObject
{
    public ?int $id;

    public ?string $entityTypeId;

    public ?string $fieldTypeId;

    public ?string $categoryId;

    public ?string $restrictionType;

    public int $roleId;

    public function __construct(?array $restrictedFieldModel)
    {
        $this->initialize($restrictedFieldModel);
    }

    private function initialize(?array $restrictedFieldModel): void
    {
        $this->id = $restrictedFieldModel['id'] ?? null;
        $this->entityTypeId = $restrictedFieldModel['entityTypeId'] ?? null;
        $this->fieldTypeId = $restrictedFieldModel['fieldTypeId'] ?? null;
        $this->categoryId = $restrictedFieldModel['categoryId'] ?? null;
        $this->restrictionType = $restrictedFieldModel['restrictionType'] ?? null;
        $this->roleId = $restrictedFieldModel['roleId'] ?? 0;
    }

    public function toArray(): array
    {
        return (array) $this;
    }

    /**
     * @throws InRiverException
     */
    public function create(): self
    {
        $body = $this->toArray();
        unset($body['id']);

        $response = InRiver()->model->addRestrictedFieldPermission(
            body: $body
        );

        $this->initialize($response);

        return $this;
    }

    /**
     * @throws InRiverException
     */
    public function delete(): self
    {
        InRiver()->model->deleteRestrictedFieldPermission(
            restrictedFieldId: $this->id
        );

        $this->initialize([]);

        return $this;
    }
}
