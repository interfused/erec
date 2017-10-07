<?php

/**
 * Created by PhpStorm.
 * User: alex
 * Date: 01.06.16
 * Time: 21:29
 */
class Ultimate_Ads_Manager_Base_Shortcode
{
    static $add_script;
    static $meta_data = array();

    public function __construct() {

        require_once(dirname(__FILE__) . '/../public/class-ultimate-ads-manager-public.php');

    }


    static function init() {
        add_shortcode('uam_ad', array(__CLASS__, 'handle_shortcode'));
        add_shortcode('uam_place', array(__CLASS__, 'handle_place_shortcode'));

        Ultimate_Ads_Manager_Base_Shortcode::register_script();


//        add_action('wp_footer', array(__CLASS__, 'print_script'));
    }

    static function handle_place_shortcode($atts) {
        global $cc_uam_config;
        require_once(dirname(__FILE__) . '/place.php');



        $a = shortcode_atts(array(
            'id' => -1
        ), $atts);

        $place = get_post($a['id'], ARRAY_A);
        $post_type = $place['post_type'];

        if($post_type !== $cc_uam_config['place_slug']){
            return;
        }

        $place_id = $a['id'];

        $candidates = Ultimate_Ads_Manager_Place::get_best_candidates($place_id);
        if(count($candidates) === 0)return;
        $candidate = Ultimate_Ads_Manager_Place::choose_candidate($candidates);
        return Ultimate_Ads_Manager_Base_Shortcode::generate_advert_html($candidate, $place_id);

    }

    static function handle_shortcode($atts) {
        self::$add_script = true;


        $a = shortcode_atts(array(
            'id' => -1
        ), $atts);

        return Ultimate_Ads_Manager_Base_Shortcode::generate_advert_html($a['id']);
    }

    static function generate_advert_html($id, $place_id=0){
        require_once(dirname(__FILE__) . '/Ultimate_Ads_Manager_Base_Randomizer.php');
        $res = Ultimate_Ads_Manager_Base_Randomizer::process_public($id);



        $ad_id = $res[0];
        $meta = $res[1];

        if(empty($meta)){ //probably empty ad group, bail out.
            return '';
        }
        // $meta['post_title'] = get_the_title ( $ad_id );





        if(!isset($GLOBALS['codeneric_uam_current_ads_meta']))
            $GLOBALS['codeneric_uam_current_ads_meta'] = array();

        $GLOBALS['codeneric_uam_current_ads_meta'][$ad_id] = $meta;

        Ultimate_Ads_Manager_Public::$current_ads_meta[$ad_id] = $meta;


        do_action('codeneric/uam/add_ad_meta', $ad_id, $meta );

        global $cc_uam_config;




        $isJavascript = in_array($meta['type'], $cc_uam_config['mapTypeToJavascript']);

        ob_start();

        ?><div class="codeneric_ultimate_ads_manager_ad_wrapper"
               data-place-id="<?php echo $place_id; ?>"
               data-js="<?php echo $isJavascript === true ? "true" : "false"; ?>"
               data-id="<?php echo $ad_id; ?>">
        <?php if( $isJavascript ) {
            echo $meta['snippet'];
        } ?>
        </div><?php

        $output = ob_get_clean();
        return $output;
    }

    static function register_script() {
        global $cc_uam_config;


    }

    static function print_script() {
        if ( ! self::$add_script )
            return;

        global $cc_uam_config;


//        $globals = array();
//
//        $globals['ads'] = self::$meta_data;
//
//        $globals['ajax_url'] = admin_url('admin-ajax.php');
//
//        if(has_action('codeneric/uam/enqueue_public_premium_js')) {
//        	do_action('codeneric/uam/enqueue_public_premium_js',$globals);
//        } else {
//          wp_register_script( $cc_uam_config['plugin_name'].'_public', $cc_uam_config['js_entry_public'], $cc_uam_config['version'], true);
//          wp_localize_script( $cc_uam_config['plugin_name'].'_public', '__CODENERIC_UAM_GLOBALS__', $globals);
//          wp_print_scripts($cc_uam_config['plugin_name'].'_public');
//        }


    }
}
