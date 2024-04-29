<?php 
/**
	 * Reset all settings
	 */
	// Reset settings section
	$wp_customize->add_section(
		'ideal_blog_reset_sections',
		array(
			'title' => esc_html__( 'Reset all', 'ideal-blog' ),
			'description' => esc_html__( 'Reset all settings to default.', 'ideal-blog' ),
			'panel' => 'ideal_blog_general_panel',
		)
	);

	// Reset sortable order setting
	$wp_customize->add_setting(
		'ideal_blog_reset_settings',
		array(
			'sanitize_callback' => 'ideal_blog_sanitize_checkbox',
			'default' => false,
			'transport'	=> 'postMessage',
		)
	);

	$wp_customize->add_control(
		'ideal_blog_reset_settings',
		array(
			'section'		=> 'ideal_blog_reset_sections',
			'label'			=> esc_html__( 'Reset all settings?', 'ideal-blog' ),
			'type'			=> 'checkbox',
		)
	);
 ?>