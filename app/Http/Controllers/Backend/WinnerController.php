<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;


class WinnerController extends Controller
{
    public function index(){
        // $c_date = Carbon::now();
        // $c_season = DB::table('seasons')
        //     ->whereRaw('"' . $c_date . '" between `starting` and `ending`')
        //     ->first();
        // $user =  DB::table('user_details')
        // ->join('users', 'users.id', '=', 'user_details.user_id')
        // ->join('seasons as s', 's.id', '=', 'user_details.season_id')
        // ->select('s.name as season_name','users.*','user_details.*')
        // ->where('user_details.season_id', '=', $c_season->id)->paginate(6);

       // $user = User::with('team')->get();

        // $fixtures = Fixture::with('season' , 'first_team_id' , 'second_team_id')->get();
        // $seasons = Season::get();

        // $fixture_season_id = Fixture::select('season_id')->get();
        $user = '';
        return view('backend.winner.index',compact('user'));
    }

}
