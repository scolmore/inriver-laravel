<?php

test('all extensions get returned', function () {
    $this->fakeResponse(require __DIR__.'/responses/Extension/Extensions.php', 200);

    $extensions = InRiver()->extensions->getAllExtensions();

    expect($extensions)->toBeArray()->toHaveCount(1);
});

test('an extensions can be added', function () {
    $extensions = require __DIR__.'/responses/Extension/Extensions.php';

    $this->fakeResponse($extensions[0], 200);

    $extension = InRiver()->extensions->addExtension(
        extensionId: 'string',
        extensionType: 'string',
        assemblyName: 'string',
        packageId: 1,
        assemblyType: 'string',
    );

    expect($extension)->toBeArray();
    $this->assertEquals($extensions[0]['extensionId'], $extension['extensionId']);
});

test('a single extension gets returned', function () {
    $extensions = require __DIR__.'/responses/Extension/Extensions.php';

    $this->fakeResponse($extensions[0], 200);

    $extension = InRiver()->extensions->getExtension('string');

    expect($extension)->toBeArray();
    $this->assertEquals('string', $extension['extensionId']);
});

test('an extension can be deleted', function () {
    $this->fakeResponse(null, 204);

    $response = InRiver()->extensions->deleteExtension('string');

    expect($response)->toBeNull();
});

test('an API key can be set for an inbound extension', function () {
    $this->fakeResponse(null, 204);

    $response = InRiver()->extensions->setExtensionApiKey('string', 'string');

    expect($response)->toBeNull();
});

test('all settings can be returned for an extension', function () {
    $this->fakeResponse(['key' => 'value'], 200);

    $settings = InRiver()->extensions->getExtensionSettings('string');

    expect($settings)->toBeArray()->toHaveCount(1);
});

test('a setting can be added to an extension', function () {
    $this->fakeResponse($data = ['key' => 'value'], 200);

    $setting = InRiver()->extensions->addOrUpdateExtensionSetting('string', $data);

    expect($setting)->toBeArray()->toHaveCount(1);
});

test('statistics can be returned for an extension', function () {
    $this->fakeResponse([
        'additionalProp1' => 'string',
        'additionalProp2' => 'string',
        'additionalProp3' => 'string',
    ], 200);

    $statistics = InRiver()->extensions->getExtensionEventStats('string');

    expect($statistics)->toBeArray()->toHaveCount(3);
});

test('a setting can be deleted for an extension', function () {
    $this->fakeResponse(null, 204);

    $response = InRiver()->extensions->deleteExtensionSetting('string', 'string');

    expect($response)->toBeNull();
});

test('a single setting can be returned for an extension', function () {
    $this->fakeResponse([
        'key' => 'string',
        'value' => 'string',
    ], 200);

    $setting = InRiver()->extensions->getExtensionSetting('string', 'string');

    expect($setting)->toBeArray()->toHaveCount(2);
});

test('default settings can be applied for an extension', function () {
    $this->fakeResponse([
        [
            'key' => 'string',
            'value' => 'string',
        ],
    ], 200);

    $response = InRiver()->extensions->applyDefaultExtensionSettings('string');

    expect($response)->tobeArray()->toHaveCount(1);
});

test('settings can be reloaded for an extension', function () {
    $this->fakeResponse(null, 204);

    $response = InRiver()->extensions->reloadSettingsForExtension('string');

    expect($response)->toBeNull();
});

test('the current status can be returned for an extension', function () {
    $this->fakeResponse([
        'isEnabled' => true,
        'isPaused' => false,
    ], 200);

    $status = InRiver()->extensions->getExtensionStatus('string');

    expect($status)->toBeArray()->toHaveCount(2)
        ->and($status['isEnabled'])->toBeTrue();
});

test('filter types can be returned for an extension', function () {
    $this->fakeResponse([
        [
            'filterTypeName' => 'string',
            'availableFilterValues' => ['string'],
        ],
    ], 200);

    $filterTypes = InRiver()->extensions->getAllFilterTypes('string');

    expect($filterTypes)->toBeArray()->toHaveCount(1);
});

