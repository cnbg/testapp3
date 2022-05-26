<?php

namespace App\Providers;

use App\Repositories\Eloquent\RowRepository;
use App\Repositories\Excel\RowImportRepository;
use App\Repositories\RowImportRepositoryInterface;
use App\Repositories\RowRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(RowRepositoryInterface::class, RowRepository::class);
        $this->app->bind(RowImportRepositoryInterface::class, RowImportRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
