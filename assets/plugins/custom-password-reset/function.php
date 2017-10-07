<?php
/*
* Plugin Name: Custom Password Reset
* Description: Custom Password Reset.
* Version: 1.0
* Author: 
* Author URI: http://www.xtreemsolution.com
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;



add_action('wp_enqueue_scripts','custom_password_reset_enqueue');
function custom_password_reset_enqueue(){

    $plugin_url = plugin_dir_url( __FILE__ );

    wp_enqueue_script("jquery-show-ui-js",$plugin_url.'js/jquery-ui.min.js',array("jquery"),'1.0.0' );
 
    wp_enqueue_script('password_reset', $plugin_url.'js/script.js',array("jquery-show-ui-js"), '1.0.0' );

    $data1 = array( 'ajaxurl'=>  admin_url('/admin-ajax.php') );
    wp_localize_script( 'password_reset', 'ajax_url', $data1 );
}


/*...........Password Reset aJax Action................*/

add_action( 'wp_ajax_nopriv_custom_password_reset1', 'custom_password_reset1' );
add_action('wp_ajax_custom_password_reset1', 'custom_password_reset1');
function custom_password_reset1(){

    /*$return = array('');
    $return['status'] = 'error';
    die(json_encode($return));*/



   if ( isset($_POST['user_login']) ) {
       
       if ( strpos( $_POST['user_login'], '@' ) ) {
            $user_data = get_user_by( 'email', trim( $_POST['user_login'] ) );
            if ( empty( $user_data ) ){
                $return['status'] = 'error';
                die( json_encode($return) );
            }
        }
        else {
            $login = trim( $_POST['user_login'] );
            $user_data = get_user_by( 'login', $login );
        }

        if ( ! $user_data ) {
            $return['status'] = 'error';
            die( json_encode($return) );
        }
        else{
            $user_status = get_user_meta($user_data->ID, 'pw_user_status', true);
            if ( $user_status == 'pending' ) {
                $return['status'] = 'pending';
                die( json_encode($return) );
            }
            elseif( $user_status == 'denied' ){
                $return['status'] = 'denied';
                die( json_encode($return) );
            }
            else{
           
                $user_email = $user_data->user_email;
                if ( email_exists($user_email) ) {
                    $key = get_password_reset_key( $user_data );
                    $user_name = $user_data->user_login;
                    $display_name = $user_data->first_name.' '.$user_data->last_name;

                    $resetlink = site_url('/resetpass/').'?key='. $key .'&login='.$user_name ;

                    $cpr_password_reset_array = get_option('cpr_password_reset');

                    if ( isset( $cpr_password_reset_array['passreset_subject'] ) ) {
                        $subject =  $cpr_password_reset_array['passreset_subject'];
                    }
                    else{
                        $subject = '[Eye Recruit] Password reset link';
                    }

                    if ( isset( $cpr_password_reset_array['passreset_mail_template'] ) ) {
                        
                        $mal_temp =  $cpr_password_reset_array['passreset_mail_template'];
                        $shortcode_arry = array('[user_name]', '[password_reset_link]');
                        $repl_shortcode_arry = array($display_name, $resetlink);

                        $message = str_replace($shortcode_arry, $repl_shortcode_arry, $mal_temp);
                    }
                    else{
                        $message = $resetlink;
                    }

                    $headers = "MIME-Version: 1.0" . "\r\n";
                    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    
                    if( wp_mail($user_email, $subject, $message, $headers) ){
                        global $wpdb;
                        $user_id = $user_data->ID;
                        $wpdb->insert(
                            $wpdb->prefix.'user_activity_log',
                            array(
                                'user_id'  => $user_id,
                                'action'   => 'password reset',
                                'datetime' => time(),
                                'meta'     => 'Password Reset > Request for password reset'
                            ),
                            array( '%d', '%s', '%s', '%s' )
                        );

                        $emailfirst = substr($user_email, 0, 1); 
                        $emailtext = substr($user_email, strpos($user_email, "@"));    

                        $return['user_email'] = $emailfirst.'....'.$emailtext;
                        $return['status'] = 'success';
                        $return['url'] = site_url('/login/');
                    }
                    else{
                         $return['status'] = 'error';
                    }
                    die( json_encode($return) );
                }
                else{
                     $return['status'] = 'error';
                }
            }
        }
    }
    die( json_encode($return) );
}
 

function password_reset_form(){

    if ( !is_user_logged_in() ) {

        ?>
        <div class="loader inner-loader" id="loaders" style="display:none;"></div>
        <form id="custom_pass_reset_form" action="" method="post">
            <p class="">
                <label for="user_login">Please enter your username or e-mail address</label>
                <input type="text" name="user_login" id="user_login" class="form-control" placeholder="Username or E-mail address*" value="" size="20">
            </p>

            <button type="submit" name="pass-submit" id="pass-submit">New Password</span></button>
        </form>

        <?php
    }
    else{
        echo wp_redirect( site_url() );
    }
}
add_shortcode('password_reset_form', 'password_reset_form');







