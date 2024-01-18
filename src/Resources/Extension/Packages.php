<?php

declare(strict_types=1);

namespace Scolmore\InRiver\Resources\Extension;

use Scolmore\InRiver\Exceptions\InRiverException;
use Scolmore\InRiver\Resources\AbstractResource;

class Packages extends AbstractResource
{
    protected string $endpoint = 'packages';

    /**
     * Lists all packages that have been added.
     *
     * @return array
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Extension/GetAllPackages
     */
    public function getAllPackages(): array
    {
        return $this->inRiver()->request(
            method: 'GET',
            endpoint: $this->endpoint()
        );
    }

    /**
     * Get a package.
     *
     * @param  int  $packageId
     * @return array
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Extension/GetPackage
     */
    public function getPackage(int $packageId): array
    {
        return $this->inRiver()->request(
            method: 'GET',
            endpoint: $this->endpoint("/{$packageId}")
        );
    }

    /**
     * Delete a package.
     *
     * @param  int  $packageId
     * @return array
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Extension/DeletePackage
     */
    public function deletePackage(int $packageId): array
    {
        return $this->inRiver()->request(
            method: 'DELETE',
            endpoint: $this->endpoint("/{$packageId}")
        );
    }

    /**
     * Get a package content.
     *
     * @param  int  $packageId
     * @return array
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Extension/GetPackageContent
     */
    public function getPackageContent(int $packageId): array
    {
        return $this->inRiver()->request(
            method: 'GET',
            endpoint: $this->endpoint("/{$packageId}/content")
        );
    }

    /**
     * Upload base64 encoded file data of the package.
     *
     * @param  string  $fileName
     * @param  string  $data
     * @return array
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Extension/UploadPackage
     */
    public function uploadPackage(string $fileName, string $data): array
    {
        return $this->inRiver()->request(
            method: 'POST',
            endpoint: $this->endpoint(':uploadbase64'),
            data: [
                'fileName' => $fileName,
                'data' => $data,
            ]
        );
    }

    /**
     * Exchange base64 encoded file data of the package to a new version.
     *
     * @param  int  $packageId
     * @param  string  $fileName
     * @param  string  $data
     * @return array
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Extension/UpdatePackage
     */
    public function updatePackage(int $packageId, string $fileName, string $data): array
    {
        return $this->inRiver()->request(
            method: 'PUT',
            endpoint: $this->endpoint("/{$packageId}:uploadandreplacebase64"),
            data: [
                'fileName' => $fileName,
                'data' => $data,
            ]
        );
    }
}
