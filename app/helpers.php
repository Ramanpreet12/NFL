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
    function update_userPoints($team_id,$season_id , $week){
        $points = Illuminate\Support\Facades\DB::table('user_teams')->where(['week'=>$week,'season_id'=>$season_id , 'team_id' => $team_id])->value('points');
        if($points != '' && $points != NULL){
            $final = (int)$points+1;
        }else if($points == 0){
            $final = (int)$points+1;
        }else{
            $final =1;
        }
        Illuminate\Support\Facades\DB::table('user_teams')->where(['week'=>$week, 'season_id'=>$season_id, 'team_id' => $team_id])->update(['points'=>$final]);
    }
}
if (!function_exists('isSelected')) {
    function isSelected($season=null, $week=null, $team=null)
    {
       if(($season && $week && $team) != null){
         $selected = Illuminate\Support\Facades\DB::table('user_teams')->where(['user_id'=>auth()->user()->id,'season_id'=>$season,'week'=>$week,'team_id'=>$team])->first();
         if($selected){
            return true;
         }else{
            return false;
         }
       }
    }
}
if (!function_exists('get_team_name')) {
    function get_team_name($team=null)
    {
       if($team != null){
         $selected = Illuminate\Support\Facades\DB::table('teams')->where('id',$team)->first();
         if($selected){
           return $selected->name;
         }else{
            return '';
         }
       }
    }
}

