<?php /**
 * Theme Hook.
 *
 * @package     Wpazure
 */
/**
 * Header
 */
function wpazure_header(){
	do_action( 'wpazure_header' );
}
/**
 * Before Header
 */
function wpazure_header_before(){
	do_action( 'wpazure_header_before' );
}
/**
 * After Header
 */
function wpazure_header_after(){
	do_action( 'wpazure_header_after' );
}


/**
 * Before primary content
 */
function wpazure_content_loop(){
	do_action( 'wpazure_content_loop' );
}

/**
 * primary content
 */
function wpazure_primary_content_before(){
	do_action( 'wpazure_primary_content_before' );
}

/**
 * After primary content
 */
function wpazure_primary_content_after(){
	do_action( 'wpazure_primary_content_after' );
}

/**
* Before archive content
*/
function wpazure_archive_before(){
	do_action( 'wpazure_archive_before' );
}

/**
* Archive content 
*/
function wpazure_archive_loop(){
	do_action( 'wpazure_archive_loop' );
}

/**
* After Archive content 
*/
function wpazure_archive_after(){
	do_action( 'wpazure_archive_after' );
}


/**
 * Before single
 */
function wpazure_single_before(){
	do_action( 'wpazure_single_before' );
}

/**
 * single
 */
function wpazure_single_loop(){
	do_action( 'wpazure_single_loop' );
}

/**
 * After single
 */
function wpazure_single_after(){
	do_action( 'wpazure_single_after' );
}


/**
 * Before Footer 
 */
function wpazure_footer_before(){
	do_action( 'wpazure_footer_before' );
}

/**
 * widget Footer 
 */
function wpazure_footer(){
	do_action( 'wpazure_footer' );
}

/**
 * After Footer 
 */
function wpazure_footer_after(){
	do_action( 'wpazure_footer_after' );
}

/**
 * Scroll to top button 
 */
function wpazure_scroll_to_top(){
	do_action( 'wpazure_scroll_to_top' );
}