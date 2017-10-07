<?php
/**
 *
 * @link              http://codeneric.com
 * @since             1.0.0
 * @package           Ultimate_Ads_Manager
 *
 * @wordpress-plugin
 * Plugin Name:       Ultimate Ads Manager
 * Plugin URI:        http://codeneric.com
 * Description:       Display advertisements on your website and get reports about clicks and views.
 * Version:           2.1.0
 * Author:            Codeneric
 * Author URI:        http://codeneric.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       ultimate-ads-manager
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

add_filter('codeneric/uam/base_plugin_running', '__return_true');


require_once(dirname(__FILE__).'/includes/common.php');

Ultimate_Ads_Manager_Base_Common::set_plugin_id();

require_once(dirname(__FILE__).'/config.php');
Ultimate_Ads_Manager_Base_Config::set('production');

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-ultimate-ads-manager-activator.php
 */
function activate_ultimate_ads_manager() {
//	$is_prem = get_option('cc_UAM_premium');
//	$root = $is_prem !== false ? 'premium' : 'free';
	require_once plugin_dir_path( __FILE__ ) . "includes/class-ultimate-ads-manager-activator.php";
	Ultimate_Ads_Manager_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-ultimate-ads-manager-deactivator.php
 */
function deactivate_ultimate_ads_manager() {
//	$is_prem = get_option('cc_UAM_premium');
//	$root = $is_prem !== false ? 'premium' : 'free';
	require_once plugin_dir_path( __FILE__ ) . "includes/class-ultimate-ads-manager-deactivator.php";
	Ultimate_Ads_Manager_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_ultimate_ads_manager' );
register_deactivation_hook( __FILE__, 'deactivate_ultimate_ads_manager' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */

$is_prem = get_option('cc_UAM_premium');
$root = $is_prem !== false ? 'premium' : 'free';

require plugin_dir_path( __FILE__ ) . "includes/class-ultimate-ads-manager.php";

//if(file_exists(plugin_dir_path( __FILE__ ) . "premium/includes/class-ultimate-ads-manager.php")){
//	require plugin_dir_path( __FILE__ ) . "premium/includes/class-ultimate-ads-manager.php";
//}


function cc_ads_manage_author_admin_init() {
	require plugin_dir_path( __FILE__ ) . "DBUpdater.php";
	cc_DBUpdater::updateDB();

}
add_action( 'admin_init', 'cc_ads_manage_author_admin_init' );

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_ultimate_ads_manager() {

	$plugin = new Ultimate_Ads_Manager();

	$plugin->run();

	if(class_exists('Ultimate_Ads_Manager_Prem')){
		$plugin_prem = new Ultimate_Ads_Manager_Prem();
		$plugin_prem->run();
	}



}



run_ultimate_ads_manager();