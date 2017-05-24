<?php
/**
 * Template Name: Extended Profile Edit
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Jobify
 * @since Jobify 1.5
 */
 
 //reference docs
//http://www.marcocimmino.net/cimy-wordpress-plugins/cimy-user-extra-fields/documentation/
//http://wordpress.stackexchange.com/questions/9775/how-to-edit-a-user-profile-on-the-front-end
/* Get user info. */

/*
CHANGELOG

2016 04 12
Integrated replacement labels for previous labels

*/
global $current_user, $wp_roles;
get_currentuserinfo();

///OAP INFO
$user = wp_get_current_user();
$userMeta=get_user_meta($user->ID);


/* Load the registration file. */
require_once( ABSPATH . WPINC . '/registration.php' );
$error = array();   

$sectionQuestions_work_act=44;
$sectionQuestions_tech=48;
$sectionQuestions_tasks=32; 
$sectionQuestions_know=14; 
$sectionQuestions_skills=17; 
$sectionQuestions_ability=18; 

/* If profile was saved, update profile. */
if ( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) && $_POST['action'] == 'update-user' ) {

    /* Update user password. */
    if ( !empty($_POST['pass1'] ) && !empty( $_POST['pass2'] ) ) {
        if ( $_POST['pass1'] == $_POST['pass2'] )
            wp_update_user( array( 'ID' => $current_user->ID, 'user_pass' => esc_attr( $_POST['pass1'] ) ) );
        else
            $error[] = __('The passwords you entered do not match.  Your password was not updated.', 'profile');
    }

    /* Update user information. */
    if ( !empty( $_POST['url'] ) )
        update_user_meta( $current_user->ID, 'user_url', esc_url( $_POST['url'] ) );
    if ( !empty( $_POST['email'] ) ){
        if (!is_email(esc_attr( $_POST['email'] )))
            $error[] = __('The Email you entered is not valid.  please try again.', 'profile');
        elseif(email_exists(esc_attr( $_POST['email'] )) != $current_user->id )
            $error[] = __('This email is already used by another user.  try a different one.', 'profile');
        else{
            wp_update_user( array ('ID' => $current_user->ID, 'user_email' => esc_attr( $_POST['email'] )));
        }
    }

    if ( !empty( $_POST['first-name'] ) )
        update_user_meta( $current_user->ID, 'first_name', esc_attr( $_POST['first-name'] ) );
    if ( !empty( $_POST['last-name'] ) )
        update_user_meta($current_user->ID, 'last_name', esc_attr( $_POST['last-name'] ) );
    if ( !empty( $_POST['description'] ) )
        update_user_meta( $current_user->ID, 'description', esc_attr( $_POST['description'] ) );
//$result = set_cimyFieldValue($user_id, $field_name, $field_value);


/* CIMY FIELD UPDATES */
//set_cimyFieldValue($current_user->ID, 'JOB_SEARCH_RADIUS', $_POST['cimy_uef_JOB_SEARCH_RADIUS']);
//set_cimyFieldValue($current_user->ID, 'TEST_TEXTAREA', $_POST['cimy_uef_TEST_TEXTAREA']);

/*
//MULTIDROP EXAMPLE
if($_POST['cimy_uef_REF_SRC']){
set_cimyFieldValue($current_user->ID, 'REF_SRC', implode(",", $_POST['cimy_uef_REF_SRC']) );
}
*/



/////BASIC LEVEL
/*
$fieldsToUpdate_arr=array('DOB','GENDER','US_ELIGIBLE','DRIVER_STATE','FIELD_LICENSE_STATUS','FELONY_STATUS','INDUSTRY_YEARS','RELIABLE_TRANSPORT','MISDEMEANOR_YN');
for($i=0;$i<count($fieldsToUpdate_arr);$i++){
	if($_POST['cimy_uef_' . $fieldsToUpdate_arr[$i]]){
	set_cimyFieldValue($current_user->ID, $fieldsToUpdate_arr[$i], $_POST['cimy_uef_' . $fieldsToUpdate_arr[$i]]);
	}
}
*/
///DROPDOWNS / TEXT ENTRIES
$fieldsToUpdate_arr=array('DOB','GENDER','US_ELIGIBLE','DRIVER_STATE','FIELD_LICENSE_STATUS','FELONY_STATUS','INDUSTRY_YEARS','RELIABLE_TRANSPORT','MISDEMEANOR_YN','JOB_SEARCH_RADIUS','LANGUAGES_SPOKEN_OTH','PLUS_SKILL_1','PLUS_SKILL_2','JOB_SEARCH_AGRESS','COMPENSATION_CURRENT','COMPENSATION_DESIRED','US_ARMED_FORCES_OTH','BEST_INDUSTRY','HIGHEST_EDUCATION','EDUCATION_GRAD_YEAR','EDU_SCHOOL_NAME','EDU_MAJOR_STUDY','SECURITY_CLEAR_YN','OVER_18_YN','CURR_EMPLOYED_YN','WORK_DATE_AVAILABLE','CURR_CAREER_LVL','RELOCATION_YN','LOCAL_LAW_FORCE_YN' );
for($i=0;$i<count($fieldsToUpdate_arr);$i++){
	$tmpVal=$_POST['cimy_uef_' . $fieldsToUpdate_arr[$i]];
	if($tmpVal != "Select" && $tmpVal != "Select all that apply"){
	set_cimyFieldValue($current_user->ID, $fieldsToUpdate_arr[$i], $_POST['cimy_uef_' . $fieldsToUpdate_arr[$i]]);
	}
}

////MULTIPLE SELECT
$multiDropsToUpdate_arr=array('REF_SRC','FIELD_LICENSE_STATE','CUR_WORK_SITUATION','LANGUAGES_SPOKEN','RELOCATION_ABILITY','LANGUAGES_WRITTEN','US_ARMED_FORCES','US_LAW_ENFORCE_STATU','DES_WORK_TYPE','WORK_EXP_AREA');
for($i=0;$i<count($multiDropsToUpdate_arr);$i++){
	if($_POST['cimy_uef_'.$multiDropsToUpdate_arr[$i]]){
set_cimyFieldValue($current_user->ID, $multiDropsToUpdate_arr[$i], implode(",", $_POST['cimy_uef_' . $multiDropsToUpdate_arr[$i]  ]) );
	}
}

	//tasks 
	for($i=1;$i<= $sectionQuestions_tasks;$i++){
		if($_POST['cimy_uef_TASKS_Q'.$i]){
			set_cimyFieldValue($current_user->ID, 'TASKS_Q'.$i, $_POST['cimy_uef_TASKS_Q'.$i]);
			}
	}
	

	for($i=1;$i<$sectionQuestions_tech;$i++){
		if($_POST['cimy_uef_TECH_Q'.$i]){
			set_cimyFieldValue($current_user->ID, 'TECH_Q'.$i, $_POST['cimy_uef_TECH_Q'.$i]);
			}
	}	
	
	
	for($i=1;$i<$sectionQuestions_know;$i++){
		if($_POST['cimy_uef_KNOW_Q'.$i]){
			set_cimyFieldValue($current_user->ID, 'KNOW_Q'.$i, $_POST['cimy_uef_KNOW_Q'.$i]);
			}
	}	
	

	for($i=1;$i<$sectionQuestions_skills;$i++){
		if($_POST['cimy_uef_SKILLS_Q'.$i]){
			set_cimyFieldValue($current_user->ID, 'SKILLS_Q'.$i, $_POST['cimy_uef_SKILLS_Q'.$i]);
			}
	}	
	

	for($i=1;$i<$sectionQuestions_ability;$i++){
		if($_POST['cimy_uef_ABILITY_Q'.$i]){
			set_cimyFieldValue($current_user->ID, 'ABILITY_Q'.$i, $_POST['cimy_uef_ABILITY_Q'.$i]);
			}
	}	
	
	
	for($i=1;$i<$sectionQuestions_work_act;$i++){
		if($_POST['cimy_uef_WORK_ACT_Q'.$i]){
			set_cimyFieldValue($current_user->ID, 'WORK_ACT_Q'.$i, $_POST['cimy_uef_WORK_ACT_Q'.$i]);
			}
	}	
	
 


    /* Redirect so the page will show updated info.*/
  /*I am not Author of this Code- i dont know why but it worked for me after changing below line to if ( count($error) == 0 ){ */
    if ( count($error) == 0 ) {
        //action hook for plugins and extra fields saving
        do_action('edit_user_profile_update', $current_user->ID);
       // wp_redirect( get_permalink().'?test='.$_POST['cimy_uef_JOB_SEARCH_RADIUS'] );
        //wp_redirect( get_permalink() );
		/* 2016 04 12 : REDIRECT TO MAIN PROFILE */
		wp_redirect('/?p=2637&updated=1');
		exit;
    }
	
	
}///END if POST

 
//////////
get_header();
?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

 

