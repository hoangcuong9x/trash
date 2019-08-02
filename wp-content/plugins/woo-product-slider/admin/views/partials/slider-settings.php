<?php
/**
 * Provides the 'Resources' view for the corresponding tab in the Shortcode Meta Box.
 *
 * @since 2.0
 *
 * @package    woo-product-slider
 */
?>

<div id="sp-wps-tab-2" class="sp-wps-mbf-tab-content">
	<?php
	$this->metaboxform->checkbox( array(
		'id'      => 'wps_auto_play',
		'name'    => __( 'AutoPlay', 'woo-product-slider' ),
		'desc'    => __( 'Check to on autoplay slider.', 'woo-product-slider' ),
		'default' => 'on',
	) );
	$this->metaboxform->number( array(
		'id'      => 'wps_auto_play_speed',
		'name'    => __( 'AutoPlay Speed', 'woo-product-slider' ),
		'desc'    => __( 'Set autoplay speed.', 'woo-product-slider' ),
		'after'   => __( '(Millisecond)', 'woo-product-slider' ),
		'default' => 3000
	) );
	$this->metaboxform->number( array(
		'id'      => 'wps_scroll_speed',
		'name'    => __( 'Slider Speed', 'woo-product-slider' ),
		'desc'    => __( 'Set slide scroll speed.', 'woo-product-slider' ),
		'after'   => __( '(Millisecond).', 'woo-product-slider' ),
		'default' => 600
	) );
	$this->metaboxform->checkbox( array(
		'id'      => 'wps_pause_on_hover',
		'name'    => __( 'Pause on Hover', 'woo-product-slider' ),
		'desc'    => __( 'Check to activate pause on hover.', 'woo-product-slider' ),
		'default' => 'on',
	) );
	$this->metaboxform->checkbox( array(
		'id'      => 'wps_show_navigation',
		'name'    => __( 'Navigation', 'woo-product-slider' ),
		'desc'    => __( 'Check to show navigation arrows.', 'woo-product-slider' ),
		'default' => 'on',
	) );
	$this->metaboxform->color( array(
		'id'      => 'wps_nav_arrow_color',
		'type'    => 'color',
		'name'    => __( 'Navigation Arrow Color', 'woo-product-slider' ),
		'desc'    => __( 'Pick a color for navigation arrows.', 'woo-product-slider' ),
		'default' => '#ffffff'
	) );
	$this->metaboxform->color( array(
		'id'      => 'wps_nav_arrow_bg',
		'type'    => 'color',
		'name'    => __( 'Navigation Arrow Background', 'woo-product-slider' ),
		'desc'    => __( 'Pick a color for navigation arrows background.', 'woo-product-slider' ),
		'default' => '#444444'
	) );
	$this->metaboxform->checkbox( array(
		'id'      => 'wps_show_pagination',
		'name'    => __( 'Pagination', 'woo-product-slider' ),
		'desc'    => __( 'Check to show pagination dots.', 'woo-product-slider' ),
		'default' => 'on'
	) );
	$this->metaboxform->color( array(
		'id'      => 'wps_pagination_color',
		'type'    => 'color',
		'name'    => __( 'Pagination Dots Background', 'woo-product-slider' ),
		'desc'    => __( 'Used as the pagination dots background color.', 'woo-product-slider' ),
		'default' => '#cccccc'
	) );
	$this->metaboxform->color( array(
		'id'      => 'wps_pagination_active_color',
		'type'    => 'color',
		'name'    => __( 'Pagination Dots Active Background', 'woo-product-slider' ),
		'desc'    => __( 'Used as the pagination dots active background color.', 'woo-product-slider' ),
		'default' => '#333333'
	) );
	$this->metaboxform->checkbox( array(
		'id'      => 'wps_touch_swipe',
		'name'    => __( 'Touch Swipe', 'woo-product-slider' ),
		'desc'    => __( 'Check to on touch swipe.', 'woo-product-slider' ),
		'default' => 'on'
	) );
	$this->metaboxform->checkbox( array(
		'id'      => 'wps_mouse_draggable',
		'name'    => __( 'Mouse Draggable', 'woo-product-slider' ),
		'desc'    => __( 'Check to on mouse draggable.', 'woo-product-slider' ),
		'default' => 'on'
	) );
	$this->metaboxform->checkbox( array(
		'id'      => 'wps_rtl',
		'name'    => __( 'RTL Mode', 'woo-product-slider' ),
		'desc'    => __( 'Check and Set a RTL language from admin settings to make the rtl option work.', 'woo-product-slider' ),
		'default' => 'off'
	) );
	?>
</div>