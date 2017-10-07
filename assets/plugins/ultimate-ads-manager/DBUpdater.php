<?php
/**
 * Created by PhpStorm.
 * User: Denis
 * Date: 26.03.2015
 * Time: 15:35
 */

//namespace cc_ads_manage;

class cc_DBUpdater {
    static $versions = array('1.0.0', '1.0.1', '1.0.2', '1.0.3', '1.1.0', '1.1.1',
        '1.1.2', '1.2.0', '1.2.1', '1.3.0', '1.3.1', '1.3.2', '1.5.5', '2.0.0', '2.0.2');
    static $currVersion;// = '1.0.0';




    static function version_to_func_name($newVersion){
        $tempNew = str_replace(".", "_", $newVersion);

        return "update_to_$tempNew";
    }

    static function updateDB(){
        global $cc_uam_config;
        $varTemp = get_plugin_data( dirname(__FILE__).'/ultimate-ads-manager.php', false, false );
        cc_DBUpdater::$currVersion = $varTemp['Version'];
        $oldVersion = get_option( 'cc_ads_manage_curr_version' );


        cc_DBUpdater::register(); //try to register

        $funcContainer = new UAM_FunctionContainer();
        $funcContainer->legacy();

        if($oldVersion === cc_DBUpdater::$currVersion)return;

        //flush_rewrite_rules();


        update_option( 'cc_ads_manage_curr_version',cc_DBUpdater::$currVersion );
        $oldVersionIndex = array_search($oldVersion, cc_DBUpdater::$versions);

        update_option('codeneric_uam_register_status', 500); //data is outdated, update profile

        if($oldVersionIndex === false)
            $oldVersionIndex = 0;



        for($i = $oldVersionIndex+1; $i< count(cc_DBUpdater::$versions); $i++ ){
            $funcName = cc_DBUpdater::version_to_func_name(cc_DBUpdater::$versions[$i]);

            if(method_exists ($funcContainer, $funcName)){ //we have to perform some operations on the database
                $funcContainer->$funcName();
            }
        }

        /////////// AFTER INSTALL/UPGRADE
        do_action($cc_uam_config['p'].'/base-plugin-updated');

//        require_once plugin_dir_path( __FILE__ ) . 'config.php';





    }

    static function update_to_premium(){
        global $cc_uam_config;
        $uuid = get_option( 'codeneric_uam_uuid' );

//        $status = array('text' => 'Fetching premium plugin...', 'code' => 0);


        $prem_download_url = $cc_uam_config['wpps_url']."/paid?plugin_id=$uuid";
        $res = wp_remote_get($prem_download_url);
        if(isset($res) && is_array($res) && isset($res['response']) && isset($res['response']['code'])){
            $code = $res['response']['code'];
            if($code === 402){
                return array('text' => 'Payment required.', 'code' => 402);
            }elseif($code !== 200){
                return array('text' => 'Something went wrong, try again later.', 'code' => 503);
            }
        }else{
            return array('text' => 'Codeneric Server currently down, try again later.', 'code' => 0);
        }

        $prem_download_url = $cc_uam_config['wpps_url']."/premium/uam/".cc_DBUpdater::$currVersion."?plugin_id=$uuid";

        if ( class_exists( 'ZipArchive' ) ) {
            $path = download_url($prem_download_url);
            if(is_string($path)){
                $zip_path = plugin_dir_path( __FILE__ ) . 'premium.zip';
                $zip_dest = plugin_dir_path( __FILE__ );
                rename($path, $zip_path);

                cc_DBUpdater::rrmdir(plugin_dir_path( __FILE__ ) . 'premium');

                $zip = new ZipArchive();
                if ($zip->open($zip_path) === true &&  $zip->extractTo($zip_dest) === true) {
                    $zip->close();
                    unlink($zip_path);
                    return true;
                }else{

                    return array('text' => 'Error occurred during upgrade.', 'code' => 42);
                }
            }

        }else{
            return array('text' => 'Zip-Module not found, upgrade to premium only manually possible.', 'code' => 42);
        }

    }


    static function register(){
        global $cc_uam_config;
        require_once (dirname(__FILE__).'/includes/common.php');

        $reg_status = get_option('codeneric_uam_register_status');
        $reg_status = $reg_status !== false ? intval($reg_status) : 500;

        //print_r($config);
        if($reg_status !== 200){
            $blog_url = get_bloginfo( 'url' );
            $blog_version = get_bloginfo( 'version' );
            $blog_lang = get_bloginfo( 'language' );
            $blog_id = get_option('codeneric_uam_uuid');
            if($blog_id === false)
                update_option('codeneric_uam_uuid', Ultimate_Ads_Manager_Base_Common::gen_uuid() );
            $p_v = cc_DBUpdater::$currVersion;
            $res = wp_remote_get( $cc_uam_config['wpps_url'] . "/register/?plugin_id=$blog_id&wp_version=$blog_version&wp_url=$blog_url&wp_lang=$blog_lang&product=uam&plugin_version=$p_v" );
            $code = 500;

            if(isset($res) && is_array($res) && isset($res['response']) && isset($res['response']['code'])){
                $code = $res['response']['code'];
            }


            update_option('codeneric_uam_register_status', $code);
        }
    }

