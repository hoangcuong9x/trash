<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package eCommerce_Market
 */

?><?php
	/**
	 * Hook - ecommerce_market_action_doctype.
	 *
	 * @hooked ecommerce_market_doctype -  10
	 */
	do_action( 'ecommerce_market_action_doctype' );
?>
<head>
	<?php
	/**
	 * Hook - ecommerce_market_action_head.
	 *
	 * @hooked ecommerce_market_head -  10
	 */
	do_action( 'ecommerce_market_action_head' );
	?>

<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

	<?php
		/**
		 * Hook - ecommerce_market_action_before.
		 *
		 * @hooked ecommerce_market_page_start - 10
		 * @hooked ecommerce_market_skip_to_content - 15
		 */
		do_action( 'ecommerce_market_action_before' );
	?>

	<?php 
		/**
		 * Hook - ecommerce_market_action_before_header
		 *
		 * @hooked ecommerce_market_header_start -10
		 *
		 */
		do_action( 'ecommerce_market_action_before_header' );
	?>
	<?php 
		/**
		 * Hook - ecommerce_market_action_header
		 *
		 * @hooked ecommerce_market_header -10
		 *
		 */
		do_action( 'ecommerce_market_action_header' );
	?>

	<?php 
	 /**
	  * Hook - ecommerce_market_action_after_header
	  *
	  * @hooked ecommerce_markert_header_end -10
	  *
	  */
	do_action( 'ecommerce_market_action_after_header' ); 
	?> 

	<?php
		/**
		 * Hook - ecommerce_market_action_before_content.
		 *
		 * @hooked ecommerce_market_content_start - 10
		 */
		do_action( 'ecommerce_market_action_before_content' );
	?>


