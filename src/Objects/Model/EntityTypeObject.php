<?php

declare(strict_types=1);

namespace Scolmore\InRiver\Objects\Model;

use Scolmore\InRiver\Exceptions\InRiverException;

class EntityTypeObject
{
    public ?string $id;
    public LanguagesObject $name;
    public array $fieldTypes;
    public array $inboundLinkTypes;
    public array $outboundLinkTypes;
    public bool $isLinkEntityType;
    public array $fieldSetIds;
    protected string $displayNameFieldTypeId;
    protected string $displayDescriptionFieldTypeId;

    /**
     * @throws InRiverException
     */
    public function __construct(array $entityTypeModel)
    {
        $this->initialize($entityTypeModel);
    }

    /**
     * @throws InRiverException
     */
    public function initialize(array $entityTypeModel): void
    {
        $this->id = $entityTypeModel['id'] ?? null;

        $this->name = isset($entityTypeModel['name'])
            ? new LanguagesObject($entityTypeModel['name'])
            : new LanguagesObject(InRiver()->model->getAllLanguages());

        $this->fieldTypes = $entityTypeModel['fieldTypes'] ?? [];

        $this->inboundLinkTypes = $entityTypeModel['inboundLinkTypes'] ?? [];
        $this->outboundLinkTypes = $entityTypeModel['outboundLinkTypes'] ?? [];

        $this->isLinkEntityType = $entityTypeModel['isLinkEntityType'] ?? false;

        $this->fieldSetIds = $entityTypeModel['fieldSetIds'] ?? [];

        $this->displayNameFieldTypeId = $entityTypeModel['displayNameFieldTypeId'] ?? '';
        $this->displayDescriptionFieldTypeId = $entityTypeModel['displayDescriptionFieldTypeId'] ?? '';
    }

    /**
     * @throws InRiverException
     */
    public function create(): self
    {
        $response = InRiver()->model->addEntityType(
            id: $this->id,
            name: array_filter($this->name->toArray(), static fn($value) => $value !== null),
            isLinkEntityType: $this->isLinkEntityType
        );

        return new self($response);
    }

    /**
     * @throws InRiverException
     */
    public function update(): self
    {
        $response = InRiver()->model->updateEntityType(
            entityTypeId: $this->id,
            name: array_filter($this->name->toArray(), static fn($value) => $value !== null),
            isLinkEntityType: $this->isLinkEntityType
        );

        return new self($response);
    }

    /**
     * @throws InRiverException
     */
    public function delete(): self
    {
        InRiver()->model->deleteEntityType(
            entityTypeId: $this->id
        );

        $this->initialize([]);

        return $this;
    }
}
