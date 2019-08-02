<?php

/*
 * Plugin Name: Max Mega Menu - StoreFront Integration
 * Plugin URI:  https://www.megamenu.com
 * Description: Integrates Max Mega Menu with the StoreFront theme.
 * Version:     1.0.3
 * Author:      megamenu.com
 * Author URI:  https://www.megamenu.com
 * License:     GPL-2.0+
 * Copyright:   2019 Tom Hemsley (https://www.megamenu.com)
 */

if ( ! function_exists( 'storefront_primary_navigation' ) ) {

    function storefront_primary_navigation() {
        if ( function_exists('max_mega_menu_is_enabled') && max_mega_menu_is_enabled('primary') ) {
            wp_nav_menu( array( 'theme_location' => 'primary' ) );
        } else {
            ?>
            <nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_html_e( 'Primary Navigation', 'storefront' ); ?>">
            <button class="menu-toggle" aria-controls="primary-navigation" aria-expanded="false"><?php echo esc_attr( apply_filters( 'storefront_menu_toggle_text', __( 'Menu', 'storefront' ) ) ); ?></button>
                <?php
                wp_nav_menu(
                    array(
                        'theme_location'    => 'primary',
                        'container_class'   => 'primary-navigation',
                        )
                );

                wp_nav_menu(
                    array(
                        'theme_location'    => 'handheld',
                        'container_class'   => 'handheld-navigation',
                        )
                );
                ?>
            </nav><!-- #site-navigation -->
            <?php
        }
    }

}

if ( ! function_exists( 'megamenu_storefront_css_and_js' ) ) {
   function megamenu_storefront_css_and_js() {
        if ( function_exists('max_mega_menu_is_enabled') && max_mega_menu_is_enabled('primary') ) {
            wp_enqueue_style('megamenu-storefront', plugin_dir_url( __FILE__ ) . 'megamenu-storefront.css', false, '1.0');
        }

        $theme = wp_get_theme( 'storefront' );
        $storefront_version = $theme['Version'];

        if ( version_compare($storefront_version, '2.2.6') >= 0 && version_compare($storefront_version, '2.4.3') <= 0 ) { // fixed in 2.4.4
            // The core StoreFront JavaScript prevents this JavaScript from running if the site-navigation ID does not exist on the page
            // Restore the functionality here instead.
            $footer_search_toggle = "(function($) {
                $('.storefront-handheld-footer-bar .search > a').on('click', function(e) {
                    e.preventDefault();
                    $(this).parent().toggleClass('active');
                });
            })( jQuery );";

            if ( function_exists( 'wp_add_inline_script' ) ) {
                wp_add_inline_script( 'megamenu', $footer_search_toggle );
            }
        }
    }
}

add_action( 'wp_enqueue_scripts', 'megamenu_storefront_css_and_js', 9999 );


