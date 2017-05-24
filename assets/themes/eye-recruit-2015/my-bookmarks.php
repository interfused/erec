<div class="search_bar">
	<!-- <div class="pull-right">
		<div class="form-group has-feedback">
		    <select class="form-control">
			  <option>All Jobs</option>
			</select>
			<span class="fa fa-angle-down form-control-feedback" aria-hidden="true"></span>
		</div>
	</div> -->
	<p>These are the <span id="countMyBookmarks" count="0">0</span> Jobs saved by you</p>
	<div class="clearfix"></div>
</div>

<div class="savedjobs_list bookmarks_list indent">
	<div class="row">
		<?php
		$count = 0;
		foreach ( $bookmarks as $bookmark ) :
			if ( get_post_status( $bookmark->post_id ) !== 'publish' ) {
				continue;
			}
			$count++;
			$has_bookmark = true;
			$location = get_post_meta($bookmark->post_id, '_job_location', true);
			$date_created = $bookmark->date_created;
			// $jobtitle = get_the_title( $bookmark->post_id );
			$getpost = get_post($bookmark->post_id);
			$jobtitle = $getpost->post_title;
			$title_job = count_char_length($jobtitle, 27);

			global $wpdb;
			$cityId = get_post_meta($bookmark->post_id, '_job_city', true);
			$regionId = get_post_meta($bookmark->post_id, '_job_state', true);

			//$job_deadline 	= get_post_meta($bookmark->post_id, '_job_deadline', true);


			$job_deadline = get_post_meta($bookmark->post_id, '_application_deadline', true);
		

			$nowDate = date('Y-m-d');

			$cityTable = $wpdb->prefix.'cities';
			$stateTable = $wpdb->prefix.'region';
			
			$city = $wpdb->get_row("SELECT * FROM $cityTable WHERE cityId = '".$cityId."' ");
			$state = $wpdb->get_row("SELECT * FROM $stateTable WHERE regionId = '".$regionId."' ");
			?>
			<div class="col-sm-6 myBookmark<?php echo $bookmark->id; ?>">
				<article>
					<span class="saved_referid"><strong>Reference: </strong><?php echo $bookmark->post_id; ?> </span>
					<h4> 
						<a href="<?php echo get_permalink( $bookmark->post_id ); ?>" > <?php echo $title_job; ?> </a>
						<span>
							<strong>Location :</strong> 
							<?php 
								echo (($city->name)) ? $city->name : '--'; 
								echo (!empty($state->name) && !empty($city->name)) ? ', '.$state->name : $city->name; 
							?>
						</span>
					</h4>
					<div class="savearticle_content">
						<div class="savearticle_img">
							<?php
							$logo = get_the_company_logo( $bookmark->post_id );
							if ( !empty($logo) ) { ?>
								<img src="<?php echo $logo; ?>" class="img-responsive">
							<?php } else{ ?>
								<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/eyerecruit_circle.png" class="img-responsive">
							<?php } ?>
							<ul>
								<li>
									<span>Headquarters : </span> 
									<?php  
									$post_author = get_post_field( 'post_author', $bookmark->post_id);
									$EMP_OFFICES_IN_STATE = get_cimyFieldValue($post_author,'EMP_OFFICES_IN_STATE'); 
									if ( !empty( $EMP_OFFICES_IN_STATE ) ) {
										$EMP_OFFICES_IN_STATEArr = explode(',', $EMP_OFFICES_IN_STATE);
										if ( isset($EMP_OFFICES_IN_STATEArr[0]) ) {
											echo $EMP_OFFICES_IN_STATEArr[0]; 
										}
									}
									else{
										echo "--";
									}
									?>
								</li>
							</ul>
							<?php if ( class_exists( 'Astoundify_Job_Manager_Companies' ) && '' != get_the_company_name($bookmark->post_id) ) :
								$companies   = Astoundify_Job_Manager_Companies::instance();
								$company_url = esc_url( $companies->company_url( get_the_company_name($bookmark->post_id) ) );
								?>
							<?php else : ?>
								<?php $company_url = 'javascript:void(0);' ?>
							<?php endif; ?>
							<a href="<?php echo $company_url; ?>" class="btn btn-success btn-sm" target="_blank">See All<br> Openings</a>
						</div>
						<div class="savearticle_text">
							<ul>
								<!-- <li>
									<span>Job Location : </span><?php 
									//echo (($city->name)) ? $city->name : '--'; 
									//echo (!empty($state->name) && !empty($city->name)) ? ', '.$state->name : $city->name; 
									?>
								</li> -->
								<li><span>Job Type : </span> <?php the_job_type($bookmark->post_id); ?></li>
							</ul>
							<?php 
							if ( $nowDate > $job_deadline ) {
								echo '<span class="label label-primary">Inactive</span>';
							}
							else{
								echo '<span class="label label-success">Active</span>';
							} 

							$er_JobMeta = get_post_meta( $bookmark->post_id );
							$tmp = $er_JobMeta['_job_pay_hourly'][0];
							$tmp2 = $er_JobMeta['_job_pay_yearly'][0];

							?>

							<ul>
								<li>
									<span>Compensation: </span>
									<?php
									if ( $tmp != 'n/a' ) {
										echo "Hourly";
									}
									else if ( $tmp2 != 'n/a' ) {
										echo "Salary";
									}
									else{
										echo "--";
									}

									?>
								</li>
								<li>
									<span>Pay Range : </span>
									<?php
									if($tmp != 'n/a'){
										echo str_replace('k', '', $tmp). '/hour';
									}
									if($tmp != 'n/a' && $tmp2 != 'n/a'){
										echo ' / ';
									}
									
									if($tmp2 != 'n/a'){
										echo str_replace('k', '', $tmp2). '/year';
									}
									
									if($tmp == 'n/a' && $tmp2 == 'n/a'){
										echo 'DOE';
									}

									?>
								</li>
							</ul>
							
							<p><strong>*NOTE : </strong>See Job Posting for Minimum Qualifications, Positional Requirements & Disclaimers</p>
							<p class="date_saved">
								<span>Saved on : </span>
								<?php //echo date('F dS Y', strtotime( $date_created) ); ?>
								<?php echo date('m/d/Y', strtotime( $date_created) ); ?>
							</p>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="article_footer">
						<div class="checkbox"><label><input class="delete_anchor remove<?php echo $bookmark->id; ?>" buttonid="<?php echo $bookmark->id; ?>" type="checkbox"> <span>Remove</span> </label></div>
						<a href="<?php  echo get_permalink( $bookmark->post_id ); ?>">View This Posting</a> 
						<div class="clearfix"></div>
					</div>
				</article>
			</div>
		<?php endforeach; ?>
		<?php if ( empty( $has_bookmark ) ) : ?>
			<div class="col-sm-12">
				<div class="savejobnotfound"><?php _e( 'You currently have no saved job', 'wp-job-manager-bookmarks' ); ?>
			</div>
		<?php endif; ?>
		<?php get_job_manager_template( 'pagination.php', array( 'max_num_pages' => $max_num_pages ) ); ?>
	</div>
