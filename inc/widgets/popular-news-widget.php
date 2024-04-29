<?php
/**
 * Popular Posts.
 *
 * @package ideal_blog
 */

function ideal_blog_popular_news() {
	register_widget( 'Ideal_Blog_Popular_Posts' );
}
add_action( 'widgets_init', 'ideal_blog_popular_news' );

class Ideal_Blog_Popular_Posts extends WP_Widget{ 

	function __construct() {
		global $control_ops;
		$widget_popular = array(
		  'classname'   => 'popular-news',
		  'description' => esc_html__( 'Add Widget to Display Popular Posts.', 'ideal-blog' )
		);
		parent::__construct( 'Ideal_Blog_Popular_Posts',esc_html__( 'ST: Popular Posts', 'ideal-blog' ), $widget_popular, $control_ops );
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, 
			array( 
			  'title'			=> esc_html__( 'Popular Posts', 'ideal-blog' ),		
			  'category'       	=> '', 
			  'number'          => 6, 
			  'show_category'	=> true,	
			) 
		);
		$title     			= isset( $instance['title'] ) ? esc_html( $instance['title'] ) : esc_html__( 'Popular Posts', 'ideal-blog' );
		$category 			= isset( $instance['category'] ) ? absint( $instance['category'] ) : 0;
		$number    			= isset( $instance['number'] ) ? absint( $instance['number'] ) : 6;   
		$show_category 		= isset( $instance['show_category'] ) ? (bool) $instance['show_category'] : true; 
	?>
	    <p>
	    	<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php echo esc_html__( 'Title:', 'ideal-blog' ); ?></label>
	    	<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
		</p>	
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'category' ) ); ?>">
				<?php esc_html_e( 'Select Category:', 'ideal-blog' ); ?>			
			</label>

			<?php
				wp_dropdown_categories(array(
					'show_option_none' => '',
					'class' 		  => 'widefat',
					'show_option_all'  => esc_html__('Latest Posts','ideal-blog'),
					'name'             => esc_attr($this->get_field_name( 'category' )),
					'selected'         => absint( $category ),          
				) );
			?>
		</p>

	    <p>
	    	<label for="<?php echo esc_attr($this->get_field_id( 'number' )); ?>">
	    		<?php echo esc_html__( 'Choose Number (Max: 20)', 'ideal-blog' );?>    		
	    	</label>

	    	<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'number' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'number' )); ?>" type="number" step="1" min="1" value="<?php echo esc_attr($number); ?>" max="20" />
	    </p>	
  
    <?php
    }

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] 				= sanitize_text_field( $new_instance['title'] );
		$instance['category'] 			= absint( $new_instance['category'] );		
		$instance['number'] 			= (int) $new_instance['number'];
		$instance['show_category'] 		= (bool) $new_instance['show_category'];  	   
		return $instance;
	}

    function widget( $args, $instance ) {

    	extract( $args ); 
		$title     			= isset( $instance['title'] ) ? esc_html( $instance['title'] ) : esc_html__( 'Popular Posts', 'ideal-blog' );
    	$title 				= apply_filters( 'widget_title', $title, $instance, $this->id_base );
    	
        $category  			= isset( $instance[ 'category' ] ) ? $instance[ 'category' ] : 0;
        $featured_category  = isset( $instance[ 'featured_category' ] ) ? $instance[ 'featured_category' ] : 0;
        $number 			= ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 6; 
        $show_category		= isset( $instance['show_category'] ) ? $instance['show_category'] : true;
        echo $before_widget;
        ?>   		    
	        
        <?php $popular_news_args = array(
            'posts_per_page' => absint( $number ),
            'post_type' => 'post',
            'post_status' => 'publish',
            'post__not_in' => get_option( 'sticky_posts' ),      
        );

        if ( absint( $category ) > 0 ) {
          $popular_news_args['cat'] = absint( $category );
        }

        $the_loop = new WP_Query( $popular_news_args ); 
    	if ( $the_loop -> have_posts() ) : 
        $i = 1;
        $count = count( ( array ) $the_loop ); ?> 
        	<div class="shadow-popular-news">
				<?php if ( !empty( $title ) ): ?>
		            <div class="shadow-section-header">
		                <?php echo $args['before_title'] . esc_html($title) . $args['after_title']; ?>
		            </div><!-- .shadow-section-header -->
			        <?php endif; ?>	 

	                <div class="section-content clear">
	                    <?php 
	                        while ( $the_loop -> have_posts() ) : $the_loop -> the_post(); 
	                            if ( in_array( $i, array( 1, 2 ) ) ) : ?>
	                                <div class="popular-post-wrapper">
	                            <?php endif; ?>
	                                <article class="hentry <?php echo ( 1 == $i ) ? 'full-width' : 'half-width'; ?>">
	                                    <div class="post-wrapper">
	                                        <?php if ( has_post_thumbnail() ) : ?>
	                                            <div class="featured-image">
	                                                <a href="<?php the_permalink(); ?>">
	                                                    <?php the_post_thumbnail( 'post-thumbnail', array( 'alt' => the_title_attribute( 'echo=0' ) ) ); ?>
	                                                </a>
	                                            </div><!-- .recent-image -->
	                                        <?php endif; ?>

	                                        <div class="shadow-entry-container">
	                                            <header class="shadow-entry-header">
	                                                <h2 class="shadow-entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
	                                            </header>
	                                            <div class="shadow-entry-meta">   
	                                            	<?php ideal_blog_posted_on(); ?>
		                                        </div><!-- .entry-meta -->

	                                            <?php if ( 1 == $i ) : ?>
	                                                <div class="shadow-entry-content">
	                                                    <?php the_excerpt(); ?>
	                                                </div><!-- .entry-content -->
	                                            <?php endif; ?>
	                                        </div><!-- .entry-container -->
	                                    </div><!-- .post-wrapper -->
	                                </article>
	                            <?php if ( 1 == $i || $i == $count ) : ?>
	                                </div><!-- .popular-post-wrapper -->
	                            <?php endif; 
	                        $i++; endwhile; 
	                     ?>
	                </div><!-- .section-content -->  
	            </div> 
            <?php endif;
            wp_reset_postdata(); ?>	 
           </div>       		    
        <?php echo $after_widget;
    } 
}