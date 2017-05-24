<?php
///outdated ontraport functions
function checkOAPContactID(){
	 $user = wp_get_current_user();
  
  $contact_id = get_user_meta($user->ID, 'contact_id', true);
  ///2015-04-30 Interfused updated the below because it seemed to broken for latest contacts. Inspired from the pilotpress plugin
  if(!$contact_id){
  	$contact_id = searchByEmail($user->user_login);
	update_user_meta( $user->ID, 'contact_id', $contact_id);
  }
  $mbrOapTags_arr=er_getOAPTagsByName($contact_id) ;
  $_SESSION['contact_id']=$contact_id;
if (in_array('EyeRecruit : Lead : Job Seeker',$mbrOapTags_arr)){
	////UPDATE USER ROLE
	wp_update_user( array( 'ID' => $user->ID, 'role' => 'candidate' ) );
}
if (in_array('EyeRecruit : Lead : Employer',$mbrOapTags_arr)){
	////UPDATE USER ROLE
	wp_update_user( array( 'ID' => $user->ID, 'role' => 'employer' ) );
}

}

function er_getOAPTagsByName($contact_id){
  $contact_id = (gettype($contact_id) == 'array') ? $contact_id[0] : $contact_id;
 

  $api = new PilotPressApi();
  $result = $api->fetchContact($contact_id);
  $contact_tags = $result->xpath('//field[@name="Contact Tags"]');
  $tags = $contact_tags[0];
  $tags_arr = explode('*/*',$tags);
  return $tags_arr;
}

add_action('wp_login', 'checkOAPContactID', 99);



/*** ONTRAPRT ***/
function getOAPTagsByName($contact_id){
  $contact_id = (gettype($contact_id) == 'array') ? $contact_id[0] : $contact_id;
	
  $api = new PilotPressApi();
  $result = $api->fetchContact($contact_id);
  $contact_tags = $result->xpath('//field[@name="Contact Tags"]');
  $tags = $contact_tags[0];
  $tags_arr = explode('*/*',$tags);
  return $tags_arr;
}

/*
function add_user_notes_fn(){
	// OAP FORM: EyeRecruit : User Notes : Seeker 
	$html='<script type="text/javascript" src="//forms.ontraport.com/v2.4/include/formEditor/genjs-v3.php?html=false&uid=p2c21625f47"></script><div class="moonray-form-p2c21625f47 ussr"><div class="moonray-form moonray-form-label-pos-stacked">
<form class="moonray-form-clearfix" action="https://forms.ontraport.com/v2.4/form_processor.php?" method="post" accept-charset="UTF-8">
<div class="moonray-form-element-wrapper moonray-form-element-wrapper-alignment-left moonray-form-input-type-email"><label for="mr-field-element-716269555268" class="moonray-form-label">Email</label><input name="email" type="email" class="moonray-form-input" id="mr-field-element-716269555268" required value="" placeholder/></div>
<div class="moonray-form-element-wrapper moonray-form-element-wrapper-alignment-left moonray-form-input-type-textarea"><label for="mr-field-element-613617002032" class="moonray-form-label">Notes</label><textarea name="notes" required class="moonray-form-input" id="mr-field-element-613617002032" placeholder></textarea></div>
<div class="moonray-form-element-wrapper moonray-form-element-wrapper-alignment-left moonray-form-input-type-submit"><input type="submit" name="submit-button" value="Submit" class="moonray-form-input" id="mr-field-element-258767155930"/></div>
<div class="moonray-form-element-wrapper moonray-form-input-type-hidden"><input name="afft_" type="hidden" value=""/></div>
<div class="moonray-form-element-wrapper moonray-form-input-type-hidden"><input name="aff_" type="hidden" value=""/></div>
<div class="moonray-form-element-wrapper moonray-form-input-type-hidden"><input name="sess_" type="hidden" value=""/></div>
<div class="moonray-form-element-wrapper moonray-form-input-type-hidden"><input name="ref_" type="hidden" value=""/></div>
<div class="moonray-form-element-wrapper moonray-form-input-type-hidden"><input name="own_" type="hidden" value=""/></div>
<div class="moonray-form-element-wrapper moonray-form-input-type-hidden"><input name="oprid" type="hidden" value=""/></div>
<div class="moonray-form-element-wrapper moonray-form-input-type-hidden"><input name="contact_id" type="hidden" value=""/></div>
<div class="moonray-form-element-wrapper moonray-form-input-type-hidden"><input name="utm_source" type="hidden" value=""/></div>
<div class="moonray-form-element-wrapper moonray-form-input-type-hidden"><input name="utm_medium" type="hidden" value=""/></div>
<div class="moonray-form-element-wrapper moonray-form-input-type-hidden"><input name="utm_term" type="hidden" value=""/></div>
<div class="moonray-form-element-wrapper moonray-form-input-type-hidden"><input name="utm_content" type="hidden" value=""/></div>
<div class="moonray-form-element-wrapper moonray-form-input-type-hidden"><input name="utm_campaign" type="hidden" value=""/></div>
<div class="moonray-form-element-wrapper moonray-form-input-type-hidden"><input name="referral_page" type="hidden" value=""/></div>
<div class="moonray-form-element-wrapper moonray-form-input-type-hidden"><input name="uid" type="hidden" value="p2c21625f47"/></div>

					</form>
				</div>
			</div>';
			return $html;
}
add_shortcode('add_user_notes','add_user_notes_fn');
*/
function get_ontraport_uid(){
	$current_user = wp_get_current_user();
	//check if address exists
//$user_id =  get_current_user_id();
  
  $all_meta_for_user = get_user_meta( $current_user->ID );
  return $all_meta_for_user['contact_id'];
}