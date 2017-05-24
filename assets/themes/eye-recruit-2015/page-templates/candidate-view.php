<?php
/**
 * Template Name: Candidate View
 *
 * @package Jobify
 * @since Jobify 1.0
 */
/*
TEMPLATE FOR ADMINS, RECRUITERS, TO BE ABLE TO VIEW CANDIATE
*/
 get_header(); ?>

<?php
///TEST VARIABLE
	$uID = 51;
	if($_REQUEST['uID']){
		$uID 					=	$_REQUEST['uID'];
	}
	$_SESSION['er_candidateID']	=  	$uID;
	$_SESSION['hideToEmployer'] =	true;
	/*	
	CHECK TO SEE IF EMPLOYEE HAS SET THEIR PROFILE/RESUME TO HIDDEN.  IF SO DO NOT DISPLAY
	*/
	function anonymousCandidateSection(){
	
		if($currUser=='employer' && $_SESSION['hideToEmployer']==true){
		return true;
		}
		return false;
	}
	    
	global $current_user, $wp_roles;
		get_currentuserinfo();

	$candidate 				= get_user_by( 'id', $uID );
		$curr_user 				= wp_get_current_user();
		//ROLES INCLUDE: for administrator, employer, candidate 


		$userMeta            	= get_user_meta($candidate->ID);
		
		


	

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
			$shortlabel		='English language proficiency';
			break;
			
			case "KNOW_Q2":
				$shortlabel	='Laws, codes, procedures & regulations';
			break;
			case "KNOW_Q3":
				$shortlabel	='Public Safety & Security strategies';
			break;
			case "KNOW_Q4":
				$shortlabel	='Media production & dissemination';
			break;
			case "KNOW_Q5":
				$shortlabel	='Computers, electronics & applications ';
			break;
			case "KNOW_Q6":
				$shortlabel	='Administrative, clerical & procedures';
			break;
			case "KNOW_Q7":
				$shortlabel	='Geographic interrelationships';
			break;
			case "KNOW_Q8":
				$shortlabel	='Curriculum, training, teaching & instruction';
			break;
			case "KNOW_Q9":
				$shortlabel	='Philosophical, religious customs & practices';
			break;
			case "KNOW_Q10":
				$shortlabel	='Group dynamics, influences & societal trends';
			break;
			case "KNOW_Q11":
				$shortlabel	='Behavior, performance, learning & motivation';
			break;
			case "KNOW_Q12":
				$shortlabel	='Customer service, needs assessments & satisfaction';
			break;
			case "KNOW_Q13":
				$shortlabel	='Administration, management, planning & leadership';
			break;
			case "KNOW_Q14":
				$shortlabel	='Telecommunications transmissions & broadcasting';
			break;
		}
	}
	///end knowledge
	
	return $shortlabel;
} ?>

<?php 
	if(!is_user_logged_in() ){
		?>
	    <div id="modal1">
		  <p>Hey, it looks like you're not  registered yet! To see this and other quailified Job Seekers in the Security, Investigation and Surveillance industry in your area, just sign up and start searcing! It's free to look. You are under no obligation.</p>
		  <p>Get Started Now</p>
		</div>
	    <?php
		exit();
	} 
?>




	<header class="page-header">
		<h1 class="page-title"><?php echo $curr_user->roles[0];?> > <?php the_title(); ?><br></h1>

	</header>

	<div id="primary" class="content-area">
	  <div id="content" class="container" role="main">
	   <section id="topSection" class="paddedTop">
			<?php 
			if($_GET['noteSubmitted']==1){
			?>
				<div class="alert alert-info marginBottom">
					Your note was successfully added.
				</div>
			<?php
			}
			?>

			<div class="row">
				<div class="col-md-6">
				<!-- NAME -->
				<?php 
				
				if( anonymousCandidateSection() == false ){

				$candidateName = 'JOHN DOE';
				if( allowViewFor(array('administrator','recruiter') ) ){
				$candidateName = 'JOHN DOE';
				}

				}else{
					$candidateName='Anonymous';
				}
				?>
				<h1 class="tight" ><span id="userName"><?php echo $candidateName; ?></span></h1>
					<strong>Recruit ID: <?php echo get_current_user_id();?></strong> 
				</div>
				<div class="col-md-6">
					<ul id="hdr_overview" class="medium-block-grid-2">
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
						<li>
							<strong>PROFILE VIEWS:</strong> <small> 
						<i class="fa fa-lock"></i> Coming Soon</small>
						</li>
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
<div class="col-sm-3 text-center">
<?php 
if( anonymousCandidateSection() == false ){
	echo get_wp_user_avatar($uID);
	//  echo get_avatar( $uID);
}else{
	//default avatar
	?>
    <img src="http://www.gravatar.com/avatar/?d=mm&s=128" />
    <?php
}
 ?>
 </div>

