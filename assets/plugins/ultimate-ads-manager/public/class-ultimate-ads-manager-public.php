<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://codeneric.com
 * @since      1.0.0
 *
 * @package    Ultimate_Ads_Manager
 * @subpackage Ultimate_Ads_Manager/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Ultimate_Ads_Manager
 * @subpackage Ultimate_Ads_Manager/public
 * @author     Codeneric <contact@codeneric.com>
 */
class Ultimate_Ads_Manager_Public
{

	static $current_ads_meta = array();

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
	private $version;


	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string $plugin_name The name of the plugin.
	 * @param      string $version The version of this plugin.
	 */
	public function __construct($plugin_name=null, $version=null)
	{

		global $cc_uam_config;
		$this->config = $cc_uam_config;
		$this->plugin_name = $this->config['plugin_name'];
		$this->version = $this->config['version'];

//		$this->mock_events(62, 100000);



	}



	static function add_current_ad_meta($id, $meta) {
		self::$current_ads_meta[$id] = $meta;

	}
	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles()
	{

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

		//wp_enqueue_style($this->plugin_name, UAM_Config::$plugin_adblock_url . '/public/css/ultimate-ads-manager-public.css', array(), $this->version, 'all');

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	
	
	public function create_globals() {
		global $cc_uam_config;
		$globals = array();
		$globals['ads'] = self::$current_ads_meta;
		$globals['ajax_url'] = admin_url('admin-ajax.php');
		$globals['id'] = get_option($cc_uam_config['plugin_id_option']);
		$globals['admin_url'] = get_option('admin_email');
		$globals['wpps_url'] = $cc_uam_config['wpps_url'];
		$globals['assets'] = $cc_uam_config['plugin_adblock_url'].'/assets/';

	}
	
	
	public function enqueue_scripts()
	{

		global $cc_uam_config;
		global $post;

//		if(! is_link($cc_uam_config['plugin_adblock_symlink_path']))
//			symlink($cc_uam_config['plugin_root_path'], $cc_uam_config['plugin_adblock_symlink_path']);
        do_action('codeneric_uam_update_symlink');
		

		$hasShortcode = is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'uam_ad');
		$hasWidget = is_active_widget(false,false, $cc_uam_config['custom_post_slug'].'_widget');

//		if( !empty(self::$current_ads_meta) && ( $hasShortcode || $hasWidget ) ) {
		if( true ) { // 1.4.1 hotfix
			$globals = array();
			$globals['ads'] = self::$current_ads_meta;
			$globals['ajax_url'] = admin_url('admin-ajax.php');




			if(has_action('codeneric/uam/enqueue_public_premium_js')) {//
				do_action('codeneric/uam/enqueue_public_premium_js',$globals);
			} else {
			  wp_register_script( $cc_uam_config['plugin_name'].'_public', $cc_uam_config['js_entry_public'], $cc_uam_config['version'], true);
			  wp_localize_script( $cc_uam_config['plugin_name'].'_public', '__CODENERIC_UAM_GLOBALS__', $globals);
			  wp_print_scripts($cc_uam_config['plugin_name'].'_public');
			}

		}

		// if(! is_link($cc_uam_config['plugin_adblock_symlink_path']))
		// 	symlink($cc_uam_config['plugin_root_path'], $cc_uam_config['plugin_adblock_symlink_path']);
		//
		// $gen_set = get_option( $cc_uam_config['custom_post_slug'].'_general_settings', array() );
		// $url = !empty($gen_set['block_adblock']) ? $cc_uam_config['plugin_adblock_url']  : plugins_url( '..', __FILE__ );
		// //wp_enqueue_script($this->plugin_name, $url . '/public/js/ultimate-ads-manager-public.js', array('jquery'), $this->version, true);
		//
		//
		//
		// $plugin_adblock_url = $url . '/public/js/public.bundle.base-'.$cc_uam_config['version'].'.min.js';
		//
		// if ( $cc_uam_config['env'] === 'development' ) {
		// 	$plugin_adblock_url = 'http://localhost:3000/entry.public.js';
		// }

//		wp_enqueue_script($this->plugin_name.'_public', $plugin_adblock_url, array('jquery'), $cc_uam_config['version'], true);
//
//		// inject ajax path as variable ajaxurl
//		wp_localize_script( $this->plugin_name.'_public', 'ajaxurl', admin_url( 'admin-ajax.php' ));


	}

    public function save_ad_event($event)
    {
        global $cc_uam_config;
        global $wpdb;



        if(!isset($event) || !isset($event['type']) || !isset($event['ad_id'])|| !isset($event['ad_slide_id'])
            || !isset($cc_uam_config['db_map'][$event['type']]) ){
            return false;
        }

        $uuid = 42; //magic
        $event['type'] = $cc_uam_config['db_map'][$event['type']];
        $event['place_id'] = isset($event['place_id']) ? intval($event['place_id']) : 0;

        if(isset($event['uuid'])){
            $enc_id = base64_decode($event['uuid']);
            $temp_uuid = $enc_id; //because PHP is bullshit

            if(ctype_digit($temp_uuid)) //check if all characters are digits
                $uuid = intval ( $temp_uuid );
            else{
                return false;
            }
        }
        $event['uuid'] = $uuid;

        $table_name = $cc_uam_config['table_name_events'];

        $supported_fields = array('type', 'uuid', 'ad_id', 'ad_slide_id', 'time', 'ip', 'place_id');
        foreach ($event as $k => $v){
            if(!in_array($k, $supported_fields))
                unset($event[$k]);
        }

        do_action('codeneric/uam/premium/update_cache', $event);


        $res = $wpdb->insert($table_name,$event );


        return $res !== false;

    }



