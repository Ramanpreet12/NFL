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
use App\Models\Reviews;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\SubscriptionExpire;
use Illuminate\Support\Facades\Log;
use Cache;


class HomeController extends Controller
{


    private function getTheTopPlayersDataBasedOnRegion($region="",$limit=3,$alphabet="",$group=""){
        $leaderboard_data = array();

        $leaderBoard_users_win_data_1  = DB::table('user_teams')
        ->select((DB::raw("COUNT(user_teams.points) as total_win_pts_in_region")) , 'user_teams.user_id as user_id' ,'users.name as user_name' , 'user_teams.points as user_pts' , 'regions.region as region_name' , 'teams.logo as team_logo' , 'teams.name as team_name')
        ->join('teams' , 'teams.id' , '=' , 'user_teams.team_id')
        ->join('users' , 'users.id' , '=' , 'user_teams.user_id')
        ->join('regions', 'regions.id', '=', 'user_teams.user_region_id');

         if(isset($alphabet) && !empty($alphabet)){
            $leaderBoard_users_win_data_1->where('users.name', 'like', "{$alphabet}%");
         }
         if(isset($group) && !empty($group)){
            $leaderBoard_users_win_data_1->where('users.group',$group);
         }
         $leaderBoard_users_win_data_1->where('user_teams.points', '=' , 1)
        ->where('regions.region', '=' , $region)
        ->groupBy(['region_name','user_id'])
        ->orderBy('total_win_pts_in_region','DESC')
        ->limit($limit);

        $leaderBoard_users_win_data = $leaderBoard_users_win_data_1->get();
        // dd($leaderBoard_users_win_data);

         if($leaderBoard_users_win_data->isNotEmpty()){
            foreach($leaderBoard_users_win_data as $leaderBoard_user_win_data){
                $leaderboard_data[$leaderBoard_user_win_data->user_id]['user_name'] =$leaderBoard_user_win_data->user_name;
                $leaderboard_data[$leaderBoard_user_win_data->user_id]['team_logo'] =$leaderBoard_user_win_data->team_logo;
                $leaderboard_data[$leaderBoard_user_win_data->user_id]['user_points']['win'] = $leaderBoard_user_win_data->total_win_pts_in_region;
            }
         }

        $leaderBoard_users_loss_data_1  = DB::table('user_teams')
        ->select((DB::raw("COUNT(user_teams.points) as total_loss_pts_in_region")) , 'user_teams.user_id as user_id' ,'users.name as user_name' , 'user_teams.points as user_pts' , 'regions.region as region_name' , 'teams.logo as team_logo' , 'teams.name as team_name')
        ->join('teams' , 'teams.id' , '=' , 'user_teams.team_id')
        ->join('users' , 'users.id' , '=' , 'user_teams.user_id')
        ->join('regions', 'regions.id', '=', 'user_teams.user_region_id');
        if(isset($alphabet) && !empty($alphabet)){
            $leaderBoard_users_loss_data_1->where('users.name', 'like', "{$alphabet}%");
         }
         if(isset($group) && !empty($group)){
            $leaderBoard_users_loss_data_1->where('users.group',$group);
         }
         $leaderBoard_users_loss_data_1->groupBy(['region_name','user_id'])
        ->orderBy('total_loss_pts_in_region','ASC')
        ->limit($limit)
        ->where('user_teams.points', '=' , 2)
        ->where('regions.region', '=' ,$region);

        $leaderBoard_users_loss_data = $leaderBoard_users_loss_data_1->get();

        //get the users with 0 points
        $leaderBoard_users_null_data_1  = DB::table('user_teams')
        ->select('user_teams.user_id as user_id' ,'users.name as user_name' , 'user_teams.points as user_pts' , 'regions.region as region_name' , 'teams.logo as team_logo' , 'teams.name as team_name')
        ->join('teams' , 'teams.id' , '=' , 'user_teams.team_id')
        ->join('users' , 'users.id' , '=' , 'user_teams.user_id')
        ->join('regions', 'regions.id', '=', 'user_teams.user_region_id');
        if(isset($alphabet) && !empty($alphabet)){
            $leaderBoard_users_null_data_1->where('users.name', 'like', "{$alphabet}%");
         }
         if(isset($group) && !empty($group)){
            $leaderBoard_users_null_data_1->where('users.group',$group);
         }
         $leaderBoard_users_null_data_1->groupBy(['region_name','user_id'])

        ->limit($limit)
        ->where('user_teams.points', '=' , 0)
        ->where('regions.region', '=' ,$region);

        $leaderBoard_users_null_data = $leaderBoard_users_null_data_1->get();


        if($leaderBoard_users_win_data->isEmpty()){
            foreach($leaderBoard_users_loss_data as $leaderBoard_user_loss_data){
                $leaderboard_data[$leaderBoard_user_loss_data->user_id]['user_name'] =$leaderBoard_user_loss_data->user_name;
                $leaderboard_data[$leaderBoard_user_loss_data->user_id]['team_logo'] =$leaderBoard_user_loss_data->team_logo;
                $leaderboard_data[$leaderBoard_user_loss_data->user_id]['user_points']['loss'] = $leaderBoard_user_loss_data->total_loss_pts_in_region;
                $leaderboard_data[$leaderBoard_user_loss_data->user_id]['user_points']['win'] = 0;
            }
         }


         else{

            foreach($leaderBoard_users_loss_data as $leaderBoard_user_loss_data){
                $leaderboard_data[$leaderBoard_user_loss_data->user_id]['user_name'] =$leaderBoard_user_loss_data->user_name;
                $leaderboard_data[$leaderBoard_user_loss_data->user_id]['team_logo'] =$leaderBoard_user_loss_data->team_logo;
                $leaderboard_data[$leaderBoard_user_loss_data->user_id]['user_points']['loss'] = $leaderBoard_user_loss_data->total_loss_pts_in_region;

                if(isset( $leaderboard_data[$leaderBoard_user_loss_data->user_id]['user_points']['win'])){
                    $leaderboard_data[$leaderBoard_user_loss_data->user_id]['user_points']['win']  =  $leaderboard_data[$leaderBoard_user_loss_data->user_id]['user_points']['win'];
                }else{
                    $leaderboard_data[$leaderBoard_user_loss_data->user_id]['user_points']['win']  =  0;
                }
            }
         }



         if( $leaderboard_data){
            foreach($leaderboard_data as $user_id_as_key => $leaderboard){
                if(empty($leaderboard['user_points']['loss'])){
                    $leaderboard_data[$user_id_as_key]['user_points']['loss'] = 0;
                }
            }
         }

        $get_count   = count($leaderboard_data);





        if($get_count<3){

        $leaderBoard_users_null_data_1  = DB::table('user_teams')
        ->select('user_teams.user_id as user_id' ,'users.name as user_name' , 'user_teams.points as user_pts' , 'regions.region as region_name' , 'teams.logo as team_logo' , 'teams.name as team_name')
        ->join('teams' , 'teams.id' , '=' , 'user_teams.team_id')
        ->join('users' , 'users.id' , '=' , 'user_teams.user_id')
        ->join('regions', 'regions.id', '=', 'user_teams.user_region_id');



        if(isset($alphabet) && !empty($alphabet)){
            $leaderBoard_users_null_data_1->where('users.name', 'like', "{$alphabet}%");
         }
         if(isset($group) && !empty($group)){
            $leaderBoard_users_null_data_1->where('users.group',$group);
         }
         $leaderBoard_users_null_data_1->groupBy(['region_name','user_id'])

        ->limit(3-$get_count)
        ->where('user_teams.points', '=' , 0)
        ->where('regions.region', '=' ,$region);

        $leaderBoard_users_null_data = $leaderBoard_users_null_data_1->get();

        // dd($leaderBoard_users_null_data);
        if($leaderBoard_users_null_data->isNotempty()){
          foreach($leaderBoard_users_null_data as $leaderBoard_users_null_data_single_player){

            if(!array_key_exists($leaderBoard_users_null_data_single_player->user_id,$leaderboard_data)){
            $leaderboard_data[$leaderBoard_users_null_data_single_player->user_id]['user_name'] =$leaderBoard_users_null_data_single_player->user_name;
            $leaderboard_data[$leaderBoard_users_null_data_single_player->user_id]['team_logo'] =$leaderBoard_users_null_data_single_player->team_logo;
            $leaderboard_data[$leaderBoard_users_null_data_single_player->user_id]['user_points']['loss'] = 0;
            $leaderboard_data[$leaderBoard_users_null_data_single_player->user_id]['user_points']['win']  = 0;
            }


           }
              return  $leaderboard_data;
           }

        }

        return  $leaderboard_data;

    }

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
        $matchBoards = Fixture::with('first_team_id' , 'second_team_id' , 'season')->inRandomOrder()->limit(1)->get();
        $upcoming_matches = Fixture::with('first_team_id', 'second_team_id', 'season')->inRandomOrder()->limit(6)->get();

