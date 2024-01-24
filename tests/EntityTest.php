<?php

test('various entity data can be returned', function () {
    $responseBody = require __DIR__.'/responses/Entity/Entities.php';

    $this->fakeResponse($responseBody, 200);

    $entity = InRiver()->entities->fetchData([
        "entityIds" => [
            0,
        ],
        "objects" => "string",
        "fieldTypeIds" => "string",
        "inbound" => [
            "linkTypeIds" => "string",
            "objects" => "string",
            "linkEntityObjects" => "string",
        ],
        "outbound" => [
            "linkTypeIds" => "string",
            "objects" => "string",
            "linkEntityObjects" => "string",
        ],
    ]);

    expect($entity)->toBeArray()->toHaveCount(1);
});

test('an upsert can be performed on entities', function () {
    $this->fakeResponse([
        'errorCount' => 0,
        'errors' => [
            ['string'],
        ],
        'insertedEntities' => [
            ['string'],
        ],
        'updatedEntities' => [
            ['string'],
        ],
        'deletedEntities' => [
            ['string'],
        ],
    ], 200);

    $body = [
        [
            "entityTypeId" => "string",
            "keyFieldTypeIds" => [
                "string",
            ],
            "fieldValues" => [
                [
                    "string",
                ],
            ],
            "fieldSetOptions" => [
                "fieldSetId" => "string",
                "wipeOtherFields" => true,
            ],
            "specificationData" => [
                "specification" => "string",
                "specificationValues" => [
                    [
                        "string",
                    ],
                ],
            ],
            "segment" => "string",
            "links" => [
                [
                    "linkTypeId" => "string",
                    "entities" => [
                        "string",
                    ],
                    "linkInsertAction" => "string",
                    "linkUpdateAction" => "string",
                    "staleLinkAction" => "string",
                ],
            ],
        ],
    ];

    $entities = InRiver()->entities->upsert($body);

    expect($entities)->toBeArray()->and($entities['errorCount'])->toEqual(0);
});

test('a summary can be returned for an entity', function () {
    $this->fakeResponse([
        'id' => 1,
        'displayName' => 'string',
        'displayDescription' => 'string',
    ], 200);

    $entity = InRiver()->entities->getEntitySummary(1);

    expect($entity)->toBeArray()->and($entity['id'])->toEqual(1);
});

test('an entity can be deleted', function () {
    $this->fakeResponse(null, 200);

    $entity = InRiver()->entities->deleteEntity(1);

    expect($entity)->toBeNull();
});

test('a new entity can be created', function () {
    $this->fakeResponse([
        'id' => 1,
        'displayName' => 'string',
        'displayDescription' => 'string',
    ], 200);

    $entity = InRiver()->entities->createEntity([
        'entityTypeId' => 'string',
        'fieldSetId' => 'string',
        'fieldValues' => [
            [
                'fieldTypeId' => 'string',
                'value' => 'string',
            ],
        ],
    ]);

    expect($entity)->toBeArray()->and($entity['id'])->toEqual(1);
});

test('a blank entity can be returned', function () {
    $this->fakeResponse([
        'entityTypeId' => 'string',
        'fieldSetId' => 'string',
        'fieldValues' => [
            [
                'fieldTypeId' => 'string',
                'value' => 'string',
            ],
        ],
    ], 200);

    $entity = InRiver()->entities->getEmptyEntity('string', 'string');

    expect($entity)->toBeArray()->and($entity['entityTypeId'])->toEqual('string');
});

test('a dictionary of unique values and entity ids get returned', function () {
    $this->fakeResponse([
        'additionalProps1' => 0,
        'additionalProps2' => 0,
        'additionalProps3' => 0,
    ], 200);

    $dictionary = InRiver()->entities->mapUniqueValues([
        'fieldTypeId' => 'string',
        'uniqueValues' => [
            'string',
        ],
    ]);

    expect($dictionary)->toBeArray()->toHaveCount(3);
});

test('completeness detail is returned for an entity', function () {
    $this->fakeResponse([
        'completeness' => 100,
        'groups' => [
            [
                'name' => 'string',
                'isCompleted' => true,
                'rules' => [
                    [
                        'name' => 'string',
                        'isCompleted' => true,
                    ],
                ],
            ],
        ],
    ], 200);

    $completeness = InRiver()->entities->completenessDetails(1);

    expect($completeness)->toBeArray()->and($completeness['completeness'])->toEqual(100);
});