<header class="page-header">
		<h1 class="page-title"><?php the_title(); ?></h1>
	</header>

	<div id="primary" class="content-area">
		<div id="content" class="container" role="main">
    
            <?php the_content(); ?>
            <?php if ( !is_user_logged_in() ) : ?>
                    <p class="warning">
                        <?php _e('You must be logged in to edit your profile.', 'profile'); ?>
                    </p><!-- .warning -->
            <?php else : ?>
        
            <!-- 
       <div id="userData">
                 {add questions in admin settings>cimy user extra fields}
            <p id="userID">userID: <?php echo $current_user->ID; ?>  </p><p id="seekerType">Job seeker type: <span><?php $seekerType = get_cimyFieldValue($current_user->ID, 'JOB_SEEKER_TYPE'); echo $seekerType; ?></span> </p>
       </div>
       -->
  
            <div class="loadingImg text-center"><img src="http://eyerecruit.com/assets/uploads/2015/03/ajax-loader.gif"></div>
            <?php
			$user_roles = $current_user->roles;
$user_role = array_shift($user_roles);
// echo '<strong>Current User Role</strong>: ' . $user_role;
			?>

                <?php if ( count($error) > 0 ) echo '<p class="error">' . implode("<br />", $error) . '</p>'; ?>
                <form method="post" id="adduser" action="<?php the_permalink(); ?>" enctype="multipart/form-data">
                
           
                
                
              <section id="basicContact">  
                <div class="row">
                <div class="col-md-6"><p class="form-username">
                        <label for="first-name"><?php _e('First Name', 'profile'); ?></label>
                        <input class="text-input" name="first-name" type="text" id="first-name" value="<?php the_author_meta( 'first_name', $current_user->ID ); ?>" />
                    </p><!-- .form-username --></div>
                <div class="col-md-6"><p class="form-username">
                        <label for="last-name"><?php _e('Last Name', 'profile'); ?></label>
                        <input class="text-input" name="last-name" type="text" id="last-name" value="<?php the_author_meta( 'last_name', $current_user->ID ); ?>" />
                    </p><!-- .form-username --></div>
                </div>
                    
                    
                    <p class="form-email">
                        <label for="email"><?php _e('E-mail *', 'profile'); ?></label>
                        <input class="text-input" name="email" type="text" id="email" value="<?php the_author_meta( 'user_email', $current_user->ID ); ?>" />
                    </p><!-- .form-email -->
                  <!-- 
                    <p class="form-url">
                        <label for="url"><?php _e('Website', 'profile'); ?></label>
                        <input class="text-input" name="url" type="text" id="url" value="<?php the_author_meta( 'user_url', $current_user->ID ); ?>" />
                    </p><!-- .form-url -->
                    <p class="h2">Change Password</p>
                    <p class="form-password">
                        <label for="pass1"><?php _e('New Password', 'profile'); ?> </label>
                        <input class="text-input" name="pass1" type="password" id="pass1" />
                    </p><!-- .form-password -->
                    <p class="form-password">
                        <label for="pass2"><?php _e('Repeat Password', 'profile'); ?></label>
                        <input class="text-input" name="pass2" type="password" id="pass2" />
                    </p><!-- .form-password -->
                    <div id="fbArea1"></div>
                    <!-- 
                    <p class="form-textarea">
                        <label for="description"><?php _e('Biographical Information', 'profile') ?></label>
                        <textarea name="description" id="description" rows="3" cols="50"><?php the_author_meta( 'description', $current_user->ID ); ?></textarea>
                    </p><!-- .form-textarea -->
