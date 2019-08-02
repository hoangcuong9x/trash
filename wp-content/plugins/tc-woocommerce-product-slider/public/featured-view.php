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
 function tc_wooslider_option_featured( $option, $section, $default = '' ) {

     $options = get_option( $section );

     if ( isset( $options[$option] ) ) {
         return $options[$option];
     }

     return $default;
 }

add_shortcode('tc-featured-product', 'tc_woo_featured_product_view' );


function tc_woo_featured_product_view($atts) {

  // Attributes
extract( shortcode_atts(
  array(
    'posts_num' => "-1",
    'order' => 'DESC',
    'carousel_cat'=>'',
    'hover'=>'tczoomin',
    'style'=>''

  ), $atts )
);

// items
$tcwps_lg_desktop=tc_wooslider_option('large-item-val','tc_whooslider_basics', '5' );
$tcwps_sm_desktop=tc_wooslider_option('sm_desktops','tc_whooslider_basics', '4' );
$tcwps_tablets=tc_wooslider_option('items-tablet-val','tc_whooslider_basics', '3' );
$tcwps_mobi_items=tc_wooslider_option('items-mobile-val','tc_whooslider_basics', '2' );
$tcwps_wl=tc_wooslider_option('sd_word_n','tc_whooslider_advanced', 18 );

// show hide
$tcwps_hsd=tc_wooslider_option('hide_sd','tc_whooslider_showhide', 'false' );
$tcwps_hstart=tc_wooslider_option('hide_start','tc_whooslider_showhide', 'false' );

      $args = array(
            'post_type' => 'product',
            'posts_per_page' => 12,
            'tax_query' => array(
                    array(
                        'taxonomy' => 'product_visibility',
                        'field'    => 'name',
                        'terms'    => 'featured',
                    ),
                ),
            );
        $tc_wps_loop = new WP_Query( $args );
        $output = '<div class="tcwps-wrap tc-wooslider-container-featured">';
        $output .= '<div class="tc-wooslider-featured owl-carousel tcwps-nav">';

        if ( $tc_wps_loop->have_posts() ) {
            while ( $tc_wps_loop->have_posts() ) : $tc_wps_loop->the_post();

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

                       $output .= '<div class="tc-cart-button">'.do_shortcode('[add_to_cart id="'.get_the_ID().'" style=""]').'</div>';



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

                $output .= '</div>'; // end .tc-wooslider-item

            endwhile;
        } else {
            echo __( 'No products found' );
        }
        wp_reset_postdata();

        $output .= '</div><!--/.tc-carousel-containe-->';
        $output .= '</div><!--/.tc-carousel-demo-->';

?>


   <script type="text/javascript">

   jQuery(document).ready(function(){
       jQuery(".tc-wooslider-featured").owlCarousel({

         // control
         autoplay:<?php  echo tc_wooslider_option('auto-play','tc_whooslider_basics', 'true' );?>,
         autoplayHoverPause:<?php  echo tc_wooslider_option('stop-onhover','tc_whooslider_basics', 'true' ); ?>,
         autoplayTimeout:<?php echo tc_wooslider_option('auto_play_timeout','tc_whooslider_basics', 5000 ); ?>,
         loop:<?php echo tc_wooslider_option('loop','tc_whooslider_basics', 'true' ); ?>,
         // Advances
         nav:<?php  echo tc_wooslider_option('nav-val','tc_whooslider_advanced', 'true' ); ?>,
         navText:['<i class="fa fa-angle-left" aria-hidden="true"></i>','<i class="fa fa-angle-right" aria-hidden="true"></i>'],
         autoHeight:<?php  echo tc_wooslider_option('autoheight','tc_whooslider_advanced', 'false' ); ?>,
         dots:<?php echo tc_wooslider_option('dots-val','tc_whooslider_advanced', 'false' ); ?>,
         responsiveClass:true,
         responsive:{
             0:{
                 items:<?php echo $tcwps_mobi_items; ?>,
             },
             600:{
                 items:<?php echo $tcwps_tablets; ?>,

             },
             1000:{
                 items:<?php  echo $tcwps_sm_desktop; ?>,

             },
             1200:{
                 items:<?php echo $tcwps_lg_desktop; ?>,

             },

         }

      });

   });


   </script>
   <?php
   return $output;


 }
 ?>
