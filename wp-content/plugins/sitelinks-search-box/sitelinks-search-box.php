<?php
/**
Plugin Name: Sitelinks Search Box
Plugin URI: http://apasionados.es
Description: Adds the JSON-LD schema.org markup for the "Google Sitelinks Search Box" on the homepage. This new feature was presented on the <a href="http://googlewebmastercentral.blogspot.com.es/2014/09/improved-sitelinks-search-box.html" target="_blank">Official Google Webmaster Central Blog</a> (05 Sep 2014 07:44 AM PDT). There is more info on the <a href="https://developers.google.com/webmasters/richsnippets/sitelinkssearch">Google Developers Website</a>.
Version: 1.3
Author: Apasionados.es
Author URI: http://apasionados.es
License: GPL2
Text Domain: ap_sitelinks_search_box
*/
 
 /*  Copyright 2014  Apasionados.es  (email: info@apasionados.es)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

$plugin_header_translate = array( __('Sitelinks Search Box', 'ap_sitelinks_search_box'), __('Adds the JSON-LD schema.org markup for the "Google Sitelinks Search Box" on the homepage. This new feature was presented on the <a href="http://googlewebmastercentral.blogspot.com.es/2014/09/improved-sitelinks-search-box.html" target="_blank">Official Google Webmaster Central Blog</a> (05 Sep 2014 07:44 AM PDT). There is more info on the <a href="https://developers.google.com/webmasters/richsnippets/sitelinkssearch">Google Developers Website</a>.', 'ap_sitelinks_search_box') );

add_action( 'admin_init', 'ap_sitelinks_search_box_load_language' );
function ap_sitelinks_search_box_load_language() {
	load_plugin_textdomain( 'ap_sitelinks_search_box', false,  dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}

function ap_sitelinks_search_box (){
	// @link  https://developers.google.com/structured-data/site-name
	// @link https://developers.google.com/structured-data/slsb-overview
	if ( is_front_page() && !defined('WPSEO_VERSION') ) {
		echo PHP_EOL . '<script type="application/ld+json">' . PHP_EOL;
		echo '{' . PHP_EOL;
		echo '  "@context": "http://schema.org",' . PHP_EOL;
		echo '  "@type": "WebSite",' . PHP_EOL;
		echo '  "url": "' . get_home_url() . '/",' . PHP_EOL;
		echo '  "potentialAction": {' . PHP_EOL;
		echo '    "@type": "SearchAction",' . PHP_EOL;
		echo '    "target": "' . get_home_url() . '/?s={search_term}",' . PHP_EOL;
		echo '    "query-input": "required name=search_term"' . PHP_EOL;
		echo '  }' . PHP_EOL;
		echo '}' . PHP_EOL;
		echo '</script>' . PHP_EOL;
	}
} 
add_action( 'wp_footer', 'ap_sitelinks_search_box', 10000 );

?>