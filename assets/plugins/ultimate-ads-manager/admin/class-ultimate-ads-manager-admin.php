<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://codeneric.com
 * @since      1.0.0
 *
 * @package    Ultimate_Ads_Manager
 * @subpackage Ultimate_Ads_Manager/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Ultimate_Ads_Manager
 * @subpackage Ultimate_Ads_Manager/admin
 * @author     Codeneric <contact@codeneric.com>
 */
class Ultimate_Ads_Manager_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $plugin_name The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $version The current version of this plugin.
	 */

	public $display_name = 'Ultimate Ads Manager';
	private $version;
	private $stats_calc;
	private $settings_mgr;

	static $settings;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 *
	 * @param      string $plugin_name The name of this plugin.
	 * @param      string $version The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {
		$this->plugin_name = $plugin_name;
		$this->version     = $version;
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-ultimate-ads-manager-statistics-calculator.php';
		$this->stats_calc = new Statistics_Calculator();

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-ultimate-ads-manager-settings.php';
		$this->settings_mgr = new Ultimate_Ads_Manager_Settings($this->plugin_name, $this->version, $this->display_name);
		$this->settings_mgr->load_settings();

		Ultimate_Ads_Manager_Admin::$settings = $this->settings_mgr;


	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Ultimate_Ads_Manager_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Ultimate_Ads_Manager_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		wp_enqueue_style( 'thickbox' );
		//wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/ultimate-ads-manager-admin.css', array(), $this->version, 'all' );
		//wp_enqueue_style( $this->plugin_name, UAM_Config::$plugin_adblock_url . '/admin/css/ultimate-ads-manager-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */


//	// soon deprecated
//	public function generate_ui_globals() {
//		global $cc_uam_config;
//		$globals = array();
//
//		$globals['ad_group'] = $cc_uam_config['plugin_adblock_url'].'/assets/';
//		$globals['id'] = get_option('codeneric_uam_uuid');
//
//		$globals['wpps_url'] = str_replace('http://', 'https://', $cc_uam_config['wpps_url']);
//		$globals['admin_email'] = get_option('admin_email');
//		$globals['assets'] = $cc_uam_config['plugin_adblock_url'].'/assets/';
//
//
//		// paypal_return
//		$isSecure =
//			( ! empty( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] !== 'off' )
//			|| $_SERVER['SERVER_PORT'] == 443;
//
//		$return_url = "$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
//		$return_url = $isSecure ? "https://$return_url" : "http://$return_url";
//		$return_url = add_query_arg( 'paid', 'yes', $return_url );
//
//		$globals['paypal_return'] = $return_url;
//
//		$globals['paypal_return'] = $return_url;
//		$globals['paypal_merchant'] = $cc_uam_config['paypal_merchant'];
//		$globals['paypal_post_url'] = $cc_uam_config['paypal_post_url'];
//		$globals['paypal_env'] = $cc_uam_config['paypal_env'];
//
//		$globals['stripe_key'] = $cc_uam_config['stripe_key'];
//
//
//		$adminurl = admin_url( 'edit.php' );
//		$globals['support_url'] = add_query_arg( array('post_type' => $cc_uam_config['custom_post_slug'], 'page' => 'support'), $adminurl);
//
//		wp_enqueue_script( 'stripe','https://checkout.stripe.com/checkout.js', array(), '2.1.1', false );
//
//		return $globals;
//
//	}



	public function generate_js_globals() {
		global $cc_uam_config;
		$globals = array();

		$globals['ad_group'] = $cc_uam_config['plugin_adblock_url'].'/assets/';
		$globals['id'] = get_option($cc_uam_config['plugin_id_option']);

		$globals['wpps_url'] = str_replace('http://', 'https://', $cc_uam_config['wpps_url']);
		$globals['admin_email'] = get_option('admin_email');
		$globals['assets'] = $cc_uam_config['plugin_adblock_url'].'/assets/';


		// paypal_return
		$isSecure =
			( ! empty( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] !== 'off' )
			|| $_SERVER['SERVER_PORT'] == 443;

		$return_url = "$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		$return_url = $isSecure ? "https://$return_url" : "http://$return_url";
		$return_url = add_query_arg( 'paid', 'yes', $return_url );

		$globals['paypal_return'] = $return_url;

		$globals['paypal_return'] = $return_url;
		$globals['paypal_merchant'] = $cc_uam_config['paypal_merchant'];
		$globals['paypal_post_url'] = $cc_uam_config['paypal_post_url'];
		$globals['paypal_env'] = $cc_uam_config['paypal_env'];
		$globals['plugin_display_name'] = $cc_uam_config['plugin_display_name'];
		$globals['checkout_url'] = $cc_uam_config['checkout_url'];



		$globals['stripe_key'] = $cc_uam_config['stripe_key'];


		$post = get_post();

		if($post) {
			$adID = $post->ID;

			$globals['ad_meta'] = (array) get_post_meta( $adID , 'ad', true );
            $r = get_post_meta( $adID , 'restrictions', true );
			$globals['ad_restrictions'] = is_array($r) ? $r : array();
            if(!empty($globals['ad_restrictions']['start'])){
                $globals['ad_restrictions']['start'] = date('Y-m-d', $globals['ad_restrictions']['start']);
            }
            if(!empty($globals['ad_restrictions']['end'])){
                $globals['ad_restrictions']['end'] = date('Y-m-d', $globals['ad_restrictions']['end']);
            }
		}



		$adminurl = admin_url( 'edit.php' );
		$globals['support_url'] = add_query_arg( array('post_type' => $cc_uam_config['custom_post_slug'], 'page' => 'codeneric_uam_support'), $adminurl);

//		wp_enqueue_script( 'stripe','https://checkout.stripe.com/checkout.js', array(), '2.1.1', false );

		return $globals;

	}
	public function enqueue_ad_script($script_name, $path, $version) {
		$current = get_current_screen();
		global $cc_uam_config;

		if ( $current->base == 'post' && $current->post_type == $cc_uam_config['custom_post_slug'] ) {

			wp_enqueue_media();
			wp_register_script( $script_name, $path, array( 'jquery' ), null, true );

			$post = get_post();
			$adID = $post->ID;
			$meta = (array) get_post_meta( $adID, 'ad', true );

			$globals = $this->generate_js_globals();

			wp_localize_script( $script_name, 'UAM_GLOBALS', $globals );
			//wp_localize_script( $script_name, 'codeneric_uam_ad_meta', $meta );
			wp_enqueue_script( $script_name );

		}
	}
	public function enqueue_ad_group_script($script_name, $path, $version) {
		$current = get_current_screen();
		global $cc_uam_config;

		if ( $current->base == 'post' && $current->post_type == $cc_uam_config['custom_post_slug'] . '_group' ) {

			wp_register_script( $script_name, $path, array( 'jquery' ),$version, true );

			$globals = $this->generate_js_globals();

			//-- GET POSTS
			$args        = array(
				'posts_per_page' => - 1,
				'orderby'        => 'date',
				'order'          => 'DESC',
				'post_type'      => $cc_uam_config['custom_post_slug'],
				'post_status'    => 'publish'
				//'suppress_filters' => true
			);
			$posts_array = get_posts( $args );
			$globals['ad_posts'] = $posts_array;

			// -----------------

			$post = get_post();
			$adID = $post->ID;
			$ad_group_ids       = get_post_meta( $adID, 'ad_group', true );
			$ad_group_ids = is_string($ad_group_ids) ? $ad_group_ids : '';
			$ad_group_ids_array = explode( ",", $ad_group_ids );

			if ( $ad_group_ids == "" ) {
				$ad_group_ids_array = array();
			}


			$ad_group = array();
			foreach ( $ad_group_ids_array as $ID ) {
				$temp = get_post( $ID );
				if($temp !== null)
					array_push( $ad_group, $temp );
			}

			$globals['ad_group'] = $ad_group;


			wp_localize_script( $script_name, 'UAM_GLOBALS', $globals );

			wp_enqueue_script( $script_name );

		}
	}


	public function enqueue_settings_script($script_name, $path, $version) {
		$current = get_current_screen();
		global $cc_uam_config;

		if ( $current->base == $cc_uam_config['custom_post_slug'] . '_page_settings' ) {
			wp_register_script( $script_name, $path, array( 'jquery' ),$version, true );

			$globals =  $this->generate_js_globals();

			$globals['settings'] = $this->settings_mgr->general_settings;
			$globals['ajax_url'] = admin_url('admin-ajax.php');
			$next_optimization_job = 'Never';
			$job_time = wp_next_scheduled( $cc_uam_config['optimize_cron_hook'] );
			$db_opt_enabled = isset($globals['settings']) &&
                isset($globals['settings']['db_optimization']) &&
                !empty($globals['settings']['db_optimization']['enabled']);

			if($job_time !== false && $db_opt_enabled){
			    $next_optimization_job = gmdate("F j, Y, g:i a", $job_time);
            }
            $globals['next_optimization_job'] = $next_optimization_job;

            $globals = apply_filters('codeneric/uam/settings_globals', $globals);

			wp_localize_script( $script_name, 'UAM_GLOBALS', $globals );
			//wp_localize_script( $script_name, 'codeneric_uam_ad_meta', $meta );
			wp_enqueue_script( $script_name);

		}
	}

    public function enqueue_async_overview_script($script_name, $path, $version) {
        $current = get_current_screen();
        global $cc_uam_config;

        if ( $current->base === 'edit' && $current->post_type === $cc_uam_config['custom_post_slug'] ) {

            wp_register_script( $script_name, $path, array( ),$version, true );
            //wp_localize_script( $script_name, 'codeneric_uam_ad_meta', $meta );
            wp_enqueue_script( $script_name);

        }
    }


	public function enqueue_premium_page_script($script_name, $path, $version) {
		$current = get_current_screen();
		global $cc_uam_config;

		if ( $current->base == $cc_uam_config['custom_post_slug'] . '_page_uam-premium' ) {
			wp_register_script( $script_name, $path, array( 'jquery' ),$version, true );

			$globals =  $this->generate_js_globals();

			$globals['settings'] = $this->settings_mgr->general_settings;

			$globals['has_premium_ext'] = $cc_uam_config['has_premium_ext'];

			$adminurl = admin_url( 'edit.php' );
			$globals['support_url'] = add_query_arg( array('post_type' => $cc_uam_config['custom_post_slug'], 'page' => 'codeneric_uam_support'), $adminurl);


			wp_localize_script( $script_name, 'UAM_GLOBALS', $globals );
			//wp_localize_script( $script_name, 'codeneric_uam_ad_meta', $meta );
			wp_enqueue_script( $script_name);

		}
	}

	public function register_statistics_script($script_name, $path, $version) {
		$current = get_current_screen();
		global $cc_uam_config;

		if ( $current->base == $cc_uam_config['custom_post_slug'] . '_page_statistics' ) {
			//--- symlink
//			if ( ! is_link( $cc_uam_config['plugin_adblock_symlink_path'] ) ) {
//
//				//symlink("/var/www/wordpress/wp-content/plugins/ultimate-ads-manager", $upload_dir['baseurl'].'/no-ads-here');
//
//				symlink( $cc_uam_config['plugin_root_path'], $cc_uam_config['plugin_adblock_symlink_path'] );
//			}
            do_action('codeneric_uam_update_symlink');
			//----------
			wp_register_script( $script_name, $path, array(),$version, true );


			$globals =  $this->generate_js_globals();


			// -- AD POSTS
			$args        = array(
				'orderby'     => 'date',
				'order'       => 'DESC',
				'post_type'   => $cc_uam_config['custom_post_slug'],
				'post_status' => 'publish',
				'numberposts' => -1
				//'suppress_filters' => true
			);

			$posts_array = get_posts( $args );
			$globals['ad_posts'] = $posts_array;

			//----------

			$globals['ad_link'] = add_query_arg( array('post_type' => $cc_uam_config['custom_post_slug']), admin_url('post-new.php') );

			wp_localize_script( $script_name, 'UAM_GLOBALS', $globals );

			//----------

			$this->settings_mgr->load_settings();

			//----------

			//$timezone = isset($this->settings_mgr->general_settings['block_timezone']) ?
			//	$this->settings_mgr->general_settings['block_timezone'] : 'America/Los_Angeles';
			//wp_localize_script( $this->plugin_name.'_statistics', 'codeneric_ad_timezone', $timezone);


			// give initial data
			$uam_statistics_initalquery = '{"type":"click","metric":"unique","history":"last_hour"}';

			if ( isset( $_COOKIE['uam_statistics_initalquery'] ) ) {
				$uam_statistics_initalquery = $_COOKIE['uam_statistics_initalquery'];
				$uam_statistics_initalquery = str_replace( '\\', '', $uam_statistics_initalquery );
			}


			$query = json_decode( $uam_statistics_initalquery, true );
			//print_r($query);
			if ( ! isset( $query['ad_id'] ) ) {
				$args = array(
					'numberposts'      => 1,
					'orderby'          => 'post_date',
					'order'            => 'DESC',
					'post_type'        => $cc_uam_config['custom_post_slug'],
					'post_status'      => 'publish',
					'suppress_filters' => true
				);

				$recent_posts   = wp_get_recent_posts( $args, ARRAY_A );
				$query['ad_id'] = count( $recent_posts ) > 0 ? $recent_posts[0]['ID'] : - 1;

			}

			$gen_set   = get_option( $cc_uam_config['custom_post_slug'] . '_general_settings', array() );
			$client_tz = ! empty( $gen_set['block_timezone'] ) ? $gen_set['block_timezone'] : 'UTC';

			$tz = date_default_timezone_get();
			date_default_timezone_set( $client_tz );
			$query['from'] = time();
			date_default_timezone_set( $tz );

			$init_data = $this->handle_statistics_query( $query );


			wp_localize_script( $script_name, 'uam_statistics_initaldata', $init_data );
			wp_localize_script( $script_name, 'uam_statistics_initalquery', $query );


			$fakeData                  = json_decode( "{\"all_time\":{\"unique\":{\"click\":[{\"from\":0,\"to\":1432840415,\"data\":\"8\"}],\"view\":[{\"from\":0,\"to\":1432840415,\"data\":\"2\"}]},\"total\":{\"click\":[{\"from\":0,\"to\":1432840415,\"data\":\"19\"}],\"view\":[{\"from\":0,\"to\":1432840415,\"data\":\"9\"}]}}}" );
			$query_all_time            = $query;
			$query_all_time['history'] = 'all_time';
			$query_all_time['type']    = array( 'click', 'view' );
			$query_all_time['metric']  = array( 'total', 'unique' );

			$all_time_data = $this->handle_statistics_query( $query_all_time );
			//$all_time_data = $fakeData;
			$all_time_data = json_decode( $all_time_data );


			wp_localize_script( $script_name, 'uam_statistics_initaloverview', $all_time_data );


			return $query['ad_id'];

		}
	}

	public function enqueue_scripts() {

		$current = get_current_screen();
		global $cc_uam_config;
//		if(! is_link($cc_uam_config['plugin_adblock_symlink_path']))
//			symlink($cc_uam_config['plugin_root_path'], $cc_uam_config['plugin_adblock_symlink_path']);
        do_action('codeneric_uam_update_symlink');

		$this->register_statistics_script($this->plugin_name.'_statistics', $cc_uam_config['js_entry_statistics'],$this->version);


		wp_enqueue_script($this->plugin_name.'_statistics'); // exported so we can add more stuff in prem

		 $this->enqueue_ad_script($this->plugin_name,$cc_uam_config['js_entry_edit'], $this->version );

		 $this->enqueue_ad_group_script($this->plugin_name.'_group',$cc_uam_config['js_entry_group_edit'], $this->version );


		$this->enqueue_settings_script($this->plugin_name.'_settings', $cc_uam_config['js_entry_settings'],$this->version);

		$this->enqueue_premium_page_script($this->plugin_name.'_premium-page', $cc_uam_config['js_entry_premium'],$this->version);
        $this->enqueue_async_overview_script($this->plugin_name.'_async-overview', $cc_uam_config['js_entry_fetch_async_overview'],$this->version);



	}


//	public function define_table_columns($column_name, $id) {
	public function define_table_columns( $column_name ) {
		//die($column_name);
		$cols = array(
			'cb'            => '<input type="checkbox" />',
			'title'         => __( 'Title' ),
			'shortcode'     => __( 'Shortcode' ),
			'date'          => __( 'Date' ),
			'total_views'   => __( 'Total Views' ),
			'unique_views'  => __( 'Unique Views' ),
			'total_clicks'  => __( 'Total Clicks' ),
			'unique_clicks' => __( 'Unique Clicks' ),
		);

		return $cols;
	}

    public function define_places_table_columns( $column_name ) {
        //die($column_name);
        $cols = array(
            'cb'            => '<input type="checkbox" />',
            'title'         => __( 'Title' ),
            'shortcode'     => __( 'Shortcode' ),
            'date'          => __( 'Date' ),
        );

        return $cols;
    }
    public function fill_places_custom_columns( $column, $post_id ) {
        if ( ! isset( $post_id ) ) {
            return;
        }

        switch ( $column ) {
            case "shortcode":
                echo '[uam_place id="' . $post_id . '"]';
                break;
        }
    }

	public function fill_custom_columns( $column, $post_id ) {
		if ( ! isset( $post_id ) ) {
			return;
		}
		require_once dirname( __FILE__ ) . "/../includes/class-ultimate-ads-manager-statistics-calculator.php";
		$stat_calc = new Statistics_Calculator();
		//$add = get_post_meta($post_id,"codeneric_ad",true);

		switch ( $column ) {
			case "shortcode":
				echo '[uam_ad id="' . $post_id . '"]';
				break;
			case "total_views":
//				echo $stat_calc->get_total_events( $post_id, 'view' );
                echo "<div data-codeneric-uam-type='view' data-codeneric-uam-metric='total' data-codeneric-uam-history='all_time' data-codeneric-uam-id='$post_id' class='codeneric-uam-async-request'>...</div>";
				break;
			case "unique_views":
//				echo $stat_calc->get_unique_events( $post_id, 'view' );
                echo "<div data-codeneric-uam-type='view' data-codeneric-uam-metric='unique' data-codeneric-uam-history='all_time' data-codeneric-uam-id='$post_id' class='codeneric-uam-async-request'>...</div>";
                break;
			case "total_clicks":
//				echo $stat_calc->get_total_events( $post_id, 'click' );
                echo "<div data-codeneric-uam-type='click' data-codeneric-uam-metric='total' data-codeneric-uam-history='all_time' data-codeneric-uam-id='$post_id' class='codeneric-uam-async-request'>...</div>";
                break;
			case "unique_clicks":
//				echo $stat_calc->get_unique_events( $post_id, 'click' );
                echo "<div data-codeneric-uam-type='click' data-codeneric-uam-metric='unique' data-codeneric-uam-history='all_time' data-codeneric-uam-id='$post_id' class='codeneric-uam-async-request'>...</div>";
                break;
		}
	}

	public function define_table_columns_group( $column_name ) {
		//die($column_name);
		$cols = array(
			'cb'        => '<input type="checkbox" />',
			'title'     => __( 'Title' ),
			'shortcode' => __( 'Shortcode' ),
			'date'      => __( 'Date' )
		);

		return $cols;
	}

	public function fill_custom_columns_group( $column, $post_id ) {
		if ( ! isset( $post_id ) ) {
			return;
		}


		switch ( $column ) {
			case "shortcode":
				echo '[uam_ad id="' . $post_id . '"]';
				break;
		}
	}

	public function register_post_type_codeneric_ad() {
		global $cc_uam_config;
		register_post_type( $cc_uam_config['custom_post_slug'],
			array(
				'labels'              => array(
					'menu_name'     => $cc_uam_config['plugin_display_name'],
					'all_items'     => __( 'Adverts' ),
					'name'          => __( 'Adverts' ),
					'singular_name' => __( 'Advert' ),
					'edit_item'     => __( 'Edit Advert' ),
					'new_item'      => __( 'New Advert' ),
					'add_new_item'  => __( 'Add New Advert' )
				),
				'public'              => true,
				'publicly_queryable'  => false,
				'show_ui'             => true,
				'query_var'           => true,
				'can_export'          => true,
				'exclude_from_search' => true,
				'has_archive'         => false,
				'menu_icon'           => 'dashicons-welcome-view-site',
				'rewrite'             => array( 'slug' => $cc_uam_config['custom_post_slug'], 'with_front' => false ),
				'supports'            => array(
					'title',
					'editor' => false
				),
				'taxonomies'          => array( 'category' ),
			)
		);
		register_post_type( $cc_uam_config['custom_post_slug'] . '_group',
			array(
				'labels'             => array(
					'name'          => __( 'Groups' ),
					'singular_name' => __( 'Group' ),
					'edit_item'     => __( 'Edit  Group' ),
					'new_item'      => __( 'New Group' ),
					'add_new_item'  => __( 'Add New Group' )
				),
				'public'             => true,
				'publicly_queryable' => true,
				'show_ui'            => true,
				'query_var'          => true,
				'can_export'         => true,
				'has_archive'        => false,
				'show_in_menu'       => 'edit.php?post_type=codeneric_ad',
				'rewrite'            => array( 'slug'       => $cc_uam_config['custom_post_slug'] . '_group',
				                               'with_front' => false
				),
				'supports'           => array(
					'title',
					'editor' => false
				),
				'taxonomies'         => array( 'category' )

			)
		);
        register_post_type( $cc_uam_config['custom_post_slug'] . '_place',
            array(
                'labels'             => array(
                    'name'          => __( 'Places' ),
                    'singular_name' => __( ' Place' ),
                    'edit_item'     => __( 'Edit  Place' ),
                    'new_item'      => __( 'New Place' ),
                    'add_new_item'  => __( 'Add New Place' )
                ),
                'public'             => true,
                'publicly_queryable' => true,
                'show_ui'            => true,
                'query_var'          => true,
                'can_export'         => true,
                'has_archive'        => false,
                'show_in_menu'       => 'edit.php?post_type='.$cc_uam_config['custom_post_slug'],
                'rewrite'            => array( 'slug'       => $cc_uam_config['place_slug'],
                    'with_front' => false
                ),
                'supports'           => array(
                    'title',
                    'editor' => false
                ),
                'taxonomies'          => array( 'category' )
//                'taxonomies'         => array( '' )

            )
        );
	}

	public function hide_add_new() {
        global $submenu, $cc_uam_config;
        unset($submenu['edit.php?post_type='.$cc_uam_config['custom_post_slug']][10]);
//        remove_submenu_page('edit.php', 'edit-tags.php?taxonomy=category&post_type='.$cc_uam_config['custom_post_slug']);
//        remove_submenu_page('edit.php', 'edit-tags.php?taxonomy=category&post_type=codeneric_ad');
        $post_type = $cc_uam_config['custom_post_slug'];
        $tax_slug = 'manage_categories';
        if (isset($submenu['edit.php?post_type='.$post_type])) {
            foreach ($submenu['edit.php?post_type=' . $post_type] as $k => $sub) {
                if ($sub[1] === $tax_slug) {
                    unset($submenu['edit.php?post_type=' . $post_type][$k]);
                }

            }
        }
	}

	public function add_meta_boxes() {
		global $cc_uam_config;
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/ultimate-ads-manager-admin-meta.php';
		add_meta_box( $this->plugin_name . '_meta', 'Ad', 'codeneric_ad_manager_meta', $cc_uam_config['custom_post_slug'], 'normal', 'high' );


		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/ultimate-ads-manager-admin-meta-group.php';
		add_meta_box( $this->plugin_name . '_meta_group', 'Group', 'codeneric_ad_manager_meta_group', $cc_uam_config['custom_post_slug'] . '_group', 'normal', 'high' );

        require_once  dirname(dirname( __FILE__ ) ) . '/admin/partials/place.php';
        add_meta_box( $this->plugin_name . '_place', 'Place', 'codeneric_ad_manager_place', $cc_uam_config['place_slug'], 'normal', 'high' );

    }

	public function save_meta_boxes( $post_id ) {
		/*
		 * We need to verify this came from the our screen and with proper authorization,
		 * because save_post can be triggered at other times.
		 */
		global $cc_uam_config;

        require_once dirname(__FILE__).'/../includes/place.php';

		// Check if our nonce is set.
		if ( ! isset( $_POST[ $cc_uam_config['wp_nonce_base'] . '_nonce' ] ) ) {
			return $post_id;
		}

		$nonce = $_POST[ $cc_uam_config['wp_nonce_base'] . '_nonce' ];

		// Verify that the nonce is valid.
		if ( ! wp_verify_nonce( $nonce, $cc_uam_config['wp_nonce_base'] ) ) {
			return $post_id;
		}


		// If this is an autosave, our form has not been submitted,
		//     so we don't want to do anything.
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return $post_id;
		}

		// Check the user's permissions.
		if ( $cc_uam_config['custom_post_slug'] == $_POST['post_type'] || $cc_uam_config['custom_post_slug'] . '_group' == $_POST['post_type'] ) {

			if ( ! current_user_can( 'edit_page', $post_id ) ) {
				return $post_id;
			}

		} else {

			if ( ! current_user_can( 'edit_post', $post_id ) ) {
				return $post_id;
			}
		}

		if ( $cc_uam_config['custom_post_slug'] == $_POST['post_type'] ) {
            require_once dirname(__FILE__).'/../includes/util.php';

			// Sanitize the user input.
            if(isset($_POST['ad'] ) && isset($_POST['ad']['type'])){
                if($_POST['ad']['type'] === 'image_ad'){
                    $image_id = $_POST['ad']['image_ad_id'];
                    $src = wp_get_attachment_image_src( $image_id, 'full', false );
                    $width = $src[1];
                    $height = $src[2];
                    $form = Ultimate_Ads_Manager_Util::nearest_form($width,$height);
                    $_POST['ad']['forms'] = array($form);
                }else{
                    $width = 1; //TODO: let them select forms in frontend. For now we do not have any preference
                    $height = 1;
                    $form = Ultimate_Ads_Manager_Util::nearest_form($width,$height);
                    $_POST['ad']['forms'] = array($form);
                }
            }


			//$mydata = sanitize_text_field( $_POST['ad']['referral_url'] );

			//die(var_dump($_POST['ad']));

            if(isset($_POST['restrictions'])){
                if(!empty($_POST['restrictions']['start'])){
                    $_POST['restrictions']['start'] = strtotime($_POST['restrictions']['start']);
                }

                if(!empty($_POST['restrictions']['end'])){
                    $_POST['restrictions']['end'] = strtotime($_POST['restrictions']['end']);
                }
                update_post_meta( $post_id, 'restrictions', $_POST['restrictions'] );
            }

            do_action('codeneric/uam/pre_save_ad', $_POST['ad'] );
			update_post_meta( $post_id, 'ad', $_POST['ad'] );
            do_action('codeneric/uam/after_save_ad', $post_id, $_POST['ad'] );


		}

		if ( $cc_uam_config['group_slug']  == $_POST['post_type'] ) {
			if ( ! isset( $_POST['ad_group'] ) ) {
				$_POST['ad_group'] = array();
			}
			//$_POST['ad_group']['ids'] = isset($_POST['ad_group']['ids']) ? explode(',',$_POST['ad_group']['ids']) : array();
			//print_r($_POST['ad_group']); //TODO: fix this issue (#4)
			//die();


			// just save the id dude
//			$ad_group = json_decode(urldecode($_POST['ad_group']));
//
//			// get rid of label
//			foreach ($ad_group as $ad) {
//				unset($ad->label);
//			}

            if(isset($_POST['restrictions'])){
                update_post_meta( $post_id, 'restrictions', $_POST['restrictions'] );
            }

            do_action('codeneric/uam/pre_save_group', $_POST['ad_group'] );
            update_post_meta( $post_id, 'ad_group', $_POST['ad_group'] );
            do_action('codeneric/uam/after_save_group', $post_id);

		}

		return $post_id;
	}


    public function save_place( $post_id ) {
        /*
         * We need to verify this came from the our screen and with proper authorization,
         * because save_post can be triggered at other times.
         */
        global $cc_uam_config;

        // Check if our nonce is set.
        if ( ! isset( $_POST[ $cc_uam_config['wp_nonce_base'] . '_nonce' ] ) ) {
            return $post_id;
        }

        $nonce = $_POST[ $cc_uam_config['wp_nonce_base'] . '_nonce' ];

        // Verify that the nonce is valid.
        if ( ! wp_verify_nonce( $nonce, $cc_uam_config['wp_nonce_base'] ) ) {
            return $post_id;
        }


        // If this is an autosave, our form has not been submitted,
        //     so we don't want to do anything.
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return $post_id;
        }

        // Check the user's permissions.
        if ( $cc_uam_config['place_slug'] == $_POST['post_type']  ) {

            if ( ! current_user_can( 'edit_page', $post_id ) ) {
                return $post_id;
            }

        } else {

            if ( ! current_user_can( 'edit_post', $post_id ) ) {
                return $post_id;
            }
        }

        if ( $cc_uam_config['place_slug'] == $_POST['post_type'] ) {
            // Sanitize the user input.

            if(isset($_POST['forms']) && is_array($_POST['forms'])){
                $forms = array_keys($_POST['forms']);
                update_post_meta( $post_id, 'forms', $forms );
                $meta = get_post_meta( $post_id, 'forms', true );
            }

            require_once dirname(__FILE__).'/../includes/place.php';
            Ultimate_Ads_Manager_Place::update_place($post_id);

        }

        return $post_id;
    }


	public function add_submenu_pages() {
		global $cc_uam_config;
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/ultimate-ads-manager-admin-statistics.php';
		add_submenu_page( 'edit.php?post_type=' . $cc_uam_config['custom_post_slug'], $this->display_name . ' ' . __( 'Statistics' ), __( 'Statistics' ), 'manage_options', 'statistics', 'ultimate_ads_manager_statistics_page' );

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/ultimate-ads-manager-admin-settings.php';
		add_submenu_page( 'edit.php?post_type=' . $cc_uam_config['custom_post_slug'], $this->display_name . ' ' . __( 'Settings' ), __( 'Settings' ), 'manage_options', 'settings', 'codeneric_ad_manager_settings_page' );

//		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/ultimate-ads-manager-admin-help.php';
//		add_submenu_page( 'edit.php?post_type=' . $cc_uam_config['custom_post_slug'], $this->display_name . ' ' . __( 'Help' ), __( 'Help' ), 'manage_options', 'help', 'codeneric_ad_manager_help_page' );

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/ultimate-ads-manager-admin-support.php';
		add_submenu_page( 'edit.php?post_type=' . $cc_uam_config['custom_post_slug'], $this->display_name . ' ' . __( 'Support' ), __( 'Support' ), 'manage_options', 'codeneric_uam_support', 'codeneric_ad_manager_support_page' );


		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/ultimate-ads-manager-admin-premium.php';
		add_submenu_page( 'edit.php?post_type=' . $cc_uam_config['custom_post_slug'], $this->display_name . ' ' . __( 'Premium' ), __( 'Premium' ), 'manage_options', 'uam-premium', 'codeneric_ad_manager_premium_page' );

//		require_once dirname( __FILE__ )  . '/../admin/partials/premium.php';
//		$prem_page = new Ultimate_Ads_Manager_Base_Premium();
//		$prem_page->add_premium_page();

	}

	public function send_support_feedback() {
		global $cc_uam_config;
		if ( empty( $_POST ) ||
		     ( ! isset( $_POST['cc_send_feedback_nonce'] ) ) ||
		     ( ! wp_verify_nonce( $_POST['cc_send_feedback_nonce'], 'cc_send_feedback' )
		     )
		) {
			echo 'You targeted the right function, but sorry, your nonce did not verify.';
			die();
		} else {


			$data      = $_POST['support'];
			$to        = array( 'support@codeneric.com' );
			$subject   = 'UAM: '.$data['subject'];
			$headers[] = 'From: <' . $data['email'] . '>';

			$message = $data['content'];
			if ( isset( $_POST['cc_send_feedback_nonce'] ) ) {
				if ( wp_mail( $to, $subject, $message, $headers ) ) {
					wp_redirect( admin_url() . 'edit.php?post_type='.$cc_uam_config['custom_post_slug'].'&page=codeneric_uam_support&is_send=true' );
				} else {
					wp_redirect( admin_url() . 'edit.php?post_type='.$cc_uam_config['custom_post_slug'].'&page=codeneric_uam_support&is_send=false' );
				}
			}
		}
	}

	public function handle_statistics_query( $q ) {

		$query = isset( $_POST['query'] ) ? $_POST['query'] : $q;
		//print_r($query);exit;
		if ( ! isset( $query ) ||
            ! isset( $query['type'] ) ||
            (!isset( $query['ad_id'] ) && !isset( $query['place_id'] )) ||
            ! isset( $query['history'] )
		) {
			status_header( 400 );
			exit;
		}


		if ( ! isset( $query['from'] ) ) {
			$query['from'] = time();
		}
		$query['from'] = intval($query['from']);
		//$ad_slide_id = isset($query['ad_slide_id']) ? $query['ad_slide_id'] : null;
		//$metric = isset($query['metric']) ? $query['metric'] : null;
		$query['ad_slide_id'] = isset( $query['ad_slide_id'] ) ? $query['ad_slide_id'] : null;
		$query['ad_id'] = isset( $query['ad_id'] ) ? $query['ad_id'] : null;
		$query['place_id'] = isset( $query['place_id'] ) ? $query['place_id'] : null;
		$query['metric']      = isset( $query['metric'] ) ? $query['metric'] : array();
		$query['metric']      = is_array( $query['metric'] ) ? $query['metric'] : array( $query['metric'] );
		if ( isset( $query['metric'] ) && ! is_array( $query['metric'] ) ) {
			$query['metric'] = array( $query['metric'] );
		}
		if ( ! isset( $query['metric'] ) ) {
			$query['metric'] = array();
		}

		if ( ! is_array( $query['type'] ) ) {
			$query['type'] = array( $query['type'] );
		}


		$hist = $query['history'];
		$res  = array( $hist => array() );
		//$res['metric'] = array();
		//$res['metric'];

		foreach ( $query['metric'] as $metric ) {
			$res[ $hist ][ $metric ] = array();
			foreach ( $query['type'] as $type ) {
				$temp_query           = $query;
				$temp_query['type']   = $type;
				$temp_query['metric'] = $metric;

				$res[ $hist ][ $metric ][ $type ] = array();

				if($type === 'ctr')
					$res[$hist][$metric][$type] = apply_filters('codeneric/uam/statistics/query/ctr', $temp_query);
				elseif ( $temp_query['history'] === 'last_24_hours' ) {
					$res[ $hist ][ $metric ][ $type ] = $this->stats_calc->get_last_24_hours( $temp_query );
				} elseif ( $temp_query['history'] === 'last_7_days' ) {
					$res[ $hist ][ $metric ][ $type ] = $this->stats_calc->get_last_7_days( $temp_query );
				} elseif ( $temp_query['history'] === 'last_hour' ) {
					$res[ $hist ][ $metric ][ $type ] = $this->stats_calc->get_last_hour( $temp_query );
				} elseif ( $temp_query['history'] === 'last_12_months' ) {
					$res[ $hist ][ $metric ][ $type ] = $this->stats_calc->get_last_12_months( $temp_query );
				} elseif ( $temp_query['history'] === 'all_time' ) {
					$res[ $hist ][ $metric ][ $type ] = $this->stats_calc->get_all_time( $temp_query );
				}
				elseif($temp_query['history'] === 'last_hour'){
					$res[$hist][$metric][$type] = $this->stats_calc->get_last_hour($temp_query);
				}elseif($temp_query['history'] === 'last_12_months'){
					$res[$hist][$metric][$type] = $this->stats_calc->get_last_12_months($temp_query);
				}elseif($temp_query['history'] === 'all_time'){
					$res[$hist][$metric][$type] = $this->stats_calc->get_all_time($temp_query);
				}elseif($temp_query['history'] === 'real_time'){
					$res[$hist][$metric][$type] = apply_filters('codeneric_uam_prem_get_real_time', $temp_query);
				}
			}
		}


		if ( isset( $_POST['query'] ) ) {
			header( "Content-Type: application/json" );
			$json = json_encode( $res );
			exit( json_encode( $json ) );
		} else {
			$json = json_encode( $res );

			return $json;
		}


	}

	public function proxy_get() {
		$url = $_POST['url'];
		$res = wp_remote_get( $url );
		if ( empty( $res ) ) {
			status_header( 500 );
			exit;
		}
		status_header( $res['response']['code'] );
		exit( $res['body'] );
	}


	public function register_shortcodes() {
		require_once dirname( __FILE__ ). '/../includes/shortcode.php';

		Ultimate_Ads_Manager_Base_Shortcode::init();


//		if(!function_exists('uam_ad')) {
//			function uam_ad($atts)
//			{
//
//				$a = shortcode_atts(array(
//					'id' => -1
//				), $atts);
//
//				ob_start();
//
//				require_once(dirname(__FILE__) . '/../includes/Ultimate_Ads_Manager_Base_Randomizer.php');
//				$res = Ultimate_Ads_Manager_Base_Randomizer::process_public($a['id']);
//
//				$ad_id = $res[0];
//				$meta = $res[1];
//
//				include(plugin_dir_path(dirname(__FILE__)) . 'public/partials/public-template.php');
//
//				$buffer = ob_get_contents();
//
//				// End buffering
//				ob_end_clean();
//
//				return $buffer;
//			}
//
//			add_shortcode( 'uam_ad', 'uam_ad' );
//		}else {
//
//			add_shortcode('uam_ad', 'uam_ad');
//		}
	}

	public function listen_on_call(){
		$result = $_POST['bool'] == 'true';
		delete_option('__temp_site_transiant_5448uam4886');
		update_option('codeneric_uam_prem', $result);
	}

	public function update_symlink(){
        global $cc_uam_config;
        $has_premium_ext = $cc_uam_config['has_premium_ext'];

        if(!is_link($cc_uam_config['plugin_adblock_symlink_path'])
        && file_exists($cc_uam_config['plugin_adblock_symlink_path'])){
            unlink($cc_uam_config['plugin_adblock_symlink_path']);
        }

        if(is_link($cc_uam_config['plugin_adblock_symlink_path']) ){
            if(readlink($cc_uam_config['plugin_adblock_symlink_path']) !== $cc_uam_config['plugin_root_path']){
                unlink($cc_uam_config['plugin_adblock_symlink_path']);
                symlink($cc_uam_config['plugin_root_path'], $cc_uam_config['plugin_adblock_symlink_path']);
            }
        }

        if(!is_link($cc_uam_config['plugin_adblock_symlink_path'])
            && !file_exists($cc_uam_config['plugin_adblock_symlink_path'])){
            symlink($cc_uam_config['plugin_root_path'], $cc_uam_config['plugin_adblock_symlink_path']);
        }

        if($has_premium_ext){
            if(!is_link($cc_uam_config['premium_plugin_adblock_symlink_path'])
                && file_exists($cc_uam_config['premium_plugin_adblock_symlink_path'])){
                unlink($cc_uam_config['premium_plugin_adblock_symlink_path']);
            }

            if(is_link($cc_uam_config['premium_plugin_adblock_symlink_path']) ){
                if(readlink($cc_uam_config['plugin_adblock_symlink_path']) !== $cc_uam_config['premium_plugin_root_path']){
                    unlink($cc_uam_config['premium_plugin_adblock_symlink_path']);
                    symlink($cc_uam_config['premium_plugin_root_path'], $cc_uam_config['premium_plugin_adblock_symlink_path']);
                }
            }

            if(!is_link($cc_uam_config['premium_plugin_adblock_symlink_path'])
                && !file_exists($cc_uam_config['premium_plugin_adblock_symlink_path'])){
                symlink($cc_uam_config['premium_plugin_root_path'], $cc_uam_config['premium_plugin_adblock_symlink_path']);
            }
        }
    }

    public function update_places_after_advert($ad_id, $ad){
        require_once dirname(__FILE__).'/../includes/place.php';
        Ultimate_Ads_Manager_Place::after_save_ad($ad_id, $ad);
    }

    public function update_places_after_group($ad_id){
        require_once dirname(__FILE__).'/../includes/place.php';
        Ultimate_Ads_Manager_Place::after_save_group($ad_id);
    }

    public function update_places_on_deletion($id){
        require_once dirname(__FILE__).'/../includes/place.php';
        Ultimate_Ads_Manager_Place::after_candidate_deleted($id);
    }

    public function update_groups_on_deletion($id){
        require_once dirname(__FILE__).'/../includes/group.php';
        Ultimate_Ads_Manager_Place::after_save_group($id);
    }

    public function register_callback($args){
        require_once dirname(__FILE__).'/../includes/common.php';
        $in = isset($args['in']) ?  $args['in'] : 0;
        $singleton = isset($args['singleton']) ?  $args['singleton'] : false;
        Ultimate_Ads_Manager_Base_Common::register_callback($args['url'], $in, $singleton);
    }

}



