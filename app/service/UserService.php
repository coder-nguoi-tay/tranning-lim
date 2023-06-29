<?php

namespace App\service;


class UserService
{
    function generateTrackingNumber()
    {
        $prefix = 'DH';
        $randomPart = substr(uniqid(), -6);
        $trackingNumber = $prefix . $randomPart;
        return $trackingNumber;
    }
}
