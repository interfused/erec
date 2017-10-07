<?php

/**
 * Created by PhpStorm.
 * User: denis
 * Date: 20.05.17
 * Time: 14:15
 */
class Ultimate_Ads_Manager_Place
{

    public static $choosen_candidates = array();

    public static function get_valid_candidates($place_id){
        global $cc_uam_config;
        $candidate_ids = get_post_meta($place_id, 'candidates', true); //should contain only ads of correct form
        $candidate_ids = is_array($candidate_ids) ? $candidate_ids : array();
        $valid_candidates = array();
        if(count($candidate_ids) === 0)return $valid_candidates;

        foreach ($candidate_ids as $id){
//            $ad_restrictions = apply_filters('codeneric/uam/normalize_restrictions', $ad_restrictions);
//            $restrictions_fulfilled = Ultimate_Ads_Manager_Place::restrictions_fulfilled($id);
            $post_type = get_post_type($id);
            if($post_type === $cc_uam_config['custom_post_slug']){
                $restrictions_fulfilled = Ultimate_Ads_Manager_Place::advert_restrictions_fulfilled($id);
                if($restrictions_fulfilled){
                    $valid_candidates[] = $id;
                }

            }
            if($post_type === $cc_uam_config['group_slug']){
                $restrictions_fulfilled = Ultimate_Ads_Manager_Place::group_restrictions_fulfilled($id);
                if($restrictions_fulfilled){
                    $valid_candidates[] = $id;
                }
            }
        }

        return $valid_candidates;
    }



    public static function restrictions_fulfilled($id){
        global $cc_uam_config;
        $post_type = get_post_type($id);
        if($post_type === $cc_uam_config['custom_post_slug']){
            return Ultimate_Ads_Manager_Place::advert_restrictions_fulfilled($id);

        }
        if($post_type === $cc_uam_config['group_slug']){
            return Ultimate_Ads_Manager_Place::group_restrictions_fulfilled($id);
        }
        return false;
    }

    public static function advert_restrictions_fulfilled($id){
        require_once dirname( __FILE__ ) . '/../includes/class-ultimate-ads-manager-statistics-calculator.php';
        $stats_calc = new Statistics_Calculator();
        $ad_restrictions = get_post_meta($id, 'restrictions', true);
//            $ad_restrictions = apply_filters('codeneric/uam/normalize_restrictions', $ad_restrictions);
        $ad_restrictions = Ultimate_Ads_Manager_Place::normalize_restrictions($ad_restrictions);
        $now = time();
        $weekday = date("l");
        $runtime_restriction_ok = $ad_restrictions['start'] <= $now
            && $now <= $ad_restrictions['end'];
        $weekday_ok = in_array($weekday, $ad_restrictions['weekdays']);

        $query_views = array(
            'history' => 'all_time',
            'metric' => 'total',
            'type' => 'view',
            'ad_id' => $id,
            'from' => time(),
//                'ad_slide_id' => null
        );
        $res = $stats_calc->get_all_time( $query_views );//slow without premium cache
        $view_restriction_ok = $res[0]->data < $ad_restrictions['max_views'];

        $query_clicks = array(
            'history' => 'all_time',
            'metric' => 'total',
            'type' => 'click',
            'ad_id' => $id,
            'from' => time(),
//                'ad_slide_id' => null
        );
        $res = $stats_calc->get_all_time( $query_clicks ); //slow without premium cache
        $click_restriction_ok = $res[0]->data  < $ad_restrictions['max_clicks'];

        return $runtime_restriction_ok
            && $view_restriction_ok
            && $click_restriction_ok
            && $weekday_ok;
    }

    public static function group_restrictions_fulfilled($id){
        require_once dirname( __FILE__ ) . '/../includes/class-ultimate-ads-manager-statistics-calculator.php';
        $stats_calc = new Statistics_Calculator();
        $restrictions = get_post_meta($id, 'restrictions', true);
//        $ad_ids = get_post_meta($id, 'ad_group', true);
        $ad_ids = Ultimate_Ads_Manager_Place::get_ads_of_group($id);
//            $ad_restrictions = apply_filters('codeneric/uam/normalize_restrictions', $ad_restrictions);
        $restrictions = Ultimate_Ads_Manager_Place::normalize_restrictions($restrictions);

        $now = time();
        $weekday = date("l");
        $runtime_restriction_ok = $restrictions['start'] <= $now
            && $now <= $restrictions['end'];
        $weekday_ok = in_array($weekday, $restrictions['weekdays']);

        if(!$runtime_restriction_ok || !$weekday_ok)
            return false;

        $total_views = 0;
        foreach ($ad_ids as $ad_id){
            $query_views = array(
                'history' => 'all_time',
                'metric' => 'total',
                'type' => 'view',
                'ad_id' => $ad_id,
                'from' => time(),
//                'ad_slide_id' => null
                );
            $res = $stats_calc->get_all_time( $query_views );
            $total_views += $res[0]->data; //slow without premium cache
            $view_restriction_ok = $total_views < $restrictions['max_views'];
            if(!$view_restriction_ok)
                return false;
        }

        $total_clicks = 0;
        foreach ($ad_ids as $ad_id){
            $query_clicks = array(
                'history' => 'all_time',
                'metric' => 'total',
                'type' => 'click',
                'ad_id' => $ad_id,
                'from' => time(),
//                'ad_slide_id' => null
            );
            $res = $stats_calc->get_all_time( $query_clicks );
            $total_clicks +=  $res[0]->data;//slow without premium cache
            $click_restriction_ok = $total_clicks < $restrictions['max_clicks'];
            if(!$click_restriction_ok)
                return false;
        }
        return true;
    }