</section>
<!-- tabs setup -->
<section id="profileQuestions">
<div id="extraQuestionsWrapper" role="tabpanel">

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#basicQ" aria-controls="basicQ" role="tab" data-toggle="tab">Basic</a></li>
    
    
     
     <li role="presentation">
     <?php
	 if( true ){
	 ?>
     <a href="#assess-tasks" aria-controls="assess-tasks" role="tab" data-toggle="tab">Tasks Assessment</a>
     <?php
	 }else{
	 ?>
     <a href="#" class="locked" ><i class="fa fa-lock"></i> Tasks Assessment</a>
     <?php
	 }
	 ?>
	 
     </li>
     <li role="presentation">
     <?php
	 if( true ){
	 ?>
     <a href="#assess-technology" aria-controls="assess-technology" role="tab" data-toggle="tab">Technology Assessment</a>
     <?php
	 }else{
	 ?>
     <a href="#" class="locked" ><i class="fa fa-lock"></i> Technology Assessment</a>
     <?php
	 }
	 ?>
     
     </li>
     <li role="presentation">
     <?php
	 if( true ){
	 ?>
     <a href="#assess-knowledge" aria-controls="assess-knowledge" role="tab" data-toggle="tab">Knowledge Assessment</a>
     <?php
	 }else{
	 ?>
     <a href="/?p=2610" class="locked" ><i class="fa fa-lock"></i> Knowledge Assessment</a>
     <?php
	 }
	 ?>
     </li>
     <li role="presentation">
     
     <?php
	 if( true ){
	 ?>
     <a href="#assess-skills" aria-controls="assess-skills" role="tab" data-toggle="tab">Skills Assessment</a>
     <?php
	 }else{
	 ?>
     <a href="/?p=2610" class="locked" ><i class="fa fa-lock"></i> Skills Assessment</a>
     <?php
	 }
	 ?>
     
     </li>
     <li role="presentation">
     
      <?php
	 if( true ){
	 ?>
     <a href="#assess-abilities" aria-controls="assess-abilities" role="tab" data-toggle="tab">Abilities Assessment</a>
     <?php
	 }else{
	 ?>
     <a href="/?p=2610" class="locked" ><i class="fa fa-lock"></i> Abilities Assessment</a>
     <?php
	 }
	 ?>
     
     </li>
     <li role="presentation">
     
     <?php
	 if( true ){
	 ?>
     <a href="#assess-activities" aria-controls="assess-activities" role="tab" data-toggle="tab">Work Activities Assessment</a>
     <?php
	 }else{
	 ?>
     <a href="/?p=2610" class="locked" ><i class="fa fa-lock"></i> Work Activities Assessment</a>
     <?php
	 }
	 ?>
     
     
     </li>
     <li role="presentation">
      <?php
	 if( true ){
	 ?>
     <a href="#premiumQ" aria-controls="premiumQ" role="tab" data-toggle="tab">Premium</a>
     <?php
	 }else{
	 ?>
     <a href="/?p=2610" class="locked" ><i class="fa fa-lock"></i> Premium</a>
     <?php
	 }
	 ?>
     
     </li>
    <li role="presentation">
      <?php
	 if( true ){
	 ?>
     <a href="#ultimateQ" aria-controls="ultimateQ" role="tab" data-toggle="tab">Ultimate</a>
     <?php
	 }else{
	 ?>
     <a href="/?p=2610" class="locked" ><i class="fa fa-lock"></i> Ultimate</a>
     <?php
	 }
	 ?>
     
    </li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane paddedBottom fade in active" id="basicQ">...</div>
    
    <div role="tabpanel" class="tab-pane paddedBottom fade" id="premiumQ">...</div>
    <div role="tabpanel" class="tab-pane paddedBottom fade" id="ultimateQ">...</div>
    <div role="tabpanel" class="tab-pane paddedBottom fade" id="assess-general">...</div>
     <div role="tabpanel" class="tab-pane paddedBottom fade" id="assess-tasks">...</div>
      <div role="tabpanel" class="tab-pane paddedBottom fade" id="assess-technology">...</div>
       <div role="tabpanel" class="tab-pane paddedBottom fade" id="assess-knowledge">...</div>
        <div role="tabpanel" class="tab-pane paddedBottom fade" id="assess-skills">...</div>
         <div role="tabpanel" class="tab-pane paddedBottom fade" id="assess-abilities">...</div>
          <div role="tabpanel" class="tab-pane paddedBottom fade" id="assess-activities">...</div>
  </div>

