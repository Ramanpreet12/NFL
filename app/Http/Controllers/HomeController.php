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
use App\Models\Player;
// use App\Models\Teams;
use App\Models\SectionHeading;
use DB;
use App\Models\Region;

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
        // dd($team_results);
    //     echo "<pre>";
    //  print_r($team_results);

    //    die();

        //get upcoming matches
        $upcoming_matches = Fixture::with('first_team_id' , 'second_team_id' , 'season')->inRandomOrder()->limit(4)->get();

        //get leaderboard
        $leaderboards = Leaderboard::with('teams')->get();

        //get regions
        //  $get_regions = Leaderboard::with('teams')->orderBy('pts', 'desc')->get()->groupBy('region')->toArray();
        //  $get_regions = Player::with('teams')->get();
        // $get_regions = Team::with('player')->orderBy('pts', 'desc')->get()->groupBy('region')->toArray();

        // $get_regions = Region::with(['teams','players'])->get();

        //17-04-2023 for leaderboard
        // $get_regions = Region::with(['teams'])->orderBy('position' , 'asc')->get()->groupBy('region');
         //18-04-2023 for leaderboard
        $get_regions = Region::with(['teams'])->orderBy('position' , 'asc')->get()->groupBy('region')->toArray();

        // $teams = Team::with(['player' , 'region'])->get()->toArray();
        //  $teams = Team::with('player')->orderBy('pts', 'desc')->get()->groupBy('region')->toArray();

    //     echo "<pre>";
    //  print_r($get_regions);

    //     die();
//     $region= [];
// foreach($get_regions as $k=> $l){

//     $ll = count($l[0]['teams']);
//     array_push($region,[$k=>$ll]);
    // foreach($l[0]['teams'] as $h=> $j){

        // echo "<pre>";
        // print_r($j);
//     }
// }
// echo "<pre>";
// print_r($region);
// die;



        //section heading

        $fixtureHeading = SectionHeading::where('name' , 'Upcoming Fixture')->first();
        $leaderboardHeading = SectionHeading::where('name' , 'leaderboard')->first();
        $videosHeading = SectionHeading::where('name' , 'Videos')->first();
        $newsHeading = SectionHeading::where('name' , 'News')->first();

        //get videos and news
        $news = News::where('type',"news")->where('status',"active")->get();
        $video = News::where('type',"video")->where('status',"active")->get();

        return view('home.index',compact('colorSection' , 'banners' ,'team_results' , 'upcoming_matches' ,'leaderboards' , 'news' ,'video' , 'menus' , 'mainMenus' , 'subMenus' , 'leaderboardHeading' , 'fixtureHeading' , 'leaderboardHeading' ,'videosHeading' ,'newsHeading' , 'get_regions'));
    }

}
