<?php
/**
 * V4 functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package V4
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.51' );
}


require_once get_template_directory() . '/class-tgm-plugin-activation.php';


add_action('tgmpa_register', 'v4_child_register_required_plugins');


function v4_child_register_required_plugins()
{

	$plugins = array(

		array(
			'name'               => 'ACF Pro', // The plugin name.
			'slug'               => 'advanced-custom-fields-pro', // The plugin slug (typically the folder name).
			'source'             => get_template_directory() . '/advanced-custom-fields-pro.zip', // The plugin source.
			'required'           => true, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			'external_url'       => '', // If set, overrides default API URL and points to an external URL.
			'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
		),
		array(
			'name'               => 'ACF Typography', // The plugin name.
			'slug'               => 'acf-typography-field', // The plugin slug (typically the folder name).
			'source'             => get_template_directory() . '/acf-typography-field.zip', // The plugin source.
			'required'           => true, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			'external_url'       => '', // If set, overrides default API URL and points to an external URL.
			'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
		),
		array(
			'name'               => 'ACF Font Awesome', // The plugin name.
			'slug'               => 'advanced-custom-fields-font-awesome', // The plugin slug (typically the folder name).
			'source'             => get_template_directory() . '/advanced-custom-fields-font-awesome.zip', // The plugin source.
			'required'           => true, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			'external_url'       => '', // If set, overrides default API URL and points to an external URL.
			'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
		),

		// array(
		// 	'name'      => 'ACF (Advanced Custom Fields)',
		// 	'slug'      => 'advanced-custom-fields',
		// 	'required'  => true,
		// )

	);

	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
	$config = array(
		'id'           => 'v4-child',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.

		/*
		'strings'      => array(
			'page_title'                      => __( 'Install Required Plugins', 'v4-child' ),
			'menu_title'                      => __( 'Install Plugins', 'v4-child' ),
			/* translators: %s: plugin name. * /
			'installing'                      => __( 'Installing Plugin: %s', 'v4-child' ),
			/* translators: %s: plugin name. * /
			'updating'                        => __( 'Updating Plugin: %s', 'v4-child' ),
			'oops'                            => __( 'Something went wrong with the plugin API.', 'v4-child' ),
			// 'notice_can_install_required'     => _n_noop(
			// 	/* translators: 1: plugin name(s). * /
			// 	'This theme requires the following plugin: %1$s.',
			// 	'This theme requires the following plugins: %1$s.',
			// 	'v4-child'
			// ),
			'notice_can_install_recommended'  => _n_noop(
				/* translators: 1: plugin name(s). * /
				'This theme recommends the following plugin: %1$s.',
				'This theme recommends the following plugins: %1$s.',
				'v4-child'
			),
			'notice_ask_to_update'            => _n_noop(
				/* translators: 1: plugin name(s). * /
				'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.',
				'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.',
				'v4-child'
			),
			'notice_ask_to_update_maybe'      => _n_noop(
				/* translators: 1: plugin name(s). * /
				'There is an update available for: %1$s.',
				'There are updates available for the following plugins: %1$s.',
				'v4-child'
			),
			'notice_can_activate_required'    => _n_noop(
				/* translators: 1: plugin name(s). * /
				'The following required plugin is currently inactive: %1$s.',
				'The following required plugins are currently inactive: %1$s.',
				'v4-child'
			),
			'notice_can_activate_recommended' => _n_noop(
				/* translators: 1: plugin name(s). * /
				'The following recommended plugin is currently inactive: %1$s.',
				'The following recommended plugins are currently inactive: %1$s.',
				'v4-child'
			),
			'install_link'                    => _n_noop(
				'Begin installing plugin',
				'Begin installing plugins',
				'v4-child'
			),
			'update_link' 					  => _n_noop(
				'Begin updating plugin',
				'Begin updating plugins',
				'v4-child'
			),
			'activate_link'                   => _n_noop(
				'Begin activating plugin',
				'Begin activating plugins',
				'v4-child'
			),
			'return'                          => __( 'Return to Required Plugins Installer', 'v4-child' ),
			'plugin_activated'                => __( 'Plugin activated successfully.', 'v4-child' ),
			'activated_successfully'          => __( 'The following plugin was activated successfully:', 'v4-child' ),
			/* translators: 1: plugin name. * /
			'plugin_already_active'           => __( 'No action taken. Plugin %1$s was already active.', 'v4-child' ),
			/* translators: 1: plugin name. * /
			'plugin_needs_higher_version'     => __( 'Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'v4-child' ),
			/* translators: 1: dashboard link. * /
			'complete'                        => __( 'All plugins installed and activated successfully. %1$s', 'v4-child' ),
			'dismiss'                         => __( 'Dismiss this notice', 'v4-child' ),
			'notice_cannot_install_activate'  => __( 'There are one or more required or recommended plugins to install, update or activate.', 'v4-child' ),
			'contact_admin'                   => __( 'Please contact the administrator of this site for help.', 'v4-child' ),

			'nag_type'                        => '', // Determines admin notice type - can only be one of the typical WP notice classes, such as 'updated', 'update-nag', 'notice-warning', 'notice-info' or 'error'. Some of which may not work as expected in older WP versions.
		),
		*/
	);

	tgmpa($plugins, $config);
}

