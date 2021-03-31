<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\WorkInterface;
use App\Repositories\WorkRepositories;
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
