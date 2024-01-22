<?php

test('image configurations are returned', function () {
    $this->fakeResponse(['string'], 200);

    $imageConfigurations = InRiver()->system->getAllImageConfigurations();

    $this->assertCount(1, $imageConfigurations);
});

test('image configuration details are returned', function () {
    $this->fakeResponse([
        [
            'id' => 1,
            'name' => 'string',
            'extension' => 'string',
            'outputExtension' => 'string',
            'arguments' => 'string',
        ],
    ]);

    $imageConfiguration = InRiver()->system->getAllImageConfigurationDetails();

    $this->assertCount(1, $imageConfiguration);
});

test('a list of server settings are returned', function () {
    $this->fakeResponse([
        'additionalProp1' => 'string',
        'additionalProp2' => 'string',
        'additionalProp3' => 'string',
    ], 200);

    $serverSettings = InRiver()->system->getServerSettings();

    $this->assertCount(3, $serverSettings);
});

test('server settings can be added', function () {
    $this->fakeResponse([
        'additionalProp1' => 'string',
        'additionalProp2' => 'string',
        'additionalProp3' => 'string',
    ], 200);

    $serverSettings = InRiver()->system->updateServerSetting([
        'additionalProp1' => 'string',
        'additionalProp2' => 'string',
        'additionalProp3' => 'string',
    ]);

    $this->assertCount(3, $serverSettings);
});

test('a list of roles and permissions gets returned', function () {
    $this->fakeResponse([
        [
            'id' => 1,
            'name' => 'string',
            'description' => 'string',
            'permissions' => [
                'string',
            ],
        ],
    ], 200);

    $rolesAndPermissions = InRiver()->system->roles();

    $this->assertCount(1, $rolesAndPermissions);
});

test('a list of segments get returned', function () {
    $this->fakeResponse([
        [
            'id' => 1,
            'name' => 'string',
            'description' => 'string',
            'roles' => [
                [
                    'id' => 1,
                    'name' => 'string',
                    'description' => 'string',
                    'permissions' => [
                        'string',
                    ],
                ],
            ],
        ],
    ], 200);

    $segments = InRiver()->system->segments();

    $this->assertCount(1, $segments);
    $this->assertCount(1, $segments[0]['roles']);
});

test('a users access for a segment can be modified', function () {
    $this->fakeResponse([
        'username' => 'string',
        'roleNames' => [
            'string',
        ],
    ], 200);

    $segment = InRiver()->system->setUserRolesForSegment(1, [
        'username' => 'string',
        'roleNames' => [
            'string',
        ],
    ]);

    $this->assertCount(2, $segment);
});

test('a role can be added to a user', function () {
    $this->fakeResponse([
        'username' => 'string',
        'roleName' => 'string',
    ], 200);

    $role = InRiver()->system->addUserRoleForSegment(1, 'string', 'string');

    $this->assertCount(2, $role);
});

test('a role can be removed from a user', function () {
    $this->fakeResponse([
        'username' => 'string',
        'roleNames' => [],
    ], 200);

    $role = InRiver()->system->removeUserRoleForSegment(1, 'string', 'string');

    $this->assertCount(2, $role);
    $this->assertCount(0, $role['roleNames']);
});

test('a list of users can be returned', function () {
    $this->fakeResponse([
        [
            'username' => 'string',
            'firstName' => 'string',
            'lastName' => 'string',
            'email' => 'string',
            'segmentRoles' => [
                [
                    'segmentId' => 1,
                    'roleNames' => [
                        'string',
                    ],
                ],
            ],
        ],
    ], 200);

    $users = InRiver()->system->getUsers();

    $this->assertCount(1, $users);
});

test('a user can be provisioned', function () {
    $this->fakeResponse($data = [
        'username' => 'string',
        'firstName' => 'string',
        'lastName' => 'string',
        'email' => 'string',
        'segmentRoles' => [
            [
                'segmentId' => 1,
                'roleNames' => [
                    'string',
                ],
            ],
        ],
    ], 200);

    $user = InRiver()->system->provisionUser($data);

    $this->assertEquals('string', $user['username']);
});

test('details for a user gets returned', function () {
    $this->fakeResponse([
        'username' => 'string',
        'firstName' => 'string',
        'lastName' => 'string',
        'email' => 'string',
        'segmentRoles' => [
            [
                'segmentId' => 1,
                'roleNames' => [
                    'string',
                ],
            ],
        ],
    ], 200);

    $user = InRiver()->system->getUser('string');

    $this->assertEquals('string', $user['username']);
});

test('a user can be updated', function () {
    $this->fakeResponse($data = [
        'username' => 'string',
        'firstName' => 'string',
        'lastName' => 'string',
        'email' => 'string',
        'segmentRoles' => [
            [
                'segmentId' => 1,
                'roleNames' => [
                    'string',
                ],
            ],
        ],
    ], 200);

    $user = InRiver()->system->updateUser('string', $data);

    $this->assertEquals('string', $user['username']);
});

test('a user can be deleted', function () {
    $this->fakeResponse(null, 204);

    $user = InRiver()->system->deleteUser('string');

    $this->assertEquals(null, $user);
});

test('the current environment context is returned', function () {
    $this->fakeResponse([
        'customerSafeName' => 'string',
        'environmentSafeName' => 'string',
    ], 200);

    $environmentContext = InRiver()->system->getEnvironmentContext();

    $this->assertEquals('string', $environmentContext['customerSafeName']);
});