</div>
</section>





                    <?php 
                        //action hook for plugin and extra fields
                        do_action('edit_user_profile',$current_user); 
                    ?>
  
                    <p class="form-submit">
                        <?php echo $referer; ?>
                        <input name="updateuser" type="submit" id="updateuser" class="submit button" value="<?php _e('Update', 'profile'); ?>" />
                        <?php wp_nonce_field( 'update-user' ) ?>
                        <input name="action" type="hidden" id="action" value="update-user" />
                    </p><!-- .form-submit -->
                </form><!-- #adduser -->
            <?php endif; ?>
        </div><!-- .entry-content -->
        <?php do_action( 'jobify_loop_after' ); ?>
                          

                          
    </div><!-- .hentry .post -->
     
    <?php endwhile; ?>
<?php else: ?>
    <p class="no-data">
        <?php _e('Sorry, no page matched your criteria.', 'profile'); ?>
    </p><!-- .no-data -->
<?php endif; ?>

<div id="cloneSamples">
<div class="experienceCheck">
    <input type="checkbox" name="checkbox" id="checkbox" />
    <label for="checkbox">I have some experience with this</label>
  
  <div class="starRating"><i class="fa fa-star-o fa-3x"></i><i class="fa fa-star-o fa-3x"></i><i class="fa fa-star-o fa-3x"></i><i class="fa fa-star-o fa-3x"></i><i class="fa fa-star-o fa-3x"></i></div>
</div>

<div class="experienceCheckV2">
   
       <div class="row">
       <div class="question col-md-10"><p>Question here and answer</p></div>
       <div class="text-center col-md-2"><input name="RadioGroup1" type="radio" id="RadioGroup1_1" value="no" />
        <label>No</label>
   <input type="radio" name="RadioGroup1" value="yes" id="RadioGroup1_0" />
        <label>Yes</label></div>
       </div>

        
        <div class="starRatingWrapper text-center paddedTop paddedBottom">
        <p class="fineprint tight"><small>SELECT A STAR BELOW TO INDICATE YOUR EXPERIENCE/SKILL LEVEL</small></p> 
  beginner<span class="starRating">
  
  <i class="fa fa-star-o fa-3x"></i><i class="fa fa-star-o fa-3x"></i><i class="fa fa-star-o fa-3x"></i><i class="fa fa-star-o fa-3x"></i><i class="fa fa-star-o fa-3x"></i> </span>expert</div>
  <div class="fb text-center"></div>
</div>
</div>

 

<section id="updatedQuestions">
<hr>
<div id="work_activities">
<?php
function getUpdatedQuestions($qType){
	/*
	
	*/
	global $sectionQuestions_work_act,$sectionQuestions_tech,$sectionQuestions_tasks,$sectionQuestions_know,$sectionQuestions_skills, $sectionQuestions_ability;

	if ($qType == 'TASKS'){
		$qCnt= $sectionQuestions_tasks;
		$slugStart='tasks_q';
	}
	if ($qType == 'TECH'){
		$qCnt= $sectionQuestions_tech;
		$slugStart='tech_q';
	}
	if ($qType == 'KNOW'){
		$qCnt= $sectionQuestions_know;
		$slugStart='know_q';
	}
	if ($qType == 'SKILLS'){
		$qCnt= $sectionQuestions_skills;
		$slugStart='skills_q';
	}
	if ($qType == 'ABILITY'){
		$qCnt= $sectionQuestions_ability;
		$slugStart='ability_q';
	}
	if ($qType == 'WORK_ACT'){
		$qCnt=  $sectionQuestions_work_act;
		$slugStart='work_act_q';
	}
	
		for($i=1;$i< $qCnt;$i++){
		///get post by slug
		$the_slug = $slugStart.$i;
	$args = array(
	  'name'        => $the_slug,
	  'post_type'   => 'assessment-question',
	  'post_status' => 'publish',
	  'numberposts' => 1
	);
	$my_posts = get_posts($args);
	if( $my_posts ) :
	$questionPostID= $my_posts[0]->ID;
	//$my_meta = get_post_meta( $questionPostID); 
	 // print_r($my_meta);
	  
	  echo '<div id="'.$the_slug.'">';
	  echo get_post_meta( $questionPostID,'wpcf-job-seeker-assessment-question',true);
	  echo '</div>';
	 // echo '<div id="'.$the_slug.'">'. $my_meta[0]['job-seeker-assessment-question'] . '</div>' ;
	endif;
		//get proper question(s)
	}
}
?>
<?php
/* UPDATED QUESTIONS 
NOTE: WE USE TYPES PLUGIN FOR THE TEXT DETAIL BUT CONTENT IS STORED IN CIMY.
BELOW OUTPUTS THE TEXT FROM TYPES PLUGIN
*/
 echo getUpdatedQuestions('TASKS');
 echo getUpdatedQuestions('TECH');
 echo getUpdatedQuestions('KNOW');
 echo getUpdatedQuestions('SKILLS');
 echo getUpdatedQuestions('ABILITY');
 echo getUpdatedQuestions('WORK_ACT');
?>


</div>

</section>

