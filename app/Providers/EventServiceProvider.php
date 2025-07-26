<?php

namespace App\Providers;

use App\Listeners\Auth\AssignClientRoleListener;
use App\Listeners\Auth\SetupCompanySessionListener;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected array $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
            AssignClientRoleListener::class,
        ],
        Login::class => [
            SetupCompanySessionListener::class,
        ],
    ];

    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
