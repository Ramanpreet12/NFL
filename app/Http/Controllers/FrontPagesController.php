<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\ContactPage;
use App\Models\StaticPage;
use App\Models\Fixture;
use App\Models\Team;
use App\Models\MatchResult;

use App\Models\UserTeam;
use App\Models\Season;
use App\Models\Prize;
use App\Models\Reviews;
use App\Models\Payment;
use App\Models\General;
use App\Models\GeneralSetting;
use App\Models\SectionHeading;
use App\Http\Requests\ReviewsRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Auth;

class FrontPagesController extends Controller
{
    private $league_id = 1 ;// league id basically determines the leagues for eg NFL ,FIFA etc
    public function test()
    {
       return ('hello');
    }
    public function contact(Request $request)
    {
        // if ($request->isMethod('POST')) {
        //     dd($request);

        //     $request->validate([
        //         'name'=> 'required|min:4|max:20',
        //         'subject'=>'required',
        //         'email'=>'required|email',
        //         'g-capcha'=>'required'
        //     ]);
        //    $contact =  Contact::create($request->all());
        //    if($contact){
        //     return redirect()->back()->with('success','We got your request and contact you soon!');
        //    }else{
        //     return redirect()->back()->with('error','Request is not sent');
        //    }

        // }else{
        //     return view('front.contact');
        // }

        if ($request->isMethod('POST')) {

            $request->validate([
                        'name'=> 'required',
                        'subject'=>'required',
                        'email'=>'required|email',
                        'message' => 'required',
                        'g-capcha'=>'required'
                    ]);

            $url = 'https://www.google.com/recaptcha/api/siteverify';
            $remoteip = $_SERVER['REMOTE_ADDR'];
            $data = [
                    'secret' => config('services.recaptcha.secret'),
                    'response' => $request->get('g-capcha'),
                    'remoteip' => $remoteip
            ];

            $options = [
                'http' => [
                    'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                    'method' => 'POST',
                    'content' => http_build_query($data)
                ]
            ];

            $context = stream_context_create($options);

            $result = file_get_contents($url, false, $context);

            $resultJson = json_decode($result);


            if ($resultJson->success != true) {
                return back()->withErrors(['error' => 'ReCaptcha Error']);
            }
            if ($resultJson->score >= 0.3) {
                $contact =  Contact::create($request->all());

                if($contact){
                        return redirect()->back()->with('success','We got your request and contact you soon!');
                       }else{
                        return redirect()->back()->with('error','Request is not sent');
                       }

                //Validation was successful, add your form submission logic here
                // return back()->with('success', 'Thanks for your message!');
            } else {
            return back()->withErrors(['error' => 'ReCaptcha Error']);
            }
        }else{
            // $get_contact_details = StaticPage::where('type' , 'contact')->first();
            $get_contact_details = GeneralSetting::where('type', 'contactPage')->get()->toArray();
            $contact_details = key_value('name', 'value', $get_contact_details);

           return view('front.contact' , compact('contact_details'));
        }
    }


    public function about()
    {
        $get_about_details = StaticPage::where('type' , 'about')->first();

        return view('front.about' , compact('get_about_details'));
    }

    public function privacy()
    {
        $get_privacy_details = StaticPage::where('type' , 'privacy')->first();

        return view('front.privacy' , compact('get_privacy_details'));
    }

