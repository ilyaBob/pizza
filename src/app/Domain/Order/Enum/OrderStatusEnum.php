<?php

namespace Domain\Order\Enum;

use App\Enum\EnumTrait;

enum OrderStatusEnum: int
{
    use EnumTrait;

    case IN_PROGRESS = 1;
    case WORK = 2;
    case DELIVERY = 3;
    case COMPLETED = 4;
}
