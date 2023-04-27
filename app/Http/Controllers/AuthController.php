<?php

namespace App\Http\Controllers;

use App\Http\Request\LoginRequest;
use App\Http\Controllers\Controller;
use Auth, Session;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRegisterRequest;

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


    public function new_reg(UserRegisterRequest $request)
        {
          if ($request->isMethod('post'))
          $count =  User::count();
          if ($count <10) {
           $group = 'A';
          } elseif(($count >=10) &&($count <20)) {
             $group = 'B';
          }elseif(($count >=20) &&($count <30)) {
              $group = 'C';
           }
         else{
          $group = 'Z';
         }
                    // dd($request);
                  User::create([
                  'name' => $request->fname,
                  'dob' => $request->birthday,
                  'email' => $request->email,
                  'password' => bcrypt($request->password),
                  'phone_number' => $request->phone,
                  'group' => $group,
                ]);

                // return redirect()->route('payment')->with('success' , 'Fill out below payment information to get subscribed');
                return redirect()->route('login')->with('success' , 'Fill out below payment information to get subscribed');
                // return redirect()->back()->with('success' , 'Fill out below payment information to get subscribed');

        }

        public function UserLogin(Request $request)
        {
            if (!$request->isMethod('post')) {
                return view('front.login');
            } else {
                    if (\Auth::attempt(['email' => $request->email , 'password' => $request->password] ))  {
                        if (\Auth::user()->role_as == 0) {
                            return redirect()->route('dashboard')->with('success' , 'Login successfully');
                        }
                        else{
                            return redirect()->back()->with('userLogin_error' , 'Invalid email or password');
                        }

                    }
                   else{
                     return redirect('login')->with('userLogin_error' , 'Invalid email or password');
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


    public function AdminLogin(LoginRequest $request )
    {
        if ($request->isMethod('post')) {

            if (\Auth::attempt(['email' => $request->email , 'password' => $request->password] ))  {
                // return redirect('admin/dashboard')->with('message_success' , 'Login successfully');
                return redirect('admin/general')->with('message_success' , 'Login successfully');
            }else{
                return redirect('admin/login')->with('message_error' , 'Incorrect email or password');
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
            \Auth::logout();
            return redirect('admin/login');
        }

    }

    //user logout
    public function logout()
    {
        if (Auth::user()->role_as == 0) {
            \Auth::logout();
            return redirect('login');
        }

    }

}
