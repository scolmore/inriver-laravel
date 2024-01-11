<?php

declare(strict_types=1);

namespace Scolmore\InRiver\Resources\Entity;

use Scolmore\InRiver\Resources\AbstractResource;

class Entities extends AbstractResource
{
    protected string $endpoint = 'entities';

    public function get(int $entityId): EntityDataObject
    {
        $response = $this->getEntityBundle($entityId);

        $data = $response['summary'];
        $data['fieldValues'] = $response['fields'];
        $data['specification'] = $response['specification'];
        $data['links'] = [
            'inbound' => $response['inbound'],
            'outbound' => $response['outbound'],
        ];

        return new EntityDataObject($data);
    }

    public function list(array $entityIds): array
    {
        $body = [
            'entityIds' => $entityIds,
            'objects' => 'EntitySummary,FieldsSummary,FieldValues,SpecificationSummary,SpecificationValues,Media,MediaDetails',
            'inbound' => [
                'linkEntityObjects' => 'EntitySummary,FieldsSummary,FieldValues,SpecificationSummary,SpecificationValues,Media,MediaDetails',
            ],
            'outbound' => [
                'linkEntityObjects' => 'EntitySummary,FieldsSummary,FieldValues,SpecificationSummary,SpecificationValues,Media,MediaDetails',
            ],
        ];

        return $this->fetchData($body);
    }

    /**
     * @param  array  $body
     * @return array
     *
     * Returns various types of entity data.
     * Source: https://apieuw.productmarketingcloud.com/swagger/index.html#/Entity/FetchData
     */
    public function fetchData(array $body): array
    {
        $this->inRiver()->version = '1.0.1';

        return $this->inRiver()->request(
            method: 'POST',
            endpoint: $this->endpoint(':fetchdata'),
            data: $body
        );
    }

    /**
     * @param  array  $body
     * @return array
     *
     * Insert or update entities and links.
     * Source: https://apieuw.productmarketingcloud.com/swagger/index.html#/Entity/Upsert
     */
    public function upsert(array $body): array
    {
        return $this->inRiver()->request(
            method: 'POST',
            endpoint: $this->endpoint(':upsert'),
            data: $body
        );
    }

    /**
     * @param  int  $entityId
     * @return array
     *
     * Returns a read only entity summary.
     * Source: https://apieuw.productmarketingcloud.com/swagger/index.html#/Entity/GetEntitySummary
     */
    public function getEntitySummary(int $entityId): array
    {
        return $this->inRiver()->request(
            method: 'GET',
            endpoint: $this->endpoint("/{$entityId}/summary")
        );
    }

    /**
     * @param  int  $entityId
     * @return array
     *
     * Deletes an entity.
     * Source: https://apieuw.productmarketingcloud.com/swagger/index.html#/Entity/DeleteEntity
     */
    public function deleteEntity(int $entityId): array
    {
        return $this->inRiver()->request(
            method: 'DELETE',
            endpoint: $this->endpoint("/{$entityId}")
        );
    }

    /**
     * @param  array  $entity
     * @return array
     *
     * Creates a new entity.
     * Source: https://apieuw.productmarketingcloud.com/swagger/index.html#/Entity/CreateEntity
     */
    public function createEntity(array $entity): array
    {
        return $this->inRiver()->request(
            method: 'POST',
            endpoint: $this->endpoint(':createnew'),
            data: $entity
        );
    }

    /**
     * @param  string  $entityTypeId
     * @param  string|null  $fieldSet
     * @return EntityDataObject
     *
     * Returns an entity creation model.
     * Source: https://apieuw.productmarketingcloud.com/swagger/index.html#/Entity/GetEmptyEntity
     */
    public function getEmptyEntity(string $entityTypeId, ?string $fieldSet = null): EntityDataObject
    {
        $response = $this->inRiver()->request(
            method: 'GET',
            endpoint: $this->endpoint(':getempty'),
            data: [
                'entityTypeId' => $entityTypeId,
                'fieldSetId' => $fieldSet,
            ]
        );

        return new EntityDataObject($response);
    }

    /**
     * @param  array  $body
     * @return array
     *
     * Returns a dictionary of unique values and entity id's.
     * Source: https://apieuw.productmarketingcloud.com/swagger/index.html#/Entity/MapUniqueValues
     */
    public function mapUniqueValues(array $body): array
    {
        return $this->inRiver()->request(
            method: 'POST',
            endpoint: $this->endpoint(':mapuniquevalues'),
            data: $body
        );
    }