</div>
<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/css/sweetalert.css">
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/sweetalert.js"></script>
<script type="text/javascript">
	jQuery(document).ready( function() {
		jQuery('.job-manager-applications-applied-notice').remove();
		var count = '<?php echo $count; ?>';
		jQuery('#countMyBookmarks').html(count);
		jQuery('#countMyBookmarks').attr('count', count);

		jQuery('.delete_anchor').on('click', function() {
			var _this = jQuery(this);
			var id = _this.attr('buttonid');

			var img = '<?php echo get_stylesheet_directory_uri()."/images/danger_icon.jpg"; ?>';
			swal({
			  imageUrl: img,
			  title: "warning",
			  text: "You are about to DELETE this saved job. Once you select continue his can not be undone. May we suggest simply restricting access?",
			  showCancelButton: true,
			  confirmButtonClass: "btn-default btn-sm changetext",
			  confirmButtonText: "Continue Delete",
			  cancelButtonText: "Cancel",
			  cancelButtonClass: "btn-primary btn-sm cancelbutton",
			  closeOnConfirm: false,
			  closeOnCancel: false,
			  customClass: 'daner_sweet',
			},
			function(isConfirm) {
			  if (isConfirm) {
			  	jQuery('.changetext').html('Please Wait...');
			    jQuery.ajax({
					type: 'POST',
					url: '<?php echo admin_url("admin-ajax.php");  ?>',
					dataType: 'json',
					data: {
						action: 'removeMyBookmrks', //Action in inc/edit_basic_info
						id: id
					},
					success: function(res){
						if ( res.status == 'success' ) {
							jQuery('.sweet-alert').removeClass('daner_sweet');
							jQuery('.changetext').html('Continue Delete');
							jQuery('.myBookmark'+id).remove();
							var totalJob = parseInt( jQuery('#countMyBookmarks').attr('count') ) - 1;
							jQuery('#countMyBookmarks').attr('count', totalJob);
							jQuery('#countMyBookmarks').html(totalJob);
							swal({
								title: "Deleted!", 
								type: "success",
								confirmButtonClass: "btn-primary btn-sm",
							});
						}
						else{
							jQuery('.sweet-alert').removeClass('daner_sweet');
							jQuery('.changetext').html('Continue Delete');
							swal({
								title: "Something Wrong!", 
								type: "warning",
								confirmButtonClass: "btn-primary btn-sm",
							});
						}
					}
				});
			  } else {
			    swal({
			   		title:	"Cancelled",
			   		type: "error",
				   	confirmButtonClass: "btn-primary btn-sm",
			   	});
			    jQuery('.remove'+id).prop('checked', false);
			  }
			});
		});
	});
</script>