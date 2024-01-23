<?php

use Illuminate\Support\Facades\Http;
use Scolmore\InRiver\Objects\Link\LinkObject;

test('a link can be returned', function () {
    $this->fakeResponse([
        'id' => 0,
        'isActive' => true,
        'linkTypeId' => 'string',
        'sourceEntityId' => 0,
        'targetEntityId' => 0,
        'linkEntityId' => null,
        'index' => 0,
    ]);

    $link = InRiver()->links->getLink(123);

    expect($link)->toBeArray()->toHaveCount(7);
});

test('a link can be deleted', function () {
    $this->fakeResponse(null, 204);

    $link = InRiver()->links->deleteLink(123);

    expect($link)->toBeNull();
});

test('a new link can be created', function () {
    $this->fakeResponse($data = [
        'id' => 0,
        'isActive' => true,
        'linkTypeId' => 'string',
        'sourceEntityId' => 0,
        'targetEntityId' => 0,
        'linkEntityId' => null,
        'index' => 0,
    ]);

    $link = InRiver()->links->createLink('string', 0, 0, 0, true);

    expect($link)->toBeArray()->toHaveCount(7);
});

test('a link can be updated', function () {
    $this->fakeResponse($data = [
        'id' => 0,
        'isActive' => true,
        'linkTypeId' => 'string',
        'sourceEntityId' => 0,
        'targetEntityId' => 0,
        'linkEntityId' => null,
        'index' => 0,
    ]);

    $link = InRiver()->links->updateLink(123, true, 0);

    expect($link)->toBeArray()->toHaveCount(7);
});

test('a link can be returned as a link object', function () {
    $this->fakeResponse([
        'id' => 0,
        'isActive' => true,
        'linkTypeId' => 'string',
        'sourceEntityId' => 0,
        'targetEntityId' => 0,
        'linkEntityId' => null,
        'index' => 0,
    ]);

    $link = InRiver()->links->get(123);

    expect($link)->toBeInstanceOf(LinkObject::class)
        ->and($link->id)->toBe(0);
});

test('a new link can be created via a link object', function () {
    $this->fakeResponse([
        'id' => 0,
        'isActive' => true,
        'linkTypeId' => 'string',
        'sourceEntityId' => 0,
        'targetEntityId' => 0,
        'linkEntityId' => null,
        'index' => 1,
    ]);

    $link = InRiver()->links->new();

    expect($link)->toBeInstanceOf(LinkObject::class)
        ->and($link->id)->toBeNull();

    $link->linkTypeId = 'string';
    $link->sourceEntityId = 0;
    $link->targetEntityId = 0;
    $link->isActive = true;
    $link->index = 1;

    $link->create();

    expect($link)->toBeInstanceOf(LinkObject::class)
        ->and($link->id)->toBe(0);
});

test('a link can be updated from a link object', function () {
    $this->fakeResponse([
        'id' => 0,
        'isActive' => true,
        'linkTypeId' => 'string',
        'sourceEntityId' => 0,
        'targetEntityId' => 0,
        'linkEntityId' => null,
        'index' => 1,
    ]);

    $link = InRiver()->links->get(0);

    expect($link)->toBeInstanceOf(LinkObject::class)
        ->and($link->id)->toBe(0);

    $link->index = 1;

    $link->update();

    expect($link)->toBeInstanceOf(LinkObject::class)
        ->and($link->id)->toBe(0);
});

test('a link can be deleted via a link object', function () {
    $this->fakeResponse(null, 204);

    $link = new LinkObject([
        'id' => 0,
        'isActive' => true,
        'linkTypeId' => 'string',
        'sourceEntityId' => 0,
        'targetEntityId' => 0,
        'linkEntityId' => null,
        'index' => 1,
    ]);

    expect($link)->toBeInstanceOf(LinkObject::class)
        ->and($link->id)->toBe(0);

    $link->delete();

    expect($link)->toBeInstanceOf(LinkObject::class)
        ->and($link->id)->toBeNull();
});
