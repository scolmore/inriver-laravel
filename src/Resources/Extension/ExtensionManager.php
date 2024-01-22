<?php

declare(strict_types=1);

namespace Scolmore\InRiver\Resources\Extension;

use Scolmore\InRiver\Exceptions\InRiverException;
use Scolmore\InRiver\Resources\AbstractResource;

class ExtensionManager extends AbstractResource
{
    protected string $endpoint = 'extensionmanager';

    /**
     * Restart all extensions.
     *
     * @throws InRiverException
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Extension/RestartServiceAsync
     */
    public function restartServiceAsync(): array
    {
        return $this->inRiver()->request(
            method: 'POST',
            endpoint: $this->endpoint(':restartservice')
        );
    }
}
