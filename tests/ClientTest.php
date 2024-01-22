<?php

use Scolmore\InRiver\Exceptions\InRiverException;
use Scolmore\InRiver\InRiver;

it('can be initialized', function () {
    $inRiver = new InRiver();

    expect($inRiver)->toBeInstanceOf(InRiver::class);
});

it('can be initialized via the helper', function () {
    $inRiver = inRiver();

    expect($inRiver)->toBeInstanceOf(InRiver::class);
});

it('throws an exception if no API key is provided', function () {
    config()->set('inriver.inriver_api_key', null);

    $this->expectException(InRiverException::class);

    new InRiver();
});

it('throws an exception if no URL is provided', function () {
    config()->set('inriver.inriver_url', null);

    new InRiver();
})->throws(InRiverException::class);

it('throws an exception if error is returned from the API', function () {
    $this->fakeResponse(['error' => 'test'], 400);

    InRiver()->channels->getChannelMessagesAsync();
})->throws(InRiverException::class);
