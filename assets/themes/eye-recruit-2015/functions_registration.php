<?php
/*login user */
function ey_login__user(){

	// First check the nonce, if it fails the function will break
   // check_ajax_referer( 'eyerecruitjobseeker', 'security' );
    // Nonce is checked, get the POST data and sign user on
    if(isset($_POST)){
    	
	    $info = array();
	    $info['user_login'] 		= $_POST['email'];
	    $info['user_password']		= $_POST['password'];
	    $info['remember'] 			= $_POST['remember'];
	    if($_POST['remember'] == 'true'){
			setcookie( 'email', $_POST['email'], time()+3600*24*100, COOKIEPATH, COOKIE_DOMAIN, false);
			setcookie( 'pass', $_POST['password'], time()+3600*24*100, COOKIEPATH, COOKIE_DOMAIN, false);
			setcookie( 'rem',$_POST['remember'], time()+3600*24*100, COOKIEPATH, COOKIE_DOMAIN, false);

	    }else{
	    	unset($_COOKIE['email']);
	    	unset($_COOKIE['pass']);
	    	unset($_COOKIE['rem']);
	    	setcookie('email');
	    	setcookie('pass');
	    	setcookie('rem');
	    	//setcookie('first_name', '', time()-300);   
	    }
		$user_signon = wp_signon( $info, false );
	   // print_r($user_signon); die;
	    if ( is_wp_error($user_signon) ){

	    	if(isset($user_signon->errors['pending_approval'][0])){
				$data = json_encode(array('loggedin'=>false, 'message'=>$user_signon->errors['pending_approval'][0]));
				}else{

				$data = json_encode(array('loggedin'=>false, 'message'=>__('Your username and password do not match. Please try again.')));
				}
	       // $data =  json_encode(array('loggedin'=>false, 'message'=>__('Your username and password do not match. Please try again.')));
	   	 } else {
	    	wp_set_auth_cookie($user_signon->ID);
	    	if ( isset($_POST['redirectUrl']) && !empty($_POST['redirectUrl']) )
			{
			    $url =  wp_get_referer();
			}
			else
			{
             	if($user_signon->roles){
		         	if($user_signon->roles[0] == 'employer'){
			    		 $url = site_url().'/employer-dashboard/';

		        	}
		        	elseif($user_signon->roles[0] == 'candidate') {
			    		$url = site_url().'/job-seekers/dashboard/';
		        	}
		        	elseif($user_signon->roles[0] == 'administrator') {
			   			 $url = site_url().'/wp-admin/';
		        	}
		        	else{
			    		 $url = site_url();
		        	}

            	}else{
	       			 $url = site_url();
                }
			}

	        $data = json_encode(array('loggedin'=>true, 'redirect'=>$url,'message'=>__('Login successful, redirecting...')));
	    }

	    echo $data; die();

    }

}
add_action('wp_ajax_login_user', 'ey_login__user');
add_action('wp_ajax_nopriv_login_user', 'ey_login__user');

/* Employers  user login*/

