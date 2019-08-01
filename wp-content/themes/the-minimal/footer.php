<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package The_Minimal
 */

?>
            
        </div><!-- .container -->
	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo" itemscope itemtype="http://schema.org/WPFooter">
		
        <div class="container">
			<?php if( is_active_sidebar( 'footer-one' ) || is_active_sidebar( 'footer-two' ) || is_active_sidebar( 'footer-three' ) ){?>
                <div class="about_site"> 
    				<div class="row">
                        <?php if( is_active_sidebar( 'footer-one' ) ){ ?>
        					<div class="col-md-4">
        					   <?php dynamic_sidebar( 'footer-one' ); ?>	
        					</div>
                        <?php } ?>
    					
                        <?php if( is_active_sidebar( 'footer-two' ) ){ ?>
                            <div class="col-md-4">
        					   <?php dynamic_sidebar( 'footer-two' ); ?>	
        					</div>
                        <?php } ?>
                        
                        <?php if( is_active_sidebar( 'footer-three' ) ){ ?>
                            <div class="col-md-4">
        					   <?php dynamic_sidebar( 'footer-three' ); ?>	
        					</div>
                        <?php } ?>
    				</div>
    			</div><!-- .about_site -->
			<?php }
            
            do_action( 'the_minimal_footer' ); //footer credits
            
            ?>
		</div><!-- .container -->
	</footer><!-- #colophon -->
    <div class="overlay"></div>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
