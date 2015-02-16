<?php
/**
 * HOMEPAGE
 */

get_header(); ?>
        <div id="primary">
            <div id="content" role="main">
               <?php remove_filter('widget_title','esc_html'); ?>
<<<<<<< HEAD
               <?php /*
=======
>>>>>>> ac88caf9f4ca63755d9ca84076d3897cbdde4feb
                <div class="row home-widgets">
                    <div class="col-sm-6 home-left home-top">
                        <?php if(!dynamic_sidebar('home-top-left')): ?>
                            <a href="<?php print site_url('/shop'); ?>"><img src="<?php bloginfo('template_url'); ?>/images/shop-now.jpg" alt="shop-now" /></a>
                        <?php endif; ?>
                    </div>
                    <div class="col-sm-6 home-right home-top">
                        <div class="widget">
                            <h3 class="widget-title">Something to <b>Tweet</b> About</h3>
                            <?php echo do_shortcode("[tweetomatic title='' show_timestamp='true' show_powered_by='false' count='3']"); ?>
                        </div>
                  </div>
                </div>        
<<<<<<< HEAD
                * 
                */ ?>
=======
>>>>>>> ac88caf9f4ca63755d9ca84076d3897cbdde4feb
                <img src="<?php bloginfo('template_url'); ?>/images/divider.jpg" alt="divider"  class="center" />
                <div class="row home-widgets">
                    <div class="col-sm-6 home-left home-bottom">
                        <?php while ( have_posts() ) : the_post(); ?>
                            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                <?php the_content(); ?>
                            </article><!-- #post-<?php the_ID(); ?> -->
                        <?php endwhile; // end of the loop. ?>
                    </div>
                    <div class="col-sm-6 home-right home-bottom">
                        <?php if(!dynamic_sidebar('home-btm-right')): ?>
                        <h2><img src="<?php bloginfo('template_url'); ?>/images/lates_post.jpg" alt="Latest Post From Blog" /></h2>
                         <?php
                                    $args = array(
                                        'srp_number_post_option'  => 1,
                                        'srp_filter_cat_option' => '4',
                                        'srp_thumbnail_option'    => 'no'
                                    );
            
                                if(function_exists('special_recent_posts')) {
                                    special_recent_posts($args);
                                 }?>
                        <?php endif; ?>
                    </div>
                </div>
            </div><!-- #content -->
        </div><!-- #primary -->

<?php get_footer(); ?>