<?php
/**
 * The default template for displaying content. Used for seeker tips
 * @package Jobify
 * @since Jobify 1.0
 */
?>
<?php
$user_id = get_current_user_id();
$value = get_cimyFieldValue($user_id,'PROFILE_VISIBILITY');
?>
<ul>
	<li data-status="anonymous" class="visibility_everyone <?php if($value =='anonymous'){ echo 'active'; } ?> visibilitys">Visible to Everyone <span></span></li>
	<li data-status="Open" class="visibility_only visibilitys <?php if($value =='Open'){ echo 'active'; } ?>">Recruiters Only <span></span></li>
	<li data-status="Private" class="visibility_invisible visibilitys <?php if($value =='Private'){ echo 'active'; } ?>">You’re Invisible <span></span></li>
</ul>