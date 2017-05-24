<?php
/**
 * Template Name: Job Seeker Dashboard (v2)
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Jobify
 * @since Jobify 1.5
 */
 
 /* DIFFERENT STYLE */
 
 //reference docs
//http://www.marcocimmino.net/cimy-wordpress-plugins/cimy-user-extra-fields/documentation/
//http://wordpress.stackexchange.com/questions/9775/how-to-edit-a-user-profile-on-the-front-end
/* Get user info. */

global $current_user, $wp_roles;
get_currentuserinfo();

///OAP INFO

$user = wp_get_current_user();
$userMeta=get_user_meta($user->ID);
$contact_id = get_user_meta($user->ID, 'contact_id', true);


///HANDLE RESUME DELETE
/* ?action=delete&resume_id=3046&_wpnonce=cfa0c58626 */
if($_GET['action']=='delete' && $_GET['resume_id'] && $_GET['_wpnonce'] ){
 ///GET ALL THE USER'S RESUME IDS
 $resumeID_arr=getResumeIds($user->ID);
 if(in_array($_GET['resume_id'],$resumeID_arr)){
 	///ONLY ALLOW USER TO DELETE HIS/HER OWN
	wp_delete_post( $_GET['resume_id']);
 }
		
	
	
}

///used for percentage completion checking
$profileBasicQTotal=0;
$profileBasicQAnswered=0;

///Ultimate, Premium,Plus logic setting for account type
$accountType='Basic';

function getShortDesc($descType,$q_id){
	global $wpdb;
	$shortlabel='';
	$slug=strtolower($q_id);
	///get post by question id
	$my_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_name = '$slug'");
	
	return $my_id;
	
	if($descType=='KNOW'){
		switch($id){
			case "KNOW_Q1":
			$shortlabel='English language proficiency';
			break;
			
			case "KNOW_Q2":
$shortlabel='Laws, codes, procedures & regulations';
break;
case "KNOW_Q3":
$shortlabel='Public Safety & Security strategies';
break;
case "KNOW_Q4":
$shortlabel='Media production & dissemination';
break;
case "KNOW_Q5":
$shortlabel='Computers, electronics & applications ';
break;
case "KNOW_Q6":
$shortlabel='Administrative, clerical & procedures';
break;
case "KNOW_Q7":
$shortlabel='Geographic interrelationships';
break;
case "KNOW_Q8":
$shortlabel='Curriculum, training, teaching & instruction';
break;
case "KNOW_Q9":
$shortlabel='Philosophical, religious customs & practices';
break;
case "KNOW_Q10":
$shortlabel='Group dynamics, influences & societal trends';
break;
case "KNOW_Q11":
$shortlabel='Behavior, performance, learning & motivation';
break;
case "KNOW_Q12":
$shortlabel='Customer service, needs assessments & satisfaction';
break;
case "KNOW_Q13":
$shortlabel='Administration, management, planning & leadership';
break;
case "KNOW_Q14":
$shortlabel='Telecommunications transmissions & broadcasting';
			break;
		}
	
	}
	///end knowledge
	
	return $shortlabel;
	}
 



get_header(); ?>


	<header class="page-header">
		<h1 class="page-title"><?php the_title(); ?></h1>
	</header>

	<div id="primary" class="content-area">
	  <div id="content" class="container" role="main">
			 
           
             
             
        <section id="topSection" class="paddedTop">
		<?php if($_GET['updated']==1){
		?>
			<div class="alert alert-info marginBottom">
			Your profile was successfully updated.
			</div>
		<?php
		}
		?>

		<div class="row">
		<div class="col-md-6">
			<!-- NAME -->
			<h1 class="tight" ><span id="userName"><?php echo ('{NAME}' ) ?></span></h1>
			<strong>Recruit ID: <?php echo $contact_id;?></strong> 
		</div>
		<div class="col-md-6"><ul id="hdr_overview" class="medium-block-grid-2">
			<li><strong>MEMBER SINCE:</strong>  
		<small>
			<?php
			////GET USER SINCE DATE
			$udata = get_userdata( get_current_user_id() );

			$registered = $udata->user_registered;

			echo  date( "F d, Y", strtotime( $registered ) );
			?>
		</small>
		</li>
		<!-- <li><strong>LAST LOGIN:</strong></li> -->
			<li><strong>PROFILE VIEWS:</strong> <small> 
			<i class="fa fa-lock"></i> Coming Soon</small></li>
			<li><strong>ACCOUNT TYPE:</strong> 
			<?php echo $accountType;?></li>
			<!-- <li><strong>LAST UPDATE:</strong></li> -->
			<li id="availability"><strong>AVAILABILITY</strong>:</li>
		</ul>
			</div><!-- col -->
		</div><!-- row =-->




