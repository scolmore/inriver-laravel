<?php

test('workarea folders are returned', function () {
    $this->fakeResponse([
        [
            'id' => 'string',
            'name' => 'string',
            'isQuery' => true,
            'index' => 1,
        ],
    ], 200);

    $workareaFolders = InRiver()->workareafolders->workareaFolders(true, true);

    $this->assertCount(1, $workareaFolders);
});

test('workarea folder tree is returned', function () {
    $this->fakeResponse([
        [
            'id' => 'string',
            'name' => 'string',
            'isQuery' => true,
            'folders' => ['test'],
        ],
    ], 200);

    $workareaFolderTree = InRiver()->workareafoldertree->workareaFolderTree(true, true);

    $this->assertCount(1, $workareaFolderTree);
});

test('entities are returned from a folder', function () {
    $this->fakeResponse([
        'count' => 2,
        'entityIds' => [123, 456],
    ]);

    $entities = InRiver()->workareafolder->workareaQueryResult(123);

    $this->assertCount(2, $entities['entityIds']);
    $this->assertEquals(123, $entities['entityIds'][0]);
    $this->assertCount(2, $entities['entityIds']);
});

test('a workarea query can be updated', function () {
    $this->fakeResponse([0], 200);

    $workareaQuery = InRiver()->workareafolder->updateWorkareaQuery(123, [
        'systemCriteria' => [
            'type' => 'string',
            'value' => 'string',
            'operator' => 'string',
        ],
    ]);

    $this->assertCount(1, $workareaQuery);
});

test('entities from a static workarea are returned', function () {
    $this->fakeResponse([123, 456], 200);

    $entities = InRiver()->workareafolder->workareaFolderEntityIds(123);

    $this->assertCount(2, $entities);
});

test('entity ids can be set on a static workarea', function () {
    $this->fakeResponse([123, 456], 200);

    $entityIds = InRiver()->workareafolder->setWorkareaFolderEntityIds(123, [123, 456]);

    $this->assertCount(2, $entityIds);
    $this->assertContains(123, $entityIds);
});

test('a workarea folder can be updated', function () {
    $this->fakeResponse([
        'id' => 'string',
        'name' => 'string',
        'isQuery' => true,
        'index' => 1,
    ], 200);

    $workareaFolder = InRiver()->workareafolder->updateWorkarea(123, 'string', 1);

    $this->assertEquals('string', $workareaFolder['name']);
    $this->assertEquals(1, $workareaFolder['index']);
});

test('a workarea folder can be deleted', function () {
    $this->fakeResponse(null, 204);

    $workareaFolder = InRiver()->workareafolder->deleteWorkarea(123);

    $this->assertNull($workareaFolder);
});

test('a workarea folder can be created', function () {
    $this->fakeResponse([
        'id' => 'string',
        'name' => 'string',
        'isQuery' => true,
        'index' => 1,
    ], 200);

    $workareaFolder = InRiver()->workareafolder->createWorkarea([
        'name' => 'string',
        'isShared' => true,
        'query' => [
            'systemCriteria' => [
                'type' => 'string',
                'value' => 'string',
                'operator' => 'string',
            ],
        ],
        'index' => 1,
    ]);

    $this->assertEquals('string', $workareaFolder['name']);
    $this->assertEquals(1, $workareaFolder['index']);
});
