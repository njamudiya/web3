<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Shadow Themes
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function ideal_blog_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

  // When  color scheme is light or dark.
  $menu_sticky = get_theme_mod( 'ideal_blog_make_menu_sticky', false );
  if (true==$menu_sticky) {  
    $classes[] = 'menu-sticky'; 
  }

	// When  color scheme is light or dark.
	$text_hover = get_theme_mod( 'ideal_blog_text_hover_type', 'hover-default' );
	$classes[] = esc_attr( $text_hover );

  // When  color scheme is light or dark.
  $btn_hover = get_theme_mod( 'ideal_blog_btn_hover_type', 'btn-hover-default' );
  $classes[] = esc_attr( $btn_hover );
  $archive_layout = get_theme_mod( 'ideal_blog_archive_layout', 'archive-four' ); 
    $classes[] = esc_attr( $archive_layout );
  $theme_layout = get_theme_mod( 'ideal_blog_theme_lite_dark_layout', 'dark-layout' ); 
    $classes[] = esc_attr( $theme_layout );
	
	// When global archive layout is checked.
	if ( is_archive() || is_404() || is_search() ) {
    $archive_sidebar = get_theme_mod( 'ideal_blog_archive_sidebar', 'no' ); 
		$classes[] = esc_attr( $archive_sidebar ) . '-sidebar';   

  } elseif ( ideal_blog_is_frontpage_blog() || ideal_blog_is_latest_posts() ) { // When global post sidebar is checked.
    $page_id = get_option( 'page_for_posts' );
      $ideal_blog_page_sidebar_meta = get_post_meta( $page_id, 'ideal-blog-select-sidebar', true);
      if ( ! empty( $ideal_blog_page_sidebar_meta ) ) {
        $classes[] = esc_attr( $ideal_blog_page_sidebar_meta ) . '-sidebar';
        } else {
        $blog_post_sidebar = get_theme_mod( 'ideal_blog_blog_sidebar', 'no' ); 
        $classes[] = esc_attr( $blog_post_sidebar ) . '-sidebar';
      }
  } elseif ( is_single() ) { // When global post sidebar is checked.
    	$ideal_blog_post_sidebar_meta = get_post_meta( get_the_ID(), 'ideal-blog-select-sidebar', true );
    	if ( ! empty( $ideal_blog_post_sidebar_meta ) ) {
			$classes[] = esc_attr( $ideal_blog_post_sidebar_meta ) . '-sidebar';
    	} else {
			$global_post_sidebar = get_theme_mod( 'ideal_blog_global_post_layout', 'no' ); 
			$classes[] = esc_attr( $global_post_sidebar ) . '-sidebar';
    	}
	} elseif ( ideal_blog_is_frontpage_blog() || is_page() ) {
		if ( ideal_blog_is_frontpage_blog() ) {
			$page_id = get_option( 'page_for_posts' );
		} else {
			$page_id = get_the_ID();
		}

    	$ideal_blog_page_sidebar_meta = get_post_meta( $page_id, 'ideal-blog-select-sidebar', true );
		if ( ! empty( $ideal_blog_page_sidebar_meta ) ) {
			$classes[] = esc_attr( $ideal_blog_page_sidebar_meta ) . '-sidebar';
		} else {
			$global_page_sidebar = get_theme_mod( 'ideal_blog_global_page_layout', 'no' ); 
			$classes[] = esc_attr( $global_page_sidebar ) . '-sidebar';
		}
	}

	// Site layout classes
	$site_layout = get_theme_mod( 'ideal_blog_site_layout', 'wide' );
	$classes[] = esc_attr( $site_layout ) . '-layout';


	return $classes;
}
add_filter( 'body_class', 'ideal_blog_body_classes' );

function ideal_blog_post_classes( $classes ) {
	if ( ideal_blog_is_page_displays_posts() ) {
		// Search 'has-post-thumbnail' returned by default and remove it.
		$key = array_search( 'has-post-thumbnail', $classes );
		unset( $classes[ $key ] );
		
		$archive_img_enable = get_theme_mod( 'ideal_blog_enable_archive_featured_img', true );

		if( has_post_thumbnail() && $archive_img_enable ) {
			$classes[] = 'has-post-thumbnail';
		} else {
			$classes[] = 'grid-item no-post-thumbnail';
		}
	}
  
	return $classes;
}
add_filter( 'post_class', 'ideal_blog_post_classes' );

