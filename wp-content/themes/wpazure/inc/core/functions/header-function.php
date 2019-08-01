<?php
/**
 * Function to get site Header
 */
if ( ! function_exists( 'wpazure_header_markup' ) ) {

	
	function wpazure_header_markup() {
		
		$AzureMenuType = get_theme_mod('menu_type','inside_header');
		$AzureStickyMenu = get_theme_mod('sticky_menu','sticky_header');
		$AzureMenuContainer = get_theme_mod('menu_container','contained');
		$AzureMenuAlignment = get_theme_mod('menu_alignment','default');

		$AzureStickyMenuValue = '';
		$AzureMenuTypeValue = '';
		$AzureMenuContainerValue ='';
		$AzureMenuAlignmentValue = '';

		switch ($AzureMenuType) {
			case "inside_header":
				$AzureMenuTypeValue = 'insideMenu';
				break;
			default:
			   $AzureMenuTypeValue = 'outsideMenu';
		}
		 
		switch ($AzureStickyMenu) {
			case "sticky_header":
				$AzureStickyMenuValue = 'az-sticky';
				break;
			default:
			   $AzureStickyMenuValue = '';
		}

		switch($AzureMenuContainer){
			case "contained":
			$AzureMenuContainerValue ='';
			break;
			default:
			$AzureMenuContainerValue = '-fluid';
		}?>

		<div class="menu-area ptb-25 <?php echo esc_attr($AzureMenuTypeValue .' ' .$AzureStickyMenuValue ); ?>">
			<div class="container<?php echo esc_attr($AzureMenuContainerValue); ?> ">
				<div class="row">
						
					<nav class="navbar navbar-expand-lg mainmenu">
							<?php wpazure_site_branding(); ?>
					
						<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="<?php echo esc_html_e('Toggle navigation','wpazure');?>">
							<span class="fa fa-bars" aria-hidden="true"></span>
						</button>
						
						<div class="collapse navbar-collapse" id="navbarSupportedContent">                  
									   <?php
									   wp_nav_menu(
									array(
										'theme_location'  => 'primary',
										'container'  => 'nav-collapse collapse navbar-inverse-collapse',
										'menu_class' => 'nav navbar-nav pull-lg-right ml-auto',
										'fallback_cb'     => 'Wpazure_Bootstrap_Navwalker::fallback',
										'walker'          => new Wpazure_Bootstrap_Navwalker(),
									)
								);
							?>
						</div>
					</nav>
				</div>
			</div>
		</div><?php
	}
} 
add_action( 'wpazure_header', 'wpazure_header_markup' );