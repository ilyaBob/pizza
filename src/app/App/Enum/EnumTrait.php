<?php

namespace App\Enum;

trait EnumTrait
{
    public static function getValues(): array
    {
        return collect(static::cases())->pluck('value')->toArray();
    }

    public static function getValuesString(): string
    {
        return implode(',', static::getValues());
    }

    public static function randomValue(): string|int
    {
        $key = array_rand(self::cases());
        return self::cases()[$key]->value;
    }
}
