	<?php  
		$current_user = wp_get_current_user();
	    $roles = $current_user->roles;
	    $role = array_shift( $roles );
	 ?>
<div class="sidebar right_sidebar">

	<div class="light_box recruiter_box welcome_box">
		
			<?php
			$pageID = get_the_ID();
			if ( is_user_logged_in() ) {

				?>
			<div class="sidebar_title">
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/welcome_eyerecruit.png" alt="advertise" class="img-responsive">	
				<?php
				global $current_user;
				echo '<h4>Welcome <br>'.$current_user->first_name.' '.$current_user->last_name.'! </h4></div>';
			}
			else{ ?>
		<div class="sidebar_title">
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/welcome_eyerecruit.png" alt="advertise" class="img-responsive">	
			<h4>Welcome Guest!</h4>
		</div>
		<div class="form-group">
			<p>Take your time, look around. We hope that you will join us and become a member.</p>
			<a href="<?php echo site_url('/job-seekers/get-started/'); ?>" class="btn btn-primary">Sign Up</a>
			<a href="<?php echo site_url('/login/'); ?>" class="btn btn-primary">Sign In</a>
		</div>
		<?php } 
		if ( (is_user_logged_in()) &&  ($role == 'candidate') ) { ?>
		<p class="main_cont">It's time to take control of your future! Save jobs and companies that interest you <a href="#">here</a> and it automatically saves on your dashboard! <strong>It's to get to work!</strong></p>
		<p><a href="<?php echo site_url('/job-seekers/dashboard/'); ?>" class="btn btn-primary">Home</a></p><?php } ?>
	</div>
	<?php
	if ( (is_user_logged_in()) &&  ($role == 'candidate') ) {
		if(is_active_sidebar('ad_find_a_job_top')){
			dynamic_sidebar('ad_find_a_job_top');
		}
	}
	else{ ?>
		<div class="feature_ad" id="paidJobPosting">
			<?php if(is_active_sidebar('post_job')){
				dynamic_sidebar('post_job');
			}
		 	?>
		</div>
		<?php 
	}
	if ( is_user_logged_in() ) {
		if( $role == 'candidate' ){ ?>
			<script type="text/javascript">
				jQuery(document).ready( function() {
					jQuery('#paidJobPosting .paidjob_post').attr('href', 'javascript:void(0);');
					jQuery('#paidJobPosting').on('click', '.paidjob_post', function() {
						jQuery('#paidJobPost').modal('show');
					});
				});
			</script>  <?php
		}
	} else { ?>
		<script type="text/javascript">
			jQuery(document).ready( function() {
				jQuery('#paidJobPosting .paidjob_post').attr('href', 'javascript:void(0);');
				jQuery('#paidJobPosting').on('click', '.paidjob_post', function() {
					jQuery('#paidJobPost').modal('show');
				});
			});
		</script> <?php 
	} 
	?>
	<?php  
	if(is_user_logged_in() &&  ($role == 'candidate')){
		?>
		<div class="light_box quick_links include_list">
			<div class="sidebar_title">
				<h4>OUR EMPLOYERS INCLUDE</h4>
			</div>
			<ul>
				<li><a href="javascript:void(0);">Private Detective Agencies</a></li>
				<li><a href="javascript:void(0);">Investigations Firms</a></li>
				<li><a href="javascript:void(0);">Surveillance Companies</a></li>
				<li><a href="javascript:void(0);">Security Agencies </a></li>
				<li><a href="javascript:void(0);">Guard Companies</a></li>
				<li><a href="javascript:void(0);">Executive Protection Providers </a></li>
				<li><a href="javascript:void(0);">Risk Management Firms</a></li>
				<li><a href="javascript:void(0);">High Tech Companies</a></li>
				<li><a href="javascript:void(0);">Military Contractors</a></li>
				<li><a href="javascript:void(0);">Private Companies</a></li>
			</ul>
		</div>
		<?php
	}
	?>
	

	<?php  if ( (is_user_logged_in()) &&  ($role == 'employer') ) {  ?>
		<div class="light_box quick_links include_list">
			<div class="sidebar_title">
				<h4>OUR CANDIDATIES INCLUDE</h4>
			</div>
			<ul>
				<li><a href="javascript:void(0);">Detectives & Investigators</a></li>
				<li><a href="javascript:void(0);">Security & Loss Prevention Personnel </a></li>
				<li><a href="javascript:void(0);">Licensed Private Detectives</a></li>
				<li><a href="javascript:void(0);">Field Agents & Operatives (Covert & Overt)</a></li>
				<li><a href="javascript:void(0);">Experienced Managers & Executives</a></li>
				<li><a href="javascript:void(0);">Former Intelligence Officers</a></li>
				<li><a href="javascript:void(0);">Former Military & Combat Veterans</a></li>
				<li><a href="javascript:void(0);">Former State & Federal Law Enforcement</a></li>
				<li><a href="javascript:void(0);">Special Investigative Unit (SIU) </a></li>
				<li><a href="javascript:void(0);">Tactical & Operational Specialists</a></li>
				<li><a href="javascript:void(0);">Seasoned Supervisory Staff </a></li>
				<li><a href="javascript:void(0);">Industry Experienced Sales Specialists</a></li>
				<li><a href="javascript:void(0);">Industry Experienced  Service Specialists</a></li>
				<li><a href="javascript:void(0);">Industry Experienced Office Specialists</a></li>
				<li><a href="javascript:void(0);">Investigative Journalists </a></li>
				<li><a href="javascript:void(0);">Recent College Graduates</a></li>
				<li><a href="javascript:void(0);">College Interns</a></li>
			</ul>
		</div>
	
	<?php   } ?>
	
	

	<div class="light_box tips">
		<?php
			if(is_active_sidebar('employers_use_us')){
				dynamic_sidebar('employers_use_us');
			}
		 ?>
	</div>
	


	<div class="light_box our_blogs">
		<div class="sidebar_title">
			<h4>From Our Blog</h4>
		</div>
		<div id="blog_carousal" class="carousel slide" data-ride="carousel">
			<?php
			$args = array('post_type'=>'post','orderby' => 'ASC','posts_per_page'=>3);
	  		$the_query = new wp_query($args);
	  		$totalpost = $the_query->post_count;
	  		$ct = 0;
			?>
			<!-- Indicators -->
			<ol class="carousel-indicators">
				<?php for ($i=1; $i <= $totalpost; $i++) { ?> 
					<li data-target="#blog_carousal" data-slide-to="<?php echo $ct; ?>" <?php if($ct == 0){ echo 'class="active"'; } ?> ></li>
					<?php $ct++; ?>
				<?php } ?>
			</ol>

		  <!-- Wrapper for slides -->
		  <div class="carousel-inner" role="listbox">
		  	<?php
		  		$a=0;
		  		if($the_query->have_posts()){
		  			while ($the_query->have_posts()) {
		  				$the_query->the_post();
		  			
		  					?>
								<div class="item <?php if($a==0){ echo "active"; } ?>">
									<?php the_post_thumbnail(); ?>
									<div class="carousel-caption">
										<a href="<?php echo  the_permalink(); ?>"><h4><?php the_title(); ?></h4></a>
										<p><?php get_the_content(); ?></p>
									</div>
								</div>
		  					<?php
		  				$a++;
		  			}
		  		}
		  	?>
		   
		  </div>

		  <!-- Controls -->
		  <a class="left carousel-control" href="#blog_carousal" role="button" data-slide="prev">
		    <span class="fa fa-angle-left" aria-hidden="true"></span>
		    <span class="sr-only">Previous</span>
		  </a>
		  <a class="right carousel-control" href="#blog_carousal" role="button" data-slide="next">
		    <span class="fa fa-angle-right" aria-hidden="true"></span>
		    <span class="sr-only">Next</span>
		  </a>
		</div>
	</div>
	<?php
	if(is_active_sidebar('ad_find_a_job_bottom')){
		dynamic_sidebar('ad_find_a_job_bottom');
	}
	?>
	<?php 
	/*$add = get_post_meta($pageID, 'right_side_add', true);
	echo do_shortcode($add);*/
	?>
	<?php

		/*if(is_active_sidebar('adds')){
			dynamic_sidebar('adds');
		}*/
	 ?>
	<!-- <img src="<?php //echo get_stylesheet_directory_uri(); ?>/img/ad1.jpg" alt="advertise" class="img-responsive"> -->


