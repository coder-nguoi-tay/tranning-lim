<?php

namespace App\Providers;

use App\Repository\Login\LoginRepository;
use App\Repository\Login\LoginRepositoryInterface;
use App\Repository\Role\RoleRepository;
use App\Repository\Role\RoleRepositoryInterface;
use App\Repository\User\UserRepository;
use App\Repository\User\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;



class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */

    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(RoleRepositoryInterface::class, RoleRepository::class);
        $this->app->bind(LoginRepositoryInterface::class, LoginRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(GateContract  $gate): void
    {
    }
}
