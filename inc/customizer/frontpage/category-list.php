<?php
/**
	 * Category List section
	 */
	// Category List section
	$wp_customize->add_section(
		'ideal_blog_category_list',
		array(
			'title' => esc_html__( 'Category List', 'ideal-blog' ),
			'panel' => 'ideal_blog_home_panel',
		)
	);

	// Category List Section enable setting
	$wp_customize->add_setting(
		'ideal_blog_category_list_section_enable',
		array(
			'sanitize_callback' => 'ideal_blog_sanitize_checkbox',
			'default' => true,
		)
	);

	$wp_customize->add_control(
		'ideal_blog_category_list_section_enable',
		array(
			'section'		=> 'ideal_blog_category_list',
			'label'			=> esc_html__( 'Enable Category List Section.', 'ideal-blog' ),
			'type'			=> 'checkbox',
		)
	);
		
	// Category List Dot enable setting
	$wp_customize->add_setting(
		'ideal_blog_category_list_dot_enable',
		array(
			'sanitize_callback' => 'ideal_blog_sanitize_checkbox',
			'default' => true,
		)
	);

	$wp_customize->add_control(
		'ideal_blog_category_list_dot_enable',
		array(
			'section'		=> 'ideal_blog_category_list',
			'label'			=> esc_html__( 'Enable Category List Dot.', 'ideal-blog' ),
			'type'			=> 'checkbox',
			'active_callback' => 'ideal_blog_is_category_list_enable',
		)
	);
	// Category List Fade Effect enable setting
	$wp_customize->add_setting(
		'ideal_blog_category_list_fade_enable',
		array(
			'sanitize_callback' => 'ideal_blog_sanitize_checkbox',
			'default' => false,
		)
	);

	$wp_customize->add_control(
		'ideal_blog_category_list_fade_enable',
		array(
			'section'		=> 'ideal_blog_category_list',
			'label'			=> esc_html__( 'Enable Category List Fade Effect.', 'ideal-blog' ),
			'type'			=> 'checkbox',
			'active_callback' => 'ideal_blog_is_category_list_enable',
		)
	);
	// Category List Infinite Enable setting
	$wp_customize->add_setting(
		'ideal_blog_category_list_arrow_enable',
		array(
			'sanitize_callback' => 'ideal_blog_sanitize_checkbox',
			'default' => true,
		)
	);

	$wp_customize->add_control(
		'ideal_blog_category_list_arrow_enable',
		array(
			'section'		=> 'ideal_blog_category_list',
			'label'			=> esc_html__( 'Enable Category List Arrow.', 'ideal-blog' ),
			'type'			=> 'checkbox',
			'active_callback' => 'ideal_blog_is_category_list_enable',
		)
	);
	// Category List Autoplay enable setting
	$wp_customize->add_setting(
		'ideal_blog_category_list_autoplay_enable',
		array(
			'sanitize_callback' => 'ideal_blog_sanitize_checkbox',
			'default' => true,
		)
	);

	$wp_customize->add_control(
		'ideal_blog_category_list_autoplay_enable',
		array(
			'section'		=> 'ideal_blog_category_list',
			'label'			=> esc_html__( 'Enable Category List Autoplay.', 'ideal-blog' ),
			'type'			=> 'checkbox',
			'active_callback' => 'ideal_blog_is_category_list_enable',
		)
	);

	// Category List Infinite Enable setting
	$wp_customize->add_setting(
		'ideal_blog_category_list_infinite_enable',
		array(
			'sanitize_callback' => 'ideal_blog_sanitize_checkbox',
			'default' => true,
		)
	);

	$wp_customize->add_control(
		'ideal_blog_category_list_infinite_enable',
		array(
			'section'		=> 'ideal_blog_category_list',
			'label'			=> esc_html__( 'Enable Category List Infinite Slide.', 'ideal-blog' ),
			'type'			=> 'checkbox',
			'active_callback' => 'ideal_blog_is_category_list_enable',
		)
	);

	// Setting Multiple Category.
	$wp_customize->add_setting( 'category_list_cat',
		array(

		'sanitize_callback' => 'ideal_blog_sanitize_category_list',
		)
	);
	$wp_customize->add_control(
		new Ideal_Blog_Dropdown_Multiple_Chooser( $wp_customize, 'category_list_cat',
			array(
			'label'    => __( 'Select Categories', 'ideal-blog' ),
			'description' => __('Press Ctrl and select categories for multiple categories', 'ideal-blog'),
			'section'  => 'ideal_blog_category_list',
			'type'           	=> 'dropdown_multiple_chooser',
			'choices'  => ideal_blog_category_choices(),
			'active_callback' => 'ideal_blog_is_category_list_enable',		
			)
		)
	);
?>