<div class="list-view">

<div class="list-view-img"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/list-img.jpg"></div>

<div class="list-view-txt">
<h3 class="ambassador">Be an Ambassador</h3>

<p>Do you want to be the Tip of the Spear
that helps one of the greatest technical
achievements of our Industry?
</p>

<p><a href="mailto:Social@EyeRecruit.com?subject=I am interested in becoming an Ambassador" class="learn-more-btn">Learn More</a></p>


</div>

</div>




</div>


<div class="modal fade" id="paidJobPost" tabindex="-1" role="dialog" aria-labelledby="paidJobPostLabel" style="display: none;">
  <div class="vertical-alignment-helper">
  		<div class="modal-dialog vertical-align-center" role="document">
		    <div class="modal-content default-form">
		      <div class="modal-body">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
			        <img src="<?php echo site_url(); ?>/assets/uploads/2016/04/EyeRecruit.com-logo_3-2.jpg" class="popup_logo">
		            <h3>Post a Job</h3>
			        <div class="clearfix"></div>
			        <?php
					if ( is_user_logged_in() ) {
			        	echo '<h3>Please create an account as a employer to post a job.</h3>';
					}
					else{ ?>
						<div class="form-group text-center">
  							<h4>Already have an employer acccount?</h2>
							<a href="<?php echo site_url('/login/'); ?>" class="btn btn-primary">Login Here</a>
  							<h4>Or</h4>
							<a href="<?php echo site_url('/employers/get-started/'); ?>" class="btn btn-default">Get Started Now</a>
						</div>
					<?php } ?>
				</div>
		    </div>
	  </div>
  </div>
</div>