<div id="overviewContainer1" class="col-sm-7">
</div>

<div class="col-sm-2 text-center"><section id="yourRecruiter" class="clearfix marginBottom-2x">
<h4 class="tightTop"> </h4>
 
 </section></div>
</div> 
<!-- END ROW -->
 

<section id="resumes" class=" padded-sm swatch2 marginTop-2x marginBottom-2x">
 
<h2 class="tightTop" ><i class="fa fa-files-o"></i>  RESUMES</h2>
<?php 

// echo do_shortcode('[candidate_dashboard]');
$resumeIDs_arr=getResumeIds($uID,array('publish'));
if( count($resumeIDs_arr)>0 ){
	for($i=0;$i<count($resumeIDs_arr);$i++){
		$resumeID=$resumeIDs_arr[$i];
		/*
		$resume_content_post = get_post($resumeID);
		$resume_content = $resume_content_post->post_content;
		$resume_content = apply_filters('the_content', $resume_content);
		$resume_content = str_replace(']]>', ']]&gt;', $resume_content);
		echo $resume_content;
		NAME: <?php echo get_the_title($resumeID); ?><br>
		*/
		$resumeMeta=get_post_meta($resumeID);
		?>
        <div class="resumeOverview">
        <div class="row ">
        <div class="col-sm-4">
        	<h3 class="tight"><?php echo $resumeMeta['_candidate_title'][0]; ?></h3>
        </div>
        <div class="col-sm-4">
        LOCATION: <?php echo $resumeMeta['_candidate_location'][0]; ?><br>
        DESIRED COMPENSATION: <?php echo $resumeMeta['_desired_pay_salary'][0]; ?><br>
        </div>
        <div class="col-sm-4 text-right">
        <a href="<?php echo get_post_permalink($resumeID);  ?>" class="button button-small" target="resumeWindow">VIEW</a>
        </div><!-- col -->
       	</div>
        </div>
        
        
        
        <?php // echo $resume_content; ?>
		<?php
	}
	/*
	for($i=0;$i<count($resumeIDs_arr);$i++){
		?>
        <p>resume id:<?php echo $resumeIDs_arr[i]; ?></p>
        <p>Name: </p>
        <?php
	}
	
	*/
	//print_r($resumeIDs_arr);
}else{
	?>
    <p>This user has no published resumes.</p>
	<?php
    }
	//////END RESUME LISTING
?>


 
</section>

<section id="supportDocs" class="clearfix padded-sm swatch2 marginBottom-2x">
<h2 class="tightTop"><i class="fa fa-download"></i> SUPPORT DOCUMENTS</h2>
<div class="row">
<div class="col-md-4"><h3>Certificates</h3>
<?php echo showCertificatesFileList($candidate->ID); ?>
<p><a href="/job-seekers/edit-profile/?m=docs-certs" class="button button-primary button-small editBtn"><i class="fa fa-pencil"></i> Edit</a></p></div>
<div class="col-md-4"><h3>Achievements</h3>
<?php echo showAchievementsFileList($candidate->ID); ?>
<p><a href="/job-seekers/edit-profile/?m=docs-achievements" class="button button-primary button-small editBtn"><i class="fa fa-pencil"></i> Edit</a></p></div>
<div class="col-md-4"><h3>Background Checks</h3>
<?php echo showBackgroundCheckList($candidate->ID); ?>
<p><a href="/job-seekers/edit-profile/?m=docs-bgchecks" class="button button-primary button-small editBtn"><i class="fa fa-pencil"></i> Edit</a></p></div>
</div>



