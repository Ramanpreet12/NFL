<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Payment;
use Illuminate\Support\Carbon;
use App\Models\Fixture;


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

    public function getWeeklyTeams($week = null)
    {
        $c_date = Carbon::now();
        $c_season = DB::table('seasons')
            ->whereRaw('"' . $c_date . '" between `starting` and `ending`')
            ->first();
        if ($week != null) {
            $fix = Fixture::where(['season_id' => $c_season->id, 'week' => $week])->get();
        } else {
            $fix = Fixture::where(['season_id' => $c_season->id, 'week' => 1])->get();
        }
        return response()->json(['data'=>$fix], 200);

    }
}
