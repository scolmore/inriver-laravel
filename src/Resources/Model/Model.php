<?php

declare(strict_types=1);

namespace Scolmore\InRiver\Resources\Model;

use Scolmore\InRiver\Resources\AbstractResource;

class Model extends AbstractResource
{
    use EntityTypes;
    use Languages;
    use FieldSets;
    use Category;

    protected string $endpoint = 'model';
}
