<?php

namespace Domain\User\Enum;

use App\Enum\EnumTrait;

enum RoleEnum: int
{
    use EnumTrait;

    case ADMIN = 1;
    case USER = 2;
}