test('field values as a summary can be returned for an entity', function () {
    $this->fakeResponse([
        [
            'fieldTypeId' => 'string',
            'entityId' => 1,
            'value' => 'string',
        ],
    ], 200);

    $fieldValues = InRiver()->entities->getFields(1);

    expect($fieldValues)->toBeArray()->and($fieldValues[0]['fieldTypeId'])->toEqual('string');
});

test('a list of field values can be returned for an entity', function () {
    $this->fakeResponse([
        [
            'fieldTypeId' => 'string',
            'value' => 'string',
        ],
    ], 200);

    $fieldValues = InRiver()->entities->getFieldValues(1);

    expect($fieldValues)->toBeArray()->toHaveCount(1)
        ->and($fieldValues[0]['fieldTypeId'])->toEqual('string');
});

test('field values can be updated', function () {
    $this->fakeResponse([
        [
            'fieldTypeId' => 'string',
            'value' => 'string',
        ],
    ], 200);

    $fields = InRiver()->entities->setFieldValues(1, [
        [
            'fieldTypeId' => 'string',
            'value' => 'string',
        ],
    ]);

    expect($fields)->toBeArray()->toHaveCount(1)
        ->and($fields[0]['fieldTypeId'])->toEqual('string');
});

test('field value revisions are returned', function () {
    $this->fakeResponse([
        [
            'fieldTypeId' => 'string',
            'value' => 'string',
            'revision' => 0,
        ],
    ], 200);

    $fieldValues = InRiver()->entities->fieldHistory(1, 'string');

    expect($fieldValues)->toBeArray()->toHaveCount(1)
        ->and($fieldValues[0]['fieldTypeId'])->toEqual('string');
});

test('a fieldset can be set for an entity', function () {
    $this->fakeResponse([
        'id' => 0,
        'displayName' => 'string',
        'displayDescription' => 'string',
    ], 200);

    $fieldSet = InRiver()->entities->setFieldSet(1, 'string', false);

    expect($fieldSet)->toBeArray()->and($fieldSet['id'])->toEqual(0);
});

test('a specification summary can be returned', function () {
    $this->fakeResponse([
        [
            'entityId' => 0,
            'additionalData' => 'string',
            'name' => 'string',
        ],
    ], 200);

    $specificationSummary = InRiver()->entities->getSpecificationSummary(1);

    expect($specificationSummary)->toBeArray()->toHaveCount(1);
});

test('specification field values are returned', function () {
    $this->fakeResponse([
        [
            'specificationFieldTypeId' => 'string',
            'value' => 'string',
        ],
    ], 200);

    $specificationFieldValues = InRiver()->entities->getSpecificationValues(1);

    expect($specificationFieldValues)->toBeArray()->toHaveCount(1)
        ->and($specificationFieldValues[0]['specificationFieldTypeId'])->toEqual('string');
});

test('specification values can be updated', function () {
    $this->fakeResponse([
        [
            'specificationFieldTypeId' => 'string',
            'value' => 'string',
        ],
    ], 200);

    $specificationFieldValues = InRiver()->entities->updateSpecificationValues(1, [
        [
            'specificationFieldTypeId' => 'string',
            'value' => 'string',
        ],
    ]);

    expect($specificationFieldValues)->toBeArray()->toHaveCount(1)
        ->and($specificationFieldValues[0]['specificationFieldTypeId'])->toEqual('string');
});

test('a specification template can be set for an entity', function () {
    $this->fakeResponse([
        'id' => 0,
        'displayName' => 'string',
        'displayDescription' => 'string',
    ], 200);

    $specificationTemplate = InRiver()->entities->setSpecificationTemplate(1, 1);

    expect($specificationTemplate)->toBeArray()->and($specificationTemplate['id'])->toEqual(0);
});

test('the segment can be set for an entity', function () {
    $this->fakeResponse([
        'id' => 0,
        'displayName' => 'string',
        'displayDescription' => 'string',
    ], 200);

    $segment = InRiver()->entities->setSegment(1, 0);

    expect($segment)->toBeArray()->and($segment['id'])->toEqual(0);
});

