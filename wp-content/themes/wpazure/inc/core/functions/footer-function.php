<?php 
/**
 * Function to get site Footer
 */
if ( ! function_exists( 'wpazure_footer_markup' ) ) {

	/**
	 * Site Footer - <footer>
	 */
	function wpazure_footer_markup() {
		
		
		//Set widget areas classes based on user choice

		$AzureWidgetArea = get_theme_mod('azure_footer_widgt_layout', 'layout-3');
		$AzureFooterBarOne = get_theme_mod('azure_footer_bar_section_one','custom_text');
		$AzureFooterBarTwo = get_theme_mod('azure_footer_bar_section_two','footer_menu');
		$AzureFooterBar = 'content_width';

		switch($AzureWidgetArea)
		{
			case "layout-3":
			$cols = 'col-md-4';
			break;
			
			default:
			$cols = 'footer_off';
			
		}
?>
<?php
if($AzureWidgetArea !='footer_off'){?>
	<footer class="az-footer">
	<div class="container">
		<div class="row">
			<?php if ( is_active_sidebar( 'footer-1' ) ) { ?>
				<div class="<?php echo esc_attr($cols); ?> col-sm-4 col-12">
					<?php dynamic_sidebar( 'footer-1'); ?>
				</div>
			<?php } else {?>
				<div class="widget wpazure-no-widget-row">
					<h2 class="widget-title"><?php echo esc_html__('Footer Widget Area 1','wpazure');?></h2>
					<p class="no-widget-text">
						<a href="<?php echo get_home_url(); ?>/wp-admin/widgets.php">
							<?php echo esc_html__('Click here to assign a widget for this area.','wpazure');?></a>
					</p>
				</div>
			<?php }?>
			
			<?php if ( is_active_sidebar( 'footer-2' ) ) { ?>
				<div class="<?php echo esc_attr($cols); ?> col-sm-4 col-12">
					<?php dynamic_sidebar( 'footer-2'); ?>
				</div>
			<?php } else { ?>
				<div class="widget wpazure-no-widget-row">
					<h2 class="widget-title"><?php echo esc_html__('Footer Widget Area 2','wpazure');?></h2>
					<p class="no-widget-text">
						<a href="<?php echo get_home_url(); ?>/wp-admin/widgets.php">
							<?php echo esc_html__('Click here to assign a widget for this area.','wpazure');?></a>
					</p>
				</div>
			<?php }?>			
			<?php if ( is_active_sidebar( 'footer-3' ) ) { ?>
				<div class="<?php echo esc_attr($cols); ?> col-sm-4 col-12">
					<?php dynamic_sidebar( 'footer-3'); ?>
				</div>
			<?php } else { ?>
			<div class="widget wpazure-no-widget-row">
				<h2 class="widget-title"><?php echo esc_html__('Footer Widget Area 3','wpazure');?></h2>
				<p class="no-widget-text">
					<a href="<?php echo get_home_url(); ?>/wp-admin/widgets.php">
						<?php echo esc_html__('Click here to assign a widget for this area.','wpazure');?></a>
				</p>
			</div>
			<?php }?>
			
		</div>
	</div>
	</footer>
<?php }



$AzureEnableFooterCopyright =  get_theme_mod('azure_footer_copyright_layout_layout','footer_bar_full');
			
			if($AzureEnableFooterCopyright!= 'footer_bar_off'){
				
					switch($AzureEnableFooterCopyright){
					case "footer_bar_center":
					$FooterCopyright = 'col-sm-12';
					$FooterCenter = 'footerBarCenter';
					break;
					default:
					$FooterCopyright = 'col-sm-6';
					$FooterCenter = '';
					
				}
				?>
	
	<div class="<?php if($AzureWidgetArea !='footer_off'){ echo 'copyright-section';} else {echo 'not-footer-copyright-section'; }?>">
	<div class="<?php if($AzureFooterBar == 'content_width') {echo 'container';} else { echo 'container-fluid';}?> ">
    <div class="row">
        <div class="col-12">
				<div class="copyright <?php echo esc_attr($FooterCenter .' '. $AzureFooterBar);  ?> row" >
					<?php if($AzureFooterBarOne != 'none'){ ?>
					
						<div class="<?php if($AzureFooterBarTwo != 'none') {echo esc_attr($FooterCopyright);} else { echo 'col-sm-12';} ?> col-12 footerbar-left-content">
							<?php if($AzureFooterBarOne == 'custom_text'){ 
							
							$footer_copyright = get_theme_mod('azure_footer_section_one','<p>'.__( '<a href="https://wordpress.org">Proudly powered by WordPress</a> | Theme: <a href="https://wpazure.com" rel="designer">Wpazure</a> by Wpazure', 'wpazure' ).'</p>');
							echo wp_kses_post($footer_copyright);
							}
							else if($AzureFooterBarOne == 'footer_menu')
							{
								?>
								<ul class="footer-links">
								  <?php  
									wp_nav_menu(
										array(
											'theme_location'  => 'footer',
											'container'  => 'false',
											'depth'          => -1,
											'menu_class' => '',
											'fallback_cb'     => 'Wpazure_Bootstrap_Navwalker::fallback',
											'walker'          => new Wpazure_Bootstrap_Navwalker(),
										)
									);
									?>
								</ul><?php	
							}
							else if($AzureFooterBarOne == 'widget'){
								
								if ( is_active_sidebar( 'footer-widget-1' ) ) : 
									dynamic_sidebar( 'footer-widget-1'); 
								endif;
								
							}?>
						</div>
					<?php } 
					if($AzureFooterBarTwo != 'none')
					{ ?>
						<div class="<?php if($AzureFooterBarOne != 'none') {echo esc_attr($FooterCopyright);} else { echo 'col-sm-12';} ?> col-12 footerbar-right-content">
							<?php if($AzureFooterBarTwo == 'custom_text'){ 
							
							$footer_copyright = get_theme_mod('azure_footer_section_two','<p>'.__( '<a href="https://wordpress.org">Proudly powered by WordPress</a> | Theme: <a href="https://wpazure.com" rel="designer">Wpazure</a> by Wpazure', 'wpazure' ).'</p>');
							echo wp_kses_post($footer_copyright);
							}
							else if($AzureFooterBarTwo == 'footer_menu')
							{
								?>
								<ul class="footer-links">
								  <?php  
									wp_nav_menu(
										array(
											'theme_location'  => 'footer',
											'container'  => 'false',
											'depth'          => -1,
											'menu_class' => '',
											'fallback_cb'     => 'Wpazure_Bootstrap_Navwalker::fallback',
											'walker'          => new Wpazure_Bootstrap_Navwalker(),
										)
									);
									?>
								</ul><?php	
							}
							else if($AzureFooterBarTwo == 'widget'){
								
								if ( is_active_sidebar( 'footer-widget-2' ) ) : 
									dynamic_sidebar( 'footer-widget-2'); 
								endif;
								
							}?>
						</div><?php 
					} ?>
				</div>
			</div>
    </div>
</div>
</div>
<?php } 
 } }

add_action( 'wpazure_footer', 'wpazure_footer_markup' );