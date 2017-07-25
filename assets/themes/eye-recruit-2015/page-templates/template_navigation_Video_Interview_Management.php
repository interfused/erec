<?php
/**
 * Template Name: Navigation Video Interview Management page
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Jobify
 * @since Jobify 1.0
 */


get_header(); ?>
	<?php 
	if ( !is_user_logged_in() ) {
		$url = site_url();
		echo wp_redirect($url);
	}

	$userID = get_current_user_id();
	$current_user = wp_get_current_user();
	if(isset($_REQUEST['recruitID'])){
		$verb = 'has';
	}else{
		$verb ='have';
	}
	if ( isset($_REQUEST['recruitID']) ) {
	  $userID = $_REQUEST['recruitID'];
	  $userdata = get_userdata($userID);
	  $allowView = '';
	  $breadText = '';
	  $cand_name = $userdata->first_name.' '.$userdata->last_name;
	  if ( in_array( 'candidate', $current_user->roles) ){
	  	$breadcrumbUrl = '/job-seekers/seeker-profile-view/';
	  }
	  elseif ( in_array( 'administrator', $current_user->roles) ) {
	  	$breadcrumbUrl = '/employers/redacted-recruiter-quick-view/?recruitID='.$userID;
	  }
	  else{
	  	$breadcrumbUrl = '/employers/redacted-employer-quick-view/?recruitID='.$userID;
	  }
	}
	elseif ( in_array( 'candidate', $current_user->roles) ){
	  $userID  = get_current_user_id();
	  $allowView = 'allow';
	  $breadcrumbUrl = '/job-seekers/dashboard/';
	  $breadText = 'Management';
	  $cand_name = 'You';
	}
	else{
		$url = site_url();
		echo wp_redirect($url);
	}
	$current = wp_get_current_user();
    $roles = $current->roles;
    $role = array_shift( $roles );


	?>

