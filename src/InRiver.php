<?php

declare(strict_types=1);

namespace Scolmore\InRiver;

use Illuminate\Support\Facades\Http;
use Scolmore\InRiver\Resources\Channel\Channels;
use Scolmore\InRiver\Resources\Entities\Entities;
use Scolmore\InRiver\Resources\Extension\Extensions;
use Scolmore\InRiver\Resources\Link\Links;

class InRiver
{
    public string $version = '1.0.0';
    public ?string $url;
    private ?string $apiKey;

    public Channels $channels;
    public Entities $entities;
    public Extensions $extensions;
    public Links $links;

    public function __construct()
    {
        $url = config('inriver.inriver_url');

        $this->url = "{$url}/api/v{$this->version}/";
        $this->apiKey = config('inriver.inriver_api_key');

        $this->setupResources();
    }

    public function request(string $method, string $endpoint, array $data = []): array|string
    {
        $client = Http::timeout(30)
            ->withHeaders([
                'X-inRiver-APIKey' => $this->apiKey,
            ]);

        $response = $client->$method("{$this->url}{$endpoint}", $data);

        if ($response->ok()) {
            return $response->json();
        }

        return [
            'error' => $response->failed(),
            'status' => $response->status(),
            'message' => $response->json()['title'] ?? $response->json(),
        ];
    }

    public function setupResources(): void
    {
        $this->channels = new Channels($this);
        $this->entities = new Entities($this);
        $this->extensions = new Extensions($this);
        $this->links = new Links($this);
    }
}
