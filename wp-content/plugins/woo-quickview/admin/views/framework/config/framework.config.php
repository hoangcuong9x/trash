<?php if ( ! defined( 'ABSPATH' ) ) {
	die;
} // Cannot access pages directly.
// ===============================================================================================
// -----------------------------------------------------------------------------------------------
// FRAMEWORK SETTINGS
// -----------------------------------------------------------------------------------------------
// ===============================================================================================
$settings = array(
	'menu_title'      => __( 'Woo Quick View', 'woo-quick-view' ),
	// 'menu_parent'     => 'edit.php?post_type=spt_testimonial',
	'menu_type'       => 'menu', // menu, submenu, options, theme, etc.
	'menu_slug'       => 'wqv_settings',
	'ajax_save'       => true,
	'show_reset_all'  => false,
	'menu_icon'		  => 'data:image/svg+xml;base64,' . base64_encode( '<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="256px" height="256px" viewBox="0 0 256 256" enable-background="new 0 0 256 256" xml:space="preserve">  <image id="image0" width="256" height="256" x="0" y="0"
    href="data:image/png;base64,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
AElFTkSuQmCC" />
</svg>' ),
	'framework_title' => __( 'WooCommerce Quick View', 'woo-quick-view' ),
);

// ===============================================================================================
// -----------------------------------------------------------------------------------------------
// FRAMEWORK OPTIONS
// -----------------------------------------------------------------------------------------------
// ===============================================================================================
$options = array();

// Quick View Button Settings.
$options[] = array(
	'name'   => 'quick_view_btn_settings',
	'title'  => __( 'Button Settings', 'woo-quick-view' ),
	'icon'   => 'fa fa-toggle-off',

	// begin: fields.
	'fields' => array(
		array(
			'id'         => 'wqv_quick_view_button_position',
			'type'       => 'select',
			'title'      => __( 'Quick View Button Position', 'woo-quick-view' ),
			'desc'       => __( 'Select quick view button position.', 'woo-quick-view' ),
			'default'    => 'after_add_to_cart',
			'options'	 => array(
				'before_add_to_cart' => __( 'Before Add to cart button', 'woo-quick-view' ),
				'after_add_to_cart'  => __( 'After add to cart button', 'woo-quick-view' ),
				'none'               => __( 'None', 'woo-quick-view' ),
			),
		),
		array(
			'id'         => 'wqv_quick_view_button_color',
			'type'       => 'color_set',
			'title'      => __( 'Button Color', 'woo-quick-view' ),
			'desc'       => __( 'Set quick view button color.', 'woo-quick-view' ),
			'default'    => array(
				'title1'  => 'Color',
				'color1'  => '#ffffff',
				'title2'  => 'Hover Color',
				'color2'  => '#ffffff',
				'title3'  => 'Background',
				'color3'  => '#994294',
				'title4'  => 'Hover Background',
				'color4'  => '#7d3179',
			),
			'color1'     => true,
			'color2'     => true,
			'color3'     => true,
			'color4'     => true,
		),
		array(
			'id'         => 'wqv_quick_view_button_padding',
			'type'       => 'margin',
			'title'      => __( 'Button Padding', 'woo-quick-view' ),
			'desc'       => __( 'Set quick view button padding.', 'woo-quick-view' ),
			'default'    => array(
				'left'   => '17',
				'right'  => '17',
				'top'    => '9',
				'bottom' => '9',
			),
			'left'      => true,
			'right'     => true,
			'top'       => true,
			'bottom'    => true,
		),
		array(
			'id'         => 'wqv_quick_view_button_border',
			'type'       => 'border',
			'title'      => __( 'Button Border', 'woo-quick-view' ),
			'desc'       => __( 'Set quick view button border.', 'woo-quick-view' ),
			'default'    => array(
				'width'       => '0',
				'style'       => 'solid',
				'color'       => '#994294',
				'hover_color' => '#7d3179',
			),
			'hover_color'     => true,
		),
		array(
			'id'         => 'wqv_quick_view_button_text',
			'type'       => 'text',
			'title'      => __( 'Quick View Button Label', 'woo-quick-view' ),
			'desc'       => __( 'Type quick view button custom label.', 'woo-quick-view' ),
			'default'    => 'Quick View',
		),

	), // end: fields.
);

// ----------------------------------------
// Popup Settings -
// ----------------------------------------
$options[] = array(
	'name'   => 'popup_settings',
	'title'  => __( 'Popup Settings', 'woo-quick-view' ),
	'icon'   => 'fa fa-external-link',

	// begin: fields.
	'fields' => array(

		array(
			'id'         => 'wqv_popup_overlay_bg',
			'type'       => 'color_picker',
			'title'      => __( 'Popup Overlay Background', 'woo-quick-view' ),
			'desc'       => __( 'Set popup overlay background color.', 'woo-quick-view' ),
			'default'    => 'rgba(11,11,11,0.8)',
		),
		array(
			'id'         => 'wqv_popup_effect',
			'type'       => 'select',
			'title'      => __( 'Popup Effect', 'woo-quick-view' ),
			'desc'       => __( 'Select popup effect.', 'woo-quick-view' ),
			'default'    => 'mfp-zoom-in',
			'options'	 => array(
				'mfp-fade'            => 'Fade',
				'mfp-zoom-in'         => 'Zoom in',
				'mfp-zoom-out'        => 'Zoom out',
				'mfp-newspaper'       => 'Newspaper',
				'mfp-move-horizontal' => 'Move horizontal',
				'mfp-3d-unfold'       => '3d unfold',
				'mfp-slide-bottom'    => 'Slide bottom',
			),
		),
		array(
			'id'         => 'wqv_popup_close_button',
			'type'       => 'switcher',
			'title'      => __( 'Popup Close Button', 'woo-quick-view' ),
			'desc'       => __( 'Show/hide popup close button.', 'woo-quick-view' ),
			'default'    => true,
		),
		array(
			'id'         => 'wqv_popup_close_btn_color',
			'type'       => 'color_set',
			'title'      => __( 'Close Button Icon Color', 'woo-quick-view' ),
			'desc'       => __( 'Set popup close button icon color.', 'woo-quick-view' ),
			'default'    => array(
				'title1'  => __( 'Color', 'woo-quick-view' ),
				'color1'  => '#444444',
				'title2'  => __( 'Hover Color', 'woo-quick-view' ),
				'color2'  => '#994294',
			),
			'color1'     => true,
			'color2'     => true,
			'dependency' => array( 'wqv_popup_close_button', '==', 'true' ),
		),
		array(
			'id'         => 'wqv_popup_close_icon_size',
			'type'       => 'number',
			'title'      => __( 'Close Button Icon Size', 'woo-quick-view' ),
			'desc'       => __( 'Set popup close button icon size.', 'woo-quick-view' ),
			'default'    => '18',
			'after'     => 'px',
			'attributes' => array(
				'min' => 0,
				'max' => 70,
			),
			'dependency' => array( 'wqv_popup_close_button', '==', 'true' ),
		),
		array(
			'type'    => 'subheading',
			'content' => __( 'Popup Product Content', 'woo-quick-view' ),
		),
		array(
			'id'         => 'wqv_rating_start_color',
			'type'       => 'color_set',
			'title'      => __( 'Rating Color', 'woo-quick-view' ),
			'desc'       => __( 'Set product star rating color.', 'woo-quick-view' ),
			'default'    => array(
				'title1'  => 'Empty Color',
				'color1'  => '#dadada',
				'title2'  => 'Full Color',
				'color2'  => '#ff9800',
			),
			'color1'     => true,
			'color2'     => true,
		),
		array(
			'id'         => 'wqv_add_to_cart_btn_color',
			'type'       => 'color_set',
			'title'      => __( 'Add to Cart Button Background', 'woo-quick-view' ),
			'desc'       => __( 'Set product add to cart button background color.', 'woo-quick-view' ),
			'default'    => array(
				'title1'  => __( 'Color', 'woo-quick-view' ),
				'color1'  => '#ffffff',
				'title2'  => __( 'Hover Color', 'woo-quick-view' ),
				'color2'  => '#ffffff',
				'title3'  => __( 'Background', 'woo-quick-view' ),
				'color3'  => '#333333',
				'title4'  => __( 'Hover Background', 'woo-quick-view' ),
				'color4'  => '#1a1a1a',
			),
			'color1'     => true,
			'color2'     => true,
			'color3'     => true,
			'color4'     => true,
		),
		array(
			'id'         => 'wqv_add_to_cart_btn_padding',
			'type'       => 'margin',
			'title'      => __( 'Add to Cart Button Padding', 'woo-quick-view' ),
			'desc'       => __( 'Set product add to cart button padding.', 'woo-quick-view' ),
			'default'    => array(
				'left'   => '21',
				'right'  => '21',
				'top'    => '0',
				'bottom' => '0',
			),
			'left'      => true,
			'right'     => true,
			'top'       => true,
			'bottom'    => true,
		),
		array(
			'id'         => 'wqv_popup_box_bg',
			'type'       => 'color_picker',
			'title'      => __( 'Popup Window Background', 'woo-quick-view' ),
			'desc'       => __( 'Set popup window background.', 'woo-quick-view' ),
			'default'    => '#ffffff',
		),

	), // end: fields.
);

// ------------------------------
// Other Options                   -
// ------------------------------
$options[] = array(
	'name'   => 'other_options_section',
	'title'  => __( 'Other Options', 'woo-quick-view' ),
	'icon'   => 'fa fa-cogs',
	'fields' => array(
		array(
			'id'    => 'wqv_custom_css',
			'type'  => 'textarea',
			'title' => __( 'Custom CSS', 'woo-quick-view' ),
			'desc'  => __( 'Type your custom css.', 'woo-quick-view' ),
		),
	),
);


SP_WQV_Framework::instance( $settings, $options );