    public static function get_best_candidates($place_id){
        $valid_candidates = Ultimate_Ads_Manager_Place::get_valid_candidates($place_id);
        $place_categories = wp_get_post_categories( $place_id );
        $best_candidates = array();
        foreach ($valid_candidates as $id){
            $candidate_categories = wp_get_post_categories( $id );
            $intersec = array_intersect($candidate_categories, $place_categories);
            if(count($intersec) > 0){
                $best_candidates[] = $id;
            }
        }

        if(count($best_candidates) > 0){ //candidates which fit the categories are better
            return $best_candidates;
        }
        // however, the valid ones will do too if there are no of desired category
        return $valid_candidates;
    }

    public static function after_save_ad($ad_id, $ad){
        global $cc_uam_config;
        $args        = array(
            'posts_per_page' => - 1,
            'post_type'      => $cc_uam_config['place_slug'],
            'post_status'    => 'publish'
            //'suppress_filters' => true
        );

        $places = get_posts( $args );
        foreach ($places as $place){
            $compatible = Ultimate_Ads_Manager_Place::ad_is_compatible_with_place($ad_id, $place->ID);
            if($compatible){
                Ultimate_Ads_Manager_Place::add_candidate_to_place($ad_id, $place->ID);
            }else{
                Ultimate_Ads_Manager_Place::remove_candidates_from_place($ad_id, $place->ID);
            }
        }
    }

    public static function after_save_group($group_id){
        global $cc_uam_config;
//        $ad_group = Ultimate_Ads_Manager_Place::get_ads_of_group($group_id);
        $args        = array(
            'posts_per_page' => - 1,
            'post_type'      => $cc_uam_config['place_slug'],
            'post_status'    => 'publish'
            //'suppress_filters' => true
        );

//        Ultimate_Ads_Manager_Place::remove_candidates_from_all_places($ad_group);
        $places = get_posts( $args );
//        foreach ($places as $place){
//            $compatible = Ultimate_Ads_Manager_Place::group_is_compatible_with_place($group_id, $place->ID);
//            if($compatible){
//                Ultimate_Ads_Manager_Place::add_candidate_to_place($group_id, $place->ID);
//            }else{
//                Ultimate_Ads_Manager_Place::remove_candidates_from_place($group_id, $place->ID);
//            }
//        }


        foreach ($places as $place){ //TODO: this is quite inefficient
            Ultimate_Ads_Manager_Place::update_place($place->ID);
        }

    }

    public static function update_place($place_id){
        global $cc_uam_config;
        $args        = array(
            'posts_per_page' => - 1,
            'post_type'      => $cc_uam_config['custom_post_slug'],
            'post_status'    => 'publish'
            //'suppress_filters' => true
        );

        Ultimate_Ads_Manager_Place::remove_all_candidates_from_place($place_id);

        $ads = get_posts( $args );
        foreach ($ads as $ad){
            $compatible = Ultimate_Ads_Manager_Place::ad_is_compatible_with_place($ad->ID, $place_id);
            if($compatible){
                Ultimate_Ads_Manager_Place::add_candidate_to_place($ad->ID, $place_id);
            }else{
                Ultimate_Ads_Manager_Place::remove_candidates_from_place($ad->ID, $place_id);
            }
        }

        $args        = array(
            'posts_per_page' => - 1,
            'post_type'      => $cc_uam_config['group_slug'],
            'post_status'    => 'publish'
            //'suppress_filters' => true
        );

        $groups = get_posts( $args );
        foreach ($groups as $group){
//            $ad_group = get_post_meta($group->ID, 'ad_group', true);
            $ad_group = Ultimate_Ads_Manager_Place::get_ads_of_group($group->ID);
            Ultimate_Ads_Manager_Place::remove_candidates_from_place($ad_group, $place_id);
            $compatible = Ultimate_Ads_Manager_Place::group_is_compatible_with_place($group->ID, $place_id);
            if($compatible){
                Ultimate_Ads_Manager_Place::add_candidate_to_place($group->ID, $place_id);
            }else{
                Ultimate_Ads_Manager_Place::remove_candidates_from_place($group->ID, $place_id);
            }
        }
    }

