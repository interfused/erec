<?php
/**
 * Template Name: Map + Jobs
 *
 * @package Jobify
 * @since Jobify 1.0
 */

get_header(); ?>

<header class="page-header">
	<h1 class="page-title"><?php the_title(); ?></h1>
</header>

<div id="primary" class="content-area">
	<div id="content" role="main">
		<?php while ( have_posts() ) : the_post(); ?>

			<?php if ( '' == get_post()->post_content ) : ?>

				<?php echo do_shortcode( '[jobs]' ); ?>

			<?php else : ?>

				<?php the_content(); ?>

			<?php endif; ?>

		<?php endwhile; ?>
	</div>
</div>

<?php echo get_footer('employer'); ?>
	
   
<script>
/*jQuery(document).ready(function(){
	jQuery('.open-popup-link').magnificPopup({
  type:'inline',
  midClick: true // Allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source in href.
});
	});*/
</script>
<script>
function hideMsg(){
    // Hide dynamically added div
	console.log('okie');

}
<?php
//$_SESSION['restrictView']==true
if(!is_user_logged_in()){
/* // Listen for ajax completions */
?>
jQuery( document ).ajaxComplete(function() {
	/*
  //jQuery( ".log" ).text( "Triggered ajaxComplete handler." );
//  alert('done');
	//jQuery("div.company").remove();
	jQuery("div.company").html('<a href="/job-seekers/get-started/">available to members</a>');
	jQuery(".job_listings img.company_logo").removeAttr("alt");
	jQuery(".job_listings img.company_logo").attr("src","/assets/uploads/2015/01/icon-resume.png");
	
});
*/
</script>
<?php } ?>
<?php 
/* only show popup once per session */
if( (is_user_logged_in() == false) &&  !$_SESSION['findJobJobAlertsModal'] ){
	$_SESSION['findJobJobAlertsModal'] = true; 
	?>
    <script>
jQuery(window).load(function(){
jQuery.magnificPopup.open({
  //items: {src: '#createAcctModal'},type: 'inline'}, 0);
});
</script>
    <?php
}
/* END MODAL SCRIPTS FOR LOGGED OUT USERS */
?>