function ey_employers_user(){
    if(isset($_POST)){
	    $info = array();
	    $info['user_login'] 		= $_POST['email'];
	    $info['user_email'] 		= $_POST['email'];
	    $info['first_name'] 		= $_POST['fname'];
	    $info['last_name']			= $_POST['lname'];
	    $info['display_name']		= $_POST['fname'] .''.$_POST['lname'];
		$info['nickname']			= $_POST['fname'];
	    $info['role']				= 'employer';
		if(email_exists( $_POST['email'] )){
	    	$data = json_encode(array('createuser'=>false, 'message'=>__('It seems like your request is already in process. We are reviewing your details and will respond you shortly.')));
	    }else{ 
		    $user_id = wp_insert_user( $info);
		    if ( is_wp_error($user_id) ){
		       $data =  json_encode(array('createuser'=>false, 'message'=>'A data has ocurred'));
		    } else {
		    	update_user_meta( $user_id, 'office_phone', $_POST['office_phone']);
				update_user_meta( $user_id, 'company', $_POST['company']);
				update_user_meta( $user_id, 'ext', $_POST['ext']);
				update_user_meta( $user_id, 'first_name', $_POST['fname']);
				update_user_meta( $user_id, 'last_name', $_POST['lname']);
				update_user_meta( $user_id, 'cell_phone', $_POST['cell_phone'] );
				set_cimyFieldValue($user_id,'PROFILE_VISIBILITY', 'Private');
				$user_password = random_password(6);  
		    	wp_set_password( $user_password, $user_id);
				$subject 			= get_option('founder_options_employer')['employer_subject'];
				$setting_options 	= get_option('xtreem_options_smtp');
				//$to  				= $setting_options['tomail'];
				$to='jeremy@interfused-inc.com';
				$enco_id = multi_base64_encode($user_id);
				$get_started = site_url('/employer-profile-bulider/?rec='.$enco_id) ;

				// Replace shortcode for jobseeker thank you template
				$thanks_employer_subject	= 	get_option('eyerecruit_thanks_employes__options')['subject'];
				$shordcode_to_rep_employer	= 	array('[site-url]','[employer_first_name]','[employer_last_name]','[get_start]','[tmp_pass]','[user_email]');
				$replace_with_employer 		=	array(site_url(),ucfirst($_POST['fname']),ucfirst($_POST['lname']),$get_started,$user_password,$_POST['email']);
				$thanks_employer_message	= 	str_replace($shordcode_to_rep_employer,$replace_with_employer,do_shortcode(get_option('eyerecruit_thanks_employes__options')['eyerecruit_thanks_message']));
				
				// Shortcode replace for emplyer mail template
				
				$shordcode_to_rep 	=	array('[site-url]','[employer_first_name]','[employer_last_name]','[employer_email_shortcode]','[employer_company_shortcode]','[employer_office_phone_shortcode]','[employer_ext_shortcode]','[employer_phone]');
				$replace_with 		= 	array(site_url(),ucfirst($_POST['fname']),ucfirst($_POST['lname']),$_POST['email'],$_POST['company'],$_POST['office_phone'],$_POST['ext'],$_POST['cell_phone']);
				$message 			= 	str_replace($shordcode_to_rep, $replace_with, do_shortcode(get_option('founder_options_employer')['employer_mail_template']));
				$headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
				if(mail($to,$subject,$message,$headers)){
					mail($_POST['email'],$thanks_employer_subject,$thanks_employer_message,$headers);
				}
		       $data =  json_encode(array('createuser'=>true, 'message'=>__('Thank you for connecting us we will contact to you soon')));
		   	}


	    }

	    echo  $data;  die();

    }

}
add_action('wp_ajax_employers_user', 'ey_employers_user');
add_action('wp_ajax_nopriv_employers_user', 'ey_employers_user');



/* Job seeker login  user login*/

