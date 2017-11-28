<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Providers\share;
use Illuminate\Support\Facades\Schema;
use App\categories;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        View::share('publicurl','resources/assets/templates/public');
        View::share('templates.public', 'App\Http\Views\Composers\ProductFromComposer');
        View::share('App\Http\Views\Composers\ProductFromComposer', 'templates.public');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }
}
