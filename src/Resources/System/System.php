<?php

declare(strict_types=1);

namespace Scolmore\InRiver\Resources\System;

use Scolmore\InRiver\Exceptions\InRiverException;
use Scolmore\InRiver\Resources\AbstractResource;

class System extends AbstractResource
{
    protected string $endpoint = 'system';

    /**
     * Returns available image configurations.
     *
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/System/GetAllImageConfigurations
     */
    public function getAllImageConfigurations(): array
    {
        return $this->inRiver()->request(
            method: 'GET',
            endpoint: $this->endpoint('/imageconfigurations')
        );
    }

    /**
     * Return full details of available image configurations.
     *
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/System/GetImageConfigurationDetails
     */
    public function getAllImageConfigurationDetails(): array
    {
        return $this->inRiver()->request(
            method: 'GET',
            endpoint: $this->endpoint('/imageconfigurationdetails')
        );
    }

    /**
     * Get a list of server settings.
     *
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/System/GetServerSettings
     */
    public function getServerSettings(): array
    {
        return $this->inRiver()->request(
            method: 'GET',
            endpoint: $this->endpoint('/serversettings')
        );
    }

    /**
     * Add/Update server settings.
     *
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/System/UpdateServerSetting
     */
    public function updateServerSetting(array $body): array
    {
        return $this->inRiver()->request(
            method: 'POST',
            endpoint: $this->endpoint('/serversetting'),
            data: $body
        );
    }

    /**
     * Get list of user roles and permissions.
     *
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/System/Roles
     */
    public function roles(): array
    {
        return $this->inRiver()->request(
            method: 'GET',
            endpoint: $this->endpoint('/roles')
        );
    }

    /**
     * Get list of segments.
     *
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/System/Segments
     */
    public function segments(): array
    {
        return $this->inRiver()->request(
            method: 'GET',
            endpoint: $this->endpoint('/segments')
        );
    }

    /**
     * Modify user access for segment.
     *
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/System/SetUserRolesForSegment
     */
    public function setUserRolesForSegment(int $segmentId, array $body): array
    {
        return $this->inRiver()->request(
            method: 'POST',
            endpoint: $this->endpoint("/segments/{$segmentId}:setuserroles"),
            data: $body
        );
    }

    /**
     * Assign a role to a user and segment.
     *
     * @param  string  $roleName  The roleName value expects a single role name, such as "Editor" or "Reader". Requires administrator role.
     *
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/System/AddUserRoleForSegment
     */
    public function addUserRoleForSegment(int $segmentId, string $username, string $roleName): array
    {
        return $this->inRiver()->request(
            method: 'POST',
            endpoint: $this->endpoint("/segments/{$segmentId}:adduserrole"),
            data: [
                'username' => $username,
                'roleName' => $roleName,
            ]
        );
    }

    /**
     * Remove a role from a user and segment.
     *
     * @param  string  $roleName  The roleName value expects a single role name, such as "Editor" or "Reader". Requires administrator role.
     *
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/System/RemoveUserRoleForSegment
     */
    public function removeUserRoleForSegment(int $segmentId, string $username, string $roleName): array
    {
        return $this->inRiver()->request(
            method: 'POST',
            endpoint: $this->endpoint("/segments/{$segmentId}:removeuserrole"),
            data: [
                'username' => $username,
                'roleName' => $roleName,
            ]
        );
    }

    /**
     * Get list of users.
     *
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/System/GetUsers
     */
    public function getUsers(): array
    {
        return $this->inRiver()->request(
            method: 'GET',
            endpoint: $this->endpoint('/users')
        );
    }

    /**
     * Provision user.
     *
     *
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/System/ProvisionUser
     */
    public function provisionUser(array $body): array
    {
        return $this->inRiver()->request(
            method: 'POST',
            endpoint: $this->endpoint('/users:provision'),
            data: $body
        );
    }

    /**
     * Get user.
     *
     *
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/System/GetUser
     */
    public function getUser(string $username): array
    {
        return $this->inRiver()->request(
            method: 'GET',
            endpoint: $this->endpoint("/users/{$username}")
        );
    }

    /**
     * Update user.
     *
     *
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/System/UpdateUser
     */
    public function updateUser(string $username, array $body): array
    {
        return $this->inRiver()->request(
            method: 'PUT',
            endpoint: $this->endpoint("/users/{$username}"),
            data: $body
        );
    }

    /**
     * Delete user.
     *
     *
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/System/DeleteUser
     */
    public function deleteUser(string $username): null
    {
        return $this->inRiver()->request(
            method: 'DELETE',
            endpoint: $this->endpoint("/users/{$username}")
        );
    }

    /**
     * Return the current environment context linked to the REST API key.
     *
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/System/GetEnvironmentContext
     */
    public function getEnvironmentContext(): array
    {
        return $this->inRiver()->request(
            method: 'GET',
            endpoint: $this->endpoint('/environmentcontext')
        );
    }
}
