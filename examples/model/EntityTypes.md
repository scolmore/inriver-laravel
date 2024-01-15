## EntityTypes Usage

### Get a list of all entity types
Return available entity types.
```php
$entityTypes = InRiver()->model->entitytypes->list();

// Optionally, you can filter the list by entity type ID by passing a comma separated list of IDs.
$entityTypes = InRiver()->model->entitytypes->list('Product,Item');
```

### Creating an entity type
```php
$entityType = InRiver()->model->entitytypes->new();

// Set the ID of the entity type.
$entityType->id = 'EntityName';

// Set the name (for any languages setup on the system).
$entityType->name->set('en', 'EntityName');

// Set if the entity type is a link type (default false).
$entityType->isLinkEntityType = false;

// Save the entity type.
$entityType->create();
```

### Updating an entity type
```php
$entityType = InRiver()->model->entitytypes->get('EntityName');

// Update the entity name.
$entityType->name->set('en', 'New entity type name');

// Update the is link entity type.
$entityType->isLinkEntityType = true;

// Update the entity type.
$entityType->update();
```

### Deleting an entity type
```php
// Retrieve an existing entity type via the ID (string).
$entityType = InRiver()->model->entitytypes->get('EntityName');

// Delete the entity type
$entityType->delete();
```

### Get a list of all entity type fields types
```php
// Retrieve an existing entity type via the ID (string).
$entityType = InRiver()->model->entitytypes->get('EntityName');

$fieldTypes = $entityType->fieldTypes();
```

### Get information for a specific field type
```php
// Retrieve an existing entity type via the ID (string).
$entityType = InRiver()->model->entitytypes->get('EntityName');

$fieldType = $entityType->fieldType('FieldTypeId');
```

### Create a new field type
```php
// Retrieve an existing entity type via the ID (string).
$entityType = InRiver()->model->entitytypes->get('EntityName');

// Get a new field type object.
$fieldType = $entityType->newFieldType();

// Set the properties that need to be set.
$fieldType->id = 'FieldTypeId';
$fieldType->name->set('en', 'Field Type Name');
$fieldType->description->set('en', 'Field Type Description');
$fieldType->dataType = 'String';
$fieldType->index = 1;

$fieldType->create();
```

### Update a field type
```php
$productEntityType = InRiver()->model->entitytypes->get('TestEntity');

$fieldType = $productEntityType->fieldType('FieldTypeId');

$fieldType->name->set('en', 'A New Name');

$fieldType->update();
```

### Delete a field type
```php
$productEntityType = InRiver()->model->entitytypes->get('TestEntity');

$fieldType = $productEntityType->fieldType('FieldTypeId');

$fieldType->delete();
```


