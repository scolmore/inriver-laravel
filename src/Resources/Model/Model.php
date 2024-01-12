<?php

declare(strict_types=1);

namespace Scolmore\InRiver\Resources\Model;

use Scolmore\InRiver\Exceptions\InRiverException;
use Scolmore\InRiver\InRiver;
use Scolmore\InRiver\Objects\Model\CategoryObject;
use Scolmore\InRiver\Resources\AbstractResource;

class Model extends AbstractResource
{
    use EntityTypes;
    use Languages;
    use FieldSets;

    public Category $category;

    protected string $endpoint = 'model';

    public function __construct(InRiver $inRiver)
    {
        parent::__construct($inRiver);

        $this->setup();
    }

    private function setup(): void
    {
        $this->category = new Category($this);
    }

    /**
     * Get all categories.
     *
     * @return array
     *
     * @throws InRiverException
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Model/GetAllCategories
     */
    public function getAllCategories(): array
    {
        $response = $this->inRiver()->request(
            method: 'GET',
            endpoint: $this->endpoint('/category')
        );

        return collect($response)
            ->map(fn ($categoryModel) => new CategoryObject($categoryModel))
            ->toArray();
    }

    /**
     * Add a category.
     *
     * @param  string  $id
     * @param  array  $name
     * @param  int  $index
     * @return CategoryObject
     *
     * @throws InRiverException
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Model/AddCategory
     */
    public function addCategory(string $id, array $name, int $index = 0): CategoryObject
    {
        $response = $this->inRiver()->request(
            method: 'POST',
            endpoint: $this->endpoint('/category'),
            data: [
                'id' => $id,
                'name' => $name,
                'index' => $index,
            ]
        );

        return new CategoryObject($response);
    }

    /**
     * Get a category.
     *
     * @param  string  $categoryId
     * @return CategoryObject
     *
     * @throws InRiverException
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Model/GetCategory
     */
    public function getCategory(string $categoryId): CategoryObject
    {
        $response = $this->inRiver()->request(
            method: 'GET',
            endpoint: $this->endpoint("/category/{$categoryId}")
        );

        return new CategoryObject($response);
    }

    /**
     * Update a category.
     *
     * @param  string  $categoryId
     * @param  array  $name
     * @param  int  $index
     * @return array
     *
     * @throws InRiverException
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Model/UpdateCategory
     */
    public function updateCategory(string $categoryId, array $name, int $index = 0): array
    {
        return $this->inRiver()->request(
            method: 'PUT',
            endpoint: $this->endpoint("/category/{$categoryId}"),
            data: [
                'id' => $categoryId,
                'name' => $name,
                'index' => $index,
            ]
        );
    }

    /**
     * Delete a category.
     *
     * @param  string  $categoryId
     * @return array
     *
     * @throws InRiverException
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Model/DeleteCategory
     */
    public function deleteCategory(string $categoryId): null
    {
        return $this->inRiver()->request(
            method: 'DELETE',
            endpoint: $this->endpoint("/category/{$categoryId}")
        );
    }
}
