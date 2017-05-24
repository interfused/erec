<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the
 * #main and #page div elements.
 *
 * @package Jobify
 * @since Jobify 1.0
 */
?>
     
<?php
$curr_pg_id = get_the_ID();
//the page ids below will not show the bottom cta
$ignore_arr=array(1882,2685);
?>


<!-- <a href="javascript:void(0);" class="btn btn-sm btn-success open-popup-intersted" data-toggle="modal" data-target="#welcome_back">Welcome Back</a>
 -->
<div class="modal fade welcome_back" id="welcome_back" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="vertical-alignment-helper">
        <div class="modal-dialog vertical-align-center" role="document">
            <div class="modal-content absolutely_free_popup">
                <div class="modal-body">
		            <button aria-label="Close" data-dismiss="modal" class="close profile_pic_close_button" type="button"><span aria-hidden="true">×</span>
		            </button>
		            <img class="popup_logo" src="/assets/uploads/2016/04/EyeRecruit.com-logo_3-2.jpg">
		            <h3>Welcome back (First Name)!</h3>
		            <div class="clearfix"></div>

		            <h4>Before we begin, has anythinged changed since you last visit with us?</h4>

		            <ul class="list_check">
		            	<li>
		            		<div class="checkbox">
							    <label>
							      <input type="checkbox">
							      <span class="c_check"></span>
							      Nope, let's get to work!
							    </label>
							</div>
		            	</li>
		            	<li>
		            		<div class="checkbox">
							    <label>
							      <input type="checkbox">
							      <span class="c_check"></span>
							      Actually yes. <small>(opens the following)</small>
							    </label>
							</div>
							<ul>
								<li>
									<div class="checkbox">
									    <label>
									      <input type="checkbox">
									      <span class="c_check"></span>
									      I need to update Resume <small>(opens the Resume section)</small>
									    </label>
									</div>
								</li>
								<li>
									<div class="checkbox">
									    <label>
									      <input type="checkbox">
									      <span class="c_check"></span>
									      I need to update my Contact Info <small>(opens to account management)</small>
									    </label>
									</div>
								</li>
								<li>
									<div class="checkbox">
									    <label>
									      <input type="checkbox">
									      <span class="c_check"></span>
									      I need to update my Skills Assessments <small>(opens drowpdown for six listed to direct)</small>
									    </label>
									</div>
								</li>
								<li>
									<div class="checkbox">
									    <label>
									      <input type="checkbox">
									      <span class="c_check"></span>
									      I can handle it myself <small>(Closes window to seeker dashboard)</small>
									    </label>
									</div>
								</li>
								<li>
									<div class="checkbox">
									    <label>
									      <input type="checkbox">
									      <span class="c_check"></span>
									      I need to discuss it with a Recruiter <small>(opens the Contact now window)</small>
									    </label>
									</div>
								</li>
							</ul>
		            	</li>
		            </ul>
		        </div>
            </div>
        </div>
    </div>
    <div class="img_phare">
	<img src="">
</div>
</div>