    private static function ad_is_compatible_with_place($ad_id, $place_id){
        $ad = get_post_meta($ad_id, 'ad', true);
        $ad_forms = isset($ad['forms']) ? $ad['forms'] : array();
        $forms = get_post_meta($place_id, 'forms', true);
        $forms = isset($forms) ? $forms : array();
        $compatible = count(array_intersect($forms, $ad_forms)) > 0;
        return $compatible;
    }

    private static function group_is_compatible_with_place($group_id, $place_id){
        //we require only one ad to be compatible
//        $ad_ids = get_post_meta($group_id, 'ad_group', true);
        $ad_ids = Ultimate_Ads_Manager_Place::get_ads_of_group($group_id);
        foreach ($ad_ids as $ad_id){
            $compatible = Ultimate_Ads_Manager_Place::ad_is_compatible_with_place($ad_id, $place_id);
            if($compatible)
                return true;
        }
        return false;
    }

    public static function remove_candidates_from_all_places($ids){
        global $cc_uam_config;
        $args        = array(
            'posts_per_page' => - 1,
            'post_type'      => $cc_uam_config['place_slug'],
            'post_status'    => 'publish'
            //'suppress_filters' => true
        );
        $places = get_posts( $args );
        foreach ($places as $place) {
            Ultimate_Ads_Manager_Place::remove_candidates_from_place($ids, $place->ID);
        }

    }

    private static function remove_all_candidates_from_place($place_id){
        update_post_meta($place_id, 'candidates', array());
    }

    private static function remove_candidates_from_place($candidate_ids, $place_id){
        $candidate_ids = is_array($candidate_ids) ? $candidate_ids : array($candidate_ids);
        $candidates = get_post_meta($place_id, 'candidates', true);
        $candidates = isset($candidates) ? $candidates : array();
        $number_of_ads = count($candidates);

        $candidates = array_values(array_diff( $candidates, $candidate_ids ));

        if($number_of_ads !== count($candidates)){ //performance reasons
            update_post_meta($place_id, 'candidates', $candidates);
        }
    }

    private static function add_candidate_to_place($candidate_id, $place_id){
        $candidates = get_post_meta($place_id, 'candidates', true);
        $candidates = isset($candidates) ? $candidates : array();

        if(!in_array($candidate_id, $candidates)){
            $candidates[] = $candidate_id;
            update_post_meta($place_id, 'candidates', $candidates);
        }
    }

    public static function normalize_restrictions($r){
        $r = isset($r) ? $r : array();
        $r = is_array($r) ? $r : array();

        $r['start'] = isset($r['start']) ? $r['start'] : 0;
        $r['start'] = is_numeric($r['start']) ? $r['start'] : 0;

        $m_int = 2147483647;
        $r['end'] = isset($r['end']) ? $r['end'] : $m_int; //max int
        $r['end'] = is_numeric($r['end']) ? $r['end'] : $m_int; //max int

        $wdays= array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
        $r['weekdays'] = isset($r['weekdays']) ? $r['weekdays'] : $wdays;
        $r['weekdays'] = is_array($r['weekdays']) ? $r['weekdays'] : $wdays;

        $r['max_clicks'] = isset($r['max_clicks']) ? $r['max_clicks'] : $m_int; //max int
        $r['max_clicks'] = is_numeric($r['max_clicks']) ? intval($r['max_clicks']) : $m_int; //max int

        $r['max_views'] = isset($r['max_views']) ? $r['max_views'] : $m_int; //max int
        $r['max_views'] = is_numeric($r['max_views']) ? intval($r['max_views']) : $m_int; //max int

        //TEST START
//        $r['max_views'] = 60;
        //TEST END

        return $r;

    }

    private static function get_ads_of_group($group_id){
        require_once dirname( __FILE__ ) . '/group.php';
        return Ultimate_Ads_Manager_Group::get_ads($group_id);
    }

    public static function after_candidate_deleted($id){
        global $cc_uam_config;
        $post_type = get_post_type($id);
        if($post_type === $cc_uam_config['custom_post_slug'] ){
            Ultimate_Ads_Manager_Place::remove_candidates_from_all_places($id);
        }

        if($post_type ===  $cc_uam_config['group_slug']){

        }
    }

    public static function choose_candidate($candidates){
        shuffle($candidates);
        $not_choosen_candidates = array_values(array_diff( $candidates, self::$choosen_candidates ));
        if(count($not_choosen_candidates) > 0)
            $candidate = $not_choosen_candidates[0];
        else
            $candidate = $candidates[0];
        self::$choosen_candidates[] = $candidate;
        return $candidate;
    }
}