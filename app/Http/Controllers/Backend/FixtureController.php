<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Fixture;
use App\Models\Season;
 use App\Models\Team;
 use App\Http\Requests\FixtureRequest;

class FixtureController extends Controller
{
    public function fixtures()
    {
        $fixtures = Fixture::with('first_team_id' , 'second_team_id' , 'season')->get();
        $seasons = Season::get();
      return view('backend.fixture.index' , compact('fixtures' , 'seasons'));
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
              //  dd($request);
              Fixture::create([
                'season_id' => $request->season,
                'first_team' => $request->first_team,
                'second_team' => $request->second_team,
                'week' => $request->week,
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
            Fixture::where('id' , $id)->update([
                'season_id' => $request->season,
                'first_team' => $request->first_team,
                'second_team' => $request->second_team,
                'week' => $request->week,
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



}


