<?php

namespace App\Http\Controllers;

use App\Http\Request\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRegisterRequest;
use App\Mail\FOrgotPassword;
use App\Mail\Signup;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Models\FogotPassword;
use Illuminate\Support\Str;
use PhpParser\Node\Stmt\TryCatch;
use Exception;


class AuthController extends Controller
{
    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function userRegister(Request $request)
    {
        return view('front.register');
    }


    // public function new_reg(UserRegisterRequest $request)
    // {
    //     try {
    //         if ($request->isMethod('post'))
    //             $count =  User::count();
    //         if ($count < 10) {
    //             $group = 'A';
    //         } elseif (($count >= 10) && ($count < 20)) {
    //             $group = 'B';
    //         } elseif (($count >= 20) && ($count < 30)) {
    //             $group = 'C';
    //         } else {
    //                 if (\Auth::attempt(['email' => $request->email , 'password' => $request->password , 'role_as' => 0] ))  {
    //                     if (\Auth::user()->role_as == 0) {
    //                         return redirect()->route('dashboard')->with('success' , 'Login successfully');
    //                     }
    //                     else{
    //                         return redirect()->back()->with('userLogin_error' , 'Invalid email or password');
    //                     }

    //                 }
    //                else{
    //                  return redirect('login')->with('userLogin_error' , 'Invalid email or password');
    //                }

    //             }
    //             $group = 'Z';
    //         }
    //         $user =  User::create([
    //             'name' => $request->fname,
    //             'dob' => $request->birthday,
    //             'email' => $request->email,
    //             'password' => bcrypt($request->password),
    //             'phone_number' => $request->phone,
    //             'group' => $group,
    //         ]);
    //         if ($user) {
    //             Mail::to($user->email)->send(new Signup($user));
    //             return redirect()->route('login')->with('success', 'Fill out below payment information to get subscribed');
    //         } else {
    //             return redirect()->back()->with('error', 'Something went wrong please try again');
    //         }
    //     }catch(Exception $e) {
    //         Log::info($e->getMessage());
    //     }
    // }

    public function new_reg(UserRegisterRequest $request)
        {
            if ($request->isMethod('post'))
                $count =  User::count();
                if ($count <1000) {

                    $group = 'A';

                } elseif(($count >=1000) &&($count <2000)) {
                    $group = 'B';

                }elseif(($count >=2000) &&($count <3000)) {
                    $group = 'C';

                }elseif(($count >=3000) &&($count <4000)) {
                    $group = 'D';
                }
                elseif(($count >=4000) &&($count <5000)) {
                    $group = 'E';
                }
                elseif(($count >=5000) &&($count <6000)) {
                    $group = 'F';
                }
                elseif(($count >=6000) &&($count <7000)) {
                    $group = 'G';
                }
                elseif(($count >=7000) &&($count <8000)) {
                    $group = 'H';
                }
                elseif(($count >=8000) &&($count <9000)) {
                    $group = 'I';
                }
                elseif(($count >=9000) &&($count <10000)) {
                    $group = 'J';
                }
                elseif(($count >=10000) &&($count <11000)) {
                    $group = 'K';
                }
                elseif(($count >=11000) &&($count <12000)) {
                    $group = 'L';
                }
                elseif(($count >=12000) &&($count <13000)) {
                    $group = 'M';
                }
                elseif(($count >=13000) &&($count <14000)) {
                    $group = 'N';
                }
                elseif(($count >=14000) &&($count <15000)) {
                    $group = 'O';
                }
                elseif(($count >=15000) &&($count <16000)) {
                    $group = 'P';
                }
                elseif(($count >=16000) &&($count <17000)) {
                    $group = 'Q';
                }
                elseif(($count >=17000) &&($count <18000)) {
                    $group = 'R';
                }
                elseif(($count >=18000) &&($count <19000)) {
                    $group = 'S';
                }
                elseif(($count >=19000) &&($count <20000)) {
                    $group = 'T';
                }
                elseif(($count >=20000) &&($count <21000)) {
                    $group = 'U';
                }
                elseif(($count >=21000) &&($count <22000)) {
                    $group = 'V';
                }
                elseif(($count >=22000) &&($count <23000)) {
                    $group = 'W';
                }
                elseif(($count >=23000) &&($count <24000)) {
                    $group = 'X';
                }
                elseif(($count >=24000) &&($count <25000)) {
                    $group = 'Y';
                }
                else{
                 $group = 'Z';
                }

                    // dd($request);
                  User::create([
                'team_id' => 0,
                  'name' => $request->fname,
                  'group' => $group,
                  'dob' => $request->birthday,
                  'email' => $request->email,
                  'password' => bcrypt($request->password),
                  'phone_number' => $request->phone,

                ]);
                if ($user) {
                    Mail::to($user->email)->send(new Signup($user));
                    return redirect()->route('login')->with('success', 'Fill out below payment information to get subscribed');
                    } else {
                    return redirect()->back()->with('error', 'Something went wrong please try again');
                    }

                return redirect()->route('login')->with('success' , 'registration sucessfull');

        }



