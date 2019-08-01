<?php
/**
 * The Minimal metabox.
 *
 *
 * @package The_Minimal
 */
 
 add_action('add_meta_boxes', 'the_minimal_add_sidebar_layout_box');

function the_minimal_add_sidebar_layout_box(){    
    add_meta_box(
                 'the_minimal_sidebar_layout', // $id
                 __('Sidebar Layout', 'the-minimal'), // $title
                 'the_minimal_sidebar_layout_callback', // $callback
                 'page', // $page
                 'normal', // $context
                 'high'); // $priority    
}

$the_minimal_sidebar_layout = array(         
        'right-sidebar' => array(
                        'value' => 'right-sidebar',
                        'label' => __( 'Right sidebar (default)', 'the-minimal' ),
                        'thumbnail' => get_template_directory_uri() . '/images/right-sidebar.png'
                    ),
        'no-sidebar' => array(
                        'value'     => 'no-sidebar',
                        'label'     => __( 'No sidebar', 'the-minimal' ),
                        'thumbnail' => get_template_directory_uri() . '/images/no-sidebar.png'
                    )   

    );

function the_minimal_sidebar_layout_callback(){
    global $post , $the_minimal_sidebar_layout;
    wp_nonce_field( basename( __FILE__ ), 'the_minimal_sidebar_layout_nonce' ); 
?>
<table class="form-table">
    <tr>
        <td colspan="4"><em class="f13"><?php _e('Choose Sidebar Template', 'the-minimal'); ?></em></td>
    </tr>

    <tr>
        <td>
        <?php  
            foreach( $the_minimal_sidebar_layout as $field ){  
                $layout = get_post_meta( $post->ID, 'the_minimal_sidebar_layout', true ); ?>

            <div class="radio-image-wrapper" style="float:left; margin-right:30px;">
                <label class="description">
                    <span><img src="<?php echo esc_url( $field['thumbnail'] ); ?>" alt="<?php echo esc_attr( $field['label']); ?>" /></span><br/>
                    <input type="radio" name="the_minimal_sidebar_layout" value="<?php echo esc_attr( $field['value'] ); ?>" <?php checked( $field['value'], $layout ); if( empty( $layout ) ){ checked( $field['value'], 'right-sidebar' ); }?>/>&nbsp;<?php echo esc_html( $field['label'] ); ?>
                </label>
            </div>
            <?php } // end foreach 
            ?>
            <div class="clear"></div>
        </td>
    </tr>
</table>
<?php        
}

/**
 * save the custom metabox data
 * @hooked to save_post hook
 */
function the_minimal_save_sidebar_layout( $post_id ) { 
    global $the_minimal_sidebar_layout, $post; 

    // Verify the nonce before proceeding.
    if ( !isset( $_POST[ 'the_minimal_sidebar_layout_nonce' ] ) || !wp_verify_nonce( $_POST[ 'the_minimal_sidebar_layout_nonce' ], basename( __FILE__ ) ) )
        return;

    // Stop WP from clearing custom fields on autosave
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE)  
        return;
        
    if ('page' == $_POST['post_type']) {  
        if (!current_user_can( 'edit_page', $post_id ) )  
            return $post_id;  
    } elseif (!current_user_can( 'edit_post', $post_id ) ) {  
            return $post_id;  
    }  
    

    foreach( $the_minimal_sidebar_layout as $field ){  
        //Execute this saving function
        $old = get_post_meta( $post_id, 'the_minimal_sidebar_layout', true ); 
        $new = sanitize_text_field( $_POST['the_minimal_sidebar_layout'] );
        if( $new && $new != $old) {  
            update_post_meta( $post_id, 'the_minimal_sidebar_layout', $new );  
        }elseif( '' == $new && $old ){  
            delete_post_meta( $post_id, 'the_minimal_sidebar_layout', $old );  
        } 
     } // end foreach   
     
}
add_action('save_post', 'the_minimal_save_sidebar_layout'); 