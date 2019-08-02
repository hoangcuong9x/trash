<?php
/**
 * TC  WooCommerce Product Slider settings API
 *
 *
 */
if ( !class_exists('TC_wooslider_Settings' ) ):
class TC_wooslider_Settings {

    private $settings_api;

    function __construct() {
        $this->settings_api = new themesCode_Settings_API;

        add_action( 'admin_init', array($this, 'admin_init') );
        add_action( 'admin_menu', array($this,'tc_menu_page'));
    }

    function admin_init() {

        //set the settings
        $this->settings_api->set_sections( $this->get_settings_sections() );
        $this->settings_api->set_fields( $this->get_settings_fields() );

        //initialize settings
        $this->settings_api->admin_init();
    }

    function tc_menu_page(){
    add_menu_page(
        __( 'TC Plugin', 'textdomain' ),
        'TC WPS',
        'manage_options',
        'tc-whooslider',
        array($this, 'plugin_page'),

        plugins_url( 'tc-woocommerce-product-slider/assets/images/icon.png' ),
        6
    );
}



    function my_custom_submenu_page_callback() {

        echo '<div class="wrap"><div id="icon-tools" class="icon32"></div>';
            echo '<h2>My Custom Submenu Page</h2>';
        echo '</div>';

    }

    function get_settings_sections() {
        $sections = array(
            array(
                'id' => 'tc_whooslider_basics',
                'title' => __( 'Basic Settings', 'tc-wps' )
            ),
            array(
                'id' => 'tc_whooslider_advanced',
                'title' => __( 'Advanced Settings', 'tc-wps' )
            ),
            array(
                'id' => 'tc_whooslider_showhide',
                'title' => __( 'Show/Hide', 'tc-wps' )
            ),
            array(
                'id' => 'tc_whooslider_styling',
                'title' => __( 'Styling Settings', 'tc-wps' )
            )
        );
        return $sections;
    }

