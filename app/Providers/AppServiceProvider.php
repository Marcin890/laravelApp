<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\App;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if (App::environment('local'))
        {
                        
            $this->app->bind(\App\memApp\Interfaces\FrontendRepositoryInterface::class,function()
            {            
                return new \App\memApp\Repositories\FrontendRepository;
            });
  
        }
        else
        {
            
            $this->app->bind(\App\memApp\Interfaces\FrontendRepositoryInterface::class,function()
            {            
                return new \App\memApp\Repositories\CachedFrontendRepository;
            });  

        }

        $this->app->bind(\App\memApp\Interfaces\FrontendRepositoryInterface::class,function()
        {            
            return new \App\memApp\Repositories\FrontendRepository;
        });

        
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', '\App\memApp\ViewComposers\FrontendComposer');

        View::composer('frontend.*', function($view) {
            $view->with('user_placeholder', asset('images/user_placeholder.png'));
        });

        if (App::environment('local'))
        {
            
           View::composer('*', function ($view) {
            $view->with('novalidate', 'novalidate');
            });
  
        }
        else
        {
            View::composer('*', function ($view) {
            $view->with('novalidate', null);
            });
        }
    }
}