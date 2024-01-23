<?php

use Illuminate\Support\Facades\Http;
use Scolmore\InRiver\Objects\Model\CategoryObject;
use Scolmore\InRiver\Objects\Model\CvlObject;
use Scolmore\InRiver\Objects\Model\CvlValueObject;

test('entity types are returned', function () {
    $this->fakeResponse([
        [
            'id' => 'string',
            'name' => 'string',
            'fieldTypes' => ['string'],
            'inboundLinkTypes' => ['string'],
            'outboundLinkTypes' => ['string'],
            'isLinkEntityType' => true,
            'fieldSetIds' => ['string'],
            'displayNameFieldTypeId' => 'string',
            'displayDescriptionFieldTypeId' => 'string',
        ],
    ], 200);

    $entityTypes = InRiver()->model->getAllEntityTypes();

    $this->assertCount(1, $entityTypes);
});

test('a new entity type can be added', function () {
    $this->fakeResponse([
        'id' => 'string',
        'name' => 'string',
        'fieldTypes' => ['string'],
        'inboundLinkTypes' => ['string'],
        'outboundLinkTypes' => ['string'],
        'isLinkEntityType' => true,
        'fieldSetIds' => ['string'],
        'displayNameFieldTypeId' => 'string',
        'displayDescriptionFieldTypeId' => 'string',
    ], 200);

    $newEntity = InRiver()->model->addEntityType('string', ['additionalProp1' => 'string'], false);

    $this->assertEquals('string', $newEntity['id']);
});

test('a single entity type gets returned', function () {
    $this->fakeResponse([
        'id' => 'string',
        'name' => 'string',
        'fieldTypes' => ['string'],
        'inboundLinkTypes' => ['string'],
        'outboundLinkTypes' => ['string'],
        'isLinkEntityType' => true,
        'fieldSetIds' => ['string'],
        'displayNameFieldTypeId' => 'string',
        'displayDescriptionFieldTypeId' => 'string',
    ], 200);

    $entityType = InRiver()->model->getEntityType('string');

    $this->assertEquals('string', $entityType['id']);
});

test('an entity type can be updated', function () {
    $this->fakeResponse([
        'id' => 'string',
        'name' => 'string',
        'fieldTypes' => ['string'],
        'inboundLinkTypes' => ['string'],
        'outboundLinkTypes' => ['string'],
        'isLinkEntityType' => false,
        'fieldSetIds' => ['string'],
        'displayNameFieldTypeId' => 'string',
        'displayDescriptionFieldTypeId' => 'string',
    ], 200);

    $entityType = InRiver()->model->updateEntityType('string', ['additionalProp1' => 'string'], false);

    $this->assertEquals('string', $entityType['id']);
});

test('an entity type can be deleted', function () {
    $this->fakeResponse(null, 200);

    $entityType = InRiver()->model->deleteEntityType('string');

    $this->assertEquals(null, $entityType);
});

test('all field types for an entity get returned', function () {
    $this->fakeResponse([
        0 => [
            'id' => 'string',
            'name' => [
                'additionalProp1' => 'string',
                'additionalProp2' => 'string',
                'additionalProp3' => 'string',
            ],
            'localizedName' => 'string',
            'description' => [
                'additionalProp1' => 'string',
                'additionalProp2' => 'string',
                'additionalProp3' => 'string',
            ],
            'localizedDescription' => 'string',
            'dataType' => 'string',
            'isMultiValue' => false,
            'isHidden' => false,
            'isReadOnly' => false,
            'isMandatory' => false,
            'isUnique' => false,
            'trackChanges' => false,
            'defaultValue' => 'string',
            'isExcludedFromDefaultView' => false,
            'includedInFieldSets' => [
                0 => 'string',
            ],
            'categoryId' => 'General',
            'index' => 0,
            'cvlId' => 'string',
            'parentCvlId' => 'string',
            'settings' => [
                'additionalProp1' => 'string',
                'additionalProp2' => 'string',
                'additionalProp3' => 'string',
            ],
        ],
    ], 200);

    $fieldTypes = InRiver()->model->getAllFieldTypesForEntityType('string');

    $this->assertCount(1, $fieldTypes);
});