<script>
function replaceLabel(tmpText){
	var replaceText='';
	if(tmpText=='basic'){
		replaceText='beginner';
	}
	if(tmpText=='average'){
		replaceText='competent';
	}
	if(tmpText=='good'){
		replaceText='intermediate';
	}
	if(tmpText=='excellent'){
		replaceText='advanced';
	}
	if(tmpText=='master'){
		replaceText='expert';
	}
	return replaceText;
}
function cloneAndCheck2(id,tblID){
	fieldname='cimy_uef_' + id ;
	var el=jQuery('[name="'+fieldname+'"]');
	el.closest( "tr" ).appendTo(tblID);
	
	var radioGrpName = 'rg_'+id;
	//console.log(fieldname);
	jQuery("#cloneSamples .experienceCheckV2").clone().insertBefore( tblID).attr('id','wrapper'+id);
	//old table row
var trContainer = el.closest('tr'); 
var tdContainer = el.closest('td'); 

var newContainer = jQuery('#wrapper'+id);

var newQuestionWrapper = newContainer.find('.question');

newQuestionWrapper.empty();

var tmpHTML = trContainer.find('th label');
jQuery(tmpHTML).appendTo(newQuestionWrapper);

//console.log('tmpHTML: '+tmpHTML);
tdContainer.contents().unwrap().appendTo(newQuestionWrapper);
//newQuestionWrapper.append('<h2>updated question: '+id+'</h2>');
/* FIND THE UPDATED QUESTION AS OUTPUT BY CUSTOM FIELDS */
var updatedQ=jQuery("div#"+id.toLowerCase() );
if( updatedQ ){
//newQuestionWrapper.append(updatedQ);
newQuestionWrapper.find('label').empty().append(updatedQ);
}

//check for existing value
	var selectedIdx = el[0].selectedIndex;
	
//	console.log(fieldname + ' index: '+selectedIdx);
	 
	 
	newContainer.find('input:radio').attr('name',radioGrpName);
	newContainer.find('input[name="'+radioGrpName+'"][value="no"]').prop('checked', true);


	if(selectedIdx > 0 ){
	
	newContainer.find('input[name="'+radioGrpName+'"][value="yes"]').prop('checked', true);
	//set stars
		newContainer.find('.fa:lt('+ (selectedIdx ) +')').removeClass('fa-star-o').addClass('fa-star');
		tmpText = newContainer.find("select").val();
	newContainer.find('.fb').text( replaceLabel(tmpText) );
	}else{
		newContainer.find('.starRatingWrapper').hide();
	}
	
	el.hide();
	
	 
	
	
}


///////////////////
/*
function cloneAndCheck(id,tblID){
	//move tr to proper table
	////TEMP EXIT TO DEBUG
	//return;
	fieldname='#cimy_uef_' + id ;
	jQuery(fieldname).closest( "tr" ).appendTo(tblID);
	var radioGrpName = 'rg_'+id;
	//alert(fieldname);
	jQuery("#cloneSamples .experienceCheckV2").clone().insertBefore( tblID).attr('id','wrapper'+id);

//old table row
var trContainer = jQuery(fieldname).closest('tr'); 
var tdContainer = jQuery(fieldname).closest('td'); 

var newContainer = jQuery('#wrapper'+id);

var newQuestionWrapper = newContainer.find('.question');

newQuestionWrapper.empty();

var tmpHTML = trContainer.find('th label');
jQuery(tmpHTML).appendTo(newQuestionWrapper);

//console.log('tmpHTML: '+tmpHTML);
tdContainer.contents().unwrap().appendTo(newQuestionWrapper);


//check for existing value
	var selectedIdx = jQuery(fieldname)[0].selectedIndex;
	
//	console.log(fieldname + ' index: '+selectedIdx);
	 
	 
	newContainer.find('input:radio').attr('name',radioGrpName);
	newContainer.find('input[name="'+radioGrpName+'"][value="no"]').prop('checked', true);


	if(selectedIdx > 0 ){
	
	newContainer.find('input[name="'+radioGrpName+'"][value="yes"]').prop('checked', true);
	//set stars
		newContainer.find('.fa:lt('+ (selectedIdx ) +')').removeClass('fa-star-o').addClass('fa-star');
		tmpText = newContainer.find("select").val();
	newContainer.find('.fb').text( replaceLabel(tmpText) );
	}else{
		newContainer.find('.starRatingWrapper').hide();
	}
	
	jQuery(fieldname).hide();
}
*/
/////////////////


///add additional tables to plus area to break up
	function setupTmpTbl (title,id){
	
	jQuery( ".tab-content div#assess-"+id ).empty().append('<h4>'+title+'</h4><table id="'+id+'" class="form-table"></table>');
	}
	


