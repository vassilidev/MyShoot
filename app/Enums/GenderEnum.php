<?php

namespace App\Enums;

enum GenderEnum: string
{
    case H = 'h';
    case F = 'f';

    /**
     * @return string|null
     */
    public function getGender(): ?string
    {
        return match ($this) {
            self::F => __('Women'),
            self::H => __('Man'),
        };
    }
}
