<?php 
/**
	 * Blog/Archive section 
	 */
	// Blog/Archive section 
	$wp_customize->add_section(
		'ideal_blog_archive_settings',
		array(
			'title' => esc_html__( 'Archive/Blog', 'ideal-blog' ),
			'description' => esc_html__( 'Settings for archive pages including blog page too.', 'ideal-blog' ),
			'panel' => 'ideal_blog_general_panel',
		)
	);

	// Global archive layout setting
	$wp_customize->add_setting(
		'ideal_blog_content_align',
		array(
			'sanitize_callback' => 'ideal_blog_sanitize_select',
			'default' => 'content-center',
		)
	);

	$wp_customize->add_control(
		'ideal_blog_content_align',
		array(
			'section'		=> 'ideal_blog_archive_settings',
			'label'			=> esc_html__( 'Content Position Align', 'ideal-blog' ),
			'type'			=> 'radio',
			'choices'		=> array( 
				'content-left' => esc_html__( 'Left', 'ideal-blog' ), 
				'content-center' => esc_html__( 'Center', 'ideal-blog' ), 
				'content-right' => esc_html__( 'Right', 'ideal-blog' ), 
				'content-justify' => esc_html__( 'Justify', 'ideal-blog' ),
			),
		)
	);

	// Global archive layout setting
	$wp_customize->add_setting(
		'ideal_blog_archive_content_type',
		array(
			'sanitize_callback' => 'ideal_blog_sanitize_select',
			'default' => 'excerpt',
		)
	);

	$wp_customize->add_control(
		'ideal_blog_archive_content_type',
		array(
			'section'		=> 'ideal_blog_archive_settings',
			'label'			=> esc_html__( 'Archive Content Type', 'ideal-blog' ),
			'type'			=> 'radio',
			'choices'		=> array( 
				'excerpt' => esc_html__( 'Excerpt Content', 'ideal-blog' ), 
				'full-content' => esc_html__( 'Full Content', 'ideal-blog' ), 
			),
		)
	);

	// Archive excerpt setting
	$wp_customize->add_setting(
		'ideal_blog_archive_excerpt',
		array(
			'sanitize_callback' => 'sanitize_text_field',
			'default' => esc_html__( 'View the post', 'ideal-blog' ),
		)
	);

	$wp_customize->add_control(
		'ideal_blog_archive_excerpt',
		array(
			'section'		=> 'ideal_blog_archive_settings',
			'label'			=> esc_html__( 'Excerpt more text:', 'ideal-blog' ),
		)
	);

	// Archive excerpt length setting
	$wp_customize->add_setting(
		'ideal_blog_archive_excerpt_length',
		array(
			'sanitize_callback' => 'ideal_blog_sanitize_number_range',
			'default' => 15,
		)
	);

	$wp_customize->add_control(
		'ideal_blog_archive_excerpt_length',
		array(
			'section'		=> 'ideal_blog_archive_settings',
			'label'			=> esc_html__( 'Excerpt more length:', 'ideal-blog' ),
			'type'			=> 'number',
			'input_attrs'   => array( 'min' => 5 ),
		)
	);

	// Category enable setting
	$wp_customize->add_setting(
		'ideal_blog_enable_archive_category',
		array(
			'sanitize_callback' => 'ideal_blog_sanitize_checkbox',
			'default' => true,
		)
	);

	$wp_customize->add_control(
		'ideal_blog_enable_archive_category',
		array(
			'section'		=> 'ideal_blog_archive_settings',
			'label'			=> esc_html__( 'Enable Category.', 'ideal-blog' ),
			'type'			=> 'checkbox',
		)
	);

	// Date enable setting
	$wp_customize->add_setting(
		'ideal_blog_enable_archive_date',
		array(
			'sanitize_callback' => 'ideal_blog_sanitize_checkbox',
			'default' => true,
		)
	);

	$wp_customize->add_control(
		'ideal_blog_enable_archive_date',
		array(
			'section'		=> 'ideal_blog_archive_settings',
			'label'			=> esc_html__( 'Enable Date.', 'ideal-blog' ),
			'type'			=> 'checkbox',
		)
	);

	// Featured image enable setting
	$wp_customize->add_setting(
		'ideal_blog_enable_archive_featured_img',
		array(
			'sanitize_callback' => 'ideal_blog_sanitize_checkbox',
			'default' => true,
		)
	);

	$wp_customize->add_control(
		'ideal_blog_enable_archive_featured_img',
		array(
			'section'		=> 'ideal_blog_archive_settings',
			'label'			=> esc_html__( 'Enable featured image.', 'ideal-blog' ),
			'type'			=> 'checkbox',
		)
	);

 ?>