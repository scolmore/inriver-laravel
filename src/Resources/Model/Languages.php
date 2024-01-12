<?php

declare(strict_types=1);

namespace Scolmore\InRiver\Resources\Model;

trait Languages
{
    /**
     * Return available languages.
     *
     * @return array
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Model/GetAllLanguages
     */
    public function getAllLanguages(): array
    {
        return $this->inRiver()->request(
            method: 'GET',
            endpoint: $this->endpoint()
        );
    }

    /**
     * Add a language.
     *
     * @param  string  $name
     * @return array
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Model/AddLanguage
     */
    public function addLanguage(string $name): array
    {
        return $this->inRiver()->request(
            method: 'POST',
            endpoint: $this->endpoint(),
            data: [
                'name' => $name,
            ]
        );
    }

    /**
     * Remove a language.
     *
     * @param  string  $languageCode
     * @return array
     *
     * @see https://apieuw.productmarketingcloud.com/swagger/index.html#/Model/DeleteLanguage
     */
    public function deleteLanguage(string $languageCode): array
    {
        return $this->inRiver()->request(
            method: 'DELETE',
            endpoint: $this->endpoint("/{$languageCode}")
        );
    }
}
