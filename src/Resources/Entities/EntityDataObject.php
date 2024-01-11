<?php

declare(strict_types=1);

namespace Scolmore\InRiver\Resources\Entities;

use Scolmore\InRiver\Exceptions\FieldDoesNotExistException;
use Scolmore\InRiver\InRiver;

class EntityDataObject
{
    public ?int $id;
    public string $displayName;
    public string $displayDescription;
    public ?string $version;
    public ?string $lockedBy;
    public ?string $createdBy;
    public ?string $createdDate;
    public ?string $formattedCreatedDate;
    public ?string $modifiedBy;
    public ?string $modifiedDate;
    public ?string $formattedModifiedDate;
    public ?string $resourceUrl;

    public string $entityTypeId;
    public ?string $entityTypeDisplayName;
    public ?string $fieldSetId;
    public ?string $fieldSetName;
    public array $fieldValues;
    public int $completeness;

    public int $segmentId;
    public ?string $segmentName;

    public array $specification;
    public array $links;

    public function __construct(array $data)
    {
        $this->id = $data['id'] ?? null;
        $this->displayName = $data['displayName'] ?? '';
        $this->displayDescription = $data['displayDescription'] ?? '';
        $this->version = $data['version'] ?? null;
        $this->lockedBy = $data['lockedBy'] ?? null;
        $this->createdBy = $data['createdBy'] ?? null;
        $this->createdDate = $data['createdDate'] ?? null;
        $this->formattedCreatedDate = $data['formattedCreatedDate'] ?? null;
        $this->modifiedBy = $data['modifiedBy'] ?? null;
        $this->modifiedDate = $data['modifiedDate'] ?? null;
        $this->formattedModifiedDate = $data['formattedModifiedDate'] ?? null;
        $this->resourceUrl = $data['resourceUrl'] ?? null;
        $this->completeness = $data['completeness'] ?? 0;

        $this->entityTypeId = $data['entityTypeId'];
        $this->entityTypeDisplayName = $data['entityTypeDisplayName'] ?? null;
        $this->fieldSetId = $data['fieldSetId'];
        $this->fieldSetName = $data['fieldSetName'] ?? null;

        $this->fieldValues = $data['fieldValues'] ?? [];

        $this->segmentId = $data['segmentId'] ?? 0;
        $this->segmentName = $data['segmentName'] ?? null;

        $this->specification = $data['specification'] ?? [];

        $this->links = $data['links'] ?? [];
    }

    /**
     * @throws FieldDoesNotExistException
     */
    public function getField(string $fieldTypeId): int|string
    {
        foreach ($this->fieldValues as $fieldValue) {
            if ($fieldValue['fieldTypeId'] === $fieldTypeId) {
                return $fieldValue['value'];
            }
        }

        throw new FieldDoesNotExistException($fieldTypeId);
    }

    /**
     * @throws FieldDoesNotExistException
     */
    public function setField(string $fieldTypeId, string|array|null $value): self
    {
        foreach ($this->fieldValues as &$fieldValue) {
            if ($fieldValue['fieldTypeId'] === $fieldTypeId) {
                $fieldValue['value'] = $value;

                return $this;
            }
        }

        throw new FieldDoesNotExistException($fieldTypeId);
    }

    public function save(): void
    {
        if ($this->id) {
            $this->update();
        } else {
            $this->create();
        }
    }

    public function delete(): ?self
    {
        $inriver = new InRiver();

        $inriver->entities->delete($this->id);

        return null;
    }

    protected function create(): EntityDataObject
    {
        $inriver = new InRiver();

        $body = [
            'entityTypeId' => $this->entityTypeId,
            'fieldSetId' => $this->fieldSetId,
            'fieldValues' => $this->fieldValues,
        ];

        $response = $inriver->entities->createNew($body);

        foreach ($response as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }

        return $this;
    }

    protected function update(): self
    {
        $inriver = new InRiver();

        $inriver->entities->updateFieldValues($this->id, $this->fieldValues);

        return $this;
    }
}
