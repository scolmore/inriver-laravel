<?php

declare(strict_types=1);

namespace Scolmore\InRiver\Resources\Model;

trait EntityTypes
{
    /**
     * Returns available entity types.
     *
     * @param  string  $entityTypeIds optional, filter types using comma separated list.
     * @return array
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Model/GetAllEntityTypesV101
     */
    public function getAllEntityTypes(string $entityTypeIds = ''): array
    {
        $this->inRiver()->version = '1.0.1';

        return $this->inRiver()->request(
            method: 'GET',
            endpoint: $this->endpoint('/entitytypes')
        );
    }

    /**
     * Adds an entity type.
     *
     * @param  string  $id
     * @param  string  $name
     * @param  bool  $isLinkedEntityType
     * @return array
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Model/AddEntityType
     */
    public function addEntityType(string $id, string $name, bool $isLinkedEntityType): array
    {
        $this->inRiver()->version = '1.0.1';

        return $this->inRiver()->request(
            method: 'POST',
            endpoint: $this->endpoint('/entitytypes'),
            data: [
                'id' => $id,
                'name' => $name,
                'isLinkedEntityType' => $isLinkedEntityType,
            ]
        );
    }

    /**
     * Gets a single entity type.
     *
     * @param  string  $entityTypeId ID of the EntityType, such as Product or Item.
     * @return array
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
     * @param  string  $entityTypeId
     * @param  string  $name
     * @param  bool  $isLinkedEntityType
     * @return array
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Model/UpdateEntityType
     */
    public function updateEntityType(string $entityTypeId, string $name, bool $isLinkedEntityType): array
    {
        $this->inRiver()->version = '1.0.1';

        return $this->inRiver()->request(
            method: 'PUT',
            endpoint: $this->endpoint("/entitytypes/{$entityTypeId}"),
            data: [
                'name' => $name,
                'isLinkedEntityType' => $isLinkedEntityType,
            ]
        );
    }

    /**
     * Deletes an entity type.
     *
     * @param  string  $entityTypeId ID of the EntityType, such as Product or Item.
     * @return array
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Model/DeleteEntityType
     */
    public function deleteEntityType(string $entityTypeId): array
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
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Model/AddFieldType
     */
    public function addFieldType(string $entityTypeId, array $body): array
    {
        $this->inRiver()->version = '1.0.1';

        return $this->inRiver()->request(
            method: 'POST',
            endpoint: $this->endpoint('/fieldtypes'),
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
     * @return array
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Model/DeleteFieldType
     */
    public function deleteFieldType(string $entityTypeId, string $fieldTypeId): array
    {
        $this->inRiver()->version = '1.0.1';

        return $this->inRiver()->request(
            method: 'DELETE',
            endpoint: $this->endpoint("/entitytypes/{$entityTypeId}/fieldtypes/{$fieldTypeId}")
        );
    }
}