</section>

 
<div id="assessments"  class="clearfix">
<h2 class="text-center tightTop">PROFESSIONAL SELF-ASSESSMENTS</h2>
<section id="assessmentTabsWrapper">
<div class="clearfix">

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#t1" aria-controls="t1" role="tab" data-toggle="tab">Tasks</a></li>
    <li role="presentation"><a href="#t2" aria-controls="t2" role="tab" data-toggle="tab">Tech</a></li>
    <li role="presentation"><a href="#t3" aria-controls="t3" role="tab" data-toggle="tab">Knowledge</a></li>
    <li role="presentation"><a href="#t4" aria-controls="t4" role="tab" data-toggle="tab">Skills</a></li>
    <li role="presentation"><a href="#t5" aria-controls="t5" role="tab" data-toggle="tab">Abilities</a></li>
    <li role="presentation"><a href="#t6" aria-controls="t6" role="tab" data-toggle="tab">Work Activities</a></li>
   <!--  <li role="presentation"><a href="#t7" aria-controls="t7" role="tab" data-toggle="tab">Settings</a></li> -->
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="t1"><h3>Tasks Assessment</h3>

  <?php 
  //print_r($curr_user->roles);
  
	getAvgStarRatingV2('TASKS',$uID); 
 
  
  echo getHighestScoreQuestionsV2('TASKS',$uID);
  ?>
  <p><a href="/job-seekers/edit-profile/?m=tasks" class="button button-primary button-small editBtn"><i class="fa fa-pencil"></i> Edit</a></p></div>
    <div role="tabpanel" class="tab-pane" id="t2"><h3>Tech Assessment</h3>

<?php 
//  print_r($user->roles);
  	
	getAvgStarRatingV2('TECH',$uID); 
  
  echo getHighestScoreQuestionsV2('TECH',$uID);
  ?>
   <p><a href="/job-seekers/edit-profile/?m=technology" class="button button-primary button-small editBtn"><i class="fa fa-pencil"></i> Edit</a></p></div>
    <div role="tabpanel" class="tab-pane" id="t3"><h3>Knowledge Assessment</h3>
<?php 
//  print_r($user->roles);
  	
	getAvgStarRatingV2('KNOW',$uID); 

  echo getHighestScoreQuestionsV2('KNOW',$uID);
  ?>
   <p><a href="/job-seekers/edit-profile/?m=knowledge" class="button button-primary button-small editBtn"><i class="fa fa-pencil"></i> Edit</a></p></div>
    <div role="tabpanel" class="tab-pane" id="t4"><h3>Skills Assessment</h3>
<?php 
//  print_r($user->roles);
  	
	getAvgStarRatingV2('SKILLS',$uID); 
  
  echo getHighestScoreQuestionsV2('SKILLS',$uID);
  ?>
   <p><a href="/job-seekers/edit-profile/?m=skills" class="button button-primary button-small editBtn"><i class="fa fa-pencil"></i> Edit</a></p></div>
    <div role="tabpanel" class="tab-pane" id="t5"><h3>Abilities Assessment</h3>
<?php 
//  print_r($user->roles);
  
  	
	getAvgStarRatingV2('ABILITY',$uID); 
  
  echo getHighestScoreQuestionsV2('ABILITY',$uID);
  ?>
   <p><a href="/job-seekers/edit-profile/?m=abilities" class="button button-primary button-small editBtn"><i class="fa fa-pencil"></i> Edit</a></p></div>
    <div role="tabpanel" class="tab-pane" id="t6"><h3>Work Activities</h3>

<?php 
//  print_r($user->roles);
  	
	getAvgStarRatingV2('WORK_ACT',$uID); 
  
  echo getHighestScoreQuestionsV2('WORK_ACT',$uID);
  ?>
   <p><a href="/job-seekers/edit-profile/?m=activities" class="button button-primary button-small editBtn"><i class="fa fa-pencil"></i> Edit</a></p></div>
<!--     <div role="tabpanel" class="tab-pane" id="t7">...</div> -->
  </div>

</div>
</section>
<br class="clearfix">
</div>

 


             <div id="mktg" class="paddedBottom" style="display:none;">
 <img src="http://eyerecruit.com/assets/uploads/2015/11/tmp.jpg" style="max-width:100%; height:auto;">
 </div>

</div><!-- end mid section -->

<div class="col-md-3 col-md-pull-9 ">     
 

             <section class="swatch3 padded-sm ">
             <h3 class="tightTop">Contact</h3>
            <!-- UPDATE -->
           
            <!-- ADDRESS -->
            
<?php
		if(allowViewFor(array('administrator') )   ):
	?>
                   <section>
                 
                <div class="iconcircle marker">
<div id="address_disp">
{ADDRESS DISPLAY}



<div id="locale">
{locale}
</div>
</div>
</div>
</section>
    <?php
	///END RESTRICTION FOR ADDRESS
			endif;
			?>
 

<!-- PHONE -->
         <div class="iconcircle mobile">
         
       <p id="usrEmailPhone">

{mobile}
</p>
        </div>

 <!-- EMAIL -->
             <div class="iconcircle envelope">
          <p id="usrEmailAddy">
