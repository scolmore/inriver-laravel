<?php

declare(strict_types=1);

namespace Scolmore\InRiver\Resources\Model;

use Scolmore\InRiver\Exceptions\InRiverException;
use Scolmore\InRiver\InRiver;
use Scolmore\InRiver\Resources\AbstractResource;

class Model extends AbstractResource
{
    public EntityTypes $entitytypes;

    public Languages $languages;

    public FieldSets $fieldsets;

    public Category $category;

    public Cvls $cvls;

    public SpecificationTemplates $specificationtemplates;

    public RestrictedFields $restrictedfields;

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
        $this->cvls = new Cvls($this);
        $this->specificationtemplates = new SpecificationTemplates($this);
        $this->restrictedfields = new RestrictedFields($this);
    }

    /**
     * Returns available entity types.
     *
     * @param  string  $entityTypeIds  optional, filter types using comma separated list.
     *
     * @throws InRiverException
     *
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
     *
     * @throws InRiverException
     *
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
     *
     * @throws InRiverException
     *
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
     *
     * @throws InRiverException
     *
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
     *
     * @throws InRiverException
     *
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
     *
     * @throws InRiverException
     *
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
     *
     * @throws InRiverException
     *
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
     *
     * @throws InRiverException
     *
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
     *
     * @throws InRiverException
     *
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
     *
     * @throws InRiverException
     *
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
     *
     * @throws InRiverException
     *
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
     *
     * @throws InRiverException
     *
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
     *
     * @throws InRiverException
     *
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
     *
     * @throws InRiverException
     *
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
     *
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Model/AddFieldSet
     */
    public function addFieldSet(array $body): array
    {
        return $this->inRiver()->request(
            method: 'POST',
            endpoint: $this->endpoint('/fieldsets'),
            data: $body
        );
    }

    /**
     * Update a field set.
     *
     *
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Model/UpdateFieldSet
     */
    public function updateFieldSet(string $fieldSetId, array $body): array
    {
        return $this->inRiver()->request(
            method: 'PUT',
            endpoint: $this->endpoint("/fieldsets/{$fieldSetId}"),
            data: $body
        );
    }

    /**
     * Add a field type to a field set.
     *
     *
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Model/AddFieldTypeToFieldSet
     */
    public function addFieldTypeToFieldSet(string $fieldSetId, string $fieldTypeId): null
    {
        return $this->inRiver()->request(
            method: 'PUT',
            endpoint: $this->endpoint("/fieldsets/{$fieldSetId}/{$fieldTypeId}")
        );
    }

    /**
     * Remove a field type from a field set.
     *
     *
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Model/DeleteFieldTypeToFieldSet
     */
    public function deleteFieldTypeToFieldSet(string $fieldSetId, string $fieldTypeId): null
    {
        return $this->inRiver()->request(
            method: 'DELETE',
            endpoint: $this->endpoint("/fieldsets/{$fieldSetId}/{$fieldTypeId}")
        );
    }

    /**
     * Delete a field set.
     *
     *
     * @throws InRiverException
     *
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
     *
     * @throws InRiverException
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
     *
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Model/AddCategory
     */
    public function addCategory(array $body): array
    {
        return $this->inRiver()->request(
            method: 'POST',
            endpoint: $this->endpoint('/category'),
            data: $body
        );
    }

    /**
     * Get a category.
     *
     *
     * @throws InRiverException
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
     *
     * @throws InRiverException
     *
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
     *
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Model/DeleteCategory
     */
    public function deleteCategory(string $categoryId): null
    {
        return $this->inRiver()->request(
            method: 'DELETE',
            endpoint: $this->endpoint("/category/{$categoryId}")
        );
    }

    /**
     * Returns all CVL's.
     *
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Model/GetAllCvls
     */
    public function getAllCvls(): array
    {
        return $this->inRiver()->request(
            method: 'GET',
            endpoint: $this->endpoint('/cvls')
        );
    }

    /**
     * Add a CVL.
     *
     * @param  ?string  $parentId
     *
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Model/AddCvl
     */
    public function addCvl(string $id, ?string $parentId, string $dataType, bool $customValueList): array
    {
        return $this->inRiver()->request(
            method: 'POST',
            endpoint: $this->endpoint('/cvls'),
            data: [
                'id' => $id,
                'parentId' => $parentId,
                'dataType' => $dataType,
                'customValueList' => $customValueList,
            ]
        );
    }

    /**
     * Get a CVL.
     *
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Model/GetCvl
     */
    public function getCvl(string $cvlId): array
    {
        return $this->inRiver()->request(
            method: 'GET',
            endpoint: $this->endpoint("/cvls/{$cvlId}")
        );
    }

    /**
     * Update a CVL.
     *
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Model/UpdateCvl
     */
    public function updateCvl(string $cvlId, ?string $parentId, string $dataType, bool $customValueList): array
    {
        return $this->inRiver()->request(
            method: 'PUT',
            endpoint: $this->endpoint("/cvls/{$cvlId}"),
            data: [
                'id' => $cvlId,
                'parentId' => $parentId,
                'dataType' => $dataType,
                'customValueList' => $customValueList,
            ]
        );
    }

    /**
     * Delete a CVL.
     *
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Model/DeleteCvl
     */
    public function deleteCvl(string $cvlId): null
    {
        return $this->inRiver()->request(
            method: 'DELETE',
            endpoint: $this->endpoint("/cvls/{$cvlId}")
        );
    }

    /**
     * Returns all values for a CVL.
     *
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Model/GetAllCvlValues
     */
    public function getAllCvlValues(string $cvlId): array
    {
        return $this->inRiver()->request(
            method: 'GET',
            endpoint: $this->endpoint("/cvls/{$cvlId}/values")
        );
    }

    /**
     * Create CVL value.
     *
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Model/CreateCvlValue
     */
    public function createCvlValue(string $cvlId, array $body): array
    {
        return $this->inRiver()->request(
            method: 'POST',
            endpoint: $this->endpoint("/cvls/{$cvlId}/values"),
            data: $body
        );
    }

    /**
     * Get CVL value.
     *
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Model/GetCvlValue
     */
    public function getCvlValue(string $cvlId, string $key): array
    {
        return $this->inRiver()->request(
            method: 'GET',
            endpoint: $this->endpoint("/cvls/{$cvlId}/values/{$key}")
        );
    }

    /**
     * Update CVL value.
     *
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Model/UpdateCvlValue
     */
    public function updateCvlValue(string $cvlId, string $key, array $body): array
    {
        return $this->inRiver()->request(
            method: 'PUT',
            endpoint: $this->endpoint("/cvls/{$cvlId}/values/{$key}"),
            data: $body
        );
    }

    /**
     * Delete CVL value.
     *
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Model/DeleteCvlValue
     */
    public function deleteCvlValue(string $cvlId, string $key): null
    {
        return $this->inRiver()->request(
            method: 'DELETE',
            endpoint: $this->endpoint("/cvls/{$cvlId}/values/{$key}")
        );
    }

    /**
     * Returns all specification templates.
     *
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Model/GetAllSpecificationTemplates
     */
    public function getAllSpecificationTemplates(): array
    {
        return $this->inRiver()->request(
            method: 'GET',
            endpoint: $this->endpoint('/specificationtemplates')
        );
    }

    /**
     * Return field types for specification template.
     *
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Model/GetSpecificationTemplatesields
     */
    public function getSpecificationTemplateFields(int $templateId): array
    {
        return $this->inRiver()->request(
            method: 'GET',
            endpoint: $this->endpoint("/specificationtemplates/{$templateId}/fieldtypes")
        );
    }

    /**
     * Get all restricted field permissions.
     *
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Model/GetAllRestrictedFieldPermission
     */
    public function getAllRestrictedFieldPermission(): array
    {
        return $this->inRiver()->request(
            method: 'GET',
            endpoint: $this->endpoint('/restrictedfields')
        );
    }

    /**
     * Add a restricted field permission.
     *
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Model/AddRestrictedFieldPermission
     */
    public function addRestrictedFieldPermission(array $body): array
    {
        return $this->inRiver()->request(
            method: 'POST',
            endpoint: $this->endpoint('/restrictedfields'),
            data: $body
        );
    }

    /**
     * Get a restricted field permission.
     *
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Model/GetRestrictedFieldPermission
     */
    public function getRestrictedFieldPermission(int $restrictedFieldId): array
    {
        return $this->inRiver()->request(
            method: 'GET',
            endpoint: $this->endpoint("/restrictedfields/{$restrictedFieldId}")
        );
    }

    /**
     * Delete a specific restricted field permission.
     *
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Model/DeleteRestrictedFieldPermission
     */
    public function deleteRestrictedFieldPermission(int $restrictedFieldId): null
    {
        return $this->inRiver()->request(
            method: 'DELETE',
            endpoint: $this->endpoint("/restrictedfields/{$restrictedFieldId}")
        );
    }

    /**
     * Delete any restrictions related to a field type.
     *
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Model/DeleteRestrictedFieldPermission
     */
    public function deleteRestrictedFieldPermissionByFieldType(string $fieldTypeId): null
    {
        return $this->inRiver()->request(
            method: 'DELETE',
            endpoint: $this->endpoint('/restrictedfields:byfieldtype')
        );
    }
}
