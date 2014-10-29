<?php
function msdlab_excerpt($content){
    global $post;
    return msdlab_get_excerpt($post->ID);
}

function msdlab_get_excerpt( $post_id, $excerpt_length = 50, $trailing_character = '&nbsp;<i class="fa fa-arrow-circle-right"></i>' ) {
    $the_post = get_post( $post_id );
    $the_excerpt = strip_tags( strip_shortcodes( $the_post->post_excerpt ) );
     
    if ( empty( $the_excerpt ) )
        $the_excerpt = strip_tags( strip_shortcodes( $the_post->post_content ) );
     
    $words = explode( ' ', $the_excerpt, $excerpt_length + 1 );
     
    if( count( $words ) > $excerpt_length )
        $words = array_slice( $words, 0, $excerpt_length );
     
    $the_excerpt = implode( ' ', $words ) . '<a href="'.get_permalink($post_id).'">'.$trailing_character.'</a>';
    return $the_excerpt;
}

// cleanup tinymce for SEO
function fb_change_mce_buttons( $initArray ) {
	//@see http://wiki.moxiecode.com/index.php/TinyMCE:Control_reference
	$initArray['theme_advanced_blockformats'] = 'p,address,pre,code,h3,h4,h5,h6';
	$initArray['theme_advanced_disable'] = 'forecolor';

	return $initArray;
}
//add_filter('tiny_mce_before_init', 'fb_change_mce_buttons');
	
// add classes for various browsers
add_filter('body_class','browser_body_class');
function browser_body_class($classes) {
    global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;
 
    if($is_lynx) $classes[] = 'lynx';
    elseif($is_gecko) $classes[] = 'gecko';
    elseif($is_opera) $classes[] = 'opera';
    elseif($is_NS4) $classes[] = 'ns4';
    elseif($is_safari) $classes[] = 'safari';
    elseif($is_chrome) $classes[] = 'chrome';
    elseif($is_IE) $classes[] = 'ie';
    else $classes[] = 'unknown';
 
    if($is_iphone) $classes[] = 'iphone';
    return $classes;
}

add_filter('body_class','pagename_body_class');
function pagename_body_class($classes) {
	global $post;
	if(is_page()){
		$classes[] = $post->post_name;
	}
	return $classes;
}

add_filter('body_class','section_body_class');
function section_body_class($classes) {
	global $post;
	$post_data = get_post(get_topmost_parent($post->ID));
	$classes[] = 'section-'.$post_data->post_name;
	return $classes;
}
add_filter('body_class','category_body_class');
function category_body_class($classes) {
    global $post;
	$post_categories = wp_get_post_categories( $post->ID );
	foreach($post_categories as $c){
		$cat = get_category( $c );
		$classes[] = 'category-'.$cat->slug;
	}
    return $classes;
}

// add classes for subdomain
if(is_multisite()){
	add_filter('body_class','subdomain_body_class');
	function subdomain_body_class($classes) {
		global $subdomain;
		$site = get_current_site()->domain;
		$url = get_bloginfo('url');
		$sub = preg_replace('@http://@i','',$url);
		$sub = preg_replace('@'.$site.'@i','',$sub);
		$sub = preg_replace('@\.@i','',$sub);
		$classes[] = 'site-'.$sub;
		$subdomain = $sub;
		return $classes;
	}
}

add_action('template_redirect','set_section');
function set_section(){
	global $post, $section;
	$section = get_section();
}

function get_section(){
    global $post;
    $post_data = get_post(get_topmost_parent($post->ID));
    $section = $post_data->post_name;
    return $section;
}

function get_topmost_parent($post_id){
	$parent_id = get_post($post_id)->post_parent;
	if($parent_id == 0){
		$parent_id = $post_id;
	}else{
		$parent_id = get_topmost_parent($parent_id);
	}
	return $parent_id;
}
//add_filter( 'the_content', 'msd_remove_msword_formatting' );
function msd_remove_msword_formatting($content){
	global $allowedposttags;
    $allowedposttags["input"] = array(
            "name" => array(),
            "id" => array(),
            "type" => array(),
            "size" => array(),
            "style" => array(),
            "class" => array(),
    );
	$allowedposttags['span']['style'] = false;
	$content = wp_kses($content,$allowedposttags);
	return $content;
}
//add_action('init','msd_allow_all_embeds');
function msd_allow_all_embeds(){
	global $allowedposttags;
	$allowedposttags["iframe"] = array(
			"src" => array(),
			"height" => array(),
			"width" => array()
	);
	$allowedposttags["object"] = array(
			"height" => array(),
			"width" => array()
	);

	$allowedposttags["param"] = array(
			"name" => array(),
			"value" => array()
	);

	$allowedposttags["embed"] = array(
			"src" => array(),
			"type" => array(),
			"allowfullscreen" => array(),
			"allowscriptaccess" => array(),
			"height" => array(),
			"width" => array()
	);
}