</section>
<hr>
<div class="row">

<div class="col-md-9 col-md-push-3">
<div class="row">
<div class="col-sm-3 text-center"><?php echo do_shortcode('[avatar_upload size="large"]') ?></div>

<div id="overviewContainer1" class="col-sm-7">
</div>

<div class="col-sm-2 text-center"><section id="yourRecruiter" class="clearfix marginBottom-2x">
<h4 class="tightTop">Your Recruiter</h4>
<?php echo do_shortcode('[your_recruiter][/your_recruiter]'); ?>
 </section></div>
</div>
<!-- END ROW -->
<section id="mainActionsWrapper">
<a href="http://eyerecruit.com/find-a-job/" class="button button-primary button-small"><i class="fa fa-search"></i>Find a Job</a> 
<a href="http://eyerecruit.com/job-seekers/job-alerts/?action=add_alert" class="button button-primary button-small"><i class="fa fa-bell-o"></i>create a job alert</a>
</section>

<section id="resumes" class=" padded-sm swatch2 marginBottom-2x">
 
<h2 class="tightTop" ><i class="fa fa-files-o"></i> MY RESUMES</h2>

<hr>
<?php echo do_shortcode('[candidate_dashboard]');?>


 
</section>

<section id="supportDocs" class="clearfix padded-sm swatch2 marginBottom-2x">
<h2 class="tightTop"><i class="fa fa-download"></i> SUPPORT DOCUMENTS</h2>
<div class="row">
<div class="col-md-4"><h3>Certificates</h3>
<?php echo showCertificatesFileList($user->ID); ?>
<p><a href="/job-seekers/edit-profile/?m=docs-certs" class="button button-primary button-small"><i class="fa fa-pencil"></i> Edit</a></p></div>
<div class="col-md-4"><h3>Achievements</h3>
<?php echo showAchievementsFileList($user->ID); ?>
<p><a href="/job-seekers/edit-profile/?m=docs-achievements" class="button button-primary button-small"><i class="fa fa-pencil"></i> Edit</a></p></div>
<div class="col-md-4"><h3>Background Checks</h3>
<?php echo showBackgroundCheckList($user->ID); ?>
<p><a href="/job-seekers/edit-profile/?m=docs-bgchecks" class="button button-primary button-small"><i class="fa fa-pencil"></i> Edit</a></p></div>
</div>



</section>

<section id="bookmarks" class="clearfix padded-sm swatch2 marginBottom-2x">
<h2 class="tightTop"><i class="fa fa-bookmark-o"></i> MY JOB BOOKMARKS</h2>
<?php echo do_shortcode('[my_bookmarks]');?>

</section>



<section id="assessments" class="clearfix padded-sm swatch2 marginBottom-2x">
<h2 class="text-center tightTop">PROFESSIONAL SELF-ASSESSMENTS</h2>

<?php

