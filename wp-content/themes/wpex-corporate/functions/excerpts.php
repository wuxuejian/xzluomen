<?php
/**
 * This file is used for all excerpt related functions
 *
 * @package WordPress
 * @subpackage Corporate WPExplorer Theme
 * @since Corporate 1.0
*/


/**
 * Custom excerpts based on wp_trim_words
 * Created for child-theming purposes
 * 
 * Learn more at http://codex.wordpress.org/Function_Reference/wp_trim_words
 *
 * @since Corporate 1.0
*/
if ( !function_exists( 'wpex_excerpt' ) ) {
	function wpex_excerpt($length=30, $readmore=false ) {
		global $post;
		$id = $post->ID;
		if ( has_excerpt( $id ) ) {
			$output = $post->post_excerpt;
		} else {
			if ($pos=strpos($post->post_content, '<!--more-->')) {
				$wpex_more_tag = apply_filters( 'wpex_more_tag', null );
				$output = get_the_content( $wpex_more_tag );
			} else {
				$output = wp_trim_words( strip_shortcodes( get_the_content( $id ) ), $length);
				if ( $readmore == true ) {
					$readmore_link = '<span class="wpex-readmore"><a href="'. get_permalink( $id ) .'" title="'. __('continue reading', 'wpex' ) .'" rel="bookmark">'. __('continue reading', 'wpex' ) .' &rarr;</a></span>';
					$output .= apply_filters( 'wpex_readmore_link', $readmore_link );
				}
			}
		}
		echo $output;
	}
}


/**
 * Change default excerpt read more style
 * @since Corporate 1.0
*/
if ( !function_exists( 'wpex_excerpt_more' ) ) :
	function wpex_excerpt_more($more) {
		global $post;
		return '...';
	}
	add_filter( 'excerpt_more', 'wpex_excerpt_more' );
endif;