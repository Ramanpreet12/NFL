<?php
if (!function_exists('get_main_menus')) {
    function get_main_menus($id){
        $menuData = DB::table('menus')->where('parent_id' , '=' , $id)->count();
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
        $menuData = DB::table('menus')->where('parent_id' , '=' , $id)->count();
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

?>