function getHighestScoreQuestions($qType){
	global $current_user, $wp_roles;
	get_currentuserinfo();
	
	///OAP INFO
	$user = wp_get_current_user();
	
	$qCnt=0;
	$totQuestionToReturn=5;
	$sort_arr = array('master','excellent','good','average','basic');
	$master_arr=array();
	$excellent_arr=array();
	$good_arr=array();
	$average_arr=array();
	$basic_arr=array();
	
	$html='';
	
	    $values = get_cimyFieldValue($user->ID, false);

    foreach ($values as $value) {
		$pos=strrpos($value['NAME'], $qType );
		if ($pos === false) { // note: three equal signs
    		// not found...
		}else{
			///build arrays
			
			$tmpVal = cimy_uef_sanitize_content($value['VALUE']);
			$insert_arr=array(id=>$value['NAME'],label=>$value['LABEL'],shortlabel=> getShortDesc($qType,$value['NAME'])  ,val=>$tmpVal);
			
			if($tmpVal == 'master'){
				array_push($master_arr, $insert_arr );
			}
			if($tmpVal == 'excellent'){
				array_push($excellent_arr,$insert_arr);
			}
			if($tmpVal == 'good'){
				array_push($good_arr,$insert_arr);
			}
			if($tmpVal == 'average'){
				array_push($average_arr,$insert_arr);
			}
			if($tmpVal == 'basic'){
				array_push($basic_arr,$insert_arr);
			}
			
			
			
			/* INGNORE BELOW 
			
			
			$html.='<div id="'.$value['NAME'].'">';
			    $html .= '<div id="q">'.$value['NAME'].'</div>';
	//$html .="<br>";
    $html .=$value['LABEL'];
    $html .="<br>";
	$html .=cimy_uef_sanitize_content($value['VALUE']);
	$html .= '</div>';
			$html .= '<hr>';
			*/
		}
		

	}
	
	$result_arr=array_merge($master_arr, $excellent_arr);
	if( count($result_arr<5) ){
		$result_arr = array_merge($result_arr,$average_arr);
	}
	if( count($result_arr<5) ){
		$result_arr = array_merge($result_arr,$basic_arr);
	}
	
//	print_r($result_arr);
$html = '';
for($i=0;$i<5;$i++){
	$html.='<div id="'. $result_arr[$i]['id'] .'">';
	//		    $html .= '<div id="q">'.$result_arr[$i]['id'].'</div>';
	//$html .="<br>";
	$assessmentQuestionPostID=$result_arr[$i]['shortlabel'];
	
//    $html .= $assessmentQuestionPostID;
/*
GET THE DESCRIPTION FROM THE CUSTOM POST TYPE AND NOT CIMY
*/
	$html .=  get_post_meta( $assessmentQuestionPostID, 'wpcf-job-seeker-q-short-desc', true );
    $html .="<br>";
	
	
	///SHOW SUB STARS
	$selfAssessmentVal=$result_arr[$i]['val'];
	//$html .=$result_arr[$i]['val'];
	
	if($selfAssessmentVal=='master'){
		$starCnt=5;
	}
	if($selfAssessmentVal=='excellent'){
		$starCnt=4;
	}
	if($selfAssessmentVal=='good'){
		$starCnt=3;
	}
	if($selfAssessmentVal=='average'){
		$starCnt=2;
	}
	if($selfAssessmentVal=='basic'){
		$starCnt=1;
	}
	$html .= '<div class="starSelfAssessment '.$selfAssessmentVal.'">';
	for($k=1;$k<=$starCnt;$k++){
			$html .= '<i class="fa fa-star"></i>';
		}
	$html .= '</div>';
	
	
	$html .= '</div>';
			$html .= '<hr>';
			
			 
	
}

	return $html;
}
function getHighestScoreQuestionsBACKUP($qType){
	global $current_user, $wp_roles;
	get_currentuserinfo();
	
	///OAP INFO
	$user = wp_get_current_user();
	
	$qCnt=0;
	$totQuestionToReturn=5;
	$sort_arr = array('master','excellent','good','average','basic');
	$html='';
	
//	$html .= count($sort_arr);
	for($s=0 ; $s<count($sort_arr); $s++){
	//$html .= $s;
		//
		for($i=1;$i<=35;$i++){
		
		$tmp=  $qType.'_Q'.$i;
		//echo "<br>".$tmp.": ";
		$value = get_cimyFieldValue($user->ID , $tmp );
		
			if($value){
				
				if($value==$sort_arr[$s]){
					$qCnt++;
					 
				$html .= $qCnt.': '. $value.'<br>';
				if($qCnt >= $totQuestionToReturn){
					break;
					}
			}
			
		
		}
		///break out of checking next
		if($qCnt >= $totQuestionToReturn){
					break;
					}
		
	}
		
	}
	
	return $html;

}
////
function getAvgStarRating($qType){
	$qCnt=0;
	$score=0;
	
	global $current_user, $wp_roles;
get_currentuserinfo();

///OAP INFO
$user = wp_get_current_user();
//echo 'uid: '.$user->ID;
	for($i=1;$i<=35;$i++){
		
		$tmp=  $qType.'_Q'.$i;
		//echo "<br>".$tmp.": ";
		$value = get_cimyFieldValue($user->ID , $tmp );
		
		if($value){
			$qCnt++;
		}
		///none,basic,average,good,excellent,master
		if($value=='basic'){
			$score=$score+1;
		}
		if($value=='average'){
			$score=$score+2;
		}
		if($value=='good'){
			$score=$score+3;
		}
		if($value=='excellent'){
			$score=$score+4;
		}
		if($value=='master'){
			$score=$score+5;
		}
		
		
		//echo get_cimyFieldValue($user->ID, $tmp  );

  
	}
	$avg=$score/$qCnt;
	//echo '<br>qcnt: '.$qCnt;
	//echo '<br>score: '.$score;
	//echo '<br>avg score: '.$avg;
	//echo '<br>floor: '.floor($avg);
	echo '<div class="starRating text-center">';
	for($j=1;$j<=5;$j++){
		if(floor($avg > $j) ){
			$starClass='fa-star';
		}else{
			$starClass='fa-star-o';
		}
		echo '<i class="fa '.$starClass.' fa-2x"></i>';
		
	}
	echo '<div>SELF RATING: '. number_format((float)$avg, 2, '.', '') .'</div>';
	echo'</div>';
	
}
?>

