<?php

namespace Barn2\Plugin\Posts_Table_Search_Sort;

// Prevent direct file access
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Barn2\Lib\Util as Util;

/**
 * This class handles our plugin settings page in the admin.
 *
 * @author    Barn2 Media <info@barn2.co.uk>
 * @license   GPL-3.0
 * @copyright Barn2 Media Ltd
 */
class Admin_Settings_Page implements \Barn2\Lib\Attachable {

	const MENU_SLUG	 = 'posts_table_search_sort';
	const OPTION_GROUP = 'posts_table_search_sort_main';

	private static $readonly_settings = array(
		'post_type',
		'image_size',
		'lightbox',
		'shortcodes',
		'excerpt_length',
		'links',
		'lazy_load',
		'post_limit',
		'cache',
		'filters',
		'page_length',
		'search_box',
		'totals',
		'pagination',
		'paging_type',
		'reset_button',
	);

	public function attach() {
		add_action( 'admin_menu', array( $this, 'add_settings_page' ) );
		add_action( 'admin_init', array( $this, 'register_settings' ) );
	}

	public function add_settings_page() {
		add_options_page(
			__( 'Posts Table With Search &amp; Sort', 'posts-data-table' ), __( 'Posts Table With Search &amp; Sort', 'posts-data-table' ), 'manage_options', self::MENU_SLUG, array( $this, 'render_settings_page' )
		);
	}

	public function render_settings_page() {
		?>
		<div class="wrap">
			<h1><?php _e( 'Posts Table with Search and Sort', 'posts-data-table' ); ?></h1>
			<form action="options.php" method="post">
				<?php
				// Output the hidden form fields (_wpnonce, etc)
				settings_fields( self::OPTION_GROUP );

				// Output the sections and their settings
				do_settings_sections( self::MENU_SLUG );
				?>
				<p class="submit">
					<input name="Submit" type="submit" name="submit" class="button button-primary" value="<?php esc_attr_e( 'Save Changes', 'posts-data-table' ); ?>" />
				</p>
			</form>
		</div>
		<?php
	}