<link rel='stylesheet' id='custom-dashboard-css'  href='<?php echo site_url();  ?>/assets/themes/eye-recruit-2015/dashboard.css?ver=4.5.3' type='text/css' media='all' />

	<?php while ( have_posts() ) : the_post(); ?>

	<header class="page-header">
		<h1 class="page-title"><?php the_title(); ?></h1>
	</header>

	<div id="primary" class="content-area">
		<div id="content" class="container" role="main">
			<section class="navigations">
				<div class="section_title">
					<h3>Video Interview <?php echo $breadText; ?></h3>
					<span><strong>Recruit ID</strong> : <?php echo $userID; ?></span>
				</div>
				<div class="row indent">
					<div class="col-md-9">
						<ol class="breadcrumb">
						  <li><a href="<?php echo site_url().$breadcrumbUrl; ?> ">Home</a></li>
						  <li class="active">Video Interview <?php echo $breadText; ?></li>
						</ol>
						<div class="search_bar">
							<p><?php echo $cand_name." ".$verb; ?> completed & stored <span>6</span> Video Interview(s)</p>
						</div>
					</div>
				</div>
				<div class="row indent">
					<div class="col-md-9">
						<div class="navigations_list video_interview">
							<div class="row nav_listcol3">
								<?php
								//$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
								$args = array(
									'post_type'   => array( 'interview' ),
									'post_status'  => array( 'publish' ),
									'order'         => 'ASC',
									'posts_per_page'=>-1
								//	'paged'		=>$paged
								);
								$query = new WP_Query( $args );
								if ( $query->have_posts() ) { 
										while($query->have_posts()){
										 	$query->the_post();
				                        ?>
										<div class="col-md-4 col-sm-6 col-xs-6 devicefull">
											<article class="navs_listitem">
												<div class="nav_list_header">
													<small>“<?php echo get_the_content();  ?>”</small>
												</div>
												<div class="nav_list_cont">
													<div class="nav_list_middle">
														<ul class="text-right">
															<li><a href="javascript:void(0);">Preview</a></li>
															<li><a href="javascript:void(0);">Forward</a></li>
															<?php if($allowView == 'allow'){ ?><li><a class="videodelete" href="javascript:void(0);" docId="<?php echo $post->ID;  ?>">Delete</a></li><?php } ?>
														</ul>
														<div class="thumbnail">
															<div href="javascript:void(0);" class="video_overlay">
																<a href="#" class="video_icon">&nbsp;</a>
																<?php  if ( (is_user_logged_in()) &&  ($role == 'candidate') ) {  ?>
																<span><a target="_blank" class="btn btn-primary btn-sm" href="<?php echo get_post_meta($post->ID,'video_link',true);  ?>">Update Response</a></span>
																<?php  } ?>
															</div>
		      												<!-- <img src="<?php //echo get_stylesheet_directory_uri(); ?>/img/video_user.jpg" class="img-responsive" alt="Resume"> -->
		      												<?php 
		      													echo do_shortcode('[ica_avatar uid="'.$userID.'"]');
															  ?>
														</div>
														<?php if($allowView == 'allow'){ ?>
															<div class="text-center">
																<p><strong>Upload Date</strong> :<br> 09/01/2016</p>
																<div class="radio">
																  <label data-toggle="tooltip" data-placement="top" title="When your profile is viewed, this is the one you want to show without permission">
																    <input type="radio" name="manage_resume1<?php echo get_the_ID(); ?>" value="option1" checked>
																    <span>Currently Viewable</span>
																  </label>
																</div>
																<div class="radio">
																  <label data-toggle="tooltip" data-placement="top" title="When your profile is viewed, this is the one you want show only with permission.">
																    <input type="radio" name="manage_resume1<?php echo get_the_ID(); ?>"  value="option1">
																    <span>Permission Only</span>
																  </label>
																</div>
																<div class="radio">
																  <label data-toggle="tooltip" data-placement="top" title="When your profile is viewed, it will indicate that you have or do not have, but will provide no further information.">
																    <input type="radio" name="manage_resume1<?php echo get_the_ID(); ?>" value="option1">
																    <span>Restrict Access</span>
																  </label>
																</div>
															</div>
														<?php } ?>
													</div>
												</div> 
											</article>
										</div>
										
										<?php
										}
										?>
										</div>
										<div class="videointerview paginationDiv">
										<?php 
									  /*  $total_pages = $query->max_num_pages;

									    if ($total_pages > 1){

									        $current_page = max(1, get_query_var('paged'));

									        echo paginate_links(array(
									            'base' => get_pagenum_link(1) . '%_%',
									            'format' => '/page/%#%',
									            'current' => $current_page,
									            'total' => $total_pages,
									            'prev_text'    => __('« prev'),
									            'next_text'    => __('next »'),
									        ));
									    }*/
										wp_reset_postdata(); ?>
										</div>
										<div class="clearfix"></div>
										<?php } ?>

								<div class="row nav_listcol3">
								<div class="col-md-4 col-sm-6 col-xs-6 devicefull">
									<article class="navs_listitem video_pending">
										<div class="nav_list_header">
											<strong>“What is the most recent skill you learned and where, when and how did you learn it?”</strong>
										</div>
										<div class="nav_list_cont">
											<div class="nav_list_middle">
		
												<div class="thumbnail">
													<!-- <a href="javascript:void(0);" class="video_icon"><span>&nbsp;</span></a> -->
      												<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/video_calender.jpg" class="img-responsive" alt="Resume">
													<!-- <p>Go to here to complete the next section of interviews.<br>
														<?php  if ( (is_user_logged_in()) &&  ($role == 'candidate') ) {  ?>
      													<a target="_blank" href="https://hire.li/f91286c" target="_blank">https://hire.li/f91286c</a>
      													<?php  } ?>
      												</p> -->
												</div>
												<?php if($allowView == 'allow'){ ?>
													<div class="text-center">
														<p><strong>Upload Date</strong>: <span class="text-success">PENDING</span></p>
														<!-- <div class="radio">
														  <label data-toggle="tooltip" data-placement="top" title="">
														    <input type="radio" name="manage_resume6" id="optionsRadios6" value="option1" checked>
														    <span>Currently Viewable</span>
														  </label>
														</div>
														<div class="radio">
														  <label data-toggle="tooltip" data-placement="top" title="">
														    <input type="radio" name="manage_resume6" id="PermissionOnly6" value="option1">
														    <span>Permission Only</span>
														  </label>
														</div>
														<div class="radio">
														  <label data-toggle="tooltip" data-placement="top" title="">
														    <input type="radio" name="manage_resume6" id="RestrictAccess6" value="option1">
														    <span>Restrict Access</span>
														  </label>
														</div> -->
													</div>
												<?php } ?>
											</div>
										</div> 
									</article>
								</div>
								<div class="col-md-4 col-sm-6 col-xs-6 devicefull">
									<article class="navs_listitem video_pending">
										<div class="nav_list_header">
											<strong>“How would you define a good working environment?”</strong>
										</div>
										<div class="nav_list_cont">
											<div class="nav_list_middle">
											
												<div class="thumbnail">
													<!-- <a href="javascript:void(0);" class="video_icon"><span>&nbsp;</span></a> -->
      												<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/video_calender.jpg" class="img-responsive" alt="Resume">
      												<!-- <p>Go to here to complete the next section of interviews.<br>
      													<?php  if ( (is_user_logged_in()) &&  ($role == 'candidate') ) {  ?>
      													<a target="_blank" href="https://hire.li/89816e0" target="_blank">https://hire.li/89816e0</a>
      													<?php  } ?>
      												</p> -->
												</div>
												<?php if($allowView == 'allow'){ ?>
													<div class="text-center">
														<p><strong>Upload Date</strong> : <span class="text-success">PENDING</span></p>
														<!-- <div class="radio">
														  <label data-toggle="tooltip" data-placement="top" title="">
														    <input type="radio" name="manage_resume6" id="optionsRadios6" value="option1" checked>
														    <span>Currently Viewable</span>
														  </label>
														</div>
														<div class="radio">
														  <label data-toggle="tooltip" data-placement="top" title="">
														    <input type="radio" name="manage_resume6" id="PermissionOnly6" value="option1">
														    <span>Permission Only</span>
														  </label>
														</div>
														<div class="radio">
														  <label data-toggle="tooltip" data-placement="top" title="">
														    <input type="radio" name="manage_resume6" id="RestrictAccess6" value="option1">
														    <span>Restrict Access</span>
														  </label>
														</div> -->
													</div>
												<?php } ?>
											</div>
										</div> 
									</article>
								</div>
								<div class="col-md-4 col-sm-6 col-xs-6 devicefull">
									<article class="navs_listitem video_pending">
										<div class="nav_list_header">
											<strong>“How would you define a difficult working environment? (Have them spin it)”</strong>
										</div>
										<div class="nav_list_cont">
											<div class="nav_list_middle">
												<!-- <ul class="text-right">
													<li><a href="javascript:void(0);">Preview</a></li>
													<li><a href="javascript:void(0);">Forward</a></li>
													<?php if($allowView == 'allow'){ ?><li><a href="javascript:void(0);">Delete</a></li><?php } ?>
												</ul> -->
												<div class="thumbnail">
													<!-- <a href="javascript:void(0);" class="video_icon"><span>&nbsp;</span></a> -->
      												<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/Pre-Recorded-Interviews.jpg" class="img-responsive" alt="Resume">
													<!-- <p>Go to here to complete the next section of interviews.<br>
														<?php  if ( (is_user_logged_in()) &&  ($role == 'candidate') ) {  ?>
      													<a target="_blank" href="https://hire.li/a179d01" target="_blank">https://hire.li/a179d01</a>
      													<?php  } ?>
      												</p> -->
												</div>
												<?php if($allowView == 'allow'){ ?>
													<div class="text-center">
														<p><strong>Upload Date</strong> :<span class="text-primary">INCOMPLETE</span></p>
														<!-- <div class="radio">
														  <label data-toggle="tooltip" data-placement="top" title="">
														    <input type="radio" name="manage_resume6" id="optionsRadios6" value="option1" checked>
														    <span>Currently Viewable</span>
														  </label>
														</div>
														<div class="radio">
														  <label data-toggle="tooltip" data-placement="top" title="">
														    <input type="radio" name="manage_resume6" id="PermissionOnly6" value="option1">
														    <span>Permission Only</span>
														  </label>
														</div>
														<div class="radio">
														  <label data-toggle="tooltip" data-placement="top" title="">
														    <input type="radio" name="manage_resume6" id="RestrictAccess6" value="option1">
														    <span>Restrict Access</span>
														  </label>
														</div> -->
													</div>
												<?php } ?>
											</div>
										</div> 
									</article>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<?php  if ( (is_user_logged_in()) &&  ($role == 'employer') ) {  ?>
								<div class="special_box special_logo navi_thumbnail">
									<div class="thumbnail">
										<img src="http://demo.eyerecruit.com/assets/themes/eye-recruit-2015/img/navi_logo-icon.png" class="img-responsive">
									</div>
									<h5> ITS JUST A START</h5>
									<p>EyeRecruit offers an easy way for Hiring Managers, HR personnel and Recruiters to sit in on some general interview questions that the Job Seekers were asked to complete. The process was designed to quickly helps you get to know candidates better and compare responses to help you select the best qualified candidates to move to the next hiring phase, the in-person interview.  </p>
								</div>
								<div class="special_box special_logo navi_thumbnail">
									<div class="thumbnail">
										<img src="http://demo.eyerecruit.com/assets/themes/eye-recruit-2015/img/navi_logo-icon.png" class="img-responsive">
									</div>
									<h5>WHERE THIS IS GOING</h5>
									<p>Gone are the days of the phone interview.  Developed exclusively by EyeRecruit, Hiring Managers, HR personnel and Recruiters are now able to maximize time, improve efficiency, saved money, become more effective, achieve diversification, standardize processes and become more transparent, all while expanding your talent pool and focusing your time on the most important candidates that will have the most potential for positive impact within organization.</p>
								</div>
						
						<?php } elseif ((is_user_logged_in()) &&  ($role == 'candidate')){ ?>

							 <?php   if ( isset($_REQUEST['recruitID']) ) { ?>

							 	<div class="special_box special_logo navi_thumbnail">
									<div class="thumbnail">
										<img src="http://demo.eyerecruit.com/assets/themes/eye-recruit-2015/img/navi_logo-icon.png" class="img-responsive">
									</div>
									<h5> ITS JUST A START</h5>
									<p>EyeRecruit offers an easy way for Hiring Managers, HR personnel and Recruiters to sit in on some general interview questions that the Job Seekers were asked to complete. The process was designed to quickly helps you get to know candidates better and compare responses to help you select the best qualified candidates to move to the next hiring phase, the in-person interview.  </p>
								</div>
								<div class="special_box special_logo navi_thumbnail">
									<div class="thumbnail">
										<img src="http://demo.eyerecruit.com/assets/themes/eye-recruit-2015/img/navi_logo-icon.png" class="img-responsive">
									</div>
									<h5>WHERE THIS IS GOING</h5>
									<p>Gone are the days of the phone interview.  Developed exclusively by EyeRecruit, Hiring Managers, HR personnel and Recruiters are now able to maximize time, improve efficiency, saved money, become more effective, achieve diversification, standardize processes and become more transparent, all while expanding your talent pool and focusing your time on the most important candidates that will have the most potential for positive impact within organization.</p>
								</div>

							<?php  }else{  ?>

								<div class="special_box navi_thumbnail">
									<h5>Complete a section of video interview now</h5>
									<p>EyeRecruit offers you many ways for you to manage your own career. By selecting to <b>Start Now </b>below, you will have access to a comprehensive list of interview questions that are traditinally asked during the first stages of the hiring process within our industry. You will have control on how it is managed through permission based viewing.</p>
									<a href="javascript:void(0);" id="startvideo" class="btn btn-primary btn-sm">Start Now</a>
								</div>

								<div class="special_box navi_thumbnail">
									<h5>Upload your own videos</h5>
									<p>You do not have to use the suggested method to record your unique answers to the interview questions provided. By selecting <b>UPLOAD</b> you will be able to select the file or files that you would like to upload.You can use a 3rd party services or if your would like to record your responses on your smart phone, you have that option as well. Once saved, you will have control of how it is managed through permission based viewing.</p>
									<a href="javascript:void(0);" class="btn btn-primary btn-sm">Upload</a>
								</div>
							<!-- <div class="special_box navi_thumbnail special_logo">
								<div class="thumbnail"><img src="<?php  //echo get_stylesheet_directory_uri(); ?>/img/speciallogo.jpg" class="img-responsive"></div>
								<h5>Member Tip</h5>
								<p>Having a Pre-Recorded video Interview posted here <b>IS NOT MANDATORY</b> to use the services offered thought EyeRecruit.com. Providing responses to the most basic pre-employment interview questions will do three things:1. Help to distinguish yourself in a positive way and stand out to a Decision Maker, 2. It gives you the chance to relax and be yourself because none of the questions will be a surprise, and 3. When you are called in for an in person interview, you know the Employer is serious about moving you to the nest step in the Hiring process.Think about what it says to a potential employers if you supply this data.  </p>
	         					video_interview_management
							</div> -->
							<?php member_navigation_sidebar_tips_function('video_interview_management'); ?>

							<?php } ?>

						<?php  }else { ?>

						<div class="special_box navi_thumbnail">
								<h5>Complete a section of video interview now</h5>
								<p>EyeRecruit offers you many ways for you to manage your own career. By selecting to <b>Start Now </b>below, you will have access to a comprehensive list of interview questions that are traditinally asked during the first stages of the hiring process within our industry. You will have control on how it is managed through permission based viewing.</p>
								
							</div>

							<div class="special_box navi_thumbnail">
								<h5>Upload your own videos</h5>
								<p>You do not have to use the suggested method to record your unique answers to the interview questions provided. By selecting <b>UPLOAD</b> you will be able to select the file or files that you would like to upload.You can use a 3rd party services or if your would like to record your responses on your smart phone, you have that option as well. Once saved, you will have control of how it is managed through permission based viewing.</p>
								
							</div>
						<!-- <div class="special_box navi_thumbnail special_logo">
							<div class="thumbnail"><img src="<?php  //echo get_stylesheet_directory_uri(); ?>/img/speciallogo.jpg" class="img-responsive"></div>
							<h5>Member Tip</h5>
							<p>Having a Pre-Recorded video Interview posted here <b>IS NOT MANDATORY</b> to use the services offered thought EyeRecruit.com. Providing responses to the most basic pre-employment interview questions will do three things:1. Help to distinguish yourself in a positive way and stand out to a Decision Maker, 2. It gives you the chance to relax and be yourself because none of the questions will be a surprise, and 3. When you are called in for an in person interview, you know the Employer is serious about moving you to the nest step in the Hiring process.Think about what it says to a potential employers if you supply this data.  </p>
         					video_interview_management
						</div> -->
						<?php member_navigation_sidebar_tips_function('video_interview_management'); 

							} 
						?>
					</div>
				</div>
			</section>
		</div><!-- #content -->
		
		<?//php do_action( 'jobify_loop_after' ); ?>
	</div><!-- #primary -->

	<?php endwhile; ?>

