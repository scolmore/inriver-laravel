<?php

declare(strict_types=1);

namespace Scolmore\InRiver\Objects\Link;

use Scolmore\InRiver\Exceptions\InRiverException;

class LinkObject
{
    public ?int $id;
    public bool $isActive;
    public ?string $linkTypeId;
    public ?int $sourceEntityId;
    public ?int $targetEntityId;
    public ?int $index;

    public function __construct(array $linkModel)
    {
        $this->initialize($linkModel);
    }

    private function initialize(array $linkModel): void
    {
        $this->id = $linkModel['id'] ?? null;
        $this->isActive = $linkModel['isActive'] ?? true;
        $this->linkTypeId = $linkModel['linkTypeId'] ?? null;
        $this->sourceEntityId = $linkModel['sourceEntityId'] ?? null;
        $this->targetEntityId = $linkModel['targetEntityId'] ?? null;
        $this->index = $linkModel['index'] ?? null;
    }

    /**
     * @throws InRiverException
     */
    public function create(): self
    {
        $response = InRiver()->links->createLink(
            linkTypeId: $this->linkTypeId,
            sourceEntityId: $this->sourceEntityId,
            targetEntityId: $this->targetEntityId,
            index: $this->index,
            isActive: $this->isActive,
        );

        $this->initialize($response);

        return $this;
    }

    /**
     * @throws InRiverException
     */
    public function update(): self
    {
        $response = InRiver()->links->updateLink(
            id: $this->id,
            isActive: $this->isActive,
            index: $this->index,
        );

        $this->initialize($response);

        return $this;
    }

    /**
     * @throws InRiverException
     */
    public function delete(): self
    {
        InRiver()->links->deleteLink($this->id);

        $this->initialize([]);

        return $this;
    }
}