        if (Cache::has('leader_board_regions_wise_users_results')) {

            $leader_board_regions_wise_users_results =  Cache::get('leader_board_regions_wise_users_results');
        }else{
            // $empty_leaderBoard_data = array();
            $leader_board_regions_wise_user_result = array();
            $leader_board_regions_wise_user_result['North'] =    $this->getTheTopPlayersDataBasedOnRegion('North');
            $leader_board_regions_wise_user_result['East'] =    $this->getTheTopPlayersDataBasedOnRegion('East');
            $leader_board_regions_wise_user_result['South'] =    $this->getTheTopPlayersDataBasedOnRegion('South');
            $leader_board_regions_wise_user_result['West'] =    $this->getTheTopPlayersDataBasedOnRegion('West');
            $leader_board_regions_wise_user_result['Mid-West'] =    $this->getTheTopPlayersDataBasedOnRegion('Mid-West');
            $leader_board_regions_wise_user_result['Overseas'] =    $this->getTheTopPlayersDataBasedOnRegion('Overseas');
            $leader_board_regions_wise_users_results  =  $leader_board_regions_wise_user_result;
            Cache::put('leader_board_regions_wise_users_results', $leader_board_regions_wise_user_result, now()->addMinutes(60));
        }


        $fixtureHeading = SectionHeading::where('name', 'Upcoming Fixture')->first();
        $leaderboardHeading = SectionHeading::where('name', 'leaderboard')->first();
        $videosHeading = SectionHeading::where('name', 'Vacation')->first();
        $newsHeading = SectionHeading::where('name', 'News')->first();
        $playerRosterHeading = SectionHeading::where('name' , 'Player Roster')->first();
        $reviewsHeading = SectionHeading::where('name' , 'Reviews')->first();

