<?php

test('all link rules get returned', function () {
    $responseBody = require __DIR__.'/responses/LinkRules/LinkRules.php';

    $this->fakeResponse($responseBody, 200);

    $linkRules = InRiver()->linkRules->getAllLinkRuleDefinitions();

    expect($linkRules)->toBeArray()->toHaveCount(1);
});

test('a link rule can be deleted', function () {
    $this->fakeResponse(null, 200);

    $linkRules = InRiver()->linkRules->deleteLinkRulesAsync([1]);

    expect($linkRules)->toBeNull();
});

test('a link rule definition can be returned for an entity', function () {
    $responseBody = require __DIR__.'/responses/LinkRules/LinkRules.php';

    $this->fakeResponse($responseBody, 200);

    $linkRuleDefinition = InRiver()->linkRules->getLinkRuleDefinitionsForEntity(1);

    expect($linkRuleDefinition)->toBeArray()->toHaveCount(1);
});

test('link rules can be disabled', function () {
    $this->fakeResponse(null, 200);

    $linkRule = InRiver()->linkRules->disableLinkRulesAsync([1]);

    expect($linkRule)->toBeNull();
});

test('link rules can be enabled', function () {
    $this->fakeResponse(null, 200);

    $linkRule = InRiver()->linkRules->enableLinkRulesAsync([1]);

    expect($linkRule)->toBeNull();
});
