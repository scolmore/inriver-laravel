<?php

declare(strict_types=1);

namespace Scolmore\InRiver;

class InRiver
{
    public string $version = '1.0.0';
    public ?string $url;
    private ?string $apiKey;

    public function __construct()
    {
        $url = config('inriver.inriver-url');

        $this->url = "{$url}/api/v{$this->version}/";
        $this->apiKey = config('inriver.inriver-api-key');
    }
}
