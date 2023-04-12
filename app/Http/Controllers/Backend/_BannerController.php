<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use Validator;
use Storage;
use App\Http\Requests\BannerRequest;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::get();
        return view('backend.site_setting.banner.index' , compact('banners'));
    }
    public function create()
    {
        return view('backend.site_setting.banner.create');
    }

    public function store(BannerRequest $request)
    {
         if($request->isMethod('post')) {
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
    }

    public function edit($id)
    {
        $banners = Banner::find($id);
        return view('backend.site_setting.banner.edit', compact('banners'));
    }

    public function update(BannerRequest $request)
    {
        if ($request->isMethod('put')) {
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
                $banners->update();
                return redirect('admin/banner')->with('success' , 'Banner updated successfully');;
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
