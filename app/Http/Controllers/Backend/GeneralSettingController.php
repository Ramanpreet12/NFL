<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GeneralSetting;
// use Illuminate\Validation\Rule;
use Validator;

class GeneralSettingController extends Controller
{
    public function contactPage(Request $request) {
        if ($request->isMethod('put')) {

            $rules = array(
                'contact_section_heading'      => 'required',
                'contact_location_heading'     => 'required',
                'contact_page_content'         => 'required',
                'contact_form_heading'         => 'required',
                'contact_social_links_heading' => 'required',
                // 'contact_page_image'           => 'required',


            );

        $fieldNames = array(
                'contact_section_heading'       => 'Page Heading',
                'contact_location_heading'      => 'Location Heading',
                'contact_page_content'          => 'Content',
                'contact_form_heading'          => 'Enquiry Form Heading',
                'contact_social_links_heading'  => 'Social Links Heading',
                // 'contact_page_image'            => 'Image',


             );

        $validator = Validator::make($request->all(), $rules);
        $validator->setAttributeNames($fieldNames);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }else{



            $image_file     =   $request->file('contact_page_image');
            if ($image_file) {
                $image_filename = $image_file->getClientOriginalName();
                $success = $image_file->storeAs('public/images/static_page/' , $image_filename);
                if (!isset($success)) {
                    return back()->withError('Could not upload logo');
                }
                // $data["contact_page_image"]=$image_filename;
                GeneralSetting::where(['name' => 'contact_page_image'])->update(['value' => $image_filename]);

            }

            GeneralSetting::where(['name' => 'contact_section_heading'])->update(['value' => $request->contact_section_heading]);
            GeneralSetting::where(['name' => 'contact_location_heading'])->update(['value' => $request->contact_location_heading]);
            GeneralSetting::where(['name' => 'contact_page_content'])->update(['value' => $request->contact_page_content]);
            GeneralSetting::where(['name' => 'contact_form_heading'])->update(['value' => $request->contact_form_heading]);
            GeneralSetting::where(['name' => 'contact_social_links_heading'])->update(['value' => $request->contact_social_links_heading]);
                return redirect()->back()->with('success' , 'Contact Page updated successfully');
            }
        }
        else {
            $get_contact_details = GeneralSetting::where('type', 'contactPage')->get()->toArray();
            $contact_details = key_value('name', 'value', $get_contact_details);

            return view('backend.site_setting.contactPage' ,compact('contact_details'));
        }
    }
}
