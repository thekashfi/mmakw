<?php

namespace App\Providers;
use App\Clients;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
		Schema::defaultStringLength(191);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        View::composer(['website.*'], function ($view) {
            $clients = Clients::where("is_active","1")->whereNotNull('image')->where('image', '!=', '')->take(10)->get();
            $view->with('clients', $clients);
        });
    }
}
