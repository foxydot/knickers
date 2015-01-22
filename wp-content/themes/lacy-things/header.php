<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?><!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged, $msd_social;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'twentyeleven' ), max( $paged, $page ) );

	?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<?php
	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
?>

</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed">
	<header id="branding" role="banner">
    	<div class="container">
				<h1 id="site-title"><span><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></span></h1>
				<h2 id="site-description"><?php bloginfo( 'description' ); ?></h2>
			<div class="search_sm">
            <?php print $msd_social->social_media(); ?>
			<?php
				// Has the text been hidden?
				if ( 'blank' == get_header_textcolor() ) :
			?>
				<div class="only-search<?php if ( $header_image ) : ?> with-image<?php endif; ?>">
				<?php get_product_search_form(); ?>
				</div>
			<?php
				else :
			?>
				<?php get_product_search_form(); ?>
			<?php endif; ?>
            </div>




			<nav id="access" role="navigation">
				<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
			</nav><!-- #access -->
       </div>
	</header><!-- #branding -->

	<div id="main">
		<div class="container">
    		 <?php 
		if(is_home() || is_front_page()){?>
	<div id="homebanner">
        	<?php 
        	ob_start();
        	echo do_shortcode('[SlideDeck2 id=1053]');
        	$slidedeck = ob_get_contents();
        	ob_end_clean();
        	if($slidedeck != ''){
        	    print '<div class="row home-widgets"><div class="col-sm-6 home-left home-top">';
        		print $slidedeck;
                ?>
                </div>
                    <div class="col-sm-6 home-right home-top">
                        <?php if(!dynamic_sidebar('home-top-left')): ?>
                            <a href="<?php print site_url('/shop'); ?>"><img src="<?php bloginfo('template_url'); ?>/images/shop-now.jpg" alt="shop-now" /></a>
                        <?php endif; ?>
                        <div class="widget">
                            <h3 class="widget-title">Something to <b>Tweet</b> About</h3>
                            <?php echo do_shortcode("[tweetomatic title='' show_timestamp='true' show_powered_by='false' count='3']"); ?>
                        </div>
                  </div>
              </div>
                <?php
        	}elseif(function_exists('wp_content_slider')) { wp_content_slider(); }  ?>
    </div>
    <?php } ?>       