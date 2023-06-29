<?php

namespace App\Providers;

use App\Repository\Login\LoginRepository;
use App\Repository\Login\LoginRepositoryInterface;
use App\Repository\Package\PackageRepository;
use App\Repository\Package\PackageRepositoryInterface;
use App\Repository\Role\RoleRepository;
use App\Repository\Role\RoleRepositoryInterface;
use App\Repository\Shipment\ShipmentRepository;
use App\Repository\Shipment\ShipmentRepositoryInterface;
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
        $this->app->bind(PackageRepositoryInterface::class, PackageRepository::class);
        $this->app->bind(ShipmentRepositoryInterface::class, ShipmentRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(GateContract  $gate): void
    {
    }
}
