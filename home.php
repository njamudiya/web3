<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Shadow Themes
 */

get_header(); 

	
$img = '';
if( ideal_blog_is_frontpage_blog() ) {
    $page_for_posts = get_option( 'page_for_posts' );
	$img = get_the_post_thumbnail_url( $page_for_posts, 'large' );
}
$archive_column = get_theme_mod( 'ideal_blog_blog_archive_column',3); 
?>
	<?php $header_image = get_header_image();
$archive_header_image='';
$default_header_image = ! empty( $header_image ) ?  $header_image : get_template_directory_uri() . '/assets/img/header-image.jpg';
if (!empty($header_image)) {
	$archive_header_image= $header_image;
} else{
	$archive_header_image= $default_header_image;
} ?>
<div id="banner-image" class="disable-top-header-image"  style="background-image: url('<?php echo esc_url( $archive_header_image ) ?>')">
    <div class="overlay"></div>
    <div class="page-site-header">
        <div class="wrapper">
            <header class="page-header">
                <h2 class="page-title">
	                <?php 
	            	if ( ideal_blog_is_latest_posts() ) {
	            		echo esc_html( get_theme_mod( 'ideal_blog_your_latest_posts_title', esc_html__( 'Blogs', 'ideal-blog' ) ) ); 
	            	} elseif( ideal_blog_is_frontpage_blog() ) {
	            		single_post_title();
	            	} 
	            	?>
                </h2>
            </header><!-- .page-header -->

            <?php  
	        $breadcrumb_enable = get_theme_mod( 'ideal_blog_breadcrumb_enable', true );
	        if ( $breadcrumb_enable ) : 
	            ?>
	            <div id="breadcrumb-list" >
	                <div class="wrapper">
	                    <?php echo ideal_blog_breadcrumb( array( 'show_on_front'   => false, 'show_browse' => false ) ); ?>
	                </div><!-- .wrapper -->
	            </div><!-- #breadcrumb-list -->
	        <?php endif; ?>
        </div><!-- .wrapper -->
    </div><!-- #page-site-header -->
</div><!-- #banner-image -->

