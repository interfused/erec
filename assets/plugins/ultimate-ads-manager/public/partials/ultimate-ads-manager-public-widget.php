<?php

/***
 * if no ad was selected, do not display any widget
 * */
if(!isset($instance['ad_id']))
    return false;


//$meta = get_post_meta( $instance['ad_id'] , 'ad_group' ,true);
//$ad_ids = explode(',', $meta);
//print_r($meta);

/**
*   $this is the Widget Class given in ultimate-ads-manager/trunk/admin/class-ultimate-ads-manager-widget.php:Ultimate_Ads_Manager_Widget
 */
/*
 *
 *

*/
global $cc_uam_config;

$post_type = get_post_type($instance['ad_id']);
if($post_type === $cc_uam_config['custom_post_slug'] || $post_type === $cc_uam_config['group_slug']){
    require_once(dirname(__FILE__).'/../../includes/Ultimate_Ads_Manager_Base_Randomizer.php');
    $res = Ultimate_Ads_Manager_Base_Randomizer::process_public($instance['ad_id']);

    $ad_id  =   $res[0];
    $meta   =   $res[1];

    if(empty($meta)){ //probably empty ad group, bail out.
        return '';
    }

    $meta['post_title'] = get_the_title ( $ad_id );



    do_action('codeneric/uam/add_ad_meta', $ad_id, $meta );

    $isJavascript = in_array($meta['type'], $cc_uam_config['mapTypeToJavascript']);

    echo $args['before_widget']; ?>

        <?php
            /*
             * Display title if needed
             * */

            if(isset($instance['display_title']) && !empty($instance['title']))
                echo $args['before_title'].$instance['title'].$args['after_title'];



            ?>
                <div class="codeneric_ultimate_ads_manager_ad_wrapper" data-js="<?php echo $isJavascript === true ? "true" : "false"; ?>" data-id="<?php echo $ad_id; ?>">
                    <?php if($isJavascript ) {
                        echo $meta['snippet'];
                    } ?>
                </div>
            <?php
        echo $args['after_widget'];

}elseif($post_type === $cc_uam_config['place_slug'] ){
    require_once(dirname(__FILE__).'/../../includes/place.php');
    require_once(dirname(__FILE__).'/../../includes/shortcode.php');
    $place_id = $instance['ad_id'];
    $candidates = Ultimate_Ads_Manager_Place::get_best_candidates($place_id);
    if(count($candidates) === 0)return;
    $ad_id = Ultimate_Ads_Manager_Place::choose_candidate($candidates);
    $ad_html =  Ultimate_Ads_Manager_Base_Shortcode::generate_advert_html($ad_id, $place_id);
    $meta['post_title'] = get_the_title ( $ad_id );



//    do_action('codeneric/uam/add_ad_meta', $ad_id, $meta );
//    $isJavascript = in_array($meta['type'], $cc_uam_config['mapTypeToJavascript']);

    echo $args['before_widget'];


    if(isset($instance['display_title']) && !empty($instance['title']))
        echo $args['before_title'].$instance['title'].$args['after_title'];



    echo $ad_html;

    echo $args['after_widget'];
}

?>
