<?php
if (!function_exists('redux_init')) :
	function redux_init() {
	/**
		ReduxFramework Sample Config File
		For full documentation, please visit: https://github.com/ReduxFramework/ReduxFramework/wiki
	**/


	/**
	 
		Most of your editing will be done in this section.

		Here you can override default values, uncomment args and change their values.
		No $args are required, but they can be overridden if needed.
		
	**/
	$args = array();


	// For use with a tab example below
	$tabs = array();

	ob_start();

	$ct = wp_get_theme();
	$theme_data = $ct;
	$item_name = $theme_data->get('Name'); 
	$tags = $ct->Tags;
	$screenshot = $ct->get_screenshot();
	$class = $screenshot ? 'has-screenshot' : '';

	$customize_title = sprintf( __( 'Customize &#8220;%s&#8221;','_s' ), $ct->display('Name') );

	?>
	<div id="current-theme" class="<?php echo esc_attr( $class ); ?>">
		<?php if ( $screenshot ) : ?>
			<?php if ( current_user_can( 'edit_theme_options' ) ) : ?>
			<a href="<?php echo wp_customize_url(); ?>" class="load-customize hide-if-no-customize" title="<?php echo esc_attr( $customize_title ); ?>">
				<img src="<?php echo esc_url( $screenshot ); ?>" alt="<?php esc_attr_e( 'Current theme preview' ); ?>" />
			</a>
			<?php endif; ?>
			<img class="hide-if-customize" src="<?php echo esc_url( $screenshot ); ?>" alt="<?php esc_attr_e( 'Current theme preview' ); ?>" />
		<?php endif; ?>

		<h4>
			<?php echo $ct->display('Name'); ?>
		</h4>

		<div>
			<ul class="theme-info">
				<li><?php printf( __( 'By %s','_s'), $ct->display('Author') ); ?></li>
				<li><?php printf( __('Version %s','_s'), $ct->display('Version') ); ?></li>
				<li><?php echo '<strong>'.__('Tags', '_s').':</strong> '; ?><?php printf( $ct->display('Tags') ); ?></li>
			</ul>
			<p class="theme-description"><?php echo $ct->display('Description'); ?></p>
			<?php if ( $ct->parent() ) {
				printf( ' <p class="howto">' . __( 'This <a href="%1$s">child theme</a> requires its parent theme, %2$s.' ) . '</p>',
					__( 'http://codex.wordpress.org/Child_Themes','_s' ),
					$ct->parent()->display( 'Name' ) );
			} ?>
			
		</div>

	</div>

	<?php
	$item_info = ob_get_contents();
		
	ob_end_clean();

	// BEGIN Sample Config

	// Setting dev mode to true allows you to view the class settings/info in the panel.
	// Default: true
	$args['dev_mode'] = false;

	// Set the icon for the dev mode tab.
	// If $args['icon_type'] = 'image', this should be the path to the icon.
	// If $args['icon_type'] = 'iconfont', this should be the icon name.
	// Default: info-sign
	//$args['dev_mode_icon'] = 'info-sign';

	// Set the class for the dev mode tab icon.
	// This is ignored unless $args['icon_type'] = 'iconfont'
	// Default: null
	//$args['dev_mode_icon_class'] = '';

	// Set a custom option name. Don't forget to replace spaces with underscores!
	$args['opt_name'] = _S_OPTIONS;

	// Setting system info to true allows you to view info useful for debugging.
	// Default: false
	//$args['system_info'] = true;


	// Set the icon for the system info tab.
	// If $args['icon_type'] = 'image', this should be the path to the icon.
	// If $args['icon_type'] = 'iconfont', this should be the icon name.
	// Default: info-sign
	//$args['system_info_icon'] = 'info-sign';

	// Set the class for the system info tab icon.
	// This is ignored unless $args['icon_type'] = 'iconfont'
	// Default: null
	//$args['system_info_icon_class'] = 'icon-large';

	$theme = wp_get_theme();

	$args['display_name'] = $theme->get('Name');
	//$args['database'] = "theme_mods_expanded";
	$args['display_version'] = $theme->get('Version');

	// If you want to use Google Webfonts, you MUST define the api key.
	$args['google_api_key'] = 'AIzaSyAX_2L_UzCDPEnAHTG7zhESRVpMPS4ssII';

	// Define the starting tab for the option panel.
	// Default: '0';
	//$args['last_tab'] = '0';

	// Define the option panel stylesheet. Options are 'standard', 'custom', and 'none'
	// If only minor tweaks are needed, set to 'custom' and override the necessary styles through the included custom.css stylesheet.
	// If replacing the stylesheet, set to 'none' and don't forget to enqueue another stylesheet!
	// Default: 'standard'
	//$args['admin_stylesheet'] = 'standard';

	// Setup custom links in the footer for share icons
	$args['share_icons']['twitter'] = array(
		'link' => 'http://twitter.com/' . _S_DESIGNER_TWITTER_HANDLE,
		'title' => 'Follow me on Twitter', 
		'icon' => 'el-icon-twitter',
	);

	// Enable the import/export feature.
	// Default: true
	//$args['show_import_export'] = false;

	// Set the icon for the import/export tab.
	// If $args['icon_type'] = 'image', this should be the path to the icon.
	// If $args['icon_type'] = 'iconfont', this should be the icon name.
	// Default: refresh
	//$args['import_icon'] = 'refresh';

	// Set the class for the import/export tab icon.
	// This is ignored unless $args['icon_type'] = 'iconfont'
	// Default: null
	//$args['import_icon_class'] = '';

	/**
	 * Set default icon class for all sections and tabs
	 * @since 3.0.9
	 */
	//$args['default_icon_class'] = '';


	// Set a custom menu icon.
	//$args['menu_icon'] = '';

	// Set a custom title for the options page.
	// Default: Options
	$args['menu_title'] = __('Options', '_s');

	// Set a custom page title for the options page.
	// Default: Options
	$args['page_title'] = __('Options', '_s');

	// Set a custom page slug for options page (wp-admin/themes.php?page=***).
	// Default: redux_options
	$args['page_slug'] = '_s_options';

	$args['default_show'] = true;
	$args['default_mark'] = '*';

	// Set a custom page capability.
	// Default: manage_options
	//$args['page_cap'] = 'manage_options';

	// Set the menu type. Set to "menu" for a top level menu, or "submenu" to add below an existing item.
	// Default: menu
	//$args['page_type'] = 'submenu';

	// Set the parent menu.
	// Default: themes.php
	// A list of available parent menus is available at http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
	//$args['page_parent'] = 'options-general.php';

	// Set a custom page location. This allows you to place your menu where you want in the menu order.
	// Must be unique or it will override other items!
	// Default: null
	//$args['page_position'] = null;

	// Set a custom page icon class (used to override the page icon next to heading)
	//$args['page_icon'] = 'icon-themes';

	// Set the icon type. Set to "iconfont" for Elusive Icon, or "image" for traditional.
	// Redux no longer ships with standard icons!
	// Default: iconfont
	//$args['icon_type'] = 'image';

	// Disable the panel sections showing as submenu items.
	// Default: true
	//$args['allow_sub_menu'] = false;

	$sections = array();

	$sections[] = array(
		'title' => __( 'Social Networks', '_s' ),
		'desc' => __( 'Enter the full URL for each network you want to show. Networks left empty won\'t be displayed. You can display the links throughout the site using the shortcode <code>[' . _S_SHORTCODE_PREFIX . '-social]</code>.', '_s' ),
		'icon' => 'el-icon-thumbs-up',
		'fields' => _s_get_social_redux_array(),
	);

	$sections[] = array(
		'title' => __( 'Opt-In', '_s' ),
		'desc' => __( 'This section lets you set up your code in one place and use it all over the site with the shortcode <code>[' . _S_SHORTCODE_PREFIX . '-opt-in]</code>.', '_s' ),
		'icon' => 'el-icon-filter',
		'fields' => array(
			array(
				'id' => 'opt_in',
				'type' => 'textarea',
				'title' => __( 'Opt-in code', '_s' ),
			),
		)
	);

	$sections[] = array(
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
				'id'     => 'section-end',
				'type'   => 'section',
				'indent' => false,
			),
			// Archives
			// Archive titles are now determined by the_archive_title() and can be filtered by get_the_archive_title, but I haven't written that functionality
			// array(
			// 	'id' => 'section-start',
			// 	'type' => 'section',
			// 	'title' => __( 'Archives', '_s' ),
			// 	'indent' => true,
			// ),
			// array(
			// 	'id' => 'archive_category_headline',
			// 	'type' => 'text',
			// 	'title' => __( 'Headlines for Category & Tag Archives', '_s' ),
			// 	'desc' => __( 'You can use <code>%s</code> to represent the category/tag.', '_s' ),
			// 	'default' => __( '%s', '_s' ),
			// ),
			// array(
			// 	'id' => 'archive_date_headline',
			// 	'type' => 'text',
			// 	'title' => __( 'Headlines for Date-Based Archives', '_s' ),
			// 	'desc' => __( 'Use PHP-style date formatting&mdash;for example, <code>Published F, Y</code> would produce a headline like <code>Published March, 2016</code>.', '_s' ),
			// 	'default' => __( '%s', '_s' ),
			// ),
			// array(
			// 	'id'     => 'section-end',
			// 	'type'   => 'section',
			// 	'indent' => false,
			// ),
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
				'id'     => 'section-end',
				'type'   => 'section',
				'indent' => false,
			),
		)
	);

	$sections[] = array(
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

	// $sections[] = array(
	// 	'type' => 'divide',
	// );

	// $sections[] = array(
	// 	'icon' => 'el-icon-info-sign',
	// 	'title' => __( 'Theme Information', '_s' ),
	// 	'desc' => __( '<p class="description">This is the Description. Again HTML is allowed</p>', '_s' ),
	// 	'fields' => array(
	// 		array(
	// 			'id'=>'raw_new_info',
	// 			'type' => 'raw',
	// 			'content' => $item_info,
	// 			)
	// 		),   
	// 	);


	if(file_exists(trailingslashit(dirname(__FILE__)) . 'README.html')) {
		$tabs['docs'] = array(
			'icon' => 'el-icon-book',
				'title' => __( 'Documentation', '_s' ),
			'content' => nl2br(file_get_contents(trailingslashit(dirname(__FILE__)) . 'README.html'))
		);
	}

	global $ReduxFramework;
	$ReduxFramework = new ReduxFramework($sections, $args, $tabs);

	// END Sample Config
	}
	add_action('init', 'redux_init');
endif;


/**

	Remove all things related to the Redux Demo mode.

**/
if ( !function_exists( 'redux_remove_demo_options' ) ):
	function redux_remove_demo_options() {
		
		// Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
		if ( class_exists('ReduxFrameworkPlugin') ) {
			remove_filter( 'plugin_row_meta', array( ReduxFrameworkPlugin::get_instance(), 'plugin_meta_demo_mode_link'), null, 2 );
		}

		// Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
		remove_action('admin_notices', array( ReduxFrameworkPlugin::get_instance(), 'admin_notices' ) );	

	}
	add_action( 'redux/plugin/hooks', 'redux_remove_demo_options' );	
endif;
