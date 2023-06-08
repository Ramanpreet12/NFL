<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Payment;
use Illuminate\Support\Carbon;
use App\Models\Fixture;
use App\Models\UserTeam;
use App\Models\Season;
use Auth , Hash;

class UserDashboardController extends Controller
{
    public function dashboard()
    {
        // $c_date = Carbon::now();
        // $c_season = DB::table('seasons')
        //     ->whereRaw('"' . $c_date . '" between `starting` and `ending`')
        //     ->first();
        // $season = Season::where('status' , 'active')->first();

        $c_date = Season::where('status' , 'active')->value('starting');
        $c_season = DB::table('seasons')
            ->whereRaw('"' . $c_date . '" between `starting` and `ending`')
            ->where('status' , 'active')->first();

        $payment = Payment::where('user_id', auth()->user()->id)->latest()->take(5)->get();
        $user = DB::table('user_teams')
        ->join('teams', 'teams.id', 'user_teams.team_id')
        ->join('seasons' , 'seasons.id' , '=' , 'user_teams.season_id')
         ->where(['user_id' => auth()->user()->id, 'season_id' => $c_season->id])
        ->select('teams.name', 'teams.logo', 'user_teams.*')->orderby('user_teams.week', 'desc')
        ->latest()->take(3)->get();

        $c_date = Season::where('status' , 'active')->value('starting');
        $c_season = DB::table('seasons')
            ->whereRaw('"' . $c_date . '" between `starting` and `ending`')
            ->where('status' , 'active')->first();

        $upcoming = Fixture::with('first_team_id','second_team_id')
        ->where('season_id',$c_season->id)
        ->whereDate('date','>',$c_date)
        ->orderby('date','asc')
        ->latest()->take(5)->get()->groupby('week');

        $prize = [];

         //return view('front.dashboard', compact('user', 'payment','upcoming','prize'));
        return view('front.dashboard',compact('user', 'payment','upcoming','prize'));
    }
    public function userPayment()
    {
        $payment = Payment::with('season')->where('user_id', auth()->user()->id)->paginate(6);

        return view('front.payment', compact('payment'));
    }

    public function my_selections()
    {
        $my_selections = DB::table('user_teams')
         ->select('f.week As fweek' ,'f.date as fdate' ,'f.time as ftime' ,'f.time_zone as ftime_zone' ,'f.id','f.win As team_win','f.loss As team_loss','t.logo As team_logo', 't.name As user_team', 's.season_name As season_name','t1.name As first_name','t1.logo As first_logo','t2.name As second_name','t2.logo As second_logo','user_teams.points As user_point')
        ->join('teams as t', 't.id', '=', 'user_teams.team_id')
        ->join('seasons as s', 's.id', '=', 'user_teams.season_id')
        ->join('fixtures as f', 'f.id', '=', 'user_teams.fixture_id')
         ->join('teams as t1', 't1.id', '=', 'f.first_team')
        ->join('teams as t2', 't2.id', '=', 'f.second_team')
         ->where('user_id', auth()->user()->id)
        ->orderby('user_teams.week', 'desc')->get()->groupby('fweek');
        $c_date = Season::where('status' , 'active')->value('starting');
        $c_season = DB::table('seasons')->whereRaw('"' . $c_date . '" between `starting` and `ending`')
                ->where('status' , 'active')->first();
           $season_name = $c_season->season_name;



        return view('front.myselections', compact('my_selections' , 'season_name'));
    }

    public function past_selections()
    {
        $past_selections = DB::table('user_teams')
         ->select('f.time As ftime' ,'f.time_zone As tformat' ,'f.date As fdate','f.week As fweek','f.id','f.win As team_win','f.loss As team_loss','t.logo As tlogo' , 't.name As user_team', 's.season_name As season_name','t1.name As first_name','t1.logo As first_logo','t2.name As second_name','t2.logo As second_logo','user_teams.points As user_point')
        ->join('teams as t', 't.id', '=', 'user_teams.team_id')
        ->join('seasons as s', 's.id', '=', 'user_teams.season_id')
        ->join('fixtures as f', 'f.id', '=', 'user_teams.fixture_id')
         ->join('teams as t1', 't1.id', '=', 'f.first_team')
        ->join('teams as t2', 't2.id', '=', 'f.second_team')
         ->where('user_id', auth()->user()->id)
         ->whereNotNull(['f.win' , 'f.loss'])
        ->orderby('user_teams.week', 'desc')->get()->groupby('fweek');

        // echo "<pre>";
        // print_r($past_selections);
        // die();
        $c_date = Season::where('status' , 'active')->value('starting');
            $c_season = DB::table('seasons')->whereRaw('"' . $c_date . '" between `starting` and `ending`')
                    ->where('status' , 'active')->first();
               $season_name = $c_season->season_name;

        // $get_season_name = $past_selections->season_name;
        // dd($season_name);
        return view('front.past_selections', compact('past_selections' , 'season_name'));
    }

    public function upcomingMatches()
    {
        // $c_date = Carbon::now();
        // $c_season = DB::table('seasons')
        //     ->whereRaw('"' . $c_date . '" between `starting` and `ending`')
        //     ->first();

        $c_date = Season::where('status' , 'active')->value('starting');
        $c_season = DB::table('seasons')
            ->whereRaw('"' . $c_date . '" between `starting` and `ending`')
            ->where('status' , 'active')->first();

        $upcoming = Fixture::with('first_team_id','second_team_id')->where('season_id',$c_season->id)->whereDate('date','>',$c_date)->get()->groupby('week');
        // echo "<pre>";
        // print_r( $upcoming);
        // die();

        return view('front.upcoming',compact('upcoming'));
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



    public function settings(Request $request)
    {
        if ($request->isMethod('put')) {

            $data = array();
                $image     =   $request->file('photo');
                if ($image) {
                    $filename =   $image->getClientOriginalName();
                    $success = $image->storeAs('public/images/user_images/' , $filename);
                    if (!isset($success)) {
                        return back()->withError('Could not upload Banner');
                    }
                    $data["photo"]=$filename;
                }

                $data["name"]=$request->name;
                $data["dob"]=$request->dob;
                $data["phone_number"]=$request->phone;
                $update_user =User::where('id', Auth::user()->id)->update($data);
                return redirect()->back()->with('success' , 'User updated successfully');;
            }
        else {
            $get_user_details = User::where('id' , Auth::user()->id)->get();
            return view('front.settings.personal_details' , compact('get_user_details'));
        }


    }

    public function updatePassword(Request $request)
    {
        if ($request->isMethod('put')) {

            $input = $request->all();
            if (!(Hash::check($request->current_password ,Auth::user()->password))) {
                // return redirect()->back()->with('pass_message_error' , 'Current password is incorrect');
                return response()->json(['message' => 'Current password is incorrect' , 'status' => false ], 200);
            }
            if (($request->current_password === $request->new_password)) {
                return response()->json(['message' => 'New Password cannot be same as your current password' , 'status' => false ], 200);

            //    return redirect()->back()->with('pass_message_error' , 'New Password cannot be same as your current password');
            }
            if (($request->new_password != $request->confirm_password)) {
                // return redirect()->back()->with('pass_message_error' , 'Password not matched');
                return response()->json(['message' => 'Password not matched' , 'status' => false ], 200);

             }

            User::where(['id' => Auth::user()->id , 'role_as' => 0])->update(['password' => bcrypt($request->new_password)]);
            // return redirect()->back()->with('success' , 'Password updated successfully');
            return response()->json(['message' => 'Password updated successfully' , 'status' => true ], 200);


        } else {
            return view('front.settings.update_password');
        }


    }
}
