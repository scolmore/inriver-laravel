<?php

declare(strict_types=1);

namespace Scolmore\InRiver\Resources\Link;

use Scolmore\InRiver\Exceptions\InRiverException;
use Scolmore\InRiver\Objects\Link\LinkObject;
use Scolmore\InRiver\Resources\AbstractResource;

class Links extends AbstractResource
{
    protected string $endpoint = 'links';

    /**
     * @throws InRiverException
     */
    public function get(int $linkId): LinkObject
    {
        $response = $this->getLink($linkId);

        return new LinkObject($response);
    }

    public function new(): LinkObject
    {
        return new LinkObject([]);
    }

    /**
     * Returns a link.
     *
     *
     * @throws InRiverException
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
     *
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Link/DeleteLink
     */
    public function deleteLink(int $linkId): null
    {
        return $this->inRiver()->request(
            method: 'DELETE',
            endpoint: $this->endpoint("/{$linkId}")
        );
    }

    /**
     * Create a new link.
     *
     * @param  int|null  $index  Set to 0 to add the link to the first position. Set to null to add the link to the last position. Specifying the index will reorganize all link indices.
     *
     * @throws InRiverException
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
     *
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Link/UpdateLink
     */
    public function updateLink(int $id, bool $isActive, int $index): array
    {
        return $this->inRiver()->request(
            method: 'PUT',
            endpoint: $this->endpoint('/sortorder'),
            data: [
                'id' => $id,
                'isActive' => $isActive,
                'index' => $index,
            ]
        );
    }
}
