<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Repositories\Contracts\BookContract;
use App\Http\Repositories\Contracts\ExportContract;
use App\Http\Repositories\BookRepository;
use App\Http\Repositories\ExportRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(BookContract::class, BookRepository::class);
        $this->app->bind(ExportContract::class, ExportRepository::class);
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
