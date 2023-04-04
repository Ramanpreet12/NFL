<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\General;
use Validator;
use Storage;

class GeneralController extends Controller
{
    // public function general()
    // {
    //     return view('backend.site_setting.general');
    // }
    public function general(Request $request)
    {
        if (! $request->isMethod('post')) {
            $general = General::first();
            return view('backend.site_setting.general' , compact('general'));
        } elseif ($request->isMethod('post')) {

            $rules = array(
                'name'    => 'required',
            );
            $fieldNames = array(
                'name'    => 'Name',
            );

            $validator = Validator::make($request->all(), $rules);
            $validator->setAttributeNames($fieldNames);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            } else {
                $general = General::First();
                $request->validate([
                    'name' => 'required'
                ]);
                $updateDetails = [
                    'name' => $request->get('name'),
                    'email' => $request->get('email'),
                    'homepage_title' => $request->get('homepage_title'),
                    'homepage_subtitle' => $request->get('homepage_subtitle'),
                    'footer_contact' => $request->get('footer_contact'),
                    'footer_address' => $request->get('footer_address'),

                ];
                if($request->has('logo')){
                    if ($request->hasFile('logo')) {
                            $logo_file = $request->file('logo');
                            $logo_filename = "logo".time().'.'.$logo_file->getClientOriginalExtension();
                            $logo_file->storeAs('public/images/general/' , $logo_filename);
                    }
                    $updateDetails['logo'] = $logo_filename;

                }
                if($request->has('favicon')){
                    if ($request->hasFile('favicon')) {
                            $favicon_file = $request->file('favicon');
                            $favicon_filename = "favicon".time().'.'.$favicon_file->getClientOriginalExtension();
                            $favicon_file->storeAs('public/images/general/' , $favicon_filename);
                    }
                    $updateDetails['favicon'] = $favicon_filename;
                }

                // Notice the call below
                $general->update($updateDetails);




               // $general->update();
                return redirect()->back()->with('success' , 'General setting update successfully');
            }
        } else {
            return redirect('admin/general');
        }


    }
}