jQuery(document).ready(function(){
	//JQuery('form select').prepend('<option>Select</option>');
	//jQuery("form select").prepend("<option val=''>Select</option>");
	/*
	jQuery("form select").each(function(index, element) {
		console.log( jQuery(this).attr('id') + ' : '+jQuery(this).val() );
        if(jQuery(this).val() != ""){
			//something is here
			}else{
			jQuery(this).find('option').eq(0).prop('selected', true); 
			}
    });
	*/
	jQuery('input[type="text"]').attr('maxlength',50);
	var maxIdx=0;
	var seekerType = jQuery("#seekerType span").text();
	if(seekerType=='Plus'){maxIdx=1;}
	if(seekerType=='Premium'){maxIdx=2;}
	if(seekerType=='Ultimate'){maxIdx=3;}
	//move main h2
	jQuery("form#adduser h2").text('Profile Questions').insertBefore("#extraQuestionsWrapper");
	jQuery("#helpText").insertAfter("form#adduser h2");
	
	
	//remove first form-table... empty for some reason?
	jQuery(".form-table").eq(0).remove();

	//move basic questions
	jQuery( ".tab-content div#basicQ" ).empty().append(jQuery('form#adduser h3').eq(0) , jQuery('.form-table').eq(0),jQuery('.form-table').eq(1));
	
	//remove plus heading();
	jQuery('form#adduser h3').eq(1).text("");
	//move plus
	//jQuery( ".tab-content div#basicQ" ).empty().append(jQuery('form#adduser h3').eq(1) , jQuery('.form-table').eq(1) );
	
	//move premium
	jQuery( ".tab-content div#premiumQ" ).empty().append(jQuery('form#adduser h3').eq(2) , jQuery('.form-table').eq(2));
	//move ultiamte
	jQuery( ".tab-content div#ultimateQ" ).empty().append(jQuery('form#adduser h3').eq(3) , jQuery('.form-table').eq(3));
	
	jQuery('form#adduser h3').eq(1).remove();
	
		setupTmpTbl("Tasks Assessment",'tasks');
	setupTmpTbl("Technology Assessment",'technology');
	setupTmpTbl("Knowledge Assessment",'knowledge');
	setupTmpTbl("Skills Assessment",'skills');
	setupTmpTbl("Abilities Assessment",'abilities');
	setupTmpTbl("Work Activities Assessment",'activities');
	///OTHER TASKS YN FIELDS : 35 questions
	for(i=1; i<= <?php echo $sectionQuestions_tasks; ?>; i++){
		if(!jQuery('select[name="cimy_uef_TASKS_Q'+ (i) +'"]' ).length ){
		break;
		}
	cloneAndCheck2( 'TASKS_Q'+i , '#tasks' );
	}
	jQuery('table#tasks').remove();
	
	
	///OTHER TECH YN FIELDS : 35 questions
	for(i=1;i<= <?php echo $sectionQuestions_tech; ?> ;i++){
		if(!jQuery('select[name="cimy_uef_TECH_Q'+ (i) +'"]' ).length ){
		break;
		}
	cloneAndCheck2( 'TECH_Q'+i , '#technology' );
	}
	jQuery('table#technology').remove();
	
	
	
	///OTHER KNOW YN FIELDS : 35 questions
	for(i=1;i<=<?php echo $sectionQuestions_know;?>;i++){
		if(!jQuery('select[name="cimy_uef_KNOW_Q'+ i +'"]' ).length ){
		break;
		}
	cloneAndCheck2( 'KNOW_Q'+i ,'#knowledge' );
	}
	jQuery('table#knowledge').remove();
	///OTHER SKILLS YN FIELDS : 35 questions
	for(i=1;i<=<?php echo $sectionQuestions_skills; ?>;i++){
		if(!jQuery('select[name="cimy_uef_SKILLS_Q'+ i +'"]' ).length ){
		break;
		}
	cloneAndCheck2( 'SKILLS_Q'+i ,'#skills' );
	}
	 
	jQuery('table#skills').remove();
	
	///OTHER ABILITY YN FIELDS : 35 questions
	for(i=1;i<=<?php echo $sectionQuestions_ability; ?>;i++){
		if(!jQuery('select[name="cimy_uef_ABILITY_Q'+ i +'"]' ).length ){
		break;
		}
	cloneAndCheck2( 'ABILITY_Q'+i,'#abilities' );
	}
	jQuery('table#abilities').remove();
	
	///OTHER WORK ACTIVITIES YN FIELDS : 35 questions
	for(i=1;i<= <?php echo $sectionQuestions_work_act; ?> ;i++){
		if(!jQuery('select[name="cimy_uef_WORK_ACT_Q'+ i +'"]' ).length ){
		break;
		}
	cloneAndCheck2( 'WORK_ACT_Q'+i ,'#activities' );
	}
	jQuery('table#activities').remove();
	
	jQuery( ".tab-pane" ).append( jQuery('<button class="er_updater button">UPDATE</button>') );
	 
jQuery("#cloneSamples").remove();
jQuery('p.form-submit:last-child').hide();

jQuery('.er_updater').on('click',function(e){
	jQuery("#updateuser").trigger("click");
	});

///EXPERIENCE CHECKBOX
jQuery('.experienceCheck input[type="checkbox"]').on('click', function(e) {
	
	divContainer=jQuery(this).closest('div');
	tmpIdx=0;
	isChecked=jQuery(this).is(':checked');
	if(isChecked){
		tmpIdx=1;
	} 
	//set stars
		divContainer.find('.starRating').fadeIn('slow');	
		divContainer.find('.starRating i').removeClass('fa-star fa-star-o').addClass('fa-star-o');	
		divContainer.find('.fa:lt('+tmpIdx+')').removeClass('fa-star-o').addClass('fa-star');
		//set initial select
		tdContainer = jQuery(this).closest('td');
		tdContainer.find("select").prop('selectedIndex', tmpIdx);
	
	if(isChecked){
		//tdContainer.find('select').css('visibility','hidden');
	}
		
	});///END CHECKBOX
	
//Y/N CLICK
jQuery('.experienceCheckV2 input[type="radio"]').on('click', function(e) {
	divContainer=jQuery(this).closest('div.experienceCheckV2');
	tmpIdx=0;
	var val=jQuery(this).val();
	if(val=='yes'){
		tmpIdx=1;	
	}
	//set stars
		divContainer.find('.starRating').fadeIn('slow');	
		divContainer.find('.starRating i').removeClass('fa-star fa-star-o').addClass('fa-star-o');	
		divContainer.find('.fa:lt('+tmpIdx+')').removeClass('fa-star-o').addClass('fa-star');
		//set initial select
		tdContainer = jQuery(this).closest('td');
		tdContainer.find("select").prop('selectedIndex', tmpIdx);
	if(val=='yes'){
	//	tdContainer.find('select').css('visibility','hidden');
	divContainer.find('.starRatingWrapper').fadeIn('slow');
	tmpText = divContainer.find("select").val();
	divContainer.find('.fb').text(tmpText);
	}else{
	divContainer.find('.starRatingWrapper').hide();
	divContainer.find('.fb').empty();
	}
	
		
});

/////CLICK STAR RATING
jQuery('.starRating i').on('click', function(e) {
    //alert('');
	//get container
	container = jQuery(this).closest('div.experienceCheckV2');
	//tdContainer = jQuery(this).closest('td');
	//container.css('background-color','#f00');
	var selectedIdx = jQuery(this).index();
	//alert(selectedIdx);
	container.find('.fa').removeClass('fa-star').addClass('fa-star-o');
	//set stars
		container.find('.fa:lt('+ (selectedIdx+1) +')').removeClass('fa-star-o').addClass('fa-star');
	//set select index
	container.find("select").prop('selectedIndex', selectedIdx+1);
	//alert('val: '+tdContainer.find('select').val());
	tmpText = container.find("select").val();
	//change labels
	
	tmpText2=replaceLabel(tmpText);
	
	container.find('.fb').text(tmpText2);
});
////
});
</script>