<ul id="assessmentsList" class="small-block-grid-1 medium-block-grid-2  text-center">
<li><div class="assessmentContainer"><h3>Tasks Assessment</h3>

  <?php 
//  print_r($user->roles);
  if( in_array('employer', $user->roles) ){
  	
	getAvgStarRating('TASKS'); 
  }
  
  echo getHighestScoreQuestions('TASKS');
  ?>
  <p><a href="/job-seekers/edit-profile/?m=tasks" class="button button-primary button-small"><i class="fa fa-pencil"></i> Edit</a></p>
</div>
</li>

<li><div class="assessmentContainer"><h3>Tech Assessment</h3>

<?php 
//  print_r($user->roles);
  if( in_array('employer', $user->roles) ){
  	
	getAvgStarRating('TECH'); 
  }
  echo getHighestScoreQuestions('TECH');
  ?>
   <p><a href="/job-seekers/edit-profile/?m=technology" class="button button-primary button-small"><i class="fa fa-pencil"></i> Edit</a></p>
  </div>
</li>
<li><div class="assessmentContainer"><h3>Knowledge Assessment</h3>
<?php 
//  print_r($user->roles);
  if( in_array('employer', $user->roles) ){
  	
	getAvgStarRating('KNOW'); 
  }
  echo getHighestScoreQuestions('KNOW');
  ?>
   <p><a href="/job-seekers/edit-profile/?m=knowledge" class="button button-primary button-small"><i class="fa fa-pencil"></i> Edit</a></p>
</div>
</li>
<li><div class="assessmentContainer"><h3>Skills Assessment</h3>
<?php 
//  print_r($user->roles);
  if( in_array('employer', $user->roles) ){
  	
	getAvgStarRating('SKILLS'); 
  }
  echo getHighestScoreQuestions('SKILLS');
  ?>
   <p><a href="/job-seekers/edit-profile/?m=skills" class="button button-primary button-small"><i class="fa fa-pencil"></i> Edit</a></p>
