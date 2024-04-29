<?php
/**
 * Shadow Themes Customizer
 *
 * @package Shadow Themes
 */

/**
 * Get all the default values of the theme mods.
 */
function ideal_blog_get_default_mods() {
	$ideal_blog_default_mods = array(
		'ideal_blog_custom_color_scheme' => '#d6adad',
		// Sliders
		'ideal_blog_slider_custom_title' => esc_html__( 'We carve design in most possible beautiful way.', 'ideal-blog'),
		'ideal_blog_slider_custom_content' => esc_html__( 'Your time is limited, so don’t waste it living someone else’s life. Don’t be trapped by dogma – which is living with the results of other people’s thinking.', 'ideal-blog'),
		'ideal_blog_slider_custom_btn' => esc_html__( 'Know More', 'ideal-blog' ),
		'ideal_blog_slider_custom_subtitle' => esc_html__( 'Lorem Ipsum is simply dummy text.', 'ideal-blog' ),
		'ideal_blog_featured_slider_dot_enable'		=> true,
		'ideal_blog_featured_slider_fade_enable'		=> false,
		'ideal_blog_featured_slider_autoplay_enable'		=> true,
		'ideal_blog_featured_slider_infinite_enable'		=> true,

		// Trending
		'ideal_blog_trending_section_title' => esc_html__( 'The Art Of TRAVEL', 'ideal-blog' ),
		'ideal_blog_trending_custom_content' => esc_html__( 'Your time is limited, so don’t waste it living someone else’s life. Don’t be trapped by dogma – which is living with the results of other people’s thinking.', 'ideal-blog' ),
		'ideal_blog_trending_dot_enable'		=> true,
		'ideal_blog_trending_fade_enable'		=> false,
		'ideal_blog_trending_autoplay_enable'		=> true,
		'ideal_blog_trending_infinite_enable'		=> true,

		// Trending
		'ideal_blog_video_section_title' => esc_html__( 'Get Ready for an Adventure', 'ideal-blog' ),
		'ideal_blog_video_custom_content' => esc_html__( 'Living Like a Local: Immersive Travel Experience.', 'ideal-blog' ),



		// Recent posts
		'ideal_blog_recent_posts_more' => esc_html__( 'See More', 'ideal-blog' ),

		// Footer copyright
		'ideal_blog_copyright_txt' => esc_html__( 'All Rights Reserved', 'ideal-blog' ),
		'ideal_blog_powered_by_text' => sprintf( esc_html__( '%1$s by %2$s.', 'ideal-blog' ), 'Ideal Blog', '<a href="' . esc_url( 'http://shadowthemes.com/' ) . '">Shadow Themes</a>' ),

		
	);

	return apply_filters( 'ideal_blog_default_mods', $ideal_blog_default_mods );
}