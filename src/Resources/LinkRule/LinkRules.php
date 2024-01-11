<?php

declare(strict_types=1);

namespace Scolmore\InRiver\Resources\LinkRule;

use Scolmore\InRiver\Resources\AbstractResource;

class LinkRules extends AbstractResource
{
    protected string $endpoint = 'linkrules';

    /**
     * Get all link rule definitions.
     *
     * @return array
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/LinkRule/GetAllLinkRuleDefinitions
     */
    public function getAllLinkRuleDefinitions(): array
    {
        return $this->inRiver()->request(
            method: 'GET',
            endpoint: $this->endpoint
        );
    }

    /**
     * Delete specified link rule definitions.
     *
     * @param  array  $linkRuleIds  List of link rule definition ids.
     * @return array
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/LinkRule/DeleteLinkRulesAsync
     */
    public function DeleteLinkRulesAsync(array $linkRuleIds): array
    {
        return $this->inRiver()->request(
            method: 'DELETE',
            endpoint: $this->endpoint,
            data: $linkRuleIds
        );
    }

    /**
     * Get link rule definitions for entity.
     *
     * @param  int  $entityId
     * @return array
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/LinkRule/GetLinkRuleDefinitionsForEntity
     */
    public function getLinkRuleDefinitionsForEntity(int $entityId): array
    {
        return $this->inRiver()->request(
            method: 'GET',
            endpoint: $this->endpoint("/{$entityId}")
        );
    }

    /**
     * Disable specified link rule definitions.
     *
     * @param  array  $linkRuleIds List of link rule definition ids.
     * @return array
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/LinkRule/DisableLinkRulesAsync
     */
    public function disableLinkRulesAsync(array $linkRuleIds): array
    {
        return $this->inRiver()->request(
            method: 'PUT',
            endpoint: $this->endpoint("/disable"),
            data: $linkRuleIds
        );
    }

    /**
     * Enable specified link rule definitions.
     *
     * @param  array  $linkRuleIds List of link rule definition ids.
     * @return array
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/LinkRule/EnableLinkRulesAsync
     */
    public function EnableLinkRulesAsync(array $linkRuleIds): array
    {
        return $this->inRiver()->request(
            method: 'PUT',
            endpoint: $this->endpoint("/enable"),
            data: $linkRuleIds
        );
    }
}
