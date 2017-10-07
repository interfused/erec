<?php

/**
 * Created by PhpStorm.
 * User: denis_000
 * Date: 20.01.2016
 * Time: 22:20
 */
class Ultimate_Ads_Manager_Base_Randomizer
{


    public static function process_public($ID) {
        global $cc_uam_config;
        $post = get_post($ID, ARRAY_A);

        $post_type = $post['post_type'];

        $ad_id = $ID;
        $meta = null;
        if($post_type === $cc_uam_config['group_slug']){
            $ad_group_ids = get_post_meta( $ID , 'ad_group' ,true);
            $ad_group_ids = is_string($ad_group_ids) ? $ad_group_ids : '';
            $ad_group_ids_array = explode( ",", $ad_group_ids );

            if ( $ad_group_ids == "" ) {
                $ad_group_ids_array = array();
            }
            $temp = array();
            foreach($ad_group_ids_array as $ID){
                if(get_post( $ID ) !== null){
                    $temp[] = $ID;
                }
            }
            $ad_group_ids_array = $temp;
            //update_post_meta( $ID , 'ad_group' ,implode(',', $ad_group_ids_array));


            $r = mt_rand() / mt_getrandmax();
            $bond = 0;
            foreach($ad_group_ids_array as $ID){
                // fake the ad for now where no functioality is there
                $ad = new stdClass();
                $ad->traffic = 1/(count($ad_group_ids_array));

                $ad->ID = $ID;
                //

                if($r <= $ad->traffic + $bond && $meta === null){
                    $meta = get_post_meta( $ad->ID , 'ad' ,true);
                    $meta['post_title'] = get_the_title ( $ad->ID );
                    $ad_id = $ad->ID;
                }
                $bond += $ad->traffic;
            }

        }
        else{
            $meta = get_post_meta( $ID , 'ad' ,true);
            $meta['post_title'] = get_the_title ( $ID );
        }

        return array($ad_id,$meta);
    }


}
