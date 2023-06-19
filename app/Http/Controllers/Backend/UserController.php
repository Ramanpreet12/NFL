<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\SectionHeading;

class UserController extends Controller
{

    public function section_heading(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate(['section_heading'=> 'required']);

            SectionHeading::where('name' , 'Player Roster')->update([
                        'value' => $request->section_heading,
                    ]);
        return redirect('admin/user')->with('success_msg' , 'Player Roster Title updated successfully');
        }
    }

    public function user_management()
    {
        $get_users = User::where('role_as' , '0')->orderBy('id' , 'desc')->select('name' , 'email' , 'photo' ,'subscribed')->get();
        $playerRosterHeading = SectionHeading::where('name' , 'Player Roster')->first();
         return view('backend.users.index' , compact('get_users' ,'playerRosterHeading'));
    }

    public function user_data()
    {
        $users = User::where('role_as' , '0')->orderBy('id' , 'desc')->paginate(6);

        return response()->json($users, 200);
      // return view('backend.users');
    }



}
