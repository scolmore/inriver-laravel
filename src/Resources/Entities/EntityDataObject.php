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

    public string $entityTypeId;
    public ?string $fieldSetId;
    public array $fieldValues;

    public function __construct(array $data)
    {
        $this->id = $data['id'] ?? null;
        $this->displayName = $data['displayName'] ?? '';
        $this->displayDescription = $data['displayDescription'] ?? '';
        $this->version = $data['version'] ?? null;
        $this->lockedBy = $data['lockedBy'] ?? null;

        $this->entityTypeId = $data['entityTypeId'];
        $this->fieldSetId = $data['fieldSetId'];

        $this->fieldValues = $data['fieldValues'] ?? [];
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
