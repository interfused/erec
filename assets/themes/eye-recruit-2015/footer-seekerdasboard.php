<?php
/**
 * The template for displaying the  seeker dashboard footer.
 *
 * Contains footer content and the closing of the
 * #main and #page div elements.
 *
 * @package Jobify
 * @since Jobify 1.0
 */
?>
</div><!-- #main -->
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

<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery('.unlogout').on('click', function(){
		jQuery('#logoutcon').modal('show');
	}); 
});    	

</script>
		<footer id="colophon" class="site-footer" role="contentinfo">
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
	<script type="text/javascript">
	jQuery(document).ready(function(){

		jQuery("li#login2-modal a").attr("href", "<?php echo site_url(); ?>/login/");
	});

	</script>
	<?php wp_footer(); ?>
<script type="text/javascript">
	jQuery(document).ready(function(){
		jQuery("li#login2-modal a").attr("href", "<?php echo site_url(); ?>/login/");

		jQuery('.btt').on('click', function(){
			jQuery("html, body").animate({ scrollTop: 0 }, 600);
    	});

		jQuery('.userdetail_add_more').live('click', function(){

            var ln_no = jQuery(this).attr('count');

            var count = parseInt(ln_no)+1;

            jQuery("#userdetail_all_fields").append('<div class="edit-main-dv" id="userdetail_pr_'+count+'" ><div class="form-group"><label for="userdetail" class="col-sm-4 control-label">Name:</label><div class="col-sm-8"><input type="text" name="fname[]" id="fname_'+count+'" class="regular-text code form-control"></div></div><div class="form-group"><label for="userdetail" class="col-sm-4 control-label">To e-mail address:</label><div class="col-sm-8"><input type="text" name="user_email[]" id="user_email_'+count+'" class="regular-text code form-control"></div></div><span class="remove_edu btn btn-default btn-sm pull-right" id="remove_edu_'+count+'" rel="'+count+'">remove</span><div class="clearfix"></div></div>');
            jQuery(this).attr('count', count);
        });


        jQuery('.remove_edu').live('click', function(){
            var rel = jQuery(this).attr('rel');
            jQuery('#userdetail_pr_'+rel).remove();
            jQuery('#remove_edu_'+rel).remove();
        });

        //for email validation
		function validEmail(v) {
		    var r = new RegExp("[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?");
		    return (v.match(r) == null) ? false : true;
		}

		//for name validation
		jQuery( "#userdetail_all_fields" ).on('keyup', 'input[name="fname[]"]', function() {
			var name_val = jQuery(this).val();
			var name_id = jQuery(this).attr('id');
			jQuery('#'+name_id+'-error').remove();

			if ( name_val == '' ) {
				jQuery('<label id="'+name_id+'-error" class="error send_mail_error" for="'+name_id+'">Name is required.</label>').insertAfter(this);
			}
			else{
				jQuery('#'+name_id+'-error').remove();
			}

		});

		//for email validation
		jQuery( "#userdetail_all_fields" ).on('keyup', 'input[name="user_email[]"]', function() {
			var email_val = jQuery(this).val();
			var email_id = jQuery(this).attr('id');
			jQuery('#'+email_id+'-error').remove();

			if ( email_val == '' ) {
				jQuery('<label id="'+email_id+'-error" class="error send_mail_error" for="'+email_id+'">Email is required.</label>').insertAfter(this);
			}
			else if ( !validEmail(email_val) ) {
				jQuery('<label id="'+email_id+'-error" class="error send_mail_error" for="'+email_id+'">Please enter a valid email.</label>').insertAfter(this);
			} 
			else{
				jQuery('#'+email_id+'-error').remove();
			}
		});

		//save and close button functionality
		jQuery('#inv_a_coll').on('click', function(){

			jQuery('.error').remove();

			jQuery('input[name="fname[]"]').each( function() {

				var name_val = jQuery(this).val();
				var name_id = jQuery(this).attr('id');

				if ( name_val == '' ) {
					jQuery('<label id="'+name_id+'-error" class="error send_mail_error" for="'+name_id+'">Name is required.</label>').insertAfter(this);
				}
			});

			jQuery('input[name="user_email[]"]').each( function() {

				var email_val = jQuery(this).val();
				var email_id = jQuery(this).attr('id');

				if ( email_val == '' ) {
					jQuery('<label id="'+email_id+'-error" class="error send_mail_error" for="'+email_id+'">Email is required.</label>').insertAfter(this);
				}
				else if ( !validEmail(email_val) ) {
					jQuery('<label id="'+email_id+'-error" class="error send_mail_error" for="'+email_id+'">Please enter a valid email.</label>').insertAfter(this);
				}  
			});

			if(!jQuery('.error').hasClass('send_mail_error')){

				var _this = jQuery(this).html('Please Wait..');
				_this.attr('disabled','disabled');
				
				var rfname = [];

				jQuery('input[name="fname[]"]').each( function() {
					rfname.push( jQuery(this).val() );
				});

				var rfemail = [];
				jQuery('input[name="user_email[]"]').each( function() {
					rfemail.push( jQuery(this).val() );
				});

				jQuery.ajax({
			 		type:"POST",
					url: "<?php echo site_url('/wp-admin/admin-ajax.php'); ?>", 
					data: {
						action: 'invite_any_colleague',
						rfname: rfname,
						rfemail: rfemail
					},
					success:function(r){
						jQuery('#invite_a_colleague').modal('hide');
						swal({
							title: "Success", 
							html: true,
							text: "<span class='text-center'>All Colleague entries have been saved and invited !</span>",
							type: "success",
							confirmButtonClass: "btn-primary btn-sm",
						});
						_this.removeAttr('disabled').html('Submit');
						setTimeout(function(){ 
							jQuery('#rfsuccess').remove();
							for (var k=1; k<=jQuery('#userdetail_add_more').attr('count'); k++) {
					            jQuery('#user_email_'+k).val('');
					            jQuery('#fname_'+k).val('');
					            if(k!=1){ jQuery('#userdetail_pr_'+k).remove(); }
            				};
						}, 2000);
					}
				});
			}
		});

		//for invite a collegue popup close
		jQuery('#rfclosepopup').on('click', function(){
			jQuery('.error').remove();
			for (var k=2; k<=jQuery('#userdetail_add_more').attr('count'); k++) {
	            jQuery('#userdetail_pr_'+k).remove();
            };
		});
    });	

</script>
</body>
</html>