<?php

/**
 * Configuration
 *
 * @link       http://codeneric.com
 * @since      1.0.0
 *
 * @package    Ultimate_Ads_Manager
 * @subpackage Ultimate_Ads_Manager/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Ultimate_Ads_Manager
 * @subpackage Ultimate_Ads_Manager/includes
 * @author     Codeneric <contact@codeneric.com>
 */
class Ultimate_Ads_Manager_Base_Config {

    /**
     * Short Description. (use period)
     *
     * Long Description.
     *
     * @since    1.0.0
     */

   // public static $plugin_name;
//    public static $plugin_display_name = 'Ultimate Ads Manager';
//    public static $custom_post_slug = 'codeneric_ad';
//    public static $wp_nonce_base = 'ultimate_ads_manager_meta';
//    public static $plugin_root_path;
//    public static $plugin_version;
//    public static $table_name_events;
//    public static $db_map;
//    public static $fake_prevention;
//    public static $plugin_adblock_url;
//    public static $plugin_adblock_symlink_name;
//    public static $plugin_adblock_symlink_path;
//    public static $wpps_url;







    public static function set($env) {
        require_once( ABSPATH . 'wp-admin/includes/plugin.php' );

        require_once( ABSPATH . 'wp-includes/wp-db.php' );

        global $wpdb;
        $uploads_info = wp_upload_dir();
        $text_domain = 'ultimate-ads-manager';

        $env = $env !== 'production' ? 'development' : 'production';




        $plugin_data = get_plugin_data( plugin_dir_path(__FILE__).'ultimate-ads-manager.php',false, false );



        $plugin_adblock_symlink_name = 'uam-pipe';
        $plugin_adblock_symlink_path = $uploads_info['basedir'].'/'.$plugin_adblock_symlink_name;
        $plugin_adblock_url = $uploads_info['baseurl'].'/'.$plugin_adblock_symlink_name;

        $premium_plugin_adblock_symlink_name = 'uam-pipe-premium';
        $premium_plugin_adblock_symlink_path = $uploads_info['basedir'].'/'.$premium_plugin_adblock_symlink_name;
        $premium_plugin_adblock_url = $uploads_info['baseurl'].'/'.$premium_plugin_adblock_symlink_name;




        $fake_prevention = array(
            'max_users_behind_router' => 5,
            'click' => 1
        );




        if ( ! function_exists( 'get_plugins' ) ) {
            require_once ABSPATH . 'wp-admin/includes/plugin.php';
        }
        $all_plugins = get_plugins();
        $plugin_data = get_plugin_data(dirname(__FILE__) .'/ultimate-ads-manager.php');
        $premium_plugin_data = null;

        //------ get premium version number
        // todo awkward procedure to get prem version
        $premium_version = '0.0.0';

        if( file_exists( dirname( dirname( __FILE__ ) ). '/ultimate-ads-manager-premium/ultimate-ads-manager-premium.php' ) ) {
            $premium_plugin_data = get_plugin_data(dirname( dirname( __FILE__ ) ). '/ultimate-ads-manager-premium/ultimate-ads-manager-premium.php');
            $premium_version = $premium_plugin_data['Version'];
        }
        //------


        $phmm_premium_key = 'ultimate-ads-manager-premium/ultimate-ads-manager-premium.php';
        $has_premium_ext = isset($all_plugins[$phmm_premium_key]);
        $a_p = get_option('active_plugins');
        $the_plugs = get_site_option('active_sitewide_plugins'); //multisite;
        $premium_ext_active = in_array($phmm_premium_key, $a_p) || isset($the_plugs[$phmm_premium_key]);

        $db_map = array(
            'view' => 0,
            'click' => 1,
            'unique' => 0,
            'total' => 1
        );
        $changelog_url = add_query_arg( array("tab"=>"plugin-information", "plugin"=>"ultimate-ads-manager","section"=>"changelog"), admin_url('plugin-install.php'));


        $mapTypeToJavascript = array('google_adsense', 'custom_code', 'dcm');

        $forms = array(
            'header' => array(1, 0.1),
            'tower' => array(0.1, 1),
            'square' => array(1, 1)
        );

        $events_table_structure = "id   bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
		  time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
		  type tinyint NOT NULL,
		  uuid bigint(20) UNSIGNED NOT NULL,
		  ip   tinytext DEFAULT '' NOT NULL,
		  ad_id   bigint(20) UNSIGNED NOT NULL,
		  ad_slide_id   tinyint UNSIGNED NOT NULL,
		  place_id   bigint(20) UNSIGNED NOT NULL,
		  value   int UNSIGNED DEFAULT 1 NOT NULL,
		  UNIQUE KEY id (id)";

        $db_charset = $wpdb->get_charset_collate();

        $forgettable_properties = array('uuid', 'ip', 'place_id');

        $config = array(
            "development" => array(
                "env" => "development",
                "text_domain" => $text_domain,
                "plugin_display_name" => 'Ultimate Ads Manager',
                "wpps_url" => 'http://headgame.draco.uberspace.de/sandbox.wpps',
                "checkout_url" => 'https://checkout.codeneric.com',
                "custom_post_slug" => "codeneric_ad",
                "group_slug" => "codeneric_ad_group",
                "place_slug" => "codeneric_ad_place",
                "plugin_name" => "ultimate-ads-manager",
                "premium_plugin_name" => "ultimate-ads-manager-premium",
                "premium_main_file" => "ultimate-ads-manager-premium.php",
                "plugin_slug_abbr" => "uam",
                "premium_changelog" => $changelog_url,
                'wp_nonce_base' => 'ultimate_ads_manager_meta',
                "version" => $plugin_data['Version'],
                "premium_version" => $premium_version,
                "has_premium_ext" => $has_premium_ext,
                "premium_ext_active" => $premium_ext_active,
                "premium_plugin_key" => $phmm_premium_key,
                "update_check_cool_down" => 5,
                "general_settings_key" => 'codeneric_ad_general_settings',

                "plugin_root_path" => plugin_dir_path(__FILE__),
                "premium_plugin_root_path" => dirname(dirname(__FILE__)).'/ultimate-ads-manager-premium',
                "table_name_events" => $wpdb->prefix . "codeneric_uam_events",
                "table_name_events_summary" => $wpdb->prefix . "codeneric_uam_events_summary",
                "db_map" => $db_map,
                "fake_prevention" => $fake_prevention,

                "plugin_adblock_symlink_name" => $plugin_adblock_symlink_name,
                "plugin_adblock_symlink_path" => $plugin_adblock_symlink_path,
                "plugin_adblock_url" => $plugin_adblock_url,

                "premium_plugin_adblock_symlink_name" => $premium_plugin_adblock_symlink_name,
                "premium_plugin_adblock_symlink_path" => $premium_plugin_adblock_symlink_path,
                "premium_plugin_adblock_url" => $premium_plugin_adblock_url,

                "js_entry_statistics" =>  'http://localhost:3000/entry.statistics.js',
                "js_entry_edit" =>  'http://localhost:3000/entry.edit.js',
                "js_entry_group_edit" =>  'http://localhost:3000/entry.edit-group.js',
                "js_entry_settings" =>  'http://localhost:3000/entry.settings.js',
                "js_entry_premium" =>  'http://localhost:3000/entry.premium-page.js',
                "js_entry_public" =>  'http://localhost:3000/entry.public.js',
                "js_entry_fetch_async_overview" =>  'http://localhost:3000/entry.fetch-async-overview.js',
              

                "js_prem_entry_statistics" =>  'http://localhost:3001/entry.statistics.js',
                "js_prem_entry_edit" =>  'http://localhost:3001/entry.edit.js',
                "js_prem_entry_group_edit" =>  'http://localhost:3001/entry.edit-group.js',
                "js_prem_entry_settings" =>  'http://localhost:3001/entry.settings.js',
                "js_prem_entry_public" =>  'http://localhost:3001/entry.public.js',

                "stripe_key" => "pk_test_uyLxBWH0UDBwlaXCzdmAzsjv",

                "paypal_merchant" => "elance-facilitator@codeneric.com",
                "paypal_post_url" => "https://www.sandbox.paypal.com/cgi-bin/webscr",
                "paypal_env"      => "sandbox",

                "p" => "codeneric_uam_", //prefix


                "mapTypeToJavascript" => $mapTypeToJavascript,

                "forms" => $forms,

                "events_table_structure" => $events_table_structure,
                "db_charset" => $db_charset,

                "forgettable_properties" => $forgettable_properties,

                "optimization_timeout" => 30,
                "optimize_older_than" => 90,
                "optimize_cron_hook" => "codeneric/uam/optimize_db",
                "ping_service_url" => "http://172.17.0.1:62449",
                "db_opti_state_option" => "codeneric/uam/db_opti_state",
                "max_db_opti_batch_size" => 2,
                "register_db_opti_cb_cycle" => 10,
                "remote_db_opti_param" => 'codeneric_uam_db_opti',
                "plugin_id_option" => "codeneric_uam_uuid",
                "invoke_db_opti_nonce_name" => '_cc_nonce'
            ),
            "production" => array(
                "env" => "production",
                "text_domain" => $text_domain,
                "plugin_display_name" => 'Ultimate Ads Manager',
                "wpps_url" => 'http://headgame.draco.uberspace.de/wpps',
                "checkout_url" => 'https://checkout.codeneric.com',
                "custom_post_slug" => "codeneric_ad",
                "group_slug" => "codeneric_ad_group",
                "place_slug" => "codeneric_ad_place",
                "plugin_name" => "ultimate-ads-manager",
                "premium_plugin_name" => "ultimate-ads-manager-premium",
                "premium_main_file" => "ultimate-ads-manager-premium.php",
                "plugin_slug_abbr" => "uam",
                "premium_changelog" => $changelog_url,
                'wp_nonce_base' => 'ultimate_ads_manager_meta',
                "version" => $plugin_data['Version'],
                "premium_version" => $premium_version,
                "has_premium_ext" => $has_premium_ext,
                "premium_ext_active" => $premium_ext_active,
                "premium_plugin_key" => $phmm_premium_key,
                "update_check_cool_down" => 60 * 60,
                "general_settings_key" => 'codeneric_ad_general_settings',

                "plugin_root_path" => plugin_dir_path(__FILE__),
                "premium_plugin_root_path" => dirname(dirname(__FILE__)).'/ultimate-ads-manager-premium',
                "table_name_events" => $wpdb->prefix . "codeneric_uam_events",
                "table_name_events_summary" => $wpdb->prefix . "codeneric_uam_events_summary",
                "db_map" => $db_map,
                "fake_prevention" => $fake_prevention,
                "plugin_adblock_symlink_name" => $plugin_adblock_symlink_name,
                "plugin_adblock_symlink_path" => $plugin_adblock_symlink_path,
                "plugin_adblock_url" => $plugin_adblock_url,

                "premium_plugin_adblock_symlink_name" => $premium_plugin_adblock_symlink_name,
                "premium_plugin_adblock_symlink_path" => $premium_plugin_adblock_symlink_path,
                "premium_plugin_adblock_url" => $premium_plugin_adblock_url,


                "js_entry_statistics" =>  $plugin_adblock_url . '/admin/entries/statistics.bundle.base-'.$plugin_data['Version'].'.min.js',
                "js_entry_edit" =>  $plugin_adblock_url . '/admin/entries/edit.bundle.base-'.$plugin_data['Version'].'.min.js',
                "js_entry_group_edit" =>   $plugin_adblock_url . '/admin/entries/edit-group.bundle.base-'.$plugin_data['Version'].'.min.js',
                "js_entry_settings" =>   $plugin_adblock_url . '/admin/entries/settings.bundle.base-'.$plugin_data['Version'].'.min.js',
                "js_entry_premium" =>   $plugin_adblock_url . '/admin/entries/premium-page.bundle.base-'.$plugin_data['Version'].'.min.js',
                "js_entry_public" =>   $plugin_adblock_url . '/public/js/public.bundle.base-'.$plugin_data['Version'].'.min.js',
                "js_entry_fetch_async_overview" =>   $plugin_adblock_url . '/admin/entries/fetch-async-overview.bundle.base-'.$plugin_data['Version'].'.min.js',

//                "js_prem_entry_statistics" =>  $plugin_adblock_url . '../ultimate-ads-manager-premium/admin/entries/statistics.bundle.premium-'.$premium_version.'.min.js',
//                "js_prem_entry_edit" =>  $plugin_adblock_url . '../ultimate-ads-manager-premium/admin/entries/edit.bundle.premium-'.$premium_version.'.min.js',
//                "js_prem_entry_group_edit" =>  $plugin_adblock_url . '../ultimate-ads-manager-premium/admin/entries/edit-group.bundle.premium-'.$premium_version.'.min.js',
//                "js_prem_entry_settings" =>   $plugin_adblock_url . '../ultimate-ads-manager-premium/admin/entries/settings.bundle.premium-'.$premium_version.'.min.js',

                "js_prem_entry_statistics" =>  plugin_dir_url( dirname( __FILE__ ) ). 'ultimate-ads-manager-premium/admin/entries/statistics.bundle.premium-'.$premium_version.'.min.js',
                "js_prem_entry_edit" =>  plugin_dir_url( dirname( __FILE__ ) ). 'ultimate-ads-manager-premium/admin/entries/edit.bundle.premium-'.$premium_version.'.min.js',
                "js_prem_entry_group_edit" =>  plugin_dir_url( dirname( __FILE__ ) ). 'ultimate-ads-manager-premium/admin/entries/edit-group.bundle.premium-'.$premium_version.'.min.js',
                "js_prem_entry_settings" =>   plugin_dir_url( dirname( __FILE__ ) ). 'ultimate-ads-manager-premium/admin/entries/settings.bundle.premium-'.$premium_version.'.min.js',
                "js_prem_entry_public" =>   plugin_dir_url( dirname( __FILE__ ) ). 'ultimate-ads-manager-premium/public/js/public.bundle.premium-'.$premium_version.'.min.js',


                "stripe_key" => 'pk_live_dvPEBGQnKz9rpcoddxTJ21Rf',
                "paypal_merchant" => "elance@codeneric.com",
                "paypal_post_url" => "https://www.paypal.com/cgi-bin/webscr",
                "paypal_env"      => "www",

                "p" => "codeneric_uam_", //prefix

                
                "mapTypeToJavascript" => $mapTypeToJavascript,

                "forms" => $forms,

                "events_table_structure" => $events_table_structure,
                "db_charset" => $db_charset,

                "forgettable_properties" => $forgettable_properties,

                "optimization_timeout" => 60*3,
                "optimize_older_than" => 90,
                "optimize_cron_hook" => "codeneric/uam/optimize_db",
                "ping_service_url" => "http://ping.codeneric.com",
                "db_opti_state_option" => "codeneric/uam/db_opti_state",
                "max_db_opti_batch_size" => 25000,
                "register_db_opti_cb_cycle" => 60 * 60 * 12,
                "remote_db_opti_param" => 'codeneric_uam_db_opti',
                "plugin_id_option" => "codeneric_uam_uuid",
                "invoke_db_opti_nonce_name" => '_cc_nonce'
            )
        );

        $GLOBALS["cc_uam_config"] = $config[$env];

        return $config;

    }


}
