<?php

declare(strict_types=1);

namespace Scolmore\InRiver\Resources\Extension;

use Scolmore\InRiver\Exceptions\InRiverException;
use Scolmore\InRiver\Resources\AbstractResource;

class Extensions extends AbstractResource
{
    protected string $endpoint = 'extensions';

    /**
     * Return a list of all extensions that have been added to the environment.
     *
     *
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Extension/GetAllExtensions
     */
    public function getAllExtensions(): array
    {
        return $this->inRiver()->request(
            method: 'GET',
            endpoint: $this->endpoint()
        );
    }

    /**
     * Add extension.
     *
     *
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Extension/AddExtension
     */
    public function addExtension(
        string $extensionId,
        string $extensionType,
        string $assemblyName,
        int $packageId,
        string $assemblyType,
        bool $isEnabled = true
    ): array {
        return $this->inRiver()->request(
            method: 'POST',
            endpoint: $this->endpoint(),
            data: [
                'extensionId' => $extensionId,
                'extensionType' => $extensionType,
                'assemblyName' => $assemblyName,
                'packageId' => $packageId,
                'assemblyType' => $assemblyType,
                'isEnabled' => $isEnabled,
            ]
        );
    }

    /**
     * Get information on a specific extension by its extension ID.
     *
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Extension/GetExtension
     */
    public function getExtension(string $extensionId): array
    {
        return $this->inRiver()->request(
            method: 'GET',
            endpoint: $this->endpoint("/{$extensionId}")
        );
    }

    /**
     * Delete an extension by its extension ID.
     *
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Extension/DeleteExtension
     */
    public function deleteExtension(string $extensionId): null
    {
        return $this->inRiver()->request(
            method: 'DELETE',
            endpoint: $this->endpoint("/{$extensionId}")
        );
    }

    /**
     * Set an apikey on an inbound extension of extensionType.
     *
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Extension/SetExtensionApiKet
     */
    public function setExtensionApiKey(string $extensionId, string $apiKey): null
    {
        return $this->inRiver()->request(
            method: 'POST',
            endpoint: $this->endpoint("/{$extensionId}/apikey"),
            data: [
                'apiKey' => $apiKey,
            ]
        );
    }

    /**
     * Get all of the settings that have been added to an extension.
     *
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Extension/GetExtensionSettings
     */
    public function getExtensionSettings(string $extensionId): array
    {
        return $this->inRiver()->request(
            method: 'GET',
            endpoint: $this->endpoint("/{$extensionId}/settings")
        );
    }

    /**
     * Add or update one extension
     *
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Extension/AddOrUpdateExtensionSetting
     */
    public function addOrUpdateExtensionSetting(string $extensionId, array $settings): array
    {
        return $this->inRiver()->request(
            method: 'PUT',
            endpoint: $this->endpoint("/{$extensionId}/settings"),
            data: $settings
        );
    }

    /**
     * Get extension statistics.
     *
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Extension/GetExtensionEventStats
     */
    public function getExtensionEventStats(string $extensionId): array
    {
        return $this->inRiver()->request(
            method: 'GET',
            endpoint: $this->endpoint("/{$extensionId}/statistics")
        );
    }

    /**
     * Delete one extension setting by its key.
     *
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Extension/DeleteExtensionSetting
     */
    public function deleteExtensionSetting(string $extensionId, string $key): null
    {
        return $this->inRiver()->request(
            method: 'DELETE',
            endpoint: $this->endpoint("/{$extensionId}/settings/{$key}")
        );
    }

    /**
     * Get extension setting.
     *
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Extension/GetExtensionSetting
     */
    public function getExtensionSetting(string $extensionId, string $key): array
    {
        return $this->inRiver()->request(
            method: 'GET',
            endpoint: $this->endpoint("/{$extensionId}/settings/{$key}")
        );
    }

    /**
     * Apply default extension settings.
     *
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Extension/ApplyDefaultExtensionSettings
     */
    public function applyDefaultExtensionSettings(string $extensionId): array
    {
        return $this->inRiver()->request(
            method: 'POST',
            endpoint: $this->endpoint("/{$extensionId}/settings:applydefaults")
        );
    }

    /**
     * Triggers a reload of all settings to be accessible from Context.Settings in the extension.
     *
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Extension/ReloadSettingsForExtension
     */
    public function reloadSettingsForExtension(string $extensionId): null
    {
        return $this->inRiver()->request(
            method: 'POST',
            endpoint: $this->endpoint("/{$extensionId}/settings:reload")
        );
    }

    /**
     * Get the current status for if the extension is enabled/disabled.
     *
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Extension/GetExtensionStatus
     */
    public function getExtensionStatus(string $extensionId): array
    {
        return $this->inRiver()->request(
            method: 'GET',
            endpoint: $this->endpoint("/{$extensionId}/status")
        );
    }

    /**
     * Get applicable filter types.
     *
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Extension/GetAllFilterTypes
     */
    public function getAllFilterTypes(string $extensionId): array
    {
        return $this->inRiver()->request(
            method: 'GET',
            endpoint: $this->endpoint("/{$extensionId}/filtertypes")
        );
    }

    /**
     * Get filter configurations.
     *
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Extension/GetAllFilterConfigurations
     */
    public function getAllFilterConfigurations(string $extensionId): array
    {
        return $this->inRiver()->request(
            method: 'GET',
            endpoint: $this->endpoint("/{$extensionId}/filterconfigurations")
        );
    }

    /**
     * Update a filter configuration.
     *
     * @throws InRiverException
     */
    public function updateFilterConfiguration(string $extensionId, array $body): array
    {
        return $this->inRiver()->request(
            method: 'PUT',
            endpoint: $this->endpoint("/{$extensionId}/filterconfigurations"),
            data: $body
        );
    }

