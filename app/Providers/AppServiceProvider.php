<?php

namespace App\Providers;

use App\Repositories\Interfaces\RoleInterface;
use App\Repositories\Interfaces\SubdivisionInterface;
use App\Repositories\Interfaces\UserInterface;
use App\Repositories\RoleRepository;
use App\Repositories\SubdivisionRepository;
use App\Repositories\UserRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            SubdivisionInterface::class,
            SubdivisionRepository::class
        );

        $this->app->bind(
            RoleInterface::class,
            RoleRepository::class
        );

        $this->app->bind(
            UserInterface::class,
            UserRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
    }
}
