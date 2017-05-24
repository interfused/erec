<?php
///
/*
function er_newuser_reg_admin_alert( $user_id ) {
    $user    = get_userdata( $user_id );
    $email   = $user->user_email;
    $message = $email . ' has registered to your website.';
    wp_mail( 'jeremy@interfused-inc.com', 'New User registration', $message );
}
add_action('user_register', 'er_newuser_reg_admin_alert');
*/