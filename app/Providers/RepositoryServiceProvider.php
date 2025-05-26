<?php

namespace App\Providers;

use App\repositories\contracts\MessageRepositoryContract;
use App\repositories\contracts\UserRepositoryContract;
use App\repositories\MessageRepository;
use App\repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(MessageRepositoryContract::class , MessageRepository::class);
        $this->app->bind(UserRepositoryContract::class , UserRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