    /**
     * Returns all the settings fields
     *
     * @return array settings fields
     */
    function get_settings_fields() {
        $settings_fields = array(
          'tc_whooslider_basics' => array(

            array(
                'name'    => 'auto-play',
                'label'   => __( 'Auto Play', 'tcwps' ),
                'desc'    => __( 'By default  Auto Play is active.', 'tcwps' ),
                'type'    => 'select',
                'default' => 'true',
                'options' => array(
                    'true' => 'Yes',
                    'false'  => 'No'
                )
            ),
            array(
                  'name'    => 'auto_play_timeout',
                  'label'   => __( 'Auto Play Timeout', 'owl-carousel-wp' ),
                  'desc'    => __( 'Set autoplay Timeout', 'owl-carousel-wp' ),
                  'type'              => 'text',
                  'default'           => 5000,
                  'sanitize_callback' => 'intval'
              ),
            array(
                'name'    => 'stop-onhover',
                'label'   => __( 'Stop On Hover', 'tcwps' ),
                'desc'    => __( 'By default  Auto Play is active.', 'tcwps' ),
                'type'    => 'select',
                'default' => 'true',
                'options' => array(
                    'true' => 'Yes',
                    'false'  => 'No'
                )
            ),
            array(
                'name'    => 'loop',
                'label'   => __( 'Carousel Loop', 'tcwps' ),
                'type'    => 'radio',
                'default' => 'true',
                'options' => array(
                    'true' => 'Yes',
                    'false'  => 'No'
                )
            ),
            array(
                'name'              => 'large-item-val',
                'label'             => __( 'Items Number ( Lg Screen )', 'tcwps' ),
                'desc'              => __( 'Any Numaric value. 4 is recomended.', 'tcwps' ),
                'type'              => 'number',
                'default'           => 4,
                'sanitize_callback' => 'intval'
            ),
            array(
                'name'              => 'items-desktop-val',
                'label'             => __( 'Items Number ( Desktop )', 'tcwps' ),
                'desc'              => __( 'Any Numaric value. 4 is recomended', 'tcwps' ),
                'type'              => 'number',
                'default'           => 4,
                'sanitize_callback' => 'intval'
            ),
            array(
                'name'              => 'items-tablet-val',
                'label'             => __( 'Items Number ( Tablet )', 'tcwps' ),
                'desc'              => __( 'Any Numaric value. 3 is recomended', 'tcwps' ),
                'type'              => 'number',
                'default'           => 3,
                'sanitize_callback' => 'intval'
            ),
            array(
                'name'              => 'items-mobile-val',
                'label'             => __( 'Items Number (SmartPhone)', 'tcwps' ),
                'desc'              => __( 'Any Numaric value. 2 is recomended', 'tcwps' ),
                'type'              => 'number',
                'default'           => 2,
                'sanitize_callback' => 'intval'
            )


          ),
          'tc_whooslider_advanced' => array(

              array(
                  'name'    => 'dots-val',
                  'label'   => __( 'Enable Dots', 'tcwps' ),
                  'desc'    => __( 'Enable Dots below the Carousel', 'tcwps' ),
                  'type'    => 'select',
                  'default' => 'true',
                  'options' => array(
                      'true' => 'Yes',
                      'false'  => 'No'
                  )
              ),
              array(
                  'name'    => 'nav-val',
                  'label'   => __( 'Navigation ', 'tcwps' ),
                  'desc'    => __( 'Show Navigation on Top Right', 'tcwps' ),
                  'type'    => 'select',
                  'default' => 'true',
                  'options' => array(
                      'true' => 'Yes',
                      'false'  => 'No'
                  )
              ),
              array(
                  'name'    => 'autoheight',
                  'label'   => __( 'Auto Height', 'tcwps' ),
                  'desc'    => __( 'Auto Height for Product Images', 'tcwps' ),
                  'type'    => 'select',
                  'default' => 'false',
                  'options' => array(
                      'true' => 'Yes',
                      'false'  => 'No'
                  )
              ),
              array(
                  'name'    => 'sd_word_n',
                  'label'   => __( 'Words Limit', 'tcwps' ),
                  'desc'    => __( 'Short Description Words Limit on Hover Overlay', 'tcwps' ),
                  'type'    => 'text',
                  'default' =>10,
              ),



          ),
          'tc_whooslider_showhide' => array(

              array(
                  'name'    => 'hide_sd',
                  'label'   => __( 'Hide Short Desscription', 'tcwps' ),
                  'desc'    => __( '', 'tcwps' ),
                  'type'    => 'radio',
                  'default' => 'false',
                  'options' => array(
                      'true' => 'Yes',
                      'false'  => 'No'
                  )
              ),

              array(
                  'name'    => 'hide_start',
                  'label'   => __( 'Hide Star Rating', 'tcwps' ),
                  'desc'    => __( '', 'tcwps' ),
                  'type'    => 'radio',
                  'default' => 'false',
                  'options' => array(
                      'true' => 'Yes',
                      'false'  => 'No'
                  )
              ),

              array(
                  'name'    => 'hide_border',
                  'label'   => __( 'Hide Border', 'tcwps' ),
                  'desc'    => __( '', 'tcwps' ),
                  'type'    => 'radio',
                  'default' => 'false',
                  'options' => array(
                      'true' => 'Yes',
                      'false'  => 'No'
                  )
              ),

            ),

          'tc_whooslider_styling' => array(

            array(
                  'name'    => 'overlay-color',
                  'label'   => __( 'Overlay Color', 'tc-wps' ),
                  'desc'    => __( 'Overlay background Color on hover', 'tc-wps' ),
                  'type'    => 'color',
                  'default' => '#2CC990'
              ),

            array(
                  'name'    => 'nav-color',
                  'label'   => __( 'Navigation Color', 'tc-wps' ),
                  'desc'    => __( 'Navigation background Color', 'tc-wps' ),
                  'type'    => 'color',
                  'default' => '#27AE60'
              ),
              array(
                    'name'    => 'nav-h-color',
                    'label'   => __( 'Navigation Hover Color', 'tc-wps' ),
                    'desc'    => __( 'Navigation background Hover Color', 'tc-wps' ),
                    'type'    => 'color',
                    'default' => '#66CC99'
                ),

              array(
                  'name'    => 'dots-color',
                  'label'   => __( 'Dots Color', 'tc-wps' ),
                  'desc'    => __( 'Dots Color', 'tc-wps' ),
                  'type'    => 'color',
                  'default' => '#27AE60'
              ),
              array(
                  'name'    => 'dots-h-color',
                  'label'   => __( 'Dots hover Color', 'tc-wps' ),
                  'desc'    => __( 'Dots hover Color', 'tc-wps' ),
                  'type'    => 'color',
                  'default' => '#66CC99'
              ),
              array(
                  'name'    => 'cart-button-color',
                  'label'   => __( 'Cart Button', 'tc-wps' ),
                  'desc'    => __( 'Add To Cart Button Color.', 'tc-wps' ),
                  'type'    => 'color',
                  'default' => '#ffffff'
              ),
              array(
                  'name'    => 'cart-button-color-hover',
                  'label'   => __( 'Cart Button Hover', 'tc-wps' ),
                  'desc'    => __( 'Title Color for style 4', 'tc-wps' ),
                  'type'    => 'color',
                  'default' => '#dd3333'
              ),
              array(
                  'name'    => 'pirce-text',
                  'label'   => __( 'Pirce Text', 'tc-wps' ),
                  'desc'    => __( 'Pirce Text Color ', 'tc-wps' ),
                  'type'    => 'color',
                  'default' => '#343434'
              ),
              array(
                  'name'    => 'pirce-text-hover',
                  'label'   => __( 'Pirce Text Hover', 'tc-wps' ),
                  'desc'    => __( 'Pirce Text Hover Color', 'tc-wps' ),
                  'type'    => 'color',
                  'default' => '#dd3333'
              ),

              array(
                  'name'    => 'overlay-title',
                  'label'   => __('Overlay Title', 'tc-wps' ),
                  'desc'    => __('Overlay Title Color', 'tc-wps' ),
                  'type'    => 'color',
                  'default' => '#fff'
              ),
              array(
                  'name'    => 'overlay-title-hover',
                  'label'   => __('Overlay Title Hover', 'tc-wps' ),
                  'desc'    => __('Overlay Title Hover Color', 'tc-wps' ),
                  'type'    => 'color',
                  'default' => '#dd3333'
              ),
              array(
                  'name'    => 'title-color',
                  'label'   => __('Title Color', 'tc-wps' ),
                  'desc'    => __('Title Color', 'tc-wps' ),
                  'type'    => 'color',
                  'default' => '#383838'
              ),
              array(
                  'name'    => 'title-hover-color',
                  'label'   => __('Title Hover Color', 'tc-wps' ),
                  'desc'    => __('Title Hover Color', 'tc-wps' ),
                  'type'    => 'color',
                  'default' => '#848484'
              )
            )

        );

        return $settings_fields;
    }

