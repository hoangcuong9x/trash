<?php
/**
 * Provides the 'Resources' view for the corresponding tab in the Shortcode Meta Box.
 *
 * @since 2.0
 *
 * @package    woo-product-slider
 */
?>

<div id="sp-wps-tab-1" class="sp-wps-mbf-tab-content nav-tab-active">

	<?php
	$this->metaboxform->select_slider_type( array(
		'id'      => 'wps_slider_type',
		'name'    => __( 'Slider Type', 'woo-product-slider' ),
		'desc'    => __( 'Select which slider you want to display.', 'woo-product-slider' ),
		'default' => 'product_slider'
	) );
	$this->metaboxform->select( array(
		'id'      => 'wps_themes',
		'name'    => __( 'Select Theme', 'woo-product-slider' ),
		'desc'    => __( 'Select which theme you want to display.', 'woo-product-slider' ),
		'options' => array(
			'theme_one' => __( 'Theme One', 'woo-product-slider' ),
			'theme_two' => __( 'Theme Two', 'woo-product-slider' ),
			'theme_three' => __( 'Theme Three', 'woo-product-slider' ),
		),
		'default' => 'theme_one'
	) );
	$this->metaboxform->select_products_from( array(
		'id'      => 'wps_products_from',
		'name'    => __( 'Product From', 'woo-product-slider' ),
		'desc'    => __( 'Select an option to show the product from.', 'woo-product-slider' ),
		'default' => 'latest'
	) );

	$this->metaboxform->number( array(
		'id'      => 'wps_number_of_column',
		'name'    => __( 'Number of Column', 'woo-product-slider' ),
		'desc'    => __( 'Set number of column for the screen larger than 1100px.', 'woo-product-slider' ),
		'default' => 4
	) );
	$this->metaboxform->number( array(
		'id'      => 'wps_number_of_column_desktop',
		'name'    => __( 'Number of Column on Desktop', 'woo-product-slider' ),
		'desc'    => __( 'Set number of column on desktop for the screen smaller than 1100px.', 'woo-product-slider' ),
		'default' => 3
	) );
	$this->metaboxform->number( array(
		'id'      => 'wps_number_of_column_tablet',
		'name'    => __( 'Number of Column on Tablet', 'woo-product-slider' ),
		'desc'    => __( 'Set number of column on tablet for the screen smaller than 990px.', 'woo-product-slider' ),
		'default' => 2
	) );
	$this->metaboxform->number( array(
		'id'      => 'wps_number_of_column_mobile',
		'name'    => __( 'Number of Column on Mobile', 'woo-product-slider' ),
		'desc'    => __( 'Set number of column on mobile for the screen smaller than 650px.', 'woo-product-slider' ),
		'default' => 1
	) );
	$this->metaboxform->number( array(
		'id'      => 'wps_number_of_total_products',
		'name'    => __( 'Total Products', 'woo-product-slider' ),
		'desc'    => __( 'Number of Total products to show.', 'woo-product-slider' ),
		'default' => 50
	) );
	$this->metaboxform->select( array(
		'id'      => 'wps_order_by',
		'name'    => __( 'Order By', 'woo-product-slider' ),
		'desc'    => __( 'Select an order by option.', 'woo-product-slider' ),
		'options' => array(
			'ID'    => __( 'ID', 'woo-product-slider' ),
			'date'     => __( 'Date', 'woo-product-slider' ),
			'title'    => __( 'Title', 'woo-product-slider' ),
			'rand'    => __( 'Random', 'woo-product-slider' ),
			'modified' => __( 'Modified', 'woo-product-slider' ),
		),
		'default' => 'date'
	) );
	$this->metaboxform->select( array(
		'id'      => 'wps_order',
		'name'    => __( 'Order', 'woo-product-slider' ),
		'desc'    => __( 'Select an order option', 'woo-product-slider' ),
		'options' => array(
			'ASC'  => __( 'Ascending', 'woo-product-slider' ),
			'DESC' => __( 'Descending', 'woo-product-slider' ),
		),
		'default' => 'DESC'
	) );

	?>

</div>