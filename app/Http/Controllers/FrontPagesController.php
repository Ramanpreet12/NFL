<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Fixture;
use App\Models\Team;
use App\Models\Season;
use App\Models\Prize;
use App\Models\Reviews;
use Illuminate\Support\Facades\DB;

class FrontPagesController extends Controller
{
    public function contact(Request $request)
    {
        // if ($request->isMethod('POST')) {
        //     dd($request);

        //     $request->validate([
        //         'name'=> 'required|min:4|max:20',
        //         'subject'=>'required',
        //         'email'=>'required|email',
        //         'g-capcha'=>'required'
        //     ]);
        //    $contact =  Contact::create($request->all());
        //    if($contact){
        //     return redirect()->back()->with('success','We got your request and contact you soon!');
        //    }else{
        //     return redirect()->back()->with('error','Request is not sent');
        //    }

        // }else{
        //     return view('front.contact');
        // }

        if ($request->isMethod('POST')) {

            $request->validate([
                        'name'=> 'required|min:4|max:20',
                        'subject'=>'required',
                        'email'=>'required|email',
                        'g-capcha'=>'required'
                    ]);

            $url = 'https://www.google.com/recaptcha/api/siteverify';
            $remoteip = $_SERVER['REMOTE_ADDR'];
            $data = [
                    'secret' => config('services.recaptcha.secret'),
                    'response' => $request->get('g-capcha'),
                    'remoteip' => $remoteip
            ];

            $options = [
                'http' => [
                    'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                    'method' => 'POST',
                    'content' => http_build_query($data)
                ]
            ];

            $context = stream_context_create($options);

            $result = file_get_contents($url, false, $context);

            $resultJson = json_decode($result);


            if ($resultJson->success != true) {
                return back()->withErrors(['error' => 'ReCaptcha Error']);
            }
            if ($resultJson->score >= 0.3) {
                $contact =  Contact::create($request->all());

                if($contact){
                        return redirect()->back()->with('success','We got your request and contact you soon!');
                       }else{
                        return redirect()->back()->with('error','Request is not sent');
                       }

                //Validation was successful, add your form submission logic here
                // return back()->with('success', 'Thanks for your message!');
            } else {
            return back()->withErrors(['error' => 'ReCaptcha Error']);
            }
        }else{
           return view('front.contact');
        }
    }


    public function about()
    {
        return view('front.about');
    }

    // public function matchResult()
    // {

    //     // $get_match_results  = DB::table('fixtures')
    //     // ->join('teams as t1' , 't1.id' , '=' , 'fixtures.first_team')
    //     // ->join('teams as t2' , 't2.id' , '=' , 'fixtures.second_team')
    //     // ->join('seasons' , 'seasons.id' , '=' , 'fixtures.season_id')
    //     // ->whereNotNull(['t1.win' , 't1.loss' , 't2.win' , 't2.loss'] )
    //     // ->select('seasons.*','fixtures.*' , 't1.name as t1_name' , 't2.name as t2_name' , 't1.win as team1_win' , 't1.loss as team1_loss' ,'t2.win as team2_win' , 't2.loss as team2_loss' , 't1.logo as t1_logo' , 't2.logo as t2_logo')

    //     // ->get()->groupby(['season_name', 'week'])->toArray();
    //     // echo "<pre>";
    //     // print_r($get_match_results);
    //     // die();

    //     $c_date = Season::where('status' , 'active')->value('starting');
    //     $c_season = DB::table('seasons')
    //         ->whereRaw('"' . $c_date . '" between `starting` and `ending`')
    //         ->where('status' , 'active')->first();
    //         //before
    //     // $get_match_results = Fixture::with('first_team_id','second_team_id')
    //     // ->whereNotNull(['win' , 'loss'])

    //     // ->where('season_id',$c_season->id)->whereDate('date','>',$c_date)
    //     // ->orderBy('week' , 'desc')
    //     // ->get()->groupby('week');

    //     //by regions

    //     // $get_match_results = DB::table('fixtures')
    //     // ->join('teams as t1' , 't1.id' , '=' , 'fixtures.first_team')
    //     // ->join('teams as t2' , 't2.id' , '=' , 'fixtures.second_team')

    //     // ->select( DB::raw('MAX(amount) as max_amount') ,'fixtures.*' ,'t1.id as t1_id' , 't1.name' , 't1.region_id as t1_region_id' , 't1.logo as t1_logo' , 't2.id as t2_id' , 't2.region_id as t2_region_id' , 't2.name as t2_name' , 't2.logo as t2_logo' )
    //     // ->whereNotNull(['fixtures.win' , 'fixtures.loss'])
    //     // ->where('season_id',$c_season->id)->whereDate('date','>',$c_date)
    //     // ->orderBy('week' , 'desc')
    //     // ->get()->groupby('week');