<script>
function setupPagination(containerDiv,qCnt){
	var maxQ=5;
	var maxPages=0;
	maxPages= Math.floor(qCnt/maxQ);
	var addClasses='';
	
	
	var html='<div class="paginationDiv text-center">';
	
	for(i=1;i<=maxPages;i++){
		sectionStartID=(i-1)*maxQ+1;
		if(i==1){
			html += '<a href="#" data-start-el='+sectionStartID+' class="active" >'+i+'</a>';
		}else{
			html += '<a href="#" data-start-el='+sectionStartID+' >'+i+'</a>';
		}
	 
	}
	
	html += '</div>';
	
	jQuery(html).insertBefore(containerDiv+" button");
	jQuery(containerDiv).find(".experienceCheckV2:gt("+ (maxQ-1) +")").hide();
	
}
/////////////
function setupPaginationBackup(sectionType){
	var maxQ=5;
	var maxPages=0;
	/* wrapperTASKS_Q1 */
	if(sectionType=='TASKS'){
		maxPages= Math.floor(<?php echo $sectionQuestions_tasks; ?>/maxQ);
	}
	if(sectionType=='TECH'){
		maxPages= Math.floor(<?php echo $sectionQuestions_tech; ?>/maxQ);
	}
	
	
	/*
KNOW
SKILLS
ABILITY
WORK_ACT
*/

//	alert('maxPages: '+ maxPages );
	
	var html='<div class="paginationDiv text-center">';
	
	for(i=1;i<=maxPages;i++){
		sectionStartID=(i-1)*maxQ+1;
		
	 html += '<a href="#" data-start-el='+sectionStartID+' >'+i+'</a>';
	}
	
	html += '</div>';
	
	jQuery(html).insertBefore("#assess-tasks button");
}
////////////////////////
jQuery(document).ready(function(){
	////REORDER BASIC QUESTIONS
	var order_arr=Array(
	'cimy_uef_JOB_SEARCH_AGRESS',
	'cimy_uef_BEST_INDUSTRY',
	'cimy_uef_HIGHEST_EDUCATION',
	'cimy_uef_EDUCATION_GRAD_YEAR',
	'cimy_uef_EDU_SCHOOL_NAME',
	'cimy_uef_EDU_MAJOR_STUDY',
	'cimy_uef_DES_WORK_TYPE[]',
	'cimy_uef_JOB_SEARCH_RADIUS',
	'cimy_uef_US_ELIGIBLE',
	'cimy_uef_SECURITY_CLEAR_YN',
	'cimy_uef_OVER_18_YN',
	'cimy_uef_DRIVER_STATE',
	'cimy_uef_CURR_EMPLOYED_YN',
	'cimy_uef_WORK_DATE_AVAILABLE',
	'cimy_uef_RELIABLE_TRANSPORT',
	'cimy_uef_INDUSTRY_YEARS',
	'cimy_uef_CURR_CAREER_LVL',
	'cimy_uef_REF_SRC[]',
	'cimy_uef_WORK_EXP_AREA[]',
	'cimy_uef_RELOCATION_YN',
	'cimy_uef_COMPENSATION_CURRENT',
	'cimy_uef_COMPENSATION_DESIRED',
	'cimy_uef_FIELD_LICENSE_STATUS',
	'cimy_uef_FIELD_LICENSE_STATE[]',
	'cimy_uef_LANGUAGES_SPOKEN[]',
	'cimy_uef_LANGUAGES_WRITTEN[]',
	'cimy_uef_CUR_WORK_SITUATION[]',
	'cimy_uef_US_ARMED_FORCES[]',
	'cimy_uef_LOCAL_LAW_FORCE_YN',
	'cimy_uef_US_LAW_ENFORCE_STATU[]'
	);
	
	for(i=0;i < order_arr.length;i++ ){
	var el= jQuery( '[name="'+ order_arr[i] +'"]' ).closest('tr');
	el.appendTo("div#basicQ table:eq(0) tbody");
	}
	/* remove empty "plus" table since all have been appedned to first table */
	jQuery("div#basicQ table:eq(1)").remove();
	
	/* SETUP BASIC SECTION PAGINATION */
	var len=jQuery('#basicQ > table > tbody > tr').length;
	
	var maxQ=5;
	var maxPages=0;
	maxPages= Math.floor(len/maxQ);
	var addClasses='';
	
	
	var html='<div class="paginationDiv text-center">';
	
	for(i=1;i<=maxPages;i++){
		sectionStartID=(i-1)*maxQ+1;
		if(i==1){
			html += '<a href="#" data-start-el='+sectionStartID+' class="active" >'+i+'</a>';
		}else{
			html += '<a href="#" data-start-el='+sectionStartID+' >'+i+'</a>';
		}
	 
	}
	
	html += '</div>';
	
	jQuery(html).insertBefore("#basicQ button");
	jQuery("#basicQ").find("tr:gt("+ (maxQ-1) +")").hide();
	/* end basic section pagination */
	
	setupPagination("#assess-tasks",<?php echo $sectionQuestions_tasks; ?>);
	setupPagination("#assess-technology",<?php echo $sectionQuestions_tech; ?>);
	
	setupPagination("#assess-knowledge",<?php echo $sectionQuestions_know; ?>);
	setupPagination("#assess-skills",<?php echo $sectionQuestions_skills; ?>);
	setupPagination("#assess-abilities",<?php echo $sectionQuestions_ability; ?>);
	setupPagination("#assess-activities",<?php echo $sectionQuestions_work_act; ?>);
	
	jQuery('.paginationDiv a').on('click',function(e){
		e.preventDefault();
		
		//GET PARENT DIV
		var tgtDiv=jQuery(this).closest('.tab-pane');
		
		tgtDiv.find(".paginationDiv a").removeClass('active');
		jQuery(this).addClass('active');
		
		//SHOW APPROPRIATE QUESTIONS
		if(tgtDiv.attr('id')=='basicQ'){
			tgtDiv.find('tr').hide();
		}else{
			tgtDiv.find('.experienceCheckV2').hide();
		}
		var startID=Number(jQuery(this).attr('data-start-el'));
	//	alert("startID: "+startID);
		
		var endID=startID+5;
		var tmpIdx=0;
		for(i=startID;i<endID;i++){
			tmpIdx++;
			if(tgtDiv.attr('id')=='basicQ'){
				tgtDiv.find("tr:nth-of-type("+i+")").show();
			}else{
			tgtDiv.find(".experienceCheckV2:nth-of-type("+i+")").show();
			}
		}
		//animate
		
		jQuery("html, body").animate({ scrollTop: tgtDiv.offset().top });
		});/* END CLICK */
		
		/* SETUP BACKGROUND CHECKS */
	
	});/* END DOC READY */

