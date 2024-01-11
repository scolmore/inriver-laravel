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

    /**
     * @param  int  $channelId
     * @param  int  $entityId
     * @param  string  $linkDescription
     * @param  string  $linkTypeId
     * @return array
     *
     * Get entity links.
     * Source: https://apieuw.productmarketingcloud.com/swagger/index.html#/Channel/GetByEntityType
     */
    public function getByEntityType(
        int $channelId,
        int $entityId,
        string $linkDescription = '',
        string $linkTypeId = ''
    ): array {
        return $this->inRiver()->request(
            method: 'GET',
            endpoint: $this->endpoint("/{$channelId}/entities/{$entityId}/links"),
            data: [
                'linkDescription' => $linkDescription,
                'linkTypeId' => $linkTypeId,
            ]
        );
    }

    /**
     * @param  int  $channelId
     * @param  int  $entityId
     * @return array
     *
     * Get structure entities for entity.
     * Source: https://apieuw.productmarketingcloud.com/swagger/index.html#/Channel/GetChannelStructureEntities
     */
    public function getChannelStructureEntities(int $channelId, int $entityId): array
    {
        return $this->inRiver()->request(
            method: 'GET',
            endpoint: $this->endpoint("/{$channelId}/entities/{$entityId}/structureentities")
        );
    }

    /**
     * @param  int  $channelId
     * @return array
     *
     * Channel structure list.
     * Source: https://apieuw.productmarketingcloud.com/swagger/index.html#/Channel/GetChannelNodes
     */
    public function getChannelNodes(int $channelId): array
    {
        return $this->inRiver()->request(
            method: 'GET',
            endpoint: $this->endpoint("/{$channelId}/nodes")
        );
    }

    /**
     * @param  int  $channelId
     * @return array
     *
     * Channel structure tree.
     * Source: https://apieuw.productmarketingcloud.com/swagger/index.html#/Channel/GetChannelNodeTree
     */
    public function getChannelNodeTree(int $channelId): array
    {
        return $this->inRiver()->request(
            method: 'GET',
            endpoint: $this->endpoint("/{$channelId}/nodetree")
        );
    }

    /**
     * @param  string  $path
     * @param  string  $entityTypeIds optional, filter types using comma separated list
     * @return array
     *
     * Channel path content.
     * Source: https://apieuw.productmarketingcloud.com/swagger/index.html#/Channel/ChannelContent
     */
    public function channelContent(string $path, string $entityTypeIds = ''): array
    {
        return $this->inRiver()->request(
            method: 'GET',
            endpoint: $this->endpoint("/content/{$path}"),
            data: [
                'entityTypeIds' => $entityTypeIds,
            ]
        );
    }

    /**
     * @return array
     *
     * Get channel queue messages for a customer environment.
     * Source: https://apieuw.productmarketingcloud.com/swagger/index.html#/Channel/GetChannelMessagesAsync
     */
    public function getChannelMessagesAsync(): array
    {
        return $this->inRiver()->request(
            method: 'GET',
            endpoint: $this->endpoint("/queue")
        );
    }

    /**
     * Get a list of channel entities of the specified entity type.
     *
     * @param  string  $entityTypeId
     * @param  bool  $orphaned True, get ids of entities not included in any channel. False, get ids of entities included in at least one channel.
     * @param  bool|null  $linkRuleEnabled Null, get all entity ids. True, get ids of entities with configured link rules. False, get ids of entities without configured link rules or disabled link rules.
     * @return array
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Channel/GetChannelEntitiesAsync
     */
    public function getChannelEntitiesAsync(string $entityTypeId, bool $orphaned = false, ?bool $linkRuleEnabled = null): array
    {
        return $this->inRiver()->request(
            method: 'GET',
            endpoint: $this->endpoint("/entityIds/{$entityTypeId}"),
            data: [
                'orphaned' => $orphaned,
                'linkRuleEnabled' => $linkRuleEnabled,
            ]
        );
    }
}
