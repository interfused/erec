<?php

function codeneric_ad_manager_support_page() {
    global $cc_uam_config;

    ?>
    <style>
        .cc-form-field {
            display: -webkit-box;
            display: -moz-box;
            display: -webkit-flex;
            display: -ms-flexbox;
            display: box;
            display: flex;
            -webkit-box-align: center;
            -moz-box-align: center;
            -o-box-align: center;
            -ms-flex-align: center;
            -webkit-align-items: center;
            align-items: center;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            margin: 1em 0;
            position: relative;
        }
        .cc-form-field .dashicons-yes {
            color: #2ecc40;
        }
        .cc-form-field .dashicons-no {
            color: #d13f19;
        }
        .cc-form-field.column {
            -webkit-box-orient: vertical;
            -moz-box-orient: vertical;
            -o-box-orient: vertical;
            -webkit-flex-direction: column;
            -ms-flex-direction: column;
            flex-direction: column;
            -webkit-box-align: start;
            -moz-box-align: start;
            -o-box-align: start;
            -ms-flex-align: start;
            -webkit-align-items: flex-start;
            align-items: flex-start;
        }
        .cc-form-field label {
            -webkit-flex-basis: 20%;
            flex-basis: 20%;
            font-weight: bold;
        }
        .cc-form-field .cc-form-field-content {
            -webkit-flex-basis: 50%;
            flex-basis: 50%;
        }
        .cc-form-field .cc-form-field-content input {
            width: 100%;
        }
        .cc-form-field input[readonly] {
            background-color: transparent;
            border: none;
            outline: none;
            box-shadow: none;
            font-weight: bold;
            margin-left: 0;
            padding-left: 0;
        }
        .cc-form-field input:-webkit-autofill {
            background-color: #fff !important;
        }
        .cc-form-field input:not([type="checkbox"]) {
            -webkit-flex-basis: 50;
            flex-basis: 50;
        }
        .cc-form-field input.invalid {
            border-color: #d13f19 !important;
            box-shadow: 0 0 2px rgba(209,63,25,0.8) !important;
        }
        .cc-form-field textarea {
            -webkit-flex-basis: 50%;
            flex-basis: 50%;
        }

    </style>

        <div class="wrap">

            <?php if(isset($_GET['is_send']) && $_GET['is_send'] == 'true'): ?>
            <div class="updated highlight">
                <h4><?php _e('The feedback has been sent successfully. Thank you!', $cc_uam_config['text_domain']); ?></h4>
            </div>
            <?php endif; ?>
            <?php if(isset($_GET['is_send']) && $_GET['is_send'] == 'false'): ?>
                <div class="error highlight">
                    <h4><?php _e('Ups, something went wrong. Please try to resubmit your feedback.', $cc_uam_config['text_domain']); ?></h4>
                    <p><?php _e('You can also contact us directly', $cc_uam_config['text_domain']); ?>: <a href="mailto:support@codeneric.com">support@codeneric.com</a></p>
                </div>
            <?php endif; ?>
             <form name="feedback_form" id="feedback_form" action="<?php echo admin_url('admin-ajax.php'); ?>" method="post" >

             <h1 style="font-weight: 100; margin: 1em 0;">Ultimate Ads Manager</h1>
            <div class="postbox">
                <div class="inside" style="width: 50%;">
                    <h2>Support</h2>
<!--                    <strong>If you encounter a problem, please <a style="color: coral" target="_blank" href="//phmm.codeneric.com">visit the official photography management website</a> for the FAQ first.</strong>-->

                    <p><?php _e('If you notice any bugs, have any questions regarding the plugin or want to suggest new features, please do so in the form', $cc_uam_config['text_domain']); ?></p>
                    <h4><?php _e('We will answer you as soon as possible!', $cc_uam_config['text_domain']); ?></h4>
                        <div class="cc-form-field">
                            <label for="support[email]">Email</label>
                            <input placeholder="Subject"  type="email" name="support[email]" value="<?php  echo get_option('admin_email'); ?>" required/>
                        </div>
                        <div class="cc-form-field">
                            <label for="support[subject]">Subject</label>
                            <input placeholder="Subject" type="text" name="support[subject]" required/>
                        </div>
                        <div class="cc-form-field">
                            <label>Message</label>
                            <textarea placeholder="Your message" name="support[content]"  cols="30" rows="10" required></textarea>
                        </div>
                        <input type="submit" name="publish" class="button button-primary" value="Send feedback" accesskey="s">

                        <?php wp_nonce_field('cc_send_feedback','cc_send_feedback_nonce'); ?>
                        <input name="action" value="codeneric_uam_send_feedback" type="hidden">



<!--                    <a target="_blank" href="//wordpress.org/support/plugin/photography-management">Photography Management Plugin Support Site</a>-->


            <hr style="margin-top:3em;">

            <?php
            global $cc_uam_config;
            $admin_edit_url = admin_url( 'edit.php' );


            ?>

            <style>
                a {
                    color: coral;
                }

            </style>


            <h3><?php _e('Usage guide', $cc_uam_config['text_domain']); ?></h3>
            <ol>

                <li><?php
                    $url = add_query_arg( 'post_type', $cc_uam_config['custom_post_slug'], $admin_edit_url );
                    $s0 = "<a target=\"_blank\" href=\"$url\">";
                    $s1 = "</a>";
                    echo sprintf(__("First, %s create %s one or more ads.", $cc_uam_config['text_domain']), $s0, $s1);


                    ?>
                </li>
                <li>
                    You can (but don't need to) group your ads by creating <a target="_blank"
                                                                              href="<?php echo add_query_arg( 'post_type', $cc_uam_config['custom_post_slug'] . '_group', $admin_edit_url ); ?>">ad
                        groups</a>.
                    This is useful if you want to rotate ads at the same spot.
                </li>
                <li>
                    Now everything is set up to display your ads. You have three options here:
                    <ol>
                        <li>
                            <h4>Widgets</h4>

                            <p>
                                A very simple method is to add the Ultimate Ads Manager widget into your sidebar.
                                To do so, <a target="_blank" href="<?php echo admin_url( 'widgets.php' ); ?>">visit
                                    the widget page</a> and find the <strong>Ultimate Ads Widget</strong> under <em>Available
                                    Widgets</em>.
                                <br> You can drag and drop this widget into a specific widget area as you would with
                                any other widget.
                            </p>

                        </li>
                        <li>
                            <h4>Shortcodes</h4>

                            <p>
                                Absolute control over the position of your ad is available via shortcodes.<br>
                                A shortcode is a WordPress-specific code that lets you display plugin content with
                                little effort.
                                For the Ultimate Ads Manager plugin, the shortcodes look like this:
                            <pre>[uam_ad id="1"]</pre>
                            <a target="_blank" href="<?php echo add_query_arg( array('post_type' => $cc_uam_config['custom_post_slug']), $admin_edit_url ); ?>">Go to the ads overview</a> and you will see a column <em>shortcodes</em>,
                            where the specific shortcode for every ad is listed.
                            <a target="_blank"
                               href="<?php echo add_query_arg( 'post_type', $cc_uam_config['custom_post_slug'] . '_group', $admin_edit_url ); ?>">Ad
                                groups</a> also have shortcodes.
                            <br>
                            All you have to do is to copy this code and paste it anywhere in your page via the <a
                                target="_blank"
                                href="<?php echo add_query_arg( array('post_type' => 'page'), $admin_edit_url ); ?>">Page editor</a>.
                            The ad will then appear in the position you have defined.
                            </p>

                        </li>
                        <li>
                            <h4>Places</h4>
                            <p>
                                Places are abstract objects which represent a location (or place) on your website.
                                The shortcode of a place looks like this:
                            <pre>[uam_place id="1"]</pre>
                            Insert it anywhere on your website and it will intelligently choose good advert candidates
                            to display at this place. Please refer to the official <a target="_blank" href="https://uam.codeneric.com">Ultimate Ads Manager website</a> for more information.
                            </p>
                        </li>
                    </ol>
                </li>

                <li>Go to <a target="_blank" href="<?php echo add_query_arg( array('post_type' => $cc_uam_config['custom_post_slug'], 'page' => 'statistics'), $admin_edit_url ); ?>">statistics</a> to see what happened on your site.</li>
            </ol>

            <strong>If you have problems or questions, please contact us using the form above.</a></strong>
                </div>
                </div>
             </form>

        </div>


    <?php
}