</div></li>
<li><div class="assessmentContainer"><h3>Abilities Assessment</h3>
<?php 
//  print_r($user->roles);
  if( in_array('employer', $user->roles) ){
  	
	getAvgStarRating('ABILITY'); 
  }
  echo getHighestScoreQuestions('ABILITY');
  ?>
   <p><a href="/job-seekers/edit-profile/?m=abilities" class="button button-primary button-small"><i class="fa fa-pencil"></i> Edit</a></p>
  </div>
</li>
<li>
 <div class="assessmentContainer"> <h3>Work Activities</h3>

<?php 
//  print_r($user->roles);
  if( in_array('employer', $user->roles) ){
  	
	getAvgStarRating('WORK_ACT'); 
  }
  echo getHighestScoreQuestions('WORK_ACT');
  ?>
   <p><a href="/job-seekers/edit-profile/?m=activities" class="button button-primary button-small"><i class="fa fa-pencil"></i> Edit</a></p>
  </div>
</li>
</ul>
</section>

<section class="clearfix paddedTop paddedBottom" style="display:none;">             
 
             <div class="row" >
             <div class="col-md-4">
			 <h2>Add a Note</h2>       
			 <?php echo do_shortcode('[contact-form-7 id="2853" title="Notes - Job Seekers"]');?>
             </div>
             
             <div class="col-md-8">
             <h2>Your Notes History</h2>       
             
             <?php echo do_shortcode( '[cfdb-table form="Notes - Job Seekers" class="notes-table" role="Anyone" show="Submitted,your-message" filter="contact-id='.$contact_id.'"  ]  '  );?>
             </div>
             
             </div>
             
             </section>
             <div id="mktg" class="paddedBottom" style="display:none;">
 <img src="http://eyerecruit.com/assets/uploads/2015/11/tmp.jpg" style="max-width:100%; height:auto;">
 </div>

</div><!-- end mid section -->

<div class="col-md-3 col-md-pull-9 ">     
	<section class="swatch3 padded-sm ">
	<h3 class="tightTop">Contact</h3>
	<!-- UPDATE -->
		
	<!-- ADDRESS -->
	<section>
		<div class="iconcircle marker">
			<div id="address_disp">
			{ADDRESS}
			<div id="locale">
			{CITY,STATE,ZIP}
			</div>
			</div>
		</div>
 	</section>

<!-- PHONE -->
         <div class="iconcircle mobile">
         
       <p id="usrEmailPhone">

{MOBILE}
</p>
        </div>

 <!-- EMAIL -->
             <div class="iconcircle envelope">
          <p id="usrEmailAddy">
<?php
$useremail='{EMAIL}' ;
?>
<a href="mailto:<?php echo $useremail;?>"> <?php echo $useremail;?>  </a>
</p> 
        </div>
        
        <!-- edit -->
<div class="text-center"><a id="editAddyLink" href="#" class="sectionEdit"><i class="fa fa-pencil"></i> EDIT</a></div>
        </section>
        
        <section class="swatch3 padded-sm marginTop">
         <!-- SOCIAL -->
         <h3 class="tightTop">Get Social</h3>
        
         <?php
		 $socialCnt=0;
		 //fb
		 if( true ){
		 $socialCnt++;
		 echo '<a href="#" target="_blank"><i class="fa fa-2x fa-facebook"></i></a>';
		 }
		 
		 //linkedin
		 if( true ){
		 $socialCnt++;
		 echo ' <a href="#" target="_blank"><i class="fa fa-2x fa-linkedin"></i></a>';
		 }
		 //twitter
		 if( true ){
		 $socialCnt++;
		 echo ' <a href="#"><i class="fa fa-2x fa-twitter"></i></a>
';
		 }
		 
		 //googleplus
		 if( true ){
		 $socialCnt++;
		 echo ' <a href="#"><i class="fa fa-2x fa-google-plus"></i></a>
';
		 }
		 
		 //skype
		 if( true ){
		 $socialCnt++;
		 echo ' <a href="skype:#?chat"><i class="fa fa-2x fa-twitter"></i></a>
';
		 }
		 ?>
         
          <?php
		  if($socialCnt==0){
			
		 ?>
         <p>No social media accounts exist, if you have any, please update the form below and let us know.</p>
         
		 <?php
		 }else{
		 ?>
         <style>
		 #social_edit{display:none;}
		 
		 .starSelfAssessment{
			 font-family:'FontAsesome'; 
			 }
			 
			 
		 
		 </style>
         <?php
		 }
		 ?>
		 
         
         
        
         
         <a id="editSocialLink" href="#" class="sectionEdit"><i class="fa fa-pencil"></i> ADD/EDIT</a>
         