    /**
     * @param  int  $entityId
     * @return array
     *
     * Returns a completeness details.
     * Source: https://apieuw.productmarketingcloud.com/swagger/index.html#/Entity/CompletenessDetails
     */
    public function completenessDetails(int $entityId): array
    {
        return $this->inRiver()->request(
            method: 'GET',
            endpoint: $this->endpoint("/{$entityId}/completenessdetails")
        );
    }

    /**
     * @param  int  $entityId
     * @param  string  $fieldTypeIds
     * @return array
     *
     * Returns a read only list of field values.
     * Source: https://apieuw.productmarketingcloud.com/swagger/index.html#/Entity/GetFields
     */
    public function getFields(int $entityId, string $fieldTypeIds = ''): array
    {
        return $this->inRiver()->request(
            method: 'GET',
            endpoint: $this->endpoint("/{$entityId}/summary/fields"),
            data: [
                'fieldTypeIds' => $fieldTypeIds,
            ]
        );
    }

    /**
     * @param  int  $entityId
     * @param  string  $fieldTypeIds
     * @return array
     *
     * Returns a list of field values.
     * Source: https://apieuw.productmarketingcloud.com/swagger/index.html#/Entity/GetFieldValues
     */
    public function getFieldValues(int $entityId, string $fieldTypeIds = ''): array
    {
        return $this->inRiver()->request(
            method: 'GET',
            endpoint: $this->endpoint("/{$entityId}/fieldvalues"),
            data: [
                'fieldTypeIds' => $fieldTypeIds,
            ]
        );
    }

    /**
     * @param  int  $entityId
     * @param  array  $fieldValues
     * @return array
     *
     * Update field values.
     * Source: https://apieuw.productmarketingcloud.com/swagger/index.html#/Entity/SetFieldValues
     */
    public function setFieldValues(int $entityId, array $fieldValues): array
    {
        return $this->inRiver()->request(
            method: 'PUT',
            endpoint: $this->endpoint("/{$entityId}/fieldvalues"),
            data: $fieldValues
        );
    }

    /**
     * @param  int  $entityId
     * @param  string  $fieldTypeId
     * @return array
     *
     * Field value revisions.
     * Source: https://apieuw.productmarketingcloud.com/swagger/index.html#/Entity/FieldHistory
     */
    public function fieldHistory(int $entityId, string $fieldTypeId): array
    {
        return $this->inRiver()->request(
            method: 'GET',
            endpoint: $this->endpoint("/{$entityId}/fieldvalues/{$fieldTypeId}/revisions")
        );
    }

    /**
     * @param  int  $entityId
     * @param  ?string  $fieldSetId
     * @param  bool  $wipeOtherFields
     * @return array
     *
     * Set field set (set fieldSetId to null to remove field set).
     * Source: https://apieuw.productmarketingcloud.com/swagger/index.html#/Entity/SetFieldSet
     */
    public function setFieldSet(int $entityId, ?string $fieldSetId, bool $wipeOtherFields): array
    {
        return $this->inRiver()->request(
            method: 'PUT',
            endpoint: $this->endpoint("/{$entityId}/fieldset"),
            data: [
                'fieldSetId' => $fieldSetId,
                'wipeOtherFields' => $wipeOtherFields,
            ]
        );
    }

    /**
     * @param  int  $entityId
     * @param  string  $specificationFieldTypeIds
     * @return array
     *
     * Returns a read only list of specification field values.
     * Source: https://apieuw.productmarketingcloud.com/swagger/index.html#/Entity/GetSpecificationSummary
     */
    public function getSpecificationSummary(int $entityId, string $specificationFieldTypeIds = ''): array
    {
        return $this->inRiver()->request(
            method: 'GET',
            endpoint: $this->endpoint("/{$entityId}/summary/specification"),
            data: [
                'specificationFieldTypeIds' => $specificationFieldTypeIds,
            ]
        );
    }

