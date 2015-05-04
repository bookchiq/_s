<?php

/**
  ReduxFramework Config File
  For full documentation, please visit: https://docs.reduxframework.com
 * */

if (!class_exists('_s_Redux_Framework_config')) {

	class _s_Redux_Framework_config {

		public $args		= array();
		public $sections	= array();
		public $theme;
		public $ReduxFramework;

		public function __construct() {

			if (!class_exists('ReduxFramework')) {
				return;
			}

			// This is needed. Bah WordPress bugs.  ;)
			if ( true == Redux_Helpers::isTheme( __FILE__ ) ) {
				$this->initSettings();
			} else {
				add_action('plugins_loaded', array($this, 'initSettings'), 10);
			}

		}

		public function initSettings() {

			// Just for demo purposes. Not needed per say.
			$this->theme = wp_get_theme();

			// Set the default arguments
			$this->setArguments();

			// Create the sections and fields
			$this->setSections();

			if (!isset($this->args['opt_name'])) { // No errors please
				return;
			}

			// If Redux is running as a plugin, this will remove the demo notice and links
			add_action( 'redux/loaded', array( $this, 'remove_demo' ) );
			
			// Function to test the compiler hook and demo CSS output.
			// Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
			//add_filter('redux/options/'.$this->args['opt_name'].'/compiler', array( $this, 'compiler_action' ), 10, 2);

			$this->ReduxFramework = new ReduxFramework($this->sections, $this->args);
		}

		// Remove the demo link and the notice of integrated demo from the redux-framework plugin
		function remove_demo() {

			// Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
			if (class_exists('ReduxFrameworkPlugin')) {
				remove_filter('plugin_row_meta', array(ReduxFrameworkPlugin::instance(), 'plugin_metalinks'), null, 2);

				// Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
				remove_action('admin_notices', array(ReduxFrameworkPlugin::instance(), 'admin_notices'));
			}
		}

		public function setSections() {

			// ACTUAL DECLARATION OF SECTIONS
			$this->sections[] = array(
				'title' => __( 'Social Networks', '_s' ),
				'desc' => __( 'Enter the full URL for each network you want to show. Networks left empty won\'t be displayed. You can display the links throughout the site using the shortcode <code>[' . _S_SHORTCODE_PREFIX . '-social]</code>.', '_s' ),
				'icon' => 'el-icon-thumbs-up',
				'fields' => _s_get_social_redux_array(),
			);

			$this->sections[] = array(
				'title' => __( 'Opt-In', '_s' ),
				'desc' => __( 'This section lets you set up your code in one place and use it all over the site with the shortcode <code>[' . _S_SHORTCODE_PREFIX . '-opt-in]</code>.', '_s' ),
				'icon' => 'el-icon-filter',
				'fields' => array(
					array(
						'id' => 'opt_in',
						'type' => 'ace_editor',
						'mode' => 'html',
						'title' => __( 'Opt-in code', '_s' ),
					),
					array(
						'id' => 'opt-in-masthead-section-start',
						'type' => 'section',
						'title' => __('Masthead opt-in settings', '_s'),
						'indent' => true,
					),
					array(
						'id' => 'opt_in_intro_masthead',
						'type' => 'text',
						'title' => __('Call-to-action', '_s'),
					),
					array(
						'id'	 => 'opt-in-masthead-section-end',
						'type'   => 'section',
						'indent' => false,
					),
					array(
						'id' => 'opt-in-homepage-masthead-section-start',
						'type' => 'section',
						'title' => __('Homepage-specific masthead opt-in settings', '_s'),
						'indent' => true,
					),
					array(
						'id' => 'opt_in_intro_homepage_masthead',
						'type' => 'editor',
						'title' => __('Call-to-action', '_s'),
					),
					array(
						'id'	 => 'opt-in-homepage-masthead-section-end',
						'type'   => 'section',
						'indent' => false,
					),
					array(
						'id' => 'opt-in-site-footer-section-start',
						'type' => 'section',
						'title' => __('Site footer opt-in settings', '_s'),
						'indent' => true,
					),
					array(
						'id' => 'opt_in_intro_site_footer',
						'type' => 'editor',
						'title' => __('Call-to-action', '_s'),
					),
					array(
						'id'	 => 'opt-in-site-footer-section-end',
						'type'   => 'section',
						'indent' => false,
					),
					array(
						'id' => 'opt-in-post-footer-section-start',
						'type' => 'section',
						'title' => __('Post footer opt-in settings', '_s'),
						'indent' => true,
					),
					array(
						'id' => 'opt_in_intro_post_footer',
						'type' => 'editor',
						'title' => __('Call-to-action', '_s'),
					),
					array(
						'id'	 => 'opt-in-post-footer-section-end',
						'type'   => 'section',
						'indent' => false,
					),
				)
			);

			$this->sections[] = array(
				'title' => __( 'In-Site Microcopy', '_s' ),
				'desc' => __( 'This section lets you set up the microcopy and general content that shows up throughout the site.', '_s' ),
				'icon' => 'el-icon-filter',
				'fields' => array(
					// Search results
					array(
						'id' => 'section-start',
						'type' => 'section',
						'title' => __( 'Search Results', '_s' ),
						'indent' => true,
					),
					array(
						'id' => 'search_results_headline',
						'type' => 'text',
						'title' => __( 'Results headline', '_s' ),
						'desc' => __( 'You can use <code>%s</code> to represent the search phrase.', '_s' ),
						'default' => __( 'Searching for %s...', '_s' ),
					),
					array(
						'id'	 => 'section-end',
						'type'   => 'section',
						'indent' => false,
					),
					// 404 page
					array(
						'id' => 'section-start',
						'type' => 'section',
						'title' => __( 'Page Not Found', '_s' ),
						'indent' => true,
						'desc' => __( 'This page is displayed when a page address is typed in incorrectly or a page is moved while old links still exist.', '_s' ),
					),
					array(
						'id' => 'four_oh_four_headline',
						'type' => 'text',
						'title' => __( 'Headline', '_s' ),
						'default' => __( 'Oops! That page can’t be found.', '_s' ),
					),
					array(
						'id' => 'four_oh_four_intro',
						'type' => 'editor',
						'title' => __( 'Main copy', '_s' ),
						'default' => __( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', '_s' ),
					),
					array(
						'id' => 'note',
						'type' => 'info',
						'title' => __( 'Note', '_s' ),
						'desc' => __( 'You can choose which widgets show up on the error page by <a href="' . get_admin_url() . 'widgets.php">customizing the "Page Not Found" widget area</a>.', '_s' ),
					),
					array(
						'id'	 => 'section-end',
						'type'   => 'section',
						'indent' => false,
					),
				)
			);

			$this->sections[] = array(
				'title' => __( 'Site Footer', '_s' ),
				'desc' => __( 'The details in this section affect what\'s shown in the global site footer.', '_s' ),
				'icon' => 'el-icon-website',
				'fields' => array(
					array(
						'id' => 'footer_credits',
						'type' => 'editor',
						'title' => __( 'Credits', '_s' ),
					),
				)
			);

			if (file_exists(trailingslashit(dirname(__FILE__)) . 'README.html')) {
				$tabs['docs'] = array(
					'icon'	  => 'el-icon-book',
					'title'	 => __('Documentation', '_s'),
					'content'   => nl2br(file_get_contents(trailingslashit(dirname(__FILE__)) . 'README.html'))
				);
			}
		}

		/**

		  All the possible arguments for Redux.
		  For full documentation on arguments, please refer to: http://docs.reduxframework.com/core/arguments/

		 * */
		public function setArguments() {

			$theme = wp_get_theme(); // For use with some settings. Not necessary.

			$this->args = array(
				'opt_name' => _S_OPTIONS,
				'display_name' => $theme->get('Name'),
				'display_version' => $theme->get('Version'),
				'page_slug' => 'wpmoxie_options',
				'page_title' => __( 'Site Options', '_s'),
				'update_notice' => true,
				'admin_bar' => true,
				'menu_type' => 'menu',
				'menu_title' => __( 'Site Options', '_s'),
				'allow_sub_menu' => true,
				'dev_mode' => false,
				'customizer' => false,
				'default_mark' => '*',
				'hints' => 
				array(
					'icon_position' => 'right',
					'icon_size' => 'normal',
					'tip_style' => 
					array(
						'color' => 'light',
					),
					'tip_position' => 
					array(
						'my' => 'top left',
						'at' => 'bottom right',
					),
					'tip_effect' => 
					array(
						'show' => 
						array(
							'duration' => '500',
							'event' => 'mouseover',
						),
						'hide' => 
						array(
							'duration' => '500',
							'event' => 'mouseleave unfocus',
						),
					),
				),
				'output' => true,
				'output_tag' => true,
				'compiler' => true,
				'page_icon' => 'icon-themes',
				'page_permissions' => 'manage_options',
				'save_defaults' => true,
				'show_import_export' => true,
				'transient_time' => '3600',
				'network_sites' => true,
			);
		}

	}
	
	global $reduxConfig;
	$reduxConfig = new _s_Redux_Framework_config();
}