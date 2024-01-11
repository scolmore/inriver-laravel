<?php

declare(strict_types=1);

namespace Scolmore\InRiver\Resources\Channel;

use Scolmore\InRiver\Resources\AbstractResource;

class Channels extends AbstractResource
{
    protected string $endpoint = 'channels';

    public function list(): array
    {
        return $this->inRiver()->request(
            method: 'GET',
            endpoint: $this->endpoint
        );
    }

    public function entityTypes(int $channelId): array
    {
        return $this->inRiver()->request(
            method: 'GET',
            endpoint: $this->endpoint("/{$channelId}/entitytypes")
        );
    }

    public function entityList(int $channelId): array
    {
        return $this->inRiver()->request(
            method: 'GET',
            endpoint: $this->endpoint("/{$channelId}/entitylist")
        );
    }
}
