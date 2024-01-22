<?php

test('channels get returned for an entity ID', function () {
    $responseBody = require __DIR__.'/responses/Channel/Channels.php';

    $this->fakeResponse($responseBody, 200);

    $channels = InRiver()->channels->getChannelsForEntityId(123);

    $this->assertCount(2, $channels);
    $this->assertEquals(1, $channels[0]['id']);
});

test('entity types get returned for a channel', function () {
    $this->fakeResponse(['Product', 'Item'], 200);

    $entityTypes = InRiver()->channels->entityTypes(123);

    $this->assertCount(2, $entityTypes);
    $this->assertContains('Product', $entityTypes);
});

test('a list of entities get returned for a channel', function () {
    $this->fakeResponse([
        'count' => 2,
        'entityIds' => [123, 456],
    ]);

    $entities = InRiver()->channels->getByLinkEntityType(123);

    $this->assertCount(2, $entities['entityIds']);
    $this->assertEquals(123, $entities['entityIds'][0]);
    $this->assertCount(2, $entities['entityIds']);

    $entities = InRiver()->channels->getByLinkEntityType(123, 'Product');

    $this->assertCount(2, $entities['entityIds']);
    $this->assertEquals(123, $entities['entityIds'][0]);
    $this->assertCount(2, $entities['entityIds']);
});

test('links by entity type can be returned from channels', function () {
    $responseBody = require __DIR__.'/responses/Channel/ChannelLinks.php';

    $this->fakeResponse($responseBody, 200);

    $links = InRiver()->channels->getByEntityType(123, 1);

    $this->assertCount(2, $links);
});

test('structure entities are returned from channels', function () {
    $responseBody = require __DIR__.'/responses/Channel/ChannelStructureEntity.php';

    $this->fakeResponse($responseBody, 200);

    $structureEntities = InRiver()->channels->getChannelStructureEntities(1, 1);

    $this->assertCount(2, $structureEntities);
});

test('channel structure list is returned', function () {
    $this->fakeResponse(['123'], 200);

    $structureList = InRiver()->channels->getChannelNodes(1);

    $this->assertCount(1, $structureList);
});

test('channel structure tree is returned', function () {
    $responseBody = require __DIR__.'/responses/Channel/ChannelPath.php';

    $this->fakeResponse($responseBody, 200);

    $structureTree = InRiver()->channels->channelContent('test', 'Product,Item');

    $this->assertCount(2, $structureTree);
});

test('channel queues are returned', function () {
    $responseBody = require __DIR__.'/responses/Channel/ChannelQueue.php';

    $this->fakeResponse($responseBody, 200);

    $structureTree = InRiver()->channels->getChannelMessagesAsync();

    $this->assertCount(1, $structureTree);
});

test('channel entities by specific entity type are returned', function () {
    $this->fakeResponse([1, 2], 200);

    $structureTree = InRiver()->channels->getChannelEntitiesAsync('Product', false, null);

    $this->assertCount(2, $structureTree);
});
