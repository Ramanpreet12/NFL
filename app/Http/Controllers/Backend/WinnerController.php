<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Models\UserTeam;
use App\Models\Prize;
use App\Models\Winner;
use App\Models\User;


class WinnerController extends Controller
{
    public function index(){
       $get_users =  DB::table('user_teams')
       ->join('users' , 'users.id' , '=' , 'user_teams.user_id')
        ->select(DB::raw('sum(points) as total_points'),'users.*' , 'user_teams.*' )
        ->groupBy(DB::raw('user_id') )
        ->get();
        return view('backend.winner.index',compact('get_users'));
    }
    public function assign_prize($id)
    {
    //    $get_winning_user = UserTeam::where('user_id' , $id)->with('user')->first();
    $get_winning_user =  DB::table('user_teams')
       ->join('users' , 'users.id' , '=' , 'user_teams.user_id')
        ->select(DB::raw('sum(points) as total_points'),'users.*' , 'user_teams.*' )
        ->groupBy(DB::raw('user_id') )->where('user_id' , $id)
        ->first();
// dd($get_winning_user);
       $get_prizes = Prize::where('status' , 'active')->orderBy('id' , 'desc')->get();
    //    dd($get_winning_user);
        return view('backend.winner.create' , compact('get_winning_user' , 'get_prizes'));
    }
    public function assigned_prize_store(Request $request , $id)
    {
        // try{
            if ($request->isMethod('post')) {
                $input = $request->all();
                $validatedData = $request->validate([
                    'prize_id' => 'required',
                ],
                [
                 'prize_id.required'=> 'The Prize field is required',

                ]
             );
                $winner = Winner::create($input);
                if($winner){
                    return redirect('admin/winner')->with('success_msg', 'Winner created successfully');
                }
                else{
                    return redirect('admin/winner')->with('error_msg', 'Something went wrong');
                }

            }
        // }catch(\Exception $e){
        //     $e->getMessage();
        // }
    }

    public function view_winners()
    {
        $get_winners = Winner::with(['user' , 'prize' , 'season'])->get();
       // dd($get_winners);

        return view('backend.winner.view_winners' , compact('get_winners'));
    }

}
