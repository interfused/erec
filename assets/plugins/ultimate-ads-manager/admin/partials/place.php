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


function codeneric_ad_manager_place($post ) {
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

    $forms = get_post_meta($post->ID, 'forms', true);
    $forms = is_array($forms) ? $forms : array();

    ?>


<!--   <div id="uam-group-select-ads"></div>-->

    <div>

        <p><?php _e('Shortcode', $cc_uam_config['text_domain']); ?>: [uam_place id="<?php echo $post->ID; ?>"]</p>
        <p><?php _e('Supported forms', $cc_uam_config['text_domain']); ?>:
            <ul>
            <?php
            foreach ($cc_uam_config['forms'] as $key => $dim){
                $value = in_array($key, $forms);
                $checked_html = checked($value, true, false);

                echo "<li>$key: <input name='forms[$key]' type=\"checkbox\" $checked_html ></li>";
            }
            ?>
        </ul>
    </div>




    <?php
}