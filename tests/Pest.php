<?php

use Scolmore\InRiver\Tests\TestCase;

uses(TestCase::class)->in(__DIR__);

test('die and dump is not used')
    ->expect('dd')
    ->not->toBeUsed();

test('dump is not used')
    ->expect('dump')
    ->not->toBeUsed();
