<?php

declare(strict_types=1);

namespace Scolmore\InRiver\Objects\Model;

use Illuminate\Support\Carbon;
use Scolmore\InRiver\Exceptions\InRiverException;

readonly class SpecificationTemplateObject
{
    public int $id;
    public ?string $displayName;
    public ?string $displayDescription;
    public ?string $version;
    public ?string $createdBy;
    public ?Carbon $createdDate;
    public ?string $formattedCreatedDate;
    public ?string $modifiedBy;
    public ?Carbon $modifiedDate;
    public ?string $formattedModifiedDate;
    public ?string $resourceUrl;
    public ?string $entityTypeId;
    public ?string $entityTypeDisplayName;
    public ?int $completeness;
    public ?string $fieldSetId;
    public ?string $fieldSetName;
    public int $segmentId;
    public ?string $segmentName;

    public function __construct(array $specificationTemplateModel)
    {
        $this->id = $specificationTemplateModel['id'] ?? null;
        $this->displayName = $specificationTemplateModel['displayName'] ?? null;
        $this->displayDescription = $specificationTemplateModel['displayDescription'] ?? null;
        $this->version = $specificationTemplateModel['version'] ?? null;
        $this->createdBy = $specificationTemplateModel['createdBy'] ?? null;
        $this->createdDate = $specificationTemplateModel['createdDate']
            ? Carbon::parse($specificationTemplateModel['createdDate'])
            : null;
        $this->formattedCreatedDate = $specificationTemplateModel['formattedCreatedDate'] ?? null;
        $this->modifiedBy = $specificationTemplateModel['modifiedBy'] ?? null;
        $this->modifiedDate = $specificationTemplateModel['modifiedDate']
            ? Carbon::parse($specificationTemplateModel['modifiedDate'])
            : null;
        $this->formattedModifiedDate = $specificationTemplateModel['formattedModifiedDate'] ?? null;
        $this->resourceUrl = $specificationTemplateModel['resourceUrl'] ?? null;
        $this->entityTypeId = $specificationTemplateModel['entityTypeId'] ?? null;
        $this->entityTypeDisplayName = $specificationTemplateModel['entityTypeDisplayName'] ?? null;
        $this->completeness = $specificationTemplateModel['completeness'] ?? null;
        $this->fieldSetId = $specificationTemplateModel['fieldSetId'] ?? null;
        $this->fieldSetName = $specificationTemplateModel['fieldSetName'] ?? null;
        $this->segmentId = $specificationTemplateModel['segmentId'] ?? null;
        $this->segmentName = $specificationTemplateModel['segmentName'] ?? null;
    }

    /**
     * @throws InRiverException
     */
    public function fieldTypes(): array
    {
        return InRiver()->model->getSpecificationTemplateFields($this->id);
    }
}