<?php
$useremail='{email}' ;
?>
<a href="mailto:<?php echo $useremail;?>"> <?php echo $useremail;?>  </a>
</p> 
        </div>
        
        <!-- edit -->
<div class="text-center"><a id="editAddyLink" href="#" class="sectionEdit "><i class="fa fa-pencil"></i> EDIT</a></div>
        </section>
        
        <?php
		///SOCIAL RESTRCITION
		if(allowViewFor(array('administrator') )   ):
	?>
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
		 if(true ){
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
		 
         
         <div id="social_edit" class="socialFormWrapper"  >
{EDIT SOCIAL FORM}
</div>
        
         
         <a id="editSocialLink" href="#" class="sectionEdit"><i class="fa fa-pencil"></i> ADD/EDIT</a>
         
</section><!-- swatch -->

		<?php endif;//SOCIAL RESTRCITON ?>
           
           
            

            <section id="atAGlance" class="swatch3 padded-sm marginTop">
            <h3 class="tightTop">At a Glance</h3>
            <section id="qa" class="clearfix">

<div id="glanceQ" >
<?php
 
    $values = get_cimyFieldValue($candidate->ID, false);
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
			 
			 
			echo '<strong >'.$value['LABEL'].': </strong>';
			$valStr='N/A';
			if($value['VALUE'] && $value['VALUE'] != "Select" && $value['VALUE'] != "Select all that apply"){
				$valStr=cimy_uef_sanitize_content($value['VALUE']);
			}
			echo '<small>';
			echo $valStr;
			echo '</small></p>';
		}
    }///end for eacxh
	//echo '</ol>';
?>
</div>


</section>
<a href="http://eyerecruit.com/job-seekers/edit-profile/" class="sectionEdit"><i class="fa fa-pencil"></i> EDIT</a>

            </section>
            </div><!-- end left col -->
</div>
<!-- base structionre -->
        
        <?php
		///RESTRICGT NOTES VIEW
		if(allowViewFor(array('administrator','employer') )   ):
		?>
        <section id="candidateNotes" class="clearfix paddedTop paddedBottom"  >             
 
             <div class="row" >
             <div class="col-md-4">
			 <h2>Add a Note</h2>       
			 <?php echo do_shortcode('[contact-form-7 id="2853" title="Notes - Job Seekers"]');?>
             </div>
             
             <div class="col-md-8">
             <h2>Notes History</h2>       
             
             <?php echo do_shortcode( '[cfdb-table form="Notes - Job Seekers" class="notes-table" role="Anyone" show="isPrivate,Submitted,notes,Submitted Login" filter="contact-id='. get_current_user_id() .'" headers="Submitted Login=Submitted By,isPrivate=Private?" ]  '  );?>
             </div>
             
             </div>
             
             </section>
            <?php endif;//RESTRICTION FOR NOTES VIEW ?>
             </div>
             



               
		</div><!-- #content -->

		<?php do_action( 'jobify_loop_after' ); ?>
	</div><!-- #primary -->

<?php
//FILTER PRIVATE FOR EMPLOYERS
if(allowViewFor(array('employer','recruiter'))):
	//echo 'curr user login is: '.$curr_user->user_login;
	?>
    <script>
	  jQuery(".notes-table tr").each(function(index, element) {
   tgtRow=jQuery(this);
    if(tgtRow.find('[title="isPrivate"] > div').text()=="private"){
		if(tgtRow.find('[title="Submitted Login"] > div').text()!="<?php echo $curr_user->user_login; ?>"){
			tgtRow.remove();	
		}
		
	}
});
	</script>
    <?php
	endif;//RESTRICTION FOR PRIVATE REMOVAL
?>

 <script>
 
jQuery(document).ready(function(){
	jQuery(".footer-cta").remove();
	jQuery(".qContainer").addClass("clearfix");
	jQuery(".qContainer .question").addClass("col-sm-8");
	jQuery(".qContainer .starSelfAssessment").addClass("col-sm-4 text-right");
	
	jQuery("input[name=contact-id]").val( <?php echo get_current_user_id();?> );
	jQuery("input[name=your-email]").val( "<?php echo $useremail;?>" );

	
	
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
.page-header p{font-size:1rem; text-transform:uppercase; color:#ccc;}
.resumeOverview{border-bottom:1px solid #ccc;}
div.wpcf7-mail-sent-ok { display:none !important; }
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


<script>
jQuery('.editBtn, .sectionEdit').remove();
</script>

<style>
#supportDocs h2, #supportDocs h3, #assessments h3{margin-top:0;}
</style>

<?php get_footer(); ?>