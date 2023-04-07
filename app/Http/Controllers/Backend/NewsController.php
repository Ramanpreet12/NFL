<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\News;
use Storage;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query_array = $request->query();
        //$section=$query_array["section"];
        return view('backend.site_setting.news.index');
    }

    public function news_data(){
        $news_data = News::where('type',"news")->paginate(6);

        return response()->json($news_data, 200);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.site_setting.news.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
           //print_r($request->all());exit;
            if ($request->isMethod('post')) {
                $validator = Validator::make($request->all(), [
                    'title' => 'required',
                    'header' => 'required',
                    'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                ]);
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput();
                }else{
                $data = array();
                 if($request->hasfile('image')){
                        $file = $request->image;
                        // $destinationPath = public_path(). '/homeSetting/';

                        $filename = date('YmdHis') . "." .$file->getClientOriginalName();
                        // $file->move($destinationPath, $filename);
                        $file->storeAs('public/images/news/' , $filename);

                        //$image_path = $request->file('image')->store('image', 'public');
                        $data['image'] = $filename;
                    }
                    $data["title"]=$request->title;
                    $data["header"] = $request->header;
                    $data["type"]='news';
                    $data["description"]=$request->description;
                     $data["status"]=$request->status;
                    $result=News::create($data);

                    if($result){
                        return redirect()->route('news.index')->with('message_success','New Record Added Successfully');
                    }else{
                        return redirect()->route('news.index')->with('message_error','Something went wrong');
                    }
               }

                }else {
                    return view('backend.site_setting.news.index');
            }
     }catch(\Exception $e){
         $e->getMessage();
    }
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
        return view('backend.site_setting.news.edit',compact('news'));
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
                  if($request->hasfile('image')){
                         $file = $request->image;
                        //  $destinationPath = public_path(). '/homeSetting/';
                         $filename = date('YmdHis') . "." .$file->getClientOriginalName();
                        //  $file->move($destinationPath, $filename);
                        $file->storeAs('public/images/news/' , $filename);

                         $data['image'] = $filename;
                     } else{
                        unset($data['image'] );
                     }
                     $data["title"]=$request->title;
                     $data["header"] = $request->header;
                     $data["type"]='news';
                     $data["description"]=$request->description;
                     $data["status"]=$request->status;
                     $result=News::where('id',$id)->update($data);

                     if($result){
                         return redirect()->route('news.index')->with('message_success','New Record Added Successfully');
                     }else{
                         return redirect()->route('news.index')->with('message_error','Something went wrong');
                     }
                }

                 }else {
                     return view('backend.site_setting.news.index');
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
            return redirect()->route('news.index')->with('message_success','Reocrd Deleted Successfully');
        }else{
            return redirect()->route('news.index')->with('message_error','Something went wrong');
        }
    }
}
