<?php 
$pageID = get_the_ID(); 
$uar = get_post_meta($pageID, 'wpcf-upload-file-content', true); 
$uors = get_post_meta($pageID, 'wpcf-use-our-services-content', true);
$mt = get_post_meta($pageID, 'member_tips', true); 
?>
<?php  if ( (is_user_logged_in()) &&  ($roles1 == 'employer') ) {  ?>

<div class="special_box special_logo navi_thumbnail">
	<div class="thumbnail">
		<img src="<?php echo site_url();  ?>/assets/themes/eye-recruit-2015/img/navi_logo-icon.png" class="img-responsive">
	</div>
	<h5>HERE IS A TIP</h5>
	<p>Honors & Awards are an excellent way to validate a Seekers background, past performance, and help Hiring Managers, HR personnel and Recruiters to match the Candidate to your Job opening. Every Award has a meaning and significance to the Job Seeker. Being able to see what is posted here allows you to initiate a conversation during the interviewing process.</p>
</div>
<div class="special_box special_logo navi_thumbnail">
	<div class="thumbnail">
		<img src="<?php echo site_url();  ?>/assets/themes/eye-recruit-2015/img/navi_logo-icon.png" class="img-responsive">
	</div>
	<h5>CONSIDER THE SOURCE</h5>
	<?php echo $uors; ?>
</div>

<?php } elseif ((is_user_logged_in()) &&  ($roles1 == 'candidate')){ ?>

<?php   if ( isset($_REQUEST['recruitID']) ) { ?>


<div class="special_box special_logo navi_thumbnail">
	<div class="thumbnail">
		<img src="<?php echo site_url();  ?>/assets/themes/eye-recruit-2015/img/navi_logo-icon.png" class="img-responsive">
	</div>
	<h5>HERE IS A TIP</h5>
	<p>Honors & Awards are an excellent way to validate a Seekers background, past performance, and help Hiring Managers, HR personnel and Recruiters to match the Candidate to your Job opening. Every Award has a meaning and significance to the Job Seeker. Being able to see what is posted here allows you to initiate a conversation during the interviewing process.</p>
</div>
<div class="special_box special_logo navi_thumbnail">
	<div class="thumbnail">
		<img src="<?php echo site_url();  ?>/assets/themes/eye-recruit-2015/img/navi_logo-icon.png" class="img-responsive">
	</div>
	<h5>CONSIDER THE SOURCE</h5>
	<?php echo $uors; ?>
</div>
<?php  }else{  ?>

<div class="special_box navi_thumbnail">
	<h5>Upload honors &amp; awards</h5>
	<p><?php echo (($uar))? $uar : 'Data not found'; ?></p>
	<a id="btn-uploadRes2" href="javascript:void(0);" class="btn btn-primary btn-sm">Upload</a>
</div>

<?php member_navigation_sidebar_tips_function('seeker_honor_awar'); ?>

<?php } ?>

<?php  }else { ?>

<div class="special_box navi_thumbnail">
	<h5>Upload honors &amp; awards</h5>
	<p><?php echo (($uar))? $uar : 'Data not found'; ?></p>
</div>

<?php member_navigation_sidebar_tips_function('seeker_honor_awar'); ?>
<?php } ?>