    function plugin_page() {
        echo '<div class="wrap-setting-tc-wooslider">';
            echo '<div class="tcwps-setting">';
        $this->settings_api->show_navigation();
        $this->settings_api->show_forms();
            echo '</div>';

        ?>
        <div class="tcwps-info-wrap">

          <div class="tcwps-info-box">
        <h3 class="tcwps-info-box-title"> Upgrade To Pro </h1>
          <ul class="pro-features-box">
            <li> <span class="dashicons dashicons-yes"></span>7 Different Navigation Style and Position.</li>
            <li> <span class="dashicons dashicons-yes"></span> Different Layout Styles.</li>
        		<li> <span class="dashicons dashicons-yes"></span> Better and Quicker support.</li>
            <li> <span class="dashicons dashicons-yes"></span> 5 Nice Image Hover Effects.</li>
            <li> <span class="dashicons dashicons-yes"></span> Shortcodes Generator.</li>
            <li> <span class="dashicons dashicons-yes"></span> Quick view / Lightbox effect available.</li>
            <li> <span class="dashicons dashicons-yes"></span> Advance settings panel with all necessary options.</li>


            <li> <span class="dashicons dashicons-yes"></span> Carousel for Recent/Latest Products.</li>
            <li> <span class="dashicons dashicons-yes"></span> Carousel for Featured Products.</li>

            <li> <span class="dashicons dashicons-yes"></span> Show Carousel from one or more specific products categories.</li>
            <li> <span class="dashicons dashicons-yes"></span> Show Carousel from On Sale Product.</li>

            <li> <span class="dashicons dashicons-yes"></span> Carousel for Recent/Latest Products.</li>


            <li> <span class="dashicons dashicons-yes"></span> Support within 6 hours.</li>
            <li> <span class="dashicons dashicons-yes"></span> Unlimited Color changing option for Quick view Button.</li>

            <li> <span class="dashicons dashicons-yes"></span> Unlimited Color changing option for Product Titles..</li>
            <li> <span class="dashicons dashicons-yes"></span> Unlimited Color changing option for Add To Cart Button.</li>
            <li> <span class="dashicons dashicons-yes"></span> changeable Navigation and Pagination color.</li>

            <li> <span class="dashicons dashicons-yes"></span> And many more.</li>
          </ul>
          <a class="tc-button tc-btn-red" href="https://www.themescode.com/items/tc-woocommerce-product-slider-pro/" target="_blank">Go Pro!</a>

        </div>

        <div class="tcwps-info-box">
      <h3 class="tcwps-info-box-title"> Social Networks </h1>
        <ul class="pro-features">
        <li><a class="" href="https://www.facebook.com/themescode.official/" target="_blank">Facebook</a></li>
        <li><a class="" href="https://twitter.com/themescode" target="_blank">Twitter</a></li>
        <li><a class="" href="http://www.youtube.com/c/Themescode" target="_blank">Youtube</a></li>
        <li><a class="" href="http://www.youtube.com/c/Wpbrim " target="_blank">Learn WordPress</a></li>

      </ul>
      <p>Thanks</p>
      </div>

        </div>
    <?php
    echo '</div>';
    }

    /**
     * Get all the pages
     *
     * @return array page names with key value pairs
     */
    function get_pages() {
        $pages = get_pages();
        $pages_options = array();
        if ( $pages ) {
            foreach ($pages as $page) {
                $pages_options[$page->ID] = $page->post_title;
            }
        }

        return $pages_options;
    }

}
endif;
