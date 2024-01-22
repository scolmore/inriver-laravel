## EntityTypes Usage

### Create a new entity
Create a new entity in the system.
```php
$entity = InRiver()->entities->new('Item');

// Set the value of a specific field
$entity->setField('ItemNumber', 'ABC123')

// Create the entity
$entity->create();
```

### Update an existing entity's fields.
```php
$entity = InRiver()->entities->get(123);

$entity->setField('ItemNumber', 'ABC123');

$entity->update();
```

### Delete an entity
```php
$entity = InRiver()->entities->get(123);

$entity->delete();
```

### Get details about an entity
```php
$entity = InRiver()->entities->get(123);
```

### Get information about multiple entities
```php
// Pass multiple entity IDs as an array
$entities = InRiver()->entities->list([
    123,
    124
]);
```