    public function matchResult(Request $request)
    {
         $get_total_points = collect([]);
         $season_name = null;
         $get_all_seasons = collect([]);
         $c_season = array();

        if ($request->isMethod('post')) {
            if ($request->seasons != null )
            {
                return redirect()->route('match-result' , ['season' => $request->seasons]);
            }
        }
        else {
                 if($request->season){
                 $c_date = Season::where('status' , 'active')->where('id' , $request->season)->value('starting');
                 if( $c_date){
                 $c_season = DB::table('seasons')->whereRaw('"' . $c_date . '" between `starting` and `ending`')
                                ->where(['status' => 'active' , 'id' =>$request->season])->first();
                 }

                 }else{
                    $c_date = Season::where('status' , 'active')->value('starting');
                    if( $c_date){
                    $c_season = DB::table('seasons')->whereRaw('"' . $c_date . '" between `starting` and `ending`')
                    ->where(['status' => 'active'])->first();
                    }
                 }

                if(empty($c_season)){
                    return view('front.match_result' , compact('get_total_points' ,'season_name' , 'get_all_seasons' , 'c_season'));
                }
                $season_data = Season::where('id' ,  $c_season->id)->first();
                if (!$season_data) {
                    return view('front.match_result' , compact('get_total_points' ,'season_name' , 'get_all_seasons' , 'c_season'));
                }

                // Fetch all the region
                 $allregions = DB::table('regions')->pluck('region','id');

                //get total_loss_pts_in_region where points == 0 (as loss points) out of total_matches_in_region
                $get_total_loss_pts_in_region = DB::table('user_teams')
                ->select((DB::raw("COUNT(user_teams.user_region_id) as total_loss_pts_in_region")), 'user_teams.user_region_id as user_region_id' , 'regions.region as region_name' , 'seasons.season_name' ,'seasons.id as season_id')
                ->join('regions' , 'regions.id' , '=' , 'user_teams.user_region_id')
                ->join('seasons' , 'seasons.id' , '=' ,'user_teams.season_id')
                ->where('season_id',$c_season->id)
                ->where('user_teams.points', '=' , 0)
                ->orderBy('regions.position' , 'asc')
                ->groupby('user_teams.user_region_id')->get();

                 //get total_win_pts_in_region where points == 0 (as win points) out of total_matches_in_region
                 $get_total_win_pts_in_region = DB::table('user_teams')
                 ->select((DB::raw("COUNT(user_teams.user_region_id) as total_win_pts_in_region")), 'regions.region as region_name' , 'seasons.season_name' ,'seasons.id as season_id')
                 ->join('regions' , 'regions.id' , '=' , 'user_teams.user_region_id')
                 ->join('seasons' , 'seasons.id' , '=' ,'user_teams.season_id')
                 ->where('season_id',$c_season->id)
                 ->where('user_teams.points', '!=' , 0)
                 ->orderBy('regions.position' , 'asc')
                 ->groupby(DB::raw('user_region_id'))->get();

                 $total_win_loss =  array();
                 foreach($allregions as $key => $region){
                    foreach( $get_total_win_pts_in_region as $data){
                       if($region == $data->region_name ){
                        $total_win_loss[$region]['win'] =  $data->total_win_pts_in_region;
                       }
                    }

                     if(!isset($total_win_loss[$region]['win'])){
                        $total_win_loss[$region]['win'] = 0;
                     }

                    foreach( $get_total_loss_pts_in_region as $data){
                        if($region == $data->region_name ){
                         $total_win_loss[$region]['loss'] =  $data->total_loss_pts_in_region;
                        }
                     }

                     if(!isset($total_win_loss[$region]['loss'])){
                        $total_win_loss[$region]['loss'] = 0;
                     }
                 }
                $season_name = $c_season->season_name;
                $get_all_seasons = Season::where('status' , 'active')->get();
                $total_players = UserTeam::where('season_id',$c_season->id)->distinct('user_id')->count();

                $get_match_results_details = MatchResult::first();

        return view('front.match_result' , compact('total_win_loss' ,'season_name' ,'get_all_seasons' ,'c_season' , 'total_players' ,'get_match_results_details'));
     }
    }


