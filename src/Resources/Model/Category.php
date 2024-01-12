<?php

declare(strict_types=1);

namespace Scolmore\InRiver\Resources\Model;

use Scolmore\InRiver\Exceptions\InRiverException;
use Scolmore\InRiver\Objects\Model\CategoryObject;

readonly class Category
{
    public function __construct(
        private Model $model
    ) {
    }

    /**
     * @throws InRiverException
     */
    public function new(): CategoryObject
    {
        return new CategoryObject([]);
    }

    /**
     * @throws InRiverException
     */
    public function list(): array
    {
        return $this->model->getAllCategories();
    }

    /**
     * @throws InRiverException
     */
    public function get(string $id): CategoryObject
    {
        return $this->model->getCategory($id);
    }
}
