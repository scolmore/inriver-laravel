<?php

declare(strict_types=1);

namespace Scolmore\InRiver\Objects\Model;

class LanguagesObject
{
    private array $languages;

    public function __construct(array $languages)
    {
        if (isset($languages[0]['name'])) {
            $this->languages = collect($languages)
                ->keyBy('name')
                ->map(fn($language) => '')
                ->toArray();
        } else {
            $this->languages = collect($languages)
                ->map(fn($language) => $language)
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
