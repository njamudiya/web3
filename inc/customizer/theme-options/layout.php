<?php 
/**
	 * Sidebar Layout
	 */
	// Sidebar Layout
	$wp_customize->add_section(
		'ideal_blog_global_layout',
		array(
			'title' => esc_html__( 'Global & Sidebar Layout', 'ideal-blog' ),
			'panel' => 'ideal_blog_general_panel',
		)
	);


	// Sidebar archive layout setting
	$wp_customize->add_setting(
		'ideal_blog_archive_sidebar',
		array(
			'sanitize_callback' => 'ideal_blog_sanitize_select',
			'default' => 'no',
		)
	);

	$wp_customize->add_control(
		'ideal_blog_archive_sidebar',
		array(
			'section'		=> 'ideal_blog_global_layout',
			'label'			=> esc_html__( 'Archive Sidebar', 'ideal-blog' ),
			'description'			=> esc_html__( 'This option works on all archive pages like: 404, search, date, category and so on.', 'ideal-blog' ),
			'type'			=> 'radio',
			'choices'		=> array( 
				
				'right' => esc_html__( 'Right', 'ideal-blog' ), 
				'no' => esc_html__( 'No Sidebar', 'ideal-blog' ), 
			),
		)
	);

	// Blog layout setting
	$wp_customize->add_setting(
		'ideal_blog_blog_sidebar',
		array(
			'sanitize_callback' => 'ideal_blog_sanitize_select',
			'default' => 'no',
		)
	);

	$wp_customize->add_control(
		'ideal_blog_blog_sidebar',
		array(
			'section'		=> 'ideal_blog_global_layout',
			'label'			=> esc_html__( 'Blog Sidebar', 'ideal-blog' ),
			'description'			=> esc_html__( 'This option works on blog and "Your latest posts"', 'ideal-blog' ),
			'type'			=> 'radio',
			'choices'		=> array( 
				
				'right' => esc_html__( 'Right', 'ideal-blog' ), 
				'no' => esc_html__( 'No Sidebar', 'ideal-blog' ), 
			),
		)
	);

	// Sidebar page layout setting
	$wp_customize->add_setting(
		'ideal_blog_global_page_layout',
		array(
			'sanitize_callback' => 'ideal_blog_sanitize_select',
			'default' => 'no',
		)
	);

	$wp_customize->add_control(
		'ideal_blog_global_page_layout',
		array(
			'section'		=> 'ideal_blog_global_layout',
			'label'			=> esc_html__( 'Sidebar page sidebar', 'ideal-blog' ),
			'description'			=> esc_html__( 'This option works only on single pages including "Posts page". This setting can be overridden for single page from the metabox too.', 'ideal-blog' ),
			'type'			=> 'radio',
			'choices'		=> array( 
				 
				'right' => esc_html__( 'Right', 'ideal-blog' ), 
				'no' => esc_html__( 'No Sidebar', 'ideal-blog' ), 
			),
		)
	);

	// Sidebar post layout setting
	$wp_customize->add_setting(
		'ideal_blog_global_post_layout',
		array(
			'sanitize_callback' => 'ideal_blog_sanitize_select',
			'default' => 'no',
		)
	);

	$wp_customize->add_control(
		'ideal_blog_global_post_layout',
		array(
			'section'		=> 'ideal_blog_global_layout',
			'label'			=> esc_html__( 'Sidebar post sidebar', 'ideal-blog' ),
			'description'			=> esc_html__( 'This option works only on single posts. This setting can be overridden for single post from the metabox too.', 'ideal-blog' ),
			'type'			=> 'radio',
			'choices'		=> array( 
				
				'right' => esc_html__( 'Right', 'ideal-blog' ), 
				'no' => esc_html__( 'No Sidebar', 'ideal-blog' ), 
			),
		)
	);
 ?>