<?php
/*--------------------------------------------------------------------*/
/*     Register Google Fonts
/*--------------------------------------------------------------------*/
function wpazure_fonts_url() {
	
    $fonts_url = '';
	
	
	/* Translators: If there are characters in your language that are not
	* supported by Lora, translate this to 'off'. Do not translate
	* into your own language.
	*/
	$work_sans = _x( 'on', 'Work Sans font: on or off', 'wpazure' );
	 
	/* Translators: If there are characters in your language that are not
	* supported by Open Sans, translate this to 'off'. Do not translate
	* into your own language.
	*/
	$open_sans = _x( 'on', 'Open Sans font: on or off', 'wpazure' );
	 
	if ( 'off' !== $work_sans || 'off' !== $open_sans ) {
	$font_families = array();
	 
	if ( 'off' !== $work_sans ) {
	$font_families[] = 'Work+Sans:400,500,600,700,800&display=swap';
	}
	 
	if ( 'off' !== $open_sans ) {
	$font_families[] = 'Open Sans:300,400,600,700,800';
	}
		
		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);

		$fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );
	}

    return $fonts_url;
}
function wpazure_scripts_styles() {
    wp_enqueue_style( 'wpazure-fonts', wpazure_fonts_url(), array(), null );
}
add_action( 'wp_enqueue_scripts', 'wpazure_scripts_styles');
?>