test('links for an entity can be returned', function () {
    $this->fakeResponse([
        [
            'id' => 0,
            'isActive' => true,
            'linkTypeId' => 'string',
            'sourceEntityId' => 0,
            'targetEntityId' => 1,
        ],
    ], 200);

    $links = InRiver()->entities->getLinksForEntity(1);

    expect($links)->toBeArray()->toHaveCount(1)
        ->and($links[0]['id'])->toEqual(0);
});

test('an entity bundle can be returned', function () {
    $this->fakeResponse([
        'linkTypeId' => 'string',
        'summary' => [],
        'fields' => [],
        'specification' => [],
        'outbound' => [],
        'inbound' => [],
    ], 200);

    $entityBundle = InRiver()->entities->getEntityBundle(1);

    expect($entityBundle)->toBeArray()->and($entityBundle['linkTypeId'])->toEqual('string');
});

test('a list of media resources linked to the entity can be returned', function () {
    $this->fakeResponse(['string'], 200);

    $mediaResources = InRiver()->entities->getAllMedia(1);

    expect($mediaResources)->toBeArray()->toHaveCount(1)
        ->and($mediaResources[0])->toEqual('string');
});

test('a detailed list of media resources linked to the entity can be returned', function () {
    $this->fakeResponse([
        [
            'fieldId' => 0,
            'url' => 'string',
            'fileName' => 'string',
            'extension' => 'string',
            'fileSize' => 0,
            'dateCreated' => 'string',
            'lastModified' => 'string',
            'entityId' => 1,
        ],
    ], 200);

    $mediaResources = InRiver()->entities->getMediaDetails(1);

    expect($mediaResources)->toBeArray()->toHaveCount(1)
        ->and($mediaResources[0]['fieldId'])->toEqual(0);
});

test('media can be added to an entity', function () {
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

    $media = InRiver()->entities->uploadBase64File(1, 'string', 'base64encoded',);

    expect($media)->toBeArray()->and($media['fieldId'])->toEqual(0);
});

test('media can be added from a URL to an entity', function () {
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

    $media = InRiver()->entities->uploadMediaFromUrl(1, 'url', 'string');

    expect($media)->toBeArray()->and($media['fieldId'])->toEqual(0);
});

test('an external URL can be added to an entity', function () {
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

    $media = InRiver()->entities->addExternalUrl(1, 'url', 'string');

    expect($media)->toBeArray()->and($media['fieldId'])->toEqual(0);
});

test('comments for an entity can be returned', function () {
    $this->fakeResponse([
        [
            'id' => 0,
            'text' => 'string',
            'author' => 'string',
            'createdDate' => 'string',
            'formattedCreatedDate' => 'string',
            'entityId' => 1,
        ],
    ], 200);

    $comments = InRiver()->entities->comments(1);

    expect($comments)->toBeArray()->toHaveCount(1)
        ->and($comments[0]['id'])->toEqual(0);
});

test('a comment can be added to an entity', function () {
    $this->fakeResponse([
        'id' => 0,
        'text' => 'string',
        'author' => 'string',
        'createdDate' => 'string',
        'formattedCreatedDate' => 'string',
        'entityId' => 1,
    ], 200);

    $comment = InRiver()->entities->createComment(1, 'My comment');

    expect($comment)->toBeArray()->and($comment['id'])->toEqual(0);
});

test('a comment on an entity can be deleted', function () {
    $this->fakeResponse(null, 204);

    $comment = InRiver()->entities->deleteComment(1, 0);

    expect($comment)->toBeNull();
});

test('a list of starred entities get returned', function () {
    $this->fakeResponse([0, 1], 200);

    $starredEntities = InRiver()->entities->starredEntities();

    expect($starredEntities)->toBeArray()->toHaveCount(2)
        ->and($starredEntities[0])->toEqual(0);
});

test('a list of starred entities can be updated', function () {
    $this->fakeResponse([0, 1], 204);

    $starredEntities = InRiver()->entities->updateStarredEntities([0, 1]);

    expect($starredEntities)->toBeArray()->toHaveCount(2)
        ->and($starredEntities[0])->toEqual(0);
});

test('a list of segments can be returned', function () {
    $this->fakeResponse([
        [
            'id' => 0,
            'name' => 'string',
            'description' => 'string',
        ],
    ], 200);

    $segments = InRiver()->entities->getAllSegments();

    expect($segments)->toBeArray()->toHaveCount(1)
        ->and($segments[0]['id'])->toEqual(0);
});

