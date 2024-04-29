<?php /**
	 *
	 *
	 * Footer copyright
	 *
	 *
	 */
	// Footer copyright
	$wp_customize->add_section(
		'ideal_blog_footer_section',
		array(
			'title' => esc_html__( 'Footer', 'ideal-blog' ),
			'priority' => 106,
			'panel' => 'ideal_blog_general_panel',
		)
	);


	// Footer copyright setting
	$wp_customize->add_setting(
		'ideal_blog_copyright_txt',
		array(
			'sanitize_callback' => 'ideal_blog_sanitize_html',
			'default' => $default['ideal_blog_copyright_txt'],
		)
	);

	$wp_customize->add_control(
		'ideal_blog_copyright_txt',
		array(
			'section'		=> 'ideal_blog_footer_section',
			'label'			=> esc_html__( 'Copyright Text:', 'ideal-blog' ),
			'type'			=> 'textarea',
			
		)
	);
 ?>