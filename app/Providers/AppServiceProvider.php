<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\General;
use Illuminate\Support\Facades\View;
use App\Models\ColorSetting;
use App\Models\Menu;
use App\Models\StaticPage;
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
        $privacy_policy = StaticPage::where(['status' =>'active' , 'type' => 'privacy'])->first();

        View::share(['general'=> $general , 'colorSection' => $colorSection , 'mainMenus' => $mainMenus , 'subMenus' => $subMenus ,'privacy_policy' =>$privacy_policy]);


    }
}
