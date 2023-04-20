<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Team;
use App\Http\Requests\TeamValidation;
use Storage;
use App\Models\Region;

class TeamController extends Controller
{
    public function index(){
        return view('backend.team.index');
    }

    public function getAll(){
        $team = Team::with('region')->paginate(6);
        return response()->json($team, 200);
    }

    public function add(){
        $get_regions = Region::where('status' , 'active')->get();
        return view('backend.team.create' , compact('get_regions'));
    }
    public function create(Request $request){
        // try{
            if ($request->isMethod('post')) {

                $input = $request->all();
                // dd($input);

                //    if($request->hasfile('logo')){
                //       $logo =  fileLoad($request->logo);
                //       $input['logo'] = $logo;
                //    }


                    if ($request->hasFile('logo')) {
                            $logo_file = $request->file('logo');
                            $logo_filename = "teamlogo".time().'.'.$logo_file->getClientOriginalExtension();
                            $logo_file->storeAs('public/images/team_logo/' , $logo_filename);
                            $input['logo'] = $logo_filename;
                    }

                $team = Team::create($input);
                if($team){
                    return redirect()->route('admin/team')->with('message_success', 'Team created successfully');
                }

            }


        // }catch(\Exception $e){
        //     $e->getMessage();
        // }
    }
    public function edit($id){
        $get_regions = Region::where('status' , 'active')->get();
        $team = Team::find($id);
        // dd($team);
        return view('backend.team.edit', compact('team' , 'get_regions'));
    }

    public function update(Request $request, $id){
        try{
            $team = Team::find($id);
            $input = $request->all();
            //    if($request->hasfile('logo')){
            //       $logo =  fileLoad($request->logo);
            //       $input['logo'] = $logo;
            //    }
               if ($request->hasFile('logo')) {
                    $logo_file = $request->file('logo');
                    $logo_filename = "teamlogo".time().'.'.$logo_file->getClientOriginalExtension();
                    $logo_file->storeAs('public/images/team_logo/' , $logo_filename);
                    $input['logo'] = $logo_filename;
                }



               else{
                $input['logo'] = $team->logo;
               }
            $team->update($input);
            if($team){
                return redirect()->route('admin/team')->with('message_success', 'Team created successfully');
            }

            }catch(\Exception $e){
                $e->getMessage();
            }
    }

    public function delete($id){
       $team =  Team::find($id)->delete();
       if($team){
        return redirect()->route('admin/team')->with('message_success', 'Team deleted successfully');
       }else{
        return redirect()->route('admin/team')->with('message_error', 'Something went wrong');
       }
    }
}
