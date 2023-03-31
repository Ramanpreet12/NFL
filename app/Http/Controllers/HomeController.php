<?php

namespace App\Http\Controllers;
use App\Models\ColorSetting;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{

   
    public function index()
    {
        $colorSection=array();
        $color_setting = ColorSetting::get();
        if(!empty($color_setting)){
            foreach($color_setting as $color){
                $colorSection[$color['section']]=$color;
            }
        }
      
        return view('home.index',compact('colorSection'));
    }

}