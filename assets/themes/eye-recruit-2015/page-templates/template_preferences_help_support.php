<?php
/**
 * Template Name: Preferences help-support page
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Jobify
 * @since Jobify 1.0
 */

get_header(); ?>

<link rel='stylesheet' id='custom-dashboard-css'  href='<?php echo site_url();  ?>/assets/themes/eye-recruit-2015/dashboard.css?ver=4.5.3' type='text/css' media='all' />

	<?php while ( have_posts() ) : the_post(); ?>

	<header class="page-header">
		<h1 class="page-title"><?php the_title(); ?></h1>
	</header>

	<?php
	if ( is_user_logged_in() ) {
		$userid = get_current_user_id();
	}
	else{
		$userid = '';
	}
	function random_strq($length, $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')
	{
	    $str = '';
	    $max = mb_strlen($keyspace, '8bit') - 1;
	    for ($i = 0; $i < $length; ++$i) {
	        $str .= $keyspace[random_int(0, $max)];
	    }
	    return $str;
	}
	?>
	<section class="preferences">
		<div class="container">
			<div class="row">
				<div class="col-md-3">
					<?php get_template_part( 'seeker_dasboard_templates/content', 'preferences_sidemenu' ); ?>
				</div>
				<div class="col-md-9 sidemenu_border">
					<div class="section_title">
						<h3>Customer Help center</h3>
						<span><strong>Recruit ID</strong> : <?php echo $userid; ?></span>
					</div>
					<div class="indent help_center help_today">
						<?php 
						$pageID = get_the_ID(); 
						$hcwht = get_post_meta($pageID, 'how_can_we_help_you_today_content', true); 
						$kbase = get_post_meta($pageID, 'knowledge_base', true); 
						$sattic = get_post_meta($pageID, 'submit_a_trouble_ticket', true); 
						$jaw = get_post_meta($pageID, 'join_a_webinar', true); 
						$callus = get_post_meta($pageID, 'call_us', true); 
						$lchat = get_post_meta($pageID, 'live_chat', true); 
						$sac1 = get_post_meta($pageID, 'schedule_a_1', true); 
						?>

						<div class="sidebar_title cont_title">
							<h4>How can we help you today?</h4>
						</div>
						<?php echo (($hcwht))? $hcwht : 'Data not found'; ?>
						<div class="indent row">
							<div class="col-sm-4">
								<div class="well">
									<h5>Knowledge Base</h5>
									<p><?php echo (($kbase))? $kbase : 'Data not found'; ?></p>
									<a href="javascript:void();" class="btn btn-primary btn-sm btn-block">Let’s Get Learning</a>
								</div>
							</div>

							<div class="col-sm-4">
								<div class="well">
									<h5>Submit a Trouble Ticket</h5>
									<p><?php echo (($sattic))? $sattic : 'Data not found'; ?></p>
									<a href="javascript:void();" data-target="#aboutproblem" data-toggle="modal" id="submitbPobe" ticketID="<?php echo random_strq(8); ?>" class="btn btn-primary btn-sm btn-block">Submit Ticket</a>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="well">
									<h5>Join a Webinar</h5>
									<p><?php echo (($jaw))? $jaw : 'Data not found'; ?></p>
									<a href="javascript:void();" class="btn btn-primary btn-sm btn-block">Save My Seat</a>
								</div>
							</div>
						</div>
					</div>
					<div class="indent help_center">
						<div class="sidebar_title cont_title">
							<h4>Advanced Support</h4>
						</div>
						<div class="indent row">
							<div class="col-sm-4">
								<div class="well">
									<h5>Call Us</h5>
									<span class="label label-success">Premium Accounts</span>
									<p><?php echo (($callus))? $callus : 'Data not found'; ?></p>
									<a href="javascript:void();" class="btn btn-primary btn-sm btn-block">Show Number</a>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="well">
									<h5>Live Chat</h5>
									<span class="label label-success">Premium Accounts</span>
									<p><?php echo (($lchat))? $lchat : 'Data not found'; ?></p>
									<a href="javascript:void();" class="btn btn-primary btn-sm btn-block">Chat Now</a>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="well">
									<h5>Schedule a 1-on-1</h5>
									<span class="label label-success">Ultimate Accounts</span>
									<p><?php echo (($sac1))? $sac1 : 'Data not found'; ?></p>
									<a href="javascript:void();" class="btn btn-primary btn-sm btn-block">Schedule</a>
								</div>
							</div>
						</div>
					</div>
					<div class="indent help_center">
						<div class="help_faq indent">
							<div class="sidebar_title cont_title">
								<h4>Frequently Asked Questions</h4>
							</div>
							<div class="row">
								<?php  
								$count=0;
								$args = array(
									'post_type'   => array( 'faq' ),
									'post_status'  => array( 'publish' ),
									'order'         => 'ASC',
								);
								$query = new WP_Query( $args );
								if ( $query->have_posts() ) { 
									$counpost = ceil($query->post_count / 2);
									echo '<div class="col-sm-6">';
										while($query->have_posts()){ $query->the_post();
				                            if($count % $counpost == 0 && $count != 0){
				                            	echo "</div><div class='col-sm-6'>";
				                            } ?>
											<h5><?php echo get_the_title(); ?></h5>
											<p><?php echo get_the_content(); ?> </p>
											<?php  
											$count++;   
										}
									echo '</div>';
								} ?>
								<!-- <div class="col-sm-6">
									<h5>Can I save money with an annual plan ?</h5>
									<p>Yes, you can. Annual plans like this are provided at significantly discounted rates as it reduces the companies costs to change, invoice & collect monthly, among other things. By billing annually we are able to focus on our core work, introducing the very best candidates with the areas top employers.</p>
									<h5>What is your Refund Policy ?</h5>
									<p>If you believe a refund is warranted, we would like to hear from you. Our Customer Care team has been directed by the owner of EyeRecruit, Inc.personally, to review each request on a case-by-case basis. We always strive for a fair and reasonable resolution. </p>
									<h5>What are your Terms of Use & Privacy policees ?</h5>
									<p>Here are our <a href="<?php echo site_url();  ?>/terms-and-conditions/">Terms and condition</a>, <a href="#">Cookies policies</a> and our <a href="<?php echo site_url();  ?>/privacy-policy">Privacy Policy</a>. If you have the time, please also review our <a href="#">Values</a>, our <a href="#">Ethics</a> and our organization’s <a href="#">Mission</a> as well.</p>
								</div> -->
							</div>
						
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!--<div id="primary" class="content-area">
		<div id="content" class="container" role="main">
				
		</div> --><!-- #content -->
		<!--
		<?//php do_action( 'jobify_loop_after' ); ?>
	</div> --><!-- #primary -->

	<?php endwhile; ?>
<?php get_footer('preferences'); ?>


<div class="modal fade" id="aboutproblem" tabindex="-1" role="dialog" aria-labelledby="aboutproblemLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content default-form">
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <img src="<?php echo site_url();  ?>/assets/uploads/2016/04/EyeRecruit.com-logo_3-2.jpg" class="popup_logo">
        <h3>Create a Trouble Ticket</h3>
        <div class="clearfix"></div>
      	<?php   echo do_shortcode('[contact-form-7 id="4563" title="Tell us about a Problem" html_id="tell_us_abt_prblm" html_class="form-horizontal"]'); ?>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
	jQuery(document).ready(function() {

		jQuery('select[name="select_problem_type"]').on('change', function(){
			var thisVal = jQuery(this).val();
			if ( thisVal == 'Other' ) {
				jQuery('.otheproblem').show();
				jQuery('input[name="other_problem"]').show().val('');
			}
			else{
				jQuery('.otheproblem').hide();
				jQuery('input[name="other_problem"]').hide().val('');
			}

			jQuery('input[name="problem_type"]').val(thisVal);
		});

		jQuery('input[name="other_problem"]').on('keyup', function() {
			var thisVal = jQuery(this).val();
			jQuery('input[name="problem_type"]').val(thisVal);
		});


		setTimeout( function() {
			var ticid = jQuery('#submitbPobe').attr('ticketID');
			jQuery('#ticketnoid').val(ticid);
		},500);
	});
</script>