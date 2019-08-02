<?php
//--------- Getting values from setting panel ---------------- //

function gs_wps_get_option( $option, $section, $default = '' ) {

    $options = get_option( $section );
 
    if ( isset( $options[$option] ) ) {
        return $options[$option];
    }
 
    return $default;
}

add_image_size('gswps_product_thumb', 350);

// ---------- Shortcode [gs_wps] -------------
function gswps_latest_prod_shortcode() {
	add_shortcode( 'gs_wps', 'gs_woo_product_shortcode' );
}
add_action( 'init', 'gswps_latest_prod_shortcode' );

function gs_woo_product_shortcode( $atts ) {

	$gs_wps_products = gs_wps_get_option( 'gs_wps_products', 'gs_wps_general', 10 );
	$gs_wps_prod_tit = gs_wps_get_option( 'gs_wps_prod_tit', 'gs_wps_style', 15 );
	$gs_wps_theme = gs_wps_get_option( 'gs_wps_theme', 'gs_wps_style', 'gs-effect-1' );
	$gs_wps_cols = gs_wps_get_option( 'gs_wps_cols', 'gs_wps_general', 4 );
	$gs_wps_autoplay = gs_wps_get_option( 'gs_wps_autoplay', 'gs_wps_general', 'on' );
	$gs_wps_autoplay = ($gs_wps_autoplay === 'off' ? 'false' : 'true');
	$gs_wps_stp_hover = gs_wps_get_option( 'gs_wps_stp_hover', 'gs_wps_general', 'on' );
	$gs_wps_stp_hover = ($gs_wps_stp_hover === 'off' ? 'false' : 'true');
	$gs_wps_inf_loop = gs_wps_get_option( 'gs_wps_inf_loop', 'gs_wps_general', 'on' );
	$gs_wps_inf_loop = ($gs_wps_inf_loop === 'off' ? 'false' : 'true');
	$gs_wps_autop_speed = gs_wps_get_option( 'gs_wps_autop_speed', 'gs_wps_general', 1000 );
	$gs_wps_autop_tmout = gs_wps_get_option( 'gs_wps_autop_tmout', 'gs_wps_general', 2500 );
	$gs_wps_nav_spd = gs_wps_get_option( 'gs_wps_nav_spd', 'gs_wps_general', 1000 );
	$gs_wps_nav_nxt = gs_wps_get_option( 'gs_wps_nav_nxt', 'gs_wps_general', 'on' );
	$gs_wps_nav_nxt = ($gs_wps_nav_nxt === 'off' ? 'none' : 'initial');
	$gs_wps_dots_nav = gs_wps_get_option( 'gs_wps_dots_nav', 'gs_wps_general', 'on' );
	$gs_wps_dots_nav = ($gs_wps_dots_nav === 'off' ? 'false' : 'true');

	extract(shortcode_atts( 
		array(
		'posts' 	=> $gs_wps_products,
		'order'		=> 'DESC',
		'orderby'   => 'date',
		'product_cat' => '',
		'theme'		=> $gs_wps_theme,
		'columns'	=> $gs_wps_cols,
		'autoplay'	=> $gs_wps_autoplay,
		'pause' 	=> $gs_wps_stp_hover,
		'inf_loop'	=> $gs_wps_inf_loop,
		'speed'		=> $gs_wps_autop_speed,
		'timeout' 	=> $gs_wps_autop_tmout,
		'nav_speed' => $gs_wps_nav_spd,
		'nav'		=> $gs_wps_nav_nxt,
		'dots_nav'	=> $gs_wps_dots_nav,
		'prod_tit_limit' => $gs_wps_prod_tit
		), $atts 
	));
	

	$gs_wps_loop = new WP_Query(
		array(
		'post_type'		=> 'product',
		'posts_per_page' => $posts,
		'order'			=> $order,
		'orderby'		=> $orderby,
		'product_cat' 	=> $product_cat,
		'tax_query' => array(
	            array(
	                'taxonomy' => 'product_visibility',
	                'field'    => 'name',
	                'terms'    => 'exclude-from-catalog',
	                'operator' => 'NOT IN',
	            ),
    		),
		)
	);
	
	// var_dump($prod_tit_limit);
	$output = '<div class="wrap gs_wps_area" style="overflow:hidden;">';
	$output .= '<div class="container">';
	$output .= '<div class="row clearfix gs_wps gs_grid '. $theme .'" id="">';
		if ( $gs_wps_loop->have_posts() ) {
			
			while ( $gs_wps_loop->have_posts() ) {
				$gs_wps_loop->the_post();				
				
				$gs_wps_title = get_the_title();
				$gs_wps_title = (strlen($gs_wps_title) > 15) ? substr($gs_wps_title,0,$prod_tit_limit).'..' : $gs_wps_title;

					$output .= gswps_style_swither( $theme, $gs_wps_title, $gs_wps_loop );			
			} // end while loop

		} else {
			$output .= "No Product Added!";
		}

		wp_reset_postdata();
		wp_reset_query();
	$output .= '</div>'; // end row
	$output .= '</div>'; // end container
	$output .= '</div>'.gs_wps_slider_trigger( $columns, $autoplay, $pause, $inf_loop, $speed, $timeout, $nav_speed, $dots_nav).gs_wps_setting_styles($nav); // end wrap

	return $output;
}

