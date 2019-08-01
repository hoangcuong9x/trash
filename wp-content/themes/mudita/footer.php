<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Mudita
 */

$enabled_sections = mudita_get_sections();

    if( is_home() || ! $enabled_sections ||  ! ( is_front_page()  || is_page_template( 'template-home.php' ) ) ){ 
        echo '</div></div></div>'; //<!-- .row --><!-- #content --><!-- .container -->
    }
    	
    $ed_social_links = get_theme_mod( 'mudita_ed_social_section' );
    if( $ed_social_links ){
    ?>
        <div class="social-block">
    		<div class="container">
    			<?php do_action( 'mudita_social_links', true ); ?>
    		</div>
    	</div>
    <?php }?>
    
	<footer id="colophon" class="site-footer" role="contentinfo">
        <div class="container">
            
            <?php if( is_active_sidebar( 'footer-one' ) || is_active_sidebar( 'footer-two' ) || is_active_sidebar( 'footer-three' ) || is_active_sidebar( 'footer-four' )) { ?>
            <div class="footer-t">
				<div class="row">
				    <?php if( is_active_sidebar( 'footer-one' ) ){ ?>
    					<div class="column">
    					   <?php dynamic_sidebar( 'footer-one' ); ?>	
    					</div>
                    <?php } ?>
					
                    <?php if( is_active_sidebar( 'footer-two' ) ){ ?>
                        <div class="column">
    					   <?php dynamic_sidebar( 'footer-two' ); ?>	
    					</div>
                    <?php } ?>
                    
                    <?php if( is_active_sidebar( 'footer-three' ) ){ ?>
                        <div class="column">
    					   <?php dynamic_sidebar( 'footer-three' ); ?>	
    					</div>
                    <?php } ?>
                    
                   	<?php if( is_active_sidebar( 'footer-four' ) ){ ?>
                        <div class="column">
    					   <?php dynamic_sidebar( 'footer-four' ); ?>	
    					</div>
                    <?php } ?>			
				</div>
			</div>
            <?php } 
            
            do_action( 'mudita_footer' );
            
            ?>
        </div><!-- .container -->        
	</footer><!-- #colophon -->
    
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>