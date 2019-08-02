<?php
/**
 * public view functionality.
 *
 * @link       http://themescode.com
 * @since      1.0.0
 *
 * @package    TC  WooCommerce  Product Slider
 * tc is used as short of themescode
 **/
 function tc_wooslider_option( $option, $section, $default = '' ) {

     $options = get_option( $section );

     if ( isset( $options[$option] ) ) {
         return $options[$option];
     }

     return $default;
 }


add_shortcode('tc-latest-product', 'tc_woo_latest_product_view' );


function tc_woo_latest_product_view($atts) {

	// Attributes
extract( shortcode_atts(
	array(
		'posts_num' => "-1",
		'order' => 'DESC',
		'carousel_cat'=>'',

	), $atts )
);

// items
$tcwps_lg_desktop=tc_wooslider_option('large-item-val','tc_whooslider_basics', '4' );
$tcwps_sm_desktop=tc_wooslider_option('sm_desktops','tc_whooslider_basics', '4' );
$tcwps_tablets=tc_wooslider_option('items-tablet-val','tc_whooslider_basics', '3' );
$tcwps_mobi_items=tc_wooslider_option('items-mobile-val','tc_whooslider_basics', '1' );
$tcwps_wl=tc_wooslider_option('sd_word_n','tc_whooslider_advanced', 18 );

// show hide
$tcwps_hsd=tc_wooslider_option('hide_sd','tc_whooslider_showhide', 'false' );
$tcwps_hstart=tc_wooslider_option('hide_start','tc_whooslider_showhide', 'false' );


$args = array(
		'orderby' => 'date',
		 'order' => $order,
	     'post_type' => 'product'
);
  $tc_wps_loop = new WP_Query($args);

$output = '<div class="tcwps-wrap tc-wooslider-container-recent">';
   $output .= '<div class="tc-wooslider-recent owl-carousel tcwps-nav">';

   if($tc_wps_loop->have_posts()){
       while($tc_wps_loop->have_posts()) {
           $tc_wps_loop->the_post();
           //global $post, $woocommerce, $product;
           $tc_wps_thumbnail = get_the_post_thumbnail(get_the_ID(), 'full');

           $output .= '<div class="tc-wooslider-item">';

              $output .='<div class="tc-wps-overlay-wrap">';

                 $output .='<div class="tc-product-img-wrap">';

                   $output .= '<a href="'.get_permalink().'">';
                     if (has_post_thumbnail( $tc_wps_loop->post->ID )){

                       $output .= get_the_post_thumbnail($tc_wps_loop->post->ID,'', array('class' => "tc-wps-img"));
                       }else{
                           $output .= '<img id="place_holder_thm" src="'.woocommerce_placeholder_img_src().'" alt="Placeholder" />';
                     }
                   $output .='</a>';
                 $output .= '<div class="tc-wps-overlay">';
                 $output .= '<div class="tc-wps-overlay-block">';
                     $output .= '<a class="tc-product-title-overlay" href="'.get_permalink().'">'.get_the_title().'</a>';
                     if($tcwps_hsd=='false'){
                     $tcwps_sd=$tc_wps_loop->post->post_excerpt;
                     $output .= themescode_limit_text($tcwps_sd,$tcwps_wl);
                     }
                     if( $price_value = $tc_wps_loop->get_price_html() ){
                              // $output .='<div class="tc_price_value">'. $price_value .'</div>';
                          }
                          $output .= '<div class="tc-cart-button">'.do_shortcode('[add_to_cart id="'.get_the_ID().'" style="tcwps-button"]').'</div>';
                      $output .= '</div>'; // tc-wps-overlay-block

                  $output .= '</div>'; // .tc-wps-overlay

                   $output .= '</div>';  // end .tc-product-img-wrap

         $output .= '</div>'; // end .tc-wps-overlay-wrap

         if( $price_value = $tc_wps_loop->get_price_html() ){
                  $output .='<div class="tc_price_value">'. $price_value .'</div>';

          }
          if($tcwps_hstart=='false'){
            $output .= my_print_stars();
          }


      $output .= '<a class="tc-product-title-bottom" href="'.get_permalink().'">'.get_the_title().'</a>';


?>

   <?php
        $output .= '</div>'; // end .tc-wooslider-item

       }
   } else {
       echo 'No Product Was Found.';
   }
   wp_reset_postdata();
   wp_reset_query();
   $output .= '</div><!--/.tc-carousel-containe-->';
   $output .= '</div><!--/.tc-carousel-demo-->';

   ?>
   <script type="text/javascript">

   jQuery(document).ready(function(){
       jQuery(".tc-wooslider-recent").owlCarousel({

         // control
         autoplay:<?php  echo tc_wooslider_option('auto-play','tc_whooslider_basics', 'true' );?>,
         autoplayHoverPause:<?php  echo tc_wooslider_option('stop-onhover','tc_whooslider_basics', 'true' ); ?>,
         autoplayTimeout:<?php echo tc_wooslider_option('auto_play_timeout','tc_whooslider_basics', 3000 ); ?>,
         loop:<?php echo tc_wooslider_option('loop','tc_whooslider_basics', 'true' ); ?>,
         // Advances
         nav:<?php  echo tc_wooslider_option('nav-val','tc_whooslider_advanced', 'true' ); ?>,
         navText:['<i class="fa fa-angle-left" aria-hidden="true"></i>','<i class="fa fa-angle-right" aria-hidden="true"></i>'],
         autoHeight:<?php  echo tc_wooslider_option('autoheight','tc_whooslider_advanced', 'false' ); ?>,
         dots:<?php echo tc_wooslider_option('dots-val','tc_whooslider_advanced', 'true' ); ?>,
         responsiveClass:true,
         responsive:{
             0:{
                 items:<?php echo $tcwps_mobi_items; ?>,
             },
             600:{
                 items:<?php  echo $tcwps_tablets;?>,

             },
             1000:{
                 items:<?php echo $tcwps_sm_desktop; ?>,

             },
             1200:{
                 items:<?php  echo $tcwps_lg_desktop; ?>,

             },

         }

      });

   });


   </script>
   <?php
   return $output;


 }

 function tc_wooslider_style_trigger(){
 ?>
 <style media="screen">

 <?php
 $tcwps_hborder=tc_wooslider_option('hide_border','tc_whooslider_showhide', 'false' );
 if($tcwps_hborder=='false'){ ?>
 .tc-wooslider-item{
   border:1px solid #eee;
 }
<?php } ?>

 /* Navigation */
 .tcwps-wrap .owl-theme .owl-nav [class*='owl-'] {
   background-color: <?php echo tc_wooslider_option('nav-color', 'tc_whooslider_styling', '#000' ); ?>;
 }
 .tcwps-wrap .owl-theme .owl-nav [class*='owl-']:hover {
    background-color: <?php echo tc_wooslider_option('nav-h-color', 'tc_whooslider_styling', '#343434' ); ?>;

   }
 /* Dots */
 .tcwps-wrap  .owl-theme .owl-dots .owl-dot span {
   background:<?php echo tc_wooslider_option('dots-color', 'tc_whooslider_styling', '#343434' ); ?>;
 }
 .tcwps-wrap  .owl-theme .owl-dots .owl-dot.active span, .owl-theme .owl-dots .owl-dot:hover span {
   background:<?php echo tc_wooslider_option('dots-h-color', 'tc_whooslider_styling', '#000' ); ?>;
  }
/*End Dots*/


.tc-wooslider-theme .owl-controls .owl-page span {
   background:<?php echo tc_wooslider_option('pagination-color', 'tc_whooslider_styling', '#FF6766' ); ?>;
 }
.tc-wooslider-theme .owl-controls .owl-buttons div {

   background:<?php echo tc_wooslider_option('navigation-color', 'tc_whooslider_styling', '#000' ); ?>;
}

/* styling the Overlay Title*/
.tc-wps-overlay{
  background-color:<?php echo tc_wooslider_option('overlay-color', 'tc_whooslider_styling', '#2CC990'); ?>;
}
.tc-wps-overlay a.tc-product-title-overlay{

  color:<?php echo tc_wooslider_option('overlay-title', 'tc_whooslider_styling', '#ffffff' ); ?>;
  line-height:21px;
  font-size: 20px;
  display: block;
  padding:4px 0;
}
.tc-wps-overlay a.tc-product-title-overlay:hover{
  color:<?php echo tc_wooslider_option('overlay-title-hover', 'tc_whooslider_styling', '#d7d7d7' ); ?>;
  line-height:21px;
  font-size: 20px;
  display: block;
  padding:4px 0;
}
/* styling the Title*/
div.tc-wooslider-item a.tc-product-title-bottom,a.tc-product-title {
  margin-top: 30px;
  color:<?php echo tc_wooslider_option('title-color', 'tc_whooslider_styling', '#343434' ); ?>;
  font-size:14px;
  line-height:21px;
}
div.tc-wooslider-item a.tc-product-title-bottom:hover,a.tc-product-title:hover{
  margin-top: 30px;
  color:<?php echo tc_wooslider_option('title-hover-color', 'tc_whooslider_styling', '#d7d7d7' ); ?>;
}

/* styling the Price value*/

div.tc-wps-overlay div.tc_price_value,div.tc_price_value{
  color: <?php echo tc_wooslider_option('pirce-text', 'tc_whooslider_styling', '#ffffff' ); ?>;
  font-weight: 600;
  font-size: 16px;
  line-height:26px;
  text-align: center;
}

div.tc-wps-overlay div.tc_price_value:hover,div.tc_price_value:hover{
  color: <?php echo tc_wooslider_option('pirce-text-hover', 'tc_whooslider_styling', '#d7d7d7' ); ?>;
}

/*styling Cart Button*/
div.tc-wooslider-item .tc-cart-button a {
  color: <?php echo tc_wooslider_option('cart-button-color', 'tc_whooslider_styling', '#ffffff' ); ?>;
  border: 1px solid <?php echo tc_wooslider_option('cart-button-color', 'tc_whooslider_styling', '#ffffff' ); ?>;

}
div.tc-wooslider-item .tc-cart-button a:hover{
  border:1px solid <?php echo tc_wooslider_option('cart-button-color-hover', 'tc_whooslider_styling', '#66CC99' ); ?>;
  background-color: <?php echo tc_wooslider_option('cart-button-color-hover', 'tc_whooslider_styling', '#66CC99' ); ?>;


}

 </style>
 <?php
 }
 add_action('wp_footer','tc_wooslider_style_trigger');
