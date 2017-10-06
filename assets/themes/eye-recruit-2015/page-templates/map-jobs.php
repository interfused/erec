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


<?php
//$_SESSION['restrictView']==true
if(is_user_logged_in() == false){
/* // Listen for ajax completions */
?>
<script>
jQuery( document ).ajaxComplete(function() {
  jQuery('#loaders').hide();
  generateCustomPagination();
});

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
<?php // custom pagination... DEV TO DEBUG LATER: ORIGINAL PAGINATION NOT WORKING ?>

<script>
function generateCustomPagination(){
  var maxListingsPerPage = 12;
  //var totalJobListings = "<?php echo get_option( 'job_manager_per_page' );?>";
  var totalJobListings = jQuery(".job_listing").length;
  var totalPages = Math.ceil(totalJobListings/maxListingsPerPage);
  var maxPages = 10;
  jQuery('.job_listing:gt('+(maxListingsPerPage-1)+')').hide();
  console.log('custom window pagination for '+totalJobListings +' with per page: '+maxListingsPerPage);
  jQuery("#jobpaginationDiv").empty();
  //generate the links
  for(var i=1;i<=totalPages;i++){
    if(i>maxPages){
      break;
    }
    jQuery("#jobpaginationDiv").append('<a class="job_page_loader" data-page="'+ (i-1) +'" href="javascript:void(0);">'+i+'</a>');
    jQuery("#jobpaginationDiv a:nth-of-type(1)").addClass('active');
  }

  /* click */
  jQuery("#jobpaginationDiv a").click(function(){
    jQuery("#jobpaginationDiv a").removeClass('active');
    jQuery(this).addClass('active');
    var activePage = jQuery(this).data('page');
    var startShowIndex = (activePage*maxListingsPerPage) - 1;
    var endShowIndex = startShowIndex + maxListingsPerPage;

    if(activePage == 0){
      startShowIndex = 0;
      endShowIndex = maxListingsPerPage - 1;
      jQuery("#searchSec").show();
    }else{
      jQuery("#searchSec").hide();
    }
    
    jQuery('.job_listing').hide();
    jQuery('.job_listing:gt('+startShowIndex+'):lt('+endShowIndex+')').fadeIn();

    jQuery("html, body").animate({scrollTop:jQuery("#erJobListingTop").offset().top }, 500, 'swing', function() { 
       console.log("Finished animating");
    });

  });
}
</script>