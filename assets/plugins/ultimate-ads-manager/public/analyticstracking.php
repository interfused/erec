<?php
/**
 * Created by PhpStorm.
 * User: denis_000
 * Date: 30.01.2016
 * Time: 14:21
 */
function codeneric_uam_append_ga_tracking_code(){
    global $cc_uam_config;
    $settings = get_option( $cc_uam_config['general_settings_key'], array() );
    $ga_tracking_code = isset($settings['ga_tracking_id']) ? $settings['ga_tracking_id'] : null;

    if(isset($ga_tracking_code)) {
        ?>
        <script>
            (function (i, s, o, g, r, a, m) {
                i['GoogleAnalyticsObject'] = r;
                i[r] = i[r] || function () {
                        (i[r].q = i[r].q || []).push(arguments)
                    }, i[r].l = 1 * new Date();
                a = s.createElement(o),
                    m = s.getElementsByTagName(o)[0];
                a.async = 1;
                a.src = g;
                m.parentNode.insertBefore(a, m)
            })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'codeneric_uam_ga');

            codeneric_uam_ga('create', '<?php echo $ga_tracking_code; ?>', 'auto');
            //codeneric_uam_ga('send', 'pageview');

        </script>
        <?php
    }
}
