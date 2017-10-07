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




function ultimate_ads_manager_statistics_page() {

//    global $cc_uam_config;
//    require_once(dirname(__FILE__).'/subscription-modal.php');
//
//    $a = uam_codeneric_modal();



    ?>

    <div class="wrap">
        <h2><?php echo __('Statistics'); ?></h2>

        <div class="postbox">
            <div class="inside">

                <div id="cc_uam_statistics">
                    <div style="background:url('images/spinner.gif') no-repeat;background-size: 20px 20px;vertical-align: middle;margin: 0 auto;height: 20px;width: 20px;display:block;"></div>
                </div>

            </div>
        </div>


    </div>




    <?php


}