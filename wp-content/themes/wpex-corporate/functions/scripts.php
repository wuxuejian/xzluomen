<?php
/**
 * This file loads custom css and js for our theme
 *
 * @package		WordPress
 * @subpackage	Corporate WPExplorer Theme
 * @since		1.0.0
 */

if ( ! function_exists( 'wpex_load_scripts' ) ) {
	function wpex_load_scripts() {

		// CSS
		$css_dir = get_template_directory_uri() .'/css/';
		wp_enqueue_style( 'style', get_stylesheet_uri() );
		wp_enqueue_style( 'wpex-responsive', $css_dir .'responsive.css' );
		wp_enqueue_style( 'wpex-font-awesome', $css_dir .'font-awesome.min.css' );
		wp_enqueue_style( 'google-font-montserrat', 'http://fonts.googleapis.com/css?family=Montserrat:400,700', 'style' );

		if ( function_exists( 'wpcf7_enqueue_styles') ) {
			wp_dequeue_style( 'contact-form-7' );
		}

		// jQuery
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
		wp_enqueue_script( 'wpex-plugins', WPEX_JS_DIR_URI .'/plugins.js', array( 'jquery' ), '1.7.5', true );
		wp_enqueue_script( 'wpex-global', WPEX_JS_DIR_URI .'/global.js', array( 'jquery', 'wpex-plugins' ), '1.7.5', true );
		
	}
}
add_action( 'wp_enqueue_scripts','wpex_load_scripts' );