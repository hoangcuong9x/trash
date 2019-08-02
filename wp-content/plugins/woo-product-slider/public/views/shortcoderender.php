<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class SP_WPS_ShortCode {
	/**
	 * @var SP_WPS_ShortCode single instance of the class
	 *
	 * @since 2.0
	 */
	protected static $_instance = null;

	/**
	 * Main SP Instance
	 *
	 * @since 2.0
	 * @static
	 * @return self Main instance
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	/**
	 * SP_WPS_ShortCode constructor.
	 */
	public function __construct() {
		add_shortcode( 'woo_product_slider', array( $this, 'wps_shortcode' ) );
	}

	/**
	 * @param $attributes
	 *
	 * @return string
	 */
	public function wps_shortcode( $attributes ) {
		extract( shortcode_atts( array(
			'id' => '',
		), $attributes, 'woo_product_slider' ) );

		$post_id = $attributes['id'];

		$wps_number_of_total_products = intval( get_post_meta( $post_id, 'wps_number_of_total_products', true ) );
		$wps_number_of_column         = intval( get_post_meta( $post_id, 'wps_number_of_column', true ) );
		$wps_number_of_column_desktop = intval( get_post_meta( $post_id, 'wps_number_of_column_desktop', true ) );
		$wps_number_of_column_tablet  = intval( get_post_meta( $post_id, 'wps_number_of_column_tablet', true ) );
		$wps_number_of_column_mobile  = intval( get_post_meta( $post_id, 'wps_number_of_column_mobile', true ) );
		$wps_auto_play_speed          = intval( get_post_meta( $post_id, 'wps_auto_play_speed', true ) );
		$wps_scroll_speed             = intval( get_post_meta( $post_id, 'wps_scroll_speed', true ) );
		$wps_product_name_font_size   = intval( get_post_meta( $post_id, 'wps_product_name_font_size', true ) );
		$wps_slider_title_font_size   = intval( get_post_meta( $post_id, 'wps_slider_title_font_size', true ) );

		$wps_slider_title_color             = get_post_meta( $post_id, 'wps_slider_title_color', true );
		$wps_themes                         = get_post_meta( $post_id, 'wps_themes', true );
		$wps_nav_arrow_color                = get_post_meta( $post_id, 'wps_nav_arrow_color', true );
		$wps_nav_arrow_bg                   = get_post_meta( $post_id, 'wps_nav_arrow_bg', true );
		$wps_pagination_color               = get_post_meta( $post_id, 'wps_pagination_color', true );
		$wps_pagination_active_color        = get_post_meta( $post_id, 'wps_pagination_active_color', true );
		$wps_product_name_color             = get_post_meta( $post_id, 'wps_product_name_color', true );
		$wps_product_name_hover_color       = get_post_meta( $post_id, 'wps_product_name_hover_color', true );
		$wps_price_color                    = get_post_meta( $post_id, 'wps_price_color', true );
		$wps_discount_price_color           = get_post_meta( $post_id, 'wps_discount_price_color', true );
		$wps_add_to_cart_color              = get_post_meta( $post_id, 'wps_add_to_cart_color', true );
		$wps_add_to_cart_bg                 = get_post_meta( $post_id, 'wps_add_to_cart_bg', true );
		$wps_add_to_cart_border_color       = get_post_meta( $post_id, 'wps_add_to_cart_border_color', true );
		$wps_add_to_cart_hover_color        = get_post_meta( $post_id, 'wps_add_to_cart_hover_color', true );
		$wps_add_to_cart_hover_bg           = get_post_meta( $post_id, 'wps_add_to_cart_hover_bg', true );
		$wps_add_to_cart_border_hover_color = get_post_meta( $post_id, 'wps_add_to_cart_border_hover_color', true );

		$wps_slider_title     = $this->get_meta( $post_id, 'wps_slider_title', 'true' );
		$wps_add_to_cart     = $this->get_meta( $post_id, 'wps_add_to_cart', 'true' );
		$wps_product_rating  = $this->get_meta( $post_id, 'wps_product_rating', 'true' );
		$wps_product_price   = $this->get_meta( $post_id, 'wps_product_price', 'true' );
		$wps_product_name    = $this->get_meta( $post_id, 'wps_product_name', 'true' );
		$wps_auto_play       = $this->get_meta( $post_id, 'wps_auto_play', 'true' );
		$wps_pause_on_hover  = $this->get_meta( $post_id, 'wps_pause_on_hover', 'true' );
		$wps_show_navigation = $this->get_meta( $post_id, 'wps_show_navigation', 'true' );
		$wps_show_pagination = $this->get_meta( $post_id, 'wps_show_pagination', 'true' );
		$wps_touch_swipe     = $this->get_meta( $post_id, 'wps_touch_swipe', 'true' );
		$wps_mouse_draggable = $this->get_meta( $post_id, 'wps_mouse_draggable', 'true' );
		$wps_rtl             = $this->get_meta( $post_id, 'wps_rtl', 'true' );

		$args = array(
			'post_type'      => 'product',
			'orderby'        => get_post_meta( $post_id, 'wps_order_by', true ),
			'order'          => get_post_meta( $post_id, 'wps_order', true ),
			'posts_per_page' => $wps_number_of_total_products,
		);

		$que = new WP_Query( $args );

		$outline = '';

		$outline .= '<style type="text/css">';
		if ( $wps_show_pagination == 'true' ) {
			$outline .= 'div#wps-slider-section #sp-woo-product-slider-' . $post_id . '.wps-product-section ul.slick-dots li button{
				background-color:' . $wps_pagination_color . ';
			}
			div#wps-slider-section #sp-woo-product-slider-' . $post_id . '.wps-product-section ul.slick-dots li.slick-active button{
				background-color:' . $wps_pagination_active_color . ';
			}';
		}
		if ( $wps_show_navigation == 'true' ) {
			$outline .= 'div#wps-slider-section #sp-woo-product-slider-' . $post_id . '.wps-product-section .slick-arrow{
				color:' . $wps_nav_arrow_color . ';
				background-color:' . $wps_nav_arrow_bg . ';
			}';
		}
		if ( $wps_show_navigation == 'true' && $wps_slider_title == 'false' ) {
			$outline .= '
			div#wps-slider-section.wps-slider-section-' . $post_id . '{
				padding-top: 45px;
			}';
		}
		if ( $wps_product_name == 'true' ) {
			$outline .= 'div#wps-slider-section #sp-woo-product-slider-' . $post_id . ' .wpsf-product-title a{
				color: ' . $wps_product_name_color . ';
				font-size: ' . $wps_product_name_font_size . 'px;
			}
			div#wps-slider-section #sp-woo-product-slider-' . $post_id . ' .wpsf-product-title a:hover{
				color: ' . $wps_product_name_hover_color . ';
			}';
		}
		if ( $wps_product_price == 'true' ) {
			$outline .= 'div#wps-slider-section #sp-woo-product-slider-' . $post_id . ' .wpsf-product-price{
				color: ' . $wps_price_color . ';
			}
			div#wps-slider-section #sp-woo-product-slider-' . $post_id . ' .wpsf-product-price del span{
				color: ' . $wps_discount_price_color . ';
			}';
		}
		if ( $wps_add_to_cart == 'true' ) {
			$outline .= 'div#wps-slider-section #sp-woo-product-slider-' . $post_id . ' .wpsf-cart-button a:not(.sp-wqvpro-view-button):not(.sp-wqv-view-button){
				color: ' . $wps_add_to_cart_color . ';
				background-color: ' . $wps_add_to_cart_bg . ';
				border-color: ' . $wps_add_to_cart_border_color . ';
			}
			div#wps-slider-section #sp-woo-product-slider-' . $post_id . ' .wpsf-cart-button a:not(.sp-wqvpro-view-button):not(.sp-wqv-view-button):hover,
			div#wps-slider-section #sp-woo-product-slider-' . $post_id . ' .wpsf-cart-button a.added_to_cart{
				color: ' . $wps_add_to_cart_hover_color . ';
				background-color: ' . $wps_add_to_cart_hover_bg . ';
				border-color: ' . $wps_add_to_cart_border_hover_color . ';
			}';
		}

		$outline .= '</style>';

		if ( $wps_themes == 'theme_one' ) {
			$outline .= '<div id="wps-slider-section" class="wps-slider-section wps-slider-section-' . $post_id . '">';
			if ( $wps_slider_title == 'true' ) {
				$outline .= '<h2 style="color: ' . $wps_slider_title_color . '; font-size: ' . $wps_slider_title_font_size . 'px;" class="sp-woo-product-slider-section-title">' . get_the_title( $post_id ) . '</h2>';
			}
			$outline .= '<div id="sp-woo-product-slider-' . $post_id . '" class="wps-product-section sp-wps-' . $wps_themes . '"';
			$outline .= ' data-slick=\'{"dots": ' . $wps_show_pagination . ', "pauseOnHover": ' . $wps_pause_on_hover . ', "slidesToShow": ' . $wps_number_of_column . ', "speed": ' . $wps_scroll_speed . ', "arrows": ' . $wps_show_navigation . ', "autoplay": ' . $wps_auto_play . ', "autoplaySpeed": ' . $wps_auto_play_speed . ', "swipe": ' . $wps_touch_swipe . ', "draggable": ' . $wps_mouse_draggable . ', "rtl": ' . $wps_rtl . ',  "responsive": [ {"breakpoint": 1100, "settings": { "slidesToShow": ' . $wps_number_of_column_desktop . ' } }, {"breakpoint": 990, "settings": { "slidesToShow": ' . $wps_number_of_column_tablet . ' } }, {"breakpoint": 650, "settings": { "slidesToShow": ' . $wps_number_of_column_mobile . ' } } ] }\' >';

			if ( $que->have_posts() ) {
				while ( $que->have_posts() ) :
					$que->the_post();
					global $product;

					$outline .= '<div class="wpsf-product">';
					$outline .= '<a href="' . esc_url( get_the_permalink() ) . '">';
					if ( has_post_thumbnail( $que->post->ID ) ) {
						$product_thumb = 'shop_catalog_image_size';
						$wps_product_image_size = apply_filters( 'sp_wps_product_image_size', $product_thumb );
						$outline .= get_the_post_thumbnail( $que->post->ID, $wps_product_image_size, array( 'class' => 'wpsf-product-img' ) );
					} else {
						$outline .= '<img id="place_holder_thm" src="' . wc_placeholder_img_src() . '" alt="Placeholder" />';
					}
					$outline .= '</a>';

					if ( $wps_product_name == 'true' ) {
						$outline .= '<div class="wpsf-product-title"><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></div>';
					}

					if ( $wps_product_price == 'true' ) {
						if ( class_exists( 'WooCommerce' ) && $price_html = $product->get_price_html() ) {
							$outline .= '<div class="wpsf-product-price">' . $price_html . '</div>';
						};
					}

					if ( class_exists( 'WooCommerce' ) && $wps_product_rating == 'true' ) {
						$average = $product->get_average_rating();
						if ( $average > 0 ) {
							$outline .= '<div class="star-rating" title="' . esc_html__( 'Rated', 'woo-product-slider' ) . ' ' . $average . '' . esc_html__( ' out of 5', 'woo-product-slider' ) . '"><span style="width:' . ( ( $average / 5 ) * 100 ) . '%"><strong itemprop="ratingValue" class="rating">' . $average . '</strong> ' . esc_html__( 'out of 5', 'woo-product-slider' ) . '</span></div>';
						}
					}
					if ( $wps_add_to_cart == 'true' ) {
						$outline .= '<div class="wpsf-cart-button">' . do_shortcode( '[add_to_cart id="' . get_the_ID() . '" show_price="false"]' ) . '</div>';
					}
					$outline .= '</div>';

				endwhile;
			} else {
				$outline .= '<h2 class="sp-not-found-any-product-f">' . __( 'No products found', 'woo-product-slider' ) . '</h2>';
			}
			$outline .= '</div>';
			$outline .= '</div>';

		} elseif ( $wps_themes == 'theme_two' ) {
			$outline .= '<div id="wps-slider-section" class="wps-slider-section wps-slider-section-' . $post_id . '">';
			if ( $wps_slider_title == 'true' ) {
				$outline .= '<h2 style="color: ' . $wps_slider_title_color . '; font-size: ' . $wps_slider_title_font_size . 'px;" class="sp-woo-product-slider-section-title">' . get_the_title( $post_id ) . '</h2>';
			}
			$outline .= '<div id="sp-woo-product-slider-' . $post_id . '" class="wps-product-section sp-wps-' . $wps_themes . '"';
			$outline .= ' data-slick=\'{"dots": ' . $wps_show_pagination . ', "pauseOnHover": ' . $wps_pause_on_hover . ', "slidesToShow": ' . $wps_number_of_column . ', "speed": ' . $wps_scroll_speed . ', "arrows": ' . $wps_show_navigation . ', "autoplay": ' . $wps_auto_play . ', "autoplaySpeed": ' . $wps_auto_play_speed . ', "swipe": ' . $wps_touch_swipe . ', "draggable": ' . $wps_mouse_draggable . ', "rtl": ' . $wps_rtl . ',  "responsive": [ {"breakpoint": 1100, "settings": { "slidesToShow": ' . $wps_number_of_column_desktop . ' } }, {"breakpoint": 990, "settings": { "slidesToShow": ' . $wps_number_of_column_tablet . ' } }, {"breakpoint": 650, "settings": { "slidesToShow": ' . $wps_number_of_column_mobile . ' } } ] }\' >';

			if ( $que->have_posts() ) {
				while ( $que->have_posts() ) :
					$que->the_post();
					global $product;

					$outline .= '<div class="wpsf-product">';
					$outline .= '<a href="' . esc_url( get_the_permalink() ) . '">';
					if ( has_post_thumbnail( $que->post->ID ) ) {
						$product_thumb = 'shop_catalog_image_size';
						$wps_product_image_size = apply_filters( 'sp_wps_product_image_size', $product_thumb );
						$outline .= get_the_post_thumbnail( $que->post->ID, $wps_product_image_size, array( 'class' => 'wpsf-product-img' ) );
					} else {
						$outline .= '<img id="place_holder_thm" src="' . wc_placeholder_img_src() . '" alt="Placeholder" />';
					}
					$outline .= '</a>';

					$outline .= '<div class="sp-wps-product-details">';
					$outline .= '<div class="sp-wps-product-details-inner">';
					if ( $wps_product_name == 'true' ) {
						$outline .= '<div class="wpsf-product-title"><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></div>';
					}

					if ( $wps_product_price == 'true' ) {
						if ( class_exists( 'WooCommerce' ) && $price_html = $product->get_price_html() ) {
							$outline .= '<div class="wpsf-product-price">' . $price_html . '</div>';
						};
					}

					if ( class_exists( 'WooCommerce' ) && $wps_product_rating == 'true' ) {
						$average = $product->get_average_rating();
						if ( $average > 0 ) {
							$outline .= '<div class="star-rating" title="' . esc_html__( 'Rated', 'woo-product-slider' ) . ' ' . $average . '' . esc_html__( ' out of 5', 'woo-product-slider' ) . '"><span style="width:' . ( ( $average / 5 ) * 100 ) . '%"><strong itemprop="ratingValue" class="rating">' . $average . '</strong> ' . esc_html__( 'out of 5', 'woo-product-slider' ) . '</span></div>';
						}
					}
					if ( $wps_add_to_cart == 'true' ) {
						$outline .= '<div class="wpsf-cart-button">' . do_shortcode( '[add_to_cart id="' . get_the_ID() . '" show_price="false"]' ) . '</div>';
					}
					$outline .= '</div>'; // sp-wps-product-details-inner.
					$outline .= '</div>'; // sp-wps-product-details.
					$outline .= '</div>';

				endwhile;
			} else {
				$outline .= '<h2 class="sp-not-found-any-product-f">' . __( 'No products found', 'woo-product-slider' ) . '</h2>';
			}
			$outline .= '</div>';
			$outline .= '</div>';
		} elseif ( $wps_themes == 'theme_three' ) {
			$outline .= '<div id="wps-slider-section" class="wps-slider-section wps-slider-section-' . $post_id . '">';
			if ( $wps_slider_title == 'true' ) {
				$outline .= '<h2 style="color: ' . $wps_slider_title_color . '; font-size: ' . $wps_slider_title_font_size . 'px;" class="sp-woo-product-slider-section-title">' . get_the_title( $post_id ) . '</h2>';
			}
			$outline .= '<div id="sp-woo-product-slider-' . $post_id . '" class="wps-product-section sp-wps-' . $wps_themes . '"';
			$outline .= ' data-slick=\'{"dots": ' . $wps_show_pagination . ', "pauseOnHover": ' . $wps_pause_on_hover . ', "slidesToShow": ' . $wps_number_of_column . ', "speed": ' . $wps_scroll_speed . ', "arrows": ' . $wps_show_navigation . ', "autoplay": ' . $wps_auto_play . ', "autoplaySpeed": ' . $wps_auto_play_speed . ', "swipe": ' . $wps_touch_swipe . ', "draggable": ' . $wps_mouse_draggable . ', "rtl": ' . $wps_rtl . ',  "responsive": [ {"breakpoint": 1100, "settings": { "slidesToShow": ' . $wps_number_of_column_desktop . ' } }, {"breakpoint": 990, "settings": { "slidesToShow": ' . $wps_number_of_column_tablet . ' } }, {"breakpoint": 650, "settings": { "slidesToShow": ' . $wps_number_of_column_mobile . ' } } ] }\' >';

			if ( $que->have_posts() ) {
				while ( $que->have_posts() ) :
					$que->the_post();
					global $product;

					$outline .= '<div class="wpsf-product">';
					$outline .= '<div class="sp-wps-product-image-area">';
					$outline .= '<a href="' . esc_url( get_the_permalink() ) . '">';
					if ( has_post_thumbnail( $que->post->ID ) ) {
						$product_thumb = 'shop_catalog_image_size';
						$wps_product_image_size = apply_filters( 'sp_wps_product_image_size', $product_thumb );
						$outline .= get_the_post_thumbnail( $que->post->ID, $wps_product_image_size, array( 'class' => 'wpsf-product-img' ) );
					} else {
						$outline .= '<img id="place_holder_thm" src="' . wc_placeholder_img_src() . '" alt="Placeholder" />';
					}
					$outline .= '</a>';

					$outline .= '<div class="sp-wps-product-details">';
					$outline .= '<div class="sp-wps-product-details-inner">';
					if ( $wps_product_name == 'true' ) {
						$outline .= '<div class="wpsf-product-title"><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></div>';
					}

					if ( $wps_product_price == 'true' ) {
						if ( class_exists( 'WooCommerce' ) && $price_html = $product->get_price_html() ) {
							$outline .= '<div class="wpsf-product-price">' . $price_html . '</div>';
						};
					}

					if ( class_exists( 'WooCommerce' ) && $wps_product_rating == 'true' ) {
						$average = $product->get_average_rating();
						if ( $average > 0 ) {
							$outline .= '<div class="star-rating" title="' . esc_html__( 'Rated', 'woo-product-slider' ) . ' ' . $average . '' . esc_html__( ' out of 5', 'woo-product-slider' ) . '"><span style="width:' . ( ( $average / 5 ) * 100 ) . '%"><strong itemprop="ratingValue" class="rating">' . $average . '</strong> ' . esc_html__( 'out of 5', 'woo-product-slider' ) . '</span></div>';
						}
					}
					if ( $wps_add_to_cart == 'true' ) {
						$outline .= '<div class="wpsf-cart-button">' . do_shortcode( '[add_to_cart id="' . get_the_ID() . '" show_price="false"]' ) . '</div>';
					}
					$outline .= '</div>'; // sp-wps-product-details-inner.
					$outline .= '</div>'; // sp-wps-product-details.
					$outline .= '</div>'; // sp-wps-product-image-area.
					$outline .= '</div>';

				endwhile;
			} else {
				$outline .= '<h2 class="sp-not-found-any-product-f">' . __( 'No products found', 'woo-product-slider' ) . '</h2>';
			}
			$outline .= '</div>';
			$outline .= '</div>';
		}

		wp_reset_query();

		return $outline;
	}

	/**
	 * Get post meta by id and key
	 *
	 * @param $post_id
	 * @param $key
	 * @param $default
	 *
	 * @return string|void
	 */
	public function get_meta( $post_id, $key, $default = null ) {
		$meta = get_post_meta( $post_id, $key, true );
		if ( empty( $meta ) && $default ) {
			$meta = $default;
		}

		if ( $meta == 'zero' ) {
			$meta = '0';
		}
		if ( $meta == 'on' ) {
			$meta = 'true';
		}
		if ( $meta == 'off' ) {
			$meta = 'false';
		}

		return esc_attr( $meta );
	}

}

new SP_WPS_ShortCode();
