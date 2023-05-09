<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;


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
}
