<?php
/**
 * Single Post
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Jobify
 * @since Jobify 1.0
 */

get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

	<?php if ( is_singular( 'job_listing' ) ) : ?>
  <?php get_template_part( 'content-single', 'job' ); ?>
<?php endif; ?>

<?php do_action( 'jobify_loop_after' ); ?>

<?php endwhile; ?>

<?php
if(!is_user_logged_in() ){

  //show modal and handle logic
  ?>

  <div class="modal fade email_leads" id="mail_job" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="vertical-alignment-helper">
      <div class="modal-dialog modal-lg vertical-align-center" role="document">
        <div class="modal-content absolutely_free_popup pop-eye">
          <div class="modal-body">
            <button type="button" id="rfclosepopup" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h2>Want job leads like this one?</h2>
            <hr>
            <div class="row paddedTop">
              <div class="col-md-4">
                <p class="lead">create your <strong>FREE PROFILE</strong> now and get industry specific opportunities delivered to your inbox.</p>
              </div>
              <div class="col-md-8">
                <ul class="checkmarks lead">
                  <li>Stop “blindly” applying to job postings!</li>
                  <li>Get notified of jobs that match your experience!</li>
                  <li>Receive access to unpublished job opportunities!</li>
                  <li>Let employers &amp; recruiters search for you!</li>
                  <li>Increase your chances for getting on the “short list”!</li>
                </ul>
                <a class="button button-primary btn-lg marginTop" href="<?php echo site_url(); ?>/job-seekers/get-started">Get Started Now</a>
              </div>
            </div>
            
            <p class="marginTop"><a id="noShow" href="javascript:dontShow()">Continue without the free profile and don't show this popup again</a></p>

          </div>
        </div>
      </div>
    </div>
  </div>

  <script type="text/javascript">
  var activeClicks = 0;
  jQuery(document).click(function(){
    activeClicks++;
  });

  function dontShow(){
    var date = new Date();
    date.setTime(date.getTime() + (10*60 * 1000));
    jQuery('#mail_job').modal('hide');
    jQuery.cookie('visited', 'yes', { expires: date }); // set value='yes' and expiration in 30 days
  }

  jQuery(document).mouseleave(function() {
    var visited = jQuery.cookie('visited'); // create cookie 'visited' with no value
    if (visited == 'yes') {
      return false;
    } else {
      if(activeClicks === 0){
        jQuery('#mail_job').modal('show');
      }
   }

 });
  </script>

<?php
}
?>

<?php get_footer(); ?>
