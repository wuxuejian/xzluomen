<?php
/**
 * Outputs the footer copyright info
 * @package WordPress
 * @subpackage Corporate WPExplorer Theme
 * @since Corporate 1.0
 */


if ( ! function_exists( 'wpex_copyright' ) ) {

	function wpex_copyright() {

		$copy = get_theme_mod('wpex_copyright', 'Corporate <a href="http://www.wordpress.org" title="WordPress" target="_blank">WordPress</a> Theme Designed &amp; Developed by <a href="http://themeforest.net/user/WPExplorer?ref=WPExplorer" target="_blank" title="WPExplorer">WPExplorer</a>' ); ?>

		<?php
		// Display custom copyright
		if ( $copy ) {
			echo do_shortcode( $copy ); ?>
		<?php
		// Copyright fallback
		} else { ?>
			&copy; <?php _e( 'Copyright', 'wpex' ); ?> <?php the_date( 'Y' ); ?> &middot; <a href="<?php echo home_url(); ?>" title="<?php bloginfo( 'name' ); ?>"><?php bloginfo( 'name' ); ?></a>
		<?php } ?>

		<?php

	} // end wpex_copyright

} // end function_exists 