<?php 

	// Pagination type setting
	$wp_customize->add_setting(
		'ideal_blog_archive_pagination_type',
		array(
			'sanitize_callback' => 'ideal_blog_sanitize_select',
			'default' => 'numeric',
		)
	);

	$archive_pagination_description = '';
	$archive_pagination_choices = array( 
				'disable' => esc_html__( '--Disable--', 'ideal-blog' ),
				'older_newer' => esc_html__( 'Older / Newer', 'ideal-blog' ),
			);
	
	$wp_customize->add_control(
		'ideal_blog_archive_pagination_type',
		array(
			'section'		=> 'ideal_blog_archive_settings',
			'label'			=> esc_html__( 'Pagination type:', 'ideal-blog' ),
			'description'			=>  $archive_pagination_description,
			'type'			=> 'select',
			'choices'		=> $archive_pagination_choices,
		)
	);
 ?>