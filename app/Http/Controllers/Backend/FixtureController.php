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
// use Carbon\CarbonImmutable;

class FixtureController extends Controller
{
    private $league_id = 1 ;// league id basically determines the leagues for eg NFL ,FIFA etc


    public function index()
    {
        $fixtures = Fixture::with('first_team_id' , 'second_team_id' , 'season')->orderBy('id' , 'desc')->get();
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

    public function create(){
        $fixtures = Fixture::with('first_team_id' , 'second_team_id' , 'season')->get();
        $seasons = Season::get();
        $teams = Team::get();
        return view('backend.fixture.add_fixture' , compact('fixtures' , 'seasons' ,'teams'));
    }

    public function store(FixtureRequest $request){

            if($request->isMethod('post')){

              $duration = Season::where('id',$request->season)->first();

              $start = Carbon::parse($duration->starting);
              $end = Carbon::parse($duration->ending);
              $store = Carbon::parse($request->date);
              if($end < $store){
                return redirect()->back()->with('error_date','Please Enter the  valid date.(Fixture date should be in between season starting and ending date.)');
              }
                $diff = $start->diff($store);

                $week = ceil($diff->d/7);
                $f_week = ((int)$week);
                if($f_week == 0){
                    $f_week = 1;
                }

//                 $start = Carbon::createFromTimestamp(strtotime($duration->starting));
// $end = Carbon::createFromTimestamp(strtotime($duration->starting))->add($store . ' minutes');
// $diff_in_weeks=  $start->diffInWeeks($end);
// dd($diff_in_weeks);

$startDate = Carbon::parse($start);
$endDate = Carbon::parse($store);

$weekdays = $startDate->diffInWeekdays($endDate);
dd($weekdays);

                $fixture_data = Fixture::where(['season_id' => $request->season ,'first_team' => $request->first_team , 'second_team' =>$request->second_team , 'week'=>$f_week , 'date' =>$request->date ])->first();
                if ($fixture_data) {
                    return redirect()->back()->with('message_error' , 'Fixture already exists !');
                //  dd($fixture_data);
                }
                else{
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
    }

    public function show($id)
    {
        //
    }

    public function edit($id){
        // $fixtures = Fixture::where('id' , $id)->with('first_team_id' , 'second_team_id' , 'season')->get();
        // $season = Season::get();

        $fixture = Fixture::where('id' , $id)->first();
         $seasons = Season::get();
         $teams = Team::get();

        return view('backend.fixture.edit_fixture' , compact('fixture' ,'seasons' , 'teams'));
    }

    public function update(FixtureRequest $request , $id){

        if($request->isMethod('put')){
            $duration = Season::where('id',$request->season)->first();
            $start = Carbon::parse($duration->starting);
            $end = Carbon::parse($duration->ending);
            $store = Carbon::parse($request->date);
            if($end < $store){
                return redirect()->back()->with('error_date','Please Enter the  valid date.(Fixture date should be in between season starting and ending date.)');
            }
              $diff = $start->diff($store);
              $week = ceil($diff->d/7);
              $f_week = ((int)$week);
              if($f_week == 0){
                $f_week = 1;
            }

            //   $fixture_data = Fixture::where([[('id' , '!=' , $id)] ,  'season_id' => $request->season ,'first_team' => $request->first_team , 'second_team' =>$request->second_team , 'week'=>$f_week , 'date' =>$request->date ])->first();
              $fixture_data = Fixture::where([['id' , '!=' , $id] , ['season_id' , '=' ,  $request->season] , ['first_team' ,'=' ,  $request->first_team ]  , ['second_team' , '=', $request->second_team ], ['week' , '=', $f_week ], ['date' , '=' , $request->date] ])->first();

              if ($fixture_data) {
                    return redirect()->back()->with('message_error' , 'Fixture already exists !');
                //  dd($fixture_data);
                }
                else{

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
    }

    public function destroy($id){
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
            return view('front.fixtures' , compact('fixtures' , 'season_name' , 'get_seasons' , 'c_season'));
        } else {
            $c_date = Season::where('status' , 'active')->value('starting');
            $c_season = DB::table('seasons')->whereRaw('"' . $c_date . '" between `starting` and `ending`')
                    ->where('status' , 'active')->first();
                $fixtures = Fixture::with('first_team_id','second_team_id')
                ->where('season_id',$c_season->id)->whereDate('date','>',$c_date)->get()->groupby('week');
               $season_name = $c_season->season_name;
               $get_seasons = Season::where('status' , 'active')->get();

            return view('front.fixtures' , compact('fixtures' , 'season_name' , 'get_seasons' , 'c_season'));
        }

    }

    // public function fixtureWeeks(Request $request)
    // {
    //     dd('gfjdkgkfg');
    //     if ($request->isMethod('post')) {
    //         dd('gfjdkgkfg');
    //     $season_data = Season::where('id' , $request->season_id)->first();

    //     $c_date = Season::where('status' , 'active')->where('id' , $request->season_id)->value('starting');
    //     $c_season = DB::table('seasons')->whereRaw('"' . $c_date . '" between `starting` and `ending`')
    //      ->where(['status' => 'active' , 'id' =>$request->season_id])->first();
    //       $season_name = $c_season->season_name;
    //      $fixtures = Fixture::with('first_team_id','second_team_id')
    //      ->where(['season_id' =>$request->season_id , 'week' => $request->weeks])
    //      ->whereDate('date','>',$c_date)->get()->groupby('week');
    //      $get_seasons = Season::where('status' , 'active')->orderby('id' , 'desc')->get();

    //      return view('front.fixtures' , compact('fixtures' , 'season_name' , 'get_seasons' , 'c_season'));
    //     } else {

    //         $c_date = Season::where('status' , 'active')->value('starting');
    //         $c_season = DB::table('seasons')->whereRaw('"' . $c_date . '" between `starting` and `ending`')
    //                 ->where('status' , 'active')->first();
    //             $fixtures = Fixture::with('first_team_id','second_team_id')
    //             ->where(['season_id' =>$request->season_id , 'week' => $request->weeks])
    //             ->whereDate('date','>',$c_date)->get()->groupby('week');
    //            $season_name = $c_season->season_name;
    //            $get_seasons = Season::where('status' , 'active')->get();

    //         return view('front.fixtures' , compact('fixtures' , 'season_name' , 'get_seasons' , 'c_season'));
    //     }

    // }

    // public function checkUser(Request $request)
    // {
    //     if (!Auth::check()) {
    //        return response()->json(['message' => 'login','status'=>false], 200);
    //     }
    //         $team_id = $request->team_id;
    //         $season_id = $request->season_id;
    //         $week = $request->week;
    //         $fixture_id = $request->fixture_id;
    //         $user_id = auth()->user()->id;
    //         $user_region_id = auth()->user()->region_id;
    //         $user_status = Payment::where(['user_id' => $user_id,'season_id'=> $season_id,'status'=>'succeeded'])->first();
    //         if ($user_status) {
    //             $current_date = Carbon::now();  // current time and date
    //             $is_user_allowed_to_choose_fixture =  Fixture::where(['season_id'=> $season_id, 'week' => $week])->orderBy('date','ASC')->first();
    //             if($is_user_allowed_to_choose_fixture == null){
    //                 return response()->json(['message' => 'Sorry.Please try again','status'=>false], 200);
    //             }
    //             $DeferenceInDays = Carbon::parse(Carbon::now())->diffInDays($is_user_allowed_to_choose_fixture->date);
    //             if($DeferenceInDays <= 0){
    //                 return response()->json(['message' => 'Time_id_over','status'=>false], 200);
    //             }
    //            // $is_user_allowed_to_choose_fixture =  Fixture::where(['season_id'=> $season_id, 'week' => $week, 'id'=>$fixture_id, [ 'date', '>', $current_date ]])->first();

    //             // if no, redirect with error
    //              if(!$is_user_allowed_to_choose_fixture){
    //                 return response()->json(['message' => 'Selection time is over for this fixture.You can choose the fixture till day before the match.','status'=>false], 200);
    //              }
    //              // if user selected the fixture or not
    //             $user_selected_fixture_team = UserTeam::where(['user_id' => $user_id, 'season_id' => $season_id, 'week' => $week,'fixture_id'=> $fixture_id ])->first();
    //              //dd('user_selected_fixture_team' ,$user_selected_fixture_team);
    //              if($user_selected_fixture_team){
    //                 $user_selected_fixture_team->update(['team_id'=>$team_id ]);
    //                 return response()->json(['message' => 'update','status'=>true], 200);
    //              }else{
    //                 $created =  UserTeam::create([
    //                     'user_id' => $user_id,
    //                     'user_region_id' => $user_region_id,
    //                     'leauge_id' => $this->league_id,
    //                     'season_id' => $season_id,
    //                     'week' => $week,
    //                     'team_id' => $team_id,
    //                     'fixture_id'=>$fixture_id,


    //                 ]);


    //                 return response()->json(['message' => 'added','status'=>true], 200);
    //              }
    //         }
    //         else{
    //             return response()->json(['message' => 'subscribe','status'=>false], 200);

    //         }



    // }


    public function loss_user()
    {
     $last_date_fixture_week =    Carbon::now()->addDays(8)->format('Y-m-d');
     $first_date_fixture_week =    Carbon::now()->addDays(1)->format('Y-m-d');

      $data= Fixture::whereBetween('date', [$first_date_fixture_week,  $last_date_fixture_week ])->pluck('id')->toArray();



      $users = User::where('role_as' , 0)->get();
    $user_teams = UserTeam::where(['user_id' => 47 , 'week' => 2])
    // ->whereNotIn('fixture_id', [1 , 2 , 3])
    // ->where('fixture_id' , '!=' , $array)
    ->pluck('fixture_id')->toArray();

  $array_diff =   array_diff($data ,$user_teams );


       dd($user_teams);
    //   $array = [];
    //   foreach($data as $item ){
    //         a
    //   }
    //   die();
     $today_date = Carbon::now()->format('Y-m-d');


     $start_date_fixtures =  Fixture::where(['season_id'=> 1, 'week' => 2])->orderBy('id' , 'asc')->first();
     $week_start_date =   $start_date_fixtures->date;

     $end_date_fixtures =  Fixture::where(['season_id'=> 1, 'week' => 2])->orderBy('id' , 'desc')->first();
     $week_end_date =   $end_date_fixtures->date;

       dd($week_end_date);

    }

    public function my_results()
    {
    //     $last_date_fixture_week =    Carbon::now()->addDays(8)->format('Y-m-d');
    //     $first_date_fixture_week =    Carbon::now()->addDays(1)->format('Y-m-d');

    //      $data= Fixture::whereBetween('date', [$first_date_fixture_week,  $last_date_fixture_week ])->pluck('id')->toArray();
    //      //data = [1,2,5]
    //      $users = User::where('role_as' , 0)->get();
    //    $user_teams = UserTeam::where(['user_id' => 47 , 'week' => 2])
    //    // ->whereNotIn('fixture_id', [1 , 2 , 3])
    //    // ->where('fixture_id' , '!=' , $array)
    //    ->pluck('fixture_id')->toArray();

    //    //user_teams = [2]

    //  $array_diff =   array_diff($data ,$user_teams );

    //  //array_diff = [1 , 5]

    //       dd($array_diff);
    //     $today_date = Carbon::now()->format('Y-m-d');


    $get_weeks = Fixture::pluck('week')->toArray();

    $user_teams = UserTeam::where(['user_id' => 47 ])->pluck('week')->toArray();
    $array_diff =   array_diff($get_weeks ,$user_teams );
    dd($array_diff);

       return view('front.my_results');
    }
}


