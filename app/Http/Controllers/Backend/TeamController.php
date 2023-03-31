<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Team;
use App\Http\Requests\TeamValidation;

class TeamController extends Controller
{
    public function index(){        
        return view('backend.team.index');
    }

    public function getAll(){
        $team = Team::paginate(6);
        return response()->json($team, 200); 
    }

    public function add(){
        return view('backend.team.create');
    }
    public function create(TeamValidation $request){
        try{
        $input = $request->all();
           if($request->hasfile('logo')){
              $logo =  fileLoad($request->logo);
              $input['logo'] = $logo;
           }
        $team = Team::create($input);
        if($team){
            return redirect()->route('admin/team')->with('message_success', 'Team created successfully');
        }

        }catch(\Exception $e){
            $e->getMessage();
        }
    }
    public function edit($id){
        $team = Team::find($id);
        return view('backend.team.edit', compact('team'));
    }  
    
    public function update(Request $request, $id){
        try{
            $team = Team::find($id);
            $input = $request->all();
               if($request->hasfile('logo')){
                  $logo =  fileLoad($request->logo);
                  $input['logo'] = $logo;
               }else{
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
