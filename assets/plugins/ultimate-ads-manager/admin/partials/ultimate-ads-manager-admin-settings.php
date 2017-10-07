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

function codeneric_ad_manager_settings_page() {

    ?>
    <form action='options.php' method='post'>
        <div class="wrap">
            <h1 style="font-weight: 100; margin: 1em 0;">Ultimate Ads Manager</h1>
            <div class="postbox">
                <div class="inside">
                    <div id="cc_uam_settings">
                        <div style="background:url('images/spinner.gif') no-repeat;background-size: 20px 20px;vertical-align: middle;margin: 0 auto;height: 20px;width: 20px;display:block;"></div>
                    </div>
                    <?php settings_fields( 'codeneric_ad_general_settings' ); ?>
                    <?php //do_settings_sections( 'codeneric_ad_general_settings' ); ?>
                    <?php //submit_button(); ?>
                </div>
            </div>
        </div>
    </form>

    <?php
}