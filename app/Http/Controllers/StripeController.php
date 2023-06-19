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
use GuzzleHttp\Client;
use Log;

class StripeController extends Controller
{
    public function stripe()
    {
        // $date = Carbon::now();
        // $season =Season::where('starting', '<=',  $date)
        // ->where('ending', '>=',  $date)
        // ->where('league','1')
        // ->first();

        // $date = Season::where('status' , 'active')->value('starting');
        $get_current_year = Carbon::now()->format('Y');
        $date = Season::where(['status'=>'active' , 'season_name' => $get_current_year])->value('starting');

        $season = DB::table('seasons')
            ->whereRaw('"' . $date . '" between `starting` and `ending`')
            ->where('status' , 'active')
            ->where('league','1')
            ->first();
        return view('front.payment.index',compact('season'));
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


    public function clover_charge(Request $request){

        try {
        $get_current_year = Carbon::now()->format('Y');
        $c_date = Season::where(['status'=>'active' , 'season_name' => $get_current_year])->value('starting');
        $c_season = DB::table('seasons')
            ->whereRaw('"' . $c_date . '" between `starting` and `ending`')
            ->where('status' , 'active')
            ->first();

        $payment_data = Payment::where(['user_id' => auth()->user()->id , 'season_id' => $request->input('season') ])->first();

        if($payment_data){
             $season_name_for_msg = $c_season->season_name;
             $season_for_msg = 'You are already subscribed for season :'.$season_name_for_msg;

             return redirect()->back()->with('message_error' ,$season_for_msg);
         }
         // new payment creation
        $client = new Client();
        $response = $client->request('POST', 'https://scl-sandbox.dev.clover.com/v1/charges', [
                'json' => [
                    'ecomind' => 'ecom',
                    'amount' => $request->input('amount')*100,
                    'user_id' =>   auth()->user()->id,
                    'name' =>  $request->input('fname'),
                    'currency' => 'USD',
                    'capture' => true,
                    'source' => $request->input('cloverToken'),
                ],
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer '.config("app.clover_private_key") ,
                    // 'Authorization' => 'Bearer 621bd654-61f2-ef27-a38d-c180a0b953bd',
                ],
            ]);
        $res = json_decode($response->getBody(), true);
           if(isset($res["error"])){
                $msg=$res["error"]["message"];
                return redirect()->back()->with('message_error' , $msg);
            }
            elseif(isset($res["status"]) && $res["status"]=="succeeded"){

                $message =  'This user having id '.auth()->user()->id.' has successfully done the payment. The transaction number is '.$res["id"].'and the reference number is '.$res['ref_num'];
                Log::channel('successfullpayment')->info($message);

                    $data = [
                        'user_id' => auth()->user()->id,
                        'season_id' => $request->input('season'),
                        'amount'=> $res["amount"]/100,
                        'transaction_id'=> $res["id"],
                        'payment_method' => $res["payment_method_details"],
                        'status' => $res["status"],
                        'currency' => $res["currency"],
                        'clover_payment_created_timestamp' => $res["created"],
                        'ref_num' => $res["ref_num"],
                        'exp_month_card' => $res['source']["exp_month"],
                        'exp_year_card' => $res['source']["exp_year"],
                        'first6_digit_of_card' =>  $res['source']["first6"],
                        'last4_digit_of_card' =>$res['source']["last4"],
                        'clover_payment_intiation_id'=>$res['source']["id"]
                    ];
                    $Payment = Payment::create($data);
                    $addressData = [
                        'user_id'=>auth()->user()->id,
                        'payment_id'=> $Payment->id,
                        'name'=> $request->input('fname'),
                        'address'=>$request->input('address'),
                        'city'=>$request->input('city'),
                        'zip'=>$res['source']["address_zip"],
                        'country'=> $request->input('country')
                    ];
                    $address = Address::create($addressData);

                    $mdata = ['user_name'=>'yaman walia'];
                    //    DB::commit();
                            if ($address) {
                                Mail::to('yamanwalia000@gmail.com')->send(new payment_class($mdata));
                                // return redirect()->route('success-message' , $Payment)->with('success', '');
                                return view('front.payment.success' , compact('Payment'));
                            } else {
                                return redirect()->route('payment')->with('error', "Some thing is went wrong");
                            }

            }
          } catch (\Exception $e) {

            $message =  'This user having id '.auth()->user()->id.' is facing the following isssue '.$e->getMessage();
            Log::channel('payment')->info($message);

            return response()->json(['status'=>401,'message'=> 'We are facing issue while processing your payment.Please try after some time.If amount is debited from your side then please contact to our support team']);

          }

    }



    public function SendEmail(Request $request) {
        // require base_path("vendor/autoload.php");
        $mail = new PHPMailer(true);
        try {
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host = 'smtp.example.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'user@example.com';
            $mail->Password = '**********';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('sender@example.com', 'SenderName');
            $mail->addAddress($request->emailRecipient);

            // if(isset($_FILES['emailAttachments'])) {
            //     for ($i=0; $i < count($_FILES['emailAttachments']['tmp_name']); $i++) {
            //         $mail->addAttachment($_FILES['emailAttachments']['tmp_name'][$i], $_FILES['emailAttachments']['name'][$i]);
            //     }
            // }
            $mail->isHTML(true);
            $mail->Subject = $request->emailSubject;
            $mail->Body    = $request->emailBody;
            if( !$mail->send() ) {
                return back()->with("failed", "Email not sent.")->withErrors($mail->ErrorInfo);
            }else {
                return back()->with("success", "Email has been sent.");
            }
        } catch (Exception $e) {
             return back()->with('error','Message could not be sent.');
        }
    }

}
