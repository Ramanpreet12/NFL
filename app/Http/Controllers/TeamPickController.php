<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\Player;
use App\Models\User;

class TeamPickController extends Controller
{
    public function index()
    {
        $get_teams = Team::with('region')->get();

        //to get team according to League their further regions
        // $get_teams = \DB::table('teams')
        // ->join('regions', 'regions.id', '=', 'teams.region_id')
        // ->orderBy('position' , 'asc')
        // ->get()->groupBy(['league' , 'region']);

        // echo "<pre>";
        // print_r($get_teams);
        // die();

      return view('front.teamPick.index' ,compact('get_teams'));
    }

    public function pickTeam(Request $request)
    {
        $id = $request->id;
            $dd = User::where('id',$id)->value('subscribed');
        if($dd == "0"){
            return response()->json(['success'=>"Please subsribe first",'status'=>false],200);
        }else{
            return response()->json(['success'=>'already subsribed','status'=>true],200);
        }
      // if ($request->isMethod('post')) {

        // $pickTeam = new Player;
        // $pickTeam->team_id = $request->team_name;
        // $pickTeam->save();
        // return redirect()->back()->with('success' , 'You have successfully pick the team ');
      // }

    }
}
