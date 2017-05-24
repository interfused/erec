<?php
/*
LOGIN STYLING
http://codex.wordpress.org/Customizing_the_Login_Form


*/
function is_interfused(){
	/* returns true if interfused */
	
	if(get_current_user_id() == 8){
		return true;
	}else{
		return false;
	}
}
function my_login_stylesheet() {
	//wp_enqueue_script('jquery');
    wp_enqueue_style( 'custom-login', get_stylesheet_directory_uri() . '/style-login.css' );
    wp_enqueue_script( 'custom-login', get_stylesheet_directory_uri() . '/style-login.js' );
}
add_action( 'login_enqueue_scripts', 'my_login_stylesheet' );



/***** HIDE TOP ADMIN BAR FOR NON ADMINS ****/
if (!current_user_can('manage_options')) {
	add_filter('show_admin_bar', '__return_false');
}

/*** CHANGE WORDPRESS LOGIN LOGO LINK ***/
function loginpage_custom_link() {
	return home_url();
}
add_filter('login_headerurl','loginpage_custom_link');


/* CHANGE DEFAULT EMAIL FROM */

/* auto-detect the server so you only have to enter the front/from half of the email address, including the @ sign */
function xyz_filter_wp_mail_from($email){
/* start of code lifted from wordpress core, at http://svn.automattic.com/wordpress/tags/3.4/wp-includes/pluggable.php */
	$sitename = strtolower( $_SERVER['SERVER_NAME'] );
	if ( substr( $sitename, 0, 4 ) == 'www.' ) {
	$sitename = substr( $sitename, 4 );
	}
	/* end of code lifted from wordpress core */
	$myfront = "noreply@";
	$myback = $sitename;
	$myfrom = $myfront . $myback;
	$email = get_option( 'admin_email' );
	return $myfrom;
}
add_filter("wp_mail_from", "xyz_filter_wp_mail_from");

/* enter the full name you want displayed alongside the email address */
/* from http://miloguide.com/filter-hooks/wp_mail_from_name/ */
function xyz_filter_wp_mail_from_name($from_name){
	$site_name = get_option( 'blogname');
return "EyeRecruit";
}
add_filter("wp_mail_from_name", "xyz_filter_wp_mail_from_name");



/* redirect login page 
https://wordpress.org/support/topic/redirect-to-customized-sign-up-form


function custom_submit_job_form_login_url() {
return '/login';
}
add_filter( 'submit_job_form_login_url', 'custom_submit_job_form_login_url' );
*/
/**
 * Jobify - Hide the Role Selector
 */

/**
 * Replace the array of options with only the single
 * option you want.
 * 
 * 'candidate' or 'employer'
*/ 
function custom_register_form_fields( $fields ) {
  //  $fields[ 'info' ][ 'role' ][ 'options' ] = array( 'candidate' => __( 'Candidate' ) );
  
  //ADD TO BEGINNING
  $nameArray = array('first_name' => array(
					'label'       => 'First Name',
					'type'        => 'text',
					'required'    => true,
					'placeholder' => '',
					'priority'    => 1
				));
	
	$fields[ 'creds' ] = array_merge($nameArray, $fields[ 'creds' ]);			
				
    
    return $fields;
}
add_filter( 'register_form_fields', 'custom_register_form_fields' );

function child_add_scripts() {
//    wp_enqueue_style('myscript', get_stylesheet_directory_uri().'/js/myscript.js', array('jquery'), '1.0', 'screen, projection');
	//wp_enqueue_script( 'custom', get_stylesheet_directory_uri() . '/inc/js/custom.js', array('jquery'), false, true);
	
	 wp_register_script(
        'custom',
        get_stylesheet_directory_uri() . '/inc/js/custom.js',
        false,
        '1.0',
        true
    );

    wp_enqueue_script( 'custom' );
}
add_action( 'wp_enqueue_scripts', 'child_add_scripts' );


/**
* remove the register link from the wp-login.php script
*/
add_filter('option_users_can_register', function($value) {
    $script = basename(parse_url($_SERVER['SCRIPT_NAME'], PHP_URL_PATH));
 
    if ($script == 'wp-login.php') {
        $value = false;
    }
 
    return $value;
});


?>