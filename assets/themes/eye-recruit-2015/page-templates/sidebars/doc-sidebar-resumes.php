<?php 
$pageID = get_the_ID(); 
$uar 		= get_post_meta($pageID, 'wpcf-upload-file-content', true); 
$uors = get_post_meta($pageID, 'wpcf-use-our-services-content', true);
$mt = get_post_meta($pageID, 'member_tips', true); 
?>

<?php  if ( (is_user_logged_in()) &&  ($roles1 == 'employer') ) {  ?>

<div class="special_box special_logo navi_thumbnail">
	<div class="thumbnail">
		<img src="<?php echo site_url(); ?>/assets/themes/eye-recruit-2015/img/navi_logo-icon.png" class="img-responsive">
	</div>
	<h5> HOW WE SEE IT</h5>
	<p>EyeRecruit offers the easiest way to review Resumes digitally when a Seeker has responded to a Job Posting or has been located during a search. Having this information accessible, you can quickly select the best qualified candidates and move to the next hiring phase. The best part is, if you don’t see something you need, you can quickly message the candidate and ask that they send it. </p>
</div>
<div class="special_box special_logo navi_thumbnail">
	<div class="thumbnail">
		<img src="<?php echo site_url(); ?>/assets/themes/eye-recruit-2015/img/navi_logo-icon.png" class="img-responsive">
	</div>
	<h5>BEYOND A RESUME</h5>
	<p>Its important to look beyond and extend your hiring efforts past the candidates resume.  EyeRecruit has designed many tools that will be of value to you during this process. A Resume remains a valuable tool in assessing a potential candidate, but what a Resume can’t tell you is vital to your success as well.  We believe in the bigger picture.  We want to consider all parts to the puzzle and look at a candidates goals, their personality type and their potential.  A Resume is a great launching point to initiate a conversation and start dialog.</p>
</div>


<?php } elseif ((is_user_logged_in()) &&  ($roles1 == 'candidate')){ ?>



<?php   if ( isset($_REQUEST['recruitID']) ) { ?>

<div class="special_box special_logo navi_thumbnail">
	<div class="thumbnail">
		<img src="<?php echo site_url(); ?>/assets/themes/eye-recruit-2015/img/navi_logo-icon.png" class="img-responsive">
	</div>
	<h5> HOW WE SEE IT</h5>
	<p>EyeRecruit offers the easiest way to review Resumes digitally when a Seeker has responded to a Job Posting or has been located during a search. Having this information accessible, you can quickly select the best qualified candidates and move to the next hiring phase. The best part is, if you don’t see something you need, you can quickly message the candidate and ask that they send it. </p>
</div>
<div class="special_box special_logo navi_thumbnail">
	<div class="thumbnail">
		<img src="<?php echo site_url(); ?>/assets/themes/eye-recruit-2015/img/navi_logo-icon.png" class="img-responsive">
	</div>
	<h5>BEYOND A RESUME</h5>
	<p>Its important to look beyond and extend your hiring efforts past the candidates resume.  EyeRecruit has designed many tools that will be of value to you during this process. A Resume remains a valuable tool in assessing a potential candidate, but what a Resume can’t tell you is vital to your success as well.  We believe in the bigger picture.  We want to consider all parts to the puzzle and look at a candidates goals, their personality type and their potential.  A Resume is a great launching point to initiate a conversation and start dialog.</p>
</div>

<?php  }else{  ?>

<div class="special_box navi_thumbnail">
	<h5>Upload a Resume</h5>
	<p><?php echo (($uar))? $uar : 'Data not found'; ?></p>
	<a id="btn-uploadRes2" href="javascript:void(0);" class="btn btn-primary btn-sm">Upload</a>
</div>

<div class="special_box navi_thumbnail">
	<h5>Use Our Resume services</h5>
	<p><?php echo (($uors))? $uors : 'Data not found'; ?></p>
	<a href="javascript:void(0);" class="btn btn-primary btn-sm">Begin</a>
</div>

<?php member_navigation_sidebar_tips_function('seeker_resume'); ?>

<?php } ?>

<?php  }else { ?>

<div class="special_box navi_thumbnail">
	<h5>Upload a Resume</h5>
	<p><?php echo (($uar))? $uar : 'Data not found'; ?></p>
</div>

<div class="special_box navi_thumbnail">
	<h5>Use Our Resume services</h5>
	<p><?php echo (($uors))? $uors : 'Data not found'; ?></p>
</div>

<?php member_navigation_sidebar_tips_function('seeker_resume'); ?>

<?php } ?>