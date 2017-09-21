<?php
/**
 *  *Template Name: Employer profile builder
 * @package Jobify
 * @since Jobify 1.0
 */

/*...........Redirect to home if user does not exist................*/
$user_id = multi_base64_decode($_REQUEST['rec']);
$user = get_userdata( $user_id );
if ( $user === false ) {
	echo wp_redirect( site_url() );
}


/*...........Redirect to home if user user status is Approved................*/

$user_status = get_user_meta($user_id, 'pw_user_status', true);

if ( $user_status == 'approved') {

		//echo wp_redirect( site_url() );
}


get_header('loginpage'); ?>
<?php //while ( have_posts() ) : the_post(); ?>
	<div class="container">
		<?php 		

		$args = array(
			"post_type"=>'profile-builder-step',
			"post_status"=>'publish',
			'orderby' => 'menu_order',
			'order' => 'ASC',
			'tax_query' => array(
				array( 
					'taxonomy' => 'profile-category',
					'field' => 'id',
					'terms' => 482
					)
				),
			"posts_per_page"=>25);
		$the_queries = new Wp_query($args);
		?>
		<?php 
		if($the_queries->have_posts()){
			$i = 1;
			while($the_queries->have_posts()){
				$the_queries->the_post();
				$post_id = get_the_ID();

			//code for previous
			//$tmp = get_previous_post();
			$tmp = get_adjacent_post( true, '', true, 'profile-category' );
			$previous_postid = $tmp->ID;
			
			//code for next post id 
			//$tmp = get_next_post();
			$tmp = get_adjacent_post( true, '', false, 'profile-category' );
			$next_postid = $tmp->ID;
			
				if($i < 2){
					$class = 'active';
				}else{
					$class ='inactive';
				}
				?>
				<div id="profilesteps<?php echo $post_id; ?>" class="profilestep <?php echo $class; ?>">
					<form id="profilebuder<?php echo $post_id; ?>" method="post" action="" enctype="multipart/form-data" >
						<figure>
							<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/EyeRecruit_Avitar.png" alt="eyerecruit" width="150">
						</figure>
						<div class="profilestep_inner">
							<?php echo  get_the_content();?>
							<div class="text-center">
								<?php  echo get_post_meta($post_id,'wpcf-extra-button',true); ?>
								<button type="button" class="continue_step step-btn " id="nextstep" data-next="<?php echo $next_postid; ?>"  data-current="<?php echo $post_id; ?>">
									<i class="fa fa-angle-double-left"></i> <?php  echo get_post_meta($post_id,'wpcf-continue-button-label',true); ?> <i class="fa fa-angle-double-right"></i>
								</button>
							</div>
						</div>
					</form>
				</div>
				<?php
				$i++;
			}	

		}
		?>

		<figure class="eyerecruit_img">
			<img src="<?php echo site_url();  ?>/assets/uploads/2016/08/eye-recruit-wo-tag.png" alt="eyerecruit">
		</figure>
		<?php //do_action( 'jobify_loop_after' ); ?>
	</div><!-- #primary -->
	<?php //endwhile; ?>
	<?php get_template_part( 'content', 'employer_profilebilder' ); ?>

	<?php //wp_footer(); ?>