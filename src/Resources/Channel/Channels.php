<?php

declare(strict_types=1);

namespace Scolmore\InRiver\Resources\Channel;

use Scolmore\InRiver\Exceptions\InRiverException;
use Scolmore\InRiver\Resources\AbstractResource;

class Channels extends AbstractResource
{
    protected string $endpoint = 'channels';

    /**
     * Get channel id's for entity id.
     *
     * @param  int|null  $forEntityId  optional.
     * @param  bool  $includeChannels  optional, defaults to true.
     * @param  bool  $includePublications  optional, defaults to false.
     * @return array
     *
     * @throws InRiverException
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Channel/GetChannelsForEntityId
     */
    public function getChannelsForEntityId(
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
     * Get entity types for channel.
     *
     * @param  int  $channelId
     * @return array
     *
     * @throws InRiverException
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Channel/EntityTypes
     */
    public function entityTypes(int $channelId): array
    {
        return $this->inRiver()->request(
            method: 'GET',
            endpoint: $this->endpoint("/{$channelId}/entitytypes")
        );
    }

    /**
     * Get a list of entities in a channel.
     *
     * @param  int  $channelId
     * @param  string  $entityTypeId  optional, filter by entity type id.
     * @return array
     *
     * @throws InRiverException
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Channel/GetByLinkEntityType
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
     * Get entity links.
     *
     * @param  int  $channelId
     * @param  int  $entityId
     * @param  string  $linkDirection  optional, "inbound" or "outbound".
     * @param  string  $linkTypeId  optional, filter by link type.
     * @return array
     *
     * @throws InRiverException
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Channel/GetByEntityType
     */
    public function getByEntityType(
        int $channelId,
        int $entityId,
        string $linkDirection = '',
        string $linkTypeId = ''
    ): array {
        return $this->inRiver()->request(
            method: 'GET',
            endpoint: $this->endpoint("/{$channelId}/entities/{$entityId}/links"),
            data: [
                'linkDirection' => $linkDirection,
                'linkTypeId' => $linkTypeId,
            ]
        );
    }

    /**
     * Get structure entities for entity.
     *
     * @param  int  $channelId
     * @param  int  $entityId
     * @return array
     *
     * @throws InRiverException
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Channel/GetChannelStructureEntities
     */
    public function getChannelStructureEntities(int $channelId, int $entityId): array
    {
        return $this->inRiver()->request(
            method: 'GET',
            endpoint: $this->endpoint("/{$channelId}/entities/{$entityId}/structureentities")
        );
    }

    /**
     * Channel structure list.
     *
     * @param  int  $channelId
     * @return array
     *
     * @throws InRiverException
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Channel/GetChannelNodes
     */
    public function getChannelNodes(int $channelId): array
    {
        return $this->inRiver()->request(
            method: 'GET',
            endpoint: $this->endpoint("/{$channelId}/nodes")
        );
    }

    /**
     * Channel structure tree.
     *
     * @param  int  $channelId
     * @return array
     *
     * @throws InRiverException
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Channel/GetChannelNodeTree
     */
    public function getChannelNodeTree(int $channelId): array
    {
        return $this->inRiver()->request(
            method: 'GET',
            endpoint: $this->endpoint("/{$channelId}/nodetree")
        );
    }

    /**
     * Channel path content.
     *
     * @param  string  $path
     * @param  string  $entityTypeIds  optional, filter types using comma separated list.
     * @return array
     *
     * @throws InRiverException
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Channel/ChannelContent
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
     * Get channel queue messages for a customer environment.
     *
     * @return array
     *
     * @throws InRiverException
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Channel/GetChannelMessagesAsync
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
     * @param  bool  $orphaned  True, get ids of entities not included in any channel. False, get ids of entities included in at least one channel.
     * @param  bool|null  $linkRuleEnabled  Null, get all entity ids. True, get ids of entities with configured link rules. False, get ids of entities without configured link rules or disabled link rules.
     * @return array
     *
     * @throws InRiverException
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Channel/GetChannelEntitiesAsync
     */
    public function getChannelEntitiesAsync(
        string $entityTypeId,
        bool $orphaned = false,
        ?bool $linkRuleEnabled = null
    ): array {
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
