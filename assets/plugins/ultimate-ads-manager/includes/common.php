<?php

/**
 * Created by PhpStorm.
 * User: denis_000
 * Date: 30.05.2016
 * Time: 16:13
 */
class Ultimate_Ads_Manager_Base_Common
{
    public static function gen_uuid() {
        return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            // 32 bits for "time_low"
            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),

            // 16 bits for "time_mid"
            mt_rand( 0, 0xffff ),

            // 16 bits for "time_hi_and_version",
            // four most significant bits holds version number 4
            mt_rand( 0, 0x0fff ) | 0x4000,

            // 16 bits, 8 bits for "clk_seq_hi_res",
            // 8 bits for "clk_seq_low",
            // two most significant bits holds zero and one for variant DCE1.1
            mt_rand( 0, 0x3fff ) | 0x8000,

            // 48 bits for "node"
            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
        );
    }

    public static function register_callback($url, $in_sec=0, $singleton=false){
        global $cc_uam_config;
//        $nonce = wp_create_nonce('test');
//        error_log("nonce: $nonce");
        $nonce = Ultimate_Ads_Manager_Base_Common::gen_uuid();
        $nn = $cc_uam_config['invoke_db_opti_nonce_name'];
        set_transient($nonce, 1, DAY_IN_SECONDS);

        $url = add_query_arg($nn,
            $nonce,
            $url);

        $url = urlencode($url);

        $u = add_query_arg('url', $url, $cc_uam_config['ping_service_url'] .'/register');
        $u = add_query_arg('in', $in_sec * 1000, $u);
        $u = add_query_arg('singleton', intval($singleton), $u);
        $response = wp_remote_get($u);
//        echo '';
//        if( is_array($response) ) {
//            $header = $response['headers']; // array of http header lines
//            $body = $response['body']; // use the content
//        }
    }

    public static function set_plugin_id(){
        global $cc_uam_config;
        if ( get_option( $cc_uam_config['plugin_id_option'] ) === false ) {
            $random_str = self::gen_uuid();
            update_option( $cc_uam_config['plugin_id_option'], $random_str  );
        }
    }
}