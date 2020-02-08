<?php

namespace App\Providers;

use Illuminate\Support\Facades\Notification;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

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
        app()->singleton('lang',function(){
            if(auth()->user()){
                if(empty(auth()->user()->lang))
                {
                    return 'en';
                }else{
                    return auth()->user()->lang;
                }
            }else{
                if(session()->has('lang')){
                   return session()->get('lang');
                }else{
                    return'en';
                }

            }
        });
        Schema::defaultStringLength(191);
    }
}
