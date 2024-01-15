<?php

declare(strict_types=1);

namespace Scolmore\InRiver\Resources\Model;

use Scolmore\InRiver\Exceptions\InRiverException;
use Scolmore\InRiver\InRiver;
use Scolmore\InRiver\Objects\Model\CategoryObject;
use Scolmore\InRiver\Resources\AbstractResource;

class Model extends AbstractResource
{
    public EntityTypes $entitytypes;
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
        $this->entitytypes = new EntityTypes($this);
        $this->languages = new Languages($this);
        $this->fieldsets = new FieldSets($this);
        $this->category = new Category($this);
    }

    /**
     * Returns available entity types.
     *
     * @param  string  $entityTypeIds  optional, filter types using comma separated list.
     * @return array
     *
     * @throws InRiverException
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Model/GetAllEntityTypesV101
     */
    public function getAllEntityTypes(string $entityTypeIds = ''): array
    {
        $this->inRiver()->version = '1.0.1';

        return $this->inRiver()->request(
            method: 'GET',
            endpoint: $this->endpoint('/entitytypes'),
            data: [
                'entityTypeIds' => $entityTypeIds,
            ]
        );
    }

    /**
     * Adds an entity type.
     *
     * @param  string  $id
     * @param  array  $name
     * @param  bool  $isLinkEntityType
     * @return array
     *
     * @throws InRiverException
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Model/AddEntityType
     */
    public function addEntityType(string $id, array $name, bool $isLinkEntityType): array
    {
        $this->inRiver()->version = '1.0.1';

        return $this->inRiver()->request(
            method: 'POST',
            endpoint: $this->endpoint('/entitytypes'),
            data: [
                'id' => $id,
                'name' => $name,
                'isLinkEntityType' => $isLinkEntityType,
            ]
        );
    }

    /**
     * Gets a single entity type.
     *
     * @param  string  $entityTypeId  ID of the EntityType, such as Product or Item.
     * @return array
     *
     * @throws InRiverException
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Model/GetEntityType
     */
    public function getEntityType(string $entityTypeId): array
    {
        $this->inRiver()->version = '1.0.1';

        return $this->inRiver()->request(
            method: 'GET',
            endpoint: $this->endpoint("/entitytypes/{$entityTypeId}")
        );
    }

    /**
     * Updates an entity type.
     *
     * @param  string  $entityTypeId
     * @param  array  $name
     * @param  bool  $isLinkEntityType
     * @return array
     *
     * @throws InRiverException
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Model/UpdateEntityType
     */
    public function updateEntityType(string $entityTypeId, array $name, bool $isLinkEntityType): array
    {
        $this->inRiver()->version = '1.0.1';

        return $this->inRiver()->request(
            method: 'PUT',
            endpoint: $this->endpoint("/entitytypes/{$entityTypeId}"),
            data: [
                'id' => $entityTypeId,
                'name' => $name,
                'isLinkEntityType' => $isLinkEntityType,
            ]
        );
    }

    /**
     * Deletes an entity type.
     *
     * @param  string  $entityTypeId  ID of the EntityType, such as Product or Item.
     * @return null
     *
     * @throws InRiverException
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Model/DeleteEntityType
     */
    public function deleteEntityType(string $entityTypeId): null
    {
        $this->inRiver()->version = '1.0.1';

        return $this->inRiver()->request(
            method: 'DELETE',
            endpoint: $this->endpoint("/entitytypes/{$entityTypeId}")
        );
    }

    /**
     * Get all field types for a particular entity type.
     *
     * @param  string  $entityTypeId
     * @return array
     *
     * @throws InRiverException
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Model/GetAllFieldTypesForEntityType
     */
    public function getAllFieldTypesForEntityType(string $entityTypeId): array
    {
        $this->inRiver()->version = '1.0.1';

        return $this->inRiver()->request(
            method: 'GET',
            endpoint: $this->endpoint("/entitytypes/{$entityTypeId}/fieldtypes")
        );
    }

    /**
     * Create a new field type.
     *
     * @param  string  $entityTypeId
     * @param  array  $body
     * @return array
     *
     * @throws InRiverException
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Model/AddFieldType
     */
    public function addFieldType(string $entityTypeId, array $body): array
    {
        $this->inRiver()->version = '1.0.1';

        return $this->inRiver()->request(
            method: 'POST',
            endpoint: $this->endpoint("/entitytypes/{$entityTypeId}/fieldtypes"),
            data: $body
        );
    }

    /**
     * Get a single field type.
     *
     * @param  string  $entityTypeId
     * @param  string  $fieldTypeId
     * @return array
     *
     * @throws InRiverException
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Model/GetFieldType
     */
    public function getFieldType(string $entityTypeId, string $fieldTypeId): array
    {
        $this->inRiver()->version = '1.0.1';

        return $this->inRiver()->request(
            method: 'GET',
            endpoint: $this->endpoint("/entitytypes/{$entityTypeId}/fieldtypes/{$fieldTypeId}")
        );
    }

    /**
     * Update an existing field type.
     *
     * @param  string  $entityTypeId
     * @param  string  $fieldTypeId
     * @param  array  $body
     * @return array
     *
     * @throws InRiverException
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Model/UpdateFieldType
     */
    public function updateFieldType(string $entityTypeId, string $fieldTypeId, array $body): array
    {
        $this->inRiver()->version = '1.0.1';

        return $this->inRiver()->request(
            method: 'PUT',
            endpoint: $this->endpoint("/entitytypes/{$entityTypeId}/fieldtypes/{$fieldTypeId}"),
            data: $body
        );
    }

    /**
     * Delete a field type.
     *
     * @param  string  $entityTypeId
     * @param  string  $fieldTypeId
     * @return null
     *
     * @throws InRiverException
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Model/DeleteFieldType
     */
    public function deleteFieldType(string $entityTypeId, string $fieldTypeId): null
    {
        $this->inRiver()->version = '1.0.1';

        return $this->inRiver()->request(
            method: 'DELETE',
            endpoint: $this->endpoint("/entitytypes/{$entityTypeId}/fieldtypes/{$fieldTypeId}")
        );
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
     * @param  array  $name
     * @param  array  $description
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
