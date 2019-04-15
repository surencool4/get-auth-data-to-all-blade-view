<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

use Illuminate\Support\Facades\Blade;
use View;
use App\Template;
use Auth;
// use App\User;

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
        Schema::defaultStringLength(191);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //compose all the views....

        view()->composer('*', function ($view) {
            if (Auth::check()){
                $template = Template::where('user_id', Auth::user()->id)->get()->first();
                $view->with('template', $template ); 
            }
        }); 


        Blade::if('env', function ($environment) {
            return app()->environment($environment);
        });
   
    }
}