</section><!-- swatch -->

		
           
           
            

            <section id="atAGlance" class="swatch3 padded-sm marginTop">
            <h3 class="tightTop">At a Glance</h3>
            <section id="qa" class="clearfix">

<div id="glanceQ" >
<?php
 
    $values = get_cimyFieldValue($user->ID, false);
	$i=0;
//	echo '<ol class="twoCol">';
	
    foreach ($values as $value) {
   	
		$showBasicQ=true;
	   
	   if (strpos( $value['NAME']  ,'PREM_') !== false) {
			$showBasicQ = false;
		}
		if (strpos( $value['NAME']  ,'ULT_') !== false) {
			$showBasicQ = false;
		}
		if (strpos( $value['NAME']  ,'TASKS_') !== false) {
			$showBasicQ = false;
		}
		if (strpos( $value['NAME']  ,'TECH_') !== false) {
			$showBasicQ = false;
		}
		if (strpos( $value['NAME']  ,'KNOW_') !== false) {
			$showBasicQ = false;
		}
		if (strpos( $value['NAME']  ,'SKILLS_') !== false) {
			$showBasicQ = false;
		}
		if (strpos( $value['NAME']  ,'ABILITY_') !== false) {
			$showBasicQ = false;
		}
		if (strpos( $value['NAME']  ,'WORK_ACT_') !== false) {
			$showBasicQ = false;
		}
		if (strpos( $value['NAME']  ,'JOB_SEEKER_TYPE') !== false) {
			$showBasicQ = false;
		}
		
		
		$i++;
		
		if($showBasicQ){
			 echo '<p id="glance_'.  $value['NAME'] .'">';
			 
			 $profileBasicQTotal++;
			echo '<strong >'.$value['LABEL'].': </strong>';
			$valStr='N/A';
			if($value['VALUE'] && $value['VALUE'] != "Select" && $value['VALUE'] != "Select all that apply"){
				$valStr=cimy_uef_sanitize_content($value['VALUE']);
				$profileBasicQAnswered++;
			}
			echo '<small>';
			echo $valStr;
			echo '</small></p>';
		}
    }///end for eacxh
	//echo '</ol>';
?>
</div>
<div class="clearfix ">
<a href="http://eyerecruit.com/job-seekers/edit-profile/" class="button button-primary button-small"><i class="fa fa-pencil"></i> Edit Basic Profile</a>
</div>

</section>
<a href="http://eyerecruit.com/job-seekers/edit-profile/" class="sectionEdit"><i class="fa fa-pencil"></i> EDIT</a>

            </section>
            </div><!-- end left col -->
</div>
<!-- base structionre -->
        
            
             </div>
             



               
		</div><!-- #content -->

		<?php do_action( 'jobify_loop_after' ); ?>
	</div><!-- #primary -->

 <?php
			if($profileBasicQAnswered < $profileBasicQTotal){
				
				?>
                <div id="alertWindow" class="alert alert-info">

<div><?php echo do_shortcode('[wp_charts title="myprogress" type="doughnut" align="alignleft" width="48px" height="auto" margin="2px 20px" data="'.$profileBasicQAnswered.','.($profileBasicQTotal-$profileBasicQAnswered).'" colors="#a12641,#eeeeee" labels="pct complete"]'); ?></div>

                <h4 style="display:inline;"><strong>Your Profile is <?php echo floor(($profileBasicQAnswered/$profileBasicQTotal)*100); ?>% complete.</strong></h4> <!-- Answered <?php echo $profileBasicQAnswered; ?> of <?php echo $profileBasicQTotal; ?>. -->  <br>
                <a href="/job-seekers/edit-profile/" style="text-decoration:underline;">Edit</a> the "Basic" section of your profile to complete.</div>
                <script>
                jQuery(document).ready(function(e) {
                    jQuery("#alertWindow").prependTo("#topSection");
                });
                </script>
                <?php
			}
			?>

