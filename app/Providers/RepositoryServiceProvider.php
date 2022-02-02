<?php

namespace App\Providers;

use App\Repository\Contracts\InstituteRepositoryInterface;
use App\Repository\Mysql\InstituteRepository;
use Illuminate\Support\ServiceProvider;


class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(InstituteRepositoryInterface::class, InstituteRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

    }

}
