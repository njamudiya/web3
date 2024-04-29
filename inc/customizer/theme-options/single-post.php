<?php 
	/**
	 * Single setting section 
	 */
	// Single setting section 
	$wp_customize->add_section(
		'ideal_blog_single_settings',
		array(
			'title' => esc_html__( 'Single Posts', 'ideal-blog' ),
			'description' => esc_html__( 'Settings for all single posts.', 'ideal-blog' ),
			'panel' => 'ideal_blog_general_panel',
		)
	);

	// Category enable setting
	$wp_customize->add_setting(
		'ideal_blog_enable_single_image',
		array(
			'sanitize_callback' => 'ideal_blog_sanitize_checkbox',
			'default' => true,
		)
	);

	$wp_customize->add_control(
		'ideal_blog_enable_single_image',
		array(
			'section'		=> 'ideal_blog_single_settings',
			'label'			=> esc_html__( 'Enable Featured Image.', 'ideal-blog' ),
			'type'			=> 'checkbox',
		)
	);

	// Category enable setting
	$wp_customize->add_setting(
		'ideal_blog_enable_single_category',
		array(
			'sanitize_callback' => 'ideal_blog_sanitize_checkbox',
			'default' => true,
		)
	);

	$wp_customize->add_control(
		'ideal_blog_enable_single_category',
		array(
			'section'		=> 'ideal_blog_single_settings',
			'label'			=> esc_html__( 'Enable categories.', 'ideal-blog' ),
			'type'			=> 'checkbox',
		)
	);

	// Date enable setting
	$wp_customize->add_setting(
		'ideal_blog_enable_single_date',
		array(
			'sanitize_callback' => 'ideal_blog_sanitize_checkbox',
			'default' => true,
		)
	);

	$wp_customize->add_control(
		'ideal_blog_enable_single_date',
		array(
			'section'		=> 'ideal_blog_single_settings',
			'label'			=> esc_html__( 'Enable Date.', 'ideal-blog' ),
			'type'			=> 'checkbox',
		)
	);


	// Author enable setting
	$wp_customize->add_setting(
		'ideal_blog_enable_single_author',
		array(
			'sanitize_callback' => 'ideal_blog_sanitize_checkbox',
			'default' => true,
		)
	);

	$wp_customize->add_control(
		'ideal_blog_enable_single_author',
		array(
			'section'		=> 'ideal_blog_single_settings',
			'label'			=> esc_html__( 'Enable Author.', 'ideal-blog' ),
			'type'			=> 'checkbox',
		)
	);

	// Comment enable setting
	$wp_customize->add_setting(
		'ideal_blog_enable_single_comment',
		array(
			'sanitize_callback' => 'ideal_blog_sanitize_checkbox',
			'default' => true,
		)
	);

	$wp_customize->add_control(
		'ideal_blog_enable_single_comment',
		array(
			'section'		=> 'ideal_blog_single_settings',
			'label'			=> esc_html__( 'Enable Comment.', 'ideal-blog' ),
			'type'			=> 'checkbox',
		)
	);

	// Tag enable setting
	$wp_customize->add_setting(
		'ideal_blog_enable_single_tag',
		array(
			'sanitize_callback' => 'ideal_blog_sanitize_checkbox',
			'default' => true,
		)
	);

	$wp_customize->add_control(
		'ideal_blog_enable_single_tag',
		array(
			'section'		=> 'ideal_blog_single_settings',
			'label'			=> esc_html__( 'Enable tags.', 'ideal-blog' ),
			'type'			=> 'checkbox',
		)
	);

	// Pagination enable setting
	$wp_customize->add_setting(
		'ideal_blog_enable_single_pagination',
		array(
			'sanitize_callback' => 'ideal_blog_sanitize_checkbox',
			'default' => true,
		)
	);

	$wp_customize->add_control(
		'ideal_blog_enable_single_pagination',
		array(
			'section'		=> 'ideal_blog_single_settings',
			'label'			=> esc_html__( 'Enable pagination.', 'ideal-blog' ),
			'type'			=> 'checkbox',
		)
	);
?>