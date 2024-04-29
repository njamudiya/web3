<?php
/**
 * Metabox file
 *
 * @package Shadow Themes
 */

/**
 * Register meta box(es).
 */
function ideal_register_meta_boxes() {
    add_meta_box( 'ideal-blog-select-sidebar', __( 'Sidebar position', 'ideal-blog' ), 'ideal_display_metabox', array( 'post', 'page' ), 'side' );
}
add_action( 'add_meta_boxes', 'ideal_register_meta_boxes' );
 
/**
 * Meta box display callback.
 *
 * @param WP_Post $post Current post object.
 */
function ideal_display_metabox( $post ) {
    // Display code/markup goes here. Don't forget to include nonces!

    // Add a nonce field so we can check for it later.
    wp_nonce_field( 'ideal_select_sidebar_save_meta_box', 'ideal_select_sidebar_meta_box_nonce' );

    $ideal_sidebar_meta = get_post_meta( $post->ID, 'ideal-blog-select-sidebar', true );
	$choices = array( 
			'right' => esc_html__( 'Right', 'ideal-blog' ), 
			'no'    => esc_html__( 'No Sidebar', 'ideal-blog' ), 
		);

		foreach ( $choices as $value => $name ) : ?>
	    	<p>
	    		<label>
					<input value="<?php echo esc_attr( $value ); ?>" <?php checked( $ideal_sidebar_meta, $value, true ); ?> name="ideal-blog-select-sidebar" type="radio" />
					<?php echo esc_html( $name ); ?>
	    		</label>
			</p>	
		<?php endforeach; 

}
 
/**
 * Save meta box content.
 *
 * @param int $post_id Post ID
 */
function ideal_save_meta_box( $post_id ) {
    // Save logic goes here. Don't forget to include nonce checks!

    /*
     * We need to verify this came from our screen and with proper authorization,
     * because the save_post action can be triggered at other times.
     */

    // Check if our nonce is set.
    if ( ! isset( $_POST['ideal-blog-select-sidebar'] ) ) {
        return;
    }

    // Verify that the nonce is valid.
    if ( ! wp_verify_nonce( sanitize_key( $_POST['ideal_select_sidebar_meta_box_nonce'] ), 'ideal_select_sidebar_save_meta_box' ) ) {
        return;
    }

    // If this is an autosave, our form has not been submitted, so we don't want to do anything.
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    // Check the user's permissions.
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    /* OK, it's safe for us to save the data now. */
    
    // Make sure that it is set.
    if ( isset( $_POST['ideal-blog-select-sidebar'] ) ) {
        // Sanitize user input.
        $ideal_sidebar_meta = sanitize_text_field( wp_unslash( $_POST['ideal-blog-select-sidebar'] ) );
        // Update the meta field in the database.
        update_post_meta( $post_id, 'ideal-blog-select-sidebar', $ideal_sidebar_meta );
    }
}
add_action( 'save_post', 'ideal_save_meta_box' );


add_action( 'add_meta_boxes', 'ideal_image_add_metabox' );
function ideal_image_add_metabox () {
    add_meta_box( 'idealimagediv', __( 'Second Featured Image ', 'ideal-blog' ), 'ideal_image_metabox', 'post', 'side', 'low');
}

function ideal_image_metabox ( $post ) {
    global $content_width, $_wp_additional_image_sizes;

    $image_id = get_post_meta( $post->ID, '_ideal_image_id', true );

    $old_content_width = $content_width;
    $content_width = 254;

    if ( $image_id && get_post( $image_id ) ) {

        if ( ! isset( $_wp_additional_image_sizes['post-thumbnail'] ) ) {
            $thumbnail_html = wp_get_attachment_image( $image_id, array( $content_width, $content_width ) );
        } else {
            $thumbnail_html = wp_get_attachment_image( $image_id, 'post-thumbnail' );
        }

        if ( ! empty( $thumbnail_html ) ) {
            $content = $thumbnail_html;
            $content .= '<p class="hide-if-no-js"><a href="javascript:;" id="remove_ideal_image_button" >' . esc_html__( 'Remove Featured Image', 'ideal-blog' ) . '</a></p>';
            $content .= '<input type="hidden" id="upload_ideal_image" name="_ideal_cover_image" value="' . esc_attr( $image_id ) . '" />';
        }

        $content_width = $old_content_width;
    } else {

        $content = '<img src="" style="width:' . esc_attr( $content_width ) . 'px;height:auto;border:0;display:none;" />';
        $content .= '<p class="hide-if-no-js"><a title="' . esc_attr__( 'Set Featured Image', 'ideal-blog' ) . '" href="javascript:;" id="upload_ideal_image_button" id="set-ideal-image" data-uploader_title="' . esc_attr__( 'Choose an image', 'ideal-blog' ) . '" data-uploader_button_text="' . esc_attr__( 'Set Featured Image', 'ideal-blog' ) . '">' . esc_html__( 'Set Featured Image', 'ideal-blog' ) . '</a></p>';
        $content .= '<input type="hidden" id="upload_ideal_image" name="_ideal_cover_image" value="" />';

    }

    echo $content;
}

add_action( 'save_post', 'ideal_image_save', 10, 1 );
function ideal_image_save ( $post_id ) {
    if( isset( $_POST['_ideal_cover_image'] ) ) {
        $image_id = (int) $_POST['_ideal_cover_image'];
        update_post_meta( $post_id, '_ideal_image_id', $image_id );
    }
}
/**
* Enqueue admin scripts for Image Widget
* @since Ideal Blog 1.0
**/
function ideal_blog_image_upload_enqueue( $hook ) {

wp_enqueue_media();
wp_enqueue_script( 'ideal_blog-image-upload-script', get_template_directory_uri() . '/assets/js/image-upload.js', array( 'jquery' ), true );
}

add_action( 'admin_enqueue_scripts', 'ideal_blog_image_upload_enqueue' );