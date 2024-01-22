<?php

namespace Scolmore\InRiver\Tests;

abstract class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function defineEnvironment($app): void
    {
        tap($app['config'], function ($config) {
            $config->set('inriver.inriver_url', 'https://test.com');
            $config->set('inriver.inriver_api_key', '123ABC');
        });
    }
}
