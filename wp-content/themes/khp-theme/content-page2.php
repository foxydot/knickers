<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<!--<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</header> .entry-header -->
	<?php 	if(is_home() || is_front_page()){?>
    	<div class="home_ads">
    	  <a href="shop-online/"><img src="<?php bloginfo('template_url'); ?>/images/shop-now.jpg" alt="shop-now" /></a>
        
        
        <div id="tweeter">
   			<div id="custom"></div> 
            <a href="https://twitter.com/KnickersofHP" target="_blank"><img src="<?php bloginfo('template_url'); ?>/images/twit-ico.jpg" alt="twit-ico" /></a>
            <a href="https://www.facebook.com/knickershp" target="_blank" class="fb_like"><img src="<?php bloginfo('template_url'); ?>/images/fb-like.jpg" alt="fb-like" /></a>

		</div>
        
    </div>

    	<div align="center">
        	<img src="<?php bloginfo('template_url'); ?>/images/divider.jpg" alt="divider" />
        </div>
    	<div class="home_left">
    	<?php the_content(); ?>
        </div>
        <div class="home_right">
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
            </div>
			<a target="_blank" href="http://visitor.r20.constantcontact.com/manage/optin/ea?v=001TqkDdJpTfnr8BNunitIGog%3D%3D" class="subscribe_newsletter"><img src="<?php bloginfo('template_url'); ?>/images/subscribe.jpg" alt="subscribe" /></a>
      
        
    <? }else{ ?>
<div class="entry-content">
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'twentyeleven' ) . '</span>', 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->
    <?php } ?>
	<footer class="entry-meta">
		<?php edit_post_link( __( 'Edit', 'twentyeleven' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->
</article><!-- #post-<?php the_ID(); ?> -->
