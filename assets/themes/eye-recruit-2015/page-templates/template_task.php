<?php
/**
 * Template Name: Task page
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Jobify
 * @since Jobify 1.0
 */


get_header(); ?>
<h1>DEV: need to debug / find out what qtype</h1>
	<script type="text/javascript" src="<?php  echo get_stylesheet_directory_uri(); ?>/rating/jquery-rating.js"></script>
	<!-- <link rel="stylesheet" type="text/css" href="<?php //echo get_stylesheet_directory_uri(); ?>/css/sweetalert.css"> 
	<script type="text/javascript" src="<?php //echo get_stylesheet_directory_uri(); ?>/js/sweetalert.js"></script> -->
	<link rel="stylesheet" type="text/css" href="<?php  echo get_stylesheet_directory_uri(); ?>/rating/jquery-rating.css">
	<?php
		$url = site_url();
		$userID = get_current_user_id(); 
		$current_user = wp_get_current_user();

		$view = '';
		if ( isset($_REQUEST['recruitID']) ) {
			$user_id = $_REQUEST['recruitID'];
			$userdata = get_userdata($user_id);
			$cand_name = $userdata->first_name.' '.$userdata->last_name;

			$accessEmp = get_cimyFieldValue($user_id, 'PNA_SELF_ASSESSMENTS');
			$accessRec = get_cimyFieldValue($user_id, 'PNAR_SELF_ASSESSMENT');
			if ( in_array( 'candidate', $current_user->roles) ){
				if ( $accessEmp == 'Yes' ) {
					$view = 'allow';
				}
			}
			elseif ( in_array( 'administrator', $current_user->roles) ) {
				if ( $accessRec == 'Yes' ) {
					$view = 'allow';
				}
			}
			elseif( in_array('employer', $current_user->roles) ){
				if ( $accessEmp == 'Yes' ) {
					$view = 'allow';
				}
			}
		}
		elseif ( in_array( 'candidate', $current_user->roles) ){
			$view = 'allow';
		}
		else{
			echo wp_redirect($url);
		}
	?>
	<?php while ( have_posts() ) : the_post(); ?>
		<header class="page-header">
			<h1 class="page-title"><?php the_title(); ?></h1>
		</header>


		<div id="primary" class="content-area skill_asse">
			<div id="content" class="container" role="main">
				<div class="filter_loader loader inner-loader" id="loaders" style="display:none;"></div>
				<?php if($view == 'allow'){ ?> 
					<div class="star_rating">
						<div class="row">
							<div class="col-lg-2 col-md-4 col-sm-4">
								<div class="rating_box">
									<span class="star_icon rating1"></span>
									<div class="rating_cont">
										<h4>Beginner</h4>
										<p>Has limited experience, shows desire and adopts behaviors driven by standards in the simplest situations. Requires extensive guidance.</p>
									</div>
								</div>
							</div>
							<div class="col-lg-2 col-md-4 col-sm-4">
								<div class="rating_box">
									<span class="star_icon rating2"></span>
									<div class="rating_cont">
										<h4>Competent</h4>
										<p>Has been confronted with a sufficient number of practical situations to observe and applies comptency in somewhat difficult situations. Requires frequent quidance.</p>
									</div>
								</div>
							</div>
							<div class="col-lg-2 col-md-4 col-sm-4">
								<div class="rating_box">
									<span class="star_icon rating3"></span>
									<div class="rating_cont">
										<h4>Intermediate</h4>
										<p>Posses two or three years of experience in the same circumstances and can evaluate and execute initiatives. Does not process self-sufficiency yet, but has the knowledge and preparation to face most situations. Requires occasional guidance.</p>
									</div>
								</div>
							</div>
							<div class="col-lg-2 col-md-4 col-sm-4">
								<div class="rating_box">
									<span class="star_icon rating4"></span>
									<div class="rating_cont">
										<h4>Advanced</h4>
										<p>Applies accumulated experience completely in considerably difficult situations. Able to identify, colaborate, communicate and make decisions efficiently. Generally requires little and no guidance.</p>
									</div>
								</div>
							</div>
							<div class="col-lg-2 col-md-4 col-sm-4">
								<div class="rating_box">
									<span class="star_icon rating5"></span>
									<div class="rating_cont">
										<h4>Expert</h4>
										<p>Applies accumulated experience completely in exceptionally difficult situations. Serves as a key resource and advises others. Not all professionals are able to reach this level.</p>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php 
					$id 	= get_the_ID();
					$qtype 	= get_post_meta($id,'question_type',true);
					$pageSlug = get_post_field( 'post_name', get_post() );
					getQuestions($qtype);
					?>
					
					<h2>q type is: <?php echo $qtype;?></h2>
					<?php the_content(); ?>

					<?php  if ( is_user_logged_in() && isset($_REQUEST['recruitID']) ) {
						$pageID = get_the_ID();
						$pagedata = get_post($pageID);
						$slug = $pagedata->post_name;
						$checkForNewUser = get_user_meta($userID, 'new-user'.$slug.$_REQUEST['recruitID'], true); 
						if ( (empty($checkForNewUser)) && (!in_array( 'candidate', $current_user->roles)) && (isset($_REQUEST['recruitID'])) ) { ?>
							<script type="text/javascript">
								jQuery(document).ready(function() {
									jQuery('#selfAsse').modal('show');
								});
							</script>
							<?php 
							update_user_meta($userID, 'new-user'.$slug.$_REQUEST['recruitID'], $slug);
						} 
					}
					update_user_meta($userID, 'guidenewUserAsses', 'Yes'); ?>
				<?php } else{ ?>
					<?php do_action( 'jobify_loop_after' ); ?>

					<div class="no-jobs-found restrict_notice">
										<h4 class="no_job_listings_found"><?php echo $cand_name; ?> has set the Security settings on this section of the profile to Restricted.</h4>
										<div class="media">
										  <div class="media-left">
										    <img class="media-object" src="<?php echo get_stylesheet_directory_uri(); ?>/img/big_minus.jpg" alt="0">
										  </div>
										  <div class="media-body">
										    <p>What does that mean? To view this material, you will need to click the link below and a message will be sent notifying the candidate that you would like access to view this material. Once <?php echo $cand_name; ?> approves the material to be viewed, you will recieve a message via mail and within your profile that your access has been granted.</p>
										  </div>
										</div>
										<div class="text-center">
											<a href="mailto:<?php echo $userdata->user_email; ?>" class="btn btn-sm btn-success">Notify</a>
										</div>
								</div><!-- no-jobs-found -->
				<!-- 	<div class="text-center">
						<div class="jobsearch_results job_listings listingforward">
							<div class="no-jobs-found">
								<h4 class="no_job_listings_found">Whoops! <?php echo $cand_name; ?> restrict access to view. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum is simply dummy text of the printing and typesetting industry.</h4>
								<p><strong>Here are some ideas that might help:</strong></p>
								<ul>
									<li>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</li>
									<li>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</li>
								</ul>
								<p>Still no luck? Send us your feedback: <a href="mailto:support@EyeRecruit.com">support@EyeRecruit.com</a>.</p>
							</div>
						</div>
					</div> -->


				<?php } ?>
			</div><!-- #content -->

			<?php do_action( 'jobify_loop_after' ); ?>
		</div><!-- #primary -->
	<?php endwhile; ?>
	
	<script type="text/javascript">
		jQuery(document).ready( function() {

			/*........View Steps..............*/
			jQuery('.view_this_step').on('click', function() {
				var step = jQuery(this).data('step');
				jQuery('.view_this_step').removeClass('active');
				jQuery(this).addClass('active');
				jQuery('.basic_info_steps').hide();
				jQuery('.basic_info_step_'+step).show();
				jQuery('html, body').animate({
			        scrollTop: jQuery('.basic_info_step_'+step).offset().top - 150
			    }, 500);
			});

			jQuery('input[value="no"]').on('change', function(){
		        var thisName = jQuery(this).attr('name');
		        jQuery('#m'+thisName+' .jr-ratenode').each( function(eh){
		        	jQuery(this).removeClass('jr-rating');
		        	jQuery(this).addClass('jr-nomal');
		        });
		        //jQuery('#loaders').show();
		        jQuery.ajax({
		          type: 'POST',
		          dataType: 'json',
		          url:'<?php echo site_url();  ?>/wp-admin/admin-ajax.php',
		          data: {
		            'action': 'save_assessment_none',
		            'question': thisName,
		            'slug': '<?php echo get_post_field("post_name", get_post() ); ?>'
		          },
		          success: function(data){
		          	/*swal({
		              title: "Success", 
		              html: true,
		              text: "<span class='text-center'>Successfully updated!</span>",
		              type: "success",
		              confirmButtonClass: "btn-primary btn-sm",
		            });
		        	jQuery('#loaders').hide();*/
		          }
		        });
		      });
		});
	</script>

<?php get_footer('assessment'); ?>

<div class="modal fade" id="selfAsse" tabindex="-1" role="dialog" aria-labelledby="selfAsseLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content default-form">
      <div class="modal-body tour_modal">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <img src="<?php echo site_url();  ?>/assets/uploads/2016/04/EyeRecruit.com-logo_3-2.jpg" class="popup_logo">
        <h3>Welcome to the self-assessment section</h3>
        <div class="clearfix"></div>
        <div class="wpcf7-form text-center">
        	<p><em>We ask very specific questions in areas of the industry sectors we represent and you may or may not have interest or experience. </em></p>
			<p><em>Do not answer in the affirmative if that is not an accurate statement.If you have a plus membership and you <strong>are</strong> responding to the more in-depth questions, please respond to all questions by indicating what you think your level of competency is at this current point of your career. </em></p>
			<p><em>Regardless of the level of membership, we ask only that you answer honestly. Responses, or a lack of a response to questions do not necessarily exclude a job seeker from consideration, but they go a long way to assisting you accomplish the desires you have for this service. </em></p>
        	<div class="text-center">
				<p><button type="button" class="btn btn-primary" data-dismiss="modal">Continue</button></p>
		    </div>
        </div>
      </div>
    </div>
  </div>
</div>