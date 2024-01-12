<?php

declare(strict_types=1);

namespace Scolmore\InRiver\Resources\Model;

use Scolmore\InRiver\Exceptions\InRiverException;

readonly class Languages
{
    public function __construct(
        private Model $model
    ) {}

    /**
     * @throws InRiverException
     */
    public function list(): array
    {
        return $this->model->getAllLanguages();
    }
}
