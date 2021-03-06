<?php 
if (!class_exists('MSDLocationCPT')) {
	class MSDLocationCPT {
		//Properties
		var $cpt = 'location';
		//Methods
	    /**
	    * PHP 4 Compatible Constructor
	    */
		public function MSDLocationCPT(){$this->__construct();}
	
		/**
		 * PHP 5 Constructor
		 */
		function __construct(){
			global $current_screen;
        	//"Constants" setup
        	$this->plugin_url = plugin_dir_url('msd-custom-cpt/msd-custom-cpt.php');
        	$this->plugin_path = plugin_dir_path('msd-custom-cpt/msd-custom-cpt.php');
			//Actions
			add_action( 'init', array(&$this,'register_cpt_location') );
			add_action('admin_head', array(&$this,'plugin_header'));
			add_action('admin_print_scripts', array(&$this,'add_admin_scripts') );
			add_action('admin_print_styles', array(&$this,'add_admin_styles') );
			add_action('admin_footer',array(&$this,'info_footer_hook') );
			// important: note the priority of 99, the js needs to be placed after tinymce loads
			add_action('admin_print_footer_scripts',array(&$this,'print_footer_scripts'),99);
			
			//Filters
			add_filter( 'pre_get_posts', array(&$this,'custom_query') );
			add_filter( 'enter_title_here', array(&$this,'change_default_title') );
            
            add_shortcode('location_section',array(&$this,'homepage_location_output'));
		}
		
		function register_cpt_location() {
		
		    $labels = array( 
		        'name' => _x( 'Locations', 'location' ),
		        'singular_name' => _x( 'Location', 'location' ),
		        'add_new' => _x( 'Add New', 'location' ),
		        'add_new_item' => _x( 'Add New Location', 'location' ),
		        'edit_item' => _x( 'Edit Location', 'location' ),
		        'new_item' => _x( 'New Location', 'location' ),
		        'view_item' => _x( 'View Location', 'location' ),
		        'search_items' => _x( 'Search Location', 'location' ),
		        'not_found' => _x( 'No location found', 'location' ),
		        'not_found_in_trash' => _x( 'No location found in Trash', 'location' ),
		        'parent_item_colon' => _x( 'Parent Location:', 'location' ),
		        'menu_name' => _x( 'Location', 'location' ),
		    );
		
		    $args = array( 
		        'labels' => $labels,
		        'hierarchical' => false,
		        'description' => 'Location',
		        'supports' => array( 'title', 'editor', 'author', 'thumbnail' ,'genesis-cpt-archives-settings'),
		        'taxonomies' => array(),
		        'public' => true,
		        'show_ui' => true,
		        'show_in_menu' => true,
		        'menu_position' => 20,
		        
		        'show_in_nav_menus' => true,
		        'publicly_queryable' => true,
		        'exclude_from_search' => true,
		        'has_archive' => true,
		        'query_var' => true,
		        'can_export' => true,
		        'rewrite' => array('slug'=>'location','with_front'=>false),
		        'capability_type' => 'post'
		    );
		
		    register_post_type( $this->cpt, $args );
		}
		
		function plugin_header() {
			global $post_type;
			?>
		    <?php
		}
		 
		function add_admin_scripts() {
			global $current_screen;
			if($current_screen->post_type == $this->cpt){
				wp_enqueue_script('media-upload');
				wp_enqueue_script('thickbox');
				wp_register_script('my-upload', plugin_dir_url(dirname(__FILE__)).'/js/msd-upload-file.js', array('jquery','media-upload','thickbox'),FALSE,TRUE);
				wp_enqueue_script('my-upload');
			}
		}
		
		function add_admin_styles() {
			global $current_screen;
			if($current_screen->post_type == $this->cpt){
				wp_enqueue_style('thickbox');
				wp_enqueue_style('custom_meta_css',plugin_dir_url(dirname(__FILE__)).'/css/meta.css');
			}
		}	
			
		function print_footer_scripts()
		{
			global $current_screen;
			if($current_screen->post_type == $this->cpt){
				print '<script type="text/javascript">/* <![CDATA[ */
					jQuery(function($)
					{
						var i=1;
						$(\'.customEditor textarea\').each(function(e)
						{
							var id = $(this).attr(\'id\');
			 
							if (!id)
							{
								id = \'customEditor-\' + i++;
								$(this).attr(\'id\',id);
							}
			 
							tinyMCE.execCommand(\'mceAddControl\', false, id);
			 
						});
					});
				/* ]]> */</script>';
			}
		}
		function change_default_title( $title ){
			global $current_screen;
			if  ( $current_screen->post_type == $this->cpt ) {
				return __('Location Name','location');
			} else {
				return $title;
			}
		}
		
		function info_footer_hook()
		{
			global $current_screen;
			if($current_screen->post_type == $this->cpt){
				?><script type="text/javascript">
						jQuery('#postdivrich').before(jQuery('#_contact_info_metabox'));
					</script><?php
			}
		}
		
        function homepage_location_output($atts){
           extract( shortcode_atts( array(), $atts ) );
           global $location_info;
            $args = array(
                'posts_per_page' => -1,
                'post_type' => $this->cpt,
            );
            $locations = get_posts($args);
            $i = 0;
            $ret = '<locations id="locations_popovers">';
            foreach($locations AS $location){
                $location_info->the_meta($location->ID);
                $locations[$i]->homepage_map_position = $location_info->get_the_value('homepage_map_position');
                $locations[$i]->title = $location->post_title;
                $ret .= '
                <a href="#" id="'.sanitize_title_for_query($location->post_title).'_popover" class="map-marker" data-container="body" data-toggle="popover" data-placement="top" data-content="'.$location->post_title.'">
  '.$location->post_title.'
</a>';
                $i++;
            }
            $ret .= '</locations>
<div id="the-hand" class="the-hand">
<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3089.450363011913!2d-84.452986!3d39.255347!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x23eba871ce630456!2sAD-EX+International!5e0!3m2!1sen!2sus!4v1421896457550" frameborder="0" style="border:0"></iframe>
</div>';
           return $ret;
        }

    function custom_query( $query ) {
            if(!is_admin()){
                $post_types = get_post_types();
                if($query->is_main_query() && $query->is_search){
                    $searchterm = $query->query_vars['s'];
                    // we have to remove the "s" parameter from the query, because it will prevent the posts from being found
                    $query->query_vars['s'] = "";
                    
                    if ($searchterm != "") {
                        $query->set('meta_value',$searchterm);
                        $query->set('meta_compare','LIKE');
                    };

                    $post_types[] = $this->cpt;
                    $query->set( 'post_type', $post_types );
                    //ts_data($query);
                }
                elseif( $query->is_main_query() && $query->is_archive ) {
                    $post_types[] = $this->cpt;
                    $query->set( 'post_type', $post_types );
                }
            }
        } 		
  } //End Class
} //End if class exists statement