    static function rrmdir( $dir ) {
        if ( is_dir( $dir ) ) {
            $objects = scandir( $dir );
            foreach ( $objects as $object ) {
                if ( $object != "." && $object != ".." ) {
                    if ( filetype( $dir . "/" . $object ) == "dir" ) {
                        cc_DBUpdater::rrmdir( $dir . "/" . $object );
                    } else {
                        unlink( $dir . "/" . $object );
                    }
                }
            }
            reset( $objects );
            return rmdir( $dir );
        }
    }


}

class UAM_FunctionContainer{
    /*
    function update_to_1_1_0(){ //update from 1.0.1 to 1.1.0
        $options = array('cc_photo_image_box'=> 1, 'cc_photo_download_text'=> 'Download all' );
        update_option( 'cc_photo_settings', $options );

        $posts_array = get_posts( "post_type=client" );
        foreach($posts_array as $client){
            $projects = get_post_meta($client->ID,"projects",true);
            foreach($projects as &$project)
                $project['downloadable'] = true;
            //print_r($projects);
            update_post_meta($client->ID,"projects", $projects);
        }
    }
    */
    function update_to_1_0_2(){
        global $cc_uam_config;
        if(is_link($cc_uam_config['plugin_adblock_symlink_path']) ){
            unlink($cc_uam_config['plugin_adblock_symlink_path']);
            symlink($cc_uam_config['plugin_root_path'], $cc_uam_config['plugin_adblock_symlink_path']);
        }
    }

    function update_to_1_1_0(){
        global $cc_uam_config;

        if(is_link($cc_uam_config['plugin_adblock_symlink_path']) )
            unlink($cc_uam_config['plugin_adblock_symlink_path']);
        if(!is_link($cc_uam_config['plugin_adblock_symlink_path']) ){
            //symlink("/var/www/wordpress/wp-content/plugins/ultimate-ads-manager", $upload_dir['baseurl'].'/no-ads-here');
            symlink($cc_uam_config['plugin_root_path'], $cc_uam_config['plugin_adblock_symlink_path']);
        }
    }

    function update_to_1_2_1(){
        global $cc_uam_config;
        $args        = array(
            'posts_per_page' => - 1,
            'orderby'        => 'date',
            'order'          => 'DESC',
            'post_type'      => $cc_uam_config['custom_post_slug'],
            'post_status'    => 'publish'
            //'suppress_filters' => true
        );
        $posts_array = get_posts( $args );
        foreach($posts_array as $p ){
            $meta = get_post_meta( $p->ID, 'ad', true );
            if(isset($meta) && isset($meta['images']) && isset($meta['referral_url'])){ //old ad, convert it!
                if(is_array($meta['images']) && count($meta['images']) > 0 ){
                    $img_id = array_keys($meta['images']);
                    $img_id = $img_id[0];
                    $vals = array_values($meta['images']);
                    if(isset($vals[0]['url']) && isset($vals[0]['title'])){
                        if(is_string($vals[0]['url']) && is_string($vals[0]['url']) && is_string($meta['referral_url'])){
                            $new_meta = array(
                                'image_ad_referral_url' => $meta['referral_url'],
                                'image_ad_title'        => $vals[0]['title'],
                                'image_ad_uri'          => $vals[0]['url'],
                                'image_ad_id'           => $img_id,
                                'type'                  => 'image_ad'
                                );
                            update_post_meta($p->ID, 'ad', $new_meta);

                        }
                    }
                }
            }
        }
    }

    function update_to_2_0_0(){
        global $cc_uam_config;

        require_once dirname(__FILE__).'/includes/util.php';
        $args        = array(
            'posts_per_page' => -1,
            'orderby'        => 'date',
            'order'          => 'DESC',
            'post_type'      => $cc_uam_config['custom_post_slug']
//            'post_status'    => 'publish'
            //'suppress_filters' => true
        );
        $posts_array = get_posts( $args );
        foreach ($posts_array as $post){
            $ad = get_post_meta($post->ID, 'ad', true);
            if(is_array($ad) && isset($ad['type'])){
                if($ad['type'] === 'image_ad'){
                    $image_id = $ad['image_ad_id'];
                    $src = wp_get_attachment_image_src( $image_id, 'full', false );
                    $width = $src[1];
                    $height = $src[2];
                    $form = Ultimate_Ads_Manager_Util::nearest_form($width,$height);
                    $ad['forms'] = array($form);
                }else{
                    $width = 1;
                    $height = 1;
                    $form = Ultimate_Ads_Manager_Util::nearest_form($width,$height);
                    $ad['forms'] = array($form);
                }
                update_post_meta($post->ID, 'ad', $ad);
            }
        }
    }


