<?php

namespace App\Http\Controllers;

use App\Models\Fixture;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Models\Payment;
use App\Models\UserTeam;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\TeamSelected;
use App\Models\Team;
use App\Models\Season;

class TeamPickController extends Controller
{
    public function index()
    {
        // $c_date = Carbon::now();
        // $c_season = DB::table('seasons')
        //     ->whereRaw('"' . $c_date . '" between `starting` and `ending`')
        //     ->first();

        $c_date = Season::where('status' , 'active')->value('starting');

        $c_season = DB::table('seasons')
            ->whereRaw('"' . $c_date . '" between `starting` and `ending`')
            ->where('status' , 'active')
            ->first();



        $fixture = Fixture::with('first_team_id', 'second_team_id')->where('season_id', $c_season->id)->orderby('week', 'asc')->get()->groupBy('week');

        return view('front.teampick', compact('fixture'));
    }

    public function pickTeam(Request $request)
    {

        // dd($request);
        // try {
            $team = $request->team;
            $season_id = $request->season;
            $week = $request->week;
            $fixture = $request->fixture;
            $id = auth()->user()->id;


            // $c_date = Carbon::now();
            $c_date = Season::where('status' , 'active')->value('starting');
            $expire_date = Payment::where(['season_id' => $season_id, 'user_id' => $id])->value('expire_on');


            $user_status = User::where('id', $id)->value('subscribed');
            if ($user_status == "0") {
                return redirect()->back()->with('error', 'You are not subscribe for team select');
            } else if ($user_status == "1" && $expire_date < $c_date) {
                return redirect()->back()->with('error', 'Please subscribe first your plan is expired');
            } else {
                $select = UserTeam::where(['user_id' => $id, 'season_id' => $season_id, 'week' => $week])->first();
                if ($select) {
                   $update =  UserTeam::where(['user_id' => $id, 'season_id' => $season_id, 'week' => $week])->update(['team_id'=>$team]);
                   if($update){
                       return redirect()->back()->with('success', 'Team is updated sucessfully for week ' . $week);
                   }else{
                    return redirect()->back()->with('error', 'Something is went wrong please try later');
                   }
                } else {
                    $created =  UserTeam::create([
                        'user_id' => $id,
                        'leauge_id' => 1,
                        'season_id' => $season_id,
                        'week' => $week,
                        'team_id' => $team,
                        'fixture_id'=>$fixture,
                    ]);

                    $user = User::where('id',$id)->first();
                    $team = Team::where('id',$team)->value('name');
                    $data = ['week'=>$week,'team'=>$team,'user_name'=>$user->name];
                    if ($created) {
                        Mail::to($user->email)->send(new TeamSelected($data));
                        return redirect()->back()->with('success', 'Congratulation your team is selected successfully');
                    } else {
                        return redirect()->back()->with('error', 'Sorry team is not selected something went wrong');
                    }
                }
            }
        // } catch (\Exception $e) {
        //     Log::info($e->getMessage());
        // }
    }
}
