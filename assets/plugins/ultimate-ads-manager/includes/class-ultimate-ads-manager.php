<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://codeneric.com
 * @since      1.0.0
 *
 * @package    Ultimate_Ads_Manager
 * @subpackage Ultimate_Ads_Manager/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Ultimate_Ads_Manager
 * @subpackage Ultimate_Ads_Manager/includes
 * @author     Codeneric <contact@codeneric.com>
 */
class Ultimate_Ads_Manager {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Ultimate_Ads_Manager_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		global $cc_uam_config;
		$this->plugin_name = 'ultimate-ads-manager';


		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

		$this->version = $cc_uam_config['version'];
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Ultimate_Ads_Manager_Loader. Orchestrates the hooks of the plugin.
	 * - Ultimate_Ads_Manager_i18n. Defines internationalization functionality.
	 * - Ultimate_Ads_Manager_Admin. Defines all hooks for the admin area.
	 * - Ultimate_Ads_Manager_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-ultimate-ads-manager-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-ultimate-ads-manager-i18n.php';



		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-ultimate-ads-manager-admin.php';

		/**
		 * The class responsible for the widget
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-ultimate-ads-manager-widget.php';

		/**
		 * The class responsible for the settings
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-ultimate-ads-manager-settings.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-ultimate-ads-manager-public.php';


		/**
		 * The class responsible for configs
		 * of the plugin.
		 */

		$this->loader = new Ultimate_Ads_Manager_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Ultimate_Ads_Manager_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Ultimate_Ads_Manager_i18n();
		$plugin_i18n->set_domain( $this->get_plugin_name() );

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {
		global $cc_uam_config;

		$plugin_admin = new Ultimate_Ads_Manager_Admin( $this->get_plugin_name(), $this->get_version() );
		$settings = new Ultimate_Ads_Manager_Settings($this->get_plugin_name(), $this->get_version(), $plugin_admin->display_name);
		$widget = new Ultimate_Ads_Manager_Widget();



		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );


		$this->loader->add_action( 'init', $plugin_admin, 'register_post_type_codeneric_ad' );



//		$this->loader->add_action( 'init', Ultimate_Ads_Manager_Base_Shortcode, 'init' );
		$this->loader->add_action( 'init', $plugin_admin, 'register_shortcodes' , 10);



		$this->loader->add_action( 'admin_menu', $plugin_admin, 'add_submenu_pages' );

		$this->loader->add_action( 'admin_menu', $plugin_admin, 'hide_add_new' );

		$this->loader->add_filter('manage_'.$cc_uam_config['custom_post_slug'].'_posts_columns', $plugin_admin,'define_table_columns');
		$this->loader->add_action( 'manage_'.$cc_uam_config['custom_post_slug'].'_posts_custom_column', $plugin_admin, 'fill_custom_columns',10,2 );


		$this->loader->add_filter('manage_'.$cc_uam_config['custom_post_slug'].'_group_posts_columns', $plugin_admin,'define_table_columns_group');
		$this->loader->add_action( 'manage_'.$cc_uam_config['custom_post_slug'].'_group_posts_custom_column', $plugin_admin, 'fill_custom_columns_group',10,2 );

        $this->loader->add_filter('manage_'.$cc_uam_config['place_slug'].'_posts_columns', $plugin_admin,'define_places_table_columns');
        $this->loader->add_action( 'manage_'.$cc_uam_config['place_slug'].'_posts_custom_column', $plugin_admin, 'fill_places_custom_columns',10,2 );


        $this->loader->add_action( 'wp_ajax_codeneric_query_statistics', $plugin_admin, 'handle_statistics_query' );
		$this->loader->add_action( 'wp_ajax_codeneric_proxy_get', $plugin_admin, 'proxy_get');
		$this->loader->add_action( 'wp_ajax_codeneric_uam_send_feedback', $plugin_admin, 'send_support_feedback');
		$this->loader->add_action( 'wp_ajax_codeneric_uam_ask_status', $plugin_admin, 'listen_on_call');


		$this->loader->add_action( 'init', $settings, 'load_settings' );
		$this->loader->add_action( 'admin_init', $settings, 'register_general_settings' );


		$this->loader->add_action( 'add_meta_boxes', $plugin_admin, 'add_meta_boxes' );
		$this->loader->add_action( 'save_post', $plugin_admin, 'save_meta_boxes' );

		$this->loader->add_action( 'save_post', $plugin_admin, 'save_place' );

        $this->loader->add_action( 'codeneric_uam_update_symlink', $plugin_admin, 'update_symlink' );





		$this->loader->add_action('widgets_init', $widget, 'init');
		$this->loader->add_action( 'admin_enqueue_scripts', $widget, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $widget, 'enqueue_scripts' );

        $this->loader->add_action( 'codeneric/uam/after_save_ad', $plugin_admin, 'update_places_after_advert', 10, 2 );
        $this->loader->add_action( 'codeneric/uam/after_save_group', $plugin_admin, 'update_places_after_group', 10, 1 );

        $this->loader->add_action( 'before_delete_post', $plugin_admin, 'update_places_on_deletion' );
        $this->loader->add_action( 'before_delete_post', $plugin_admin, 'update_groups_on_deletion' );

        $this->loader->add_action( 'codeneric/uam/register_callback', $plugin_admin, 'register_callback', 10, 1 );

		//$this->loader->add_filter('widgets_init', $plugin_admin,'define_table_columns');


	}




	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Ultimate_Ads_Manager_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );

        $this->loader->add_action( 'wp_ajax_nopriv_codeneric_ad_event', $plugin_public, 'handle_client_side_ad_event' );
        $this->loader->add_action( 'wp_ajax_codeneric_ad_event', $plugin_public, 'handle_client_side_ad_event' );

		$this->loader->add_action( 'codeneric/uam/add_ad_meta', $plugin_public, 'add_current_ad_meta', 10, 2);

		$this->loader->add_action( 'wp_footer', $plugin_public, 'enqueue_scripts', 20);
		$this->loader->add_action( 'wp_footer', $plugin_public, 'append_ga_tracking_code', true );
		//add_action( 'wp_footer', 'print_my_inline_script' );


		$widget = new Ultimate_Ads_Manager_Widget();


	}





	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Ultimate_Ads_Manager_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
