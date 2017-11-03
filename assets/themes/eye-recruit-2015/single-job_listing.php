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

<?php get_footer('employer'); ?>

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
            <div  class="pop_logo popnew_logo">
              <a href="#"><img src="<?php echo site_url();  ?>/assets/themes/eye-recruit-2015/images/login_logo.png" alt="" class="img-responsive"></a>
            </div>
            <h3 class="text-center">Yes, email me job leads like this one!</h3>
            <?php echo do_shortcode('[contact-form-7 id="6498" title="Job Board Email Capture"]');  ?>
            <p>Continues without the <strong>free</strong> email updates <a id="noShow" href="javascript:dontShow()">Don't show this popup again</a></p>

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
    if (visited == 'yesqwerqwer') {
      return false;
    } else {
      if(activeClicks == 0){
        jQuery('#mail_job').modal('show');
        var t = jQuery("#gsetJobCat div.value").text();
        
        jQuery('span.jobs select').val( jQuery.trim(t) );
      }
    
   }

 });
  /* listen to close */
 
  document.addEventListener( 'wpcf7submit', function( event ) {
    var formID = event.detail.contactFormId;
    var inputs = event.detail.inputs;
    
    if(formID == '6498'){
      setTimeout(function(){
        jQuery('#mail_job').modal('hide');
      },3000);
    }
    
}, false );



  </script>

  <?php
}
?>