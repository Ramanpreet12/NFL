<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AboutPage;


class AboutPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $get_about_page = AboutPage::first();

        return view('backend.site_setting.aboutPage' , compact('get_about_page'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        if($request->hasFile('image'))
        {
            $allowedfileExtension=['pdf','jpg','png','docx'];

            $files = $request->file('image');
            foreach($files as $file)
            {
                $filename = $file->getClientOriginalName();

                $extension = $file->getClientOriginalExtension();
                $check=in_array($extension,$allowedfileExtension);

                if($check)
                {
                    // $items= AboutPage::create($request->all());
                   $about_page =  AboutPage::where('id' , $id)->update([
                        'content' => $request->content,
                        ]);
                        dd($about_page->id);
                    foreach ($request->image as $photo)
                    {

                        $image_file = $photo->storeAs('public/images/AboutPage' ,$filename);

                        AboutPage::where('id' , $id)->update([
                            'about_page_id' => $about_page->id,

                        'about_images' => $filename
                        ]);
                    }
                    echo "Upload Successfully";
                }
                else
                {
                echo '<div class="alert alert-warning"><strong>Warning!</strong> Sorry Only Upload png , jpg , doc</div>';
                }

            }
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
        //
    }
}
