<?php

declare(strict_types=1);

namespace Scolmore\InRiver\Resources\Model;

trait FieldSets
{
    /**
     * Returns available field sets.
     *
     * @return array
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
     * @param  string  $fieldSetId
     * @param  string  $name
     * @param  string  $description
     * @param  string  $entityTypeId
     * @param  array  $fieldTypeIds
     * @return array
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Model/AddFieldSet
     */
    public function addFieldSet(
        string $fieldSetId,
        string $name,
        string $description,
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
     */
    public function updateFieldSet(
        string $fieldSetId,
        string $name,
        string $description,
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
     * @return array
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Model/DeleteFieldSet
     */
    public function deleteFieldSet(string $fieldSetId): array
    {
        return $this->inRiver()->request(
            method: 'DELETE',
            endpoint: $this->endpoint("/fieldsets/{$fieldSetId}")
        );
    }
}
