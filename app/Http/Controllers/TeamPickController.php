<?php

namespace App\Http\Controllers;

use App\Models\Fixture;
use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\Season;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Models\Payment;

class TeamPickController extends Controller
{
    public function index()
    {
        $c_date = Carbon::now();
        $c_season = DB::table('seasons')
            ->whereRaw('"' . $c_date . '" between `starting` and `ending`')
            ->first();
            // dd($c_season->id);
        //$get_teams = Team::with('region')->get();
        $fixture = Fixture::with('first_team_id','second_team_id')->where('season_id', $c_season->id)->get();
        return view('front.teamPick.index', compact('fixture'));
    }

    public function pickTeam(Request $request)
    {
        $c_date = Carbon::now();
        $id = $request->id;
        $season_id = $request->season_id;
        $expire_date = Payment::where(['season_id' => $season_id, 'user_id' => $id])->value('expire_on');
        $dd = User::where('id', $id)->value('subscribed');
        if ($dd == "0") {
            return response()->json(['success' => "Please subsribe first", 'status' => false, 'plan' => ''], 200);
        } else if ($dd == "1" && $expire_date < $c_date) {
            return response()->json(['success' => "Please subsribe first your plan is expire", 'plan' => 'expired', 'status' => false], 200);
        } else {
            return response()->json(['success' => 'already subsribed', 'status' => true], 200);
        }
        //}
        // if ($request->isMethod('post')) {

        // $pickTeam = new Player;
        // $pickTeam->team_id = $request->team_name;
        // $pickTeam->save();
        // return redirect()->back()->with('success' , 'You have successfully pick the team ');
        // }

    }
}