function gs_wps_slider_trigger( $columns, $autoplay, $pause, $inf_loop, $speed, $timeout, $nav_speed, $dots_nav){ 
	$gs_wps_margin = gs_wps_get_option( 'gs_wps_margin', 'gs_wps_general', 4 );
	$gs_wps_dot_each = gs_wps_get_option( 'gs_wps_dot_each', 'gs_wps_general', 'on' );
	$gs_wps_dot_each = ($gs_wps_dot_each === 'off' ? 'false' : 'true');
?>
	<script type="text/javascript">
		jQuery.noConflict();
		jQuery(document).ready(function(){

		jQuery('.gs_wps').owlCarousel({
			autoplay: <?php echo $autoplay; ?>,
			autoplayHoverPause: <?php echo $pause; ?>,
			loop: <?php echo $inf_loop; ?>,
			margin: <?php echo $gs_wps_margin; ?>,
			autoplaySpeed: <?php echo $speed; ?>,
			autoplayTimeout: <?php echo $timeout; ?>,
			navSpeed: <?php echo $nav_speed; ?>,
			dots: <?php echo $dots_nav; ?>,
		    dotsEach: <?php echo $gs_wps_dot_each; ?>, 
		    responsiveClass:true,
		    lazyLoad: true,
		    responsive:{
		        0:{
		            items:1,
		            nav:false
		        },
		        600:{
		            items:3,
		            nav:false
		        },
		        1000:{
		            items: <?php echo $columns; ?>,
		            nav:true
		        }
		    }    
		}) // end of owlCarousel latest product
		});
	</script>
<?php
}

function gs_wps_setting_styles($nav) { 
	$gs_wps_title = gs_wps_get_option( 'gs_wps_title', 'gs_wps_style', '#fff' );
	$gs_wps_btn = gs_wps_get_option( 'gs_wps_btn', 'gs_wps_style', '#ed4e6e' );
	$gs_wps_btn_hvr = gs_wps_get_option( 'gs_wps_btn_hvr', 'gs_wps_style', '#ed90a1' );
	$gs_wps_prod_price = gs_wps_get_option( 'gs_wps_prod_price', 'gs_wps_style', '#fff' );
	$gs_wps_nv_bg = gs_wps_get_option( 'gs_wps_nv_bg', 'gs_wps_style', '#3783a7' );
	$gs_wps_nv_hv = gs_wps_get_option( 'gs_wps_nv_hv', 'gs_wps_style', '#0fb9da' );
	$gs_wps_dot_nv_bg = gs_wps_get_option( 'gs_wps_dot_nv_bg', 'gs_wps_style', '#3783a7' );
	$gs_wps_dot_nv_ac = gs_wps_get_option( 'gs_wps_dot_nv_ac', 'gs_wps_style', '#0fb9da' );
?>		
	<style>
		.gs_wps .gs_wps_title a {
			color: <?php echo $gs_wps_title; ?>;
			transition: .5s;
		}
		.gs_wps .gs_wps_title a:hover {
			color: <?php echo $gs_wps_title; ?>;
			opacity: .9;
			text-decoration: none;
		}
		.gs_wps .gs_wps_price .add_to_cart_button {
			background: <?php echo $gs_wps_btn; ?>;
			transition: .5s;
			color: #fff;
		}
		.gs_wps .gs_wps_price .add_to_cart_button:hover {
			background: <?php echo $gs_wps_btn_hvr; ?>;
			text-decoration: none;
		}
		.gs_wps .gs_wps_price .amount {
			color: <?php echo $gs_wps_prod_price; ?>;
		}
		.gs_wps .woocommerce ins {
			background: transparent;
		}
		.gs_wps .owl-controls .owl-dots .owl-dot span {
			background: <?php echo $gs_wps_dot_nv_bg; ?>;
		}
		.gs_wps .owl-controls .owl-dots .owl-dot.active span {
			background: <?php echo $gs_wps_dot_nv_ac; ?>;
		}
		.gs_wps .owl-controls .owl-nav {
			display: <?php echo $nav; ?>;
		}
		.gs_wps .owl-controls .owl-nav .owl-prev,
		.gs_wps .owl-controls .owl-nav .owl-next {
			background: <?php echo $gs_wps_nv_bg; ?>;
			transition: .5s;
		}
		.gs_wps .owl-controls .owl-nav .owl-prev:hover,
		.gs_wps .owl-controls .owl-nav .owl-next:hover {
			background: <?php echo $gs_wps_nv_hv; ?>;
		}
	</style>		
<?php
}

add_action('wp_head', 'gs_wps_setting_styles');