    public function UserLogin(Request $request)
    {
        if (!$request->isMethod('post')) {
            return view('front.login');
        } else {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                if (Auth::user()->role_as == 0) {
                    return redirect()->route('dashboard')->with('success', 'Login successfully');
                } else {
                    return redirect()->back()->with('userLogin_error', 'Invalid email or password');
                }
            } else {
                return redirect('login')->with('userLogin_error', 'Invalid email or password');
            }
        }
    }



    /**
     * Authenticate login user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function login(LoginRequest $request)
    // {
    //     // if (!\Auth::attempt([
    //     //     'email' => $request->email,
    //     //     'password' => $request->password

    //     // ])) {
    //     //     throw new \Exception('Wrong email or password.');
    //     // }


    // }

    public function AdminLoginCreate()
    {
        return view('backend.admin_login', [
            'layout' => 'login'
        ]);
    }


    public function AdminLogin(LoginRequest $request)
    {
        if ($request->isMethod('post')) {

            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                // return redirect('admin/dashboard')->with('message_success' , 'Login successfully');
                return redirect('admin/general')->with('message_success', 'Login successfully');
            } else {
                return redirect('admin/login')->with('message_error', 'Incorrect email or password');
            }
        }
    }

    /**
     * Logout user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function Adminlogout()
    {
        if (Auth::user()->role_as == 1) {
            Auth::logout();
            return redirect('admin/login');
        }
    }

    //user logout
    public function logout()
    {
        if (Auth::user()->role_as == 0) {
            Auth::logout();
            return redirect('login');
        }
    }
    public function forgotPassword(Request $request)
    {

        if ($request->isMethod('post')) {
            $request->validate([
                'email' => 'required|email'
            ]);
            $user = User::where('email', $request->email)->first();
            if (!$user) {
                return redirect()->back()->with('error', 'Email address is invalid');
            } else {


                $token = Str::random(20);

                FogotPassword::create([
                    'email' => $request->email,
                    'token' => $token,
                ]);
                $data = ['email' => $request->email, 'token' => $token, 'user_name' => $user->name];
                Mail::to($request->email)->send(new FOrgotPassword($data));
                return redirect()->route('change_password')->with('success', 'Token is generate successfully check your email for update password');
            }
        } else {
            return view('front.forgot-password');
        }
    }
    public function changePassword(Request $request)
    {

        //try {
            if ($request->isMethod('post')) {
                $request->validate([
                    'token'=>'required',
                    'password'=>'required|min:6',
                    'confirm' => 'required|min:6|same:password',
                ]);
                $pass = FogotPassword::where('token',$request->token)->first();
                if($pass){
                    $user = User::where('email',$pass->email)->update([
                        'password'=>bcrypt($request->password)
                    ]);
                    FogotPassword::where('id',$pass->id)->delete();
                    return redirect()->route('login')->with('success','Passowrd is updated successfully');
                }else{
                    return redirect()->back()->with('error','Invalid token');
                }
            }else{
                return view('front.changepassword');
            }
        // } catch (Exception $e) {
        //     Log::info($e->getMessage());
        // }
    }
}
