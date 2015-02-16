<?php global $product; ?>
<li>
	<a href="<?php echo esc_url( get_permalink( $product->id ) ); ?>" title="<?php echo esc_attr( $product->get_title() ); ?>">
		<?php echo $product->get_image(); ?>
<<<<<<< HEAD
		<?php echo $product->get_title(); ?>
=======
		<span class="product-title"><?php echo $product->get_title(); ?></span>
>>>>>>> 5ec0834fd204a926bf216a4361cc6ea50af56fe1
	</a>
	<?php if ( ! empty( $show_rating ) ) echo $product->get_rating_html(); ?>
	<?php echo $product->get_price_html(); ?>
</li>