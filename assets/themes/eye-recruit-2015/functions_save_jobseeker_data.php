<?php
/*Use for set job seeker profile visibility*/
function save_profile_visibility(){
  global $wpdb;
  $data = json_encode(array('success'=>false, 'message'=>'not save'));
  if(isset($_POST['userid'])){
    set_cimyFieldValue($_POST['userid'], 'PROFILE_VISIBILITY', $_POST['status']);
    if($_POST['status'] == 'anonymous'){
      $status = 'Visible to Everyone';
    }elseif ($_POST['status'] == 'Open') {
      $status = 'Recruiters Only ';
    }elseif ($_POST['status'] == 'Private') {
      $status = 'Invisible';
    }else{
      $status = 'Invisible';
    }
    $wpdb->insert($wpdb->prefix.'user_activity_log', array('user_id' => $_POST['userid'], 'action' => 'ProfileVisibility', 'datetime' => time(), 'meta' => 'Changed visibility Settings to '.$status ),array( '%d', '%s', '%s', '%s' ) );
    $data = json_encode(array('success'=>true, 'message'=>'Successfully save'));
  }else{
   $data = json_encode(array('success'=>false, 'message'=>'not save'));
  }
  echo $data; exit;
}

add_action('wp_ajax_visibility', 'save_profile_visibility');
add_action('wp_ajax_nopriv_visibility', 'save_profile_visibility');



//Membership Spotlight active inactive
function spotlight_status(){
  if($_POST['status']){
    $v = $_POST['status'];
    $user_id  = get_current_user_id();
    update_usermeta($user_id, 'spotlight_status',$_POST['status']);
  }
  echo $v; die;
}

add_action('wp_ajax_spotlight', 'spotlight_status');
add_action('wp_ajax_nopriv_spotlight', 'spotlight_status');





//associating a function to login hook
add_action('wp_login', 'set_last_login');
 
//function for setting the last login
function set_last_login($login) {
   $user = get_userdatabylogin($login);
 
   //add or update the last login value for logged in user
   update_usermeta( $user->ID, 'last_login', current_time('mysql') );
}


//function for getting the last login
function get_last_login($user_id) {
   $last_login = get_user_meta($user_id, 'last_login', true);
 
   //picking up wordpress date time format
   $date_format = get_option('date_format') . ' ' . get_option('time_format');
 
   //converting the login time to wordpress format
   $the_last_login = mysql2date($date_format, $last_login, false);
 
   //finally return the value
   return $the_last_login;
}

/*
Login history Store in  database  for every user role
*/
function save_user_login_history($login){
  global  $wpdb;
    $user               = get_userdatabylogin($login);
    $user_id            = $user->ID;
    $browser            = $_SERVER['HTTP_USER_AGENT'];
    $device             = $_SERVER['HTTP_USER_AGENT'];
    $location           = 'Fort Lauderdale, FL.United States';
    $ip_address         = $_SERVER['REMOTE_ADDR'];
    $login_datetime     = date('Y-m-d H:i:s');
    $cdate              = date('Y-m-d H:i:s');
      $wpdb->insert( 
      'eyecuwp_user_login_history', 
      array( 
        'user_id'     => $user_id, 
        'browser'     => $browser ,
        'device'      => $device , 
        'location'    =>  $location , 
        'ip_address'  => $ip_address , 
        'login_date'  =>$login_datetime, 
        'created_ate' => $cdate
      ), 
      array( '%d','%s' ,'%s','%s','%s','%s','%s'));

}


add_action('wp_login','save_user_login_history');






function data_save_assessment_none(){
  $data = json_encode(array('success'=>false, 'message'=>'not save'));
  if(isset($_POST['question'])){
    $user_id = get_current_user_id();
    set_cimyFieldValue($user_id, $_POST['question'], '');
    if ( isset($_POST['slug']) ) {
      $fieldvalue = time();
      update_user_meta($user_id, $_POST['question'].'action', $fieldvalue);
      update_user_meta($user_id, $_POST['slug'], $fieldvalue);
    }
    $data = json_encode(array('success'=>true, 'message'=>'Successfully save'));
  }
  echo $data; die;
}
add_action('wp_ajax_save_assessment_none','data_save_assessment_none');
add_action('wp_ajax_nopriv_save_assessment_none','data_save_assessment_none');



function checkupdateSelfAsses($slug, $user_id){
  if ( !empty($slug) ) {
    $img = '<img src="'.get_stylesheet_directory_uri().'/img/mini_torch.png"> ';
    $slug = strtolower($slug);
    $fieldname = $slug.'action';
    $getdata = get_user_meta($user_id, $fieldname, true);
    $now = time();
    $datediff = $now - $getdata;
    $dayes = floor( $datediff / (60 * 60 * 24) );
    if ( (!empty($getdata)) && ($dayes <= 90) ) {
      // return $img;
       return '';
    }
  }
}

?>