<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function user_management()
    {
        $get_users = User::where('role_as' , '0')->orderBy('id' , 'desc')->get();
        // dd($get_users);
         return view('backend.users.index' , compact('get_users'));
    }

    public function user_data()
    {
        $users = User::where('role_as' , '0')->orderBy('id' , 'desc')->paginate(6);
        // dd($users);
        return response()->json($users, 200);
      // return view('backend.users');
    }



}
