<?php

namespace App\Http\Controllers;
use App\Models\ColorSetting;
use App\Models\Banner;
use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Models\TeamResult;
use App\Models\Fixture;
use App\Models\Leaderboard;
use App\Models\News;
use App\Models\Menu;
use DB;


class HomeController extends Controller
{


    public function index()
    {
        //get menu

        $menus = Menu::with('menu')->where('status' , 'active')->get();


        // dd($menus_data);
        // echo "<pre>";
        // print_r($menus);
        $mainMenus = Menu::where('parent_id' , 0)->get();
        $subMenus = Menu::where('parent_id' , '!=' , 0)->get();

    //   $menus =   DB::table('menus AS mainMenu')
    // ->join('menus AS subMenu','mainMenu.id',"=",'subMenu.parent_id')->get();

    //     echo "<pre>";
    //     print_r($menus);
    //     echo "<pre>";
    //     die();

        $colorSection=array();
        $color_setting = ColorSetting::get();
        if(!empty($color_setting)){
            foreach($color_setting as $color){
                $colorSection[$color['section']]=$color;
            }
        }
        //get banners
        $banners = Banner::where('status' , 'Active')->get();

        // //get team
        // $teams = Team::where('status' , 'active')->inRandomOrder()->limit(1)->get();
        //get Team results
        $team_results = TeamResult::with('team_result_id1' , 'team_result_id2')->where('status' , 'active')->inRandomOrder()->limit(1)->get();

        //get upcoming matches
        $upcoming_matches = Fixture::with('first_team_id' , 'second_team_id' , 'season')->inRandomOrder()->limit(4)->get();

        //get leaderboard
        $leaderboards = Leaderboard::with('teams')->get();

        //get videos and news
        $news = News::where('type',"news")->where('status',"active")->get();
        $video = News::where('type',"video")->where('status',"active")->get();

        return view('home.index',compact('colorSection' , 'banners' ,'team_results' , 'upcoming_matches' ,'leaderboards' , 'news' ,'video' , 'menus' , 'mainMenus' , 'subMenus'));
    }

}
