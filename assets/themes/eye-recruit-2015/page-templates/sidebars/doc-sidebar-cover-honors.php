<?php 
$pageID = get_the_ID(); 
$uar = get_post_meta($pageID, 'upload_file_content', true); 
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
	<p>Military, Law Enforcement and Governmental Sector awards are traditionally ribbons, badges, and medals, and are a big part of the culture. While they show leadership, excellence and hard work, they also show sacrifice.  Awards from these institutions tell a story of heroism, valor and courage.  They will help determine capabilities and talents with respect to future performance.</p>
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
	<p>Military, Law Enforcement and Governmental Sector awards are traditionally ribbons, badges, and medals, and are a big part of the culture. While they show leadership, excellence and hard work, they also show sacrifice.  Awards from these institutions tell a story of heroism, valor and courage.  They will help determine capabilities and talents with respect to future performance.</p>
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
