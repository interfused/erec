<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Plugin_Name
 * @subpackage Plugin_Name/admin/partials
 */


function codeneric_ad_manager_meta_group($post ) {
    global $cc_uam_config;

//    $ad_group =  get_post_meta( $post->ID , 'ad_group' ,false);
//
//    $ad_group = empty($ad_group) ? array() : $ad_group[0];
//    foreach ($ad_group as $ad) {
//        $ad->label = get_the_title($ad->ID);
//    }


    /***
     *
     *  WP nonce validation
     */
    wp_nonce_field($cc_uam_config['wp_nonce_base'], $cc_uam_config['wp_nonce_base'].'_nonce');


    ?>


<!--   <div id="uam-group-select-ads"></div>-->

    <div id="cc_uam_edit_post_group_app">
        <div style="background:url('images/spinner.gif') no-repeat;background-size: 20px 20px;vertical-align: middle;margin: 0 auto;height: 20px;width: 20px;display:block;"></div>
    </div>




    <?php
}