        //get videos and news
        $news = News::where('type', "news")->where('status', "active")->get();
        // $video = News::where('type',"video")->where('status',"active")->get();
        $vacations = Vacation::where('status', "active")->get();
        //get reviews
        $get_reviews = Reviews::inRandomOrder()->limit(10)->get();

        $get_teams = Team::where('status' , 'active')->select('logo')->get();

        return view('home.index',compact('get_teams' , 'get_reviews' ,'colorSection' , 'banners', 'upcoming_matches' ,'leader_board_regions_wise_users_results', 'news' ,'vacations' , 'menus' , 'mainMenus' , 'subMenus' , 'leaderboardHeading' , 'fixtureHeading' , 'leaderboardHeading' ,'playerRosterHeading','videosHeading' ,'newsHeading' ,'matchBoards' ,'reviewsHeading'));
    }


    //  private function getPlayersData($group='',$PlayerName=''){
    //     $roster_data_query = DB::table('user_teams')
    //     ->join('teams' , 'teams.id' , '=' , 'user_teams.team_id')
    //     ->join('users' , 'users.id' , '=' , 'user_teams.user_id')
    //     ->join('regions', 'regions.id', '=', 'teams.region_id')
    //     ->select('')
    //     ->orderBy('position' , 'asc');

    //     if(isset($PlayerName)){
    //         $roster_data_query->where('users.name', 'like', "{$PlayerName}%");
    //       }

    //     $roster_data_query->where('users.group',$group);
    //     $customer_players_data = $roster_data_query->get()->groupBy(['region']);

    //      if($customer_players_data->isEmpty()){
    //         return 0;
    //      };


    //     if(Cache::has('regions')){
    //         $PlayersRegions = Cache::get('regions');
    //       }else{
    //          $get_regions =  Region::where('status' , 'active')->select('region')->get();
    //          $PlayersRegions =  Cache::put('regions', $get_regions);
    //       }
    //        $roster_data = [];
    //        foreach($PlayersRegions as $regions){
    //         if(isset($customer_players_data[$regions->region])){
    //             $roster_data[$regions->region] = $customer_players_data[$regions->region];
    //         }else{
    //             $roster_data[$regions->region] = collect([]);
    //         }
    //        }
    //        return   $roster_data;

    //  }

    private function getPlayersData($group='',$PlayerName='' , $region = ""){
        $roster_data = array();
        $roster_win_data_query  = DB::table('user_teams')
        ->select((DB::raw("COUNT(user_teams.points) as total_win_pts_in_region")) , 'user_teams.user_id as user_id' ,'users.name as user_name' , 'user_teams.points as user_pts' , 'regions.region as region_name' , 'teams.logo as team_logo' , 'teams.name as team_name')
        ->join('teams' , 'teams.id' , '=' , 'user_teams.team_id')
        ->join('users' , 'users.id' , '=' , 'user_teams.user_id')
        ->join('regions', 'regions.id', '=', 'user_teams.user_region_id')
        ->groupBy(['region_name','user_id'])
        ->orderBy('total_win_pts_in_region','DESC')
        ->limit(3)
        ->where('user_teams.points', '!=' , 0)
        ->where('regions.region', '=' , 'North')
        ->get();




        if(isset($PlayerName)){
            $roster_win_data_query->where('users.name', 'like', "{$PlayerName}%");
          }

        $roster_win_data_query->where('users.group',$group);
        if($roster_win_data_query->isNotEmpty()){
            foreach($roster_win_data_query as $roster_win_data){
                $roster_data[$roster_win_data->user_id]['user_name'] =$roster_win_data->user_name;
                $roster_data[$roster_win_data->user_id]['team_logo'] =$roster_win_data->team_logo;
                $roster_data[$roster_win_data->user_id]['user_points']['win'] = $roster_win_data->total_win_pts_in_region;
            }
         }

         $roster_loss_data_query  = DB::table('user_teams')
        ->select((DB::raw("COUNT(user_teams.points) as total_loss_pts_in_region")) , 'user_teams.user_id as user_id' ,'users.name as user_name' , 'user_teams.points as user_pts' , 'regions.region as region_name' , 'teams.logo as team_logo' , 'teams.name as team_name')
        ->join('teams' , 'teams.id' , '=' , 'user_teams.team_id')
        ->join('users' , 'users.id' , '=' , 'user_teams.user_id')
        ->join('regions', 'regions.id', '=', 'user_teams.user_region_id')
        ->groupBy(['region_name','user_id'])
        ->orderBy('total_loss_pts_in_region','ASC')
        ->limit(3)
        ->where('user_teams.points', '=' , 0)
        ->where('regions.region', '=' ,'North')
        ->get();


         dd($roster_loss_data_query);

        // $customer_players_data = $roster_data_query->get()->groupBy(['region']);

        //  if($customer_players_data->isEmpty()){
        //     return 0;
        //  };


        // if(Cache::has('regions')){
        //     $PlayersRegions = Cache::get('regions');
        //   }else{
        //      $get_regions =  Region::where('status' , 'active')->select('region')->get();
        //      $PlayersRegions =  Cache::put('regions', $get_regions);
        //   }
        //    $roster_data = [];
        //    foreach($PlayersRegions as $regions){
        //     if(isset($customer_players_data[$regions->region])){
        //         $roster_data[$regions->region] = $customer_players_data[$regions->region];
        //     }else{
        //         $roster_data[$regions->region] = collect([]);
        //     }
        // }
         //  return   $roster_data;

     }


    public function getAlphabets(Request $request)
    {
        $name = $request->letters;
        $gp = $request->path;
        $roster_data=[];
        $roster_data['North'] =  $this->getTheTopPlayersDataBasedOnRegion('North',100,$name,$gp);
        $roster_data['East'] =  $this->getTheTopPlayersDataBasedOnRegion('East',100,$name,$gp);
        $roster_data['South'] =  $this->getTheTopPlayersDataBasedOnRegion('South',100,$name,$gp);
        $roster_data['West'] =  $this->getTheTopPlayersDataBasedOnRegion('West',100,$name,$gp);
        $roster_data['Mid-West'] =  $this->getTheTopPlayersDataBasedOnRegion('Mid-West',100,$name,$gp);
        $roster_data['Overseas'] =  $this->getTheTopPlayersDataBasedOnRegion('Overseas',100,$name,$gp);

        foreach($roster_data as $rd){
            $region = $rd;
            if(!empty($region)){
                // return response()->json(['roster_data' =>  $roster_data, 'status' => true], 200);
                $msg = $roster_data;
                $status = "true";
                break;
            }else{
               $msg = "error";
               $status = "false";
            }
        }

        return response()->json(['roster_data' => $msg, 'status' => $status]);

        // if ($roster_data) {
        //     return response()->json(['roster_data' =>  $roster_data, 'status' => true], 200);
        // } else {
        //     return response()->json(['roster_data' =>  'error', 'status' => false], 200);
        // }
    }

    public function player_roster($alphabets)
    {
        $gp = $alphabets;
        $roster_data['North'] =  $this->getTheTopPlayersDataBasedOnRegion('North',100,'',$gp);
        $roster_data['East'] =  $this->getTheTopPlayersDataBasedOnRegion('East',100,'',$gp);
        $roster_data['South'] =  $this->getTheTopPlayersDataBasedOnRegion('South',100,'',$gp);
        $roster_data['West'] =  $this->getTheTopPlayersDataBasedOnRegion('West',100,'',$gp);
        $roster_data['Mid-West'] =  $this->getTheTopPlayersDataBasedOnRegion('Mid-West',100,'',$gp);
        $roster_data['Overseas'] =  $this->getTheTopPlayersDataBasedOnRegion('Overseas',100,'',$gp);





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
