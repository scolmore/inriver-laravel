## CVL's Usage

### Get a list of all CVL's
Return all CVL's.
```php
$cvls = InRiver()->model->cvls->list();
```

### Create a new CVL
```php
$cvl = InRiver()->model->cvls->new();

$cvl->id = 'TestCvl';
$cvl->dataType = 'String';

$cvl->create();
```

### Get a single CVL
```php
$cvl = InRiver()->model->cvls->get('cvlId');
```

### Update a CVL
```php
$cvl = InRiver()->model->cvls->get('TestCvl');

$cvl->dataType = 'LocalString';
        
$cvl->update();
```

### Delete a CVL
```php
$cvl = InRiver()->model->cvls->get('TestCvl');

$cvl->delete();
```

### Return all values for a CVL
```php
$cvl = InRiver()->model->cvls->get('TestCvl');

$values = $cvl->values();
```

### Return a single value for a CVL
```php
$cvl = InRiver()->model->cvls->get('TestCvl');

$value = $cvl->value('ValueKey');
```

### Create a new CVL value for a CVL
```php
$cvl = InRiver()->model->cvls->get('TestCvl');

$value = $cvl->newValue();

$value->key = 'NewValue';

// If the CVL type is LocalString
$value->value->set('en', 'New Value');
// Or if the CVL type is String
$value->value = 'New Value';

$value->index = 1;

$value->create();
```

### Update a CVL value for a CVL
```php
$cvl = InRiver()->model->cvls->get('TestCvl');

$value = $cvl->value('ExistingValue');

// If the CVL type is LocalString
$value->value->set('en', 'New Value');
// Or if the CVL type is String
$value->value = 'New Value';

$value->update();
```

### Delete a CVL value for a CVL
```php
$cvl = InRiver()->model->cvls->get('TestCvl');

$value = $cvl->value('ExistingValue');

$value->delete();
```