/**
 * Excerpt length
 * 
 * @since Shadow Themes 1.0.0
 * @return Excerpt length
 */
function ideal_blog_excerpt_length( $length ){
	if ( is_admin() ) {
		return $length;
	}

	$length = get_theme_mod( 'ideal_blog_archive_excerpt_length', 30 );
	return $length;
}
add_filter( 'excerpt_length', 'ideal_blog_excerpt_length', 999 );

if ( ! function_exists( 'ideal_the_excerpt' ) ) :

  /**
   * Generate excerpt.
   *
   * @since 1.0.0
   *
   * @param int     $length Excerpt length in words.
   * @param WP_Post $post_obj WP_Post instance (Optional).
   * @return string Excerpt.
   */
  function ideal_the_excerpt( $length = 0, $post_obj = null ) {

    global $post;

    if ( is_null( $post_obj ) ) {
      $post_obj = $post;
    }

    $length = absint( $length );

    if ( 0 === $length ) {
      return;
    }

    $source_content = $post_obj->post_content;

    if ( ! empty( $post_obj->post_excerpt ) ) {
      $source_content = $post_obj->post_excerpt;
    }

    $source_content = preg_replace( '`\[[^\]]*\]`', '', $source_content );
    $trimmed_content = wp_trim_words( $source_content, $length, '&hellip;' );
    return $trimmed_content;

  }

endif;

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function ideal_blog_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'ideal_blog_pingback_header' );

/**
 * Get an array of post id and title.
 * 
 */
function ideal_blog_get_post_choices() {
	$choices = array( '' => esc_html__( '--Select Post--', 'ideal-blog' ) );
	$args = array( 'numberposts' => -1, );
	$posts = get_posts( $args );

	foreach ( $posts as $post ) {
		$id = $post->ID;
		$title = $post->post_title;
		$choices[ $id ] = $title;
	}

	return $choices;
}

/**
 * List of category for category choices.
 * @return Array Array of post ids and name.
 */
function ideal_blog_category_choices() {
    $tax_args = array(
        'hierarchical' => 0,
        'taxonomy'     => 'category',
    );
    $taxonomies = get_categories( $tax_args );
    $choices = array();
    $choices[0] = esc_html__( '--Select--', 'ideal-blog' );
    foreach ( $taxonomies as $tax ) {
        $choices[ $tax->term_id ] = $tax->name;
    }
    return  $choices;
}

if( !function_exists( 'ideal_blog_get_page_choices' ) ) :
  /*
   * Function to get pages
   */
  function ideal_blog_get_page_choices() {

    $pages  =  get_pages();
    $page_list = array();
    $page_list[0] = esc_html__( '--Select Page--', 'ideal-blog' );

    foreach( $pages as $page ){
      $page_list[ $page->ID ] = $page->post_title;
    }

    return $page_list;

  }
endif;

/**
 * Get an array of cat id and title.
 * 
 */

if( !function_exists( 'ideal_blog_get_post_cat_choices' ) ) :
  /*
   * Function to get categories
   */
  function ideal_blog_get_post_cat_choices() {
    $categories = get_terms( 'category' );
    $choices = array('' => esc_html__( '--Select Category--', 'ideal-blog' ));

    foreach( $categories as $category ) {
      $choices[$category->term_id] = $category->name;
    }

    return $choices;
  }
endif;


/**
 * Checks to see if we're on the homepage or not.
 */
function ideal_blog_is_frontpage() {
	return ( is_front_page() && ! is_home() );
}

/**
 * Checks to see if Static Front Page is set to "Your latest posts".
 */
function ideal_blog_is_latest_posts() {
	return ( is_front_page() && is_home() );
}

/**
 * Checks to see if Static Front Page is set to "Posts page".
 */
function ideal_blog_is_frontpage_blog() {
	return ( is_home() && ! is_front_page() );
}

/**
 * Checks to see if the current page displays any kind of post listing.
 */
function ideal_blog_is_page_displays_posts() {
	return ( ideal_blog_is_frontpage_blog() || is_search() || is_archive() || ideal_blog_is_latest_posts() );
}

