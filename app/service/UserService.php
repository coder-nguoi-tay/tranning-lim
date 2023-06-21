<?php

namespace App\service;


class UserService
{
    public function isAdmin($array = [], $role = [])
    {
        foreach ($array as $value) {
            if (array_search($value, $role)) {
                return true;
            }
        }
        return false;
    }
    function generateTrackingNumber()
    {
        $prefix = 'DH';
        $randomPart = substr(uniqid(), -6);
        $trackingNumber = $prefix . $randomPart;
        return $trackingNumber;
    }
}
