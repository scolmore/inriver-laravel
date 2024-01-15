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

    public Languages $languages;
    public FieldSets $fieldsets;
    public Category $category;

    protected string $endpoint = 'model';

    public function __construct(InRiver $inRiver)
    {
        parent::__construct($inRiver);

        $this->setup();
    }

    private function setup(): void
    {
        $this->languages = new Languages($this);
        $this->fieldsets = new FieldSets($this);
        $this->category = new Category($this);
    }

    /**
     * Return available languages.
     *
     * @return array
     *
     * @throws InRiverException
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Model/GetAllLanguages
     */
    public function getAllLanguages(): array
    {
        return $this->inRiver()->request(
            method: 'GET',
            endpoint: $this->endpoint('/languages')
        );
    }

    /**
     * Add a language.
     *
     * @param  string  $languageISOCode
     * @return array
     *
     * @throws InRiverException
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Model/AddLanguage
     */
    public function addLanguage(string $languageISOCode): array
    {
        return $this->inRiver()->request(
            method: 'POST',
            endpoint: $this->endpoint('/languages'),
            data: [
                'name' => $languageISOCode,
            ]
        );
    }

    /**
     * Remove a language.
     *
     * @param  string  $languageISOCode
     * @return null
     *
     * @throws InRiverException
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Model/DeleteLanguage
     */
    public function deleteLanguage(string $languageISOCode): null
    {
        return $this->inRiver()->request(
            method: 'DELETE',
            endpoint: $this->endpoint("/languages/{$languageISOCode}")
        );
    }

    /**
     * Returns available field sets.
     *
     * @return array
     *
     * @throws InRiverException
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Model/GetAllFieldSets
     */
    public function getAllFieldSets(): array
    {
        return $this->inRiver()->request(
            method: 'GET',
            endpoint: $this->endpoint('/fieldsets')
        );
    }

    /**
     * Add a field set.
     *
     * @param  string  $fieldSetId
     * @param  string  $name
     * @param  string  $description
     * @param  string  $entityTypeId
     * @param  array  $fieldTypeIds
     * @return array
     *
     * @throws InRiverException
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Model/AddFieldSet
     */
    public function addFieldSet(
        string $fieldSetId,
        array $name,
        array $description,
        string $entityTypeId,
        array $fieldTypeIds
    ): array {
        return $this->inRiver()->request(
            method: 'POST',
            endpoint: $this->endpoint('/fieldsets'),
            data: [
                'fieldSetId' => $fieldSetId,
                'name' => $name,
                'description' => $description,
                'entityTypeId' => $entityTypeId,
                'fieldTypeIds' => $fieldTypeIds,
            ]
        );
    }

    /**
     * Update a field set.
     *
     * @param  string  $fieldSetId
     * @param  string  $name
     * @param  string  $description
     * @param  string  $entityTypeId
     * @param  array  $fieldTypeIds
     * @return array
     *
     * @throws InRiverException
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Model/UpdateFieldSet
     */
    public function updateFieldSet(
        string $fieldSetId,
        array $name,
        array $description,
        string $entityTypeId,
        array $fieldTypeIds
    ): array {
        return $this->inRiver()->request(
            method: 'PUT',
            endpoint: $this->endpoint("/fieldsets/{$fieldSetId}"),
            data: [
                'fieldSetId' => $fieldSetId,
                'name' => $name,
                'description' => $description,
                'entityTypeId' => $entityTypeId,
                'fieldTypeIds' => $fieldTypeIds,
            ]
        );
    }

    /**
     * Add a field type to a field set.
     *
     * @param  string  $fieldSetId
     * @param  string  $fieldTypeId
     * @return array
     *
     * @throws InRiverException
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Model/AddFieldTypeToFieldSet
     */
    public function addFieldTypeToFieldSet(string $fieldSetId, string $fieldTypeId): array
    {
        return $this->inRiver()->request(
            method: 'PUT',
            endpoint: $this->endpoint("/fieldsets/{$fieldSetId}/{$fieldTypeId}")
        );
    }

    /**
     * Remove a field type from a field set.
     *
     * @param  string  $fieldSetId
     * @param  string  $fieldTypeId
     * @return array
     *
     * @throws InRiverException
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Model/DeleteFieldTypeToFieldSet
     */
    public function deleteFieldTypeToFieldSet(string $fieldSetId, string $fieldTypeId): array
    {
        return $this->inRiver()->request(
            method: 'DELETE',
            endpoint: $this->endpoint("/fieldsets/{$fieldSetId}/{$fieldTypeId}")
        );
    }

    /**
     * Delete a field set.
     *
     * @param  string  $fieldSetId
     * @return null
     *
     * @throws InRiverException
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Model/DeleteFieldSet
     */
    public function deleteFieldSet(string $fieldSetId): null
    {
        return $this->inRiver()->request(
            method: 'DELETE',
            endpoint: $this->endpoint("/fieldsets/{$fieldSetId}")
        );
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
            ->map(fn($categoryModel) => new CategoryObject($categoryModel))
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
     * @return null
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
