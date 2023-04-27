<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use App\Models\HomeSetting;
use App\Models\News;
use App\Models\SectionHeading;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Storage;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function section_heading(Request $request)
    {
        if ($request->isMethod('post')) {
            SectionHeading::where('name' , 'Videos')->update([
                        'value' => $request->section_heading,
                    ]);
                    return redirect()->route('videoSetting.index')->with('success' , 'Video title updated successfully');
        }
    }

    public function index()
    {
        $VideoHeading = SectionHeading::where('name' , 'Videos')->first();

        return view('backend.site_setting.video_setting.index' , compact('VideoHeading'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.site_setting.video_setting.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // try{
            //print_r($request->all());exit;
             if ($request->isMethod('post')) {
                 $validator = Validator::make($request->all(), [
                     'title' => 'required',
                     'header' => 'required',
                     'video' => 'required',

                 ]);
                 if ($validator->fails()) {
                     return redirect()->back()->withErrors($validator)->withInput();
                 }else{

                 $data = array();
                  if($request->hasfile('video')){
                    //print_r($request->all());
                         $file = $request->video;
                        //  $destinationPath = public_path(). '/homeSetting/';
                         $filename = date('YmdHis') . "." .$file->getClientOriginalName();
                        //  $file->move($destinationPath, $filename);
                        $file->storeAs('public/videos/' , $filename);

                         //$image_path = $request->file('image')->store('image', 'public');
                         $data['image'] = $filename;
                     }

                     if($request->hasfile('image')){
                        //print_r($request->all());
                             $file = $request->image;
                            //  $destinationPath = public_path(). '/homeSetting/';
                             $filename = date('YmdHis') . "." .$file->getClientOriginalName();
                            //  $file->move($destinationPath, $filename);
                            $file->storeAs('public/images/vacation/' , $filename);

                             //$image_path = $request->file('image')->store('image', 'public');
                             $data['image'] = $filename;
                         }

                     //exit;
                     $data["title"]=$request->title;
                     $data["header"] = $request->header;
                     $data["type"]="video";
                     $data["description"]=$request->description;
                     $data["status"]=$request->status;
                     $result=News::create($data);

                     if($result){
                         return redirect()->route('videoSetting.index')->with('message_success','New Record Added Successfully');
                     }else{
                         return redirect()->route('videoSetting.index')->with('message_error','Something went wrong');
                     }
                }

                 }else {
                     return view('backend.site_setting.video_setting.index');
             }
    //   }catch(\Exception $e){
    //       $e->getMessage();
    //  }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $news = News::find($id);
        return view('backend.site_setting.video_setting.edit', compact('news'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            //print_r($request->all());exit;
             if ($request->isMethod('put')) {
                 $validator = Validator::make($request->all(), [
                     'title' => 'required',
                     'header' => 'required',
                     //'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                 ]);
                 if ($validator->fails()) {
                     return redirect()->back()->withErrors($validator)->withInput();
                 }else{
                 $data = array();
                  if($request->hasfile('video')){
                         $file = $request->video;
                        //  $destinationPath = public_path(). '/homeSetting/';
                         $filename = date('YmdHis') . "." .$file->getClientOriginalName();
                        //  $file->move($destinationPath, $filename);
                        $file->storeAs('public/videos/' , $filename);

                         $data['image'] = $filename;
                     } else{
                        unset($data['image'] );
                     }
                     $data["title"]=$request->title;
                     $data["header"] = $request->header;
                     $data["type"]="video";
                     $data["description"]=$request->description;
                     $data["status"]=$request->status;
                     $result=News::where('id',$id)->update($data);

                     if($result){
                         return redirect()->route('videoSetting.index')->with('message_success','New Record Added Successfully');
                     }else{
                         return redirect()->route('videoSetting.index')->with('message_error','Something went wrong');
                     }
                }

                 }else {
                     return view('backend.site_setting.video_setting.index');
             }
      }catch(\Exception $e){
          $e->getMessage();
     }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $del = News::find($id)->delete();
        if($del){
            return redirect()->route('videoSetting.index')->with('message_success','Reocrd Deleted Successfully');
        }else{
            return redirect()->route('videoSetting.index')->with('message_error','Something went wrong');
        }
    }

    public function videoSettingList(){

        $result = News::where('type',"video")->paginate(6);
        return response()->json($result, 200);
    }
}
