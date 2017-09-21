<?php 
$pageID = get_the_ID(); 
$uar = get_post_meta($pageID, 'wpcf-upload-file-content', true); 
$uors = get_post_meta($pageID, 'wpcf-use-our-services-content', true);
$mt = get_post_meta($pageID, 'member_tips', true); 
?>

<?php if($allowView == 'allow'){ ?>
<div class="special_box navi_thumbnail">
	<h5>Upload a cover letter</h5>
	<p><?php echo (($uar))? $uar : 'Data not found'; ?></p>
	<a id="btn-uploadRes2" href="javascript:void(0);" class="btn btn-primary btn-sm">Upload</a>
</div>
<?php } ?>

<?php if($allowView == 'allow'){ ?>
<div class="special_box navi_thumbnail">
	<h5>Use our template free</h5>
	<!-- <p><?php echo (($uar))? $uar : 'Data not found'; ?></p> -->
	<?php echo $uors ; ?>
  <a href="/job-seekers/cover-letters/" class="btn btn-primary btn-sm" target="_erDocs">Start</a>
</div>
<?php } ?>

<?php member_navigation_sidebar_tips_function('seeker_cover_letters'); ?>