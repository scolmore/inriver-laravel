<?php

declare(strict_types=1);

namespace Scolmore\InRiver\Resources\Workarea;

use Scolmore\InRiver\Exceptions\InRiverException;
use Scolmore\InRiver\Resources\AbstractResource;

class WorkareaFolder extends AbstractResource
{
    protected string $endpoint = 'workareafolder';

    /**
     * Returns a list of entities in a workarea folder.
     *
     * @param  string  $workAreaFolderId
     * @return array
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Workarea/WorkareaQueryResult
     */
    public function workareaQueryResult(string $workAreaFolderId): array
    {
        return $this->inRiver()->request(
            method: 'GET',
            endpoint: $this->endpoint("/{$workAreaFolderId}/entitylist")
        );
    }

    /**
     * Update workarea query.
     *
     * @param  string  $workareaFolderId
     * @param  array  $query
     * @return array
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Workarea/UpdateWorkareaQuery
     */
    public function updateWorkareaQuery(string $workareaFolderId, array $query): array
    {
        return $this->inRiver()->request(
            method: 'PUT',
            endpoint: $this->endpoint("/{$workareaFolderId}/query"),
            data: $query
        );
    }

    /**
     * Get entity id's in a static workarea.
     *
     * @param  string  $workareaFolderId
     * @return array
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Workarea/WorkareaFolderEntityIds
     */
    public function workareaFolderEntityIds(string $workareaFolderId): array
    {
        return $this->inRiver()->request(
            method: 'GET',
            endpoint: $this->endpoint("/{$workareaFolderId}/entityIds")
        );
    }

    /**
     * Set entity id's in a static workarea.
     *
     * @param  string  $workareaFolderId
     * @param  array  $entityIds
     * @return array
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Workarea/SetWorkareaFolderEntityIds
     */
    public function setWorkareaFolderEntityIds(string $workareaFolderId, array $entityIds): array
    {
        return $this->inRiver()->request(
            method: 'PUT',
            endpoint: $this->endpoint("/{$workareaFolderId}/entityIds"),
            data: $entityIds
        );
    }

    /**
     * Update workarea folder.
     *
     * @param  string  $workareaFolderId
     * @param  string  $name
     * @param  int  $index
     * @return array
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Workarea/UpdateWorkarea
     */
    public function updateWorkarea(string $workareaFolderId, string $name, int $index): array
    {
        return $this->inRiver()->request(
            method: 'PUT',
            endpoint: $this->endpoint("/{$workareaFolderId}"),
            data: [
                'name' => $name,
                'index' => $index,
            ]
        );
    }

    /**
     * Delete workarea folder.
     *
     * @param  string  $workareaFolderId
     * @return null
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Workarea/DeleteWorkarea
     */
    public function deleteWorkarea(string $workareaFolderId): null
    {
        return $this->inRiver()->request(
            method: 'DELETE',
            endpoint: $this->endpoint("/{$workareaFolderId}")
        );
    }

    /**
     * Create a new workarea.
     *
     * @param  array  $body
     * @return array
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Workarea/CreateWorkarea
     */
    public function createWorkarea(array $body): array
    {
        return $this->inRiver()->request(
            method: 'POST',
            endpoint: $this->endpoint(':createnew'),
            data: $body
        );
    }
}
