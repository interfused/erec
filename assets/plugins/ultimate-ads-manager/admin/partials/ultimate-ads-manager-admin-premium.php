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

function codeneric_ad_manager_premium_page() {

    ?>
    <form action='options.php' method='post'>
        <div class="wrap">
            <h1 style="font-weight: 100; margin: 1em 0;">Ultimate Ads Manager</h1>
            <div class="postbox">
                <div class="inside">
                    <div id="cc_uam_premium">
                        <div style="background:url('images/spinner.gif') no-repeat;background-size: 20px 20px;vertical-align: middle;margin: 0 auto;height: 20px;width: 20px;display:block;"></div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <?php
}