	public function handle_client_side_ad_event()
	{
		global $cc_uam_config;
		global $wpdb;
		$post = $_POST;
//		if(!isset($post) || !isset($post['type']) || !isset($post['ad_id'])|| !isset($post['ad_slide_id'])
//		|| !isset($cc_uam_config['db_map'][$post['type']]) ){
//			status_header( 400 );
//			exit;
//		}

//		$uuid = 42; //magic
//		$type = $cc_uam_config['db_map'][$post['type']];
//        $place_id = isset($post['place_id']) ? intval($post['place_id']) : 0;
//
//		if(isset($post['uuid'])){
//		    $enc_id = base64_decode($post['uuid']);
//			$temp_uuid = $enc_id; //because PHP is bullshit
//
//			if(ctype_digit($temp_uuid)) //check if all characters are digits
//				$uuid = intval ( $temp_uuid );
//			else{
//				status_header( 400 );
//				exit;
//			}
//		}

		$table_name = $cc_uam_config['table_name_events'];




//		$event = array(
//			'time' => date( 'Y-m-d H:i:s' ),
//			'type' => $post['type'],
//			'uuid' => $post['uuid'],
//			'ip'   => $ip, //TODO: save ip as Binary(4) http://stackoverflow.com/questions/1385552/datatype-for-storing-ip-address-in-sql-server
//			'ad_id' => $post['ad_id'],
//			'ad_slide_id' => $post['ad_slide_id'],
//            'place_id' => $place_id
//		);

        $event = $post;
        $event['time'] = date( 'Y-m-d H:i:s' );
        $event['ip'] = $this->get_client_ip();
        $succ = $this->save_ad_event($event);



		status_header( $succ !== false ? 200 : 400 );
		if(!isset($post['uuid']) && $succ !== false){
			$wpdb->update( $table_name, array('uuid' => $wpdb->insert_id), array('id'=> $wpdb->insert_id) );
			header( "Content-Type: application/json" );
			$enc_id = $wpdb->insert_id;
			$res = new stdClass();
			$res->uuid = base64_encode($enc_id);
			exit(json_encode($res));
		}else{

			exit;
		}

	}

	private function get_client_ip() {
		$ipaddress = '';
		if (isset($_SERVER['HTTP_CLIENT_IP']))
			$ipaddress = $_SERVER['HTTP_CLIENT_IP'];
		else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
			$ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
		else if(isset($_SERVER['HTTP_X_FORWARDED']))
			$ipaddress = $_SERVER['HTTP_X_FORWARDED'];
		else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
			$ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
		else if(isset($_SERVER['HTTP_FORWARDED']))
			$ipaddress = $_SERVER['HTTP_FORWARDED'];
		else if(isset($_SERVER['REMOTE_ADDR']))
			$ipaddress = $_SERVER['REMOTE_ADDR'];
		else
			$ipaddress = 'UNKNOWN';
		return $ipaddress;
	}

	private function prop_that_fake_event($event){
		global $wpdb, $cc_uam_config;
		$prop = 0; //we ar optimistic, no fake.

		$table_name = $cc_uam_config['table_name_events'];
		$db_map = $cc_uam_config['db_map'];

		//get most recent click of this ip
		$query = "SELECT * FROM $table_name WHERE ip = '%s' AND type = %d ORDER BY time DESC LIMIT 1";

		$old_event = $wpdb->get_results( $wpdb->prepare($query, $event['ip'], $db_map['click']) );
		if($wpdb->num_rows === 1){
			$old_time  = strtotime($old_event[0]->time);
			$curr_time = strtotime($event['time']);
			$diff_in_sec = $curr_time - $old_time;

			if($diff_in_sec <= 60 && $old_event[0]->uudi !== $event['uuid']){ //somebody wants to produce 2 total events
				$prop = 1;
			}
		}
		/*
		foreach($users_latest_events as $event){

		}*/

		return $prop;
	}
	public function append_ga_tracking_code() {
		require_once(dirname(__FILE__).'/analyticstracking.php');
		codeneric_uam_append_ga_tracking_code();
	}

	public function mock_events($ad_id, $amount)
	{
		global $cc_uam_config;
		global $wpdb;

		if($this->config['env'] !== 'development')
			return;




		$table_name = $cc_uam_config['table_name_events'];



		$event = array(
//			'time' => current_time( 'mysql' ),
			'time' => date( 'Y-m-d H:i:s' ),
			'type' => 0,
			'uuid' => rand(1,999999999),
			'ip'   => '255.255.255.255', //TODO: save ip as Binary(4) http://stackoverflow.com/questions/1385552/datatype-for-storing-ip-address-in-sql-server
			'ad_id' => $ad_id,
			'ad_slide_id' => 43
		);
		for ($i=0; $i < $amount; $i++){
			$event['uuid'] = rand(1,999999999);
			$wpdb->insert($table_name,$event );
		}

	}

}
