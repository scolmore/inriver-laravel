<?php

declare(strict_types=1);

namespace Scolmore\InRiver\Resources\Model;

use Scolmore\InRiver\Exceptions\InRiverException;
use Scolmore\InRiver\Objects\Model\SpecificationTemplateObject;

readonly class SpecificationTemplates
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
        $templates = $this->model->getAllSpecificationTemplates();

        return collect($templates)
            ->map(fn (array $template) => new SpecificationTemplateObject($template))
            ->toArray();
    }

    /**
     * @throws InRiverException
     */
    public function get(int $specificationId): SpecificationTemplateObject
    {
        $templates = $this->list();

        foreach ($templates as $template) {
            if ($template->id === $specificationId) {
                return $template;
            }
        }

        throw new InRiverException(['Specification ID' => 'Not found']);
    }
}
