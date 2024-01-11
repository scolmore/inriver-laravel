<?php

declare(strict_types=1);

namespace Scolmore\InRiver\Resources\Link;

use Scolmore\InRiver\Resources\AbstractResource;

class Links extends AbstractResource
{
    protected string $endpoint = 'links';

    /**
     * Returns a link.
     *
     * @param  int  $linkId
     * @return array
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Link/GetLink
     */
    public function getLink(int $linkId): array
    {
        return $this->inRiver()->request(
            method: 'GET',
            endpoint: $this->endpoint("/{$linkId}")
        );
    }

    /**
     * Delete link.
     *
     * @param  int  $linkId
     * @return array
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Link/DeleteLink
     */
    public function deleteLink(int $linkId): array
    {
        return $this->inRiver()->request(
            method: 'DELETE',
            endpoint: $this->endpoint("/{$linkId}")
        );
    }

    /**
     * Create a new link.
     *
     * @param  string  $linkTypeId
     * @param  int  $sourceEntityId
     * @param  int  $targetEntityId
     * @param  int|null  $index Set to 0 to add the link to the first position. Set to null to add the link to the last position. Specifying the index will reorganize all link indices.
     * @param  bool  $isActive
     * @return array
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Link/CreateLink
     */
    public function createLink(
        string $linkTypeId,
        int $sourceEntityId,
        int $targetEntityId,
        ?int $index,
        bool $isActive = true
    ): array {
        return $this->inRiver()->request(
            method: 'POST',
            endpoint: $this->endpoint,
            data: [
                'isActive' => $isActive,
                'linkTypeId' => $linkTypeId,
                'sourceEntityId' => $sourceEntityId,
                'targetEntityId' => $targetEntityId,
                'index' => $index,
            ]
        );
    }

    /**
     * Update sort order of links.
     *
     * @param  int  $id
     * @param  bool  $isActive
     * @param  int  $index
     * @return array
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Link/UpdateLink
     */
    public function updateLink(int $id, bool $isActive, int $index): array
    {
        return $this->inRiver()->request(
            method: 'PUT',
            endpoint: $this->endpoint("/sortorder"),
            data: [
                'id' => $id,
                'isActive' => $isActive,
                'index' => $index,
            ]
        );
    }
}