/**
 * Shows a breadcrumb for all types of pages.  This is a wrapper function for the Breadcrumb_Trail class,
 * which should be used in theme templates.
 *
 * @since  1.0.0
 * @access public
 * @param  array $args Arguments to pass to Breadcrumb_Trail.
 * @return void
 */
function ideal_blog_breadcrumb( $args = array() ) {
	$breadcrumb = apply_filters( 'breadcrumb_trail_object', null, $args );

	if ( ! is_object( $breadcrumb ) )
		$breadcrumb = new Breadcrumb_Trail( $args );

	return $breadcrumb->trail();
}

/**
 * Pagination in archive/blog/search pages.
 */
function ideal_blog_posts_pagination() { 
	$archive_pagination = get_theme_mod( 'ideal_blog_archive_pagination_type', 'older_newer' );
	if ( 'disable' === $archive_pagination ) {
		return;
	}
	if ( 'older_newer' === $archive_pagination ) {
        the_posts_navigation( array(
            'prev_text'          => '<span>'. esc_html__( 'Older', 'ideal-blog' ) .'</span>',
            'next_text'          => '<span>'. esc_html__( 'Newer', 'ideal-blog' ) .'</span>' ,
        )  );
	}
}






/**
 * Get an array of google fonts.
 * 
 */
function ideal_blog_font_choices() {
  $font_family_arr = array();
  $font_family_arr[''] = esc_html__( '--Default--', 'ideal-blog' );

  // Make the request
    $request = wp_remote_get( get_theme_file_uri( 'assets/js/webfonts.json' ) );

    if( is_wp_error( $request ) ) {
      return false; // Bail early
    }
  // Retrieve the data
    $body = wp_remote_retrieve_body( $request );
    $data = json_decode( $body );
    if ( ! empty( $data ) ) {
      foreach ( $data->items as $items => $fonts ) {
        $family_str_arr = explode( ' ', $fonts->family );
        $family_value = implode( '-', array_map( 'strtolower', $family_str_arr ) );
        $font_family_arr[ $family_value ] = $fonts->family;
      }
    }

    return apply_filters( 'ideal_blog_font_choices', $font_family_arr );
}

