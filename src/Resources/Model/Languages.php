<?php

declare(strict_types=1);

namespace Scolmore\InRiver\Resources\Model;

use Scolmore\InRiver\Exceptions\InRiverException;
use Scolmore\InRiver\Objects\Model\LanguagesObject;

trait Languages
{
    /**
     * @throws InRiverException
     */
    public function listLanguages(): LanguagesObject
    {
        return new LanguagesObject($this->getAllLanguages());
    }

    /**
     * Return available languages.
     *
     * @return array
     *
     * @throws InRiverException
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Model/GetAllLanguages
     */
    public function getAllLanguages(): array
    {
        return $this->inRiver()->request(
            method: 'GET',
            endpoint: $this->endpoint('/languages')
        );
    }

    /**
     * Add a language.
     *
     * @param  string  $languageISOCode
     * @return array
     *
     * @throws InRiverException
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Model/AddLanguage
     */
    public function addLanguage(string $languageISOCode): array
    {
        return $this->inRiver()->request(
            method: 'POST',
            endpoint: $this->endpoint('/languages'),
            data: [
                'name' => $languageISOCode,
            ]
        );
    }

    /**
     * Remove a language.
     *
     * @param  string  $languageISOCode
     * @return null
     *
     * @throws InRiverException
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Model/DeleteLanguage
     */
    public function deleteLanguage(string $languageISOCode): null
    {
        return $this->inRiver()->request(
            method: 'DELETE',
            endpoint: $this->endpoint("/languages/{$languageISOCode}")
        );
    }
}