    function update_to_2_0_2(){
        global $cc_uam_config;
        /////////////// Database Stuff ////////////////////////
        global $wpdb;

        $table_name = $cc_uam_config['table_name_events'];
        /*
                if(UAM_Config::$ENV === 'development'){
                    $wpdb->query( " DROP TABLE $table_name"	);
                }*/

        $charset_collate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE $table_name (
		  id   bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
		  time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
		  type tinyint NOT NULL,
		  uuid bigint(20) UNSIGNED NOT NULL,
		  ip   tinytext DEFAULT '' NOT NULL,
		  ad_id   bigint(20) UNSIGNED NOT NULL,
		  ad_slide_id   tinyint UNSIGNED NOT NULL,
		  place_id   bigint(20) UNSIGNED NOT NULL,
		  UNIQUE KEY id (id)
		) $charset_collate;";

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $sql );


    }



    function update_to_2_1_0(){
        global $cc_uam_config;
        /////////////// Database Stuff ////////////////////////
        global $wpdb;

        $table_name = $cc_uam_config['table_name_events'];
        /*
                if(UAM_Config::$ENV === 'development'){
                    $wpdb->query( " DROP TABLE $table_name"	);
                }*/

        $charset_collate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE $table_name (
		  id   bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
		  time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
		  type tinyint NOT NULL,
		  uuid bigint(20) UNSIGNED NOT NULL,
		  ip   tinytext DEFAULT '' NOT NULL,
		  ad_id   bigint(20) UNSIGNED NOT NULL,
		  ad_slide_id   tinyint UNSIGNED NOT NULL,
		  place_id   bigint(20) UNSIGNED NOT NULL,
		  value   int UNSIGNED DEFAULT 1 NOT NULL,
		  UNIQUE KEY id (id)
		) $charset_collate;";

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $sql );


    }
//    function update_to_1_3_2(){
//        global $cc_uam_config;
//
//        /////////////// Database Stuff ////////////////////////
//        global $wpdb;
//
//        $table_name = $cc_uam_config['table_name_events_summary'];
//        /*
//                if(UAM_Config::$ENV === 'development'){
//                    $wpdb->query( " DROP TABLE $table_name"	);
//                }*/
//
//        $charset_collate = $wpdb->get_charset_collate();
//
//        $sql = "CREATE TABLE $table_name (
//		  id   bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
//		  time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
//		  type tinyint NOT NULL,
//		  metric tinyint NOT NULL,
//		  ad_id   bigint(20) UNSIGNED NOT NULL,
//		  value   bigint(20) UNSIGNED NOT NULL,
//		  UNIQUE KEY id (id)
//		) $charset_collate;";
//
//        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
//        dbDelta( $sql );
//    }


    function legacy(){
//        $pf = get_option( 'cc_phmm_pf' );
        $p = get_option( 'codeneric_uam_prem' );
        global $cc_uam_config;
        if($p && !$cc_uam_config['has_premium_ext']){
            if(!function_exists('cc_uam_base_admin_notice_update_to_premium')){
                function cc_uam_base_admin_notice_update_to_premium() {
                    global $cc_uam_config;
                    $class = "update-nag";
                    $prem_url = admin_url('edit.php');
                    $prem_url = add_query_arg(array('post_type' => $cc_uam_config['custom_post_slug'], 'page' => 'uam-premium'), $prem_url);
                    $p_url =  admin_url('plugins.php');
                    $message = "Please <a id=\"cc_uam_install_notice\" href=\"$prem_url\" >install</a> the Ultimate Ads Manager Premium extension!";
                    echo"<div id=\"cc_uam_notice_wrap\" class=\"$class\"> <p>$message</p></div>";
                }
            }
            add_action( 'admin_notices', 'cc_uam_base_admin_notice_update_to_premium' );

        }
        elseif($cc_uam_config['has_premium_ext'] && !$cc_uam_config['premium_ext_active']){
            if(!function_exists('cc_uam_base_admin_notice_update_to_premium')){
                function cc_uam_base_admin_notice_update_to_premium() {
                    global $cc_uam_config;
                    $class = "update-nag";
                    $d_url =  admin_url('plugins.php');
                    $message = "Please <a href=\"$d_url\" >activate</a> the Ultimate Ads Manager Premium extension!";
                    echo"<div id=\"cc_uam_notice_wrap\" class=\"$class\"> <p>$message</p></div>";
                }
            }

            add_action( 'admin_notices', 'cc_uam_base_admin_notice_update_to_premium' );

        }

    }
}

