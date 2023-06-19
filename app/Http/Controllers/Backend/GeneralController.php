<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\GeneralRequest;
use App\Models\General;
use Validator;
use Illuminate\Support\Str;
use Storage;

class GeneralController extends Controller
{
    public function general()
    {
        $general = General::first();
        // echo "<pre>";
        // print_r($general);die();
            return view('backend.site_setting.general' , compact('general'));
    }
    public function general_update(GeneralRequest $request)
    {
      // dd($request);die();
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
                    'email_color' => $request->get('Emailtext_color'),
                    'footer_contact_color' => $request->get('FooterContact_color'),
                    'other_contact_color' => $request->get('otherContact_color'),
                    'footer_add_color' => $request->get('Footeraddress_color'),
                    'footer_content_color' => $request->get('FooterContent_color'),
                    'footer_afilated_color' => $request->get('FooterAffliated_color'),
                    'privacy_policy' => $request->get('privacy_policy'),
                    'privacy_policy_color' => $request->get('privacy_policy_color'),
                    'santa_game_store' => $request->get('santa_game_store'),
                    'santa_game_store_color' => $request->get('santa_game_store_color'),
                    'santa_game_store_link' => $request->get('santa_game_store_link'),
                    'footer_bar' => $request->get('footer_bar'),
                    'footer_content_head' => $request->get('footer_content_head'),
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

                public function prize_banner(Request $request) {
                  $general = General::First();
                  $update_prize_banner = array();
                  if($request->has('prize_banner')){
                      $prize_banner_filename =  general_images($request->prize_banner);
                      $update_prize_banner['prize_banner'] = $prize_banner_filename;
                  }

                  $update_query =  $general->update( $update_prize_banner);
                  return redirect()->back()->with('success_msg' , 'Prize Banner updated successfully');
              }
}
