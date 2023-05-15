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

class TeamPickController extends Controller
{
    public function index()
    {
        $c_date = Carbon::now();
        $c_season = DB::table('seasons')
            ->whereRaw('"' . $c_date . '" between `starting` and `ending`')
            ->first();
        $fixture = Fixture::with('first_team_id', 'second_team_id')->where('season_id', $c_season->id)->orderby('week', 'asc')->get()->groupBy('week');

        return view('front.teamPick.index', compact('fixture'));
    }

    public function pickTeam(Request $request)
    {

        try {
            $team = $request->team;
            $season_id = $request->season;
            $week = $request->week;
            $id = auth()->user()->id;
            $c_date = Carbon::now();
            $expire_date = Payment::where(['season_id' => $season_id, 'user_id' => $id])->value('expire_on');


            $user_status = User::where('id', $id)->value('subscribed');
            if ($user_status == "0") {
                return redirect()->back()->with('error', 'You are not subscribe for team select');
            } else if ($user_status == "1" && $expire_date < $c_date) {
                return redirect()->back()->with('error', 'Please subscribe first your plan is expired');
            } else {
                $select = UserTeam::where(['user_id' => $id, 'season_id' => $season_id, 'week' => $week])->first();
                if ($select) {
                    return redirect()->back()->with('error', 'Team is already selected for this week week is ' . $week);
                } else {
                    $created =  UserTeam::create([
                        'user_id' => $id,
                        'leauge_id' => 1,
                        'season_id' => $season_id,
                        'week' => $week,
                        'team_id' => $team,
                    ]);
                    if ($created) {
                        return redirect()->back()->with('success', 'Congratulation your team is selected successfully');
                    } else {
                        return redirect()->back()->with('error', 'Sorry team is not selected something went wrong');
                    }
                }
            }
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }
}
