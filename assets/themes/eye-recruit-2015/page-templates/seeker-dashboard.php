<?php
/**
 * Template Name: Job Seeker Dashboard
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
//die;
global $current_user, $wp_roles;
get_currentuserinfo();

///OAP INFO
$user = wp_get_current_user();
$userMeta=get_user_meta($user->ID);

///need logic for accounttype: Ultimate,Premium,Plus
$accountType='Basic';
 



get_header(); ?>
 

	<header class="page-header">
		<h1 class="page-title"><?php the_title(); ?></h1>
	</header>

	<div id="primary" class="content-area">
		<div id="content" class="container" role="main">
			 
             
             <section id="topSection" class="paddedTop">
<div class="row">
<div class="col-md-9">

<div id="yourInfo" class="row">
<div class="col-md-3"><?php echo do_shortcode('[avatar_upload size="large"]') ?></div>

<div class="col-md-9">


<?php // print_r($userMeta); ?>

<h1 style="margin-bottom:0; padding-bottom:0;" ><span id="userName">{USERNAME}</span></h1>
<strong>Recruit ID: {USER ID}</strong> | Account Type: <?php echo $accountType;?>
<p class="marginTop-2x borderBottom"><strong>Your Address</strong> <a href="#">(Edit)</a></p>
{ADDRESS}


<div id="locale">
{CITY,STATE,ZIP}
</div>


<?php
$useremail='{EMAIL}' ;
?>
<a href="mailto:<?php echo $useremail;?>"> <?php echo $useremail;?>  </a>
 

 
</div>
</div>
</div>

<div class="col-md-3 text-center"  ><img src="http://eyerecruit.com/assets/uploads/2015/11/tmp.jpg" style="max-width:100%; height:auto;"></div>




</div>

</section>
 
 <section id="yourRecruiter" class="clearfix paddedAll swatch2 marginBottom-2x">

<?php echo do_shortcode('[your_recruiter][/your_recruiter]'); ?>
 </section>

<section id="resumes" class="clearfix paddedAll swatch2 marginBottom-2x">
 
<h2 ><i class="fa fa-files-o"></i> MY RESUMES</h2>
 
<?php echo do_shortcode('[candidate_dashboard]');?>


 
</section>

<section id="bookmarks" class="clearfix paddedAll swatch2 marginBottom-2x">
<h2><i class="fa fa-bookmark-o"></i> MY JOB BOOKMARKS</h2>
<?php echo do_shortcode('[my_bookmarks]');?>
<a href="http://eyerecruit.com/job-seekers/job-alerts/?action=add_alert" class="button button-primary button-small"><i class="fa fa-bell-o"></i>create a job alert</a>
</section>

<section id="qa" class="clearfix paddedAll swatch2 marginBottom-2x">
<h2><i class="fa fa-question-circle"></i> Profile Overview</h2>

<h3>Basic</h3>
<div class="multiCol">
<?php
 
    $values = get_cimyFieldValue($user->ID, false);
	echo '<ol class="twoCol">';
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
		
		
		
		if($showBasicQ){
			 echo '<li>';
			 //echo $value['NAME'];
			 //echo "<br>";
			echo $value['LABEL'];
			echo '<br><small>';
			echo cimy_uef_sanitize_content($value['VALUE']);
			echo '</small></li>';
		}
    }///end for eacxh
	echo '</ol>';
?>
</div>
<div class="clearfix paddedTop-2x">
<a href="http://eyerecruit.com/job-seekers/edit-profile/" class="button button-primary button-small"><i class="fa fa-pencil"></i> Edit Profile Overview</a>
</div>
</section>



<section id="assessments" class="clearfix paddedAll swatch2 marginBottom-2x">
<h2>ASSESSMENTS BREAKDOWN</h2>

<?php
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
	echo '<div>'. number_format((float)$avg, 2, '.', '') .'</div>';
	echo'</div>';
	
}
?>

<ul id="assessmentsList" class="medium-block-grid-3 text-center">
<li><div class="assessmentContainer"><h3>Tasks Assessment</h3>

  <?php getAvgStarRating('TASKS'); ?>
</div>
</li>
<li><div class="assessmentContainer"><h3>Tech Assessment</h3>

<?php getAvgStarRating('TECH'); ?></div>
</li>
<li><div class="assessmentContainer"><h3>Knowledge Assessment</h3>
<?php getAvgStarRating('KNOW'); ?></div>
</li>
<li><div class="assessmentContainer"><h3>Skills Assessment</h3>
<?php getAvgStarRating('SKILLS'); ?>
</div></li>
<li><div class="assessmentContainer"><h3>Abilities Assessment</h3>
<?php getAvgStarRating('ABILITY'); ?></div>
</li>
<li>
 <div class="assessmentContainer"> <h3>Work Activities</h3>

<?php getAvgStarRating('WORK_ACT'); ?></div>
</li>
</ul>
<div id="editAssessmentsBtnWrapper" class="clearfix paddedTop-2x">
<a href="http://eyerecruit.com/job-seekers/edit-profile/" class="button button-primary button-small"><i class="fa fa-pencil"></i> Edit Assessments</a>
</div>

 
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
               
		</div><!-- #content -->

		<?php do_action( 'jobify_loop_after' ); ?>
	</div><!-- #primary -->

 <script>
jQuery(document).ready(function(){
	jQuery(".footer-cta").remove();
	jQuery("input[name=contact-id]").val( <?php echo $contact_id;?> );
	jQuery("input[name=your-email]").val( "<?php echo $useremail;?>" );
	
	jQuery("input[name=your-name]").val( jQuery("#userName").text()   );
	
	
jQuery(".wpua-edit-container br").remove();
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
.assessmentContainer{position:relative; padding:2rem;}
div.locked{background:rgba(0,0,0,.8); color:#fff; padding:2rem; position:absolute; top:0; left:0; width:100%; height:100%; z-index:10;}

</style>

<?php get_footer(); ?>