function ey_seeker_user(){
	 global $wpdb;
	//First check the nonce, if it fails the function will break
    //check_ajax_referer( 'ajax-login-nonce', 'security' );
    //Nonce is checked, get the POST data and sign user on
    if(isset($_POST)){
	    $info = array();
	    $info['user_login'] 		= $_POST['email'];
	    $info['user_email'] 		= $_POST['email'];
	    $info['first_name'] 		= $_POST['fname'];
	    $info['last_name']			= $_POST['lname'];
	    $info['display_name']		= $_POST['fname'] .''.$_POST['lname'];
		$info['nickname']			= $_POST['fname'];
	    $info['role']				= 'candidate';

	   if(email_exists( $_POST['email'] )){
	    	$data = json_encode(array('createuser'=>false, 'message'=>__('It seems like your request is already in process. We are reviewing your details and will respond you shortly.')));

	    }else{
		   $user_id = wp_insert_user( $info);
		   if ( is_wp_error($user_id) ) {
		        $data = json_encode(array('createuser'=>false, 'message'=>'A data has ocurred'));
		    } else {
		    	update_user_meta( $user_id, 'first_name', $_POST['fname']);
				update_user_meta( $user_id, 'last_name', $_POST['lname']);
		    	update_user_meta( $user_id, 'cell_phone', $_POST['cell_phone'] );
		    	$user_password = random_password(6);  
		    	wp_set_password( $user_password, $user_id);
		    	//add basic plan in membership
		    	 $startdate = date('Y-m-d H:i:s');
		    	$table_name = $wpdb->prefix . "pmpro_memberships_users";
  				//$wpdb->insert($table_name, array('user_id' => $user_id, 'membership_id' => '1','status' => 'active') ); 
		    	// for communiction preferences email notifications
						    	$wpdb->insert(
									$table_name,
						array(
							'user_id'   		=> $user_id,
							'membership_id'     => '1',
							'initial_payment'   => '0.00',
							'status'  			=> 'active',
							'cycle_number'      => '',
							'startdate'         => $startdate
						),
						array(
							'%d','%d','%s', '%s', '%s','%s'
						)
					); 

		    	set_cimyFieldValue($user_id, 'CP_EMAIL_NOTIFY', 'HTML');
		    	

				//for permissions and allowances for employers preferences
				set_cimyFieldValue($user_id, 'PNA_BACK_VERI_REPORT' ,'No');
				set_cimyFieldValue($user_id, 'PNA_CURRENT_EMPLOYER' ,'No');
				set_cimyFieldValue($user_id, 'PNA_LICENSING_DOC' ,'No');
				set_cimyFieldValue($user_id, 'PNA_HONORS_N_AWARDS' ,'Yes');
				set_cimyFieldValue($user_id, 'PNA_PHOTOGRAPH' ,'Yes');
				set_cimyFieldValue($user_id, 'PNA_CERTIFICATIONS' ,'Yes');
				set_cimyFieldValue($user_id, 'PNA_BADGES' ,'Yes');
				set_cimyFieldValue($user_id, 'PNA_REFERRALS' ,'Yes');
				set_cimyFieldValue($user_id, 'PNA_REFERENCED' ,'No');
				set_cimyFieldValue($user_id, 'PNA_EDUCATION' ,'Yes');
				set_cimyFieldValue($user_id, 'PNA_SELF_ASSESSMENTS' ,'Yes');
				set_cimyFieldValue($user_id, 'PNA_CELL_PHONE_NO' ,'No');

				//for permissions and allowances for recruiters preferences

				set_cimyFieldValue($user_id, 'PNAR_BACK_VERI_REP', 'No');
				set_cimyFieldValue($user_id, 'PNAR_CURRENT_EMPLOY', 'Yes');
				set_cimyFieldValue($user_id, 'PNAR_LICENSING_DOC', 'Yes');
				set_cimyFieldValue($user_id, 'PNAR_HONORS_N_AWARD', 'Yes');
				set_cimyFieldValue($user_id, 'PNAR_PHOTOGRAPH', 'Yes');
				set_cimyFieldValue($user_id, 'PNAR_CERTIFICATIONS', 'Yes');
				set_cimyFieldValue($user_id, 'PNAR_BADGES', 'Yes');
				set_cimyFieldValue($user_id, 'PNAR_REFERRALS', 'Yes');
				set_cimyFieldValue($user_id, 'PNAR_REFERENCED', 'Yes');
				set_cimyFieldValue($user_id, 'PNAR_EDUCATION', 'Yes');
				set_cimyFieldValue($user_id, 'PNAR_SELF_ASSESSMENT', 'Yes');
				set_cimyFieldValue($user_id, 'PNAR_CELL_PHONE_NO', 'Yes');
				set_cimyFieldValue($user_id, 'PROFILE_VISIBILITY', 'Private');

		    	$subject 					= get_option('founder_options_jobseeker')['jobseeker_subject'];
				$setting_options 			= get_option('xtreem_options_smtp');
				$thanks_jobseeker_subject	= get_option('founder_options')['subject'];
				
				$enco_id = multi_base64_encode($user_id);

				$get_started = site_url('/profile-builder/?rec='.$enco_id) ;

				// Replace shortcode for jobseeker thank you template
				$shordcode_to_rep_jobseeker	= 	array('[site-url]','[jobseeker_first_name]','[jobseeker_last_name]','[get_start]','[tmp_pass]','[user_email]');
				$replace_with_jobseeker 	=	array(site_url(),ucfirst($_POST['fname']),ucfirst($_POST['lname']),$get_started,$user_password,$_POST['email']);
				$thanks_jobseeker_message	= 	str_replace($shordcode_to_rep_jobseeker,$replace_with_jobseeker,do_shortcode(get_option('founder_options')['thanks_jobseeker_mail_template']));
				
				//$to 				= $setting_options['tomail'];
				$to = 'jeremy@interfused-inc.com';
				// Replace shortcode for jobseeker admin mail template
				$shordcode_to_rep 	= array('[site-url]','[jobseeker_first_name]','[jobseeker_last_name]','[jobseeker_email_shortcode]','[jobseeker_phone]');
				$replace_with 		= array(site_url(),ucfirst($_POST['fname']),ucfirst($_POST['lname']),$_POST['email'],$_POST['cell_phone'] );
				$message 			= str_replace($shordcode_to_rep, $replace_with, do_shortcode(get_option('founder_options_jobseeker')['jobseeker_mail_template']));
				
				$headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
				//$is_request = false;
				if(wp_mail($to,$subject,$message,$headers)){
					wp_mail($_POST['email'],$thanks_jobseeker_subject,$thanks_jobseeker_message,$headers);
				}
		       $data = json_encode(array('createuser'=>true, 'message'=>__('Thank you for connecting us we will contact to you soon')));
		    }
	   }

	 echo $data; die();

    }

}

add_action('wp_ajax_seeker_user', 'ey_seeker_user');
add_action('wp_ajax_nopriv_seeker_user', 'ey_seeker_user');


function random_password( $length = 8 ) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$&";
    $password = substr( str_shuffle( $chars ), 0, $length );
    return $password;
}

?>