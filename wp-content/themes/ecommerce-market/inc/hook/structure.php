<?php
/**
 * Theme functions related to structure.
 *
 * This file contains structural hook functions.
 *
 * @package eCommerce_Market
 */
if ( ! function_exists( 'ecommerce_market_doctype' ) ) :
	/**
	 * Doctype Declaration.
	 *
	 * @since 1.0.0
	 */
	function ecommerce_market_doctype() {
	?><!DOCTYPE html> <html <?php language_attributes(); ?>><?php
	}
endif;

add_action( 'ecommerce_market_action_doctype', 'ecommerce_market_doctype', 10 );

if ( !function_exists( 'ecoomerce_market_head' ) ) :
	/**
	 * Header Codes.
	 *
	 * @since 1.0.0
	 */
	function ecommerce_market_head() {
	?>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">  
	<?php
	}
endif;

add_action( 'ecommerce_market_action_head', 'ecommerce_market_head', 10 );

if ( ! function_exists( 'ecommerce_market_page_start' ) ) :
	/**
	 * Page Start.
	 *
	 * @since 1.0.0
	 */
	function ecommerce_market_page_start() {
	?>
    <div id="page" class="hfeed site">
    <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'ecommerce-market' ); ?></a>
    <?php
	}
endif;
add_action( 'ecommerce_market_action_before', 'ecommerce_market_page_start' );

if ( ! function_exists( 'ecommerce_market_page_end' ) ) :
	/**
	 * Page End.
	 *
	 * @since 1.0.0
	 */
	function ecommerce_market_page_end() {
	?></div><!-- #page --><?php
	}
endif;


add_action( 'ecommerce_market_action_after', 'ecommerce_market_page_end' );

if ( ! function_exists( 'ecommerce_market_content_start' ) ) :
	/**
	 * Content Start.
	 *
	 * @since 1.0.0
	 */
	function ecommerce_market_content_start() {
	?><div id="content" class="site-content"><?php
	}
endif;
add_action( 'ecommerce_market_action_before_content', 'ecommerce_market_content_start' );


if ( ! function_exists( 'ecommerce_market_content_end' ) ) :
	/**
	 * Content End.
	 *
	 * @since 1.0.0
	 */
	function ecommerce_market_content_end() {
	?></div><!-- #content --><?php
	}
endif;
add_action( 'ecommerce_market_action_after_content', 'ecommerce_market_content_end' );


if ( ! function_exists( 'ecommerce_market_header_start' ) ) :
	/**
	 * Header Start
	 *
	 * @since 1.0.0
	 */
	function ecommerce_market_header_start() {
	?><header id="masthead" class="site-header"> <!-- header starting from here --><?php	
	}
endif;

add_action( 'ecommerce_market_action_before_header', 'ecommerce_market_header_start', 10 );


if ( ! function_exists( 'ecommerce_market_header_end' ) ) :
	/**
	 * Header End
	 *
	 * @since 1.0.0
	 */
	function ecommerce_market_header_end() {
	?></header><!-- header ends here --><?php	
	}
endif;
add_action( 'ecommerce_market_action_after_header', 'ecommerce_market_header_end', 10 );

if ( ! function_exists( 'ecommerce_market_footer_start' ) ) :
	/**
	 * Footer Start.
	 *
	 * @since 1.0.0
	 */
	function ecommerce_market_footer_start() {
	?><footer id="colophon" class="site-footer"> <!-- footer starting from here --> 
	<?php
	}
endif;
add_action( 'ecommerce_market_action_before_footer', 'ecommerce_market_footer_start' );


if ( ! function_exists( 'ecommerce_market_footer_end' ) ) :
	/**
	 * Footer End.
	 *
	 * @since 1.0.0
	 */
	function ecommerce_market_footer_end() {
	?></footer><!-- #colophon --><?php
	}
endif;
add_action( 'ecommerce_market_action_after_footer', 'ecommerce_market_footer_end' );