<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\GeneralRequest;
use App\Models\General;
use Validator;
use Storage;

class GeneralController extends Controller
{
    public function general()
    {
        $general = General::first();
            return view('backend.site_setting.general' , compact('general'));
    }
    public function general_update(GeneralRequest $request)
    {
        // try {
                $general = General::First();
                $updateDetails = [
                    'name' => $request->get('name'),
                    'email' => $request->get('email'),
                    'homepage_title' => $request->get('homepage_title'),
                    'homepage_subtitle' => $request->get('homepage_subtitle'),
                    'footer_contact' => $request->get('footer_contact'),
                    'footer_address' => $request->get('footer_address'),
                    'footer_content' => $request->get('footer_content'),
                ];
                if($request->has('logo')){
                    // if ($request->hasFile('logo')) {
                    //         $logo_file = $request->file('logo');
                    //         $logo_filename = "logo".time().'.'.$logo_file->getClientOriginalExtension();
                    //         $logo_file->storeAs('public/images/general/' , $logo_filename);
                    // }
                   $logo_filename =  general_images($request->logo);
                    $updateDetails['logo'] = $logo_filename;
                }

                if($request->has('favicon')){
                    $favicon_filename =  general_images($request->favicon);
                    $updateDetails['favicon'] = $favicon_filename;
                }
              $update_query =   $general->update($updateDetails);
              if ($update_query) {
                return redirect()->back()->with('success' , 'General setting updated successfully');
              } else {
                return redirect()->back()->with('message_error' , 'Something went wrong');
              }

            // } catch (\Exception $e) {
            //         $e->getMessage();
            //         }

                }
}
