<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Season;

class SeasonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.season.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        return view('backend.season.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->isMethod('post')) {
            $season = new Season;

//             $datetime = $request->start_date;
// $date = new DateTime($datetime);
// echo $date->format('Y-m-d');
// die();


            $season->season_name = $request->name;
            $season->starting = $request->start_date;
            $season->ending = $request->end_date;
            $season->save();
            if($season){
                return redirect()->route('season.index')->with('message_success','New Season Added Successfully');
               }else{
                return redirect()->route('season.index')->with('message_error','Something went wrong');
               }

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
        //
        $season =Season::find($id);
        return view('backend.season.edit', compact('season'));
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

    //     if ($request->isMethod('put')) {


    //     $request->validate([
    //         'season_name' => 'required',
    //         'starting' => 'required',
    //         'ending'=> 'required',
    //     ]);
    //     $data = [
    //         'season_name' => $request->name,
    //         'starting' => $request->starting,
    //         'ending' => $request->ending,
    //     ];

    //     $season = Season::where('id' , $id)->update($data);

    //    if($season){
    //     return redirect()->route('season.index')->with('message_success','New Season Added Successfully');
    //    }else{
    //     return redirect()->route('season.index')->with('message_error','Something went wrong');
    //    }
    // }

    if ($request->isMethod('put')) {
        $data = array();

            $data["season_name"]=$request->name;
            $data["starting"]=$request->starting;
            $data["ending"]=$request->ending;
            $result=Season::where('id',$id)->update($data);
            return redirect()->route('season.index')->with('message_success','New Season Updated Successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function delete($id)
    {
        $del = Season::find($id)->delete();
        if($del){
            return redirect()->route('season.index')->with('message_success','Season Deleted Successfully');
        }else{
            return redirect()->route('season.index')->with('message_error','Something went wrong');
        }

    }

    public function allSeasons(){
        $season = Season::paginate(6);
        return response()->json($season, 200);
    }
}
