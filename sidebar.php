<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Shadow Themes
 */
 
if ( is_archive() || is_404() || is_search() ) {
	$archive_sidebar = get_theme_mod( 'ideal_blog_archive_sidebar', 'no' ); 
	if ( 'no' === $archive_sidebar ) {
		return;
	}
} elseif ( is_single() ) {
    $ideal_blog_post_sidebar_meta = get_post_meta( get_the_ID(), 'ideal-blog-select-sidebar', true );
	$global_post_sidebar = get_theme_mod( 'ideal_blog_global_post_layout', 'no' ); 

	if ( ! empty( $ideal_blog_post_sidebar_meta ) && ( 'no' === $ideal_blog_post_sidebar_meta ) ) {
		return;
	} elseif ( empty( $ideal_blog_post_sidebar_meta ) && 'no' === $global_post_sidebar ) {
		return;
	}
} elseif ( ideal_blog_is_latest_posts() ) {
	$page_id = get_option( 'page_for_posts' );
    $ideal_blog_page_sidebar_meta = get_post_meta( $page_id, 'ideal-blog-select-sidebar', true );
	$global_blog_sidebar = get_theme_mod( 'ideal_blog_blog_sidebar', 'no' ); 

	if ( ! empty( $ideal_blog_page_sidebar_meta ) && ( 'no' === $ideal_blog_page_sidebar_meta ) ) {
		return;
	} elseif ( empty( $ideal_blog_page_sidebar_meta ) && 'no' === $global_blog_sidebar ) {
		return;
	}
} elseif ( ideal_blog_is_frontpage_blog() || is_page() ) {
	if ( ideal_blog_is_frontpage_blog() ) {
		$page_id = get_option( 'page_for_posts' );
	} else {
		$page_id = get_the_ID();
	}
    $ideal_blog_page_sidebar_meta = get_post_meta( $page_id, 'ideal-blog-select-sidebar', true );
	$global_page_sidebar = get_theme_mod( 'ideal_blog_global_page_layout', 'no' ); 

	if ( !empty( $ideal_blog_page_sidebar_meta ) && ( 'no' === $ideal_blog_page_sidebar_meta ) ) {
		return;
	} elseif ( empty( $ideal_blog_page_sidebar_meta ) && 'no' === $global_page_sidebar ) {
		return;
	}
}

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area" role="complementary">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside><!-- #secondary -->
