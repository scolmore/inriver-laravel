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