<script>
jQuery(document).ready(function(){
	jQuery(".footer-cta").remove();
	jQuery("input[name=contact-id]").val( <?php echo $contact_id;?> );
	jQuery("input[name=your-email]").val( "<?php echo $useremail;?>" );
	
	jQuery("input[name=your-name]").val( jQuery("#userName").text()   );
	
	
jQuery(".wpua-edit-container br, .wpua-edit-container h3").remove();
jQuery('.wpua-edit #submit').addClass('button-small').val('Update Pic');
jQuery('.avatar-container #delete_avatar').addClass('button-small');

var tmp=jQuery("#address1");
if(tmp.length < 0 ){
tmp.remove();
}

jQuery("#resumes tfoot a").addClass('button button-primary button-small');



});
</script>




<style>
#userName{font-size:3rem;}
section{position:relative;}
div.multiCol {
	-webkit-column-count:2;   
    -moz-column-count:2;
    -ms-column-count:2;
    -o-column-count:2;
    column-count:2;
    -webkit-column-gap:15px;   
    -moz-column-gap:15px;
    -ms-column-gap:15px;
    -o-column-gap:15px;
    column-gap:15px;
    columns:2;
}

ol li{margin-bottom:1rem;}
.assessmentContainer{position:relative; padding:1rem;}
div.locked{background:rgba(0,0,0,.8); color:#fff; padding:2rem; position:absolute; top:0; left:0; width:100%; height:100%; z-index:10;}
#address_edit {display:none;}

.sectionEdit{position:absolute; right:15px; top:15px; font-size:.8rem;}
#hdr_overview strong{text-transform:uppercase;}
#glanceQ p{margin-bottom:1rem;}
#overviewContainer1 p{margin:0;}
#supportDocs ul ul{margin-bottom:2rem; padding-left:1rem;}
</style>


<script>
function relabel(qID,str){
	jQuery("#"+qID +" > strong").text(str+": ");
}

jQuery("#editAddyLink").click(function(e) {
    e.preventDefault();
	//jQuery("#address_disp").hide();
	jQuery("#address_edit").fadeIn('slow');
		jQuery("#address_edit #mr-field-element-614460997321").val(jQuery("#usrEmailAddy").text() );
});

jQuery("#editSocialLink").click(function(e) {
    e.preventDefault();
	//jQuery("#address_disp").hide();
	jQuery("#social_edit").fadeIn('slow');
		jQuery("#social_edit #mr-field-element-614460997321").val(jQuery("#usrEmailAddy").text() );
});

jQuery("#social_edit #mr-field-element-614460997321").val(jQuery("#usrEmailAddy").text() );

/* CANCEL EDIT FORMS */
jQuery(".cancelEdit").click(function(e) {
    e.preventDefault();

});

//RELABEL GLANCE Q
relabel('glance_JOB_SEARCH_AGRESS','Status');
relabel('glance_BEST_INDUSTRY','Category');
relabel('glance_INDUSTRY_YEARS','Experience');
relabel('glance_COMPENSATION_CURRENT','Current Comp');
relabel('glance_COMPENSATION_DESIRED','Comp Desired');

relabel('glance_JOB_SEARCH_RADIUS','Radius');
relabel('glance_RELOCATION_YN','Willing to relocate');
relabel('glance_LANGUAGES_SPOKEN','Spoken Language(s)');
relabel('glance_US_ELIGIBLE','US Eligible');
/* AT A GLANCE RELABEL */
relabel('glance_REF_SRC','Referred By');
relabel('glance_RELIABLE_TRANSPORT','Transportation');
relabel('glance_DRIVER_STATE','Active DL State');
relabel('glance_FIELD_LICENSE_STATUS','Professional License(s)');
relabel('glance_FIELD_LICENSE_STATE','State(s)');
relabel('glance_US_ARMED_FORCES','Armed Forces');
relabel('glance_US_LAW_ENFORCE_STATU','Active Military or Law Enforcement');
relabel('glance_OVER_18_YN','Over 18?');
relabel('glance_WORK_DATE_AVAILABLE','Date available');
relabel('glance_CURR_EMPLOYED_YN','Currently employed?');
relabel('glance_CUR_WORK_SITUATION','Current work situation?');
relabel('glance_CURR_CAREER_LVL','Career level');
relabel('glance_WORK_EXP_AREA','Areas of experience');
relabel('glance_LOCAL_LAW_FORCE_YN','Current/previous local/state law enforcement');
relabel('glance_HIGHEST_EDUCATION','Highest education completed');
relabel('glance_EDUCATION_GRAD_YEAR','Graduation year');
relabel('glance_EDU_SCHOOL_NAME','School');
relabel('glance_EDU_MAJOR_STUDY','Field of study');
relabel('glance_SECURITY_CLEAR_YN','Security clearance');
//AT A GLANCE ORDER
var tmpID_arr=Array(
"#glance_REF_SRC",
"#glance_OVER_18_YN",
"#glance_WORK_DATE_AVAILABLE",
"#glance_CURR_EMPLOYED_YN",
"#glance_CUR_WORK_SITUATION",
"#glance_CURR_CAREER_LVL",
"#glance_WORK_EXP_AREA",
"#glance_RELIABLE_TRANSPORT",
"#glance_DRIVER_STATE",
"#glance_FIELD_LICENSE_STATUS",
"#glance_FIELD_LICENSE_STATE",
"#glance_SECURITY_CLEAR_YN",
"#glance_US_ARMED_FORCES",
"#glance_LOCAL_LAW_FORCE_YN",
"#glance_US_LAW_ENFORCE_STATU",
"#glance_DES_WORK_TYPE",
"#glance_HIGHEST_EDUCATION",
"#glance_EDUCATION_GRAD_YEAR",
"#glance_EDU_SCHOOL_NAME",
"#glance_EDU_MAJOR_STUDY"
);

for (i=0;i<tmpID_arr.length;i++){
	jQuery( tmpID_arr[i] ).appendTo("#glanceQ");
}
jQuery("<hr>").insertBefore("#glance_RELIABLE_TRANSPORT");
jQuery("<hr>").insertBefore("#glance_FIELD_LICENSE_STATUS");
jQuery("<hr>").insertAfter("#glance_FIELD_LICENSE_STATE");
jQuery("<hr>").insertAfter("#glance_DES_WORK_TYPE");
jQuery("<hr>").insertAfter("#glance_REF_SRC");
jQuery("<hr>").insertAfter("#glance_EDU_MAJOR_STUDY");
/* END AT A GLANCE */


/* MOVE STUFF */
jQuery("#hdr_overview #availability").empty().append( jQuery("#glance_JOB_SEARCH_AGRESS ") );
/* APPEND TO DIV NEXT TO AVATAR */
tmpID_arr=Array("#glance_BEST_INDUSTRY","#glance_INDUSTRY_YEARS","#glance_COMPENSATION_CURRENT", "#glance_COMPENSATION_DESIRED","#glance_JOB_SEARCH_RADIUS","#glance_RELOCATION_YN","#glance_LANGUAGES_SPOKEN","#glance_LANGUAGES_WRITTEN","#glance_US_ELIGIBLE");
for (i=0;i<tmpID_arr.length;i++){
	jQuery( tmpID_arr[i] ).appendTo("#overviewContainer1");
}

</script>

<style>
#supportDocs h2, #supportDocs h3, #assessments h3{margin-top:0;}
</style>


<?php get_footer(); ?>