/* ---------------------------------------------------------------------- */
/* Check the current post for the existence of a short code
/* ---------------------------------------------------------------------- */

if ( !function_exists('msdlab_has_shortcode') ) {

    function msdlab_has_shortcode($shortcode = '') {
    
        global $post;
        $post_obj = get_post( $post->ID );
        $found = false;
        
        if ( !$shortcode )
            return $found;
        if ( stripos( $post_obj->post_content, '[' . $shortcode ) !== false )
            $found = true;
        
        // return our results
        return $found;
    
    }
}

/**
 * Check if a post is a particular post type.
 */
if(!function_exists('is_cpt')){
	function is_cpt($cpt){
		global $post;
		$ret = get_post_type( $post ) == $cpt?TRUE:FALSE;
		return $ret;
	}
}

function remove_wpautop( $content ) { 
    $content = do_shortcode( shortcode_unautop( $content ) ); 
    $content = preg_replace( '#^<\/p>|^<br \/>|<p>$#', '', $content );
    return $content;
}

/*** SITEMAP ***/
/**
 * Retrieve or display list of pages in list (li) format.
 *
 * @since 1.5.0
 *
 * @param array|string $args Optional. Override default arguments.
 * @return string HTML content, if not displaying.
 */
function msdlab_list_pages_for_sitemap($args = '') {
    $defaults = array(
        'depth' => 0, 'show_date' => '',
        'date_format' => get_option('date_format'),
        'child_of' => 0, 'exclude' => '',
        'title_li' => __('Pages'), 'echo' => 1,
        'authors' => '', 'sort_column' => 'menu_order, post_title',
        'link_before' => '', 'link_after' => '', 'walker' => '',
    );

    $r = wp_parse_args( $args, $defaults );
    extract( $r, EXTR_SKIP );

    $output = '';
    $current_page = 0;
    
    /*$r['meta_query'] = array(
        array(
            'key'     => '_yoast_wpseo_meta-robots-noindex',
            'value'   => 1,
            'compare' => '!=',
        ),
    );*/

    // sanitize, mostly to keep spaces out
    $r['exclude'] = preg_replace('/[^0-9,]/', '', $r['exclude']);

    // Allow plugins to filter an array of excluded pages (but don't put a nullstring into the array)
    $exclude_array = ( $r['exclude'] ) ? explode(',', $r['exclude']) : array();
    $r['exclude'] = implode( ',', apply_filters('wp_list_pages_excludes', $exclude_array) );

    // Query pages.
    $r['hierarchical'] = 0;
    $pages = get_pages($r);
    if ( !empty($pages) ) {
        if ( $r['title_li'] )
            $output .= '<li class="pagenav">' . $r['title_li'] . '<ul>';

        global $wp_query;
        if ( is_page() || is_attachment() || $wp_query->is_posts_page )
            $current_page = $wp_query->get_queried_object_id();
        $output .= msdlab_walk_page_tree($pages, $r['depth'], $current_page, $r);

        if ( $r['title_li'] )
            $output .= '</ul></li>';
    }

    $output = apply_filters('wp_list_pages', $output, $r);

    if ( $r['echo'] )
        echo $output;
    else
        return $output;
}

function msdlab_walk_page_tree($pages, $depth, $current_page, $r) {
    if ( empty($r['walker']) )
        $walker = new Walker_Page;
    else
        $walker = $r['walker'];

    foreach ( (array) $pages as $k=>$page ) {
        if($x = get_metadata('post',$page->ID,'_yoast_wpseo_meta-robots-noindex')){
            if($x = 1){
                unset($pages[$k]);
                continue;
            }
        }
        if ( $page->post_parent )
            $r['pages_with_children'][ $page->post_parent ] = true;
    }

    $args = array($pages, $depth, $r, $current_page);
    return call_user_func_array(array($walker, 'walk'), $args);
}

function msdlab_sitemap(){
    $col1 = '
            <h4>'. __( 'Pages:', 'genesis' ) .'</h4>
            <ul>
                '. msdlab_list_pages_for_sitemap( 'echo=0&title_li=' ) .'
            </ul>
            ';
            
    $col2 = '
            <h4>'. __( 'Product Categories:', 'genesis' ) .'</h4>
            <ul>
                '. wp_list_categories( 'taxonomy=product_cat&echo=0&sort_column=name&title_li=' ) .'
            </ul>
            ';



    $col3 = '<h4>'. __( 'Recent News:', 'genesis' ) .'</h4>
            <ul>
                '. wp_get_archives( 'echo=0&type=postbypost&limit=15' ) .'
            </ul>
            ';
    $ret = '<div class="row">
       <div class="col-md-4 col-sm-12">'.$col1.'</div>
       <div class="col-md-4 col-sm-12">'.$col2.'</div>
       <div class="col-md-4 col-sm-12">'.$col3.'</div>
    </div>';
    print $ret;
} 