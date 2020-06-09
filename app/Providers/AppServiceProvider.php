<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Cart;
use Auth;
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
            if(Auth::user()){
                $userID = Auth::user()->id;
                if(Cart::session($userID)->isEmpty()){
                    $count = 0;
                }
                else{
                    $count = count(Cart::session($userID)->getContent());
                }            
            }else{
                $count = 0;
            }
            $user = Auth::user();
            $v->with(['cart_count' => $count,'user'=>$user]);
        });

    }
}
