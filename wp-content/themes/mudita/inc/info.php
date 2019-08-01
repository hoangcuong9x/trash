<?php
/**
 * Mudita Theme Info
 *
 * @package Mudita
 */

function mudita_customizer_theme_info( $wp_customize ) {

   $wp_customize->add_section( 'theme_info' , array(
		'title'       => __( 'Information Links' , 'mudita' ),
		'priority'    => 6,
		));

	$wp_customize->add_setting('theme_info_theme',array(
		'default' => '',
		'sanitize_callback' => 'wp_kses_post',
		));
    
    $theme_info = '';
	$theme_info .= '<h3 class="sticky_title">' . __( 'Need help?', 'mudita' ) . '</h3>';
    $theme_info .= '<span class="sticky_info_row"><label class="row-element">' . __( 'View demo', 'mudita' ) . ': </label><a href="' . esc_url( 'https://demo.raratheme.com/mudita/' ) . '" target="_blank">' . __( 'here', 'mudita' ) . '</a></span><br />';
	$theme_info .= '<span class="sticky_info_row"><label class="row-element">' . __( 'View documentation', 'mudita' ) . ': </label><a href="' . esc_url( 'https://raratheme.com/documentation/mudita/' ) . '" target="_blank">' . __( 'here', 'mudita' ) . '</a></span><br />';
	$theme_info .= '<span class="sticky_info_row"><label class="row-element">' . __( 'Theme info', 'mudita' ) . ': </label><a href="' . esc_url( 'https://raratheme.com/wordpress-themes/mudita/' ) . '" target="_blank">' . __( 'here', 'mudita' ) . '</a></span><br />';
	$theme_info .= '<span class="sticky_info_row"><label class="row-element">' . __( 'Support ticket', 'mudita' ) . ': </label><a href="' . esc_url( 'https://raratheme.com/support-ticket/' ) . '" target="_blank">' . __( 'here', 'mudita' ) . '</a></span><br />';
    $theme_info .= '<span class="sticky_info_row"><label class="row-element">' . __( 'Rate this theme', 'mudita' ) . ': </label><a href="' . esc_url( 'https://wordpress.org/support/theme/mudita/reviews' ) . '" target="_blank">' . __( 'here', 'mudita' ) . '</a></span><br />';
	$theme_info .= '<span class="sticky_info_row"><label class="more-detail row-element">' . __( 'More WordPress Themes' ,'mudita' ) . ': </label><a href="' . esc_url( 'https://raratheme.com/wordpress-themes/' ) . '" target="_blank">' . __( 'here', 'mudita' ) . '</a></span><br />';
	

	$wp_customize->add_control( new Mudita_Theme_Info( $wp_customize ,'theme_info_theme',array(
		'label' => __( 'About Mudita' , 'mudita' ),
		'section' => 'theme_info',
		'description' => $theme_info
		)));

	$wp_customize->add_setting('theme_info_more_theme',array(
		'default' => '',
		'sanitize_callback' => 'wp_kses_post',
		));

}
add_action( 'customize_register', 'mudita_customizer_theme_info' );


if( class_exists( 'WP_Customize_Control' ) ){

	class Mudita_Theme_Info extends WP_Customize_Control
	{
    	/**
       	* Render the content on the theme customizer page
       	*/
       	public function render_content()
       	{
       		?>
       		<label>
       			<strong class="customize-text_editor"><?php echo esc_html( $this->label ); ?></strong>
       			<br />
       			<span class="customize-text_editor_desc">
       				<?php echo wp_kses_post( $this->description ); ?>
       			</span>
       		</label>
       		<?php
       	}
    }//editor close
    
}//class close
