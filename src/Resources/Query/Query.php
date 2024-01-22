<?php

declare(strict_types=1);

namespace Scolmore\InRiver\Resources\Query;

use Carbon\Carbon;
use Scolmore\InRiver\Exceptions\InRiverException;
use Scolmore\InRiver\Resources\AbstractResource;

class Query extends AbstractResource
{
    protected string $endpoint = 'query';

    /**
     * @throws InRiverException
     */
    public function updatedSince(Carbon $dateTime, ?string $entityId = null): array
    {
        $entity = $entityId ? [
            'type' => 'EntityTypeId',
            'value' => $entityId,
            'operator' => 'Equal',
        ] : null;

        $search = [
            'systemCriteria' => [
                [
                    'type' => 'LastModified',
                    'operator' => 'GreaterThanOrEqual',
                    'value' => $dateTime->format('Y-m-d\TH:i:s'),
                ],
            ],
            'dataCriteriaOperator' => 'And',
        ];

        if ($entity) {
            $search['systemCriteria'][] = $entity;
        }

        return $this->query($search);
    }

    /**
     * Search for entity id's.
     *
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Query/Query
     */
    public function query(array $query): array
    {
        return $this->inRiver()->request(
            method: 'POST',
            endpoint: $this->endpoint(),
            data: $query
        );
    }
}