    /**
     * @param  int  $entityId
     * @param  string  $specificationFieldTypeIds
     * @param  bool  $mandatoryOnly
     * @return array
     *
     * Returns a list of specification field values.
     * Source: https://apieuw.productmarketingcloud.com/swagger/index.html#/Entity/GetSpecificationValues
     */
    public function getSpecificationValues(
        int $entityId,
        string $specificationFieldTypeIds = '',
        bool $mandatoryOnly = false
    ): array {
        return $this->inRiver()->request(
            method: 'GET',
            endpoint: $this->endpoint("/{$entityId}/specificationvalues"),
            data: [
                'specificationFieldTypeIds' => $specificationFieldTypeIds,
                'mandatoryOnly' => $mandatoryOnly,
            ]
        );
    }

    /**
     * @param  int  $entityId
     * @param  array  $specificationValues
     * @return array
     *
     * Update specification field values.
     * Source: https://apieuw.productmarketingcloud.com/swagger/index.html#/Entity/UpdateSpecificationValues
     */
    public function updateSpecificationValues(int $entityId, array $specificationValues): array
    {
        return $this->inRiver()->request(
            method: 'PUT',
            endpoint: $this->endpoint("/{$entityId}/specificationvalues"),
            data: $specificationValues
        );
    }

    /**
     * @param  int  $entityId
     * @param  int  $specificationId
     * @return array
     *
     * Set specification template.
     * Source: https://apieuw.productmarketingcloud.com/swagger/index.html#/Entity/SetSpecificationTemplate
     */
    public function setSpecificationTemplate(int $entityId, int $specificationId): array
    {
        return $this->inRiver()->request(
            method: 'PUT',
            endpoint: $this->endpoint("/{$entityId}/specificationtemplate"),
            data: [
                'specificationId' => $specificationId,
            ]
        );
    }

    /**
     * @param  int  $entityId
     * @param  int  $segmentId
     * @return array
     *
     * Set entity segment.
     * Source: https://apieuw.productmarketingcloud.com/swagger/index.html#/Entity/SetSegment
     */
    public function setSegment(int $entityId, int $segmentId): array
    {
        return $this->inRiver()->request(
            method: 'PUT',
            endpoint: $this->endpoint("/{$entityId}/segment"),
            data: [
                'segmentId' => $segmentId,
            ]
        );
    }

    /**
     * @param  int  $entityId
     * @param  string  $linkDirection
     * @param  string  $linkTypeId
     * @return array
     *
     * Returns a list of links.
     * Source: https://apieuw.productmarketingcloud.com/swagger/index.html#/Entity/GetLinksForEntity
     */
    public function getLinksForEntity(int $entityId, string $linkDirection = '', string $linkTypeId = ''): array
    {
        return $this->inRiver()->request(
            method: 'GET',
            endpoint: $this->endpoint("/{$entityId}/links"),
            data: [
                'linkDirection' => $linkDirection,
                'linkTypeId' => $linkTypeId,
            ]
        );
    }

    /**
     * @param  int  $entityId
     * @param  string  $fieldTypeIds
     * @param  string  $linkDirection
     * @param  string  $linkTypeId
     * @return array
     *
     * Returns a bundle of the entity and all linked entities.
     * Source: https://apieuw.productmarketingcloud.com/swagger/index.html#/Entity/GetEntityBundle
     */
    public function getEntityBundle(
        int $entityId,
        string $fieldTypeIds = '',
        string $linkDirection = '',
        string $linkTypeId = ''
    ): array {
        return $this->inRiver()->request(
            method: 'GET',
            endpoint: $this->endpoint("/{$entityId}/linksandfields"),
            data: [
                'fieldTypeIds' => $fieldTypeIds,
                'linkDirection' => $linkDirection,
                'linkTypeId' => $linkTypeId,
            ]
        );
    }

    /**
     * @param  int  $entityId
     * @return array
     *
     * Returns a read only list of media resources linked to the entity.
     * Source: https://apieuw.productmarketingcloud.com/swagger/index.html#/Entity/GetAllMedia
     */
    public function getAllMedia(int $entityId): array
    {
        return $this->inRiver()->request(
            method: 'GET',
            endpoint: $this->endpoint("/{$entityId}/media")
        );
    }

    /**
     * @param  int  $entityId
     * @return array
     *
     * Returns a read only detailed list of media resources linked to the entity.
     * Source: https://apieuw.productmarketingcloud.com/swagger/index.html#/Entity/GetMediaDetails
     */
    public function getMediaDetails(int $entityId): array
    {
        return $this->inRiver()->request(
            method: 'GET',
            endpoint: $this->endpoint("/{$entityId}/mediadetails")
        );
    }

