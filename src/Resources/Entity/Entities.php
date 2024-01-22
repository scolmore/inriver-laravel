<?php

declare(strict_types=1);

namespace Scolmore\InRiver\Resources\Entity;

use Scolmore\InRiver\Exceptions\InRiverException;
use Scolmore\InRiver\Objects\Entity\EntityObject;
use Scolmore\InRiver\Resources\AbstractResource;

class Entities extends AbstractResource
{
    protected string $endpoint = 'entities';

    /**
     * @throws InRiverException
     */
    public function new(string $entityTypeId, ?string $fieldSetId = null, bool $allFields = false): EntityObject
    {
        return new EntityObject(
            $this->getEmptyEntity(
                entityTypeId: $entityTypeId,
                fieldSetId: $fieldSetId,
                allFields: $allFields
            )
        );
    }

    /**
     * @throws InRiverException
     */
    public function get(int $entityId): EntityObject
    {
        $response = $this->getEntityBundle($entityId);

        $data = $response['summary'];
        $data['fieldValues'] = $response['fields'];
        $data['specification'] = $response['specification'];
        $data['links'] = [
            'inbound' => $response['inbound'],
            'outbound' => $response['outbound'],
        ];

        return new EntityObject($data);
    }

    /**
     * @throws InRiverException
     */
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
     * Returns various types of entity data.
     *
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Entity/FetchData
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
     * Insert or update entities and links.
     *
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Entity/Upsert
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
     * Returns a read only entity summary.
     *
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Entity/GetEntitySummary
     */
    public function getEntitySummary(int $entityId): array
    {
        return $this->inRiver()->request(
            method: 'GET',
            endpoint: $this->endpoint("/{$entityId}/summary")
        );
    }

    /**
     * Deletes an entity.
     *
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Entity/DeleteEntity
     */
    public function deleteEntity(int $entityId): null
    {
        return $this->inRiver()->request(
            method: 'DELETE',
            endpoint: $this->endpoint("/{$entityId}")
        );
    }

    /**
     * Creates a new entity.
     *
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Entity/CreateEntity
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
     * Returns an entity creation model.
     *
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Entity/GetEmptyEntity
     */
    public function getEmptyEntity(string $entityTypeId, ?string $fieldSetId = null, bool $allFields = false): array
    {
        return $this->inRiver()->request(
            method: 'GET',
            endpoint: $this->endpoint(':getempty'),
            data: [
                'entityTypeId' => $entityTypeId,
                'fieldSetId' => $fieldSetId,
                'allFields' => $allFields ? 'true' : 'false',
            ]
        );
    }

    /**
     * Returns a dictionary of unique values and entity id's.
     *
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Entity/MapUniqueValues
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
     * Returns a completeness details.
     *
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Entity/CompletenessDetails
     */
    public function completenessDetails(int $entityId): array
    {
        return $this->inRiver()->request(
            method: 'GET',
            endpoint: $this->endpoint("/{$entityId}/completenessdetails")
        );
    }

    /**
     * Returns a read only list of field values.
     *
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Entity/GetFields
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
     * Returns a list of field values.
     *
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Entity/GetFieldValues
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
     * Update field values.
     *
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Entity/SetFieldValues
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
     * Field value revisions.
     *
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Entity/FieldHistory
     */
    public function fieldHistory(int $entityId, string $fieldTypeId): array
    {
        return $this->inRiver()->request(
            method: 'GET',
            endpoint: $this->endpoint("/{$entityId}/fieldvalues/{$fieldTypeId}/revisions")
        );
    }

    /**
     * Set field set (set fieldSetId to null to remove field set).
     *
     * @param  ?string  $fieldSetId
     *
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Entity/SetFieldSet
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
     * Returns a read only list of specification field values.
     *
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Entity/GetSpecificationSummary
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
     * Returns a list of specification field values.
     *
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Entity/GetSpecificationValues
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
     * Update specification field values.
     *
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Entity/UpdateSpecificationValues
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
     * Set specification template.
     *
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Entity/SetSpecificationTemplate
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
     * Set entity segment.
     *
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Entity/SetSegment
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
     * Returns a list of links.
     *
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Entity/GetLinksForEntity
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
     * Returns a bundle of the entity and all linked entities.
     *
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Entity/GetEntityBundle
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
     * Returns a read only list of media resources linked to the entity.
     *
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Entity/GetAllMedia
     */
    public function getAllMedia(int $entityId): array
    {
        return $this->inRiver()->request(
            method: 'GET',
            endpoint: $this->endpoint("/{$entityId}/media")
        );
    }

    /**
     * Returns a read only detailed list of media resources linked to the entity.
     *
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Entity/GetMediaDetails
     */
    public function getMediaDetails(int $entityId): array
    {
        return $this->inRiver()->request(
            method: 'GET',
            endpoint: $this->endpoint("/{$entityId}/mediadetails")
        );
    }

    /**
     * Add Media.
     *
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Entity/UploadBase64File
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
     * Add Media from URL.
     *
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Entity/UploadMediaFromUrl
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
     * Add external media URL.
     *
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Entity/AddExternalUrl
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
     * Entity comments.
     *
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Entity/Comments
     */
    public function comments(int $entityId): array
    {
        return $this->inRiver()->request(
            method: 'GET',
            endpoint: $this->endpoint("/{$entityId}/comments")
        );
    }

    /**
     * Post entity comment.
     *
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Entity/CreateComment
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
     * Delete entity comment.
     *
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Entity/DeleteComment
     */
    public function deleteComment(int $entityId, int $commentId): null
    {
        return $this->inRiver()->request(
            method: 'DELETE',
            endpoint: $this->endpoint("/{$entityId}/comments/{$commentId}")
        );
    }

    /**
     * Get list of starred entities.
     *
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Entity/StarredEntities
     */
    public function starredEntities(): array
    {
        return $this->inRiver()->request(
            method: 'GET',
            endpoint: $this->endpoint('/starred')
        );
    }

    /**
     * Update list of starred entities.
     *
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Entity/UpdateStarredEntities
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
     * Get all segments.
     *
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Entity/GetAllSegments
     */
    public function getAllSegments(): array
    {
        return $this->inRiver()->request(
            method: 'GET',
            endpoint: $this->endpoint('/segments')
        );
    }
}
