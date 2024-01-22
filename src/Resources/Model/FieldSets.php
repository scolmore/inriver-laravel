<?php

declare(strict_types=1);

namespace Scolmore\InRiver\Resources\Model;

use Scolmore\InRiver\Exceptions\InRiverException;
use Scolmore\InRiver\Objects\Model\FieldSetObject;

readonly class FieldSets
{
    public function __construct(
        private Model $model
    ) {
    }

    /**
     * @throws InRiverException
     */
    public function list(): array
    {
        return $this->model->getAllFieldSets();
    }

    /**
     * @throws InRiverException
     */
    public function new(): FieldSetObject
    {
        return new FieldSetObject([]);
    }

    /**
     * @throws InRiverException
     */
    public function get(string $fieldSetId): FieldSetObject
    {
        $fieldSets = $this->list();

        foreach ($fieldSets as $fieldSet) {
            if ($fieldSet['fieldSetId'] === $fieldSetId) {
                return new FieldSetObject($fieldSet);
            }
        }

        throw new InRiverException(['fieldSetId' => 'Not found']);
    }
}
