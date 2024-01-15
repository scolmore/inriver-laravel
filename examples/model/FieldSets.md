## FieldSet Usage

### Get a list of all field sets
Return available field sets.
```php
$fieldSets = InRiver()->model->fieldsets->list();
```

### Creating a field set
```php
// Create a new field set build up of field type IDs and allow it to be added to a certain entity.
$fieldSet = InRiver()->model->fieldsets->new();

// Set the ID of the field set.
$fieldSet->fieldSetId = 'FieldSetId';

// Set the name (for any languages setup on the system).
$fieldSet->name->set('en', 'Field Set Name');

// Set the description (for any languages setup on the system).
$fieldSet->description->set('en', 'Field Set Description');

// Set the entity type EG. Product or Item.
$fieldSet->entityTypeId = 'Product';

// Add the field type IDs that should be included in the field set.
$fieldSet->fieldTypeIds = [
    'FieldType1',
    'FieldType2',
    'FieldType3',
];

// Save the field set.
$fieldSet->create();
```

### Updating a field set
Please note that InRiver does not currently have an endpoint for getting a single field set, so we have to loop over the list and this does not include languages so updates will clear other languages for name and description.
```php
$fieldSet = InRiver()->model->fieldsets->get('FieldSetId');

// Update the name and/or description (for any languages setup on the system, please see above message).
$fieldSet->name->set('en', 'New Field Set Name');
$fieldSet->description->set('en', 'New Field Set Description');

// Change what entity it belongs to.
$fieldSet->entityTypeId = 'Item';

// Add or remove field types from the original list.
$fieldSet->fieldTypeIds = [
    'FieldType1',
    'FieldType2',
    'FieldType3',
];

// Update the field set.
$fieldSet->update();
```

### Deleting a field set
```php
// Retrieve an existing field set via the ID (string).
$fieldSet = InRiver()->model->fieldsets->get('FieldSetId');

// Delete the field set.
$fieldSet->delete();
```
