<?php

/**
 * Fired during plugin deactivation
 *
 * @link       http://codeneric.com
 * @since      1.0.0
 *
 * @package    Ultimate_Ads_Manager
 * @subpackage Ultimate_Ads_Manager/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Ultimate_Ads_Manager
 * @subpackage Ultimate_Ads_Manager/includes
 * @author     Codeneric <contact@codeneric.com>
 */
class Ultimate_Ads_Manager_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
		global $cc_uam_config;
		$plugin_id = get_option($cc_uam_config['plugin_id_option']);
		wp_remote_get( $cc_uam_config['wpps_url'] . "/event/1.0/?plugin_id=$plugin_id&type=deactivated");

	}

}
