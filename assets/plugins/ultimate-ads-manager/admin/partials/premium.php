<?php

//add_action( 'admin_menu', 'codeneric_phmm_premium_page' );

class Ultimate_Ads_Manager_Base_Premium
{

    private $plugin_name;
    private $version;
    private $slug;

    private $page_name;
    public function __construct( ) {
        global $cc_uam_config;
        $this->config = $cc_uam_config;
        $this->page_name   = $this->config['p']. 'premium';
        $this->plugin_name = $this->config['plugin_name'];
        $this->version     = $this->config['version'];
        $this->slug        = $this->config['custom_post_slug'];
        $this->display_name        = $this->config['plugin_display_name'];



    }

    public function add_premium_page()
    {

        add_submenu_page('edit.php?post_type='.$this->slug, $this->display_name . ' Premium', __('Premium'), 'manage_options', $this->page_name, array($this, 'render_premium_page'));

    }

    public function render_premium_page()
    {



        ?>
        <div id="premium-modal"></div>
        <script>
            jQuery('#cc_phmm_notice_wrap').hide(); //better remove_action than this
        </script>

        <div class="wrap">
            <div class="postbox">
                <div id="cc-phmm-container" class="inside" style="width: 50%;">
                    <div style="background:url('images/spinner.gif') no-repeat;background-size: 20px 20px;vertical-align: middle;margin: 0 auto;height: 20px;width: 20px;display:block;"></div>
                </div>
            </div>
            <br><br>
        </div>


        <?php
    }

}