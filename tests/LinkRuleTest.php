<?php

test('all link rules get returned', function () {
    $responseBody = require __DIR__.'/responses/LinkRules/LinkRules.php';

    $this->fakeResponse($responseBody, 200);

    $linkRules = InRiver()->linkRules->getAllLinkRuleDefinitions();

    $this->assertCount(1, $linkRules);
});

test('a link rule can be deleted', function () {
    $this->fakeResponse(null, 200);

    $linkRule = InRiver()->linkRules->DeleteLinkRulesAsync([1]);

    $this->assertNull($linkRule);
});

test('a link rule definition can be returned for an entity', function () {
    $responseBody = require __DIR__.'/responses/LinkRules/LinkRules.php';

    $this->fakeResponse($responseBody, 200);

    $linkRuleDefinition = InRiver()->linkRules->getLinkRuleDefinitionsForEntity(1);

    $this->assertCount(1, $linkRuleDefinition);
});

test('link rules can be disabled', function () {
    $this->fakeResponse(null, 200);

    $linkRule = InRiver()->linkRules->disableLinkRulesAsync([1]);

    $this->assertNull($linkRule);
});

test('link rules can be enabled', function () {
    $this->fakeResponse(null, 200);

    $linkRule = InRiver()->linkRules->enableLinkRulesAsync([1]);

    $this->assertNull($linkRule);
});
