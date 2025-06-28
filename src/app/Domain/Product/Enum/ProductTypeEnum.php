<?php

namespace Domain\Product\Enum;

use App\Enum\EnumTrait;

enum ProductTypeEnum: int
{
    use EnumTrait;

    case PIZZA = 1;
    case DRINK = 2;
}
