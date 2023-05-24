<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Fixture;
use App\Models\SectionHeading;
use App\Models\Season;
use App\Models\User;
use App\Models\UserTeam;
 use App\Models\Team;
 use App\Models\Payment;
 use Auth;
 use App\Http\Requests\FixtureRequest;
 use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class FixtureController extends Controller
{
    private $league_id = 1 ;// league id basically determines the leagues for eg NFL ,FIFA etc


    public function fixtures()
    {
        $fixtures = Fixture::with('first_team_id' , 'second_team_id' , 'season')->get();
        $fixtureHeading = SectionHeading::where('name' , 'Upcoming Fixture')->first();
        //dd($fixtures);
        $seasons = Season::get();
      return view('backend.fixture.index' , compact('fixtures' , 'seasons' , 'fixtureHeading'));
    }

    public function fixtures_data()
    {
        $fixture = Fixture::with('first_team_id' , 'second_team_id' , 'season')->paginate(6);
        return response()->json($fixture , 200);
    }

    public function add_fixtures(){
        $fixtures = Fixture::with('first_team_id' , 'second_team_id' , 'season')->get();
        $seasons = Season::get();
        $teams = Team::get();
        return view('backend.fixture.add_fixture' , compact('fixtures' , 'seasons' ,'teams'));
    }

    public function store_fixture(FixtureRequest $request){
            if($request->isMethod('post')){
              $duration = Season::where('id',$request->season)->first();

              $start = Carbon::parse($duration->starting);
              $end = Carbon::parse($duration->ending);
              $store = Carbon::parse($request->date);
              if($end < $store){
                return redirect()->back()->with('error_date','Enter a valid date');
              }
                $diff = $start->diff($store);

                $week = ceil($diff->d/7);
                $f_week = ((int)$week);
                if($f_week == 0){
                    $f_week = 1;
                }

              Fixture::create([
                'season_id' => $request->season,
                'first_team' => $request->first_team,
                'second_team' => $request->second_team,
                'week' => $f_week,
                'date' => $request->date,
                'time' => $request->time,
                'time_zone' => $request->time_zone,
              ]);
              return redirect('admin/fixtures')->with('success' , 'Fixture Created successfully');
            }
    }

    public function edit_fixture($id){
        // $fixtures = Fixture::where('id' , $id)->with('first_team_id' , 'second_team_id' , 'season')->get();
        // $season = Season::get();

        $fixture = Fixture::where('id' , $id)->first();
         $seasons = Season::get();
         $teams = Team::get();

        return view('backend.fixture.edit_fixture' , compact('fixture' ,'seasons' , 'teams'));
    }
    public function update_fixture(FixtureRequest $request , $id){

        if($request->isMethod('post')){
            $duration = Season::where('id',$request->season)->first();
            $start = Carbon::parse($duration->starting);
            $end = Carbon::parse($duration->ending);
            $store = Carbon::parse($request->date);
            if($end < $store){
              return redirect()->back()->with('error_date','Enter a valid date');
            }
              $diff = $start->diff($store);
              $week = ceil($diff->d/7);
              $f_week = ((int)$week);

            Fixture::where('id' , $id)->update([
                'season_id' => $request->season,
                'first_team' => $request->first_team,
                'second_team' => $request->second_team,
                'week' => $f_week,
                'date' => $request->date,
                'time' => $request->time,
                'time_zone' => $request->time_zone,
            ]);
            return redirect('admin/fixtures')->with('success' , 'Fixture updated successfully');
        }
    }

    public function delete_fixture($id){
        Fixture::where('id' , $id)->delete();
        return redirect()->back()->with('success' , 'Fixture deleted successfully');
    }

    public function section_heading(Request $request)
    {
        if ($request->isMethod('post')) {
            SectionHeading::where('name' , 'Upcoming Fixture')->update([
                        'value' => $request->section_heading,
                    ]);
        return redirect('admin/fixtures')->with('success' , 'Fixture Title updated successfully');
        }
    }



    //team results

    // public function teamResult_index()
    // {
    //     $fixtures =  Fixture::with('first_team_id' , 'second_team_id' , 'season')->get();
    //     return view('backend.team_result.index', compact('fixtures'));
    // }


    public function edit_teamResult(Request $request, $id)
    {
        if (!$request->isMethod('post')) {
           $team_results =  Fixture::with('first_team_id' , 'second_team_id' , 'season')->where('id', $id)->first();
            $teams = Team::get();

            return view('backend.team_result.edit', compact('team_results', 'teams'));
        } else {
          $fixture_data =   Fixture::where('id' , $id)->first();

            Fixture::where('id' , $id)->update([

                'win' => $request->winner_team,
                'loss' => $request->loss_team,
            ]);



            if ($request->winner_team) {
                $team_win = Team::where('id', $request->winner_team)->first();
                $match_played = $team_win->match_played;
                $matchwin = $team_win->win;
                Team::where('id', $request->winner_team)->update(['match_played' => (int)$match_played + 1, 'win' => (int)$matchwin + 1]);
                update_userPoints($request->winner_team, $fixture_data->season_id , $fixture_data->week);
            }
            if ($request->loss_team) {
                $team_loss = Team::where('id', $request->loss_team)->first();
                $match_played = $team_loss->match_played;
                $matchloss = $team_loss->loss;
                Team::where('id', $request->loss_team)->update(['match_played' => (int)$match_played + 1, 'loss' => (int)$matchloss + 1]);
            }


            return redirect('admin/teams/result')->with('success', 'Team Result updated successfully');
        }
    }

    // public function showFixtures()
    // {

    //     $c_date = Season::where('status' , 'active')->value('starting');
    //     $c_season = DB::table('seasons')->whereRaw('"' . $c_date . '" between `starting` and `ending`')
    //         ->where('status' , 'active')->first();
    //     $fixtures = Fixture::with('first_team_id','second_team_id')->where('season_id',$c_season->id)->whereDate('date','>',$c_date)->get()->groupby('week');
    //    $season_name = $c_season->season_name;
    //    $get_seasons = Season::where('status' , 'active')->get();

    //    return view('front.fixtures' , compact('fixtures' , 'season_name' , 'get_seasons'));
    // }


    // public function get_seasons(Request $request)
    // {
    //     if($request->isMethod('post')){
    // //    $season_data = Season::where('id' , $request->seasons)->first();
    // $c_date = Season::where('status' , 'active')->where('id' , $request->seasons)->value('starting');
    // $c_season = DB::table('seasons')->whereRaw('"' . $c_date . '" between `starting` and `ending`')
    // ->where(['status' => 'active' , 'id' =>$request->seasons])->first();

    // $season_name = $c_season->season_name;

    // $fixtures = Fixture::with('first_team_id','second_team_id')->where('season_id',$request->seasons)
    // ->whereDate('date','>',$c_date)
    // ->get()->groupby('week');
    // $get_seasons = Season::where('status' , 'active')->get();

    // return view('front.fixtures' , compact('fixtures' , 'season_name' , 'get_seasons' , 'c_season'));
    //     }
    // }

    public function fixture(Request $request)
    {

        if ($request->isMethod('post')) {
            $season_data = Season::where('id' , $request->seasons)->first();
            $c_date = Season::where('status' , 'active')->where('id' , $request->seasons)->value('starting');
            $c_season = DB::table('seasons')->whereRaw('"' . $c_date . '" between `starting` and `ending`')
             ->where(['status' => 'active' , 'id' =>$request->seasons])->first();
             $season_name = $c_season->season_name;
             $fixtures = Fixture::with('first_team_id','second_team_id')->where('season_id',$request->seasons)
             ->whereDate('date','>',$c_date)->get()->groupby('week');
             $get_seasons = Season::where('status' , 'active')->orderby('id' , 'desc')->get();

             //get data according to weeks
            //  $fixtures = Fixture::with('first_team_id','second_team_id')->where('season_id',$request->seasons)
            //  ->whereDate('date','>',$c_date)->get()->groupby('week');
            // $id = auth()->user()->id;
            // $user_status = User::where('id', $id)->value('subscribed');
            // dd($user_status);
            // if ($user_status == "0") {
            //     return redirect()->back()->with('error', 'You are not subscribe for team select');
            // }


            return view('front.fixtures' , compact('fixtures' , 'season_name' , 'get_seasons' , 'c_season'));
        } else {
            $c_date = Season::where('status' , 'active')->value('starting');
            $c_season = DB::table('seasons')->whereRaw('"' . $c_date . '" between `starting` and `ending`')
                    ->where('status' , 'active')->first();
                $fixtures = Fixture::with('first_team_id','second_team_id')->where('season_id',$c_season->id)->whereDate('date','>',$c_date)->get()->groupby('week');
               $season_name = $c_season->season_name;
               $get_seasons = Season::where('status' , 'active')->get();

            return view('front.fixtures' , compact('fixtures' , 'season_name' , 'get_seasons' , 'c_season'));
        }

    }

    public function fixtureWeeks(Request $request)
    {
        if ($request->isMethod('post')) {
        $season_data = Season::where('id' , $request->season_id)->first();

        $c_date = Season::where('status' , 'active')->where('id' , $request->season_id)->value('starting');
        $c_season = DB::table('seasons')->whereRaw('"' . $c_date . '" between `starting` and `ending`')
         ->where(['status' => 'active' , 'id' =>$request->season_id])->first();
          $season_name = $c_season->season_name;
         $fixtures = Fixture::with('first_team_id','second_team_id')
         ->where(['season_id' =>$request->season_id , 'week' => $request->weeks])
         ->whereDate('date','>',$c_date)->get()->groupby('week');
         $get_seasons = Season::where('status' , 'active')->orderby('id' , 'desc')->get();

         return view('front.fixtures' , compact('fixtures' , 'season_name' , 'get_seasons' , 'c_season'));
        } else {
            $c_date = Season::where('status' , 'active')->value('starting');
            $c_season = DB::table('seasons')->whereRaw('"' . $c_date . '" between `starting` and `ending`')
                    ->where('status' , 'active')->first();
                $fixtures = Fixture::with('first_team_id','second_team_id')
                ->where(['season_id' =>$request->season_id , 'week' => $request->weeks])
                ->whereDate('date','>',$c_date)->get()->groupby('week');
               $season_name = $c_season->season_name;
               $get_seasons = Season::where('status' , 'active')->get();

            return view('front.fixtures' , compact('fixtures' , 'season_name' , 'get_seasons' , 'c_season'));
        }

    }

    public function checkUser(Request $request)
    {


        if (!Auth::check()) {
           return response()->json(['message' => 'login','status'=>false], 200);
        }


            $team_id = $request->team_id;

            $season_id = $request->season_id;

            $week = $request->week;
            $fixture_id = $request->fixture_id;
            $user_id = auth()->user()->id;

            $user_status = Payment::where(['user_id' => $user_id,'season_id'=> $season_id,'status'=>'succeeded'])->first();



            if ($user_status) {

                $current_date = Carbon::now();  // current time and date

                $is_user_allowed_to_choose_fixture =  Fixture::where(['season_id'=> $season_id, 'week' => $week, 'id'=>$fixture_id, [ 'date', '>', $current_date ]])->first();

                // if no, redirect with error
                 if(!$is_user_allowed_to_choose_fixture){
                    return response()->json(['message' => 'Selection time is over for this fixture.You can choose the fixture till day before the match.','status'=>false], 200);
                 }
                 // if user selected the fixture or not
                $user_selected_fixture_team = UserTeam::where(['user_id' => $user_id, 'season_id' => $season_id, 'week' => $week,'fixture_id'=> $fixture_id ])->first();

                 if($user_selected_fixture_team){
                    $user_selected_fixture_team->update(['team_id'=>$team_id]);

                    return response()->json(['message' => 'update','status'=>true], 200);

                 }else{

                    $created =  UserTeam::create([
                        'user_id' => $user_id,
                        'leauge_id' => $this->league_id,
                        'season_id' => $season_id,
                        'week' => $week,
                        'team_id' => $team_id,
                        'fixture_id'=>$fixture_id,
                    ]);

                    return response()->json(['message' => 'added','status'=>true], 200);
                 }

            }
            else{
                return response()->json(['message' => 'subscribe','status'=>false], 200);

            }
    }
}


