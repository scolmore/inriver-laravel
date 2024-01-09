<?php

declare(strict_types=1);

namespace Scolmore\InRiver\Resources\Entities;

use Scolmore\InRiver\Resources\AbstractResource;

class Entities extends AbstractResource
{
    protected string $endpoint = 'entities';

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
            endpoint: $this->endpoint((string) $entityId)
        );
    }

    public function new(string $entityTypeId): array
    {
        return $this->inRiver()->request(
            method: 'GET',
            endpoint: $this->endpoint(':getempty'),
            data: [
                'entityTypeId' => $entityTypeId,
            ]
        );
    }
}
