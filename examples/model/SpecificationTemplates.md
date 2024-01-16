## Specification Templates

### Get a list of all specification templates
Returns all specification templates.
```php
$specificationTemplates = InRiver()->model->specificationtemplates->list();
```

### Get a single specification template
```php
$specificationTemplate = InRiver()->model->specificationtemplates->get(SpecificationTemplateId);
```

### Get all field types for a specification template
Returns field types for passed specification template.
```php
$specificationTemplate = InRiver()->model->specificationtemplates->get(SpecificationTemplateId);

$fieldTypes = $specificationTemplate->fieldTypes();
```
