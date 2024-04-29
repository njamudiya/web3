<?php /**
	 * Single pages setting section 
	 */
	// Single pages setting section 
	$wp_customize->add_section(
		'ideal_blog_single_page_settings',
		array(
			'title' => esc_html__( 'Single Pages', 'ideal-blog' ),
			'description' => esc_html__( 'Settings for all single pages.', 'ideal-blog' ),
			'panel' => 'ideal_blog_general_panel',
		)
	);

	// Author enable setting
	$wp_customize->add_setting(
		'ideal_blog_enable_single_page_author',
		array(
			'sanitize_callback' => 'ideal_blog_sanitize_checkbox',
			'default' => false,
		)
	);

	$wp_customize->add_control(
		'ideal_blog_enable_single_page_author',
		array(
			'section'		=> 'ideal_blog_single_page_settings',
			'label'			=> esc_html__( 'Enable Page Author.', 'ideal-blog' ),
			'type'			=> 'checkbox',
		)
	);

	// Author enable setting
	$wp_customize->add_setting(
		'ideal_blog_enable_single_page_image',
		array(
			'sanitize_callback' => 'ideal_blog_sanitize_checkbox',
			'default' => true,
		)
	);

	$wp_customize->add_control(
		'ideal_blog_enable_single_page_image',
		array(
			'section'		=> 'ideal_blog_single_page_settings',
			'label'			=> esc_html__( 'Enable Page image.', 'ideal-blog' ),
			'type'			=> 'checkbox',
		)
	);

	// Pagination enable setting
	$wp_customize->add_setting(
		'ideal_blog_enable_single_page_pagination',
		array(
			'sanitize_callback' => 'ideal_blog_sanitize_checkbox',
			'default' => true,
		)
	);

	$wp_customize->add_control(
		'ideal_blog_enable_single_page_pagination',
		array(
			'section'		=> 'ideal_blog_single_page_settings',
			'label'			=> esc_html__( 'Enable pagination.', 'ideal-blog' ),
			'type'			=> 'checkbox',
		)
	);
?>