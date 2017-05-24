<?php
/**
 * Single Post
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Jobify
 * @since Jobify 1.0
 */
///USER MUST BE LOGGED IN TO SEE
if(!is_user_logged_in() ){
	header('location: /');	
};

get_header(); ?>

	<?php the_post(); ?>
	<header class="page-header">
		<h1 class="page-title">
			<?php printf( __( 'Jobs at %s', 'jobify' ), esc_attr( urldecode( get_query_var( 'term' ) ) ) ); ?></h1>
<?php 
//$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); 
//echo $term->name; // will show the name
//echo get_queried_object()->term_id; ?>
		
	</header>
	<?php rewind_posts(); ?>

	<div id="primary" class="content-area cusjoblistingtex">
		<div id="content" class="container" role="main">
			<div class="company-profile">
			<div class="filter_loader loader inner-loader" id="loaders" style="display:none;"></div>
				<div class="company-profile-jobs">
					<?php if ( have_posts() ) : ?>
					<div class="job_listings">
						<ul class="job_listings">
							<?php while ( have_posts() ) : the_post(); ?>
								<?php get_job_manager_template_part( 'content', 'job_listing' ); ?>
							<?php endwhile; ?>
						</ul>
					</div>
					<?php else : ?>
						<?php get_template_part( 'content', 'none' ); ?>
					<?php endif; ?>
				</div>

				<!-- <div class="company-profile-info job-meta col-md-2 col-sm-4 col-xs-4">

					

				</div> -->

			</div>
		</div><!-- #content -->

		<?php do_action( 'jobify_loop_after' ); ?>
	</div><!-- #primary -->

<?php get_footer(); ?>
<script type="text/javascript">
	jQuery(document).ready( function() {
		jQuery('.job-manager-applications-applied-notice').remove();
		jQuery('.cusjoblistingtex .paginate-links').removeClass('container').wrap('<div class="custompagination container"></div>');
	});
</script>

<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/css/sweetalert.css">
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/sweetalert.js"></script>


<!-- Save Bookmark -->
<script type="text/javascript">
    jQuery(document).ready( function(){
        jQuery('.company-profile').on('click', '.custSaveBookmark', function() {
            var _this = jQuery(this);
            var postid = _this.attr('postid');
            var userid = '<?php echo get_current_user_id(); ?>';
            jQuery('#loaders').show();
            jQuery.ajax({
                type: 'POST',
                url: '<?php echo admin_url("admin-ajax.php") ?>',
                dataType: 'json',
                data: {
                    action: 'saveCustomBookmarks', //Action in inc/edit_basic_info.php
                    postid: postid,
                    userid: userid
                },
                success:function(data){
                    jQuery('#loaders').hide();
                    if ( data.msg == 'success' ) {
                        var sveurl = "<?php echo site_url(); ?>/preferences/saved-jobs-of-interest/";
                        _this.html('Saved');
                        _this.attr('href', sveurl);
                        _this.removeClass('btn-default custSaveBookmark').addClass('btn-primary');

                        swal({
                            title: "Success", 
                            html: true,
                            text: "<span class='text-center'>SUCCESS! This Job has been successfully saved!  You will be able to find it later by going to your Saved Jobs of Interest from your Dashboard or from Preferences.</span>",
                            type: "success",
                            confirmButtonClass: "btn-primary btn-sm",
                        });
                    }
                    else if(data.msg == 'exist'){
                        _this.removeClass('btn-default custSaveBookmark').addClass('btn-primary');
                        _this.html('Saved');
                        swal({
                            title: "Warning", 
                            html: true,
                            text: "<span class='text-center'>Job already saved. <br> To check your saved Job <a href='"+sveurl+"'>Click Here</a></span>",
                            type: "warning",
                            confirmButtonClass: "btn-primary btn-sm",
                        });
                    }
                    else{
                        swal({
                            title: "Error", 
                            html: true,
                            text: "<span class='text-center'>Something Wrong. Please try again!</span>",
                            type: "warning",
                            confirmButtonClass: "btn-primary btn-sm",
                        });
                    }
                }
            });
        });
    });
</script>


<!-- Forward Job Pop_up -->
<?php
    $user_id = get_current_user_id();
    if(is_user_logged_in()){
    	$getuserdata = get_userdata($user_id);
        $Fname =  get_user_meta($user_id, 'first_name', true);
        $Lname =  get_user_meta($user_id, 'last_name', true);
        $Email =  $getuserdata->user_email;
    }
    else{
        $Fname = '';
        $Lname = '';
        $Email ='';
    }

 ?>

