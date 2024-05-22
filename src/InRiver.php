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
use Scolmore\InRiver\Resources\Query\Query;
use Scolmore\InRiver\Resources\Syndicate\Syndicate;
use Scolmore\InRiver\Resources\System\System;
use Scolmore\InRiver\Resources\Workarea\WorkareaFolder;
use Scolmore\InRiver\Resources\Workarea\WorkareaFolders;
use Scolmore\InRiver\Resources\Workarea\WorkareaFolderTree;

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

    public Query $query;

    public Syndicate $syndicate;

    public System $system;

    public WorkareaFolders $workareafolders;

    public WorkareaFolderTree $workareafoldertree;

    public WorkareaFolder $workareafolder;

    /**
     * @throws InRiverException
     */
    public function __construct()
    {
        $this->url = config('inriver.inriver_url');
        $this->apiKey = config('inriver.inriver_api_key');

        if (is_null($this->url)) {
            throw new InRiverException([
                'status' => 500,
                'code' => 'INRIVER_URL_NOT_SET',
                'message' => 'The inRiver URL has not been set.',
            ]);
        }

        if (is_null($this->apiKey)) {
            throw new InRiverException([
                'status' => 500,
                'code' => 'INRIVER_API_KEY_NOT_SET',
                'message' => 'The inRiver API key has not been set.',
            ]);
        }

        $this->setupResources();
    }

    /**
     * @throws InRiverException
     */
    public function request(string $method, string $endpoint, array $data = []): ?array
    {
        $this->url = "{$this->url}/api/v{$this->version}/";

        $client = Http::timeout(config('inriver.inriver_timeout'))
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
        $this->query = new Query($this);
        $this->syndicate = new Syndicate($this);
        $this->system = new System($this);
        $this->workareafolders = new WorkareaFolders($this);
        $this->workareafoldertree = new WorkareaFolderTree($this);
        $this->workareafolder = new WorkareaFolder($this);
    }
}
