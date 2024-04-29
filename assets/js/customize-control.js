/**
 * Scripts within the customizer controls window.
 *
 * Contextually shows the color hue control and informs the preview
 * when users open or close the front page sections section.
 */

(function( $, api ) {
    wp.customize.bind('ready', function() {
    	// Show message on change.
        var ideal_blog_settings = ['ideal_blog_slider_num', 'ideal_blog_latest_num', 'ideal_blog_services_num', 'ideal_blogjects_num', 'ideal_blog_testimonial_num', 'ideal_blog_blog_section_num', 'ideal_blog_reset_settings', 'ideal_blog_testimonial_num', 'ideal_blog_partner_num'];
        _.each( ideal_blog_settings, function( ideal_blog_setting ) {
            wp.customize( ideal_blog_setting, function( setting ) {
                var blogRiderNotice = function( value ) {
                    var name = 'needs_refresh';
                    if ( value && ideal_blog_setting == 'ideal_blog_reset_settings' ) {
                        setting.notifications.add( 'needs_refresh', new wp.customize.Notification(
                            name,
                            {
                                type: 'warning',
                                message: localized_data.reset_msg,
                            }
                        ) );
                    } else if( value ){
                        setting.notifications.add( 'reset_name', new wp.customize.Notification(
                            name,
                            {
                                type: 'info',
                                message: localized_data.refresh_msg,
                            }
                        ) );
                    } else {
                        setting.notifications.remove( name );
                    }
                };

                setting.bind( blogRiderNotice );
            });
        });

        /* === Radio Image Control === */
        api.controlConstructor['radio-color'] = api.Control.extend( {
            ready: function() {
                var control = this;

                $( 'input:radio', control.container ).change(
                    function() {
                        control.setting.set( $( this ).val() );
                    }
                );
            }
        } );

        

        // Sortable sections
        jQuery( "body" ).on( 'hover', '.ideal-blog-drag-handle', function() {
            jQuery( 'ul.ideal-blog-sortable-list' ).sortable({
                handle: '.ideal-blog-drag-handle',
                axis: 'y',
                update: function( e, ui ){
                    jQuery('input.ideal-blog-sortable-input').trigger( 'change' );
                }
            });
        });

        /* On changing the value. */
        jQuery( "body" ).on( 'change', 'input.ideal-blog-sortable-input', function() {
            /* Get the value, and convert to string. */
            this_checkboxes_values = jQuery( this ).parents( 'ul.ideal-blog-sortable-list' ).find( 'input.ideal-blog-sortable-input' ).map( function() {
                return this.value;
            }).get().join( ',' );

            /* Add the value to hidden input. */
            jQuery( this ).parents( 'ul.ideal-blog-sortable-list' ).find( 'input.ideal-blog-sortable-value' ).val( this_checkboxes_values ).trigger( 'change' );

        });

        // Deep linking for counter section to about section.
        jQuery('.ideal-blog-edit').click(function(e) {
            e.preventDefault();
            var jump_to = jQuery(this).attr( 'data-jump' );
            wp.customize.section( jump_to ).focus()
        });

        wp.customize.bind('ready', function() {
            jQuery('a[data-open="ideal-blog-recent-posts"]').click(function(e) {
                e.preventDefault();
                wp.customize.section( 'sidebar-widgets-homepage-sidebar' ).focus()
            });
        });
        
    });
})( jQuery, wp.customize );