    public function matchfixture(Request $request)
    {

         $fixtures = collect([]);
         $season_name = null;
         $get_all_seasons = collect([]);
         $c_season = array();
         $get_current_year = Carbon::now()->format('Y');
         $season_data  = Season::where('status','active')->first();
         $get_year_from_season_date = Carbon::createFromFormat('Y-m-d H:i:s', $season_data->starting)->format('Y');
         $get_current_season = Season::where(['status'=>'active' , 'season_name' => $get_current_year])->first();

         //get headings of page
         $get_fixture_headings = GeneralSetting::where(['type' => 'matchFixture'])->get()->toArray();
         $fixture_headings = key_value('name', 'value', $get_fixture_headings);


        // $current_season_data  = Season::where('status','active')->first();
        // If there is no active season . Then redirect with no found record.
        if(!$season_data){
            return view('front.fixtures' , compact('fixtures' , 'season_name' , 'get_all_seasons' , 'c_season' ,'fixture_headings'));
        }
        // Now checking if  there is season coming in parameter from url. If not then assign the season id from above $current_season_data.
        $current_season_id = $request->seasons ? $request->seasons : $get_current_season->id;
        // Now checking if  there is week coming in parameter from url. If not then assign the season id from above $current_season_data.
        $selected_week = $request->weeks ? $request->weeks : 1;
        $select_season_data = Season::where('status' , 'active')->where('id' ,$current_season_id)->first();
        $fixtures = Fixture::with('first_team_id','second_team_id')
        ->where(['season_id'=> $current_season_id,'week'=>$selected_week])
        // ->whereDate('date','>=',$select_season_data->starting)
        ->get()->groupby('week');


        if( $select_season_data){
            $c_season = DB::table('seasons')->whereRaw('"' . $select_season_data->starting . '" between `starting` and `ending`')
                               ->where(['status' => 'active' , 'id' => $current_season_id])->first();
        }
          // Fetch all the season which are active
         $get_all_seasons = Season::where('status' , 'active')->orderby('id' , 'desc')->get();
         $season_name =  $select_season_data->season_name;
         //get the team selected by user

         if (Auth::check()) {
            $get_selected_teams_by_user =  UserTeam::where('user_id' , Auth::user()->id)->pluck('team_id')->toArray();
         } else {
            $get_selected_teams_by_user = '';
         }

         return view('front.fixtures' , compact('fixtures' , 'season_name' , 'get_all_seasons' , 'c_season','fixture_headings' ,'get_selected_teams_by_user'));


        //  $user_id =  Auth::user()->id;
        //  if ($user_id) {
        //     $get_selected_teams_by_user =  UserTeam::where('user_id' , $user_id)->pluck('team_id')->toArray();
        //  }
        // if ($get_selected_teams_by_user) {
        //     return view('front.fixtures' , compact('fixtures' , 'season_name' , 'get_all_seasons' , 'c_season','fixture_headings' ,'get_selected_teams_by_user'));
        // } else {
        //     return view('front.fixtures' , compact('fixtures' , 'season_name' , 'get_all_seasons' , 'c_season','fixture_headings'));
        // }


    }


    public function fixture_team_pick(Request $request)
    {
        // if (!Auth::check()) {
        //    return response()->json(['message' => 'login','status'=>false], 200);
        // }
        if (Auth::check()) {


            $team_id = $request->team_id;
            $season_id = $request->season_id;
            $week = $request->week;
            $fixture_id = $request->fixture_id;
            $user_id = auth()->user()->id;
            $user_region_id = auth()->user()->region_id;
            $user_status = Payment::where(['user_id' => $user_id,'season_id'=> $season_id,'status'=>'succeeded'])->first();
            if ($user_status) {
                $current_date = Carbon::now();  // current time and date
                $is_user_allowed_to_choose_fixture =  Fixture::where(['season_id'=> $season_id, 'week' => $week])->orderBy('date','ASC')->first();

                if($is_user_allowed_to_choose_fixture == null){
                    return response()->json(['message' => 'Sorry.Please try again','status'=>false], 200);
                }
                $DeferenceInDays = Carbon::parse(Carbon::now())->diffInDays($is_user_allowed_to_choose_fixture->date);
                // dd($DeferenceInDays);
                if($DeferenceInDays <= 0){
                    return response()->json(['message' => 'Time_id_over','status'=>false], 200);
                }
               // $is_user_allowed_to_choose_fixture =  Fixture::where(['season_id'=> $season_id, 'week' => $week, 'id'=>$fixture_id, [ 'date', '>', $current_date ]])->first();

                // if no, redirect with error
                 if(!$is_user_allowed_to_choose_fixture){
                    return response()->json(['message' => 'Selection time is over for this fixture.You can choose the fixture till day before the match.','status'=>false], 200);
                 }
                 // if user selected the fixture or not
                $user_selected_fixture_team = UserTeam::where(['user_id' => $user_id, 'season_id' => $season_id, 'week' => $week,'fixture_id'=> $fixture_id ])->first();
                 //dd('user_selected_fixture_team' ,$user_selected_fixture_team);
                 if($user_selected_fixture_team){
                    $user_selected_fixture_team->update(['team_id'=>$team_id ]);
                    return response()->json(['message' => 'update','status'=>true], 200);
                 }else{
                    $created =  UserTeam::create([
                        'user_id' => $user_id,
                        'user_region_id' => $user_region_id,
                        'leauge_id' => $this->league_id,
                        'season_id' => $season_id,
                        'week' => $week,
                        'team_id' => $team_id,
                        'fixture_id'=>$fixture_id,
                    ]);
                    return response()->json(['message' => 'added','status'=>true], 200);
                 }
            }
            // else{
            //     return response()->json(['message' => 'subscribe','status'=>false], 200);
            // }
        }
    }


