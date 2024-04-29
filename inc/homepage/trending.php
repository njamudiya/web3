<?php
/**
 * Template part for displaying front page trending.
 *
 * @package Shadow Themes
 */

/// Get default  mods value.
$trending_enable = get_theme_mod( 'ideal_blog_trending_section_enable', true );

if ( false == $trending_enable ) {
    return;
}

$header_font_size = get_theme_mod( 'ideal_blog_trending_header_font_size');
$button_font_size = get_theme_mod( 'ideal_blog_trending_button_font_size');
$trending_speed = get_theme_mod( 'ideal_blog_trending_speed',600);
$trending_infinite = get_theme_mod('ideal_blog_trending_infinite_enable', true);
$trending_dot = get_theme_mod('ideal_blog_trending_dot_enable', true);
$trending_autoplay = get_theme_mod('ideal_blog_trending_autoplay_enable', true);
$trending_arrow = get_theme_mod('ideal_blog_trending_arrow_enable', true);
$trending_fade = get_theme_mod('ideal_blog_trending_fade_enable', false);
$trending_content_opacity = get_theme_mod( 'ideal_blog_trending_content_opacity',60);
$trending_background_opacity = get_theme_mod( 'ideal_blog_trending_image_opacity',0);
$trending_decoration_image = get_theme_mod( 'ideal_blog_trending_decoration_image',0);
$trending = get_theme_mod( 'ideal_blog_trending_content_type', 'cat' );


$default = ideal_blog_get_default_mods();
$trending_num = get_theme_mod( 'ideal_blog_trending_num', 4 );
$trending_column = get_theme_mod( 'ideal_blog_trending_column', 4 );
$section_title = get_theme_mod( 'ideal_blog_trending_section_title', $default['ideal_blog_trending_section_title'] ); 

?>
<div id="trending" class="page-section" >
	<div class="wrapper">
		<div class="shadow-section-header">
			<h2 class="shadow-section-title"><?php echo esc_html($section_title) ?></h2>
		</div>
		<div class="trending-wrapper column-<?php echo esc_attr($trending_column); ?>">
		    <?php
		    $trending_id = array();
			        for ( $i=1; $i <= $trending_num; $i++ ) { 
			            $trending_id[] = get_theme_mod( "ideal_blog_trending_post_" . $i );
			        }
		        $args = array(
		            'post_type' => 'post',
		            'post__in' => (array)$trending_id,   
	                'orderby'   => 'post__in',
		            'posts_per_page' => $trending_num,
		            'ignore_sticky_posts' => true,
		        );
			    
			    $query = new WP_Query( $args );

			    $i = 1;
			    if ( $query->have_posts() ) :
			        while ( $query->have_posts() ) :
			            $query->the_post();
			            ?>
			            <article class=" <?php echo has_post_thumbnail() ? 'has-post-thumbnail' : 'no-post-thumbnail' ; ?>" >

			            	<div class="trending-inner" style="background-image: url('<?php the_post_thumbnail_url( 'full' ); ?>');">
			                    <a href="<?php echo the_permalink();?>" class="post-thumbnail-link"></a>
			                </div>
			                <div class="trending-container">
			                	<?php 	ideal_blog_cats(); ?>			
				                <header class="shadow-entry-header">
			                        <h2 class="shadow-entry-title" style="font-size: <?php echo esc_attr($header_font_size); ?>px; " ><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h2>
			                    </header>
			                </div>
		    	        </article>
			        <?php 
			        $i++;
			    	endwhile;
			        wp_reset_postdata();
			    endif;
			?>
		</div><!-- #trending slider -->
	</div><!-- .wrapper-->
</div><!-- #trending -->