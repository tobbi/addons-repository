<?php

namespace App\Providers;

use App\AddonType;
use App\SuperTuxVersion;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::share('versions', SuperTuxVersion::all());
        View::share('types', AddonType::all());
    }
}
