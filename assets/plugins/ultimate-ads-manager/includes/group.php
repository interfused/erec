<?php

/**
 * Created by PhpStorm.
 * User: denis
 * Date: 20.05.17
 * Time: 14:15
 */
class Ultimate_Ads_Manager_Group
{
    public static function normalize_ads($ads){
        $ads = isset($ads) ? $ads : array();
        $ads = is_string($ads) ? explode(',', $ads) : $ads;
        $ads = is_array($ads) ? $ads : array();
        foreach ($ads as $i => $ad){
            $ads[$i] = (int)$ads[$i];
        }
        return $ads;
    }

    public static function get_ads($group_id){
        $ad_group = get_post_meta($group_id, 'ad_group', true);
        return Ultimate_Ads_Manager_Group::normalize_ads($ad_group);
    }

    private static function remove_adverts_from_group($advert_ids, $group_id){
        $advert_ids = is_array($advert_ids) ? $advert_ids : array($advert_ids);
        $current_advert_ids = Ultimate_Ads_Manager_Group::get_ads($group_id);
        $number_of_ads = count($current_advert_ids);

        $current_advert_ids = array_values(array_diff( $current_advert_ids, $advert_ids ));

        if($number_of_ads !== count($current_advert_ids)){ //performance reasons
            update_post_meta($group_id, 'ad_group', $current_advert_ids);
        }
    }

    public static function remove_adverts_from_all_groups($ids){
        global $cc_uam_config;
        $args        = array(
            'posts_per_page' => - 1,
            'post_type'      => $cc_uam_config['group_slug'],
//            'post_status'    => 'publish'
            //'suppress_filters' => true
        );
        $groups = get_posts( $args );
        foreach ($groups as $group) {
            Ultimate_Ads_Manager_Group::remove_adverts_from_group($ids, $group->ID);
        }

    }

    public static function update_groups_on_deletion($id){
        global $cc_uam_config;
        $post_type = get_post_type($id);
        if($post_type === $cc_uam_config['custom_post_slug'] ){
            Ultimate_Ads_Manager_Group::remove_adverts_from_all_groups($id);
        }
    }
}