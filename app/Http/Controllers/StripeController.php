<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session,Auth;
use Stripe;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\Address;
use App\Models\Season;
use Illuminate\Support\Carbon;
use App\Models\UserDetail;
use App\Models\UserTeam;
use Illuminate\Support\Facades\Mail;
use App\Mail\Payment as payment_class;

class StripeController extends Controller
{
    public function stripe()
    {
        // $date = Carbon::now();
        // $season =Season::where('starting', '<=',  $date)
        // ->where('ending', '>=',  $date)
        // ->where('league','1')
        // ->first();

        $date = Season::where('status' , 'active')->value('starting');
        $season = DB::table('seasons')
            ->whereRaw('"' . $date . '" between `starting` and `ending`')
            ->where('status' , 'active')
            ->where('league','1')
            ->first();
        return view('front.payment.index',compact('season'));
    }

    public function stripePost(Request $request)
    {

        // Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Stripe::setApiKey('sk_test_51N0zp6SEbSqasrdr21ihzINADkmGl7RKvQ0BJrj9UUv5bRLsfP1Rs2mQOVw9wMX2PfyFAP1m44HdQZqzAmFiJcRH00clZAQ8Gr');
        DB::beginTransaction();
        // try {
            $data = [
                'user_id'=>auth()->user()->id,
                'name'=>$request->name,
                'address'=>$request->address,
                'city'=>$request->city,
                'zip'=>$request->zip,
                'country'=>$request->country
            ];
          Address::create($data);
          $user = User::find(auth()->user()->id);

        //   if($user){
        //      $user->season_id=$request->season;
        //      $user->save();
        //   }

            $intent = \Stripe\PaymentIntent::create([
                'amount' => $request->amount*100,
                'currency' => 'inr',
                'automatic_payment_methods' => [
                    'enabled' => 'true',
                ],
            ]);


            DB::commit();
            return response()->json($intent->client_secret);

        // } catch (\Stripe\Exception\CardException $e) {
        //     DB::rollback();
        //     echo 'Status is:' . $e->getHttpStatus() . '\n';
        //     echo 'Type is:' . $e->getError()->type . '\n';
        //     echo 'Code is:' . $e->getError()->code . '\n';
        //     // param is '' in this case
        //     echo 'Param is:' . $e->getError()->param . '\n';
        //     echo 'Message is:' . $e->getError()->message . '\n';
        //     if ($e->getError()->code == "card_declined") {
        //         return redirect()->back()->with('msg', 'Card is declined');
        //     }
        // } catch (\Stripe\Exception\RateLimitException $e) {
        //     echo 'Message is:' . $e->getError()->message . '\n';
        // } catch (\Stripe\Exception\InvalidRequestException $e) {
        //     echo 'Message is:' . $e->getError()->message . '\n';
        // } catch (\Stripe\Exception\AuthenticationException $e) {
        //     echo 'Message is:' . $e->getError()->message . '\n';
        // } catch (\Stripe\Exception\ApiConnectionException $e) {
        //     echo 'Message is:' . $e->getError()->message . '\n';
        // } catch (\Stripe\Exception\ApiErrorException $e) {
        //     echo 'Message is:' . $e->getError()->message . '\n';
        // }
        // return redirect()->back()->with('msg', $e->getError()->message);
        return redirect()->back()->with('msg', 'failed');
    }

    public function success(Request $req)
    {
        DB::beginTransaction();
        try {
            // $c_date = Carbon::now();
            // $c_season= DB::table('seasons')
            //     ->whereRaw('"'.$c_date.'" between `starting` and `ending`')
            //     ->first();

                $c_date = Season::where('status' , 'active')->value('starting');
        $c_season = DB::table('seasons')
            ->whereRaw('"' . $c_date . '" between `starting` and `ending`')
            ->where('status' , 'active')
            ->first();


            $getSeason = DB::table('seasons')->select('starting','ending')->where('id',$c_season->id)->first();

            $dayDiff = Carbon::parse( $getSeason->starting)->diffInDays($getSeason->ending);

            $data = [
                'user_id'=>auth()->user()->id,
                'season_id' =>$c_season->id,
                'payment' => $req->payment_intent,
                'client_secret' => $req->payment_intent_client_secret,
                'status' => $req->redirect_status,
                // 'expire_on'=> $c_date->addDays($dayDiff)
                'expire_on'=> $getSeason->ending
            ];
            // $Payment = Payment::create($data);
            // User::withTrashed()->where('id', auth()->user()->id)->update(['subscribed' => 1]);
            // DB::commit();
            // if ($Payment) {
            //     return redirect()->route('success-message')->with('success', "Payment is successfully done pickup your team");
            // } else {
            //     return redirect()->route('payment')->with('error', "Some thing is went wrong");
            // }

            $Payment = Payment::create($data);

            $user = User::where('id',auth()->user()->id)->first();
            $mdata = ['user_name'=>$user->name];
            User::withTrashed()->where('id', auth()->user()->id)->update(['subscribed' => 1]);
            DB::commit();
            if ($Payment) {
                //Mail::to($user->email)->send(new payment_class($mdata));
                return redirect()->route('success-message')->with('success', "Payment is successfully done pickup your team");
            } else {
                return redirect()->route('payment')->with('error', "Some thing is went wrong");
            }


        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('payment')->with('error', $e->getMessage());
        }
    }

    public function selectTeam(Request $req)
    {
        DB::beginTransaction();
        try {


            // $c_date = Carbon::now();
            // $c_season= DB::table('seasons')
            //     ->whereRaw('"'.$c_date.'" between `starting` and `ending`')
            //     ->first();
            $select = UserTeam::where(['user_id'=>$req->user_id,'season_id'=>$req->season_id,'week'=>$req->week])->first();
            if($select){
                return response()->json(['status'=>200,'message'=>'Team is already selected for week','select'=>'already']);
            }else{
               $created =  UserTeam::create([
                    'user_id'=>$req->user_id,
                    'leauge_id'=>1,
                    'season_id'=>$req->season_id,
                    'week'=>$req->week,
                    'team_id'=>$req->team_id,
                    'fixture_id'=>$req->fixture
                ]);
            }
            DB::commit();
            if ($created) {
                return response()->json(['status'=>200,'message'=>'Team selected successfully','select'=>'']);
            } else {
                return response()->json(['status'=>401,'message'=>'Team is not selected','select'=>'']);
            }
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['status'=>401,'message'=>$e->getMessage()]);
        }
    }
}
