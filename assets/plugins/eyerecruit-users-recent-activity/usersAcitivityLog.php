<?php
/*
Plugin Name: EyeRecruit Users Recent Activity
Description: EyeRecruit Users Recent Activity.
Version: 3.1.1
Author: EyeRecruit
*/


// Create Table for viewed

function create_activity_log_db() {

    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();
    $table_name = $wpdb->prefix . 'user_activity_log';

    $sql = "CREATE TABLE $table_name (
        id int(9) NOT NULL AUTO_INCREMENT,
        user_id int(9) NOT NULL,
        action varchar(2555),
        datetime varchar(2555),
        meta varchar(2555),
        UNIQUE KEY id (id)
    ) $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
}
register_activation_hook( __FILE__, 'create_activity_log_db' );


function create_job_seeker_resume_table() {

    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();
    $table_name = $wpdb->prefix . 'jobseeker_resume';

    $sql = "CREATE TABLE $table_name (
        id int(9) NOT NULL AUTO_INCREMENT,
        user_id int(9) NOT NULL,
        datetime varchar(2555),
        filefullpath varchar(2555),
        file varchar(2555),
        access varchar(2555),
        other varchar(2555),
        UNIQUE KEY id (id)
    ) $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
}
register_activation_hook( __FILE__, 'create_job_seeker_resume_table' );

function reach_out_and_ask_for_referral_table() {

    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();
    $table_name = $wpdb->prefix . 'reach_out_and_ask_for_referral';

    $sql = "CREATE TABLE $table_name (
        id int(9) NOT NULL AUTO_INCREMENT,
        first_name varchar(2555),
        last_name varchar(2555),
        user_email varchar(2555),
        user_message varchar(2555),
        UNIQUE KEY id (id)
    ) $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );

    $your_column = 'user_id'; 
    if(!in_array($your_column, $wpdb->get_col("DESC ". $table_name, 0 ))){  
        $result= $wpdb->query("ALTER TABLE $table_name ADD $your_column int(9) NOT NULL AFTER id");
    }
}
register_activation_hook( __FILE__, 'reach_out_and_ask_for_referral_table' );

// Create Table for viewed
function create_viewed_db() {

    global $wpdb;
    $charset_collate_view = $wpdb->get_charset_collate();
    $table_name = $wpdb->prefix . 'last_view';

    $sql = "CREATE TABLE $table_name (
        id int(9) NOT NULL AUTO_INCREMENT,
        can_id int(9),
        emp_id int(9),
        date_time DEFAULT CURRENT_TIMESTAMP,
        meta_other varchar(2555),
        UNIQUE KEY id (id)
    ) $charset_collate_view;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
}
register_activation_hook( __FILE__, 'create_viewed_db' );

// Create tabel for refrence 
function create_reference_table() {
    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();
    $table_name = $wpdb->prefix . 'reference_now';
    $sql = "CREATE TABLE $table_name (
        id int(9) NOT NULL AUTO_INCREMENT,
        ref_detail LONGTEXT,
        UNIQUE KEY id (id)
    ) $charset_collate;";
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
}
register_activation_hook( __FILE__, 'create_reference_table' );


include('UsersActivityListing.php');