	public function register_settings() {
		// Register the settings
		register_setting( self::OPTION_GROUP, Settings::TABLE_ARGS_SETTING, array(
			'type' => 'string', // array type not supported, so just use string
			'description' => 'Posts Table with Search and Sort - table defaults',
			'sanitize_callback' => '\Barn2\Plugin\Posts_Table_Search_Sort\Settings::sanitize_table_args'
		) );

		$default_args	 = Simple_Posts_Table::get_defaults();
		$args_setting	 = Settings::TABLE_ARGS_SETTING;

		// Selecting posts
		\WP_Settings_API_Helper::add_settings_section(
			'ptss_post_selection', self::MENU_SLUG, __( 'Posts selection', 'posts-data-table' ), array( $this, 'section_description_selecting_posts' ),
			$this->mark_readonly_settings( array(
				array(
					'id' => $args_setting . '[post_type]',
					'title' => __( 'Post type', 'posts-data-table' ),
					'type' => 'select',
					'desc' => __( 'The default post type for your tables.', 'posts-data-table' ),
					'options' => array( 'post' ),
					'default' => 'post'
				),
			) )
		);

		// Table content
		\WP_Settings_API_Helper::add_settings_section(
			'ptss_content', self::MENU_SLUG, __( 'Table content', 'posts-data-table' ), array( $this, 'section_description_table_content' ),
			$this->mark_readonly_settings( array(
				array(
					'id' => $args_setting . '[columns]',
					'title' => __( 'Columns', 'posts-data-table' ),
					'type' => 'text',
					'desc' => __( 'The columns displayed in your table (comma-separated). ', 'posts-data-table' ),
					'default' => $default_args['columns'],
				),
				array(
					'id' => $args_setting . '[image_size]',
					'title' => __( 'Image size', 'posts-data-table' ),
					'type' => 'text',
					'desc' => __( "W x H in pixels. Sets the image size when using the 'image' column. ", 'posts-data-table' ) . Util::barn2_link( 'kb/ptp-column-widths/#image-size' ),
					'default' => 'thumbnail',
				),
				array(
					'id' => $args_setting . '[lightbox]',
					'title' => __( 'Image lightbox', 'posts-data-table' ),
					'type' => 'checkbox',
					'label' => __( 'Display featured images in a lightbox when opened', 'posts-data-table' ),
					'default' => true,
				),
				array(
					'title' => __( 'Shortcodes', 'posts-data-table' ),
					'type' => 'checkbox',
					'id' => $args_setting . '[shortcodes]',
					'label' => __( 'Display shortcodes, HTML and other formatting inside the table content', 'posts-data-table' ),
					'default' => true
				),
				array(
					'id' => $args_setting . '[content_length]',
					'title' => __( 'Content length', 'posts-data-table' ),
					'type' => 'number',
					'class' => 'small-text',
					'suffix' => __( 'words', 'posts-data-table' ),
					'desc' => __( 'Enter -1 to show the full post content.', 'posts-data-table' ),
					'default' => $default_args['content_length'],
					'custom_attributes' => array(
						'min' => -1
					)
				),
				array(
					'id' => $args_setting . '[excerpt_length]',
					'title' => __( 'Excerpt length', 'posts-data-table' ),
					'type' => 'number',
					'class' => 'small-text',
					'suffix' => __( 'words', 'posts-data-table' ),
					'desc' => __( 'Enter -1 to show the full excerpt.', 'posts-data-table' ),
					'default' => 15,
					'custom_attributes' => array(
						'min' => -1
					)
				),
				array(
					'id' => $args_setting . '[links]',
					'title' => __( 'Links', 'posts-data-table' ),
					'type' => 'text',
					'desc' => __( 'Display links to the single post page, category, tag, or term archive. ', 'posts-data-table' ) . Util::barn2_link( 'kb/links-posts-table/' ),
					'default' => 'all',
				)
			) )
		);

		// Loading posts
		\WP_Settings_API_Helper::add_settings_section(
			'ptss_loading', self::MENU_SLUG, __( 'Table loading', 'posts-data-table' ), '__return_false',
			$this->mark_readonly_settings( array(
				array(
					'title' => __( 'Lazy load', 'posts-data-table' ),
					'type' => 'checkbox',
					'id' => $args_setting . '[lazy_load]',
					'label' => __( 'Load the posts one page at a time', 'posts-data-table' ),
					'desc' => sprintf( __( 'Enable this if you have many posts or experience slow page load times. ', 'posts-data-table' ) ) . Util::barn2_link( 'kb/posts-table-lazy-load/' ),
					'default' => false,
				),
				array(
					'title' => __( 'Post limit', 'posts-data-table' ),
					'type' => 'number',
					'id' => $args_setting . '[post_limit]',
					'desc' => __( 'The maximum (total) number of posts to display in one table.', 'posts-data-table' ),
					'default' => 500,
					'class' => 'small-text',
					'custom_attributes' => array(
						'min' => -1
					)
				),
				array(
					'title' => __( 'Posts per page', 'posts-data-table' ),
					'type' => 'number',
					'id' => $args_setting . '[rows_per_page]',
					'desc' => __( 'The number of posts per page of results. Enter -1 to display all posts on one page.', 'posts-data-table' ),
					'default' => $default_args['rows_per_page'],
					'custom_attributes' => array(
						'min' => -1
					)
				),
				array(
					'title' => __( 'Caching', 'posts-data-table' ),
					'type' => 'checkbox',
					'id' => $args_setting . '[cache]',
					'label' => __( 'Cache table contents to improve load time', 'posts-data-table' ),
					'default' => false
				)
			) )
		);

		// Sorting
		$sort_columns = wp_list_pluck( Simple_Posts_Table::get_column_defaults(), 'heading' );

		\WP_Settings_API_Helper::add_settings_section(
			'ptss_sorting', self::MENU_SLUG, __( 'Sorting', 'posts-data-table' ), '__return_false',
			$this->mark_readonly_settings( array(
				array(
					'title' => __( 'Sort by', 'posts-data-table' ),
					'type' => 'select',
					'id' => $args_setting . '[sort_by]',
					'options' => $sort_columns,
					'desc' => __( 'The initial sort order applied to the table. ', 'posts-data-table' ),
					'default' => $default_args['sort_by']
				),
				array(
					'title' => __( 'Sort direction', 'posts-data-table' ),
					'type' => 'select',
					'id' => $args_setting . '[sort_order]',
					'options' => array(
						'' => __( 'Automatic', 'posts-data-table' ),
						'asc' => __( 'Ascending (A to Z, 1 to 99)', 'posts-data-table' ),
						'desc' => __( 'Descending (Z to A, 99 to 1)', 'posts-data-table' )
					),
					'default' => $default_args['sort_order']
				)
			) )
		);

		// Table controls
		\WP_Settings_API_Helper::add_settings_section(
			'ptss_controls', self::MENU_SLUG, __( 'Table controls', 'posts-data-table' ), '__return_false',
			$this->mark_readonly_settings( array(
				array(
					'title' => __( 'Search filters', 'posts-data-table' ),
					'type' => 'select',
					'id' => $args_setting . '[filters]',
					'options' => array(
						'false' => __( 'Disabled', 'posts-data-table' ),
						'true' => __( 'Show based on columns in table', 'posts-data-table' ),
						'custom' => __( 'Custom', 'posts-data-table' )
					),
					'desc' => __( 'Dropdown lists to filter the table by category, tag, attribute, or custom taxonomy. ', 'posts-data-table' ) . Util::barn2_link( 'kb/posts-table-filters/' ),
					'default' => true,
				),
				array(
					'title' => __( 'Page length', 'posts-data-table' ),
					'type' => 'select',
					'id' => $args_setting . '[page_length]',
					'options' => array(
						'top' => __( 'Above table', 'posts-data-table' ),
						'bottom' => __( 'Below table', 'posts-data-table' ),
						'both' => __( 'Above and below table', 'posts-data-table' ),
						'false' => __( 'Hidden', 'posts-data-table' )
					),
					'desc' => __( "The position of the 'Show [x] entries' dropdown list.", 'posts-data-table' ),
					'default' => 'top'
				),
				array(
					'title' => __( 'Search box', 'posts-data-table' ),
					'type' => 'select',
					'id' => $args_setting . '[search_box]',
					'options' => array(
						'top' => __( 'Above table', 'posts-data-table' ),
						'bottom' => __( 'Below table', 'posts-data-table' ),
						'both' => __( 'Above and below table', 'posts-data-table' ),
						'false' => __( 'Hidden', 'posts-data-table' )
					),
					'default' => 'top'
				),
				array(
					'title' => __( 'Totals', 'posts-data-table' ),
					'type' => 'select',
					'id' => $args_setting . '[totals]',
					'options' => array(
						'top' => __( 'Above table', 'posts-data-table' ),
						'bottom' => __( 'Below table', 'posts-data-table' ),
						'both' => __( 'Above and below table', 'posts-data-table' ),
						'false' => __( 'Hidden', 'posts-data-table' )
					),
					'desc' => __( "The position of the post totals, e.g. 'Showing 1 to 5 of 10 entries'.", 'posts-data-table' ),
					'default' => 'bottom'
				),
				array(
					'title' => __( 'Pagination buttons', 'posts-data-table' ),
					'type' => 'select',
					'id' => $args_setting . '[pagination]',
					'options' => array(
						'top' => __( 'Above table', 'posts-data-table' ),
						'bottom' => __( 'Below table', 'posts-data-table' ),
						'both' => __( 'Above and below table', 'posts-data-table' ),
						'false' => __( 'Hidden', 'posts-data-table' )
					),
					'desc' => __( 'The position of the paging buttons which scroll between results.', 'posts-data-table' ),
					'default' => 'bottom'
				),
				array(
					'title' => __( 'Pagination type', 'posts-data-table' ),
					'type' => 'select',
					'id' => $args_setting . '[paging_type]',
					'options' => array(
						'numbers' => __( 'Numbers only', 'posts-data-table' ),
						'simple' => __( 'Prev|Next', 'posts-data-table' ),
						'simple_numbers' => __( 'Prev|Next + Numbers', 'posts-data-table' ),
						'full' => __( 'Prev|Next|First|Last', 'posts-data-table' ),
						'full_numbers' => __( 'Prev|Next|First|Last + Numbers', 'posts-data-table' )
					),
					'default' => 'simple_numbers'
				),
				array(
					'title' => __( 'Reset button', 'posts-data-table' ),
					'type' => 'checkbox',
					'id' => $args_setting . '[reset_button]',
					'label' => __( 'Show a reset button above the table', 'posts-data-table' ),
					'default' => false
				)
			) )
		);
	}