<div class="modal fade job_postings" id="absolutely_free" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="vertical-alignment-helper">
        <div class="modal-dialog modal-lg vertical-align-center" role="document">
            <div class="modal-content absolutely_free_popup">
                <div class="modal-body">
                    <button type="button" id="rfclosepopup" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h3>Your First 10 Job Postings - Absolutely Free!</h3>
                    <h5>Use Promo Code : <strong>Get10</strong></h5>
                    <div class="row">
                    	<div class="col-md-5"><img src="<?php echo site_url();  ?>/assets/themes/eye-recruit-2015/img/preview_img.jpg" alt="" class="img-responsive shadow_img"></div>
                    	<div class="col-md-7">
                    		<h4><strong>Think of  this as:</strong> Job Ads 3.0</h4>
                    		<ul>
                    			<li>Save Time & Money Streamlining & Systematizing the Job Posting & Applicant review procces company wide.</li>
                    			<li>Define your Hiring & Managment team <strong>upfront</strong>, to ensure <strong>all the right people are involved</strong> and the  best decisions can be, and will be made.</li>
                    			<li>Be notified immediately when job Seekers apply and review their profile, at <strong>your leisure</strong> and <strong>within your schedule</strong>, to see if <strong>you</strong> want to communicate & continue.</li>
                    		</ul>
		                    <div class="clearfix"></div>
		                    <div class="btn_center">
			                    <a class="btn btn-success" id="step1" href="javascript:void(0);">Next</a>
		                    </div>
                    	</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade job_postings" id="better_decisions" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="vertical-alignment-helper">
        <div class="modal-dialog modal-lg vertical-align-center" role="document">
            <div class="modal-content absolutely_free_popup">
                <div class="modal-body">
                    <button type="button" id="rfclosepopup" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h3>Realtime Information = Better Decisions!</h3>
                    <h5>Use Promo Code : <strong>Get10</strong></h5>
                    <div class="row">
                    	<div class="col-md-5"><img src="<?php echo site_url();  ?>/assets/themes/eye-recruit-2015/img/preview_img2.jpg" alt="" class="img-responsive shadow_img"></div>
                    	<div class="col-md-7">
                    		<h4>Knowledge is Power</h4>
                    		<ul>
                    			<li>Review potential candidates in one singular location!</li>
                    			<li>Focus on what’s important: Experienced Job Seekers from <strong>within</strong> your industry!</li>
                    			<li>Quickly compare candidate submission and review more then a resume, <strong>review and entire career!</strong></li>
                    		</ul>
		                    <div class="clearfix"></div>
		                    <div class="btn_center">
			                    <a class="btn btn-success" id="step2" href="javascript:void(0);">Next</a>
		                    </div>
                    	</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade job_postings" id="extend_reach" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="vertical-alignment-helper">
        <div class="modal-dialog modal-lg vertical-align-center" role="document">
            <div class="modal-content absolutely_free_popup">
                <div class="modal-body">
                    <button type="button" id="rfclosepopup" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h3>Extend Your Reach, by Limiting Your Search!</h3>
                    <h5>Use Promo Code : <strong>Get10</strong></h5>
                    <div class="row">
                    	<div class="col-md-5">
                    		<img src="<?php echo site_url();  ?>/assets/themes/eye-recruit-2015/img/preview_img2.jpg" alt="" class="img-responsive shadow_img">
                    		<!-- <div class="circle"></div> -->
                    	</div>
                    	<div class="col-md-7">
                    		<h4>Build for Our Industry</h4>
                    		<ul>
                    			<li>Increase interest, awareness and traffic to your site, and to your job postings, with optional company Branding!</li>
                    			<li>Easy to understand Dashboard and functionality that track the applicant through the process from sourcing to interview!</li>
                    			<li>Automate Responses, even when you're not interested!</li>
                    			<li>Integrate Custom Career Pages on your website's career page so your postings automatically appear on your website and applicants are directed to complete a full profile!</li>
                    		</ul>
		                    <div class="clearfix"></div>
		                    <div class="btn_center">
			                    <a class="btn btn-success" href="<?php echo site_url(); ?>/employers/get-started">Join</a>
		                    </div>
                    	</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade want_logout" id="logoutcon" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="vertical-alignment-helper">
        <div class="modal-dialog modal-lg vertical-align-center" role="document">
            <div class="modal-content recommendation_popup">
                <div class="modal-body">
                    <button type="button" id="rfclosepopup" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <img src="<?php  echo site_url();  ?>/assets/uploads/2016/04/EyeRecruit.com-logo_3-2.jpg" class="popup_logo">
                    <h3>Are you sure want to logout?</h3>
                    <div class="clearfix"></div>
                    <div class="btn_center">
	                    <a class="btn btn-primary" data-dismiss="modal" aria-label="Close" href="javascript:void(0);">No, Resume Session</a>
	                    <a class="btn btn-primary" data-target="#logoutcon" href="<?php echo wp_logout_url(); ?>">Yes, Continue with log out</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- <a href="javascript:void(0);" data-toggle="modal" data-target="#UploadResume" class="btn btn-success">Demos</a> -->