<div id="inner-content-wrapper" class=" <?php if ($archive_column > 3) { ?>wide-wrapper <?php } ?> wrapper page-section">
	<div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
        	<?php 
        	$sticky_posts = get_option( 'sticky_posts' );  
        	if ( ! empty( $sticky_posts ) ) :
        	?>
                <div class="sticky-post-wrapper posts-wrapper grid column-<?php echo esc_attr( $archive_column );?>">
	        		<?php  
						$sticky_query = new WP_Query( array(
							'post__in'  => $sticky_posts,
						) );

						if ( $sticky_query->have_posts() ) :
							/* Start the Loop */
							while ( $sticky_query->have_posts() ) : $sticky_query->the_post(); ?>
								<article id="post-<?php the_ID(); ?>" <?php post_class('grid-item'); ?>>
									<?php 
										$archive_img_enable = get_theme_mod( 'ideal_blog_enable_archive_featured_img', true );
										$archive_date_enable = get_theme_mod( 'ideal_blog_enable_archive_date', true );
										$archive_layout = get_theme_mod( 'ideal_blog_archive_layout', 'archive-four' );
										$featured_image_option= get_theme_mod( 'ideal_blog_featured_image_option', 'main-image' );
										$content_align= get_theme_mod( 'ideal_blog_content_align', 'content-center' );
										$second_image_id = get_post_meta( get_the_ID(), '_ideal_image_id', true );
										$archive_two_second_image = wp_get_attachment_image_src( $second_image_id, "ideal-archive-two", "", array( "class"=> "img-responsive" ) );
										$second_image = wp_get_attachment_image_src( $second_image_id, "full", "", array( "class"=> "img-responsive" ) );
										$img_url = '';
										if ( has_post_thumbnail() && $archive_img_enable ) : 
											$img_url = get_the_post_thumbnail_url( get_the_ID(), 'full' );
										endif;
										$half_class='';
										if ((!empty($second_image) && has_post_thumbnail()) && $archive_layout != 'archive-one') {
										  	$half_class ='double-image';
										} else{
											$half_class ='single-image';
										}  
									?>
									<?php if ( (!empty( $img_url ) || !empty($second_image)) && $archive_img_enable==true) : ?>
										<div class="archive-featured-image <?php echo $half_class; ?>">
										    <?php if ((!empty($second_image) || !empty( $img_url ) ) && ($archive_layout == 'archive-one') ){ ?>
								        		<div class="main-featured-image" style="background-image: url('<?php the_post_thumbnail_url( 'full' ); ?>');"> 
								        			<a href="<?php echo the_permalink();?>" class="post-thumbnail-link"></a>
								        			<?php if (!empty($second_image)): ?>
									        			<div class="second-featured-image" style="background-image: url('<?php echo esc_url( $second_image[0] ) ?>');" > 
								    						<a href="<?php echo the_permalink();?>" class="post-thumbnail-link"></a>
								    					</div>
													<?php endif ?>
								        		</div>
								        	<?php } elseif ((!empty($second_image) || !empty( $img_url ) ) && ($archive_layout=='archive-two' || $archive_layout=='archive-three') ){ ?>

								    			<?php if (!empty($img_url)): ?>
									        		<div class="main-featured-image"> 
									        			<a href="<?php echo the_permalink();?>"><img src="<?php the_post_thumbnail_url( 'ideal-archive-two' ); ?>"></a>
									        		</div>
								        		<?php endif ?>
									    		<?php if (!empty($second_image)): ?>
									    			<div class="second-featured-image" > 
														<a href="<?php echo the_permalink();?>"><img src="<?php echo esc_url( $archive_two_second_image[0] ) ?>"></a>
													</div>
								    			<?php endif ?>
								    		<?php } elseif ((!empty($second_image) || !empty( $img_url ) ) && ($archive_layout=='archive-four' || $archive_layout=='archive-five') ){ ?>

								    			<?php if (!empty($img_url) && $featured_image_option=='main-image'): ?>
									        		<div class="main-featured-image" <?php if ($archive_layout=='archive-five') { ?> style="background-image: url('<?php the_post_thumbnail_url( 'full' ); ?>');" <?php } ?>> 
									        			<?php if ($archive_layout=='archive-five') { ?>
									        				<a href="<?php echo the_permalink();?>" class="post-thumbnail-link"></a>
									        			<?php } else{ ?>
										        			<a href="<?php echo the_permalink();?>"><img src="<?php the_post_thumbnail_url( 'full' ); ?>"></a>
										        		<?php } ?>
									        		</div>
								        		<?php endif ?>
									    		<?php if (!empty($second_image) && $featured_image_option=='second-image'): ?>
									    			<div class="second-featured-image" <?php if ($archive_layout=='archive-five') { ?> style="background-image: url('<?php echo esc_url( $second_image[0] ) ?>');" <?php } ?>> 
									        			<?php if ($archive_layout=='archive-five') { ?>
									        				<a href="<?php echo the_permalink();?>" class="post-thumbnail-link"></a>
									        			<?php } else{ ?>
										        			<a href="<?php echo the_permalink();?>"><img src="<?php echo esc_url($second_image[0]); ?>"></a>
										        		<?php } ?>
									        		</div>
								    			<?php endif ?>
								    		<?php } ?>
								    		
										</div><!-- .featured-image -->
									<?php endif; ?>

									<div class="shadow-entry-container <?php echo esc_attr($content_align); ?>">
										
										<?php 
											$enable_archive_author = get_theme_mod( 'ideal_blog_enable_archive_author', true );
											
											$archive_category_enable = get_theme_mod( 'ideal_blog_enable_archive_category', true );
											$archive_tags_enable = get_theme_mod( 'ideal_blog_enable_archive_tags', true );
										
										if ( $archive_category_enable ) {
										 	ideal_blog_cats(); 
										 }?>

										    	
									    <header class="shadow-entry-header">
									        <?php
											if ( is_singular() ) :
												the_title( '<h1 class="shadow-entry-title">', '</h1>' );
											else :
												the_title( '<h2 class="shadow-entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
											endif; ?>
									    </header>

									    <?php if ( $archive_date_enable==true) { ?>
											<div class="post-date">
												<?php ideal_blog_posted_on(); ?>
											</div>
										<?php } ?>
										
									    <div class="shadow-entry-content">
									        <?php
									        
												$archive_content_type = get_theme_mod( 'ideal_blog_archive_content_type', 'excerpt' );
												if ( 'excerpt' == $archive_content_type ) {
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
											<div class="entry-meta shadow-posted">
												<div class="entry-meta-left">
													<?php ideal_blog_comment(); ?>
													<?php 
													if ( class_exists( 'Post_Views_Counter' ) ) {
								                        pvc_post_views( $post_id = 0, $echo = true );
								                    } ?>
													<?php //ideal_blog_post_author(); ?>
												</div>
												<div class="read-time">
													<?php
													echo '<span class="read-time-count">'. ideal_blog_time_interval( get_the_content() ) . '</span>';
													echo '<span class="read-time-text">'. esc_html( get_theme_mod( 'ideal_blog_min_to_read', esc_html__( 'Min to Read', 'ideal-blog' ) ) ). '</span>';
													?>
												</div>
											</div>
									    	
									    	<?php if ( $archive_tags_enable ) {
									    	 	ideal_blog_tags();
									    	 } ?>

									    </div><!-- .shadow-entry-content -->
								    </div><!-- .shadow-entry-container -->
								</article><!-- #post-<?php the_ID(); ?> -->
							<?php
							endwhile;
							wp_reset_postdata();
						endif;
	        		?>
                </div><!-- .blog-posts-wrapper/.sticky-post-wrapper -->
        	<?php endif; 

    		$page_id = get_option( 'page_for_posts' );
    		
    	    $ideal_blog_page_sidebar_meta = get_post_meta( $page_id, 'ideal-blog-select-sidebar', true );
    		$global_page_sidebar = get_theme_mod( 'ideal_blog_global_page_layout', 'right' ); 
            $blog_sidebar = get_theme_mod( 'ideal_blog_blog_sidebar', 'no' ); 
            $archive_column = get_theme_mod( 'ideal_blog_blog_archive_column',3); 
    		if ( ! empty( $ideal_blog_page_sidebar_meta ) && ( 'no' === $ideal_blog_page_sidebar_meta ) ) {
    			$col = 3;
    		} elseif ( empty( $ideal_blog_page_sidebar_meta ) && 'no' === $global_page_sidebar ) {
    			$col = 3;
    		} elseif( ( is_front_page() ) && ( 'no' === $blog_sidebar ) ) {
    			$col = 3;
    		} else{
                $col = 2;
            }
        	?>
            <div  id="ideal-blog-infinite-scroll" class="archive-blog-wrapper posts-wrapper grid clear column-<?php echo esc_attr( $archive_column );?>">
				<?php
				if ( have_posts() ) :

					/* Start the Loop */
					while ( have_posts() ) : the_post();

						/*
						 * Include the Post-Format-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'template-parts/content', get_post_format() );

					endwhile;

					wp_reset_postdata();

				else :

					get_template_part( 'template-parts/content', 'none' );

				endif; ?>
			</div><!-- .blog-posts-wrapper -->
			<?php ideal_blog_posts_pagination();?>
		</main><!-- #main -->
	</div><!-- #primary -->

	<?php get_sidebar();?>
</div>
<?php get_footer();
