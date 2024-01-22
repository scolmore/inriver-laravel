<?php

declare(strict_types=1);

namespace Scolmore\InRiver\Objects\Model;

use Scolmore\InRiver\Exceptions\InRiverException;

class CvlValueObject
{
    private string $cvlId;

    private string $type;

    public ?string $key;

    public string|LanguagesObject $value;

    public int $index;

    public ?string $parentKey;

    public bool $deactivated;

    /**
     * @throws InRiverException
     */
    public function __construct(CvlObject $cvl, array $cvlValueModel)
    {
        $this->cvlId = $cvl->id;
        $this->type = $cvl->dataType;

        $this->initialize($cvlValueModel);
    }

    /**
     * @throws InRiverException
     */
    private function initialize(array $cvlValueModel): void
    {
        $this->key = $cvlValueModel['key'] ?? null;

        $this->value = $this->type === 'String'
            ? ($cvlValueModel['value'] ?? '')
            : new LanguagesObject($cvlValueModel['value'] ?? []);

        $this->index = $cvlValueModel['index'] ?? 0;
        $this->parentKey = $cvlValueModel['parentKey'] ?? null;
        $this->deactivated = $cvlValueModel['deactivated'] ?? false;
    }

    public function toArray(): array
    {
        return [
            'key' => $this->key,
            'value' => is_string($this->value) ? $this->value : $this->value->toArray(),
            'index' => $this->index,
            'parentKey' => $this->parentKey,
            'deactivated' => $this->deactivated,
        ];
    }

    /**
     * @throws InRiverException
     */
    public function create(): self
    {
        $response = InRiver()->model->createCvlValue(
            cvlId: $this->cvlId,
            body: $this->toArray()
        );

        $this->initialize($response);

        return $this;
    }

    /**
     * @throws InRiverException
     */
    public function update(): self
    {
        $response = InRiver()->model->updateCvlValue(
            cvlId: $this->cvlId,
            key: $this->key,
            body: $this->toArray()
        );

        $this->initialize($response);

        return $this;
    }

    /**
     * @throws InRiverException
     */
    public function delete(): self
    {
        InRiver()->model->deleteCvlValue(
            cvlId: $this->cvlId,
            key: $this->key
        );

        $this->initialize([]);

        return $this;
    }
}
