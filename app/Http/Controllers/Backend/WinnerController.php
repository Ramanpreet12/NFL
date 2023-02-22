<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Fixture;
use App\Models\Season;

class WinnerController extends Controller
{
    public function index(){
        $fixtures = Fixture::with('season' , 'first_team_id' , 'second_team_id')->get();
        $seasons = Season::get();

        $fixture_season_id = Fixture::select('season_id')->get();
    //dd($fixture_season_id->season_id);
        //  $get_season_id = Season::where('id' , $fixture_season_id)->get();
        //  dd($get_season_id);
        return view('backend.winner.index' , compact('fixtures'  , 'seasons'));
    }

}