    public function check_user_subscribe_for_fixturePage(Request $request)
    {
        if (Auth::check()) {
            $user_id = auth()->user()->id;
        $season_id = $request->season_id;
        $user_status = Payment::where(['user_id' => $user_id,'season_id'=> $season_id,'status'=>'succeeded'])->first();
            if($user_status){
                return response()->json(['message' => 'subscribed','status'=>true], 200);
            }else{
                return response()->json(['message' => 'not subscribed','status'=>false], 200);
            }
        }
         else {
            return response()->json(['message' => 'not_login','status'=>false], 200);
        }
    }



    public function gameResult()
    {

        // $get_match_results  = DB::table('fixtures')
        // ->join('teams as t1' , 't1.id' , '=' , 'fixtures.first_team')
        // ->join('teams as t2' , 't2.id' , '=' , 'fixtures.second_team')
        // ->join('seasons' , 'seasons.id' , '=' , 'fixtures.season_id')
        // ->whereNotNull(['t1.win' , 't1.loss' , 't2.win' , 't2.loss'] )
        // ->select('seasons.*','fixtures.*' , 't1.name as t1_name' , 't2.name as t2_name' , 't1.win as team1_win' , 't1.loss as team1_loss' ,'t2.win as team2_win' , 't2.loss as team2_loss' , 't1.logo as t1_logo' , 't2.logo as t2_logo')

        // ->get()->groupby(['season_name', 'week'])->toArray();
        // echo "<pre>";
        // print_r($get_match_results);
        // die();

        $c_date = Season::where('status' , 'active')->value('starting');
        $c_season = DB::table('seasons')
            ->whereRaw('"' . $c_date . '" between `starting` and `ending`')
            ->where('status' , 'active')->first();
        $get_game_results = Fixture::with('first_team_id','second_team_id')
        ->whereNotNull(['win' , 'loss'])

        ->where('season_id',$c_season->id)->whereDate('date','>=',$c_date)
        ->orderBy('week' , 'desc')
        ->get()->groupby('week');




        // echo "<pre>";
        // print_r( $get_game_results);
        // die();
       $season_name = $c_season->season_name;


        return view('front.game_result' , compact('get_game_results' ,'season_name'));
    }



    public function prize()
    {
        $prizes = Prize::with('season')->where('status' , 'active')->get();
        $get_prize_banner = General::where('prize_banner' , '!=' , null)->select('prize_banner')->first();
        $get_prize_heading = SectionHeading::where('name', 'Prize')->first();

        return view('front.prize' , compact('prizes' , 'get_prize_banner' , 'get_prize_heading'));
    }


    public function standings()
    {
        // $teams = Team::get()->groupBy(['league' , 'region_id']);

        // $teams = DB::table('teams')
        // ->join('regions' , 'regions.id' , '=' , 'teams.region_id' )
        // ->get()->groupBy(['league' , 'region']);

        $teams = DB::table('user_teams')
        ->join('teams' , 'teams.id' , '=' , 'user_teams.team_id' )
        // ->join('regions' , 'regions.id' , '=' , 'teams.region_id' )
         ->get()->groupBy(['league' , 'region']);


        // echo "<pre>";
        // print_r($teams);
        // die();

       return view('front.standings');
    }


    public function results_by_regions()
    {
       return 'Results by regions';
    }

    public function reviews(ReviewsRequest $request)
    {


       $reviews = Reviews::create([
        'username' => $request->username,
        'email' => $request->email,
        'comment' => $request->comment,
        'rating' => $request->rating,
       ]);
    //    return redirect()->back()->with('reviews_success' , 'Reviews added successfullly');
    return response()->json(['message' , 'success'], 200);

    }

}
