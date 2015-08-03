<?php

function msdlab_ts_query($query){
    if($query->is_main_query())
    ts_data($query);
}
//add_action('pre_get_posts','msdlab_ts_query');
//add_filter( 'posts_request', 'dump_request' );

function dump_request( $input ) {

    var_dump($input);

    return $input;
}
add_action('genesis_footer','msdlab_show_actions');
function msdlab_show_actions(){
    global $wp_filter;
    //$tag = $_GET['tag'];
    //$tag = 'woocommerce_subcategory_count_html';
    if($tag){
        ts_var( $wp_filter[$tag] );
    }
    //ts_var($wp_filter['wp']);
} 

/*
* A useful troubleshooting function. Displays arrays in an easy to follow format in a textarea.
*/
if(!function_exists('ts_data')){
	function ts_data($data){
		$ret = '<textarea class="troubleshoot" rows="20" cols="100">';
		$ret .= print_r($data,true);
		$ret .= '</textarea>';
		print $ret;
	}
}
/*
* A useful troubleshooting function. Dumps variable info in an easy to follow format in a textarea.
*/
if(!function_exists('ts_var')){
	function ts_var($var){
		ts_data(var_export( $var , true ));
	}
}