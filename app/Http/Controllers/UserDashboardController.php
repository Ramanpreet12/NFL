<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Payment;
use Illuminate\Support\Carbon;
use App\Models\Fixture;
use App\Models\UserTeam;

class UserDashboardController extends Controller
{
    public function dashboard()
    {
        $c_date = Carbon::now();
        $c_season = DB::table('seasons')
            ->whereRaw('"' . $c_date . '" between `starting` and `ending`')
            ->first();
        $user = User::with('team')->where('id', auth()->user()->id)->get();

        $payment = Payment::where('user_id', auth()->user()->id)->paginate(6);
        return view('front.dashboard', compact('user', 'payment'));
    }

    public function userHistory()
    {
        $history = DB::table('user_teams')
                ->join('teams','teams.id','=','user_teams.team_id')
                ->join('seasons as s','s.id','=','user_teams.season_id')
                ->where('user_id',auth()->user()->id)->get();
        return view('front.userhistory',compact('history'));
    }

}
