<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Cart;

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
        Schema::defaultStringLength(191);
        

        view()->composer('*', function($v){
            if(Cart::isEmpty()){
                $count = 0;
            }
            else{
                $count = count(Cart::getContent());
            }            
            $v->with(['cart_count' => $count]);
        });

    }
}
