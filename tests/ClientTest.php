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

    $this->expectException(InRiverException::class);

    new InRiver();
});
