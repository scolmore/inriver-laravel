<?php

test('all syndications get returned', function () {
    $this->fakeResponse([
        'extensionDisplayName' => 'string',
        'extensionId' => 'string',
        'id' => 1,
        'mappingName' => 'string',
        'name' => 'string',
        'outputFormat' => 'string',
        'workareaName' => 'string',
        'workareaId' => 'string',
    ], 200);

    $syndications = InRiver()->syndicate->syndications();

    $this->assertEquals('string', $syndications['extensionDisplayName']);
});

test('a syndication can be ran', function () {
    $this->fakeResponse(null, 200);

    $syndication = InRiver()->syndicate->runSyndicate(1);

    $this->assertEquals(null, $syndication);
});