    /**
     * Get a filter configuration.
     *
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Extension/GetFilterConfiguration
     */
    public function getFilterConfiguration(string $extensionId, string $filterTypeName): array
    {
        return $this->inRiver()->request(
            method: 'GET',
            endpoint: $this->endpoint("/{$extensionId}/filterconfigurations/{$filterTypeName}")
        );
    }

    /**
     * Enable a disabled extension.
     *
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Extension/EnableExtension
     */
    public function enableExtension(string $extensionId): array
    {
        return $this->inRiver()->request(
            method: 'POST',
            endpoint: $this->endpoint("/{$extensionId}:enable")
        );
    }

    /**
     * Disable an enabled extension.
     *
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Extension/DisableExtension
     */
    public function disableExtension(string $extensionId): array
    {
        return $this->inRiver()->request(
            method: 'POST',
            endpoint: $this->endpoint("/{$extensionId}:disable")
        );
    }

    /**
     * Resume a paused extension.
     *
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Extension/ResumeExtension
     */
    public function resumeExtension(string $extensionId): array
    {
        return $this->inRiver()->request(
            method: 'POST',
            endpoint: $this->endpoint("/{$extensionId}:resume")
        );
    }

    /**
     * Pause an extension.
     *
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Extension/PauseExtension
     */
    public function pauseExtension(string $extensionId): array
    {
        return $this->inRiver()->request(
            method: 'POST',
            endpoint: $this->endpoint("/{$extensionId}:pause")
        );
    }

    /**
     * Run an extension of type ScheduledExtension.
     *
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Extension/RunExtension
     */
    public function runExtension(string $extensionId): null
    {
        return $this->inRiver()->request(
            method: 'POST',
            endpoint: $this->endpoint("/{$extensionId}:run")
        );
    }

    /**
     * Test an extension.
     *
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Extension/TestExtension
     */
    public function testExtension(string $extensionId): null
    {
        return $this->inRiver()->request(
            method: 'POST',
            endpoint: $this->endpoint("/{$extensionId}:test")
        );
    }

    /**
     * Get extensions queue messages for a customer environment.
     *
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Extension/GetQueuedConnectMessagesAsync
     */
    public function getQueuedConnectMessagesAsync(): array
    {
        return $this->inRiver()->request(
            method: 'GET',
            endpoint: $this->endpoint('/queue')
        );
    }

    /**
     * Delete all queued connect messages.
     *
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Extension/DeleteAllConnectMessagesAsync
     */
    public function deleteAllConnectMessagesAsync(): null
    {
        return $this->inRiver()->request(
            method: 'DELETE',
            endpoint: $this->endpoint('/queue')
        );
    }

    /**
     * Delete queued connect messages with a specific extensionId in a set time frame between a start date and end date.
     *
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Extension/DeleteQueuedConnectMessagesAsync
     */
    public function deleteQueuedConnectMessagesAsync(string $extensionId, string $startDateUtc = '', string $endDateUtc = ''): null
    {
        return $this->InRiver()->request(
            method: 'DELETE',
            endpoint: $this->endpoint("/queue/{$extensionId}"),
            data: [
                'startDateUtc' => $startDateUtc,
                'endDateUtc' => $endDateUtc,
            ]
        );
    }

    /**
     * Get all ConnectorStates.
     *
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Extension/GetAllConnectorStatesAsync
     */
    public function getAllConnectorStatesAsync(): array
    {
        return $this->inRiver()->request(
            method: 'GET',
            endpoint: $this->endpoint('/connectorstates')
        );
    }

    /**
     * Add a ConnectorState.
     *
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Extension/AddConnectorStateAsync
     */
    public function addConnectorStateAsync(string $connectorId, string $data): array
    {
        return $this->inRiver()->request(
            method: 'POST',
            endpoint: $this->endpoint('/connectorstates'),
            data: [
                'connectorId' => $connectorId,
                'data' => $data,
            ]
        );
    }

    /**
     * Delete all ConnectorStates.
     *
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Extension/DeleteAllConnectorStatesAsync
     */
    public function deleteAllConnectorStatesAsync(): null
    {
        return $this->inRiver()->request(
            method: 'DELETE',
            endpoint: $this->endpoint('/connectorstates')
        );
    }

    /**
     * Get all ConnectorStates for Connector.
     *
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Extension/GetAllConnectorStatesByConnectorIdAsync
     */
    public function getAllConnectorStatesByConnectorIdAsync(string $connectorId): array
    {
        return $this->inRiver()->request(
            method: 'GET',
            endpoint: $this->endpoint("/connectorstates/{$connectorId}")
        );
    }

    /**
     * Update a ConnectorState.
     *
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Extension/UpdateConnectorStateAsync
     */
    public function updateConnectorStateAsync(int $id, string $connectorId, string $data): array
    {
        return $this->inRiver()->request(
            method: 'PUT',
            endpoint: $this->endpoint("/connectorstates/{$id}"),
            data: [
                'connectorId' => $connectorId,
                'data' => $data,
            ]
        );
    }

    /**
     * Delete a ConnectorState.
     *
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Extension/DeleteConnectorStateAsync
     */
    public function deleteConnectorStateAsync(int $id): null
    {
        return $this->inRiver()->request(
            method: 'DELETE',
            endpoint: $this->endpoint("/connectorstates/{$id}")
        );
    }

    /**
     * Delete all ConnectorStates for Connector.
     *
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Extension/DeleteConnectorStateForConnectorAsync
     */
    public function deleteConnectorStateForConnectorAsync(string $connectorId): null
    {
        return $this->inRiver()->request(
            method: 'DELETE',
            endpoint: $this->endpoint("/connectorstates/connector/{$connectorId}")
        );
    }
}