<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/additional-methods.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/css/sweetalert.css">
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/sweetalert.js"></script>
<script type="text/javascript">
	jQuery(document).ready( function() {
		/*jQuery('#checkwithoulogin').on('click', function() {
			jQuery('#applyModalWrap').modal('hide');
			jQuery('#UploadResume').modal('show');
			jQuery(this).prop('checked', false);
		});*/

		jQuery('#upload_doc_form').validate({
			rules: {
				your_name: {
					required: true
				},
				your_last_name: {
					required: true
					//email: true
				},
				your_zipcode: {
					required: true
				},
				upload_resume: {
					required: true,
					// accept: "doc/*, docx/*, pdf/*"
					extension: "doc|docx|pdf"
				}
			},
			messages: {
				your_name: {
					required: "Please enter a First name."
				},
				your_last_name: {
					required: 'Please enter a Last name.',
					//email: 'Please enter a valid email address.'
				},
				your_zipcode: {
					required: 'Please enter an Current Zip Code.'
				},
				upload_resume: {
					required: 'Please upload a resume.',
					extension: "File is not a valid format. Allow only Pdf, Docx and Doc format."
				}	
			},
			submitHandler: function(form){
		        jQuery('#upload_resume-error').hide();
		        jQuery('#upload_doc_btn').val('Please Wait...').attr('disabled', 'disabled');
		        var fd = new FormData();
		        var files_data = jQuery('#upload_doc_form #upload_resume'); 

		        jQuery.each(jQuery(files_data), function(i, obj) {
		            jQuery.each(obj.files,function(j,file){
		                fd.append('files[' + j + ']', file);
		            })
		        });

		        var uname = jQuery('#your_name').val(); 
		        var lastname = jQuery('#your_last_name').val(); 
		        var postid = '<?php echo $post->ID; ?>';

				fd.append('action', 'applyforjobwithoutlogin_demo');   //Action in inc/custom_functions.php
				fd.append('uname', uname);
				fd.append('lastname', lastname);
				fd.append('postid', postid);
		        jQuery.ajax({
		            type: 'POST',
		            url: '<?php echo admin_url("admin-ajax.php"); ?>',
		            data: fd,
		            contentType: false,
		            processData: false,
		            success: function(response){
		            	jQuery('#upload_doc_btn').val('Send').removeAttr('disabled');
		            	if ( response == 'success') {
		            		jQuery('#upload_doc_form')[0].reset();
		            		//jQuery('#UploadResume').modal('hide');
		            		swal({
								title: 'Successfully applied for job.', 
								type: "success",
								confirmButtonClass: "btn-primary btn-sm"
							});
		            	}
		            	else{
		            		jQuery('#upload_resume-error').html(response).show();
		            	}
		            }
		        });
			}
		});
	});
</script>

<script type="text/javascript">
jQuery(document).ready(function(){

		jQuery(function () {
			jQuery('[data-toggle="tooltip"]').tooltip();
		});
	jQuery('.unlogout').on('click', function(){
		jQuery('#logoutcon').modal('show');
	}); 
});    	

</script>
<div class="modal fade want_logout" id="logoutcon" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="vertical-alignment-helper">
        <div class="modal-dialog modal-lg vertical-align-center" role="document">
            <div class="modal-content recommendation_popup">
                <div class="modal-body">
                    <button type="button" id="rfclosepopup" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <img src="<?php  echo site_url();  ?>/assets/uploads/2016/04/EyeRecruit.com-logo_3-2.jpg" class="popup_logo">
                    <h3>Are you sure you want to logout?</h3>
                    <div class="clearfix"></div>
                    <div class="btn_center">
	                    <a class="btn btn-primary" data-dismiss="modal" aria-label="Close" href="javascript:void(0);">No, Resume Session</a>
	                    <a class="btn btn-primary" data-target="#logoutcon" href="<?php echo wp_logout_url(); ?>">Yes, Continue with log out</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery('.unlogout').on('click', function(){
		jQuery('#logoutcon').modal('show');
	}); 
});    	

</script>

