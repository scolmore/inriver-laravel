## Restricted Fields

### Get a list of all restricted fields
Returns all restricted field permissions.
```php
$restrictedFields = InRiver()->model->restrictedfields->list();
```

### Get a single restricted field
```php
$restrictedField = InRiver()->model->restrictedfields->get(restrictedFieldId);
```

### Create a restricted field
```php
$restrictedField = InRiver()->model->restrictedfields->new();

$restrictedField->entityTypeId = 'Item';
$restrictedField->fieldTypeId = 'ItemDIYMarket';
$restrictedField->categoryId = 'General';
$restrictedField->restrictionType = 'Readonly';
$restrictedField->roleId = 1;

$restrictedField->create();
```

### Delete a restricted field
```php
$restrictedField = InRiver()->model->restrictedfields->new();

$restrictedField->delete();
```
