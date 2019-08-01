<?php
/**
 * The Minimal Theme Info
 *
 * @package The_Minimal
 */

function the_minimal_customizer_theme_info( $wp_customize ) {
	
    $wp_customize->add_section( 'theme_info' , array(
		'title'       => __( 'Information Links' , 'the-minimal' ),
		'priority'    => 6,
		));

	$wp_customize->add_setting('theme_info_theme',array(
		'default' => '',
		'sanitize_callback' => 'wp_kses_post',
		));
    
    $theme_info = '';
	$theme_info .= '<h3 class="sticky_title">' . __( 'Need help?', 'the-minimal' ) . '</h3>';
    $theme_info .= '<span class="sticky_info_row"><label class="row-element">' . __( 'View demo', 'the-minimal' ) . ': </label><a href="' . esc_url( 'https://raratheme.com/previews/?theme=the-minimal' ) . '" target="_blank">' . __( 'here', 'the-minimal' ) . '</a></span><br />';
	$theme_info .= '<span class="sticky_info_row"><label class="row-element">' . __( 'View documentation', 'the-minimal' ) . ': </label><a href="' . esc_url( 'https://raratheme.com/documentation/the-minimal/' ) . '" target="_blank">' . __( 'here', 'the-minimal' ) . '</a></span><br />';
    $theme_info .= '<span class="sticky_info_row"><label class="row-element">' . __( 'Support ticket', 'the-minimal' ) . ': </label><a href="' . esc_url( 'https://raratheme.com/support-ticket/' ) . '" target="_blnak">' . __( 'here', 'the-minimal' ) . '</a></span><br />';
	$theme_info .= '<span class="sticky_info_row"><label class="more-detail row-element">' . __( 'More Details', 'the-minimal' ) . ': </label><a href="' . esc_url( 'https://raratheme.com/wordpress-themes/' ) . '" target="_blank">' . __( 'here', 'the-minimal' ) . '</a></span><br />';
	

	$wp_customize->add_control( new The_Minimal_Theme_Info( $wp_customize ,'theme_info_theme',array(
		'label' => __( 'About The Minimal' , 'the-minimal' ),
		'section' => 'theme_info',
		'description' => $theme_info
		)));

}
add_action( 'customize_register', 'the_minimal_customizer_theme_info' );


if( class_exists( 'WP_Customize_control' ) ){

	class The_Minimal_Theme_Info extends WP_Customize_Control
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

if( class_exists( 'WP_Customize_Section' ) ) :
/**
 * Adding Go to Pro Section in Customizer
 * https://github.com/justintadlock/trt-customizer-pro
 */
class The_Minimal_Customize_Section_Pro extends WP_Customize_Section {

	/**
	 * The type of customize section being rendered.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $type = 'pro-section';

	/**
	 * Custom button text to output.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $pro_text = '';

	/**
	 * Custom pro button URL.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $pro_url = '';

	/**
	 * Add custom parameters to pass to the JS via JSON.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function json() {
		$json = parent::json();

		$json['pro_text'] = $this->pro_text;
		$json['pro_url']  = esc_url( $this->pro_url );

		return $json;
	}

	/**
	 * Outputs the Underscore.js template.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	protected function render_template() { ?>

		<li id="accordion-section-{{ data.id }}" class="accordion-section control-section control-section-{{ data.type }} cannot-expand">

			<h3 class="accordion-section-title">
				{{ data.title }}

				<# if ( data.pro_text && data.pro_url ) { #>
					<a href="{{ data.pro_url }}" class="button button-secondary alignright" target="_blank">{{ data.pro_text }}</a>
				<# } #>
			</h3>
		</li>
	<?php }
}
endif;

add_action( 'customize_register', 'the_minimal_sections_pro' );
function the_minimal_sections_pro( $manager ) {
	// Register custom section types.
	$manager->register_section_type( 'The_Minimal_Customize_Section_Pro' );

	// Register sections.
	$manager->add_section(
		new The_Minimal_Customize_Section_Pro(
			$manager,
			'the_minimal_view_pro',
			array(
				'title'    => esc_html__( 'Pro Available', 'the-minimal' ),
                'priority' => 5, 
				'pro_text' => esc_html__( 'VIEW PRO THEME', 'the-minimal' ),
				'pro_url'  => 'https://raratheme.com/wordpress-themes/the-minimal-pro/'
			)
		)
	);
}