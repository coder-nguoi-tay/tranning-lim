<?php

namespace App\Enums;

use Spatie\Enum\Laravel\Enum;

final class UserRoleEnum extends Enum
{
    const CUSTOMER = 1;
    const ADMIN = 2;
    const EMPLOY = 3;
    const SYSTEMADMIN = 4;
    public static function Role()
    {
        return [2, 3, 4];
    }
}
