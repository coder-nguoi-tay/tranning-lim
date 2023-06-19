<?php

namespace App\Providers;

use App\Repository\Login\LoginInterface;
use App\Repository\Login\LoginRepository;
use App\Repository\Role\RoleInterface;
use App\Repository\Role\RoleRepository;
use App\Repository\User\UserRepository;
use App\Repository\User\UserInterface;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;



class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */

    public function register(): void
    {
        $this->app->bind(UserInterface::class, UserRepository::class);
        $this->app->bind(RoleInterface::class, RoleRepository::class);
        $this->app->bind(LoginInterface::class, LoginRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(GateContract  $gate): void
    {
    }
}
