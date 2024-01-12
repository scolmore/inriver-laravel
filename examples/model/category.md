## Category Usage

When retrieving a category from the API, it will be set as a CategoryObject with the name values set as a LanguageObject.

### Get a list of all categories
Return all categories in an array.
```php
$categories = InRiver()->model->category->list();
```

### Get a category by ID
Return a single category as a CategoryResource.
```php
$category = InRiver()->model->category->get('CategoryId');
```

### Creating a category

```php
// Get a new category object.
$category = InRiver()->model->category->new();

// Set the properties.
$category->id = 'categoryId';
$category->name->set('en', 'Category Name');
$category->index = 1;

// Create the category.
$category->create();
```

### Updating a category

```php
// Retrieve an existing category via the ID (string).
$category = InRiver()->model->category->get('categoryId');

// Update the name of the category for any language(s) setup on the system.
$category->name->set('en', 'Hello');
$category->name->set('fr', 'Bonjour');

// Update the category.
$category->update();
```

### Deleting a category

```php
// Retrieve an existing category via the ID (string)
$category = InRiver()->model->category->get('category-id');

// Delete the category
$category->delete();
```