if ( ! function_exists( 'megamenu_add_theme_storefront' ) ) {

    function megamenu_add_theme_storefront( $themes ) {
        $themes["storefront_1464904373"] = array(
            'title' => 'StoreFront',
            'container_background_from' => 'rgba(0, 0, 0, 0)',
            'container_background_to' => 'rgba(0, 0, 0, 0)',
            'arrow_up' => 'dash-f343',
            'arrow_down' => 'dash-f347',
            'arrow_left' => 'dash-f341',
            'arrow_right' => 'dash-f345',
            'menu_item_background_hover_from' => 'rgba(255, 255, 255, 0)',
            'menu_item_background_hover_to' => 'rgba(255, 255, 255, 0)',
            'menu_item_link_font_size' => '16px',
            'menu_item_link_height' => '77px',
            'menu_item_link_color' => 'rgb(213, 217, 219)',
            'menu_item_link_weight' => 'bold',
            'menu_item_link_color_hover' => 'rgb(255, 255, 255)',
            'menu_item_link_weight_hover' => 'bold',
            'menu_item_link_padding_left' => '15px',
            'menu_item_link_padding_right' => '15px',
            'menu_item_highlight_current' => 'on',
            'panel_background_from' => 'rgb(240, 240, 240)',
            'panel_background_to' => 'rgb(240, 240, 240)',
            'panel_width' => 'body',
            'panel_inner_width' => '.col-full',
            'panel_border_color' => 'rgb(51, 51, 51)',
            'panel_border_radius_bottom_left' => '3px',
            'panel_border_radius_bottom_right' => '3px',
            'panel_header_color' => 'rgb(97, 101, 107)',
            'panel_header_text_transform' => 'none',
            'panel_header_padding_bottom' => '0px',
            'panel_header_margin_bottom' => '5px',
            'panel_header_border_color' => 'rgb(191, 191, 191)',
            'panel_padding_top' => '10px',
            'panel_padding_bottom' => '10px',
            'panel_font_size' => '14px',
            'panel_font_color' => 'rgb(67, 69, 75)',
            'panel_font_family' => 'inherit',
            'panel_second_level_font_color' => 'rgb(97, 101, 107)',
            'panel_second_level_font_color_hover' => 'rgb(67, 69, 75)',
            'panel_second_level_text_transform' => 'none',
            'panel_second_level_font' => 'inherit',
            'panel_second_level_font_size' => '16px',
            'panel_second_level_font_weight' => 'bold',
            'panel_second_level_font_weight_hover' => 'bold',
            'panel_second_level_text_decoration' => 'none',
            'panel_second_level_text_decoration_hover' => 'none',
            'panel_second_level_margin_bottom' => '10px',
            'panel_second_level_border_color' => 'rgb(191, 191, 191)',
            'panel_third_level_font_color' => 'rgb(97, 101, 107)',
            'panel_third_level_font_color_hover' => 'rgb(67, 69, 75)',
            'panel_third_level_font' => 'inherit',
            'panel_third_level_font_size' => '15px',
            'flyout_width' => '200px',
            'flyout_menu_background_from' => 'rgb(240, 240, 240)',
            'flyout_menu_background_to' => 'rgb(240, 240, 240)',
            'flyout_link_padding_left' => '15px',
            'flyout_link_padding_right' => '0px',
            'flyout_link_height' => '45px',
            'flyout_background_from' => 'rgba(44, 45, 51, 0)',
            'flyout_background_to' => 'rgba(44, 45, 51, 0)',
            'flyout_background_hover_from' => 'rgba(255, 255, 255, 0.05)',
            'flyout_background_hover_to' => 'rgba(255, 255, 255, 0.05)',
            'flyout_link_size' => '15px',
            'flyout_link_color' => 'rgb(97, 101, 107)',
            'flyout_link_color_hover' => 'rgb(67, 69, 75)',
            'flyout_link_family' => 'inherit',
            'responsive_breakpoint' => '767px',
            'shadow' => 'on',
            'shadow_vertical' => '1px',
            'shadow_blur' => '4px',
            'shadow_color' => 'rgba(0, 0, 0, 0.15)',
            'transitions' => 'on',
            'resets' => 'off',
            'mobile_columns' => '1',
            'toggle_background_from' => 'rgba(44, 45, 51, 0)',
            'toggle_background_to' => 'rgba(44, 45, 51, 0)',
            'toggle_font_color' => 'rgb(213, 217, 219)',
            'custom_css' => '#{$wrap} #{$menu} > li.mega-menu-item > a.mega-menu-link:after {
    font-size: 0.8em;
    font-weight: normal;
}
#{$wrap} #{$menu} .product_list_widget li img {
    max-width: 2.618em;
}
@include mobile {
    #{$wrap} {
        clear: both;
    }
}',
        );
        return $themes;
    }

}

add_filter("megamenu_themes", "megamenu_add_theme_storefront");


/**
 * Ensure Max Mega Menu (free) is installed
 */
if ( ! function_exists( 'storefront_check_megamenu_is_installed' ) ) {

    function storefront_check_megamenu_is_installed() {

        $path = 'megamenu/megamenu.php';

        if ( is_plugin_active($path) ) {
            return;
        }

        $all_plugins = get_plugins();

        if ( isset( $all_plugins[$path] ) ) :

            $plugin = plugin_basename('megamenu/megamenu.php');

            $string = __( 'Max Mega Menu - StoreFront Integration requires Max Mega Menu. Please {activate} the Max Mega Menu plugin.', 'megamenu' );

            $link = '<a href="' . wp_nonce_url( 'plugins.php?action=activate&amp;plugin=' . $plugin . '&amp;plugin_status=all&amp;paged=1', 'activate-plugin_' . $plugin ) . '" class="edit">' . __( 'activate', 'megamenu' ) . '</a>';

        ?>

        <div class="updated">
            <p>
                <?php echo str_replace( "{activate}", $link, $string ); ?>
            </p>
        </div>

        <?php

        else:

        ?>
        <div class="updated">
            <p>
                <?php _e( 'Max Mega Menu - StoreFront Integration requires Max Mega Menu. Please install the Max Mega Menu plugin.', 'megamenu' ); ?>
            </p>
            <p class='submit'>
                <a href="<?php echo admin_url( "plugin-install.php?tab=search&type=term&s=max+mega+menu" ) ?>" class='button button-secondary'><?php _e("Install Max Mega Menu", "megamenupro"); ?></a>
            </p>
        </div>
        <?php

        endif;

    }
}

add_action("admin_notices", 'storefront_check_megamenu_is_installed' );


?>