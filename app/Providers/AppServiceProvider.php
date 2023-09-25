<?php

namespace App\Providers;

use App\Repository\FeeRepository;
use App\Repository\ProfileRepository;
use App\Repository\StudentRepository;
use Illuminate\Support\ServiceProvider;
use App\Repository\Interface\FeeInterface;
use App\Repository\Interface\ProfileInterface;
use App\Repository\Interface\StudentInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(StudentInterface::class,StudentRepository::class);
        $this->app->bind(ProfileInterface::class,ProfileRepository::class);
        $this->app->bind(FeeInterface::class,FeeRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
