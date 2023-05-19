<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TeamResult;
use App\Models\Team;
use Validator;
use App\Models\Fixture;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;


class TeamResultController extends Controller
{
    public function index()
    {
        $fixtures =  Fixture::with('first_team_id' , 'second_team_id' , 'season')->get();
    // dd($fixtures);
        // $team_results = TeamResult::where('status', 'active')->get();
        return view('backend.team_result.index', compact('fixtures'));
    }
    public function teamResult_data()
    {
        // $fixture = TeamResult::with('first_team_id' , 'second_team_id' , 'season')->paginate(6);
        $team_results = TeamResult::with('team_result_id1', 'team_result_id2')->paginate(6);

        return response()->json($team_results, 200);
    }


    public function add_teamResult(Request $request)
    {
        if (!$request->isMethod('post')) {
            $teams = Team::get();
            return view('backend.team_result.create', compact('teams'));
        } elseif ($request->isMethod('post')) {
            $rules = array(
                ''    => '',
            );
            $fieldNames = array(
                ''    => '',
            );

            $validator = Validator::make($request->all(), $rules);
            $validator->setAttributeNames($fieldNames);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            } else {
                $team_results = new TeamResult;

                $team_results->team1_id  = $request->team_one;
                $team_results->team2_id   = $request->team_two;
                $team_results->team1_score   = $request->team1_score;
                $team_results->team2_score  = $request->team2_score;
                $team_results->result_status   = $request->result_status;
                $team_results->status   = $request->status;
                $team_results->save();

                return redirect('admin/teams/result')->with('success', 'Team Result added successfully');
            }
        } else {
            return redirect('admin/team_result/create')->with('message_error', 'Something went wrong');
        }
    }

//     public function edit_teamResult(Request $request, $id)
//     {


//         if (!$request->isMethod('post')) {
//             // $team_results = TeamResult::with(['team_result_id1' , 'team_result_id2'])->where('id', $id)->get();
//            // dd($team_results);
//            $team_results =  Fixture::with('first_team_id' , 'second_team_id' , 'season' , 'first_team_result' , 'second_team_result')->where('id', $id)->get();

//             $teams = Team::get();
//             return view('backend.team_result.edit', compact('team_results', 'teams'));
//         } else {
//             $data = [
//                 'fixture_id' => $request->fixture_id,
//                 'win' => $request->winner_team,
//                 'loss' => $request->loss_team,
//             ];
// $rr = TeamResult::create($data);

//             TeamResult::create([
//                 'fixture_id' => $request->fixture_id,
//                 'win' => $request->winner_team,
//                 'loss' => $request->loss_team,
//             ]);
//             return response()->json(['success' => "team result updated"], 200);
//         }
//     }


        public function edit_teamResult(Request $request, $id)
    {
        if (!$request->isMethod('post')) {
           $team_results =  Fixture::with('first_team_id' , 'second_team_id' , 'season')->where('id', $id)->first();
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



    public function delete_teamResult($id)
    {
        TeamResult::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Team Result deleted successfully');
    }
}