    /**
     * @param  int  $entityId
     * @param  string  $fileName
     * @param  string  $data
     * @return array
     *
     * Add Media.
     * Source: https://apieuw.productmarketingcloud.com/swagger/index.html#/Entity/UploadBase64File
     */
    public function uploadBase64File(int $entityId, string $fileName, string $data): array
    {
        return $this->inRiver()->request(
            method: 'POST',
            endpoint: $this->endpoint("/{$entityId}/media:uploadbase64"),
            data: [
                'fileName' => $fileName,
                'data' => $data,
            ]
        );
    }

    /**
     * @param  int  $entityId
     * @param  string  $url
     * @param  string  $overrideUrlFileName
     * @return array
     *
     * Add Media from URL.
     * Source: https://apieuw.productmarketingcloud.com/swagger/index.html#/Entity/UploadMediaFromUrl
     */
    public function uploadMediaFromUrl(int $entityId, string $url, string $overrideUrlFileName): array
    {
        return $this->inRiver()->request(
            method: 'POST',
            endpoint: $this->endpoint("/{$entityId}/media:uploadfromurl"),
            data: [
                'url' => $url,
                'overrideUrlFileName' => $overrideUrlFileName,
            ]
        );
    }

    /**
     * @param  int  $entityId
     * @param  string  $url
     * @param  string  $overrideUrlFileName
     * @return array
     *
     * Add external media URL.
     * Source: https://apieuw.productmarketingcloud.com/swagger/index.html#/Entity/AddExternalUrl
     */
    public function addExternalUrl(int $entityId, string $url, string $overrideUrlFileName): array
    {
        return $this->inRiver()->request(
            method: 'POST',
            endpoint: $this->endpoint("/{$entityId}/media:addexternalurl"),
            data: [
                'url' => $url,
                'overrideUrlFileName' => $overrideUrlFileName,
            ]
        );
    }

    /**
     * @param  int  $entityId
     * @return array
     *
     * Entity comments.
     * Source: https://apieuw.productmarketingcloud.com/swagger/index.html#/Entity/Comments
     */
    public function comments(int $entityId): array
    {
        return $this->inRiver()->request(
            method: 'GET',
            endpoint: $this->endpoint("/{$entityId}/comments")
        );
    }

    /**
     * @param  int  $entityId
     * @param  string  $text
     * @return array
     *
     * Post entity comment.
     * Source: https://apieuw.productmarketingcloud.com/swagger/index.html#/Entity/CreateComment
     */
    public function createComment(int $entityId, string $text): array
    {
        return $this->inRiver()->request(
            method: 'POST',
            endpoint: $this->endpoint("/{$entityId}/comments"),
            data: [
                'text' => $text,
            ]
        );
    }

    /**
     * @param  int  $entityId
     * @param  int  $commentId
     * @return array
     *
     * Delete entity comment.
     * Source: https://apieuw.productmarketingcloud.com/swagger/index.html#/Entity/DeleteComment
     */
    public function deleteComment(int $entityId, int $commentId): array
    {
        return $this->inRiver()->request(
            method: 'DELETE',
            endpoint: $this->endpoint("/{$entityId}/comments/{$commentId}")
        );
    }

    /**
     * @return array
     *
     * Get list of starred entities.
     * Source: https://apieuw.productmarketingcloud.com/swagger/index.html#/Entity/StarredEntities
     */
    public function starredEntities(): array
    {
        return $this->inRiver()->request(
            method: 'GET',
            endpoint: $this->endpoint('/starred')
        );
    }

    /**
     * @param  array  $entityIds
     * @return array
     *
     * Update list of starred entities.
     * Source: https://apieuw.productmarketingcloud.com/swagger/index.html#/Entity/UpdateStarredEntities
     */
    public function updateStarredEntities(array $entityIds): array
    {
        return $this->inRiver()->request(
            method: 'PUT',
            endpoint: $this->endpoint('/starred'),
            data: $entityIds
        );
    }

    /**
     * @return array
     *
     * Get all segments.
     * Source: https://apieuw.productmarketingcloud.com/swagger/index.html#/Entity/GetAllSegments
     */
    public function getAllSegments(): array
    {
        return $this->inRiver()->request(
            method: 'GET',
            endpoint: $this->endpoint('/segments')
        );
    }
}