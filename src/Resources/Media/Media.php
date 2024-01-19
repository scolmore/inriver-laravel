<?php

declare(strict_types=1);

namespace Scolmore\InRiver\Resources\Media;

use Scolmore\InRiver\Exceptions\InRiverException;
use Scolmore\InRiver\Resources\AbstractResource;

class Media extends AbstractResource
{
    protected string $endpoint = 'media';

    private function getResourceLink(?int $sourceEntityId, string $linkTypeId): array
    {
        $resourceLink = [];

        if ($sourceEntityId) {
            $resourceLink['sourceEntityId'] = $sourceEntityId;
            $resourceLink['linkTypeId'] = $linkTypeId;
        }

        return $resourceLink;
    }

    /**
     * Add media.
     * Upload base64 encoded file data. A resource entity will be created. If the resourceLink object is omitted a resource entity will be created without a link. If resourceLink.linkTypeId is omitted inRiver will automatically find the most suitable link type.
     *
     * @param  string  $fileName
     * @param  string  $data
     * @param  int|null  $sourceEntityId
     * @param  string  $linkTypeId
     * @return array
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Media/UploadBase64File
     */
    public function uploadBase64File(
        string $fileName,
        string $data,
        ?int $sourceEntityId = null,
        string $linkTypeId = ''
    ): array {
        $resourceLink = $this->getResourceLink($sourceEntityId, $linkTypeId);

        return $this->inRiver()->request(
            method: 'POST',
            endpoint: $this->endpoint,
            data: [
                'fileName' => $fileName,
                'data' => $data,
                'resourceLink' => $resourceLink,
            ]
        );
    }

    /**
     * Add Media.
     * Note: If overrideUrlFileName is omitted, the filename will equal the one supplied in the url. Set overrideUrlFileName to specify a file name. If the resourceLink object is omitted a resource entity will be created without a link. If resourceLink.linkTypeId is omitted inRiver will automatically find the most suitable link type.
     *
     * @param  string  $url
     * @param  string  $overrideUrlFileName
     * @param  int|null  $sourceEntityId
     * @param  string  $linkTypeId
     * @return array
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Media/UploadMediaFromUrl
     */
    public function uploadMediaFromUrl(
        string $url,
        string $overrideUrlFileName = '',
        ?int $sourceEntityId = null,
        string $linkTypeId = ''
    ): array {
        $resourceLink = $this->getResourceLink($sourceEntityId, $linkTypeId);

        return $this->inRiver()->request(
            method: 'POST',
            endpoint: $this->endpoint,
            data: [
                'url' => $url,
                'overrideUrlFileName' => $overrideUrlFileName,
                'resourceLink' => $resourceLink,
            ]
        );
    }

    /**
     * Add external media url.
     * If the resourceLink object is omitted a resource entity will be created without a link. If resourceLink.linkTypeId is omitted inRiver will automatically find the most suitable link type. Example: Original external file URL that is added with this REST endpoint https://yourexternalresourceservice.com/imagename.jpg Your external image service then need to support the standard inRiver image configuration formats(Original, Preview, Thumbnail and SmallThumbnail) as a suffix on the URL that you uploaded or have a proxy that redirect to the right image format, else the inRiver web portal will not work correct.
     * https://yourexternalresourceservice.com/imagename.jpg/Original
     * https://yourexternalresourceservice.com/imagename.jpg/Preview
     * https://yourexternalresourceservice.com/imagename.jpg/Thumbnail
     * https://yourexternalresourceservice.com/imagename.jpg/SmallThumbnail
     *
     * @param  string  $url
     * @param  string  $overrideUrlFileName
     * @param  int|null  $sourceEntityId
     * @param  string  $linkTypeId
     * @return array
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Media/AddExternalUrl
     */
    public function addExternalUrl(string $url, string $overrideUrlFileName = '', ?int $sourceEntityId = null, string $linkTypeId = ''): array
    {
        $resourceLink = $this->getResourceLink($sourceEntityId, $linkTypeId);

        return $this->inRiver()->request(
            method: 'POST',
            endpoint: $this->endpoint,
            data: [
                'url' => $url,
                'overrideUrlFileName' => $overrideUrlFileName,
                'resourceLink' => $resourceLink,
            ]
        );
    }
}