test('filter configurations can be returned for an extension', function () {
    $this->fakeResponse([
        [
            'filterType' => 'string',
            'configuration' => ['string'],
        ],
    ], 200);

    $filterConfigurations = InRiver()->extensions->getAllFilterConfigurations('string');

    expect($filterConfigurations)->toBeArray()->toHaveCount(1);
});

test('filter configurations can be updated', function () {
    $this->fakeResponse($data = [
        [
            'filterType' => 'string',
            'configuration' => ['string'],
        ],
    ], 200);

    $filterConfigurations = InRiver()->extensions->updateFilterConfiguration('string', $data);

    expect($filterConfigurations)->toBeArray()->toHaveCount(1);
});

test('a single filter configuration can be returned', function () {
    $this->fakeResponse([
        'filterType' => 'string',
        'configuration' => ['string'],
    ], 200);

    $filterConfiguration = InRiver()->extensions->getFilterConfiguration('string', 'string');

    expect($filterConfiguration)->toBeArray()->toHaveCount(2);
});

test('an extension can be enabled', function () {
    $this->fakeResponse([
        'isEnabled' => true,
        'isPaused' => false,
    ], 200);

    $status = InRiver()->extensions->enableExtension('string');

    expect($status)->toBeArray()->toHaveCount(2)
        ->and($status['isEnabled'])->toBeTrue();
});

test('an extension can be disabled', function () {
    $this->fakeResponse([
        'isEnabled' => false,
        'isPaused' => false,
    ], 200);

    $status = InRiver()->extensions->disableExtension('string');

    expect($status)->toBeArray()->toHaveCount(2)
        ->and($status['isEnabled'])->toBeFalse();
});

test('a paused extension can be resumed', function () {
    $this->fakeResponse([
        'isEnabled' => true,
        'isPaused' => false,
    ], 200);

    $status = InRiver()->extensions->resumeExtension('string');

    expect($status)->toBeArray()->toHaveCount(2)
        ->and($status['isPaused'])->toBeFalse();
});

test('an extension can be paused', function () {
    $this->fakeResponse([
        'isEnabled' => true,
        'isPaused' => true,
    ], 200);

    $status = InRiver()->extensions->pauseExtension('string');

    expect($status)->toBeArray()->toHaveCount(2)
        ->and($status['isPaused'])->toBeTrue();
});

test('an extension can be ran', function () {
    $this->fakeResponse('running', 200);

    $response = InRiver()->extensions->runExtension('string');

    expect($response)->toBeNull();
});

test('an extension can be tested', function () {
    $this->fakeResponse('Test success', 200);

    $response = InRiver()->extensions->testExtension('string');

    expect($response)->toBeNull();
});

test('queue messages for an extensions can be returned', function () {
    $this->fakeResponse([
        [
            'id' => 0,
            'action' => 'string',
            'status' => 'string',
            'message' => 'string',
            'modified' => 'string',
            'added' => 'string',
            'username' => 'string',
            'extensionId' => 'string',
        ],
    ], 200);

    $queueMessages = InRiver()->extensions->getQueuedConnectMessagesAsync();

    expect($queueMessages)->toBeArray()->toHaveCount(1);
});

test('all queued connector messages can be deleted', function () {
    $this->fakeResponse(null, 204);

    $response = InRiver()->extensions->deleteAllConnectMessagesAsync();

    expect($response)->toBeNull();
});

test('queues messages can be deleted for a single extension', function () {
    $this->fakeResponse(null, 204);

    $response = InRiver()->extensions->deleteQueuedConnectMessagesAsync('string');

    expect($response)->toBeNull();
});

test('all connector states can be returned', function () {
    $this->fakeResponse([
        [
            'id' => 0,
            'connectorId' => 'string',
            'data' => 'string',
            'created' => 'string',
            'modified' => 'string',
        ],
    ], 200);

    $connectorStates = InRiver()->extensions->getAllConnectorStatesAsync();

    expect($connectorStates)->toBeArray()->toHaveCount(1);
});

