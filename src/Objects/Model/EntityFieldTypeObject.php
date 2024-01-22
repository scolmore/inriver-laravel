<?php

declare(strict_types=1);

namespace Scolmore\InRiver\Objects\Model;

use Scolmore\InRiver\Exceptions\InRiverException;

class EntityFieldTypeObject
{
    public string $entityTypeId;

    public ?string $id;

    public LanguagesObject $name;

    public ?string $localizedName;

    public LanguagesObject $description;

    public ?string $localizedDescription;

    public ?string $dataType;

    public bool $isMultiValue;

    public bool $isHidden;

    public bool $isReadOnly;

    public bool $isMandatory;

    public bool $isUnique;

    public bool $trackChanges;

    public ?string $defaultValue;

    public bool $isExcludedFromDefaultView;

    public ?array $includedInFieldSets;

    public ?string $categoryId;

    public int $index;

    public ?string $cvlId;

    public ?string $parentCvlId;

    public ?array $settings;

    /**
     * @throws InRiverException
     */
    public function __construct(?array $fieldSetModel)
    {
        $this->initialize($fieldSetModel);
    }

    /**
     * @throws InRiverException
     */
    public function initialize(array $fieldSetModel): void
    {
        $this->entityTypeId = $fieldSetModel['entityTypeId'];

        $this->id = $fieldSetModel['id'] ?? null;

        $this->name = isset($fieldSetModel['name'])
            ? new LanguagesObject($fieldSetModel['name'])
            : new LanguagesObject(InRiver()->model->getAllLanguages());

        $this->localizedName = $fieldSetModel['localizedName'] ?? null;

        $this->description = isset($fieldSetModel['description'])
            ? new LanguagesObject($fieldSetModel['description'])
            : new LanguagesObject(InRiver()->model->getAllLanguages());

        $this->localizedDescription = $fieldSetModel['localizedDescription'] ?? null;
        $this->dataType = $fieldSetModel['dataType'] ?? null;
        $this->isMultiValue = $fieldSetModel['isMultiValue'] ?? false;
        $this->isHidden = $fieldSetModel['isHidden'] ?? false;
        $this->isReadOnly = $fieldSetModel['isReadOnly'] ?? false;
        $this->isMandatory = $fieldSetModel['isMandatory'] ?? false;
        $this->isUnique = $fieldSetModel['isUnique'] ?? false;
        $this->trackChanges = $fieldSetModel['trackChanges'] ?? false;
        $this->defaultValue = $fieldSetModel['defaultValue'] ?? null;
        $this->isExcludedFromDefaultView = $fieldSetModel['isExcludedFromDefaultView'] ?? false;
        $this->includedInFieldSets = $fieldSetModel['includedInFieldSets'] ?? [];
        $this->categoryId = $fieldSetModel['categoryId'] ?? 'General';
        $this->index = $fieldSetModel['index'] ?? 0;
        $this->cvlId = $fieldSetModel['cvlId'] ?? null;
        $this->parentCvlId = $fieldSetModel['parentCvlId'] ?? null;
        $this->settings = $fieldSetModel['settings'] ?? [];
    }

    public function toArray(): array
    {
        $data = (array) $this;

        unset($data['entityTypeId']);

        $data['name'] = $this->name->toArray();
        $data['description'] = $this->description->toArray();
        $data['settings'] = empty($this->settings) ? null : $this->settings;

        return $data;
    }

    /**
     * @throws InRiverException
     */
    public function create(): self
    {
        $response = InRiver()->model->addFieldType(
            entityTypeId: $this->entityTypeId,
            body: $this->toArray()
        );

        $this->initialize(['entityTypeId' => $this->entityTypeId] + $response);

        return $this;
    }

    /**
     * @throws InRiverException
     */
    public function update(): self
    {
        $response = InRiver()->model->updateFieldType(
            entityTypeId: $this->entityTypeId,
            fieldTypeId: $this->id,
            body: $this->toArray()
        );

        $response['entityTypeId'] = $this->entityTypeId;

        $this->initialize(['entityTypeId' => $this->entityTypeId] + $response);

        return $this;
    }

    /**
     * @throws InRiverException
     */
    public function delete(): self
    {
        InRiver()->model->deleteFieldType(
            entityTypeId: $this->entityTypeId,
            fieldTypeId: $this->id
        );

        $this->initialize(['entityTypeId' => $this->entityTypeId]);

        return $this;
    }
}
