<?php
/**
 * The template for the sidebar containing the main widget area
 *
 * @package MediaSmack
 * @subpackage Tommy James
 * @since 1.0
 * @version 1.0
 */
?>

<?php if ( is_active_sidebar( 'shop' )  ) : ?>
	<div class="shop-sidebar-area">
		<?php dynamic_sidebar( 'shop' ); ?>
	</div>	
<?php endif; ?>
