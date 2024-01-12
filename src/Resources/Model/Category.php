<?php

declare(strict_types=1);

namespace Scolmore\InRiver\Resources\Model;

trait Category
{
    /**
     * Get all categories.
     *
     * @return array
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Model/GetAllCategories
     */
    public function getAllCategories(): array
    {
        return $this->inRiver()->request(
            method: 'GET',
            endpoint: $this->endpoint('/category')
        );
    }

    /**
     * Add a category.
     *
     * @param  string  $id
     * @param  string  $name
     * @return array
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Model/AddCategory
     */
    public function addCategory(string $id, string $name): array
    {
        return $this->inRiver()->request(
            method: 'POST',
            endpoint: $this->endpoint('/category'),
            data: [
                'id' => $id,
                'name' => $name,
            ]
        );
    }

    /**
     * Get a category.
     *
     * @param  string  $categoryId
     * @return array
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Model/GetCategory
     */
    public function getCategory(string $categoryId): array
    {
        return $this->inRiver()->request(
            method: 'GET',
            endpoint: $this->endpoint("/category/{$categoryId}")
        );
    }

    /**
     * Update a category.
     *
     * @param  string  $categoryId
     * @param  string  $name
     * @return array
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Model/UpdateCategory
     */
    public function updateCategory(string $categoryId, string $name): array
    {
        return $this->inRiver()->request(
            method: 'PUT',
            endpoint: $this->endpoint("/category/{$categoryId}"),
            data: [
                'name' => $name,
            ]
        );
    }

    /**
     * Delete a category.
     *
     * @param  string  $categoryId
     * @return array
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Model/DeleteCategory
     */
    public function deleteCategory(string $categoryId): array
    {
        return $this->inRiver()->request(
            method: 'DELETE',
            endpoint: $this->endpoint("/category/{$categoryId}")
        );
    }
}
