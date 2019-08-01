<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package TheFour
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="page" class="site">

	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'thefour-lite' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<div class="navbar">
			<div class="site-branding<?php echo esc_attr( thefour_logo_class() ); ?>">
				<?php the_custom_logo(); ?>

				<div class="site-name">
					<?php if ( is_front_page() && is_home() ) : ?>
						<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php else : ?>
						<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
					<?php endif; ?>

					<?php
					$description = get_bloginfo( 'description', 'display' );
					if ( $description || is_customize_preview() ) : ?>
						<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
					<?php endif; ?>
				</div>
			</div><!-- .site-branding -->

			<nav class="site-navigation" role="navigation" aria-label="<?php esc_html_e( 'Primary Navigation', 'thefour-lite' ); ?>">
				<button class="menu-toggle"><?php esc_html_e( 'Menu', 'thefour-lite' ); ?></button>
				<?php
				wp_nav_menu( array(
					'container_class' => 'main-menu',
					'menu_class'      => 'main-menu clearfix',
					'theme_location'  => 'menu-1',
					'items_wrap'      => '<ul>%3$s</ul>',
				) );
				?>
			</nav>
		</div>
		<div class="header-inner container">
			<?php get_template_part( 'template-parts/hero' ); ?>
		</div>
	</header>

	<main class="main container clearfix" id="main" role="main">
