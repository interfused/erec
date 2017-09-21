<?php 
$pageID = get_the_ID(); 
$uar = get_post_meta($pageID, 'wpcf-upload-file-content', true); 
$mt = get_post_meta($pageID, 'member_tips', true); 
?>
<?php  if ( (is_user_logged_in()) &&  ($roles1 == 'employer') ) {  ?>

<div class="special_box special_logo navi_thumbnail">
	<div class="thumbnail">
		<img src="<?php echo site_url();  ?>/assets/themes/eye-recruit-2015/img/navi_logo-icon.png" class="img-responsive">
	</div>
	<h5>ON BEING CERTIFIED</h5>
	<p>A certification shows that the Candidate was interested enough to peruse the certification and in most cases they took an exam. Some professional certifications require you study (hard) and pass a text.  Other’s require you have years of experience in a specific field before you can even apply.  Do you see something here that will give this candidate and edge?</p>
</div>
<div class="special_box special_logo navi_thumbnail">
	<div class="thumbnail">
		<img src="<?php echo site_url();  ?>/assets/themes/eye-recruit-2015/img/navi_logo-icon.png" class="img-responsive">
	</div>
	<h5>THE VALUE TO YOU</h5>
	<p>Some Certifications are excellent others will not be useful to you in the position(s) you have available. There are arguments to be made about the value of certification, especially in discussions around technology.  What it does show is on-going interest in the profession and areas where education mixed with passion, might produce excellence. With any luck the Job Seeker learned something though the study that they will be able to implement in the working environment.</p>
</div>


<?php } elseif ((is_user_logged_in()) &&  ($roles1 == 'candidate')){ ?>
<?php   if ( isset($_REQUEST['recruitID']) ) { ?>

<div class="special_box special_logo navi_thumbnail">
	<div class="thumbnail">
		<img src="<?php echo site_url();  ?>/assets/themes/eye-recruit-2015/img/navi_logo-icon.png" class="img-responsive">
	</div>
	<h5>ON BEING CERTIFIED</h5>
	<p>A certification shows that the Candidate was interested enough to peruse the certification and in most cases they took an exam. Some professional certifications require you study (hard) and pass a text.  Other’s require you have years of experience in a specific field before you can even apply.  Do you see something here that will give this candidate and edge?</p>
</div>
<div class="special_box special_logo navi_thumbnail">
	<div class="thumbnail">
		<img src="<?php echo site_url();  ?>/assets/themes/eye-recruit-2015/img/navi_logo-icon.png" class="img-responsive">
	</div>
	<h5>THE VALUE TO YOU</h5>
	<p>Some Certifications are excellent others will not be useful to you in the position(s) you have available. There are arguments to be made about the value of certification, especially in discussions around technology.  What it does show is on-going interest in the profession and areas where education mixed with passion, might produce excellence. With any luck the Job Seeker learned something though the study that they will be able to implement in the working environment.</p>
</div>


<?php  }else{  ?>

<div class="special_box navi_thumbnail">
	<h5>Upload a certification</h5>
	<p><?php echo (($uar))? $uar : 'Data not found'; ?></p>
	<a id="btn-uploadRes2" href="javascript:void(0);" class="btn btn-primary btn-sm">Upload</a>
</div>

<?php member_navigation_sidebar_tips_function('seeker_certificates'); ?>
<?php } ?>

<?php  }else { ?>
<div class="special_box navi_thumbnail">
	<h5>Upload a certification</h5>
	<p><?php echo (($uar))? $uar : 'Data not found'; ?></p>
</div>

<?php member_navigation_sidebar_tips_function('seeker_certificates'); ?>
<?php } ?>