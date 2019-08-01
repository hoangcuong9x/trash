<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package eCommerce_Market
 */

?>

  <?php
  /**
   * Hook - ecommerce_market_action_after_content.
   *
   * @hooked ecommerce_market_content_end - 10
   */
  do_action( 'ecommerce_market_action_after_content' );
  ?>

  <?php
  /**
   * Hook - ecommerce_market_action_before_footer.
   *
   * @hooked ecommerce_market_add_footer_bottom_widget_area - 5
   * @hooked ecommerce_market_footer_start - 10
   */
  do_action( 'ecommerce_market_action_before_footer' );
  ?> 
  <?php
    /**
     * Hook - ecommerce_market_action_footer.
     *
     * @hooked ecommerce_market_footer_copyright - 10
     */
    do_action( 'ecommerce_market_action_footer' );
  ?>
  <?php
  /**
   * Hook - ecommerce_market_action_before_footer.
   *
   * @hooked ecommerce_market_add_footer_bottom_widget_area - 5
   * @hooked ecommerce_market_footer_start - 10
   */
  do_action( 'ecommerce_market_action_after_footer' );
  ?>  

 
  <div class="back-to-top">
    <a href="#masthead" title="Go to Top" class="fa-angle-up"></a>       
  </div>
  <?php
  /**
   * Hook - ecommerce_market_action_after.
   *
   * @hooked ecommerce_market_page_end - 10   * 
   */
  do_action( 'ecommerce_market_action_after' );
  ?>

<?php wp_footer(); ?>
    
</body>
</html>