</section>
	<!-- //Recommend Friends & Colleagues -->

		<footer id="colophon" class="site-footer" role="contentinfo">
			<?php if ( is_active_sidebar( 'widget-area-footer' ) ) : ?>
			<div class="footer-widgets">
				<div class="container">
					<div class="row">
						<?php dynamic_sidebar( 'widget-area-footer' ); ?>
                        
                        
					</div>
				</div>
			</div>
			<?php endif; 

			if(!is_page('login')){
				?>
				<div class="container paddedTop-2x paddedBottom">
						<?php $defaults = array(
												'theme_location'  => '',
												'menu'            => 'Footer Main',
												'container'       => 'div',
												'container_class' => '',
												'container_id'    => '',
												'menu_class'      => 'menu medium-block-grid-3',
												'menu_id'         => '',
												'echo'            => true,
												'fallback_cb'     => 'wp_page_menu',
												'before'          => '',
												'after'           => '',
												'link_before'     => '',
												'link_after'      => '',
												'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
												'depth'           => 0,
												'walker'          => ''
												);

						wp_nav_menu( $defaults );

						?>
				</div>

				<?php
			}

			?>


			<div class="copyright">
				<div class="container">
					<div class="site-info">
						<?php echo apply_filters( 'jobify_footer_copyright', sprintf( __( '&copy; %1$s EYE RECRUIT INC &mdash; All Rights Reserved', 'jobify' ), date( 'Y' ), get_bloginfo( 'name' ) ) ); ?>
					</div><!-- .site-info -->

					<a href="javascript:void(0);" class="btt"><i class="icon-up-circled"></i></a>

					<?php
						if ( has_nav_menu( 'footer-social' ) ) :
							$social = wp_nav_menu( array(
								'theme_location'  => 'footer-social',
								'container_class' => 'footer-social',
								'items_wrap'      => '%3$s',
								'depth'           => 1,
								'echo'            => false,
								'link_before'     => '<span class="screen-reader-text">',
								'link_after'      => '</span>',
							) );

							echo strip_tags( $social, '<a><div><span>' );
						endif;
					?>
				</div>
			</div>
		</footer><!-- #colophon -->
	</div><!-- #page -->

<?php // include('popups-registration-modal.php');?>
     
<?php
/////JOB ALERTS
if(is_page(2236) ){
	?>
    <script type="text/javascript" src="<?php echo get_stylesheet_directory_uri();?>/inc/js/er-ja.js" ></script>

    <?php
}
?>
<?php
///REMOVE THINGS ON CANDIDATE DASHBAORD
if(is_page(2637)){
	
	if($_GET['action']=='add_alert'){
		?>
        <script>
		jQuery(document).ready(function(){
			jQuery("#topSection").remove();
			});
		</script>
        <?php
	}
	
}
?>
<script>
	jQuery(document).ready(function(){
		jQuery('.unlogout').on('click', function(){
			jQuery('#logoutcon').modal('show');
    	}); 

		jQuery('.btt').on('click', function(){
        	jQuery("html, body").animate({ scrollTop: 0 }, 600);

    	}); 

		jQuery("li#login2-modal a").attr("href", "<?php echo site_url(); ?>/login/");
		/* LOGIN PAGE SCRIPTING NEEDING TO BE REMOVED OR CONDITIONALLY LOADED*/
		jQuery('.nav-tabs a').click(function(e){
			e.preventDefault();
			jQuery('.nav-tabs li').removeClass('active');
			jQuery(this).parent('li').addClass('active');
			var clickID = jQuery(this).attr('aria-controls');
			//alert(clickID);
			jQuery('.tab-pane').removeClass('active');
			jQuery('#'+clickID+'.tab-pane').addClass('active').fadeIn('slow');

			//var pageurl = jQuery(this).attr('pageurl');
			//jQuery('.get_started_now').attr('href', pageurl);
		});
		/* end login page scripting */
				 
		jQuery(".customactive").on('click',function(){
			var val = jQuery(this).data('tabss');
			var v = jQuery(this).data('t');
			jQuery('.nav-tabs li').removeClass('active');
			jQuery('.nav-tabs li.'+v).addClass('active');
			jQuery('.tab-pane').removeClass('active');
			jQuery('#'+val+'.tab-pane').addClass('active').fadeIn('slow');
			var pageurl = jQuery('.nav-tabs li.'+v+' a').attr('pageurl');
			jQuery('.get_started_now').attr('href', pageurl);
		});

	});	
</script>

  <?php
  echo types_render_field("footer-scripts", array("raw"=>"true"));

