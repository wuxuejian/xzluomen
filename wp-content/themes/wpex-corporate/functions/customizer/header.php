<?php
/**
 * Header theme options
 *
 * @package		WordPress
 * @subpackage	Corporate WPExplorer Theme
 * @since		Corporate 1.0.0
 */

function wpex_customizer_general( $wp_customize ) {

	$wp_customize->add_section( 'wpex_header_section' , array(
		'title'		=> __( 'Header', 'wpex' ),
		'priority'	=> 200,
	) );

	$wp_customize->add_setting( 'wpex_logo', array(
		'type'	=> 'theme_mod'
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'wpex_logo', array(
		'label'		=> __('Image Logo','wpex'),
		'section'	=> 'wpex_header_section',
		'settings'	=> 'wpex_logo',
		'priority'	=> 1,
	) ) );

	$wp_customize->add_setting( 'wpex_header_search', array(
		'type'		=> 'theme_mod',
		'default'	=> true
	) );

	$wp_customize->add_control( 'wpex_header_search', array(
		'label'		=> __( 'Header Search', 'wpex' ),
		'section'	=> 'wpex_header_section',
		'settings'	=> 'wpex_header_search',
		'priority'	=> 2,
		'type'		=> 'checkbox',
	) );
		
}
add_action( 'customize_register', 'wpex_customizer_general' );