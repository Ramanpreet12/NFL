<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserTeam;
use App\Models\SectionHeading;
use App\Models\Payment;
use PDF;

class UserController extends Controller
{

    public function section_heading(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate(['section_heading'=> 'required']);

            SectionHeading::where('name' , 'Player Roster')->update([
                        'value' => $request->section_heading,
                    ]);
        return redirect('admin/user')->with('success_msg' , 'Player Roster Title updated successfully');
        }
    }

    public function user_management()
    {
        $get_users = User::where('role_as' , '0')->orderBy('id' , 'desc')->select('name' , 'email' , 'photo' ,'subscribed' ,'id')->get();
        $playerRosterHeading = SectionHeading::where('name' , 'Player Roster')->first();
         return view('backend.users.index' , compact('get_users' ,'playerRosterHeading'));
    }

    public function user_data()
    {
        $users = User::where('role_as' , '0')->orderBy('id' , 'desc')->paginate(6);

        return response()->json($users, 200);
      // return view('backend.users');
    }


    public function user_datails($id){
        // $userDetails = DB::table('users')
        // ->join('regions', 'regions.id', 'users.region_id')
        // ->join('usa_states', 'usa_states.region_id', 'regions.id')
        // ->join('user_teams', 'user_teams.user_id', 'users.id')
        // ->join('teams', 'teams.id', 'user_teams.team_id')
        // // ->join('payments' , 'payments.user_id' ,'=' , 'users.id')
        // ->where(['users.id' => $id])
        // ->select('regions.region as regionName','teams.name as userTeam', 'users.*','usa_states.state_name as state_name')
        // ->first();

        $check_user_pick_team = UserTeam::where('user_id' , $id)->first();
        // dd($check_user_pick_team);
       $check_user_subscribe =  Payment::where('user_id' , $id)->first();

       if (($check_user_subscribe != '') && ($check_user_pick_team  == '')) {

        //$userDetails = 'only subscribed';


      $userDetails = DB::table('users')
      ->select('regions.region as regionName', 'users.*','usa_states.state_name as state_name' , 'payments.user_id as payment_user_id'  )
        ->join('regions', 'regions.id', 'users.region_id')
        ->join('usa_states', 'usa_states.region_id', 'regions.id')
        // ->join('user_teams as ut', 'ut.user_id','=' ,'users.id')
        // ->join('teams as t', 't.id', '=', 'user_teams.team_id')

        // ->join('teams as t', 't.id','=', 'user_teams.team_id')
         ->join('payments' , 'payments.user_id' ,'=' , 'users.id')
        ->where(['users.id' => $id])

        ->first();

       }
       elseif (($check_user_pick_team != '') && ($check_user_subscribe != '')) {
      //  $userDetails = 'User Has pick the team and subsribed too';

        $userDetails = DB::table('users')
        ->select('regions.region as regionName', 'users.*','usa_states.state_name as state_name', 'payments.user_id as payment_user_id' , 'teams.name as user_team_name' , 'teams.logo as user_team_logo')
          ->join('regions', 'regions.id', 'users.region_id')
          ->join('usa_states', 'usa_states.region_id', 'regions.id')
            ->join('user_teams', 'user_teams.user_id', 'users.id')
            ->join('teams', 'teams.id', 'user_teams.team_id')

           ->join('payments' , 'payments.user_id' ,'=' , 'users.id')
          ->where(['users.id' => $id])
          ->first();
       }

       else {

       $userDetails = 'Neither Subscribed or User Has pick the team (register)';
           $userDetails = DB::table('users')
        ->join('regions', 'regions.id', 'users.region_id')
        ->join('usa_states', 'usa_states.region_id', 'regions.id')

        ->where(['users.id' => $id])
        ->select('regions.region as regionName','users.*','usa_states.state_name as state_name')
        ->first();

       }





       return view('backend.users.userdetails' , compact('userDetails') );
  }

  public function userPayment_datails($id){
      $userData = User::where('id', $id)->get();
      $userPaymentData =  DB::table('payments')->join('addresses', 'addresses.payment_id', 'payments.id')->join('seasons', 'seasons.id', 'payments.season_id')->where(['payments.user_id' => $id])->select('seasons.season_name','payments.*','addresses.name','addresses.address','addresses.city','addresses.country')->get();
      // echo "<pre>";
      // print_r($userPaymentData);die();
      return view('backend.users.userpayments',compact('userData' ,'userPaymentData'));
  }

  public function payment_invoice($id)
  {
      try {
      $order = DB::table('payments')->join('addresses', 'addresses.payment_id','=', 'payments.id')->join('seasons', 'seasons.id','=', 'payments.season_id')->where(['payments.id' => $id])->select('seasons.season_name','payments.*','addresses.name','addresses.address','addresses.city','addresses.country','addresses.zip')->first();
         $invoice_date = date('jS F Y', strtotime($order->created_at));
         return view('backend.users.invoice', compact('order'));
      } catch (\Exception $e) {
         dd($e->getMessage());
         // Log::info($e->getMessage());
      }
  }


}