<?php get_footer('preferences'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/css/sweetalert.css">
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/sweetalert.js"></script>
<script type="text/javascript">
	jQuery(document).ready( function() {
		jQuery(".avatar").addClass("img-responsive");

		jQuery("#startvideo").on('click',function(){
			jQuery('#videomanagment').modal('show');
		});
		jQuery('.videodelete').on('click', function() {
			var _this= jQuery(this);
			var docId = _this.attr('docId');
			//alert(docId);
			var img = '<?php echo get_stylesheet_directory_uri()."/images/danger_icon.jpg"; ?>';
			swal({
			  imageUrl: img,
			  title: "warning",
			  text: "You are about to permanently DELETE this item.  Once you select continue his can not be undone. If you need this document in the future you will need to locate it and upload it again if you want touse it. May we suggest simply restricting access?",
			  showCancelButton: true,
			  confirmButtonClass: "btn-default btn-sm changetext",
			  confirmButtonText: "Continue Delete",
			  cancelButtonText: "Set to Restrict",
			  cancelButtonClass: "btn-primary btn-sm cancelbutton",
			  closeOnConfirm: false,
			  closeOnCancel: true,
			  customClass: 'daner_sweet',
			  // showLoaderOnConfirm: true
			},
			function(isConfirm) {
			  if (isConfirm) {
			  		jQuery('.changetext').html('Please Wait...');
					jQuery.ajax({
						'type': 'POST',
						'url': '<?php echo admin_url("/admin-ajax.php"); ?>',
						data:{
							'action': 'removeJobseekervideo', //Action in inc/edit_basic_info.php
							'docId': docId,
							'removedoctype': 'videopost',
						},
						success: function(r){
							alert(r);
							if ( r == 'error' ) {
								jQuery('.sweet-alert').removeClass('daner_sweet');
								jQuery('.changetext').html('Continue Delete');
								swal({
									title: "Something Wrong! Please try again.", 
									type: "warning",
									confirmButtonClass: "btn-primary btn-sm",
								});
							}
							else{
								jQuery('.sweet-alert').removeClass('daner_sweet');
								jQuery('.changetext').html('Continue Delete');
								jQuery('#resumeID'+docId).remove();
								jQuery('#noOfRes').html( jQuery('.resumeno').length );
								swal({
									title: "Deleted!", 
									type: "success",
									confirmButtonClass: "btn-primary btn-sm",
								});
							}
						}
					});
				} 
				else {
			  	   jQuery('.sweet-alert').removeClass('daner_sweet');
				   if ( !jQuery('#RestrictAccess'+docId).is(':checked') ) {
			  	   		changeAccess('#RestrictAccess'+docId);
			  	   		jQuery('#RestrictAccess'+docId).prop('checked', true);
			  	   }
				}
			});
		});

	});
</script>
<div class="modal fade" id="videomanagment" tabindex="-1" role="dialog" aria-labelledby="videomanagmentResModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content modal-videomanagment">
		<div class="modal-body vscroll">
			<button type="button" class="close welcome_close_button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<img src="<?php echo site_url();  ?>/assets/uploads/2016/04/EyeRecruit.com-logo_3-2.jpg" class="popup_logo">
			<h3>CHOOSE A SECTION TO COMPLETE NOW</h3>

	        <div class="clearfix"></div>
	        <form id="tell_us_abt_prblm" class="wpcf7-form">
				<p>It’s time to control your first impression.  We have gathered the basic questions that our Employers tell us that they are traditionally asking during the first interview stages and put them into a single location.  Below you can choose to answer questions in sections or return to the previous page where you can answer or change them individually whenever you would like and as your experience and views change over your career.</p>
				<p class="bg-primary">For limited time <strong>all membership levels</strong> have <strong>full access!</strong></p>
				<p><small>Video interviews allow more decision makers, at more companies, to see more applicants.Always on, 24/7.</small></p>
				<div class="text-center">
					<div class="video_begin">
						<p><span>Plus Member Video Interview</span> <a class="btn btn-success btn-sm" target="_blank" href="https://hire.li/70d2294">Begin Now</a></p>
						<p><span>Premium Member Video Interview</span> <a class="btn btn-success btn-sm" target="_blank" href="https://hire.li/a27bddf">Begin Now</a></p>
						<p><span>Ultimate Member Video Interview</span> <a class="btn btn-success btn-sm" target="_blank" href="https://hire.li/a70cf1f">Begin Now</a></p>
					</div>
					<img src="<?php echo site_url();  ?>/assets/themes/eye-recruit-2015/img/upgrades_ending.jpg">
				</div>
			</form>
			<a href="<?php echo site_url(); ?>/seeker-pricing/" class="pull-right"><small>&lt;&lt;&lt; Upgrade Membership &gt;&gt;&gt;</small></a>
			<div class="clearfix"></div>
  	    </div>
    </div>
  </div>
</div>