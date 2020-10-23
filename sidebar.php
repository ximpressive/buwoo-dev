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

<?php if ( is_active_sidebar( 'sidebar-1' )  ) : ?>
	<div class="sidebar-area">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</div>	
<?php endif; ?>
