<?php
/**
 * Created by PhpStorm.
 * User: denis_000
 * Date: 01.06.2015
 * Time: 17:43
 */

function codeneric_uam_subscription_modal(){
    global $cc_uam_config;
    add_thickbox();
    ?>


    <a href="#TB_inline?height=521&width=783&inlineId=modal-window-id" id="modal-win-link" class="thickbox hidden"
       title="Go Premium"></a>


    <div id="modal-window-id" style="display:none;">
        <h3>Trusted and used by hundreds of website owners around the globe.</h3>

        <p>You need the full version of the Ultimate Ads Manager plugin for unlimited usage.</p>

        <p>It costs only <strong>9 USD per month</strong>.
        </p>
        <p>The subscription permits you to use the Ultimate Ads Manager on one wordpress instance
            and can be <strong>canceled any time</strong>. </p>
        <p>
            <small>Support: support@codeneric.com</small>
        </p>
        <div style="float: none; vertical-align: text-bottom;" id="cc-premium-spinner" class="spinner"></div>
        <script async="async" src="https://www.paypalobjects.com/js/external/paypal-button.min.js?merchant=elance@codeneric.com"
                data-button="subscribe"
                data-name="Ultimate Ads Manager"
                data-amount="9"
                data-recurrence="1"
                data-period="M"
                data-callback="<?php echo $cc_uam_config['wpps_url']; ?>/paypal/pay"
                data-env=""
                data-src="1"
                data-no_shipping="1"
                data-custom="<?php echo get_option($cc_uam_config['plugin_id_option']); ?>"
            <?php
            function isSecure()
            {
                return
                    (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
                    || $_SERVER['SERVER_PORT'] == 443;
            }

            $return_url = "$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            $return_url = isSecure() ? "https://$return_url" : "http://$return_url";
            $return_url = add_query_arg('paid', 'yes', $return_url);

            ?>
                data-return="<?php echo $return_url; ?>"
            ></script>
    </div>

    <?php
}

function codeneric_uam_purchase_modal(){
    global $cc_uam_config;
    add_thickbox();
    ?>


    <a href="#TB_inline?height=521&width=783&inlineId=modal-window-id" id="modal-win-link" class="thickbox hidden"
       title="Go Premium"></a>


    <div id="modal-window-id" style="display:none;">
        <h3>Trusted and used by hundreds of website owners around the globe.</h3>

        <p>You need the full version of the Ultimate Ads Manager plugin for unlimited usage.</p>

        <p>It costs only <strong>19 USD</strong>.
        </p>
        <p>The purchase permits you to use the Ultimate Ads Manager on one wordpress instance
            and install all premium updates which are released within 6 months. </p>
        <p>
            <small>Support: support@codeneric.com</small>
        </p>
        <div style="float: none; vertical-align: text-bottom;" id="cc-premium-spinner" class="spinner"></div>
        <script async="async" src="https://www.paypalobjects.com/js/external/paypal-button.min.js?merchant=elance@codeneric.com"
                data-button="buynow"
                data-amount="19"
                data-shipping="0"
                data-tax="0"
                data-name="Ultimate Ads Manager"
                data-callback="<?php echo $cc_uam_config['wpps_url']; ?>/paypal/pay"
                data-env=""
                data-custom="<?php echo get_option($cc_uam_config['plugin_id_option']); ?>"
            <?php
            function isSecure()
            {
                return
                    (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
                    || $_SERVER['SERVER_PORT'] == 443;
            }

            $return_url = "$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            $return_url = isSecure() ? "https://$return_url" : "http://$return_url";
            $return_url = add_query_arg('paid', 'yes', $return_url);

            ?>
                data-return="<?php echo $return_url; ?>"
            ></script>
    </div>

    <?php
}

function uam_codeneric_modal()
{
    global $cc_uam_config;
    $uuid = get_option('codeneric_uam_uuid', '');

    $num = 0;
    for($i=0; $i<strlen($uuid); $i++ )
        $num += ord($uuid[$i]);

    if($num % 3 <= 1)
        codeneric_uam_purchase_modal();
    else
        codeneric_uam_subscription_modal();

    /*
                Hello, fellow developer!

				Apparently, you really want to see this part of our plugin.
				This is where we set the expiration date for the payment.
				If you can not afford the plugin any longer, feel free to hack this part.
				However, we are working hard to deliver this awesome product, so please consider to subscribe as soon as you can.

				Best,
				Ultimate Ads Plugin Team
    */

    if(get_option( '_site_transint_timeout_browser_a7cef1c8465454dd4238b5bc2f2e819', 0) < time() ){
        //Expired! Ask server if user has paid for the next month...

        $res = wp_remote_get( $cc_uam_config['wpps_url']."/paid?plugin_id=$uuid" );
        $wpps = $cc_uam_config['wpps_url'];
        //print_r($res['response']);
        if(empty($res) || is_wp_error($res))return false;//server down
        if($res['response']['code'] !== 200 ){

            echo "<script>document.addEventListener('DOMContentLoaded',function(){
                        jQuery('button.paypal-button').on('click',function(e){
                            jQuery.get('$wpps/event/1.0?plugin_id=$uuid&type=purchase-modal-clicked');
                        });
                        document.getElementById('modal-win-link').click();});

                        jQuery.get('$wpps/event/1.0?plugin_id=$uuid&type=subscription-modal-shown');

                  </script>";
            return true;
        }else{
            update_option( '_site_transint_timeout_browser_a7cef1c8465454dd4238b5bc2f2e819', time() + 60 * 60 * 24 * 33);
        }

    }

    return false;
}