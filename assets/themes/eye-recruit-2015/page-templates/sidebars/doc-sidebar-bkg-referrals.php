<?php 
$pageID = get_the_ID(); 
$roafar = get_post_meta($pageID, 'reach_out_ask_for_a_referral_now_content', true); 
$hiw = get_post_meta($pageID, 'how_it_works', true); 
$mt = get_post_meta($pageID, 'member_tip', true); 
?>
<?php  if ( (is_user_logged_in()) &&  ($roles1 == 'employer') ) {  ?>
<div class="special_box special_logo navi_thumbnail">
	<div class="thumbnail">
		<img src="<?php echo site_url();  ?>/assets/themes/eye-recruit-2015/img/navi_logo-icon.png" class="img-responsive">
	</div>
	<h5> HERE IS THE PROCESS</h5>
	<p>The recommendation process has been simplified for the Candidate, so they are able to provide you with a simple and effective way to review some of the things people who know them have taken the time to provide in writing. The Seeker sends an automated e-mail asking for open ended feedback and the response is posted within the Job Seekers profile so it can be provide here for your review. </p>
</div>
<div class="special_box special_logo navi_thumbnail">
	<div class="thumbnail">
		<img src="<?php echo site_url();  ?>/assets/themes/eye-recruit-2015/img/navi_logo-icon.png" class="img-responsive">
	</div>
	<h5>ITS A STARTING POINT</h5>
	<p>While there is no way for EyeRecruit, Inc. to validate accuracy of the information, we offer this section to Hiring Managers, HR personnel and Recruiters to initiate open lines of communication, get to know the candidate better, to begin to cross reference the bigger picture and to assist in the verification, background and pre-hiring process for a potential employee / team member you might be interested in considering.</p>
</div>


<?php } elseif ((is_user_logged_in()) &&  ($roles1 == 'candidate')){ ?>

<?php   if ( isset($_REQUEST['recruitID']) ) { ?>

<div class="special_box special_logo navi_thumbnail">
	<div class="thumbnail">
		<img src="<?php echo site_url();  ?>/assets/themes/eye-recruit-2015/img/navi_logo-icon.png" class="img-responsive">
	</div>
	<h5> HERE IS THE PROCESS</h5>
	<p>The recommendation process has been simplified for the Candidate, so they are able to provide you with a simple and effective way to review some of the things people who know them have taken the time to provide in writing. The Seeker sends an automated e-mail asking for open ended feedback and the response is posted within the Job Seekers profile so it can be provide here for your review. </p>
</div>
<div class="special_box special_logo navi_thumbnail">
	<div class="thumbnail">
		<img src="<?php echo site_url();  ?>/assets/themes/eye-recruit-2015/img/navi_logo-icon.png" class="img-responsive">
	</div>
	<h5>ITS A STARTING POINT</h5>
	<p>While there is no way for EyeRecruit, Inc. to validate accuracy of the information, we offer this section to Hiring Managers, HR personnel and Recruiters to initiate open lines of communication, get to know the candidate better, to begin to cross reference the bigger picture and to assist in the verification, background and pre-hiring process for a potential employee / team member you might be interested in considering.</p>
</div>
<?php  }else{  ?>

<div class="special_box navi_thumbnail">
	<h5>Reach out & ask for a Recommendation Now</h5>
	<p><?php echo (($roafar))? $roafar : 'Data not found'; ?></p>
	<a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#reach_out_n_ask_fr_Referral">Ask Now</a>
</div>
<div class="special_box navi_thumbnail">
	<h5>How it Works</h5>
	<p><?php echo (($hiw))? $hiw : 'Data not found'; ?></p>
</div>

<?php member_navigation_sidebar_tips_function('seeker_referrals'); ?>

<?php } ?>


<?php  }else { ?>
<div class="special_box navi_thumbnail">
	<h5>Reach out & ask for a Recommendation Now</h5>
	<p><?php echo (($roafar))? $roafar : 'Data not found'; ?></p>
</div>
<div class="special_box navi_thumbnail">
	<h5>How it Works</h5>
	<p><?php echo (($hiw))? $hiw : 'Data not found'; ?></p>
</div>

<?php member_navigation_sidebar_tips_function('seeker_referrals'); ?>

<?php } ?>