<div class="modal fade" id="shareModalWrap" tabindex="-1" role="dialog" aria-labelledby="shareModalWrapLabel">
  <div class="vertical-alignment-helper">
    <div role="document" class="modal-dialog modal-lg vertical-align-center">
      <div class="modal-content">
        <div class="modal-body">
            <button aria-label="Close" data-dismiss="modal" class="close profile_pic_close_button" type="button"><span aria-hidden="true">×</span>
            </button>
            <img class="popup_logo" src="<?php echo site_url(); ?>/assets/uploads/2016/04/EyeRecruit.com-logo_3-2.jpg">
            <h3>Share Job</h3>
            <div class="clearfix"></div>

            <form method="post" action="" class="wpcf7-form text-left" id="forward_modal_form">
                <h4>Send To</h4>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>First Name (required)</label>
                            <span class="wpcf7-form-control-wrap firstname-to">
                                <input type="text" class="form-control" size="40"  name="firstname_to" id="firstname_to">
                            </span>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Last Name (required)</label>
                            <span class="wpcf7-form-control-wrap lastname-to">
                                <input type="text"  class="form-control" size="40"  name="lastname_to" id="lastname_to">
                            </span>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Email (required)</label>
                            <span class="wpcf7-form-control-wrap email-to">
                                <input type="email"  class="form-control" size="40"  name="email_to" id="email_to">
                            </span>
                        </div>
                    </div>
                </div>
                <h4>From</h4>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Your First Name (required)</label>
                            <span class="wpcf7-form-control-wrap firstname-from">
                                <input type="text"  class="form-control" size="40" value="<?php echo $Fname; ?>"  name="firstname_from" id="firstname_from">
                            </span>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Your Last Name (required)</label>
                            <span class="wpcf7-form-control-wrap lastname-from">
                                <input type="text"  class="form-control" size="40" value="<?php echo $Lname; ?>"  name="lastname_from" id="lastname_from">
                            </span>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Your Email (required)</label>
                            <span class="wpcf7-form-control-wrap email-from">
                                <input type="email"   class="form-control" size="40" value="<?php echo $Email; ?>"  name="email_from" id="email_from">
                            </span>
                        </div>
                    </div>
                </div>
                <h4>Email Message</h4>
                <div class="form-group">
                    <label>Comments to be included in email message:</label>
                    <span class="wpcf7-form-control-wrap shareMsg">
                        <textarea  class="form-control" rows="10" cols="40" name="shareMsg" id="shareMsg"></textarea>
                    </span>
                </div>
                <p>
                    <input type="hidden" value="theVal" id="shareJobURL" name="shareJobURL">
                </p>
                <div class="text-center">
                    <input type="hidden" value="" name="thisjobid">
                    <input type="submit" class="btn btn-primary btn-sm " value="Send" name="forward_job">
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
  jQuery(document).ready( function(){

    jQuery('.company-profile').on('click', '.forwardThisjob', function() {
      var _this = jQuery(this);
      var jobid = _this.attr('jobid');
      jQuery('input[name="thisjobid"]').val(jobid);
      jQuery('#shareModalWrap').modal('show');
    });

    jQuery('input[name="forward_job"]').on('click', function() {
      var _this = jQuery(this);
      jQuery("#forward_modal_form").validate({
        rules:{
          firstname_to:{
              required:true
          },
          lastname_to:{
              required:true
          },
          email_to:{
              required:true
          },
          firstname_from:{
              required:true
          },
          lastname_from:{
              required:true
          },
          email_from:{
              required:true
          },
          shareMsg:{
              required:true
          }
        },
        messages:{
          firstname_to:{
              required:"Please enter first name"
          },
          lastname_to:{
              required:"Plese enter last name"
          },
          email_to:{
              required:"Please enter an email address"
          },
          firstname_from:{
              required:"Please enter first name"
          },
          lastname_from:{
              required:"Please enter last name"
          },
          email_from:{
              required:"Please enter an email address"
          },
          shareMsg:{
              required:"Please enter your messages"
          }
        },
        submitHandler: function(form) {
          _this.attr('disabled', 'disabled');
          _this.val('Please Wait...');
          var to_first_name = jQuery("#firstname_to").val();
          var to_last_name  = jQuery("#lastname_to").val();
          var to_email      = jQuery("#email_to").val();
          var from_firstname = jQuery("#firstname_from").val();
          var from_lastname = jQuery("#lastname_from").val();
          var from_email    = jQuery("#email_from").val();
          var share_message  = jQuery("#shareMsg").val();
          var jobid  = jQuery("input[name='thisjobid']").val();
          jQuery.ajax({
            type: 'POST',
            url: '<?php echo admin_url("admin-ajax.php"); ?>',
            dataType: 'json',
            data:{
              action: 'forwardThisJob', //Action in inc/edit_basic_info.php file
              'to_first_name': to_first_name,
              'to_last_name' : to_last_name,
              'to_email'     : to_email,
              'from_firstname': from_firstname,
              'from_lastname': from_lastname,
              'from_email':   from_email,
              'share_message': share_message,
              'jobid': jobid
            },
            success:function(data){
              if ( data.msg == 'success' ) {
                jQuery('#forward_modal_form')[0].reset();
                _this.removeAttr('disabled');
                _this.val('Send');
                jQuery('#shareModalWrap').modal('hide');
                swal({
                    title: "Success", 
                    html: true,
                    text: "<span class='text-center'>SUCCESS! You have successfully forwarded this Job Opening! Even if the Job isn't right for you, you can build your professional network by helping someone you know imporve their long term career goals. Great Job!</span>",
                    type: "success",
                    confirmButtonClass: "btn-primary btn-sm",
                });
              }
              else{
                _this.removeAttr('disabled');
                _this.val('Send');
                jQuery('#shareModalWrap').modal('hide');
                swal({
                    title: "Error", 
                    html: true,
                    text: "<span class='text-center'>Something wrong. Please try again !</span>",
                    type: "warning",
                    confirmButtonClass: "btn-primary btn-sm",
                });
              }
            }
          });
        }
      });
    });
  });
</script>