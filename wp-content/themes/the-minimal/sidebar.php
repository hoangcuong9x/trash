<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package The_Minimal
 */

if ( ! is_active_sidebar( 'right-sidebar' ) ) {
	return;
}
?>
</div><!-- .col-md-8 -->
    
    <div class="col-md-4">
        <aside id="secondary" class="widget-area" role="complementary" itemscope itemtype="http://schema.org/WPSideBar">
    	   <?php dynamic_sidebar( 'right-sidebar' ); ?>
        </aside><!-- #secondary -->
    </div>

</div><!-- .row -->