test('a new field type can be created', function () {
    $this->fakeResponse($data = [
        'id' => 'string',
        'name' => [
            'additionalProp1' => 'string',
            'additionalProp2' => 'string',
            'additionalProp3' => 'string',
        ],
        'localizedName' => 'string',
        'description' => [
            'additionalProp1' => 'string',
            'additionalProp2' => 'string',
            'additionalProp3' => 'string',
        ],
        'localizedDescription' => 'string',
        'dataType' => 'string',
        'isMultiValue' => false,
        'isHidden' => false,
        'isReadOnly' => false,
        'isMandatory' => false,
        'isUnique' => false,
        'trackChanges' => false,
        'defaultValue' => 'string',
        'isExcludedFromDefaultView' => false,
        'includedInFieldSets' => [
            0 => 'string',
        ],
        'categoryId' => 'General',
        'index' => 0,
        'cvlId' => 'string',
        'parentCvlId' => 'string',
        'settings' => [
            'additionalProp1' => 'string',
            'additionalProp2' => 'string',
            'additionalProp3' => 'string',
        ],
    ], 200);

    $newField = InRiver()->model->addfieldType('string', $data);

    $this->assertEquals('string', $newField['id']);
});

test('a single field type can be returned', function () {
    $this->fakeResponse([
        'id' => 'string',
        'name' => [
            'additionalProp1' => 'string',
            'additionalProp2' => 'string',
            'additionalProp3' => 'string',
        ],
        'localizedName' => 'string',
        'description' => [
            'additionalProp1' => 'string',
            'additionalProp2' => 'string',
            'additionalProp3' => 'string',
        ],
        'localizedDescription' => 'string',
        'dataType' => 'string',
        'isMultiValue' => false,
        'isHidden' => false,
        'isReadOnly' => false,
        'isMandatory' => false,
        'isUnique' => false,
        'trackChanges' => false,
        'defaultValue' => 'string',
        'isExcludedFromDefaultView' => false,
        'includedInFieldSets' => [
            0 => 'string',
        ],
        'categoryId' => 'General',
        'index' => 0,
        'cvlId' => 'string',
        'parentCvlId' => 'string',
        'settings' => [
            'additionalProp1' => 'string',
            'additionalProp2' => 'string',
            'additionalProp3' => 'string',
        ],
    ], 200);

    $fieldType = InRiver()->model->getFieldType('string', 'string');

    $this->assertEquals('string', $fieldType['id']);
});

test('a field type can be updated', function () {
    $this->fakeResponse($data = [
        'id' => 'string',
        'name' => [
            'additionalProp1' => 'string',
            'additionalProp2' => 'string',
            'additionalProp3' => 'string',
        ],
        'localizedName' => 'string',
        'description' => [
            'additionalProp1' => 'string',
            'additionalProp2' => 'string',
            'additionalProp3' => 'string',
        ],
        'localizedDescription' => 'string',
        'dataType' => 'string',
        'isMultiValue' => false,
        'isHidden' => false,
        'isReadOnly' => false,
        'isMandatory' => false,
        'isUnique' => false,
        'trackChanges' => false,
        'defaultValue' => 'string',
        'isExcludedFromDefaultView' => false,
        'includedInFieldSets' => [
            0 => 'string',
        ],
        'categoryId' => 'General',
        'index' => 0,
        'cvlId' => 'string',
        'parentCvlId' => 'string',
        'settings' => [
            'additionalProp1' => 'string',
            'additionalProp2' => 'string',
            'additionalProp3' => 'string',
        ],
    ], 200);

    $field = InRiver()->model->updateFieldType('string', 'string', $data);

    $this->assertEquals('string', $field['id']);
});

test('a field can be deleted', function () {
    $this->fakeResponse(null, 204);

    $field = InRiver()->model->deleteFieldType('string', 'string');

    $this->assertEquals(null, $field);
});

test('all languages are returned', function () {
    $this->fakeResponse([
        [
            'name' => 'string',
            'displayName' => 'string',
        ],
    ], 200);

    $languages = InRiver()->model->getAllLanguages();

    $this->assertCount(1, $languages);
});

test('a new language can be added', function () {
    $this->fakeResponse([
        'name' => 'string',
        'displayName' => 'string',
    ], 200);

    $language = InRiver()->model->addLanguage('string');

    $this->assertEquals('string', $language['name']);
});

test('a language can be deleted', function () {
    $this->fakeResponse(null, 204);

    $language = InRiver()->model->deleteLanguage('string');

    $this->assertEquals(null, $language);
});

