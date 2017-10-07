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


function codeneric_ad_manager_meta($post ) {
    global $cc_uam_config;

    /***
     *
     *  get meta data and merge with default data
     *
     */
    //TODO: rebase this into a class (for reference, see Ultimate_Ads_Manager_Settings::load_settings)
    //TODO: gather all field names in an array rather than plain text
//    $meta = (array) get_post_meta( $post->ID , 'ad' ,true);
//    $default_meta = array(
//        "traffic_percentage" => 100,
//        "referral_url"  => '',
//        "images" => array(),
//        'snippet' => ''
//    );
//    $meta =  array_merge( $default_meta, $meta );
//
//
//
//
//
//
//    $uam_images = array();
//
//    foreach ($meta['images'] as $id => $img) {
//        $std = new stdClass();
//        $std->id = $id;
//        $std->url = $img['url'];
//        $std->title = $img['title'];
//        array_push($uam_images,$std);
//    }


    /***
     *
     *  WP nonce validation
     */
    wp_nonce_field($cc_uam_config['wp_nonce_base'], $cc_uam_config['wp_nonce_base'].'_nonce');



    ?>

    <style>
        /* hide the permalink bar under title since it doesnt make sense for ads  */
        #edit-slug-box {
            display:none;
        }
    </style>
    <div id="cc_uam_edit_post_app">
        <div style="background:url('images/spinner.gif') no-repeat;background-size: 20px 20px;vertical-align: middle;margin: 0 auto;height: 20px;width: 20px;display:block;"></div>
    </div>


<!--    <table class="form-table">-->
<!--        <tbody>-->
<!--        <tr>-->
<!--            <th scope="row">--><?php //echo __('Advertisement image'); ?><!--</th>-->
<!--            <td>-->
<!--               <div id="uam-admin-img-upload"></div>-->
<!---->
<!--            </td>-->
<!--        </tr>-->
<!---->
<!--        <tr>-->
<!--            <th scope="row">--><?php //echo __('Referral URL'); ?><!--</th>-->
<!--            <td>-->
<!--                <input  class="widefat" type="url" name="ad[referral_url]" value="--><?php //echo $meta['referral_url']; ?><!--"  required="required">-->
<!--            </td>-->
<!--        </tr>-->
<!--        </tbody>-->
<!--    </table>-->



    <?php
}