test('a new connector state can be added', function () {
    $this->fakeResponse($data = [
        'id' => 0,
        'connectorId' => 'string',
        'data' => 'string',
        'created' => 'string',
        'modified' => 'string',
    ], 200);

    $connectorState = InRiver()->extensions->addConnectorStateAsync($data['connectorId'], $data['data']);

    expect($connectorState)->toBeArray()->toHaveCount(5);
});

test('all connector states can be deleted', function () {
    $this->fakeResponse(null, 204);

    $response = InRiver()->extensions->deleteAllConnectorStatesAsync();

    expect($response)->toBeNull();
});

test('all connector states can be returned for a connector', function () {
    $this->fakeResponse([
        [
            'id' => 0,
            'connectorId' => 'string',
            'data' => 'string',
            'created' => 'string',
            'modified' => 'string',
        ],
    ], 200);

    $connectorStates = InRiver()->extensions->getAllConnectorStatesByConnectorIdAsync(0);

    expect($connectorStates)->toBeArray()->toHaveCount(1);
});

test('a connector state can be updated', function () {
    $this->fakeResponse($data = [
        'id' => 0,
        'connectorId' => 'string',
        'data' => 'string',
        'created' => 'string',
        'modified' => 'string',
    ], 200);

    $connectorState = InRiver()->extensions->updateConnectorStateAsync($data['id'], $data['connectorId'],
        $data['data']);

    expect($connectorState)->toBeArray()->toHaveCount(5);
});

test('a connector state can be deleted', function () {
    $this->fakeResponse(null, 204);

    $response = InRiver()->extensions->deleteConnectorStateAsync(0);

    expect($response)->toBeNull();
});

test('all connector states can be deleted for a connector', function () {
    $this->fakeResponse(null, 204);

    $response = InRiver()->extensions->deleteConnectorStateForConnectorAsync('string');

    expect($response)->toBeNull();
});

test('all extensions can be restarted', function () {
    $this->fakeResponse('done', 204);

    $response = InRiver()->extensionmanager->restartServiceAsync();

    expect($response)->toBeNull();
});

test('all packages get returned', function () {
    $this->fakeResponse([
        [
            'id' => 0,
            'createdDate' => 'string',
            'modifiedDate' => 'string',
            'fileName' => 'string',
            'version' => 0,
        ],
    ], 200);

    $packages = InRiver()->packages->getAllPackages();

    expect($packages)->toBeArray()->toHaveCount(1);
});

test('a single package can be returned', function () {
    $this->fakeResponse([
        'id' => 0,
        'createdDate' => 'string',
        'modifiedDate' => 'string',
        'fileName' => 'string',
        'version' => 0,
    ], 200);

    $package = InRiver()->packages->getPackage(0);

    expect($package)->toBeArray()->toHaveCount(5);
});

test('a package can be deleted', function () {
    $this->fakeResponse(null, 204);

    $response = InRiver()->packages->deletePackage(0);

    expect($response)->toBeNull();
});

test('package content can be returned', function () {
    $this->fakeResponse([
        'fileName' => 'string',
        'data' => 'string',
    ], 200);

    $packageContents = InRiver()->packages->getPackageContent(0);

    expect($packageContents)->toBeArray()->toHaveCount(2);
});

test('a package can be uploaded', function () {
    $this->fakeResponse([
        'id' => 0,
        'createdDate' => 'string',
        'modifiedDate' => 'string',
        'fileName' => 'string',
        'version' => 0,
    ], 200);

    $package = InRiver()->packages->uploadPackage('string', 'string');

    expect($package)->toBeArray()->toHaveCount(5);
});

test('a package can be replaced', function () {
    $this->fakeResponse([
        'id' => 0,
        'createdDate' => 'string',
        'modifiedDate' => 'string',
        'fileName' => 'string',
        'version' => 0,
    ], 200);

    $package = InRiver()->packages->updatePackage(0, 'string', 'string');

    expect($package)->toBeArray()->toHaveCount(5);
});
