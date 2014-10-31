<?php
/**
 * Staff theme options
 * @package WordPress
 * @subpackage Corporate WPExplorer Theme
 * @since Corporate 1.0
 */



add_action( 'customize_register', 'wpex_customizer_staff' );

function wpex_customizer_staff($wp_customize) {

	// Staff Section
	$wp_customize->add_section( 'wpex_staff' , array(
		'title'		=> __( 'Staff', 'wpex' ),
		'priority'	=> 202,
	) );
	
	// Enable/Disable Staff
	$wp_customize->add_setting( 'wpex_staff', array(
		'type'		=> 'theme_mod',
		'default'	=> '1'
	) );

	$wp_customize->add_control( 'wpex_staff', array(
		'label'		=> __('Staff Post Type','wpex'),
		'section'	=> 'wpex_staff',
		'settings'	=> 'wpex_staff',
		'type'		=> 'checkbox',
		'priority'	=> '1',
	) );

	// Enable/Disable Staff Comments
	$wp_customize->add_setting( 'wpex_staff_comments', array(
		'type'		=> 'theme_mod',
		'default'	=> ''
	) );

	$wp_customize->add_control( 'wpex_staff_comments', array(
		'label'		=> __('Staff Comments','wpex'),
		'section'	=> 'wpex_staff',
		'settings'	=> 'wpex_staff_comments',
		'type'		=> 'checkbox',
		'priority'	=> '1',
	) );

	// Posts Per Page - Archive
	$wp_customize->add_setting( 'wpex_staff_posts_per_page', array(
		'type'		=> 'theme_mod',
		'default'	=> '9',
	) );
	
	$wp_customize->add_control( 'wpex_staff_posts_per_page', array(
		'label'		=> __('Archive Posts Per Page','wpex'),
		'section'	=> 'wpex_staff',
		'settings'	=> 'wpex_staff_posts_per_page',
		'type'		=> 'text',
		'priority'	=> '2',
	) );

}