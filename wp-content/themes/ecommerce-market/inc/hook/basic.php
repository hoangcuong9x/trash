<?php 
/**
 * Basic Theme Function
 *
 * This file contains hook functions attached to core hooks.
 *
 * @package eCommerce_Market
 */
if ( ! function_exists( 'ecommerce_market_is_woocommerce_active' ) ) :

	/**
	 * Check if WooCommerce is active.
	 *
	 * @since 1.0.0
	 *
	 * @return bool Active status.
	 */
	function ecommerce_market_is_woocommerce_active() {
		$output = false;

		if ( class_exists( 'WooCommerce' ) ) {
			$output = true;
		}

		return $output;
	}

endif;

if ( ! class_exists( 'WP_Customize_Control' ) )
  return NULL;

/**
 * Class Ecommerce_Market_Dropdown_Taxonomies_Control
 */
class Ecommerce_Market_Dropdown_Taxonomies_Control extends WP_Customize_Control {

    /**
     * Render the control's content.
     *
     * @since 1.0.0
     */
    public function render_content() {
        $dropdown = wp_dropdown_categories(
            array(
                'name'              => 'ecommerce-market-dropdown-categories-' . $this->id,
                'echo'              => 0,
                'show_option_none'  => __( '&mdash; Select &mdash;', 'ecommerce-market' ),
                'option_none_value' => '0',
                'selected'          => $this->value(),
                'hide_empty'        => 0,                   

            )
        ); 
        
        $dropdown = str_replace( '<select', '<select ' . $this->get_link(), $dropdown );

        printf(
            '<label class="customize-control-select"><span class="customize-control-title">%s</span> %s <span class="description customize-control-description"></span>%s </label>',
            esc_html($this->label),
            esc_html($this->description),
            $dropdown

        );
    }

}
/**
 * Class Ecommerce_Market_Dropdown_Product_Taxonomies_Control
 */
class Ecommerce_Market_Dropdown_Product_Taxonomies_Control extends WP_Customize_Control {

    /**
     * Render the control's content.
     *
     * @since 1.0.0
     */
    public function render_content() {
        $dropdown = wp_dropdown_categories(
            array(
                'name'              => 'ecommerce-market-dropdown-categories-' . $this->id,
                'echo'              => 0,
                'show_option_none'  => __( '&mdash; Select &mdash;', 'ecommerce-market' ),
                'option_none_value' => '0',
                'selected'          => $this->value(),
                'hide_empty'        => 0,
                'taxonomy'          => 'product_cat'                  

            )
        ); 
        
        $dropdown = str_replace( '<select', '<select ' . $this->get_link(), $dropdown );

        printf(
            '<label class="customize-control-select"><span class="customize-control-title">%s</span> %s <span class="description customize-control-description"></span>%s </label>',
            esc_html($this->label),
            esc_html($this->description),
            $dropdown

        );
    }

}

//  Customizer Control
if (class_exists('WP_Customize_Control') && ! class_exists( 'Ecommerce_Market_Image_Radio_Control' ) ) {
    /**
    * Customize sidebar layout control.
    */
    class Ecommerce_Market_Image_Radio_Control extends WP_Customize_Control {

        public function render_content() {

            if (empty($this->choices))
                return;

            $name = '_customize-radio-' . $this->id;
            ?>
            <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
            <ul class="controls" id='ecommerce-market-img-container'>
                <?php
                foreach ($this->choices as $value => $label) :
                    $class = ($this->value() == $value) ? 'ecommerce-market-radio-img-selected ecommerce-market-radio-img-img' : 'ecommerce-market-radio-img-img';
                    ?>
                    <li style="display: inline;">
                        <label>
                            <input <?php $this->link(); ?>style = 'display:none' type="radio" value="<?php echo esc_attr($value); ?>" name="<?php echo esc_attr($name); ?>" <?php
                                                          $this->link();
                                                          checked($this->value(), $value);
                                                          ?> />
                            <img src='<?php echo esc_url($label); ?>' class='<?php echo esc_attr($class); ?>' />
                        </label>
                    </li>
                    <?php
                endforeach;
                ?>
            </ul>
            <?php
        }

    }
}