<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Payment;
use Illuminate\Support\Carbon;
use App\Models\Fixture;
use PDF;
use Illuminate\Support\Facades\Log;

class UserDashboardController extends Controller
{
    public function dashboard()
    {
        $c_date = Carbon::now();
        $c_season = DB::table('seasons')
            ->whereRaw('"' . $c_date . '" between `starting` and `ending`')
            ->first();
        $payment = Payment::where('user_id', auth()->user()->id)->latest()->take(5)->get();
        $user = DB::table('user_teams')->join('teams', 'teams.id', 'user_teams.team_id')->where(['user_id' => auth()->user()->id, 'season_id' => $c_season->id])->select('teams.name', 'teams.logo', 'user_teams.*')->orderby('user_teams.week', 'desc')->latest()->take(3)->get();
        $upcoming = Fixture::with('first_team_id', 'second_team_id')->where('season_id', $c_season->id)->whereDate('date', '>', $c_date)->orderby('date', 'asc')->latest()->take(5)->get()->groupby('week');
        $prize = [];

        //return view('front.dashboard', compact('user', 'payment','upcoming','prize'));
        return view('front.test', compact('user', 'payment', 'upcoming', 'prize'));
    }
    public function userPayment()
    {
        $payment = Payment::where('user_id', auth()->user()->id)->paginate(6);
        return view('front.payment', compact('payment'));
    }

    public function userHistory()
    {
        $history = DB::table('user_teams')->select('f.id', 'f.win As team_win', 'f.loss As team_loss', 't.name As user_team', 's.season_name As season_name', 't1.name As first_name', 't1.logo As first_logo', 't2.name As second_name', 't2.logo As second_logo', 'user_teams.points As user_point')
            ->join('teams as t', 't.id', '=', 'user_teams.team_id')
            ->join('seasons as s', 's.id', '=', 'user_teams.season_id')
            ->join('fixtures as f', 'f.id', '=', 'user_teams.fixture_id')
            ->join('teams as t1', 't1.id', '=', 'f.first_team')
            ->join('teams as t2', 't2.id', '=', 'f.second_team')
            ->where('user_id', auth()->user()->id)->orderby('user_teams.week', 'desc')->paginate(6);

        return view('front.userhistory', compact('history'));
    }

    public function upcomingMatches()
    {
        $c_date = Carbon::now();
        $c_season = DB::table('seasons')
            ->whereRaw('"' . $c_date . '" between `starting` and `ending`')
            ->first();
        $upcoming = Fixture::with('first_team_id', 'second_team_id')->where('season_id', $c_season->id)->whereDate('date', '>', $c_date)->get()->groupby('week');
        // echo "<pre>";
        // print_r( $upcoming);
        return view('front.upcoming', compact('upcoming'));
    }

    public function invoice($id)
    {

        try {
//             $order = Payment::where('user_id',$id)
//                                 ->join('seasons','seasons.id','=',)->first();
// dd($order);
//             $invoice_date = date('jS F Y', strtotime($order->created_at));
$order = DB::table('payments')->join('users','users.id','=','payments.user_id')
                                ->join('seasons','seasons.id','=','payments.season_id')
                                ->join('addresses','addresses.user_id','=','users.id')
                                ->select('users.name as user_name','users.email as user_email','users.phone_number as user_phone','seasons.season_name as season_name','addresses.address','addresses.city','addresses.zip','addresses.country','payments.*')
                                ->first();
                                $invoice_date = date('jS F Y', strtotime($order->created_at));
            // return view('front.invoice',compact('order'));

           $pdf = PDF::loadView('front.invoice', array('order' => $order))->setOptions(['defaultFont' => 'sans-serif']);
           return $pdf->download('Invoice_' . config('app.name') . '_Order_No # ' . $id . ' Date_' . $invoice_date . '.pdf');
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }
}
