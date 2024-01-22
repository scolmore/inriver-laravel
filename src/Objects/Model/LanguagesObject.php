<?php

declare(strict_types=1);

namespace Scolmore\InRiver\Objects\Model;

use Scolmore\InRiver\Exceptions\InRiverException;

class LanguagesObject
{
    private array $languages;

    /**
     * @throws InRiverException
     */
    public function __construct(array|string $languages)
    {
        if (is_string($languages) || isset($languages[0])) {
            $this->languages = collect(InRiver()->model->getAllLanguages())
                ->keyBy('name')
                ->map(fn ($language) => null)
                ->toArray();

            if (is_string($languages)) {
                $this->languages[array_key_first($this->languages)] = $languages;
            }
        } elseif (isset($languages[0]['name'])) {
            $this->languages = collect($languages)
                ->keyBy('name')
                ->map(fn ($language) => null)
                ->toArray();
        } else {
            $this->languages = collect($languages)
                ->map(fn ($language) => $language)
                ->toArray();
        }
    }

    public function get(string $code): string
    {
        return $this->languages[$code];
    }

    public function set(string $languageCode, string $value): void
    {
        $this->languages[$languageCode] = $value;
    }

    public function toArray(): array
    {
        return $this->languages;
    }
}
