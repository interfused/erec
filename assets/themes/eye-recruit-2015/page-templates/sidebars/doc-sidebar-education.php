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
	<h5>BEYOND A DEGREE</h5>
	<p>Job Seekers understand that a college degree and skills gained though experience will provide a greater chance for financial freedom and quality employment. Leadership and management opportunities do require university degrees and many Job Seekers are aware that if they are looking to break into the middle class or higher, they need not only experience, but a degree as well. </p>
</div>
<div class="special_box special_logo navi_thumbnail">
	<div class="thumbnail">
		<img src="<?php echo site_url();  ?>/assets/themes/eye-recruit-2015/img/navi_logo-icon.png" class="img-responsive">
	</div>
	<h5>THE DISCLAIMER</h5>
	<p>Our goal in automating this process is for the Job Seeker to manage their own career and maintain their own documents. EyeRecruit, Inc. does not confirm the materials provided here.  All users have the responsibility to determine whether information obtained from this site is accurate, current, and complete.   EyeRecruit, Inc. assumes no responsibility for any errors or omissions or for the use of information obtained from this site in accordance with our <a target="_blank" href="<?php site_url(); ?>/terms-and-conditions/">Terms & Conditions </a>policies.</p>
</div>


<?php } elseif ((is_user_logged_in()) &&  ($roles1 == 'candidate')){ ?>

<?php   if ( isset($_REQUEST['recruitID']) ) { ?>

<div class="special_box special_logo navi_thumbnail">
	<div class="thumbnail">
		<img src="<?php echo site_url();  ?>/assets/themes/eye-recruit-2015/img/navi_logo-icon.png" class="img-responsive">
	</div>
	<h5>BEYOND A DEGREE</h5>
	<p>Job Seekers understand that a college degree and skills gained though experience will provide a greater chance for financial freedom and quality employment. Leadership and management opportunities do require university degrees and many Job Seekers are aware that if they are looking to break into the middle class or higher, they need not only experience, but a degree as well. </p>
</div>
<div class="special_box special_logo navi_thumbnail">
	<div class="thumbnail">
		<img src="<?php echo site_url();  ?>/assets/themes/eye-recruit-2015/img/navi_logo-icon.png" class="img-responsive">
	</div>
	<h5>THE DISCLAIMER</h5>
	<p>Our goal in automating this process is for the Job Seeker to manage their own career and maintain their own documents. EyeRecruit, Inc. does not confirm the materials provided here.  All users have the responsibility to determine whether information obtained from this site is accurate, current, and complete.   EyeRecruit, Inc. assumes no responsibility for any errors or omissions or for the use of information obtained from this site in accordance with our <a target="_blank" href="<?php site_url(); ?>/terms-and-conditions/">Terms & Conditions </a>policies.</p>
</div>

<?php  }else{  ?>

<div class="special_box navi_thumbnail">
	<h5>Upload education docs</h5>
	<p><?php echo (($uar))? $uar : 'Data not found'; ?></p>
	<a id="btn-uploadRes2" href="javascript:void(0);" class="btn btn-primary btn-sm">Upload</a>
</div>

<?php member_navigation_sidebar_tips_function('seeker_education'); ?>

<?php } ?>


<?php  }else { ?>
<div class="special_box navi_thumbnail">
	<h5>Upload education docs</h5>
	<p><?php echo (($uar))? $uar : 'Data not found'; ?></p>
</div>

<?php member_navigation_sidebar_tips_function('seeker_education'); ?>
<?php } ?>
