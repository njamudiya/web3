<?php 
	/**
	 * General settings
	 */
	// General settings
	$wp_customize->add_section(
		'ideal_blog_general_section',
		array(
			'title' => esc_html__( 'General', 'ideal-blog' ),
			'panel' => 'ideal_blog_general_panel',
		)
	);
 

	// Breadcrumb enable setting
	$wp_customize->add_setting(
		'ideal_blog_breadcrumb_enable',
		array(
			'sanitize_callback' => 'ideal_blog_sanitize_checkbox',
			'default' => true,
		)
	);

	$wp_customize->add_control(
		'ideal_blog_breadcrumb_enable',
		array(
			'section'		=> 'ideal_blog_general_section',
			'label'			=> esc_html__( 'Enable breadcrumb.', 'ideal-blog' ),
			'type'			=> 'checkbox',
		)
	);


?>