test('available field sets are returned', function () {
    $this->fakeResponse([
        [
            'fieldSetId' => 'string',
            'name' => 'string',
            'description' => 'string',
            'entityTypeId' => 'string',
            'fieldTypeIds' => [
                'string',
            ],
        ],
    ], 200);

    $fieldSets = InRiver()->model->getAllFieldSets();

    $this->assertCount(1, $fieldSets);
});

test('a new field set can be added', function () {
    $this->fakeResponse($data = [
        'fieldSetId' => 'string',
        'name' => [
            'additionalProp1' => 'string',
            'additionalProp2' => 'string',
            'additionalProp3' => 'string',
        ],
        'description' => [
            'additionalProp1' => 'string',
            'additionalProp2' => 'string',
            'additionalProp3' => 'string',
        ],
        'entityTypeId' => 'string',
        'fieldTypeIds' => [
            'string',
        ],
    ], 200);

    $fieldSet = InRiver()->model->addFieldSet($data);

    $this->assertEquals('string', $fieldSet['fieldSetId']);
});

test('a field set can be updated', function () {
    $this->fakeResponse($data = [
        'fieldSetId' => 'string',
        'name' => [
            'additionalProp1' => 'string',
            'additionalProp2' => 'string',
            'additionalProp3' => 'string',
        ],
        'description' => [
            'additionalProp1' => 'string',
            'additionalProp2' => 'string',
            'additionalProp3' => 'string',
        ],
        'entityTypeId' => 'string',
        'fieldTypeIds' => [
            'string',
        ],
    ], 200);

    $fieldSet = InRiver()->model->updateFieldSet('string', $data);

    $this->assertEquals('string', $fieldSet['fieldSetId']);
});

test('a field type can be added to a field set', function () {
    $this->fakeResponse(null, 204);

    $field = InRiver()->model->addFieldTypeToFieldSet('string', 'string');

    $this->assertEquals(null, $field);
});

test('a field type can be removed from a field set', function () {
    $this->fakeResponse(null, 204);

    $field = InRiver()->model->deleteFieldTypeToFieldSet('string', 'string');

    $this->assertEquals(null, $field);
});

test('a field set can be deleted', function () {
    $this->fakeResponse(null, 204);

    $fieldSet = InRiver()->model->deleteFieldSet('string');

    $this->assertEquals(null, $fieldSet);
});

test('all categories get returned', function () {
    $this->fakeResponse([
        [
            'id' => 'string',
            'name' => [
                'additionalProp1' => 'string',
                'additionalProp2' => 'string',
                'additionalProp3' => 'string',
            ],
            'index' => 1,
        ],
    ], 200);

    $categories = InRiver()->model->getAllCategories();

    $this->assertCount(1, $categories);
});

test('a category can be added', function () {
    $this->fakeResponse($data = [
        'id' => 'string',
        'name' => [
            'additionalProp1' => 'string',
            'additionalProp2' => 'string',
            'additionalProp3' => 'string',
        ],
        'index' => 1,
    ], 200);

    $category = InRiver()->model->addCategory($data);

    $this->assertEquals('string', $category['id']);
});

test('a category gets returned', function () {
    $this->fakeResponse([
        'id' => 'string',
        'name' => [
            'additionalProp1' => 'string',
            'additionalProp2' => 'string',
            'additionalProp3' => 'string',
        ],
        'index' => 1,
    ], 200);

    $category = InRiver()->model->getCategory('string');

    $this->assertEquals('string', $category['id']);
});

test('a category can be updated', function () {
    $this->fakeResponse($data = [
        'id' => 'string',
        'name' => [
            'additionalProp1' => 'string',
            'additionalProp2' => 'string',
            'additionalProp3' => 'string',
        ],
        'index' => 1,
    ], 200);

    $category = InRiver()->model->updateCategory('string', $data);

    $this->assertEquals('string', $category['id']);
});

test('a category can be deleted', function () {
    $this->fakeResponse(null, 204);

    $category = InRiver()->model->deleteCategory('string');

    $this->assertEquals(null, $category);
});

test('a new category object is generated', function () {
    $this->fakeResponse([
        [
            'name' => 'en',
            'displayName' => 'English',
        ],
    ], 200);

    $category = InRiver()->model->category->new();

    $this->assertEquals($category, new CategoryObject([]));
});

