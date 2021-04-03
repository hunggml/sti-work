<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\WorkInterface;
use App\Repositories\UserInterface;
use App\Repositories\WorkRepositories;
use App\Repositories\UserRepositories;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind(WorkInterface::class,WorkRepositories::class);
        $this->app->bind(UserInterface::class,UserRepositories::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
