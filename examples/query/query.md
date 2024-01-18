## Query Usage

### Get entities that have been update since a date
```php
// Get all entity types that have been updated since a datetime.
$updateEntities = InRiver()->query->updatedSince(
    dateTime: now()->subDay()
);

// Optionally you can also only get entities of a specific type.
$updatedEntities = InRiver()->query->updatedSince(
    dateTime: now()->subDay(),
    entityTypeId: 'Product'
);
```

Have an idea for other useful queries? [Create an issue](https://github.com/scolmore/inriver-laravel/issues) or submit a pull request.
