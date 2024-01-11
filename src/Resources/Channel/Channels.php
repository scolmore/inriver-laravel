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

    /**
     * @param  int  $channelId
     * @return array
     *
     * Get entity types for channel.
     * Source: https://apieuw.productmarketingcloud.com/swagger/index.html#/Channel/EntityTypes
     */
    public function entityTypes(int $channelId): array
    {
        return $this->inRiver()->request(
            method: 'GET',
            endpoint: $this->endpoint("/{$channelId}/entitytypes")
        );
    }

    /**
     * @param  int  $channelId
     * @param  string  $entityTypeId
     * @return array
     *
     * Get a list of entities in a channel.
     * Source: https://apieuw.productmarketingcloud.com/swagger/index.html#/Channel/GetByLinkEntityType
     */
    public function getByLinkEntityType(int $channelId, string $entityTypeId = ''): array
    {
        return $this->inRiver()->request(
            method: 'GET',
            endpoint: $this->endpoint("/{$channelId}/entitylist"),
            data: [
                'entityTypeId' => $entityTypeId,
            ]
        );
    }
}
