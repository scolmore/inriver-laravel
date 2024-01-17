## Links Usage

### Get a link by ID
Return a single link.
```php
$link = InRiver()->links->get(linkId);
```

### Create a new link
```php
$link = InRiver()->links->new();

$link->linkTypeId = 'ProductItem';
$link->sourceEntityId = 55;
$link->targetEntityId = 43;
// Set index to 0 to add the link to first position. Set index to null to add the link to last position. Specifying the index will reorganize all link indices.
$link->index = null;

$link->save();
```

### Update a link
Update if the link is active and/or it's order position (index).
```php
$link = InRiver()->links->get(linkId);

$link->isActive = false;
// Changing the index will re-order the order links automatically.
$link->index = 3;

$link->update();
```

### Delete a link
```php
$link = InRiver()->links->get(linkId);

$link->delete();
```
