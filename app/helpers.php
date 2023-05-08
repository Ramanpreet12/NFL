<?php
if (!function_exists('get_main_menus')) {
    function get_main_menus($id){
        $menuData = Illuminate\Support\Facades\DB::table('menus')->where('parent_id' , '=' , $id)->count();
        if($menuData > 0){
            return "dropdown-toggle";
        }
        else{
            return "";
        }
    }
}

if (!function_exists('get_main_submenus')) {
    function get_main_submenus($id){
        $menuData = Illuminate\Support\Facades\DB::table('menus')->where('parent_id' , '=' , $id)->count();
        if($menuData > 0){
            return "dropdown";
        }
        else{
            return "";
        }
    }
}

if (!function_exists('general_images')) {
     function general_images($img_file)
    {
        if ($img_file) {
            if(is_file($img_file)){
                $filename = rand('111' , '9999').'.'.$img_file->getClientOriginalExtension();
                $img_file->storeAs('public/images/general/' , $filename);
                return $filename;
            }else{
                return false;
            }
        }

    }
}
if (!function_exists('update_userPoints')) {
    function update_userPoints($team_id,$season_id){

            $user = Illuminate\Support\Facades\DB::table('users')->where(['team_id'=>$team_id,'season_id'=>$season_id])->get();
           foreach($user as $u){
            $points = Illuminate\Support\Facades\DB::table('user_details')->where(['user_id'=>$u->id,'season_id'=>$season_id])->value('points');
            if($points != '' && $points != NULL){
                $final = (int)$points+1;
            }else{
                $final = 1;
            }
            $d =Illuminate\Support\Facades\DB::table('user_details')->where(['user_id'=>$u->id, 'season_id'=>$season_id])->update(['points'=>$final]);

           }

    }
}
