<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Fixture;
use App\Models\Team;
use App\Models\Season;
use Illuminate\Support\Facades\DB;

class FrontPagesController extends Controller
{
    public function contact(Request $request)
    {
        if ($request->isMethod('POST')) {
            $request->validate([
                'name'=> 'required|min:4|max:20',
                'subject'=>'required',
                'email'=>'required|email',
                'g-capcha'=>'required'
            ]);
           $contact =  Contact::create($request->all());
           if($contact){
            return redirect()->back()->with('success','We got your request and contact you soon!');
           }else{
            return redirect()->back()->with('error','Request is not sent');
           }

        }else{
            return view('front.contact');
        }
    }

    public function about()
    {
        return view('front.about');
    }

    public function matchResult()
    {

        $get_match_results  = DB::table('fixtures')
        ->join('teams as t1' , 't1.id' , '=' , 'fixtures.first_team')
        ->join('teams as t2' , 't2.id' , '=' , 'fixtures.second_team')
        ->join('seasons' , 'seasons.id' , '=' , 'fixtures.season_id')
        ->whereNotNull(['t1.win' , 't1.loss' , 't2.win' , 't2.loss'] )
        ->select('seasons.*','fixtures.*' , 't1.name as t1_name' , 't2.name as t2_name' , 't1.win as team1_win' , 't1.loss as team1_loss' ,'t2.win as team2_win' , 't2.loss as team2_loss' , 't1.logo as t1_logo' , 't2.logo as t2_logo')

        ->get()->groupby(['season_name', 'week'])->toArray();
        // echo "<pre>";
        // print_r($get_match_results);
        // die();

        return view('front.match_result' , compact('get_match_results'));
    }

    public function prize()
    {
        return view('front.prize');
    }
}
