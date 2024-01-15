## Languages Usage

### Get a list of all languages
Return all languages in an array.
```php
$languages = InRiver()->model->languages->list();
```

### Creating a language

```php
// Name of Windows-only culture name.
// For example, 'en', 'en-US' etc.
$category = InRiver()->model->languages->create('languageCode');
```

### Deleting a language

```php
// Pass the language code to delete.
InRiver()->model->languages->delete('languageCode');
```
