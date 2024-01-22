<?php

declare(strict_types=1);

namespace Scolmore\InRiver\Resources\Model;

use Scolmore\InRiver\Exceptions\InRiverException;
use Scolmore\InRiver\Objects\Model\CvlObject;

readonly class Cvls
{
    public function __construct(
        private Model $model
    ) {
    }

    /**
     * @throws InRiverException
     */
    public function list(): array
    {
        return $this->model->getAllCvls();
    }

    public function new(): CvlObject
    {
        return new CvlObject([]);
    }

    /**
     * @throws InRiverException
     */
    public function get(string $cvlId): CvlObject
    {
        $cvl = $this->model->getCvl($cvlId);

        return new CvlObject($cvl);
    }
}
