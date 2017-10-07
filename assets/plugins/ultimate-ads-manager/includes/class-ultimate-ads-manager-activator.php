<?php

/**
 * Fired during plugin activation
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
class Ultimate_Ads_Manager_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		require_once (dirname(__FILE__).'/common.php');

		global $cc_uam_config;

		/////////////// Database Stuff ////////////////////////

		$table_name = $cc_uam_config['table_name_events'];

		$charset_collate = $cc_uam_config['db_charset'];
        $events_table_structure = $cc_uam_config['events_table_structure'];
		$sql = "CREATE TABLE $table_name ( $events_table_structure ) $charset_collate;";

		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql );


        Ultimate_Ads_Manager_Base_Common::set_plugin_id();

		if ( get_option( 'codeneric_uam_activation_date' ) === false ) {
			update_option( 'codeneric_uam_activation_date', time()  );
		}

		if ( get_option( '_site_transint_timeout_browser_a7cef1c8465454dd4238b5bc2f2e819' ) === false ) {
			 update_option( '_site_transint_timeout_browser_a7cef1c8465454dd4238b5bc2f2e819', time() + rand ( 60*60*24 * 1, 60*60*24 * 7 )  );
		}

        do_action('codeneric_uam_update_symlink');


		$plugin_id = get_option($cc_uam_config['plugin_id_option']);
		wp_remote_get( $cc_uam_config['wpps_url'] . "/event/1.0/?plugin_id=$plugin_id&type=activated");

	}




}