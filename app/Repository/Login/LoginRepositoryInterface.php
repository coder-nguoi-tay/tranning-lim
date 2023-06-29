<?php

namespace App\Repository\Login;


interface LoginRepositoryInterface
{
    public function login($request);
    public function register($request);
}
