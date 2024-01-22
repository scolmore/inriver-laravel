<?php

declare(strict_types=1);

namespace Scolmore\InRiver\Objects\Entity;

use Scolmore\InRiver\Exceptions\FieldDoesNotExistException;
use Scolmore\InRiver\Exceptions\InRiverException;

class EntityObject
{
    private ?int $id;
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

    public ?string $entityTypeId;
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
        $this->initialize($data);
    }

    private function initialize($data): void
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

        $this->entityTypeId = $data['entityTypeId'] ?? null;
        $this->entityTypeDisplayName = $data['entityTypeDisplayName'] ?? null;
        $this->fieldSetId = $data['fieldSetId'] ?? null;
        $this->fieldSetName = $data['fieldSetName'] ?? null;

        $this->fieldValues = $data['fieldValues'] ?? [];

        $this->segmentId = $data['segmentId'] ?? 0;
        $this->segmentName = $data['segmentName'] ?? null;

        $this->specification = $data['specification'] ?? [];

        $this->links = $data['links'] ?? [];
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function toArray(): array
    {
        $array = [
            'entityTypeId' => $this->entityTypeId,
            'fieldSetId' => $this->fieldSetId,
            'fieldValues' => $this->fieldValues,
        ];

        if ($this->segmentId) {
            $array['segmentId'] = $this->segmentId;
        }

        return $array;
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

    /**
     * @throws InRiverException
     */
    public function create(): self
    {
        $response = InRiver()->entities->createEntity($this->toArray());

        $this->initialize($response);

        return $this;
    }

    /**
     * @throws InRiverException
     */
    public function update(): self
    {
        $response = InRiver()->entities->setFieldValues($this->id, $this->fieldValues);

        $this->initialize($response);

        return $this;
    }

    /**
     * @throws InRiverException
     */
    public function delete(): self
    {
        InRiver()->entities->deleteEntity($this->id);

        $this->initialize([]);

        return $this;
    }
}
