<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TeamResult;
use App\Models\Team;
use Validator;

class TeamResultController extends Controller
{
    public function index()
    {
        $team_results = TeamResult::where('status', 'active')->get();

        return view('backend.team_result.index' , compact('team_results'));
    }
    public function teamResult_data()
    {
        // $fixture = TeamResult::with('first_team_id' , 'second_team_id' , 'season')->paginate(6);
        $team_results = TeamResult::with('team_result_id1' , 'team_result_id2')->paginate(6);

        return response()->json($team_results , 200);
    }
    // public function add_teamResult(Request $request)
    // {
    //     $teams = Team::get();

    //     return view('backend.team_result.create' , compact('teams'));
    // }



    public function add_teamResult(Request $request)
    {
        if (! $request->isMethod('post')) {
            $teams = Team::get();
        return view('backend.team_result.create' , compact('teams'));

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
                return redirect('admin/teams/result')->with('success' , 'Team Result added successfully');
            }
        } else {
            return redirect('admin/team_result/create')->with('message_error' , 'Something went wrong');
        }
    }

    public function edit_teamResult(Request $request , $id){

        if(!$request->isMethod('post')){
            $team_results = TeamResult::where('id' , $id)->first();
            $teams = Team::get();
        return view('backend.team_result.edit' , compact('team_results','teams' ));
        }
        else{
            TeamResult::where('id' , $id)->update([
                'team1_id' => $request->team_one,
                'team2_id' => $request->team_two,
                'team1_score' => $request->team1_score,
                'team2_score' => $request->team2_score,
                'result_status' => $request->result_status,
                'status' => $request->status,

            ]);
            return redirect('admin/teams/result')->with('success' , 'Team Result updated successfully');
        }
    }

    public function delete_teamResult($id){
        TeamResult::where('id' , $id)->delete();
        return redirect()->back()->with('success' , 'Team Result deleted successfully');
    }





}
