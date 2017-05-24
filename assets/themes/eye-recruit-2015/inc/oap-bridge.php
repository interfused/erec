<?php

/*
actionMode=initialSeekerReg&email=[Email]&fname=[First Name]&lname=[Last Name]&pw=[*48.43.2.password]
*/


/*
//$wp_dir='wp-content';
$wp_dir='assets';
$parse_uri = explode( $wp_dir, $_SERVER['SCRIPT_FILENAME'] );
require_once( $parse_uri[0] . 'wp-load.php' );
*/
include('../../../../wp-load.php');
header("HTTP/1.0 200 OK");
//mail('jeremy@interfused-inc.com','debugging script','yes initally goes through checkpoint');
/*
$_POST['email']='bogus234@interfused-inc.com';
$_POST['fname']='Jeremytest';
$_POST['lname']='TestingOnly';
$_POST['pw']=='whosyginger';
$_POST['actionMode']='initialSeekerReg';
*/
extract($_POST);


$msg = print_r($_POST,true);
mail('jeremy@interfusedcreative.com','try to bridge programmatically',$msg);

/*
if($_SERVER['REQUEST_METHOD'] != 'POST' ){
	mail('jeremy@interfusedcreative.com','eyerec problem','attempt to use without post');
	return;
}
*/


/*
POST VARIABLES:
email
fname
lname
actionMode: initialSeekerReg
pw

*/



function updateName($email,$first,$last){
	$user = get_user_by( 'email', $email );
	$user_id = $user->ID;
	update_user_meta($user_id, 'first_name', $first);
	update_user_meta($user_id, 'last_name', $last);
}

function addUserRole($email,$role){
	$user = get_user_by( 'email', $email );
//ROLES MUST BE LOWERCASE
	$user->set_role(strtolower($role));
	/*
	$user_id = $user->ID;
	
	*/
}

if($_POST['actionMode']=='initialSeekerReg'){
	
	$user_id = username_exists( $_POST['email'] );
	if(!$user_id && email_exists($_POST['email']) == false){
		$user_id = wp_create_user( $_POST['email'], $_POST['pw'], $_POST['email'] );
		updateName($_POST['email'],$_POST['fname'],$_POST['lname']);
		addUserRole($_POST['email'],'candidate');
	}
	
}

///////////
if($_POST['actionMode']=='initialEmployerReg'){
	
	$user_id = username_exists( $_POST['email'] );
	if(!$user_id && email_exists($_POST['email']) == false){
		$user_id = wp_create_user( $_POST['email'], $_POST['pw'], $_POST['email'] );
		updateName($_POST['email'],$_POST['fname'],$_POST['lname']);
		addUserRole($_POST['email'],'employer');
	}
	
}

?>