    //     echo "<pre>";
    //     print_r( $get_match_results);
    //     die();
    //    $season_name = $c_season->season_name;


    //     return view('front.match_result' , compact('get_match_results' ,'season_name'));
    // }


    public function matchResult()
    {

         // total of every participant records from the North Region, East Region, South Region, West Region....
        $c_date = Season::where('status' , 'active')->value('starting');
        $c_season = DB::table('seasons')
            ->whereRaw('"' . $c_date . '" between `starting` and `ending`')
            ->where('status' , 'active')->first();


        $total_points = DB::table('user_teams')
        ->select((DB::raw("SUM(user_teams.points) as Userpoints")), 'user_teams.*','regions.region as region_name','t.id as t1_id' , 't.name' , 't.region_id as t_region_id' , 't.logo as t_logo' , 't.win as t_win' ,'t.loss as t_loss')
        ->join('teams as t' , 't.id' , '=' , 'user_teams.team_id')
        ->join('regions' , 'regions.id' , '=' , 't.region_id')
        ->where('season_id',$c_season->id)
         ->groupby(DB::raw('region_name'))->get();


        echo "<pre>";
        print_r( $total_points);
        die();

        // $get_match_results =DB::table('user_teams')
        // ->select((DB::raw('max(points) as year,user_id')), 'user_teams.*','regions.region as region_name','t.id as t1_id' , 't.name' , 't.region_id as t_region_id' , 't.logo as t_logo' , 't.win as t_win' ,'t.loss as t_loss')
        // ->join('teams as t' , 't.id' , '=' , 'user_teams.team_id')
        // ->join('regions' , 'regions.id' , '=' , 't.region_id')
        // ->where('season_id',$c_season->id)
        //  ->groupby(DB::raw('region_name'))->get();
        // echo "<pre>";
        // print_r( $get_match_results);
        // die();


       $season_name = $c_season->season_name;


        return view('front.match_result' , compact('total_points' ,'season_name'));
    }



    public function gameResult()
    {

        // $get_match_results  = DB::table('fixtures')
        // ->join('teams as t1' , 't1.id' , '=' , 'fixtures.first_team')
        // ->join('teams as t2' , 't2.id' , '=' , 'fixtures.second_team')
        // ->join('seasons' , 'seasons.id' , '=' , 'fixtures.season_id')
        // ->whereNotNull(['t1.win' , 't1.loss' , 't2.win' , 't2.loss'] )
        // ->select('seasons.*','fixtures.*' , 't1.name as t1_name' , 't2.name as t2_name' , 't1.win as team1_win' , 't1.loss as team1_loss' ,'t2.win as team2_win' , 't2.loss as team2_loss' , 't1.logo as t1_logo' , 't2.logo as t2_logo')

        // ->get()->groupby(['season_name', 'week'])->toArray();
        // echo "<pre>";
        // print_r($get_match_results);
        // die();

        $c_date = Season::where('status' , 'active')->value('starting');
        $c_season = DB::table('seasons')
            ->whereRaw('"' . $c_date . '" between `starting` and `ending`')
            ->where('status' , 'active')->first();
        $get_game_results = Fixture::with('first_team_id','second_team_id')
        ->whereNotNull(['win' , 'loss'])

        ->where('season_id',$c_season->id)->whereDate('date','>',$c_date)
        ->orderBy('week' , 'desc')
        ->get()->groupby('week');




        // echo "<pre>";
        // print_r( $get_game_results);
        // die();
       $season_name = $c_season->season_name;


        return view('front.game_result' , compact('get_game_results' ,'season_name'));
    }



    public function prize()
    {
        $prizes = Prize::with('season')->where('status' , 'active')->get();

        return view('front.prize' , compact('prizes'));
    }


    public function standings()
    {
        // $teams = Team::get()->groupBy(['league' , 'region_id']);

        // $teams = DB::table('teams')
        // ->join('regions' , 'regions.id' , '=' , 'teams.region_id' )
        // ->get()->groupBy(['league' , 'region']);

        $teams = DB::table('user_teams')
        ->join('teams' , 'teams.id' , '=' , 'user_teams.team_id' )
        // ->join('regions' , 'regions.id' , '=' , 'teams.region_id' )
         ->get()->groupBy(['league' , 'region']);


        // echo "<pre>";
        // print_r($teams);
        // die();

       return view('front.standings');
    }


    public function results_by_regions()
    {
       return 'Results by regions';
    }

    public function reviews(Request $request)
    {

       $reviews = Reviews::create([
        'username' => $request->username,
        'email' => $request->email,
        'comment' => $request->comment,
        'rating' => $request->rating,
       ]);
       return redirect()->back()->with('reviews_success' , 'Reviews added successfullly');

    }

}
