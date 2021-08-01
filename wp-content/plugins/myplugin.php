<?php
/*
    Plugin Name: my plugin
    Description: new plugin
    Author: Nermeen

*/

add_action( 'the_title', 'title_capitalize');
function title_capitalize( $title ) {

    // Uppercases the entire title
    $title = ucwords( $title );
    return $title;
}
add_filter('the_title','title_capitalize');

//test



// add_action('the_content', 'rename_content');
// function rename_content($content){
//     $arr1 = [4, 10, 1, 5];
//     $arr2 = ["Four", "Ten", "One", "Five"];
//     return str_replace($arr1, $arr2 ,$content );
// }




?>