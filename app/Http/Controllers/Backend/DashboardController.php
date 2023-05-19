<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Season;
use App\Models\Payment;
use App\Models\Fixture;


class DashboardController extends Controller
{
    public function dashboard()
    {
        $total_user_count = User::get()->count();
        $total_season_count = Season::get()->count();
        $total_payment_count = Payment::get()->count();
        $get_total_amount = $total_payment_count * 100;
        $get_users = User::where('role_as' , '0')->orderby('id' , 'desc')->limit(5)->get();
        $get_upcoming_matches = Fixture::with('first_team_id' , 'second_team_id' , 'season')->limit(4)->get();

//  dd($get_upcoming_matches);
        return view('backend.dashboard' ,compact('total_user_count' , 'total_season_count' , 'get_total_amount' , 'get_users' , 'get_upcoming_matches'));
    }
}
