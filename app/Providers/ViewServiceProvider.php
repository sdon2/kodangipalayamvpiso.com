<?php

namespace App\Providers;

use App\View\Composers\MenuComposer;
use App\View\Composers\MainSliderComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('layouts.guest', MenuComposer::class);
        View::composer('page', MainSliderComposer::class);
    }
}
