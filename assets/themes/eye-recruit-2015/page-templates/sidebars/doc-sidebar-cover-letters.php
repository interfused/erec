<?php 
$pageID = get_the_ID(); 
$uar = get_post_meta($pageID, 'upload_file_content', true); 
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
	<p>EyeRecruit <b>does have</b> a paid services for correspondences like this, but we have included a FREE cover letters template to be used by our members. This template has been provided to give you a good foundation and example on what could be sent. By selecting to use the <b>TEMPLATE</b> provided you will be able to modify it and save it for this use while also be able to return to use the template again whenever you desire.</p>
	<a href="/job-seekers/cover-letters/" class="btn btn-primary btn-sm" target="_erDocs">Start</a>
</div>
<?php } ?>

<?php member_navigation_sidebar_tips_function('seeker_cover_letters'); ?>