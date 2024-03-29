<?php

declare(strict_types=1);

namespace Scolmore\InRiver\Objects\Model;

use Scolmore\InRiver\Exceptions\InRiverException;

class CvlObject
{
    public ?string $id;

    public ?string $parentId;

    public ?string $dataType;

    public bool $customValueList;

    public function __construct(array $cvlModel)
    {
        $this->initialize($cvlModel);
    }

    private function initialize(array $cvlModel): void
    {
        $this->id = $cvlModel['id'] ?? null;
        $this->parentId = $cvlModel['parentId'] ?? null;
        $this->dataType = $cvlModel['dataType'] ?? null;
        $this->customValueList = $cvlModel['customValueList'] ?? false;
    }

    /**
     * @throws InRiverException
     */
    public function create(): self
    {
        $response = InRiver()->model->addCvl(
            id: $this->id,
            parentId: $this->parentId,
            dataType: $this->dataType,
            customValueList: $this->customValueList
        );

        $this->initialize($response);

        return $this;
    }

    /**
     * @throws InRiverException
     */
    public function update(): self
    {
        $response = InRiver()->model->updateCvl(
            cvlId: $this->id,
            parentId: $this->parentId,
            dataType: $this->dataType,
            customValueList: $this->customValueList
        );

        $this->initialize($response);

        return $this;
    }

    /**
     * @throws InRiverException
     */
    public function delete(): self
    {
        InRiver()->model->deleteCvl(
            cvlId: $this->id
        );

        $this->initialize([]);

        return $this;
    }

    /**
     * @throws InRiverException
     */
    public function values(): array
    {
        $values = InRiver()->model->getAllCvlValues(
            cvlId: $this->id
        );

        return collect($values)
            ->map(fn (array $value) => new CvlValueObject($this, $value))
            ->toArray();
    }

    /**
     * @throws InRiverException
     */
    public function newValue(): CvlValueObject
    {
        return new CvlValueObject($this, []);
    }

    /**
     * @throws InRiverException
     */
    public function value(string $key): CvlValueObject
    {
        $response = InRiver()->model->getCvlValue(
            cvlId: $this->id,
            key: $key
        );

        return new CvlValueObject($this, $response);
    }
}
