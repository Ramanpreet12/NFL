<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Fixture;
use App\Models\SectionHeading;
use App\Models\Season;
 use App\Models\Team;
 use App\Http\Requests\FixtureRequest;
 use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class FixtureController extends Controller
{
    public function fixtures()
    {
        $fixtures = Fixture::with('first_team_id' , 'second_team_id' , 'season')->get();
        $fixtureHeading = SectionHeading::where('name' , 'Upcoming Fixture')->first();
        // dd($fixtureHeading);
        $seasons = Season::get();
      return view('backend.fixture.index' , compact('fixtures' , 'seasons' , 'fixtureHeading'));
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
              $duration = Season::where('id',$request->season)->first();
              $start = Carbon::parse($duration->starting);
              $end = Carbon::parse($duration->ending);
              $store = Carbon::parse($request->date);
              if($end < $store){
                return redirect()->back()->with('error_date','Enter a valid date');
              }
                $diff = $start->diff($store);
                $week = ceil($diff->d/7);
                $f_week = ((int)$week);

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
            $duration = Season::where('id',$request->season)->first();
            $start = Carbon::parse($duration->starting);
            $end = Carbon::parse($duration->ending);
            $store = Carbon::parse($request->date);
            if($end < $store){
              return redirect()->back()->with('error_date','Enter a valid date');
            }
              $diff = $start->diff($store);
              $week = ceil($diff->d/7);
              $f_week = ((int)$week);

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

    public function delete_fixture($id){
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

    public function showFixtures()
    {
        // $fixtures = Fixture::with('first_team_id' , 'second_team_id' , 'season' , 'groupSeason')->get()->groupBy(['week'])->toArray();
        // dd($fixtures);s

        $fixtures = DB::table('fixtures')
        ->join('seasons as s1','s1.id', '=', 'fixtures.season_id')
         ->join('teams as teamOne', 'teamOne.id', '=', 'fixtures.first_team')
        ->join('teams as teamTwo', 'teamTwo.id', '=', 'fixtures.second_team')
        ->select('fixtures.*', 's1.*', 'teamOne.name as firstTeamName', 'teamOne.logo as firstTeamLogo','teamTwo.name as secondTeamName' ,'teamTwo.logo as secondTeamLogo')
        ->get()->groupBy(['season_name' , 'week']);
        // echo "<pre>";
        // print_r($fixtures);
        // die();

       return view('front.fixtures' , compact('fixtures'));
    }
    public function edit_teamResult(Request $request, $id)
    {
        if (!$request->isMethod('post')) {
           $team_results =  Fixture::with('first_team_id' , 'second_team_id' , 'season')->where('id', $id)->get();
            $teams = Team::get();
            return view('backend.team_result.edit', compact('team_results', 'teams'));
        } else {
          $fixture_data =   Fixture::where('id' , $id)->first();

            Fixture::where('id' , $id)->update([

                'win' => $request->winner_team,
                'loss' => $request->loss_team,
            ]);



            if ($request->winner_team) {
                $team_win = Team::where('id', $request->winner_team)->first();
                $match_played = $team_win->match_played;
                $matchwin = $team_win->win;
                Team::where('id', $request->winner_team)->update(['match_played' => (int)$match_played + 1, 'win' => (int)$matchwin + 1]);
                update_userPoints($request->winner_team, $fixture_data->season_id , $fixture_data->week);
            }
            if ($request->loss_team) {
                $team_loss = Team::where('id', $request->loss_team)->first();
                $match_played = $team_loss->match_played;
                $matchloss = $team_loss->loss;
                Team::where('id', $request->loss_team)->update(['match_played' => (int)$match_played + 1, 'loss' => (int)$matchloss + 1]);
            }


            return redirect('admin/teams/result')->with('success', 'Team Result updated successfully');
        }
    }
    public function teamResult_index()
    {
        $fixtures =  Fixture::with('first_team_id' , 'second_team_id' , 'season')->get();
        return view('backend.team_result.index', compact('fixtures'));
    }
}


