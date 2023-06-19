<?php

namespace App\Repository\Login;


interface LoginInterface
{
    public function login($request);
    public function register($request);
}
