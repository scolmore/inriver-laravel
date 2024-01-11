<?php

declare(strict_types=1);

namespace Scolmore\InRiver\Resources\Channel;

use Scolmore\InRiver\Resources\AbstractResource;

class Channels extends AbstractResource
{
    protected string $endpoint = 'channels';

    /**
     * @param  int|null  $forEntityId
     * @param  bool  $includeChannels
     * @param  bool  $includePublications
     * @return array
     *
     * Get channel id's for entity id.
     * Source: https://apieuw.productmarketingcloud.com/swagger/index.html#/Channel/GetChannelsForEntityId
     */
    public function GetChannelsForEntityId(
        ?int $forEntityId,
        bool $includeChannels = true,
        bool $includePublications = false
    ): array {
        return $this->inRiver()->request(
            method: 'GET',
            endpoint: $this->endpoint,
            data: [
                'forEntityId' => $forEntityId,
                'includeChannels' => $includeChannels,
                'includePublications' => $includePublications,
            ]
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
