<?php

test('a query can be ran', function () {
    $this->fakeResponse([
        'count' => 2,
        'entityIds' => [123, 456],
    ]);

    $entities = InRiver()->query->query([
        'systemCriteria' => [
            'type' => 'string',
            'value' => 'string',
            'operator' => 'string',
        ],
    ]);

    $this->assertCount(2, $entities['entityIds']);
});

test('query can be ran on last modified date', function () {
    $this->fakeResponse([
        'count' => 2,
        'entityIds' => [123, 456],
    ]);

    $entities = InRiver()->query->updatedSince(now()->subWeek());

    $this->assertCount(2, $entities['entityIds']);
});
