<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\General;
use Illuminate\Support\Facades\View;
use App\Models\ColorSetting;
use App\Models\Menu;
use Illuminate\Pagination\Paginator;


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
        Paginator::useBootstrap();
        $mainMenus = Menu::where('parent_id' , 0)->get();
        $subMenus = Menu::where('parent_id' , '!=' , 0)->get();


        $colorSection=array();
        $color_setting = ColorSetting::get();
        if(!empty($color_setting)){
            foreach($color_setting as $color){
                $colorSection[$color['section']]=$color;
            }
        }
        // View::share('colorSection' , $colorSection);


       //site setting
        $general = General::first();
    //    $general_logo =  $this->helper->key_value('name', 'value', $general);
        // View::share('general', $general);
        View::share(['general'=> $general , 'colorSection' => $colorSection , 'mainMenus' => $mainMenus , 'subMenus' => $subMenus ]);
    }
}
