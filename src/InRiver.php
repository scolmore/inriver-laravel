<?php

declare(strict_types=1);

namespace Scolmore\InRiver;

use Illuminate\Support\Facades\Http;
use Scolmore\InRiver\Exceptions\InRiverException;
use Scolmore\InRiver\Resources\Channel\Channels;
use Scolmore\InRiver\Resources\Entity\Entities;
use Scolmore\InRiver\Resources\Extension\ExtensionManager;
use Scolmore\InRiver\Resources\Extension\Extensions;
use Scolmore\InRiver\Resources\Extension\Packages;
use Scolmore\InRiver\Resources\Link\Links;
use Scolmore\InRiver\Resources\LinkRule\LinkRules;
use Scolmore\InRiver\Resources\Media\Media;
use Scolmore\InRiver\Resources\Model\Model;

class InRiver
{
    public string $version = '1.0.0';
    public ?string $url;
    private ?string $apiKey;

    public Channels $channels;
    public Entities $entities;
    public Extensions $extensions;
    public ExtensionManager $extensionmanager;
    public Packages $packages;
    public Links $links;
    public LinkRules $linkRules;
    public Media $media;
    public Model $model;

    public function __construct()
    {
        $this->url = config('inriver.inriver_url');
        $this->apiKey = config('inriver.inriver_api_key');

        $this->setupResources();
    }

    /**
     * @throws InRiverException
     */
    public function request(string $method, string $endpoint, array $data = []): array|null
    {
        $this->url = "{$this->url}/api/v{$this->version}/";

        $client = Http::timeout(30)
            ->withHeaders([
                'X-inRiver-APIKey' => $this->apiKey,
            ]);

        $response = $client->$method("{$this->url}{$endpoint}", $data);

        if ($response->successful()) {
            return $response->json();
        }

        throw new InRiverException([
            'status' => $response->status(),
            'code' => $response->json()['errorCode'] ?? null,
            'message' => $response->json()['errorMessage'] ?? null,
        ]);
    }

    public function setupResources(): void
    {
        $this->channels = new Channels($this);
        $this->entities = new Entities($this);
        $this->extensions = new Extensions($this);
        $this->extensionmanager = new ExtensionManager($this);
        $this->packages = new Packages($this);
        $this->links = new Links($this);
        $this->linkRules = new LinkRules($this);
        $this->media = new Media($this);
        $this->model = new Model($this);
    }
}
