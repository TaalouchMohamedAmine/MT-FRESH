<?php

namespace App\Models\Concerns;

trait HasLocalizedFields
{
    public function translated(string $field, ?string $locale = null): string
    {
        $value = $this->getAttribute($field);

        if (! is_array($value)) {
            return (string) $value;
        }

        $locale ??= app()->getLocale();

        return (string) ($value[$locale] ?? $value['fr'] ?? $value['en'] ?? reset($value) ?: '');
    }
}
