<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\General;
use Illuminate\Support\Facades\View;

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
       //site setting
        $general = General::first();
    //    $general_logo =  $this->helper->key_value('name', 'value', $general);
        View::share('general', $general);
    }
}