function change_password_form(){

    if ( !is_user_logged_in() ) {

        global $rp_login, $rp_key;

        $rp_cookie = 'wp-resetpass-' . COOKIEHASH;
        if ( isset( $_GET['key'] ) ) {
            $value = sprintf( '%s:%s', wp_unslash( $_GET['login'] ), wp_unslash( $_GET['key'] ) );
            setcookie( $rp_cookie, $value, 0, '/', COOKIE_DOMAIN, is_ssl(), true );
            wp_safe_redirect( remove_query_arg( array( 'key', 'login' ) ) );
            exit;
        }

        if ( isset( $_COOKIE[ $rp_cookie ] ) && 0 < strpos( $_COOKIE[ $rp_cookie ], ':' ) ) {
            list( $rp_login, $rp_key ) = explode( ':', wp_unslash( $_COOKIE[ $rp_cookie ] ), 2 );
            $user = check_password_reset_key( $rp_key, $rp_login );
            if ( isset( $_POST['pass1'] ) && ! hash_equals( $rp_key, $_POST['rp_key'] ) ) {
                $user = false;
            }
        } else {
            $user = false;
        }


        if ( ! $user || is_wp_error( $user ) ) {
            setcookie( $rp_cookie, ' ', time() - YEAR_IN_SECONDS, '/', COOKIE_DOMAIN, is_ssl(), true );
            if ( $user && $user->get_error_code() === 'expired_key' )
                wp_redirect( site_url( '/lostpassword/' ) );
            else
                wp_redirect( site_url( '/lostpassword/' ) );
            exit;
        }



        ?>
        <div class="loader inner-loader" id="loaders" style="display:none;"></div>
        <form autocomplete="off" method="post" action="" id="cus_resetpassform">

            
            <p>
                <label for="pass1">Password</label>
                <input type="password" autocomplete="off" value="" size="20" class="form-control" id="pass1" name="pass1" placeholder="Password*">
            </p>

            <p>
                <label for="pass1">Confirm password</label>
                <input type="password" autocomplete="off" value="" size="20" class="form-control" id="pass2" name="pass2" placeholder="Confirm password*">
            </p>
            
            <button id="chag-pass-submit" class="" name="chag-pass-submit" type="submit">Reset Password</button>
            <input type="hidden" autocomplete="off" value="<?php echo esc_attr( $GLOBALS['rp_login'] ); ?>" id="user_login">
            <input type="hidden" value="<?php echo esc_attr( $GLOBALS['rp_key'] ); ?>" name="rp_key">
        </form>

        <?php
    }
    else{
        echo wp_redirect( site_url() );
    }
}
add_shortcode('change_password_form', 'change_password_form');



/*...........Change Reset aJax Action................*/

add_action('wp_ajax_change_password', 'change_password');
add_action( 'wp_ajax_nopriv_change_password', 'change_password' );
function change_password(){

    $return = array('');

    if ( isset( $_POST['pass'] ) && ! empty( $_POST['pass'] ) && isset( $_POST['user_login'] ) ) {


        $user_data = get_user_by( 'login', $_POST['user_login'] );
        $user_id = $user_data->ID;
        $password = $_POST['pass'];
        wp_set_password( $password, $user_id );


        $user_name = $user_data->user_login;
        $user_email = $user_data->user_email;
        $display_name = $user_data->first_name.' '.$user_data->last_name;
        $login_url = site_url().'/login/';
        $reset_array = get_option('cpr_after_password_reset');

        if ( isset( $reset_array['passreset_subject'] ) ) {
            $subject =  $reset_array['passreset_subject'];
        }
        else{
            $subject = '[Eye Recruit] Password reset link';
        }

        if ( isset( $reset_array['after_passreset_mail_template'] ) ) {
            
            $mal_temp =  $reset_array['after_passreset_mail_template'];
            $shortcode_arry = array('[user_name]', '[login_url]');
            $repl_shortcode_arry = array($display_name, $login_url);

            $message = str_replace($shortcode_arry, $repl_shortcode_arry, $mal_temp);
        }
        else{
            $message = 'Your Password has been updated, please go to '.$login_url.' to log in.';
        }

        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        wp_mail($user_email, $subject, $message, $headers);


        $return['status'] = 'success';
        $return['url'] = site_url('/login/');
        die( json_encode($return) );

    }
    else{
        $return['status'] = 'error';
        die( json_encode($return) );
    }

   $return['status'] = 'error';
   die( json_encode($return) );
}