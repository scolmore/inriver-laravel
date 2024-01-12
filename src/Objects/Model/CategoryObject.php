<?php

declare(strict_types=1);

namespace Scolmore\InRiver\Objects\Model;

use Scolmore\InRiver\Exceptions\InRiverException;
use Scolmore\InRiver\InRiver;

class CategoryObject
{
    public ?string $id;
    public LanguagesObject $name;
    public ?int $index;

    /**
     * @throws InRiverException
     */
    public function __construct(array $categoryModel)
    {
        $this->initialize($categoryModel);
    }

    /**
     * @throws InRiverException
     */
    public function initialize(array $categoryModel): void
    {
        $this->id = $categoryModel['id'] ?? null;
        $this->index = $categoryModel['index'] ?? null;

        $this->name = isset($categoryModel['name'])
            ? new LanguagesObject((array) $categoryModel['name'])
            : InRiver()->model->listLanguages();
    }

    /**
     * @throws InRiverException
     */
    public function create(): self
    {
        $response = (new InRiver)->model->addCategory(
            id: $this->id,
            name: $this->name->toArray(),
            index: $this->index
        );

        return new self((array) $response);
    }

    /**
     * @throws InRiverException
     */
    public function update(): self
    {
        $response = (new InRiver)->model->updateCategory(
            categoryId: $this->id,
            name: $this->name->toArray(),
            index: $this->index
        );

        return new self($response);
    }

    /**
     * @throws InRiverException
     */
    public function delete(): self
    {
        (new InRiver)->model->deleteCategory(
            categoryId: $this->id,
        );

        $this->initialize([]);

        return $this;
    }
}
