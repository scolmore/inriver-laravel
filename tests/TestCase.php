<?php

namespace Scolmore\InRiver\Tests;

use Illuminate\Support\Facades\Http;

abstract class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function defineEnvironment($app): void
    {
        tap($app['config'], function ($config) {
            $config->set('inriver.inriver_url', 'https://test.com');
            $config->set('inriver.inriver_api_key', '123ABC');
        });
    }

    public function fakeResponse(array|string|null $response, int $code = 200): void
    {
        Http::fake([
            '*' => Http::response($response, $code),
        ]);
    }
}
