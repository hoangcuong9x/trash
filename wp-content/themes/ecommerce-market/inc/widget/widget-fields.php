<?php 
/**
 * Field for Widget
 *
 * @package eCommerce_Market
 */

function ecommerce_market_widgets_show_widget_field($instance = '', $widget_field = '', $ecommerce_market_field_value = '') {
   
    /**
     * Category list in array
    **/
    $ecommerce_market_category_list[0] = array(
        'value' => 0,
        'label' => esc_html__('Select Categories','ecommerce-market')
    );
    $ecommerce_market_posts = get_categories();
    foreach ($ecommerce_market_posts as $ecommerce_market_post) :
        $ecommerce_market_category_list[$ecommerce_market_post->term_id] = array(
            'value' => $ecommerce_market_post->term_id,
            'label' => $ecommerce_market_post->name
        );
    endforeach;
    
    
    /**
     * Default Page List in array
    */
    $ecommerce_market_pagelist[0] = array(
        'value' => 0,
        'label' => esc_html__('Select Pages','ecommerce-market')
    );
    $arg = array('posts_per_page' => -1);
    $ecommerce_market_pages = get_pages($arg);
    foreach ($ecommerce_market_pages as $ecommerce_market_page) :
        $ecommerce_market_pagelist[$ecommerce_market_page->ID] = array(
            'value' => $ecommerce_market_page->ID,
            'label' => $ecommerce_market_page->post_title
        );
    endforeach;


    extract($widget_field);

    switch ($ecommerce_market_widgets_field_type) {

        /**
         * Standard text field area
        **/
        case 'text' :
            ?>
            <p>
                <label for="<?php echo esc_attr($instance->get_field_id($ecommerce_market_widgets_name)); ?>"><?php echo esc_html($ecommerce_market_widgets_title); ?> :</label>
                <input class="widefat" id="<?php echo esc_attr($instance->get_field_id($ecommerce_market_widgets_name)); ?>" name="<?php echo esc_attr($instance->get_field_name($ecommerce_market_widgets_name)); ?>" type="text" value="<?php echo esc_attr($ecommerce_market_field_value) ; ?>" />

                <?php if (isset($ecommerce_market_widgets_description)) { ?>
                    <br />
                    <small><?php echo esc_html($ecommerce_market_widgets_description); ?></small>
                <?php } ?>
            </p>
            <?php
            break;

        /**
         * Standard title field area
        **/   
        case 'title' :
            ?>
            <p>
                <label for="<?php echo esc_attr($instance->get_field_id($ecommerce_market_widgets_name)); ?>"><?php echo esc_html($ecommerce_market_widgets_title); ?> :</label>
                <input class="widefat" id="<?php echo esc_attr($instance->get_field_id($ecommerce_market_widgets_name)); ?>" name="<?php echo esc_attr($instance->get_field_name($ecommerce_market_widgets_name)); ?>" type="text" value="<?php echo esc_attr($ecommerce_market_field_value) ; ?>" />
                <?php if (isset($ecommerce_market_widgets_description)) { ?>
                    <br />
                    <small><?php echo esc_html($ecommerce_market_widgets_description); ?></small>
                <?php } ?>
            </p>
            <?php
            break;

        case 'group_start' :
            ?>
            <div class="ecommerce_market-main-group" id="ap-font-awesome-list <?php echo esc_attr($instance->get_field_id( $ecommerce_market_widgets_name )); ?>">
                <div class="ecommerce_market-main-group-heading" style="font-size: 15px;  font-weight: bold;  padding-top: 12px;"><?php echo esc_html($ecommerce_market_widgets_title) ; ?><span class="toogle-arrow"></span></div>
                <div class="ecommerce_market-main-group-wrap">
            <?php
            break;

            case 'group_end':
            ?></div>
            </div><?php
            break;

        /**
         * Standard url field area
        **/
        case 'url' :
            ?>
            <p>
                <label for="<?php echo esc_attr($instance->get_field_id($ecommerce_market_widgets_name)); ?>"><?php echo esc_html($ecommerce_market_widgets_title); ?> :</label>
                <input class="widefat" id="<?php echo esc_attr($instance->get_field_id($ecommerce_market_widgets_name)); ?>" name="<?php echo esc_attr($instance->get_field_name($ecommerce_market_widgets_name)); ?>" type="text" value="<?php echo esc_attr($ecommerce_market_field_value); ?>" />

                <?php if (isset($ecommerce_market_widgets_description)) { ?>
                    <br />
                    <small><?php echo esc_url($ecommerce_market_widgets_description); ?></small>
                <?php } ?>
            </p>
            <?php
            break;

        /**
         * Standard textarea field area
        **/
        case 'textarea' :
            ?>
            <p>
                <label for="<?php echo esc_attr($instance->get_field_id($ecommerce_market_widgets_name)); ?>"><?php echo esc_html($ecommerce_market_widgets_title); ?> :</label>
                <textarea class="widefat" rows="<?php echo esc_attr($ecommerce_market_widgets_row); ?>" id="<?php echo esc_attr($instance->get_field_id($ecommerce_market_widgets_name)); ?>" name="<?php echo esc_attr($instance->get_field_name($ecommerce_market_widgets_name)); ?>"><?php echo wp_kses_post($ecommerce_market_field_value); ?></textarea>
            </p>
            <?php
            break;
        
        /**
         * Standard checkbox field area
        **/
        case 'checkbox' :
            ?>
            <p>
                <input id="<?php echo esc_attr($instance->get_field_id($ecommerce_market_widgets_name)); ?>" name="<?php echo esc_attr($instance->get_field_name($ecommerce_market_widgets_name)); ?>" type="checkbox" value="1" <?php checked('1', $ecommerce_market_field_value); ?>/>
                <label for="<?php echo esc_attr($instance->get_field_id($ecommerce_market_widgets_name)); ?>"><?php echo esc_html($ecommerce_market_widgets_title); ?> </label>

                <?php if (isset($ecommerce_market_widgets_description)) { ?>
                    <br />
                    <small><?php echo wp_kses_post($ecommerce_market_widgets_description); ?></small>
                <?php } ?>
            </p>
            <?php
            break;

        /**
         * Standard radio field area
        **/
        case 'radio' :
            ?>
            <p>
                <?php
                echo esc_html($ecommerce_market_widgets_title);
                echo '<br />';
                foreach ($ecommerce_market_widgets_field_options as $ecommerce_market_option_name => $ecommerce_market_option_title) {
                    ?>
                    <input id="<?php echo esc_attr($instance->get_field_id($ecommerce_market_option_name)); ?>" name="<?php echo esc_attr($instance->get_field_name($ecommerce_market_widgets_name)); ?>" type="radio" value="<?php echo esc_attr($ecommerce_market_option_name); ?>" <?php checked($ecommerce_market_option_name, $ecommerce_market_field_value); ?> />
                    <label for="<?php echo esc_attr($instance->get_field_id($ecommerce_market_option_name)); ?>"><?php echo esc_html($ecommerce_market_option_title); ?></label>
                    <br />
                <?php } ?>
                <?php if (isset($ecommerce_market_widgets_description)) { ?>
                    <small><?php echo esc_html($ecommerce_market_widgets_description); ?></small>
                <?php } ?>
            </p>
            <?php
            break;

        /**
         * Standard select field area
        **/
        case 'select' :
            ?>
            <p>
                <label for="<?php echo esc_attr($instance->get_field_id($ecommerce_market_widgets_name)); ?>"><?php echo esc_html($ecommerce_market_widgets_title); ?> :</label>
                <select name="<?php echo esc_attr($instance->get_field_name($ecommerce_market_widgets_name)); ?>" id="<?php echo esc_attr($instance->get_field_id($ecommerce_market_widgets_name)); ?>" class="widefat">
                    <?php foreach ($ecommerce_market_widgets_field_options as $ecommerce_market_option_name => $ecommerce_market_option_title) { ?>
                        <option value="<?php echo esc_attr($ecommerce_market_option_name); ?>" id="<?php echo esc_attr($instance->get_field_id($ecommerce_market_option_name)); ?>" <?php selected($ecommerce_market_option_name, $ecommerce_market_field_value); ?>><?php echo esc_html($ecommerce_market_option_title); ?></option>
                    <?php } ?>
                </select>

                <?php if (isset($ecommerce_market_widgets_description)) { ?>
                    <br />
                    <small><?php echo esc_html($ecommerce_market_widgets_description); ?></small>
                <?php } ?>
            </p>
            <?php
            break;
        
        /**
         * Standard select pages field area
        **/
        case 'selectpage' :
            ?>
            <p>
                <label for="<?php echo esc_attr($instance->get_field_id($ecommerce_market_widgets_name)); ?>"><?php echo esc_html($ecommerce_market_widgets_title); ?>:</label>
                <select name="<?php echo esc_attr($instance->get_field_name($ecommerce_market_widgets_name)); ?>" id="<?php echo esc_attr($instance->get_field_id($ecommerce_market_widgets_name)); ?>" class="widefat">
                    <?php foreach ($ecommerce_market_pagelist as $ecommerce_market_page) { ?>
                        <option value="<?php echo esc_attr($ecommerce_market_page['value']); ?>" id="<?php echo esc_attr($instance->get_field_id($ecommerce_market_page['label'])); ?>" <?php selected($ecommerce_market_page['value'], $ecommerce_market_field_value); ?>><?php echo esc_html($ecommerce_market_page['label']); ?></option>
                    <?php } ?>
                </select>

                <?php if (isset($ecommerce_market_widgets_description)) { ?>
                    <br />
                    <small><?php echo esc_html($ecommerce_market_widgets_description); ?></small>
                <?php } ?>
            </p>
            <?php
            break;

        /**
         * Standard number field area
        **/        
        case 'number' :
            ?>
            <p>
                <label for="<?php echo esc_attr($instance->get_field_id($ecommerce_market_widgets_name)); ?>"><?php echo esc_attr($ecommerce_market_widgets_title); ?> :</label><br />
                <input name="<?php echo esc_attr($instance->get_field_name($ecommerce_market_widgets_name)); ?>" type="number" step="4" min="4" id="<?php echo esc_attr($instance->get_field_id($ecommerce_market_widgets_name)); ?>" value="<?php  echo esc_attr($ecommerce_market_field_value); ?>" class="widefat" />

                <?php if (isset($ecommerce_market_widgets_description)) { ?>
                    <br />
                    <small><?php echo esc_html($ecommerce_market_widgets_description); ?></small>
                <?php } ?>
            </p>
            <?php
            break;



        /**
         * Standard multi checkboxes category field area
        **/
        case 'multicheckcategory' :
            
            if( isset( $ecommerce_market_mulicheckbox_title ) ) { ?>
                <label><?php echo esc_attr( $ecommerce_market_mulicheckbox_title ); ?> :</label>
            <?php }
            echo '<div class="ecommerce-market-multiplecat">';
                foreach ( $ecommerce_market_widgets_field_options as $ecommerce_market_option_name => $ecommerce_market_option_title) {
                    if( isset( $ecommerce_market_field_value[$ecommerce_market_option_name] ) ) {
                        $ecommerce_market_field_value[$ecommerce_market_option_name] = 1;
                    }else{
                        $ecommerce_market_field_value[$ecommerce_market_option_name] = 0;
                    }                
                ?>
                    <p>
                        <input id="<?php echo esc_attr($instance->get_field_id($ecommerce_market_widgets_name)); ?>" name="<?php echo esc_attr($instance->get_field_name($ecommerce_market_widgets_name)).'['.$ecommerce_market_option_name.']'; ?>" type="checkbox" value="1" <?php checked('1', $ecommerce_market_field_value[$ecommerce_market_option_name]); ?>/>
                        <label for="<?php echo esc_attr($instance->get_field_id($ecommerce_market_option_name)); ?>"><?php echo esc_html($ecommerce_market_option_title); ?></label>
                    </p>
                <?php
                    }
            echo '</div>';
                if (isset($ecommerce_market_widgets_description)) {
            ?>
                    <small><?php echo esc_html($ecommerce_market_widgets_description); ?></small>
            <?php
                }            
            break;

        /**
         * Standard upload category field area
        **/
        case 'upload' :
            $output = '';
            $id = esc_attr($instance->get_field_id($ecommerce_market_widgets_name));
            $class = '';
            $int = '';
            $value = $ecommerce_market_field_value;
            $name = esc_attr($instance->get_field_name($ecommerce_market_widgets_name));

            if ($value) {
                $class = 'has-file';
            }
            $output .= '<div class="sub-option section widget-upload">';
            $output .= '<label for="'.esc_attr($instance->get_field_id($ecommerce_market_widgets_name)).'">'.esc_html($ecommerce_market_widgets_title).'</label><br/>';
            $output .= '<input id="' . $id . '" class="upload' . $class . '" type="text" name="' . $name . '" value="' . $value . '" placeholder="' . esc_html__('No file chosen', 'ecommerce-market') . '" />' . "\n";
            
            if (function_exists('wp_enqueue_media')) {
                if (( $value == '')) {
                    $output .= '<input id="upload-' . $id . '" class="upload-button-wdgt button" type="button" value="' . esc_html__('Upload', 'ecommerce-market') . '" />' . "\n";
                } else {
                    $output .= '<input id="remove-' . $id . '" class="remove-file button" type="button" value="' . esc_html__('Remove', 'ecommerce-market') . '" />' . "\n";
                }
            } else {
                $output .= '<p><i>' . esc_html__('Upgrade your version of WordPress for full media support.', 'ecommerce-market') . '</i></p>';
            }

            $output .= '<div class="screenshot team-thumb" id="' . $id . '-image">' . "\n";
            if ($value != '') {
                $remove = '<a class="remove-image">Remove</a>';
                $image = preg_match('/(^.*\.jpg|jpeg|png|gif|ico*)/i', $value);
                if ($image) {
                    $output .= '<img src="' . $value . '" alt="" />' . $remove;
                } else {
                    $parts = explode("/", $value);
                    for ($i = 0; $i < sizeof($parts); ++$i) {
                        $title = $parts[$i];
                    }
                    $output .= '';
                    $title = esc_html__('View File', 'ecommerce-market');
                    $output .= '<div class="no-image"><span class="file_link"><a href="' . $value . '" target="_blank" rel="external">' . $title . '</a></span></div>';
                }
            }
            $output .= '</div></div>' . "\n";
            echo $output;
            break;
    }
}

function ecommerce_market_widgets_updated_field_value($widget_field, $new_field_value) {

    extract($widget_field);

    if ($ecommerce_market_widgets_field_type == 'number') {

        return absint($new_field_value);

    } elseif ($ecommerce_market_widgets_field_type == 'multicheckcategory') {

        return wp_kses_post($new_field_value);
    }
    else {

        return wp_kses_data($new_field_value);

    }
}