	public function mark_readonly_settings( $settings ) {
		foreach ( $settings as &$setting ) {
			$subkey = preg_filter( '/^[\w\[\]]+\[(\w+)\]$/', '$1', $setting['id'] );

			if ( $subkey && false !== array_search( $subkey, self::$readonly_settings ) ) {
				$setting['field_class']			 = 'readonly';
				$setting['custom_attributes']	 = array(
					'disabled' => 'disabled'
				);

				$setting['title'] = $setting['title'] .
					sprintf( '<span class="pro-version">%s</span>', Util::barn2_link( 'gggg', __( 'Pro version only', 'posts-data-table' ) ) );
			}
		}

		return $settings;
	}

	public function section_description_selecting_posts() {
		?>
		<p><?php
			printf(
				__( 'Posts tables display all published posts for the selected post type. To restrict the posts by category, tag, author, etc, set the relevant option in the [posts_table] shortcode. See the %splugin description%s for details.', 'posts-data-table' ),
				'<a href="' . esc_url( 'https://wordpress.org/plugins/posts-data-table/#description' ) . '" target="_blank">',
				'</a>'
			);
			?>
		</p>
		<?php
	}

	public function section_description_table_content() {
		?>
		<p><?php
			printf(
				__( 'You can override these options by setting the relevant option in the [posts_table] shortcode. See the %splugin description%s for details.', 'posts-data-table' ),
				'<a href="' . esc_url( 'https://wordpress.org/plugins/posts-data-table/#description' ) . '" target="_blank">',
				'</a>'
			);
			?>
		</p>
		<?php
	}
}
