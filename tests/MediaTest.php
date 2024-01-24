<?php

test('media can be added', function () {
    $this->fakeResponse([
        'fieldId' => 0,
        'url' => 'string',
        'fileName' => 'string',
        'extension' => 'string',
        'fileSize' => 0,
        'dateCreated' => 'string',
        'lastModified' => 'string',
        'entityId' => 1,
    ], 200);

    $media = InRiver()->media->uploadBase64File('filename', 'base64', 1, 'string');

    expect($media)->toBeArray()->and($media['fieldId'])->toEqual(0);
});

test('media can be uploaded from URL', function () {
    $this->fakeResponse([
        'fieldId' => 0,
        'url' => 'string',
        'fileName' => 'string',
        'extension' => 'string',
        'fileSize' => 0,
        'dateCreated' => 'string',
        'lastModified' => 'string',
        'entityId' => 1,
    ], 200);

    $media = InRiver()->media->uploadMediaFromUrl('url', 'filename', 1, 'string');

    expect($media)->toBeArray()->and($media['fieldId'])->toEqual(0);
});

test('external source media from URL can be added', function () {
    $this->fakeResponse([
        'fieldId' => 0,
        'url' => 'string',
        'fileName' => 'string',
        'extension' => 'string',
        'fileSize' => 0,
        'dateCreated' => 'string',
        'lastModified' => 'string',
        'entityId' => 1,
    ], 200);

    $media = InRiver()->media->addExternalUrl('url', 'filename', 1, 'string');

    expect($media)->toBeArray()->and($media['fieldId'])->toEqual(0);
});