test('a category can be created from a category object', function () {
    Http::fake([
        '*languages*' => Http::response([
            [
                'name' => 'en',
                'displayName' => 'English',
            ],
        ], 200),
        '*category*' => Http::response($data = [
            'id' => 'Test',
            'name' => [
                'en' => 'test',
            ],
            'index' => 1,
        ], 200),
    ]);

    $category = InRiver()->model->category->new();

    $category->name->set('en', 'Test');
    $category->index = 1;

    $category->create();

    $this->assertEquals($category, new CategoryObject($data));
});

test('a category can be updated from a category object', function () {
    $this->fakeResponse($data = [
        'id' => 'Test',
        'name' => [
            'en' => 'Test',
        ],
        'index' => 1,
    ], 200);

    $category = InRiver()->model->category->get('Test');

    $category->name->set('en', 'Test');
    $category->index = 1;

    $category->update();

    $this->assertEquals($category, new CategoryObject($data));
});

test('a category can be deleted from a category object', function () {
    Http::fake([
        '*languages*' => Http::response([
            [
                'name' => 'en',
                'displayName' => 'English',
            ],
        ], 200),
        '*category*' => Http::response(null, 204),
    ]);

    $category = new CategoryObject([
        'id' => 'Test',
        'name' => [
            'en' => 'Test',
        ],
        'index' => 1,
    ]);

    $category->delete();

    $this->assertEquals($category, new CategoryObject([]));
});

test('a list of CVLs get returned', function () {
    $this->fakeResponse([
        [
            'id' => 'string',
            'parentId' => 'string',
            'dataType' => 'string',
        ],
        [
            'id' => 'string1',
            'parentId' => 'string1',
            'dataType' => 'string',
        ],
    ]);

    $cvls = InRiver()->model->getAllCVLs();

    $this->assertCount(2, $cvls);
});

test('a CVL can be added', function () {
    $this->fakeResponse([
        'id' => 'string',
        'parentId' => 'string',
        'dataType' => 'string',
        'customValueList' => false,
    ]);

    $cvl = InRiver()->model->addCVL('string', 'string', 'string', false);

    $this->assertEquals('string', $cvl['id']);
});

test('a single CVL can be returned', function () {
    $this->fakeResponse([
        'id' => 'string',
        'parentId' => 'string',
        'dataType' => 'string',
    ]);

    $cvl = InRiver()->model->getCVL('string');

    $this->assertEquals('string', $cvl['id']);
});

test('a CVL can be updated', function () {
    $this->fakeResponse([
        'id' => 'string',
        'parentId' => 'string',
        'dataType' => 'string',
        'customValueList' => false,
    ]);

    $cvl = InRiver()->model->updateCVL('string', 'string', 'string', false);

    $this->assertEquals('string', $cvl['id']);
});

test('a CVL can be deleted', function () {
    $this->fakeResponse(null, 204);

    $cvl = InRiver()->model->deleteCVL('string');

    $this->assertEquals(null, $cvl);
});

test('values for a CVL get returned', function () {
    $this->fakeResponse([
        [
            'key' => 'string',
            'value' => 'string',
            'index' => 0,
            'parentKey' => 'string',
            'deactivated' => true,
        ],
    ]);

    $cvlValues = InRiver()->model->getAllCvlValues('string');

    $this->assertCount(1, $cvlValues);
});

test('a new CVL value can be added', function () {
    $this->fakeResponse($data = [
        'key' => 'string',
        'value' => 'string',
        'index' => 0,
        'parentKey' => 'string',
        'deactivated' => true,
    ]);

    $cvlValue = InRiver()->model->createCvlValue('string', $data);

    $this->assertEquals('string', $cvlValue['key']);
});

test('a single CVL value can be returned', function () {
    $this->fakeResponse([
        'key' => 'string',
        'value' => 'string',
        'index' => 0,
        'parentKey' => 'string',
        'deactivated' => true,
    ]);

    $cvlValue = InRiver()->model->getCvlValue('string', 'string');

    $this->assertEquals('string', $cvlValue['key']);
});

test('a CVL value can be updated', function () {
    $this->fakeResponse($data = [
        'key' => 'string',
        'value' => 'string',
        'index' => 0,
        'parentKey' => 'string',
        'deactivated' => true,
    ]);

    $cvlValue = InRiver()->model->updateCvlValue('string', 'string', $data);

    $this->assertEquals('string', $cvlValue['key']);
});

test('a CVL value can be deleted', function () {
    $this->fakeResponse(null, 204);

    $cvlValue = InRiver()->model->deleteCvlValue('string', 'string');

    $this->assertEquals(null, $cvlValue);
});

