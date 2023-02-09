<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function user_management()
    {
         return view('backend.users');
    }

    public function user_data()
    {
        $users = User::paginate(6);
        return response()->json($users, 200);
      // return view('backend.users');
    }



}
