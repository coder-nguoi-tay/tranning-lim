<?php

namespace App\service;


class UserService
{
    public function isAdmin($array = [], $role = [])
    {
        foreach ($array as $value) {
            if (in_array($value, $role)) {
                return true;
            }
        }
        return false;
    }
}
