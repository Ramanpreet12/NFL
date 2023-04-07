<?php
function get_menus($id){
    $menuData = DB::table('menus')
                ->where('parent_id' , '=' , $id)->count();
    if($menuData > 0){
        return "dropdown-toggle";

    }
    else{
        return "";
    }
}

function get_menus_bar($id){
    $menuData = DB::table('menus')
                ->where('parent_id' , '=' , $id)->count();
    if($menuData > 0){
        return "dropdown";

    }
    else{
        return "";
    }
}

?>
