<?php
/**
	 * Trending section
	 */
	// Trending section
	$wp_customize->add_section(
		'ideal_blog_trending',
		array(
			'title' => esc_html__( 'Trending Section', 'ideal-blog' ),
			'panel' => 'ideal_blog_home_panel',
		)
	);

	// Trending Section enable setting
	$wp_customize->add_setting(
		'ideal_blog_trending_section_enable',
		array(
			'sanitize_callback' => 'ideal_blog_sanitize_checkbox',
			'default' => true,
		)
	);

	$wp_customize->add_control(
		'ideal_blog_trending_section_enable',
		array(
			'section'		=> 'ideal_blog_trending',
			'label'			=> esc_html__( 'Enable Trending Section.', 'ideal-blog' ),
			'type'			=> 'checkbox',
		)
	);
		// Trending custom content setting
	$wp_customize->add_setting(
		'ideal_blog_trending_section_title',
		array(
			'sanitize_callback' => 'sanitize_text_field',
			'default' => $default['ideal_blog_trending_section_title'],
		)
	);

	$wp_customize->add_control(
		'ideal_blog_trending_section_title',
		array(
			'section'		=> 'ideal_blog_trending',
			'label'			=> esc_html__( 'Section Title ', 'ideal-blog' ),
			'active_callback' => 'ideal_blog_is_trending_enable',
			'type'			=> 'text'
		)
	);

	$trending_num = get_theme_mod( 'ideal_blog_trending_num', 4 );
	for ( $i=1; $i <= $trending_num; $i++ ) { 
		// Trending post setting
		$wp_customize->add_setting(
			'ideal_blog_trending_post_' . $i,
			array(
				'sanitize_callback' => 'ideal_blog_sanitize_dropdown_pages',
			)
		);

		$wp_customize->add_control(
			'ideal_blog_trending_post_' . $i,
			array(
				'section'		=> 'ideal_blog_trending',
				'label'			=> esc_html__( 'Post ', 'ideal-blog' ) . $i,
				'active_callback' => 'ideal_blog_is_trending_enable',
				'type'			=> 'select',
				'choices'		=> ideal_blog_get_post_choices(),
			)
		);
	}
?>