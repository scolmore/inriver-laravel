<?php

declare(strict_types=1);

namespace Scolmore\InRiver\Resources\Model;

use Scolmore\InRiver\Exceptions\InRiverException;
use Scolmore\InRiver\Objects\Model\LanguagesObject;

readonly class Languages
{
    public function __construct(
        private Model $model
    ) {}

    /**
     * @throws InRiverException
     */
    public function list(): LanguagesObject
    {
        return new LanguagesObject($this->model->getAllLanguages());
    }
}
