<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use Validator;
use Storage;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::get();
        return view('backend.site_setting.banner.index' , compact('banners'));
    }
    public function create(Request $request)
    {
        if (! $request->isMethod('post')) {
            return view('backend.site_setting.banner.create');
        } elseif ($request->isMethod('post')) {


            $rules = array(
                'heading'    => 'required',
                // 'serial'       =>'required',
                // 'image'      => 'required'
            );


            $fieldNames = array(
                'heading'    => 'Heading',
                // 'serial'      => 'Serial',
                // 'image'      => 'Image'
            );

            $validator = Validator::make($request->all(), $rules);
            $validator->setAttributeNames($fieldNames);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            } else {
                // $image     =   $request->file('image');
                // $extension =   $image->getClientOriginalExtension();
                // $filename  =   'banner_'.time() . '.' . $extension;
                // $success   = $image->move('public/images/banners', $filename);

                // if (!isset($success)) {
                //     return back()->withError('Could not upload Banner');
                // }

                if ($request->hasFile('image')) {
                    $image = $request->file('image');
                    $filename = "banner_".time().'.'.$image->getClientOriginalExtension();
                    $success = $image->storeAs('public/images/banners/' , $filename);
                    if (!isset($success)) {
                        return back()->withError('Could not upload Banner');
                    }

                }

                $banners = new Banner;
                $banners->heading  = $request->heading;
                $banners->image    = $filename;
                $banners->serial   = $request->serial;
                $banners->status   = $request->status;
                $banners->save();
                return redirect('admin/banner')->with('success' , 'Banner added successfully');
            }
        } else {
            return redirect('admin/banner/create')->with('message_error' , 'Something went wrong');
        }
    }


    public function update(Request $request)
    {
        if (! $request->isMethod('post')) {
            $banners = Banner::find($request->id);
            return view('backend.site_setting.banner.edit', compact('banners'));
        } elseif ($request->isMethod('post')) {
            $rules = array(
                    'heading'    => 'required',

                    );

            $fieldNames = array(
                        'heading'    => 'Heading',

                        );

            $validator = Validator::make($request->all(), $rules);
            $validator->setAttributeNames($fieldNames);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            } else {
                $banners = Banner::find($request->id);
                $banners->heading  = $request->heading;
                $banners->serial   = $request->serial;
                $banners->status   = $request->status;
                $image     =   $request->file('image');
                if ($image) {
                    $extension =   $image->getClientOriginalExtension();
                    $filename  =   'banner_'.time() . '.' . $extension;
                    $success = $image->storeAs('public/images/banners/' , $filename);
                    if (!isset($success)) {
                        return back()->withError('Could not upload Banner');
                    }
                    $banners->image = $filename;
                }

                $banners->save();
                return redirect('admin/banner')->with('success' , 'Banner updated successfully');;
            }
        } else {
            return redirect('admin/banner/edit/'.$request->id);
        }
    }


    public function delete(Request $request)
    {

            //$banners   = Banners::find($request->id);
            // $file_path = public_path().'/front/images/banners/'.$banners->image;
            // if (file_exists($file_path)) {
            //     unlink($file_path);
            // }
            Banner::find($request->id)->delete();
        return redirect('admin/banner')->with('success' , 'Banner deleted successfully');;
    }

}