jQuery(window).load(function(e) {
	
//remove stuff
    jQuery(".loadingImg").remove();
	/*
	jQuery("form#adduser h3:gt("+maxIdx+")").remove();
	jQuery("form#adduser table.form-table:gt("+(maxIdx+1)+")").remove();
	*/
	
});

jQuery('.locked').on('click',function(e){
	e.preventDefault();
	window.location='/?p=2610';
	});

</script>
<?php
if($_GET['chpw']){
	?>
    <script>
	jQuery(document).ready(function(){
		jQuery("#initialStart").remove();
	jQuery("#profileQuestions, #supportDocsWrapper").remove();
	var tgt=jQuery('[name="first-name"]').closest('.row');
	tgt.addClass('offScrn');
	 tgt=jQuery('input#email').closest('p');
	tgt.addClass('offScrn');
	jQuery("#updateuser").show().css({'position':'relative','display':'block'});
	jQuery('[name="pass1"]').closest('p').find('label').text('NEW PASSWORD *');
	});
	/*   */
	jQuery('<button class="er_updater button">UPDATE</button>').appendTo("#basicContact");
	jQuery('.er_updater').on('click',function(e){
	jQuery("#updateuser").trigger("click");
	});
    </script>
   
    <?php
}
?>
<?php
if($_GET['m']){
	?>
    <script>
	jQuery(document).ready(function(){
		var tgt="<?php echo $_GET['m']; ?>";
		
		jQuery(".alert-warning, #basicContact").hide();
		jQuery("a[href='#assess-<?php echo $_GET['m']; ?>']").trigger('click');
		jQuery(".acc_group #<?php echo $_GET['m']; ?>").trigger('click');
		 jQuery("#initialStart").hide();
		 if(tgt=='docs-certs' || tgt=='docs-achievements' || tgt=='docs-bgchecks' ){
		 	jQuery("#profileQuestions").hide();
			//jQuery("html, body").animate({ scrollTop: jQuery("#supportDocsHeader").offset().top });
		 }
		 
		});
	
	</script>
    <?php
}
?>

<script>
jQuery(document).ready(function(){
	jQuery('.open-popup-link').magnificPopup({
  type:'inline',
  midClick: true // Allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source in href.
});
	});
</script>
<!-- 
<a id="starLegend" href="#starLegend-modal" class="open-popup-link"><img src="http://eyerecruit.com/assets/uploads/2016/04/star-legend.jpg"></a>
-->
<div id="helpText"><p><small>Need help with the assessment rating? <a href="#starLegend-modal" class="open-popup-link">Click here</a></small></p></div>

<div id="starLegend-modal" class="modal-reg modal">
<p class="text-center">
<img src="http://eyerecruit.com/assets/uploads/2016/04/star-rating-explanation.jpg" ></p>
</div>
<!-- UNIVERSAL SCRIPTS /STYLES -->
 <script>
	function checkPwMatch(){
		var pass1 = jQuery("#pass1").val();
		var pass2=jQuery("#pass2").val();
		var fbMsg='';
		if(pass1.length < 4 || pass2.length < 4){
			return;
		}
		if(pass1 != pass2){
			fbMsg='passwords do not match';
		}else{
			fbMsg='';
		}
		jQuery("#fbArea1").text(fbMsg);
	};
	
	jQuery("#pass1, #pass2").change(function(e) {
        checkPwMatch();
    });
	///////////////
	var tgt=jQuery('[name="first-name"]').closest('.row');
	tgt.addClass('offScrn');
	 tgt=jQuery('input#email').closest('p');
	tgt.addClass('offScrn');
	
	</script>
<style>
form#adduser h2{padding-bottom:0; margin-bottom:0;}
.starRating .fa{cursor:pointer;}
.form-table tr > th, .form-table tr > td{display:block; width:auto;}

.wpcf-group-area_user-education, .wpcf-group-area_user-notes, .wpua-edit-container, h3:last-child{display:none !important;}
.paginationDiv{border:1px solid #ccc; border-left:none; border-right:none; padding:1rem;}
.paginationDiv a{display:inline-block; padding:5px 10px;}
.paginationDiv a.active{background:#900; color:#fff;}
.modal{max-width:600px;}
button.mfp-close {
  right: 10px;
  top: 10px;
}
a#starLegend{position:fixed; right:0; top:50%;}
</style>


<?php get_footer(); ?>