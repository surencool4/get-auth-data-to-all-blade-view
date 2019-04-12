<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

use View;
use App\Cart;
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
        // (Auth::check())

        // $template = Template::where('user_id',1)->get()->first();

        // View::share([
        //     'template'=> $template,
        // ]);

        //compose all the views....
        view()->composer('*', function ($view) {
            $cart = Cart::where('user_id', Auth::user()->id)->get()->first();
            $view->with('cart', $cart );    
        }); 

        
   
    }
}

