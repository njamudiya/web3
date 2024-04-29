<?php
/**
 * Template part for displaying search results
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Shadow Themes
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('grid-item'); ?>>
	<?php 
	$archive_img_enable = get_theme_mod( 'ideal_blog_enable_archive_featured_img', true );

	$img_url = '';
	if ( has_post_thumbnail() && $archive_img_enable ) : 
		$img_url = get_the_post_thumbnail_url( get_the_ID(), 'full' );
	endif;
	?>
	<div class="featured-image" style="background-image: url('<?php echo esc_url( $img_url ); ?>');">
		<?php 
		if ( ! empty( $img_url ) ) : ?>
	    	<a href="<?php the_permalink(); ?>" class="featured-image-link"></a>
		<?php endif; ?>

	    <div class="entry-meta">
	        <?php
			$enable_archive_author = get_theme_mod( 'ideal_blog_enable_archive_author', true );
	        if ( $enable_archive_author ) {
				ideal_blog_post_author(); 
			}

			$archive_date_enable = get_theme_mod( 'ideal_blog_enable_archive_date', true );
			if ( $archive_date_enable ) {
				ideal_blog_posted_on(); 
			}
			?>

	    </div><!-- .entry-meta -->
	</div><!-- .featured-image -->

	<div class="shadow-entry-container">
        <div class="entry-meta">
			<?php ideal_blog_entry_footer(); ?>
        </div><!-- .entry-meta -->

        <header class="shadow-entry-header">
            <?php
			if ( is_singular() ) :
				the_title( '<h1 class="shadow-entry-title">', '</h1>' );
			else :
				the_title( '<h2 class="shadow-entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			endif; ?>
        </header>

        <div class="shadow-entry-content">
            <?php
				$archive_content_type = get_theme_mod( 'ideal_blog_enable_archive_content_type', 'excerpt' );
				if ( 'excerpt' === $archive_content_type ) {
					the_excerpt();
					?>
			        <div class="read-more-link">
					    <a href="<?php the_permalink(); ?>"><?php echo esc_html( get_theme_mod( 'ideal_blog_archive_excerpt', esc_html__( 'View the post', 'ideal-blog' ) ) ); ?></a>
					</div><!-- .read-more -->
				<?php
				} else {
					the_content( sprintf(
						wp_kses(
							/* translators: %s: Name of current post. Only visible to screen readers */
							__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'ideal-blog' ),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						),
						get_the_title()
					) );

					wp_link_pages( array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'ideal-blog' ),
						'after'  => '</div>',
					) );
				}
			?>
	    	
	    	<?php ideal_blog_tags(); ?>

        </div><!-- .shadow-entry-content -->
        

    </div><!-- .shadow-entry-container -->
</article><!-- #post-<?php the_ID(); ?> -->
