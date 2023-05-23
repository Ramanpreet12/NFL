<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Fixture;
use App\Models\Team;
use App\Models\Season;
use App\Models\Prize;
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

    public function matchResult()
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
        $get_match_results = Fixture::with('first_team_id','second_team_id')
        ->whereNotNull(['win' , 'loss'])

        ->where('season_id',$c_season->id)->whereDate('date','>',$c_date)
        ->orderBy('week' , 'desc')
        ->get()->groupby('week');

        // echo "<pre>";
        // print_r( $get_match_results);
        // die();
       $season_name = $c_season->season_name;


        return view('front.match_result' , compact('get_match_results' ,'season_name'));
    }

    public function prize()
    {
        $prizes = Prize::with('season')->where('status' , 'active')->get();

        return view('front.prize' , compact('prizes'));
    }
}
