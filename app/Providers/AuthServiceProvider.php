<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Bill;
use App\Models\User;
use App\Models\Portfolio;
use App\Policies\BillPolicy;
use App\Policies\UserPolicy;
use App\Policies\PortfolioPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        User::class => UserPolicy::class,
        Bill::class => BillPolicy::class,
        Portfolio::class => PortfolioPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
