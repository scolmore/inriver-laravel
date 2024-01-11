<?php

declare(strict_types=1);

namespace Scolmore\InRiver\Resources\Entities;

use Scolmore\InRiver\Resources\AbstractResource;

class Entities extends AbstractResource
{
    protected string $endpoint = 'entities';

    public function get(int $entityId): EntityDataObject
    {
        $response = $this->inRiver()->request(
            method: 'GET',
            endpoint: $this->endpoint("/{$entityId}/linksandfields")
        );

        $data = $response['summary'];
        $data['fieldValues'] = $response['fields'];
        $data['specification'] = $response['specification'];
        $data['links'] = [
            'inbound' => $response['inbound'],
            'outbound' => $response['outbound'],
        ];

        return new EntityDataObject($data);
    }

    public function fetchData(array $objects): array
    {
        $this->inRiver()->version = '1.0.1';

        return $this->inRiver()->request(
            method: 'POST',
            endpoint: $this->endpoint(':fetchdata'),
            data: $objects
        );
    }

    public function list(array $entityIds): array
    {
        $this->inRiver()->version = '1.0.1';

        return $this->inRiver()->request(
            method: 'POST',
            endpoint: $this->endpoint(':fetchdata'),
            data: [
                'entityIds' => $entityIds,
                'objects' => 'EntitySummary,FieldsSummary,FieldValues,SpecificationSummary,SpecificationValues,Media,MediaDetails',
                'inbound' => [
                    'linkEntityObjects' => 'EntitySummary,FieldsSummary,FieldValues,SpecificationSummary,SpecificationValues,Media,MediaDetails',
                ],
                'outbound' => [
                    'linkEntityObjects' => 'EntitySummary,FieldsSummary,FieldValues,SpecificationSummary,SpecificationValues,Media,MediaDetails',
                ]
            ]
        );
    }

    public function summary(int $entityId): array
    {
        return $this->inRiver()->request(
            method: 'GET',
            endpoint: $this->endpoint("/{$entityId}/summary")
        );
    }

    public function delete(int $entityId): array
    {
        return $this->inRiver()->request(
            method: 'DELETE',
            endpoint: $this->endpoint("/{$entityId}")
        );
    }

    public function new(string $entityTypeId, ?string $fieldSet = null): EntityDataObject
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

    public function createNew(array $entity): array
    {
        return $this->inRiver()->request(
            method: 'POST',
            endpoint: $this->endpoint(':createnew'),
            data: $entity
        );
    }

    public function updateFieldValues(int $entityId, array $fieldValues): array
    {
        return $this->inRiver()->request(
            method: 'PUT',
            endpoint: $this->endpoint("/{$entityId}/fieldvalues"),
            data: $fieldValues
        );
    }

    public function completenessDetails(int $entityId): array
    {
        return $this->inRiver()->request(
            method: 'GET',
            endpoint: $this->endpoint("/{$entityId}/completenessdetails")
        );
    }

    public function fieldSummary(int $entityId, string $fieldTypeIds = ''): array
    {
        return $this->inRiver()->request(
            method: 'GET',
            endpoint: $this->endpoint("/{$entityId}/summary/fields"),
            data: [
                'fieldTypeIds' => $fieldTypeIds,
            ]
        );
    }

    public function fieldValues(int $entityId, string $fieldTypeIds = ''): array
    {
        return $this->inRiver()->request(
            method: 'GET',
            endpoint: $this->endpoint("/{$entityId}/fieldvalues"),
            data: [
                'fieldTypeIds' => $fieldTypeIds,
            ]
        );
    }
}