test('all CVL are listed', function () {
    $this->fakeResponse($data = [
        [
            'id' => 'string',
            'parentId' => 'string',
            'dataType' => 'string',
        ],
    ]);

    $cvl = InRiver()->model->cvls->list();

    $this->assertCount(1, $cvl);
});

test('a new CVL object can be generated', function () {
    $cvl = InRiver()->model->cvls->new();

    $this->assertEquals($cvl, new CvlObject([]));
});

test('a new CVL can be created from a CVL object', function () {
    $this->fakeResponse($data = [
        'id' => 'string',
        'parentId' => 'string',
        'dataType' => 'string',
        'customValueList' => false,
    ]);

    $cvl = InRiver()->model->cvls->new();

    $cvl->id = 'string';
    $cvl->parentId = 'string';
    $cvl->dataType = 'string';
    $cvl->customValueList = false;

    $cvl->create();

    $this->assertEquals($cvl, new CvlObject($data));
});

test('a single CVL object gets returned', function () {
    $this->fakeResponse($data = [
        'id' => 'string',
        'parentId' => 'string',
        'dataType' => 'string',
    ]);

    $cvl = InRiver()->model->cvls->get('string');

    $this->assertEquals($cvl, new CvlObject($data));
});

test('a CVL can be updated from a CVL object', function () {
    $this->fakeResponse($data = [
        'id' => 'string',
        'parentId' => 'string',
        'dataType' => 'string',
        'customValueList' => false,
    ]);

    $cvl = InRiver()->model->cvls->get('string');

    $cvl->id = 'string';
    $cvl->parentId = 'string';
    $cvl->dataType = 'string';
    $cvl->customValueList = false;

    $cvl->update();

    $this->assertEquals($cvl, new CvlObject($data));
});

test('a CVL can be deleted from a CVL object', function () {
    $this->fakeResponse(null, 204);

    $cvl = new CvlObject([
        'id' => 'string',
        'parentId' => 'string',
        'dataType' => 'string',
        'customValueList' => false,
    ]);

    $cvl->delete();

    $this->assertEquals($cvl, new CvlObject([]));
});

test('all CVL values can be listed from a CVL object', function () {
    $this->fakeResponse([
        [
            'key' => 'string',
            'value' => 'string',
            'index' => 0,
            'parentKey' => 'string',
            'deactivated' => true,
        ],
    ]);

    $cvl = new CvlObject([
        'id' => 'string',
        'parentId' => 'string',
        'dataType' => 'string',
        'customValueList' => false,
    ]);

    $cvlValues = $cvl->values();

    $this->assertCount(1, $cvlValues);
});

test('a single value can be returned from a CVL object', function () {
    $this->fakeResponse([
        'key' => 'string',
        'value' => 'string',
        'index' => 0,
        'parentKey' => 'string',
        'deactivated' => true,
    ]);

    $cvl = new CvlObject([
        'id' => 'string',
        'parentId' => 'string',
        'dataType' => 'String',
        'customValueList' => false,
    ]);

    $cvlValue = $cvl->value('string');

    $this->assertEquals('string', $cvlValue->key);
});

test('a new value can be created from a CVL object', function () {
    $this->fakeResponse($data = [
        'key' => 'string',
        'value' => 'string',
        'index' => 0,
        'parentKey' => 'string',
        'deactivated' => true,
    ]);

    $cvl = new CvlObject([
        'id' => 'string',
        'parentId' => 'string',
        'dataType' => 'String',
        'customValueList' => false,
    ]);

    $cvlValue = $cvl->newValue();

    $cvlValue->key = 'string';
    $cvlValue->value = 'String';
    $cvlValue->index = 0;
    $cvlValue->parentKey = 'string';
    $cvlValue->deactivated = true;

    $cvlValue->create();

    $this->assertEquals($cvlValue, new CvlValueObject($cvl, $data));
});

test('a value object can be deleted from a CVL object', function () {
    $this->fakeResponse(null, 204);

    $cvl = new CvlObject([
        'id' => 'string',
        'parentId' => 'string',
        'dataType' => 'String',
        'customValueList' => false,
    ]);

    $cvlValue = new CvlValueObject($cvl, [
        'key' => 'string',
        'value' => 'String',
        'index' => 0,
        'parentKey' => 'string',
        'deactivated' => true,
    ]);

    $cvlValue->delete();

    $this->assertEquals($cvlValue, new CvlValueObject($cvl, []));
});