function ideal_blog_custom_color_scheme() {
    $custom_color = get_theme_mod( 'ideal_blog_custom_color_scheme' );

    $section_title_font_family = explode( '-', get_theme_mod( 'ideal_blog_section_title_font_option'  ) );
    $section_title_font_family = implode( ' ', array_map( 'ucfirst', $section_title_font_family ) );

    $h1_h6_font_family = explode( '-', get_theme_mod( 'ideal_blog_h1_h6_font_option'  ) );
    $h1_h6_font_family = implode( ' ', array_map( 'ucfirst', $h1_h6_font_family ) );

    $body_font_family = explode( '-', get_theme_mod( 'ideal_blog_body_font_option'  ) );
    $body_font_family = implode( ' ', array_map( 'ucfirst', $body_font_family ) );
    $custom_css = '
            /*----------------------------------------
              Color
            ------------------------------------------*/
            a,
            .secondary-menu a:hover,
            .secondary-menu a:focus,
            .secondary-menu ul.menu li.current-menu-item > a,
            .main-navigation a:hover,
            .main-navigation a:focus,
            .pagination .page-numbers.current,
            .pagination a.page-numbers:hover,
            .pagination a.page-numbers:focus,.widget_popular_post h3 a:hover,
            .widget_popular_post h3 a:focus,
            .widget_popular_post a time,
            .widget_popular_post time,
            #secondary ul li a:hover,
            #secondary ul li a:focus,
            .nav-links a:hover,
            .nav-links a:hover svg,
            #related-posts .shadow-entry-title a:hover,
            #related-posts .shadow-entry-title a:focus,
            #related-posts ul.post-categories li a:hover,
            #related-posts ul.post-categories li a:focus,
            .comment-meta .url:hover,
            .comment-meta .url:focus,
            ul.trail-items li.trail-item.trail-end,
            ul.trail-items li.trail-item.trail-end,
            ul.trail-items li a:hover,
            ul.trail-items li a:focus,
            #features .shadow-entry-title a:hover,
            #features .shadow-entry-title a:focus,
            .hover-default .post-archive article .shadow-entry-container .shadow-entry-title a:hover,
            .hover-default .post-archive article .shadow-entry-container .shadow-entry-title a:focus,
            article .shadow-entry-title a:hover,
            article .shadow-entry-title a:focus,
            .hover-2 .shadow-entry-header h1 a:hover,
            .hover-2 .shadow-entry-header h2 a:hover,
            .hover-2 .shadow-entry-header h3 a:hover,
            .hover-2 .shadow-entry-header h4 a:hover,
            .hover-2 .shadow-entry-header h5 a:hover,
            .hover-2 .latest-featured .shadow-entry-header h2 a:hover,
            .hover-3 .shadow-entry-header h3 a:hover,
            .hover-3 .shadow-entry-header h2 a:hover,
            .hover-3 .shadow-entry-header h3 a:hover,
            .hover-3 .shadow-entry-header h4 a:hover,
            .hover-3 .shadow-entry-header h5 a:hover,
            .hover-3 .latest-featured .shadow-entry-header h2 a:hover,
            .footer-widgets-area .widget ul li a:hover,
            .site-title a:hover,
            .featured-content-wrapper span.posted-on time,
            .cat-links a,
            #list-articles .shadow-entry-container .more-link,
            #must-read .shadow-entry-title a:hover, 
            #must-read .shadow-entry-title a:focus,
            #featured .posted-on a,
            .cat-links a,
            .shadow-entry-subtitle,
            #popular .shadow-entry-title a:hover, 
            #popular .shadow-entry-title a:focus,
            #featured .shadow-entry-title a:hover, 
            #featured .shadow-entry-title a:focus,
            .shadow-popular-news article .shadow-entry-title a:hover, 
            .shadow-popular-news article .shadow-entry-title a:focus,
            .blog #secondary span.posted-on a:hover, 
            .blog #secondary span.posted-on time:hover, 
            .archive #secondary span.posted-on a:hover, 
            .archive #secondary span.posted-on time:hover, 
            .search #secondary span.posted-on a:hover, 
            .search #secondary span.posted-on time:hover,
            span.posted-on a:hover, 
            span.posted-on time:hover,
            .dark-layout #must-read .shadow-entry-title a:hover,
            .dark-layout #must-read .shadow-entry-title a:focus,
            .dark-layout #message .shadow-entry-title a:hover,
            .dark-layout #message .shadow-entry-title a:focus,
            .dark-layout a:hover,
            .dark-layout a:focus,
            .dark-layout #must-read .shadow-entry-title a:hover, 
            .dark-layout #must-read .shadow-entry-title a:focus, 
            .dark-layout .main-navigation a:hover, 
            .dark-layout .main-navigation a:focus,
            .dark-layout #secondary ul li a:hover,
            .dark-layout #secondary ul li a:focus,
            .dark-layout .menu-item p,
            #trending article .shadow-entry-title a:hover,
            #featured-slider article.half-image .half-content-wrapper .shadow-entry-title a:hover,
            #featured-slider article.half-image .half-content-wrapper .shadow-entry-title a:focus {
                color: ' . esc_attr( $custom_color ) . ';
            }

            .main-navigation ul.nav-menu > li > a.search:hover svg.icon-search,
            .main-navigation ul.nav-menu > li > a.search:focus svg.icon-search,
            .nav-links a:hover,
            .nav-links a:hover svg,
            .btn svg{
              fill: ' . esc_attr( $custom_color ) . ';
            }

            @media screen and (min-width: 1024px) {
              .modern-menu .main-navigation ul#primary-menu ul li.current-menu-item > a, 
              .modern-menu .main-navigation ul#primary-menu ul li:hover > a, 
              .modern-menu .main-navigation ul#primary-menu ul li:focus > a,
              .main-navigation ul#primary-menu ul li.current-menu-item > a {
                color: ' . esc_attr( $custom_color ) . ';
              }
            }

            /*----------------------------------------
              Background Color
            ------------------------------------------*/
             .totop,
             form.search-form button.search-submit, 
             .widget_search form.search-form button.search-submit,
             input[type="submit"]:hover,
            input[type="submit"]:focus,
            .reply a:hover,
            .reply a:focus,
            .featured-content-wrapper .btn,
            #featured-posts article:hover .featured-item-wrapper:after,
            #featured-posts article .cat-links a,
            #message .separator,
            .popup-video:hover,
            .slick-prev, 
            .slick-next,
            .slick-dots li button,
            .btn-hover-6 .btn:before,
            .btn-hover-6 .featured-content-wrapper .btn:before,
            .btn,
            #featured-collection article .popup:hover,
            #featured-collection .cat-links a:hover,
             #featured-collection .cat-links a:focus,
            .entry-meta.shadow-posted,
            .wp-block-search__button,
            .dark-layout .totop {
              background-color: ' . esc_attr( $custom_color ) . ';
            }

            .pagination .page-numbers, 
            .pagination .page-numbers {
              background-color: #eee;
            }

            :root {
                --mainColor: ' . esc_attr( $custom_color ) . ';
              }

            @media screen and (min-width: 1024px) {
              .main-navigation ul.sub-menu li:hover > a,
              .main-navigation ul.sub-menu li:focus > a,
              #top-menu ul.sub-menu li:hover > a,
              #top-menu ul.sub-menu li:focus > a {
                background-color: ' . esc_attr( $custom_color ) . ';
              }
            }

            /*----------------------------------------
              Border Color
            ------------------------------------------*/

            #respond input[type="submit"]:hover,
            #respond input[type="submit"]:focus,
            .pagination a.page-numbers:hover,
            .pagination a.page-numbers:focus,
            .post-categories li::before,
            .post-categories li::after,
            .wp-block-search__button,
            #featured-collection .cat-links a:hover,
            #featured-collection .cat-links a:focus {
              border-color: ' . esc_attr( $custom_color ) . ';
            }
            .main-navigation ul.sub-menu,
            #top-menu ul.sub-menu,
            .entry-meta.shadow-posted {
              border-top-color: ' . esc_attr( $custom_color ) . ';
            }
            #message .shadow-entry-header:before{
              border-right-color: ' . esc_attr( $custom_color ) . ';
            }

            @media screen and (min-width: 1024px) {
              .main-navigation ul ul {
                  border-top-color: ' . esc_attr( $custom_color ) . ';
              }
              .main-navigation ul.nav-menu > li.menu-item-has-children:hover > a:after {
                border-bottom-color: ' . esc_attr( $custom_color ) . ';
              }
            }
              @media screen and (max-width: 1023px) {
              .main-navigation ul.sub-menu,
              #top-menu ul.sub-menu {
                  border-top-color: ' . esc_attr( $custom_color ) . ';
            }
          }
            /*----------------------------------------
              Font Family
            ------------------------------------------*/
            .shadow-section-header h1,
            .shadow-section-header h2,
            .shadow-section-header h3,
            .shadow-section-header h4,
            .shadow-section-header h5,
            .shadow-section-header h6 {
              font-family: ' . esc_attr( $section_title_font_family ) . ';
            }
            h1,
            h2,
            h3,
            h4,
            h5,
            h6,
            .post-navigation a, 
            .posts-navigation a,
            .single-post-wrapper span.tags-links,
            .single-post-wrapper span.cat-links,
            .blog-posts-wrapper .cat-links a,
            .blog-posts-wrapper .cat-links,
            .woocommerce div.product .woocommerce-tabs ul.tabs li a {
              font-family: ' . esc_attr( $h1_h6_font_family ) . ';
            }
            body,
            .single-post-wrapper span.tags-links a,
            .single-post-wrapper span.cat-links a,
            .blog-posts-wrapper span.cat-links,
            .blog-posts-wrapper span.cat-links a,
            .blog-posts-wrapper span.cat-links,
            .blog-posts-wrapper span.cat-links a {
              font-family: ' . esc_attr( $body_font_family ) . ';
            }
            ';
    wp_add_inline_style( 'ideal-blog-style', $custom_css );
}
add_action( 'wp_enqueue_scripts', 'ideal_blog_custom_color_scheme' );

// Add auto p to the palces where get_the_excerpt is being called.
add_filter( 'get_the_excerpt', 'wpautop' );

 