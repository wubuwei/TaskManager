<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //类似于路由写法，直接调用类及方法，最后不加 @compose 因为会默认调用
        view()->composer('layouts.app', 'App\Http\ViewComposers\TaskCountComposer');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
