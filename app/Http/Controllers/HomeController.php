<?php

namespace App\Http\Controllers;

use App\Models\ColorSetting;
use App\Models\Banner;
use App\Http\Controllers\Controller;
use App\Models\Team;
// use App\Models\TeamResult;
use App\Models\Fixture;
use App\Models\Leaderboard;
use App\Models\News;
use App\Models\Menu;
use App\Models\SectionHeading;
use Illuminate\Support\Facades\DB;
use App\Models\Region;
use App\Models\Vacation;
use Illuminate\Http\Request;
use App\Models\Season;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\SubscriptionExpire;
use Illuminate\Support\Facades\Log;


class HomeController extends Controller
{


    public function index()
    {
        //get menu

        $menus = Menu::with('menu')->where('status', 'active')->get();
        $mainMenus = Menu::where('parent_id', 0)->get();
        $subMenus = Menu::where('parent_id', '!=', 0)->get();
        $colorSection = array();
        $color_setting = ColorSetting::get();
        if (!empty($color_setting)) {
            foreach ($color_setting as $color) {
                $colorSection[$color['section']] = $color;
            }
        }
        //get banners
        $banners = Banner::where('status', 'Active')->get();

        //get Team results
        //  $team_results = TeamResult::with('team_result_id1' , 'team_result_id2')->where('status' , 'active')->inRandomOrder()->limit(1)->get();

        $matchBoards = Fixture::with('first_team_id' , 'second_team_id' , 'season')->inRandomOrder()->limit(1)->get();
      //  dd($matchBoards);
        //get upcoming matches
        $upcoming_matches = Fixture::with('first_team_id', 'second_team_id', 'season')->inRandomOrder()->limit(4)->get();

        //get leaderboard
        // $leaderboards = Leaderboard::with('teams')->get();

        //get regions for leaderboard
        // $get_regions = Region::with(['teams'])->orderBy('position' , 'asc')->get()->groupBy('region')->toArray();
        // dd($get_regions);

        $leaderBoard_data = DB::table('user_teams')
        ->join('teams' , 'teams.id' , '=' , 'user_teams.team_id')
        ->join('users' , 'users.id' , '=' , 'user_teams.user_id')
        ->join('regions', 'regions.id', '=', 'teams.region_id')
        ->orderBy('position' , 'asc')->get()->groupBy('region')->toArray();

    //   echo "<pre>";
    //   print_r($leaderBoard_data);
    //   die();

        //get user based on alphabets

        //section heading

        $fixtureHeading = SectionHeading::where('name', 'Upcoming Fixture')->first();
        $leaderboardHeading = SectionHeading::where('name', 'leaderboard')->first();
        $videosHeading = SectionHeading::where('name', 'Videos')->first();
        $newsHeading = SectionHeading::where('name', 'News')->first();

        //get videos and news
        $news = News::where('type', "news")->where('status', "active")->get();
        // $video = News::where('type',"video")->where('status',"active")->get();
        $vacations = Vacation::where('status', "active")->get();

        return view('home.index',compact('colorSection' , 'banners', 'upcoming_matches' ,'leaderBoard_data', 'news' ,'vacations' , 'menus' , 'mainMenus' , 'subMenus' , 'leaderboardHeading' , 'fixtureHeading' , 'leaderboardHeading' ,'videosHeading' ,'newsHeading' ,'matchBoards'));
    }

    public function getAlphabets(Request $request)
    {
        $name = $request->letters;
        $gp = $request->path;
        $roster_data = DB::table('teams')
            ->join('users', 'users.team_id', '=', 'teams.id')
            ->join('regions', 'regions.id', '=', 'teams.region_id')
            ->orderBy('position', 'asc')
            ->where('users.name', 'like', "{$name}%")
            ->where('group', $gp)
            ->get()->groupBy(['region']);
        if ($roster_data) {
            return response()->json(['roster_data' =>  $roster_data, 'status' => true], 200);
        } else {
            return response()->json(['roster_data' =>  '', 'status' => false], 401);
        }
    }

    public function player_roster($alphabets)
    {
        $gp = $alphabets;

        // $roster_data = DB::table('teams')
        // ->join('users', 'users.team_id', '=', 'teams.id')
        // ->join('regions', 'regions.id', '=', 'teams.region_id')
        // ->orderBy('position' , 'asc')
        // ->where('group',$gp)
        // ->get()->groupBy(['region']);


        $roster_data = DB::table('user_teams')
        ->join('teams' , 'teams.id' , '=' , 'user_teams.team_id')
        ->join('users' , 'users.id' , '=' , 'user_teams.user_id')
        ->join('regions', 'regions.id', '=', 'teams.region_id')
        ->orderBy('position' , 'asc')
        ->where('users.group',$gp)
        ->get()->groupBy(['region']);


        // echo "<pre>";
        // print_r($roster_data);
        // die();

        return view('front.playerRoster' , compact('roster_data'));
    }

    public function checkPlan()
    {
        try {
            $now = Carbon::now();
            $ex_date = $now->addDays();
            $data = DB::table('seasons')->where('starting', '<=', $now)->where('ending', '>=', $now)->get();
            if ($data->isNotEmpty()) {
                foreach ($data as $key => $value) {
                    $ex = DB::table('payments as p')->join('users', 'users.id', 'p.user_id')->where('p.season_id', $value->id)->whereDate('p.expire_on', '=', $ex_date)->get();
                    foreach ($ex as $k => $v) {
                       Mail::to($v->email)->send(new SubscriptionExpire($v));
                    }
                }
            }
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }
}
