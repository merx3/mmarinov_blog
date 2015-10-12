<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Category;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $categories = Category::orderBy('name')->get();
        view()->share('navCategories', $categories);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
