<?php

declare(strict_types=1);

namespace Scolmore\InRiver\Objects\Model;

use Scolmore\InRiver\Exceptions\InRiverException;

class FieldSetObject
{
    public ?string $fieldSetId;
    public LanguagesObject $name;
    public LanguagesObject $description;
    public ?string $entityTypeId;
    public array $fieldTypeIds;

    /**
     * @throws InRiverException
     */
    public function __construct(array $fieldSetModel)
    {
        $this->initialize($fieldSetModel);
    }

    /**
     * @throws InRiverException
     */
    public function initialize(array $fieldSetModel): void
    {
        $this->fieldSetId = $fieldSetModel['fieldSetId'] ?? null;

        $this->name = isset($fieldSetModel['name'])
            ? new LanguagesObject($fieldSetModel['name'])
            : new LanguagesObject(InRiver()->model->getAllLanguages());

        $this->description = isset($fieldSetModel['description'])
            ? new LanguagesObject($fieldSetModel['description'])
            : new LanguagesObject(InRiver()->model->getAllLanguages());

        $this->entityTypeId = $fieldSetModel['entityTypeId'] ?? null;

        $this->fieldTypeIds = $fieldSetModel['fieldTypeIds'] ?? [];
    }

    /**
     * @throws InRiverException
     */
    public function create(): self
    {
        $response = InRiver()->model->addFieldSet(
            fieldSetId: $this->fieldSetId,
            name: array_filter($this->name->toArray(), static fn($value) => $value !== null),
            description: $this->description->toArray(),
            entityTypeId: $this->entityTypeId,
            fieldTypeIds: $this->fieldTypeIds
        );

        return new self($response);
    }

    /**
     * @throws InRiverException
     */
    public function update(): self
    {
        $response = InRiver()->model->updateFieldSet(
            fieldSetId: $this->fieldSetId,
            name: array_filter($this->name->toArray(), static fn($value) => $value !== null),
            description: $this->description->toArray(),
            entityTypeId: $this->entityTypeId,
            fieldTypeIds: $this->fieldTypeIds
        );

        return new self($response);
    }

    /**
     * @throws InRiverException
     */
    public function delete(): self
    {
        InRiver()->model->deleteFieldSet(
            fieldSetId: $this->fieldSetId,
        );

        $this->initialize([]);

        return $this;
    }
}