if (function_exists('get_field')) :

	add_filter('acf/settings/save_json', 'my_acf_json_save_point');

	function my_acf_json_save_point($path)
	{

		// Update path
		$path = get_template_directory() . '/acf-json';
		// Return path
		return $path;
	}

	add_filter('acf/settings/load_json', function ($paths) {
		$paths[] = get_template_directory() . '/acf-json';
		return $paths;
	});
endif;




if ( ! function_exists( 'v4_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function v4_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on V4, use a find and replace
		 * to change 'v4' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'v4', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'v4' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'v4_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);

		global $wpdb;
		$table_prefix = $wpdb->get_blog_prefix();


		$option_sql = "
			INSERT INTO `".$table_prefix. "options` (`option_name`, `option_value`, `autoload`) VALUES
				('options_site_width',	'1320',	'no'),
				('_options_site_width',	'field_630429506fff0',	'no'),
				('options_global_border_radius',	'6',	'no'),
				('_options_global_border_radius',	'field_63055e35f79c3',	'no'),
				('options_global_grid_gap',	'24',	'no'),
				('_options_global_grid_gap',	'field_6356a67cc1243',	'no'),
				('options_global_excerpt_length',	'10',	'no'),
				('_options_global_excerpt_length',	'field_6356aa55ccf09',	'no'),
				('options_global_excerpt_ellipsis',	'...',	'no'),
				('_options_global_excerpt_ellipsis',	'field_6356aabdcf1e5',	'no'),
				('options_global_mobile_breakpoint',	'768',	'no'),
				('_options_global_mobile_breakpoint',	'field_6356ce619885d',	'no'),
				('options_global_tablet_breakpoint',	'1024',	'no'),
				('_options_global_tablet_breakpoint',	'field_6356ce899885e',	'no'),
				('options_global_affiliate_disclosure',	'<h2>Affiliate Disclosure</h2>\r\nV4 Base Theme is an independent publisher and comparison service, not an investment advisor, financial advisor, loan broker, insurance producer, or insurance broker. Its articles, interactive tools and other content are provided to you for free, as self-help tools and for informational purposes only. They are not intended to provide investment advice. V4 Base Theme does not and cannot guarantee the accuracy or applicability of any information in regard to your individual circumstances. We encourage you to seek personalized advice from qualified professionals regarding specific investment issues. Featured estimates are based on past market performance, and past performance is not a guarantee of future performance.',	'no'),
				('_options_global_affiliate_disclosure',	'field_63ce98faf835e',	'no'),
				('options_global_review_blurb',	'We independently research, test, review, and recommend the best products. If you buy something through our links, we may earn a commission. <a data-fancybox=\"\" data-src=\"#global-affiliate-disclosure\">Learn more here</a>.',	'no'),
				('_options_global_review_blurb',	'field_63b3395f70c07',	'no'),
				('options_single_post_boxed_layout',	'1',	'no'),
				('_options_single_post_boxed_layout',	'field_63891737fc4cf',	'no'),
				('options_show_author_boxes_on_posts',	'1',	'no'),
				('_options_show_author_boxes_on_posts',	'field_63892fad6ef43',	'no'),
				('options_single_post_full_layout_padding_padding_options_top_bottom',	'py-5',	'no'),
				('_options_single_post_full_layout_padding_padding_options_top_bottom',	'field_6305444400304',	'no'),
				('options_single_post_full_layout_padding_padding_options_left_right',	'px-0',	'no'),
				('_options_single_post_full_layout_padding_padding_options_left_right',	'field_630550c5259b5',	'no'),
				('options_single_post_full_layout_padding',	'',	'no'),
				('_options_single_post_full_layout_padding',	'field_63b2f2e531114',	'no'),
				('options_archive_post_full_layout_padding_padding_options_top_bottom',	'py-4',	'no'),
				('_options_archive_post_full_layout_padding_padding_options_top_bottom',	'field_6305444400304',	'no'),
				('options_archive_post_full_layout_padding_padding_options_left_right',	'px-0',	'no'),
				('_options_archive_post_full_layout_padding_padding_options_left_right',	'field_630550c5259b5',	'no'),
				('options_archive_post_full_layout_padding',	'',	'no'),
				('_options_archive_post_full_layout_padding',	'field_6407cf3b6b686',	'no'),
				('options_archive_boxed_layout',	'1',	'no'),
				('_options_archive_boxed_layout',	'field_6407cadf48478',	'no'),
				('options_index_full_layout_padding_padding_options_top_bottom',	'py-0',	'no'),
				('_options_index_full_layout_padding_padding_options_top_bottom',	'field_6305444400304',	'no'),
				('options_index_full_layout_padding_padding_options_left_right',	'px-0',	'no'),
				('_options_index_full_layout_padding_padding_options_left_right',	'field_630550c5259b5',	'no'),
				('options_index_full_layout_padding',	'',	'no'),
				('_options_index_full_layout_padding',	'field_63cf23d7614b4',	'no'),
				('options_index_boxed_layout',	'1',	'no'),
				('_options_index_boxed_layout',	'field_63cf23c3614b3',	'no'),
				('options_index_layout',	'cards',	'no'),
				('_options_index_layout',	'field_63cf367d9e820',	'no'),
				('options_include_sticky_sidebar_script',	'1',	'no'),
				('_options_include_sticky_sidebar_script',	'field_6407f448212f1',	'no'),
				('options_link_color',	'#219067',	'no'),
				('_options_link_color',	'field_6419bd9af241e',	'no'),
				('options_v4_theme_colors',	'#131313\r\n#f8f8f8\r\n#0F52BA\r\n#4682B4\r\n#ffffff\r\n#000000\r\n#808080\r\n#F5F5F5',	'no'),
				('_options_v4_theme_colors',	'field_62f59364bd05d',	'no'),
				('options_color_map_dark_color_selector',	'#131313',	'no'),
				('_options_color_map_dark_color_selector',	'field_60ef8b16b84f7',	'no'),
				('options_color_map_dark',	'',	'no'),
				('_options_color_map_dark',	'field_60ef93bdfbcec',	'no'),
				('options_color_map_light_color_selector',	'#ffffff',	'no'),
				('_options_color_map_light_color_selector',	'field_60ef8b16b84f7',	'no'),
				('options_color_map_light',	'',	'no'),
				('_options_color_map_light',	'field_60ef93fefbced',	'no'),
				('options_color_selector',	'#0F52BA',	'no'),
				('_options_color_selector',	'field_60ef8b16b84f7',	'no'),
				('options_color_map_primary',	'',	'no'),
				('_options_color_map_primary',	'field_60ef9405fbcee',	'no'),
				('options_color_map_secondary_color_selector',	'#4682B4',	'no'),
				('_options_color_map_secondary_color_selector',	'field_60ef8b16b84f7',	'no'),
				('options_color_map_secondary',	'',	'no'),
				('_options_color_map_secondary',	'field_60ef940ffbcef',	'no'),
				('options_color_map_black_color_selector',	'#131313',	'no'),
				('_options_color_map_black_color_selector',	'field_60ef8b16b84f7',	'no'),
				('options_color_map_black',	'',	'no'),
				('_options_color_map_black',	'field_62f5a03cf7840',	'no'),
				('options_color_map_white_color_selector',	'#131313',	'no'),
				('_options_color_map_white_color_selector',	'field_60ef8b16b84f7',	'no'),
				('options_color_map_white',	'',	'no'),
				('_options_color_map_white',	'field_62f5a045f7841',	'no'),
				('options_p_settings',	'a:7:{s:9:\"font_size\";s:2:\"16\";s:11:\"font_family\";s:6:\"Roboto\";s:11:\"font_weight\";s:3:\"400\";s:10:\"font_style\";s:6:\"normal\";s:11:\"line_height\";s:2:\"32\";s:14:\"letter_spacing\";s:1:\"0\";s:14:\"text_transform\";s:4:\"none\";}',	'no'),
				('_options_p_settings',	'field_63041fdc9cce4',	'no'),
				('options_li_settings',	'a:7:{s:9:\"font_size\";s:2:\"16\";s:11:\"font_family\";s:6:\"Roboto\";s:11:\"font_weight\";s:3:\"400\";s:10:\"font_style\";s:6:\"normal\";s:11:\"line_height\";s:2:\"32\";s:14:\"letter_spacing\";s:1:\"0\";s:14:\"text_transform\";s:4:\"none\";}',	'no'),
				('_options_li_settings',	'field_64075156aa10a',	'no'),
				('options_h1_settings',	'a:7:{s:9:\"font_size\";s:2:\"48\";s:11:\"font_family\";s:11:\"Roboto Slab\";s:11:\"font_weight\";s:3:\"400\";s:10:\"font_style\";s:6:\"normal\";s:11:\"line_height\";s:2:\"48\";s:14:\"letter_spacing\";s:1:\"0\";s:14:\"text_transform\";s:4:\"none\";}',	'no'),
				('_options_h1_settings',	'field_630415be8cc3c',	'no'),
				('options_h2_settings',	'a:7:{s:9:\"font_size\";s:2:\"34\";s:11:\"font_family\";s:6:\"Roboto\";s:11:\"font_weight\";s:3:\"700\";s:10:\"font_style\";s:6:\"normal\";s:11:\"line_height\";s:2:\"46\";s:14:\"letter_spacing\";s:1:\"0\";s:14:\"text_transform\";s:4:\"none\";}',	'no'),
				('_options_h2_settings',	'field_63041f1b57b5c',	'no'),
				('options_h3_settings',	'a:7:{s:9:\"font_size\";s:2:\"28\";s:11:\"font_family\";s:6:\"Roboto\";s:11:\"font_weight\";s:3:\"700\";s:10:\"font_style\";s:6:\"normal\";s:11:\"line_height\";s:2:\"38\";s:14:\"letter_spacing\";s:1:\"0\";s:14:\"text_transform\";s:4:\"none\";}',	'no'),
				('_options_h3_settings',	'field_63041f989cce0',	'no'),
				('options_h4_settings',	'a:7:{s:9:\"font_size\";s:2:\"26\";s:11:\"font_family\";s:6:\"Roboto\";s:11:\"font_weight\";s:3:\"700\";s:10:\"font_style\";s:6:\"normal\";s:11:\"line_height\";s:2:\"32\";s:14:\"letter_spacing\";s:1:\"0\";s:14:\"text_transform\";s:4:\"none\";}',	'no'),
				('_options_h4_settings',	'field_63041fad9cce1',	'no'),
				('options_h5_settings',	'a:7:{s:9:\"font_size\";s:2:\"22\";s:11:\"font_family\";s:6:\"Roboto\";s:11:\"font_weight\";s:3:\"700\";s:10:\"font_style\";s:6:\"normal\";s:11:\"line_height\";s:2:\"28\";s:14:\"letter_spacing\";s:1:\"0\";s:14:\"text_transform\";s:4:\"none\";}',	'no'),
				('_options_h5_settings',	'field_63041fbb9cce2',	'no'),
				('options_h6_settings',	'a:7:{s:9:\"font_size\";s:2:\"18\";s:11:\"font_family\";s:6:\"Roboto\";s:11:\"font_weight\";s:3:\"700\";s:10:\"font_style\";s:6:\"normal\";s:11:\"line_height\";s:2:\"24\";s:14:\"letter_spacing\";s:1:\"0\";s:14:\"text_transform\";s:4:\"none\";}',	'no'),
				('_options_h6_settings',	'field_63041fca9cce3',	'no'),
				('options_sidebar_heading_settings',	'a:7:{s:9:\"font_size\";s:2:\"34\";s:11:\"font_family\";s:6:\"Roboto\";s:11:\"font_weight\";s:3:\"400\";s:10:\"font_style\";s:6:\"normal\";s:11:\"line_height\";s:2:\"48\";s:14:\"letter_spacing\";s:1:\"0\";s:14:\"text_transform\";s:4:\"none\";}',	'no'),
				('_options_sidebar_heading_settings',	'field_64073b6c6ee21',	'no'),
				('options_sidebar_list_items_settings',	'a:7:{s:9:\"font_size\";s:2:\"18\";s:11:\"font_family\";s:6:\"Roboto\";s:11:\"font_weight\";s:3:\"400\";s:10:\"font_style\";s:6:\"normal\";s:11:\"line_height\";s:2:\"30\";s:14:\"letter_spacing\";s:1:\"0\";s:14:\"text_transform\";s:4:\"none\";}',	'no'),
				('_options_sidebar_list_items_settings',	'field_640f11d7c8032',	'no'),
				('options_sidebar_text_settings',	'a:7:{s:9:\"font_size\";s:2:\"24\";s:11:\"font_family\";s:6:\"Roboto\";s:11:\"font_weight\";s:3:\"400\";s:10:\"font_style\";s:6:\"normal\";s:11:\"line_height\";s:2:\"24\";s:14:\"letter_spacing\";s:1:\"0\";s:14:\"text_transform\";s:4:\"none\";}',	'no'),
				('_options_sidebar_text_settings',	'field_640f12d0117a5',	'no'),
				('options_show_sidebar_globally',	'1',	'no'),
				('_options_show_sidebar_globally',	'field_6419c4c9db9b8',	'no'),
				('options_nav_font_settings',	'a:7:{s:9:\"font_size\";s:2:\"18\";s:11:\"font_family\";s:6:\"Roboto\";s:11:\"font_weight\";s:3:\"400\";s:10:\"font_style\";s:6:\"normal\";s:11:\"line_height\";s:2:\"24\";s:14:\"letter_spacing\";s:1:\"0\";s:14:\"text_transform\";s:4:\"none\";}',	'no'),
				('_options_nav_font_settings',	'field_640f0f40f5833',	'no'),
				('options_footer_heading_settings',	'a:7:{s:9:\"font_size\";s:2:\"20\";s:11:\"font_family\";s:6:\"Roboto\";s:11:\"font_weight\";s:3:\"400\";s:10:\"font_style\";s:6:\"normal\";s:11:\"line_height\";s:2:\"20\";s:14:\"letter_spacing\";s:1:\"0\";s:14:\"text_transform\";s:4:\"none\";}',	'no'),
				('_options_footer_heading_settings',	'field_6407dbf05fecf',	'no'),
				('options_footer_list_item_settings',	'a:7:{s:9:\"font_size\";s:2:\"20\";s:11:\"font_family\";s:6:\"Roboto\";s:11:\"font_weight\";s:3:\"400\";s:10:\"font_style\";s:6:\"normal\";s:11:\"line_height\";s:2:\"20\";s:14:\"letter_spacing\";s:1:\"0\";s:14:\"text_transform\";s:4:\"none\";}',	'no'),
				('_options_footer_list_item_settings',	'field_640f0337406df',	'no'),
				('options_sidebar_bg_color_color_names',	'none',	'no'),
				('_options_sidebar_bg_color_color_names',	'field_60ef96004903e',	'no'),
				('options_sidebar_bg_color',	'',	'no'),
				('_options_sidebar_bg_color',	'field_64074155551a0',	'no'),
				('options_sidebar_text_color_color_names',	'dark',	'no'),
				('_options_sidebar_text_color_color_names',	'field_60ef96004903e',	'no'),
				('options_sidebar_text_color',	'',	'no'),
				('_options_sidebar_text_color',	'field_64074c43f09be',	'no'),
				('options_sidebar_link_color_color_names',	'dark',	'no'),
				('_options_sidebar_link_color_color_names',	'field_60ef96004903e',	'no'),
				('options_sidebar_link_color',	'',	'no'),
				('_options_sidebar_link_color',	'field_64074de516099',	'no'),
				('options_sidebar_padding_padding_options_top_bottom',	'py-0',	'no'),
				('_options_sidebar_padding_padding_options_top_bottom',	'field_6305444400304',	'no'),
				('options_sidebar_padding_padding_options_left_right',	'px-2',	'no'),
				('_options_sidebar_padding_padding_options_left_right',	'field_630550c5259b5',	'no'),
				('options_sidebar_padding',	'',	'no'),
				('_options_sidebar_padding',	'field_6407483b38c0b',	'no'),
				('options_logo_max_width',	'200',	'no'),
				('_options_logo_max_width',	'field_63566f2c9685a',	'no'),
				('options_header_text_color_color_names',	'light',	'no'),
				('_options_header_text_color_color_names',	'field_60ef96004903e',	'no'),
				('options_header_text_color',	'',	'no'),
				('_options_header_text_color',	'field_60f15f5fa179b',	'no'),
				('options_header_background_color_color_names',	'dark',	'no'),
				('_options_header_background_color_color_names',	'field_60ef96004903e',	'no'),
				('options_header_background_color',	'',	'no'),
				('_options_header_background_color',	'field_60ef8d7f3785c',	'no'),
				('options_navbar_background_color_color_names',	'none',	'no'),
				('_options_navbar_background_color_color_names',	'field_60ef96004903e',	'no'),
				('options_navbar_background_color',	'',	'no'),
				('_options_navbar_background_color',	'field_63a18940ff3a0',	'no'),
				('options_header_background_image',	'',	'no'),
				('_options_header_background_image',	'field_63a19228da688',	'no'),
				('options_nav_on_its_own_line',	'0',	'no'),
				('_options_nav_on_its_own_line',	'field_63a1829d5b744',	'no'),
				('options_show_topbar',	'0',	'no'),
				('_options_show_topbar',	'field_63a18479e8c10',	'no'),
				('options_header_overlay_on_homepage',	'0',	'no'),
				('_options_header_overlay_on_homepage',	'field_61f5c927d3d30',	'no'),
				('options_page_header_width',	'boxed',	'no'),
				('_options_page_header_width',	'field_6407e412003e3',	'no'),
				('options_sticky_nav',	'1',	'no'),
				('_options_sticky_nav',	'field_63a1907c2a1de',	'no'),
				('options_page_header_background_color_color_names',	'primary',	'no'),
				('_options_page_header_background_color_color_names',	'field_60ef96004903e',	'no'),
				('options_page_header_text_color',	'text-dark',	'no'),
				('_options_page_header_text_color',	'field_6357450415641',	'no'),
				('options_padding_options_top_bottom',	'py-0',	'no'),
				('_options_padding_options_top_bottom',	'field_6305444400304',	'no'),
				('options_padding_options_left_right',	'px-0',	'no'),
				('_options_padding_options_left_right',	'field_630550c5259b5',	'no'),
				('options_page_header_margin',	'my-0',	'no'),
				('_options_page_header_margin',	'field_635745041564e',	'no'),
				('options_page_header_background_image',	'',	'no'),
				('_options_page_header_background_image',	'field_6357450415655',	'no'),
				('options_page_header_background_image_parallax',	'0',	'no'),
				('_options_page_header_background_image_parallax',	'field_635745041565b',	'no'),
				('options_color_names',	'dark',	'no'),
				('_options_color_names',	'field_60ef96004903e',	'no'),
				('options_page_header_background_color_overlay_opacity',	'',	'no'),
				('_options_page_header_background_color_overlay_opacity',	'field_6357450415669',	'no'),
				('options__copy',	'',	'no'),
				('_options__copy',	'field_635746299217f',	'no'),
				('options_footer_background_color',	'',	'no'),
				('_options_footer_background_color',	'field_61f5ef10bd041',	'no'),
				('options_footer_text_color_color_names',	'dark',	'no'),
				('_options_footer_text_color_color_names',	'field_60ef96004903e',	'no'),
				('options_footer_text_color',	'',	'no'),
				('_options_footer_text_color',	'field_61f5f215062b1',	'no'),
				('options_footer_link_color_color_names',	'light',	'no'),
				('_options_footer_link_color_color_names',	'field_60ef96004903e',	'no'),
				('options_footer_link_color',	'',	'no'),
				('_options_footer_link_color',	'field_6407d6e4db58a',	'no'),
				('options_footer_column_count',	'1fr 1fr 1fr',	'no'),
				('_options_footer_column_count',	'field_61f5eb85609b6',	'no'),
				('options_copyright_content',	'',	'no'),
				('_options_copyright_content',	'field_61f5f7570884c',	'no'),
				('options_button_background_color_color_names',	'dark',	'no'),
				('_options_button_background_color_color_names',	'field_60ef96004903e',	'no'),
				('options_button_background_color',	'',	'no'),
				('_options_button_background_color',	'field_6305357f1f311',	'no'),
				('options_button_background_color_hover_color_names',	'primary',	'no'),
				('_options_button_background_color_hover_color_names',	'field_60ef96004903e',	'no'),
				('options_button_background_color_hover',	'',	'no'),
				('_options_button_background_color_hover',	'field_6305358d1f312',	'no'),
				('options_button_text_color_color_names',	'light',	'no'),
				('_options_button_text_color_color_names',	'field_60ef96004903e',	'no'),
				('options_button_text_color',	'',	'no'),
				('_options_button_text_color',	'field_630535a01f313',	'no'),
				('options_button_text_color_hover_color_names',	'light',	'no'),
				('_options_button_text_color_hover_color_names',	'field_60ef96004903e',	'no'),
				('options_button_text_color_hover',	'',	'no'),
				('_options_button_text_color_hover',	'field_630540f0893f5',	'no'),
				('options_button_padding_padding_options_top_bottom',	'py-0',	'no'),
				('_options_button_padding_padding_options_top_bottom',	'field_6305444400304',	'no'),
				('options_button_padding_padding_options_left_right',	'px-0',	'no'),
				('_options_button_padding_padding_options_left_right',	'field_630550c5259b5',	'no'),
				('options_button_padding',	'',	'no'),
				('_options_button_padding',	'field_6305430ad8977',	'no'),
				('options_card_padding_padding_options_top_bottom',	'py-4',	'no'),
				('_options_card_padding_padding_options_top_bottom',	'field_6305444400304',	'no'),
				('options_card_padding_padding_options_left_right',	'px-0',	'no'),
				('_options_card_padding_padding_options_left_right',	'field_630550c5259b5',	'no'),
				('options_card_padding',	'',	'no'),
				('_options_card_padding',	'field_63cfdf827eade',	'no'),
				('options_card_content_padding_padding_options_top_bottom',	'py-4',	'no'),
				('_options_card_content_padding_padding_options_top_bottom',	'field_6305444400304',	'no'),
				('options_card_content_padding_padding_options_left_right',	'px-3',	'no'),
				('_options_card_content_padding_padding_options_left_right',	'field_630550c5259b5',	'no'),
				('options_card_content_padding',	'',	'no'),
				('_options_card_content_padding',	'field_63ff3cb198930',	'no'),
				('options_card_background_color_color_names',	'light',	'no'),
				('_options_card_background_color_color_names',	'field_60ef96004903e',	'no'),
				('options_card_background_color',	'',	'no'),
				('_options_card_background_color',	'field_6345848449ea7',	'no'),
				('options_card_full_min_height',	'300',	'no'),
				('_options_card_full_min_height',	'field_6416337942eb4',	'no'),
				('options_card_full_background_overlay_color',	'',	'no'),
				('_options_card_full_background_overlay_color',	'field_64163fc9fa2df',	'no'),
				('options_card_full_background_color_overlay_opacity',	'',	'no'),
				('_options_card_full_background_color_overlay_opacity',	'field_64164006dcea6',	'no'),
				('options_card_full_text_color_color_names',	'dark',	'no'),
				('_options_card_full_text_color_color_names',	'field_60ef96004903e',	'no'),
				('options_card_full_text_color',	'',	'no'),
				('_options_card_full_text_color',	'field_6419b76b1e166',	'no'),
				('options_card_title_element_element_options',	'h4',	'no'),
				('_options_card_title_element_element_options',	'field_6303fb72a3f0c',	'no'),
				('options_card_title_element',	'',	'no'),
				('_options_card_title_element',	'field_6345976456456',	'no'),
				('options_card_title_position_position_options',	'start',	'no'),
				('_options_card_title_position_position_options',	'field_6303fd5478f80',	'no'),
				('options_card_title_position',	'',	'no'),
				('_options_card_title_position',	'field_63459bef99d32',	'no'),
				('options_card_title_color_color_names',	'dark',	'no'),
				('_options_card_title_color_color_names',	'field_60ef96004903e',	'no'),
				('options_card_title_color',	'',	'no'),
				('_options_card_title_color',	'field_63459cb2185ee',	'no'),
				('options_card_title_padding_padding_options_top_bottom',	'py-0',	'no'),
				('_options_card_title_padding_padding_options_top_bottom',	'field_6305444400304',	'no'),
				('options_card_title_padding_padding_options_left_right',	'px-0',	'no'),
				('_options_card_title_padding_padding_options_left_right',	'field_630550c5259b5',	'no'),
				('options_card_title_padding',	'',	'no'),
				('_options_card_title_padding',	'field_6345a87e517b4',	'no'),
				('options_card_button_show',	'0',	'no'),
				('_options_card_button_show',	'field_635671a38739e',	'no'),
				('options_card_button_default_text',	'Read More',	'no'),
				('_options_card_button_default_text',	'field_635671cb8739f',	'no'),
				('options_card_button_background_color_color_names',	'dark',	'no'),
				('_options_card_button_background_color_color_names',	'field_60ef96004903e',	'no'),
				('options_card_button_background_color',	'',	'no'),
				('_options_card_button_background_color',	'field_6345aa23c0544',	'no'),
				('options_card_button_background_color_hover_color_names',	'primary',	'no'),
				('_options_card_button_background_color_hover_color_names',	'field_60ef96004903e',	'no'),
				('options_card_button_background_color_hover',	'',	'no'),
				('_options_card_button_background_color_hover',	'field_6345aa33c0545',	'no'),
				('options_card_button_text_color_color_names',	'light',	'no'),
				('_options_card_button_text_color_color_names',	'field_60ef96004903e',	'no'),
				('options_card_button_text_color',	'',	'no'),
				('_options_card_button_text_color',	'field_6345aa42c0546',	'no'),
				('options_card_button_text_color_hover_color_names',	'light',	'no'),
				('_options_card_button_text_color_hover_color_names',	'field_60ef96004903e',	'no'),
				('options_card_button_text_color_hover',	'',	'no'),
				('_options_card_button_text_color_hover',	'field_6345aa52c0547',	'no'),
				('options_card_button_padding_padding_options_top_bottom',	'py-2',	'no'),
				('_options_card_button_padding_padding_options_top_bottom',	'field_6305444400304',	'no'),
				('options_card_button_padding_padding_options_left_right',	'px-4',	'no'),
				('_options_card_button_padding_padding_options_left_right',	'field_630550c5259b5',	'no'),
				('options_card_button_padding',	'',	'no'),
				('_options_card_button_padding',	'field_6345aa60c0548',	'no'),
				('options_card_button_position_position_options',	'center',	'no'),
				('_options_card_button_position_position_options',	'field_6303fd5478f80',	'no'),
				('options_card_button_position',	'',	'no'),
				('_options_card_button_position',	'field_63cfe1e18fe4f',	'no'),
				('options_card_excerpt_show',	'1',	'no'),
				('_options_card_excerpt_show',	'field_6345a744b690d',	'no'),
				('options_card_excerpt_padding_padding_options_top_bottom',	'py-2',	'no'),
				('_options_card_excerpt_padding_padding_options_top_bottom',	'field_6305444400304',	'no'),
				('options_card_excerpt_padding_padding_options_left_right',	'px-0',	'no'),
				('_options_card_excerpt_padding_padding_options_left_right',	'field_630550c5259b5',	'no'),
				('options_card_excerpt_padding',	'',	'no'),
				('_options_card_excerpt_padding',	'field_6345a19d5483e',	'no'),
				('options_card_excerpt_position_position_options',	'start',	'no'),
				('_options_card_excerpt_position_position_options',	'field_6303fd5478f80',	'no'),
				('options_card_excerpt_position',	'',	'no'),
				('_options_card_excerpt_position',	'field_6345a3bd7ec86',	'no'),
				('options_card_excerpt_color_color_names',	'dark',	'no'),
				('_options_card_excerpt_color_color_names',	'field_60ef96004903e',	'no'),
				('options_card_excerpt_color',	'',	'no'),
				('_options_card_excerpt_color',	'field_6345a3d07ec87',	'no'),
				('options_site_fallback_image',	'',	'no'),
				('_options_site_fallback_image',	'field_6328591c51c72',	'no'),
				('options_user_fallback_image',	'1016',	'no'),
				('_options_user_fallback_image',	'field_63b765e2ff121',	'no'),
				('options_ad_repeater',	'',	'no'),
				('_options_ad_repeater',	'field_63cf2a7cace1f',	'no'),
				('options_single_post_featured_image_size_type',	'cover',	'no'),
				('_options_single_post_featured_image_size_type',	'field_64ac0a0ecffa8',	'no'),
				('options_index_layout_column_count',	'2',	'no'),
				('_options_index_layout_column_count',	'field_63cfdd80b1d75',	'no'),
				(1448079,	'_transient_timeout_apbPostsArgs-bef6d832-3',	'1689083769',	'no'),
				(1448080,	'_transient_apbPostsArgs-bef6d832-3',	'a:8:{s:9:\"post_type\";s:4:\"post\";s:14:\"posts_per_page\";i:12;s:7:\"orderby\";s:4:\"date\";s:5:\"order\";s:4:\"desc\";s:9:\"tax_query\";a:1:{s:8:\"relation\";s:3:\"AND\";}s:6:\"offset\";i:0;s:12:\"category__in\";a:0:{}s:7:\"tag__in\";a:0:{}}',	'no'),
				('options_card_excerpt_character_limit',	'100',	'no'),
				('_options_card_excerpt_character_limit',	'field_64ac1de13d0f6',	'no'),
				('options_sidebar_list_item_spacing',	'6',	'no'),
				('_options_sidebar_list_item_spacing',	'field_64ac22e96f728',	'no'),
				('options_card_title_link',	'1',	'no'),
				('_options_card_title_link',	'field_64ac2890c6e92',	'no'),
				('options_card_image_padding',	'100',	'no'),
				('_options_card_image_padding',	'field_64ac2c7f55f64',	'no'),
				('options_card_image_link',	'1',	'no'),
				('_options_card_image_link',	'field_64ac323213c02',	'no');
				('options_single_post_featured_image',	'1',	'no'),
				('_options_single_post_featured_image',	'field_649b2867e108c',	'no'),
				('options_',	'',	'no'),
				('_options_',	'field_649b2840e108b',	'no'),
				('options_single_post_height',	'50',	'no'),
				('_options_single_post_height',	'field_649b2e1ec67ba',	'no'),
				('options_single_post_featured_image_height',	'30',	'no'),
				('_options_single_post_featured_image_height',	'field_649b2e1ec67ba',	'no'),
				(1288793,	'acft_settings',	'a:1:{s:10:\"google_key\";s:39:\"AIzaSyCpsCYh4tdrfNVO0WqAu0fQ5aIAouilIYg\";}',	'yes'),
				('options_card_shadow',	'1',	'no'),
				('_options_card_shadow',	'field_649b6339dcba4',	'no'),
				('options_card_border_radius',	'1',	'no'),
				('_options_card_border_radius',	'field_649b67cb56480',	'no'),
				('options_card_shadow_copy',	'a:3:{i:0;s:11:\"meta-author\";i:1;s:9:\"meta-date\";i:2;s:13:\"meta-category\";}',	'no'),
				('_options_card_shadow_copy',	'field_649b701ce60bc',	'no'),
				('options_show_meta',	'a:3:{i:0;s:11:\"meta-author\";i:1;s:9:\"meta-date\";i:2;s:13:\"meta-category\";}',	'no'),
				('_options_show_meta',	'field_649b701ce60bc',	'no');
			";


		$wpdb->query($wpdb->prepare($option_sql));


	}
endif;
add_action( 'after_setup_theme', 'v4_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function v4_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'v4_content_width', 640 );
}
add_action( 'after_setup_theme', 'v4_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function v4_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'v4' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'v4' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar( array(
			'name'          => 'Footer Widgets',
			'id'            => 'footer-widget',
			'before_widget' => '<div class="footer-widget">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="footer-title">',
			'after_title'   => '</h2>',
	) );

}
add_action( 'widgets_init', 'v4_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function v4_scripts() {
	wp_enqueue_style('v4-lightbox-style', get_template_directory_uri() . '/css/lightbox.css', array(), _S_VERSION, false);

	wp_enqueue_style( 'v4-style', get_stylesheet_uri(), array(), _S_VERSION );
	// wp_enqueue_style( 'v4-slick-css', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css', array(), _S_VERSION, true );
	// wp_enqueue_style( 'v4-slick-css-theme', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css', array(), _S_VERSION, true );
	wp_style_add_data( 'v4-style', 'rtl', 'replace' );

	wp_enqueue_script( 'v4-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );
	
	// if (get_field('include_sticky_sidebar_script', 'option')) {
	// 	wp_enqueue_script('v4-sticky-sidebar', get_template_directory_uri() . '/js/sticky.js', array(), _S_VERSION, true);
	// }


	wp_enqueue_script( 'v4-bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'v4-fontawesome', 'https://kit.fontawesome.com/372d5631e9.js', array(), _S_VERSION, true );
	// wp_enqueue_script( 'v4-slick', get_stylesheet_directory_uri() . '/js/slick.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'v4-custom', get_template_directory_uri() . '/js/v4.js', array('jquery'), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script('v4-lightbox', get_template_directory_uri() . '/js/lightbox.js', array('jquery'), _S_VERSION);
}
add_action( 'wp_enqueue_scripts', 'v4_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Custom Navwalker functionality
 */
	require get_template_directory() . '/inc/navwalker.php';

/**
 * Custom V4 functionality
 */
	require get_template_directory() . '/inc/v4.php';

	add_theme_support( 'align-wide' );