?>
	<?php wp_footer(); ?>
  
<link rel="stylesheet" type="text/css" href="<?php echo site_url(); ?>/assets/themes/eye-recruit-2015/css/overwrites.css"  />

<?php
///HANDLE ACCORDION
?>
<script>
jQuery('.acc_heading').on('click',function(){
	var parentDiv=jQuery(this).closest('.acc_group');
	parentDiv.find('.acc_heading').removeClass('active');
	parentDiv.find('.acc_body').slideUp();
	jQuery(this).addClass('active');
	jQuery(this).next().slideDown();
	 
	});
</script>

<?php
/////REMOVE LINKS FROM ONTRAPORT FORMS
?>
<style>
.opform_wrapper{ visibility:hidden;}
</style>
<script>
jQuery(document).ready(function(e) {
	jQuery(".opform_wrapper link").remove();
	jQuery(".opform_wrapper").css('visibility','visible');
});
</script>
<?php
/* RESUME SERVICES UPLOAD PAGE */
if(is_page(3836) ){
	if($_GET['sm']){
		if($_GET['sm']==1){
			$resType='Entry Level';
		}
		if($_GET['sm']==2){
			$resType='Professional';
		}
		if($_GET['sm']==3){
			$resType='Executive';
		}
	?>
    <script>
	jQuery("[name='first-name']").val("<?php echo $_GET['firstname']; ?>");
	jQuery("[name='last-name']").val("<?php echo $_GET['lastname']; ?>");
	jQuery("[name='your-email']").val("<?php echo $_GET['email']; ?>");
	jQuery("[name='resumeType']").val("<?php echo $resType; ?>");
	</script>
    <?php
	}else{
	///redirect;
	
	}
	
}
?>

<?php  if(isset($_REQUEST['se'])) {  ?>
<script type="text/javascript">
	jQuery(document).ready(function(){
		var se= "<?php echo $_REQUEST['se']; ?>";
		var deceoded_mail= atob(se);
		jQuery('#enc_mail').html(deceoded_mail);

	})
</script>
<?php } ?>
<?php if ( !is_user_logged_in() ) { ?>
	<script type="text/javascript">
	/*jQuery(document).ready( function() { 
		jQuery('.homepage-content .homejob_btns a:first-child').attr('href', '<?php echo site_url()."/login"; ?>');
		setTimeout( function() {
			jQuery('.homepage-content .homejob_btns a:first-child').attr('href', '<?php echo site_url()."/login"; ?>');
		},1000);
	});*/
	</script>
<?php } ?>

<script type="text/javascript">
	jQuery(document).ready( function() {

		var ulno = 1;
		jQuery('.custom_our_comp .sub-menu').addClass('custom_ul'+ulno);
		jQuery('<div class="clearfix"></div>').insertBefore('.custom_our_comp .custom_ul1');
		jQuery('.custom_our_comp .sub-menu li').each( function() {
			var liId = jQuery(this).attr('id');
			var indexval = jQuery(this).index();
			if ( ( indexval % 4 == 0) && (indexval!= 0) ) {
				ulno++;
				jQuery('<ul class="sub-menu custom_ul'+ulno+'"></ul>').appendTo('.custom_our_comp');
			}
			jQuery(this).addClass('ulno'+ulno);
		}); 

		for (var i = 1; i <= ulno; i++) {
			jQuery('.ulno'+ulno).appendTo('.custom_ul'+ulno);
		}
	});
</script>


<script type="text/javascript">
	jQuery(document).ready(function(){
		jQuery("#step1").click(function(){
			//jQuery('.home').addClass("modal-open");
			jQuery("#absolutely_free").modal('hide');
			jQuery("#better_decisions").modal('show');
			jQuery('body').delay(500).queue(function(){
				jQuery(this).addClass('modal-open').clearQueue();
			});
		});
		jQuery("#step2").click(function(){
			//jQuery('.home').addClass("modal-open");
			jQuery("#better_decisions").modal('hide');
			jQuery("#extend_reach").modal('show');
			jQuery('body').delay(500).queue(function(){
				jQuery(this).addClass('modal-open').clearQueue();
			});
		});

	});
</script>

</body>
</html>