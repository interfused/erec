<?php
/**
 * Template Name: Seeker - Add Recommendation
 *
 * 
 *
 * @package Jobify
 * @since Jobify 1.5
 */

//handle form posts

$postSuccess=false;
global $wpdb;
$tableName = $wpdb->prefix.'reach_out_and_ask_for_referral';

if($_POST['user_message'] && isset( $_POST['post_nonce_field'] ) && wp_verify_nonce( $_POST['post_nonce_field'], 'post_nonce' )){
	
	$user_message = stripslashes_deep($_POST['user_message']);
	$sql = 'SELECT * FROM '.$tableName.' WHERE id = "'.$_POST['id'].'"';
	$wpdb->get_row($sql);

	$wpdb->update(
		$tableName,
		array('response_time' => $_POST['time'],
			'user_message' => $user_message
			),
		array('id' => $_POST['id']),
		array('%s','%s'),
		array('%d')
		);
	$postSuccess=true;
}

get_header(); ?>

<style>
textarea#user_message{height:10em;}
</style>
<?php
///two ids.  userID vs refererID
$recommendationID = $_REQUEST['rID'] ? $_REQUEST['rID'] : 0;
if($recommendationID == 0){
	//get requested user id which should be passed by urlParam
	//redirect if no userID exists
}else{
	
	
	//$sql = 'SELECT * FROM '.$tableName.' WHERE id = "'.$recommendationID.'"';
	$sql = 'SELECT * FROM '.$tableName.' WHERE id = "'.$recommendationID.'" AND user_message IS NULL';
				
	$resultrow = $wpdb->get_row($sql);
	//pull seeker's id from rec
}

?>

<header class="page-header">
	<h1 class="page-title"><?php the_title(); ?></h1>
</header>

<div id="primary" class="content-area">
	<div id="content" class="container" role="main">
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="entry-content<?php echo has_shortcode( $post->post_content, 'jobs' ) ? ' has-jobs' : null; ?>">
				<?php // the_content(); ?>

				
				<?php
				if(!$resultrow && $_REQUEST['rID']){
						//no results exist
					?>
					<div>This recommendation does not exist</div>
					<?php
				}
				?>

				<?php
				if(count($resultrow) >= 1){
					//show details of recommendation data
					?>

					<div id="" class="paddedTop-2x">
						<div class="row">
							<div id="seekerInfo" class="col-md-6">
								<?php
							//seeker's info / seeker card
								$user_info = get_userdata($resultrow->user_id);

								?>
								<?php echo get_wp_user_avatar($user_info->id);?>
								<h3><?php echo ($user_info->first_name .' '.$user_info->last_name ); ?></h3>
								<p>recruitID: <?php echo $user_info->id ?></p>
							</div>
							<?php if($postSuccess==false) {
								?>

								<div id="formContainer" class="col-md-6">
									<form id="addSeekerRecommendation" name="id="addSeekerRecommendation"" method="POST">
										<input type="hidden" name="ref_fname" id="ref_fname" value="<?php echo $resultrow->first_name;?>" />
										<input type="hidden" name="time" value="<?php echo time();?>">
										<input type="hidden" name="id" id="id" value="<?php echo $resultrow->id;?>" />
										<div class="form-group">
											<label for="user_message"><p>Hello <?php echo ucfirst($resultrow->first_name ); ?>,</p>
												<p>Thank you for responding to my request for a letter of recommendation. If you could, please describe below.</p>
											</label>
											<textarea id="user_message" name="user_message" required></textarea>
										</div>
										<div class="form-group">
											<?php  wp_nonce_field( 'post_nonce', 'post_nonce_field' ); ?>
											<button type="submit" class="btn btn-primary">Submit Recommendation</button>
										</div>
									</form>
								</div>

								<?php
							}else{
								?>

								<div id="thanksMsg" class="col-md-6">
									<h3>Thanks <?php echo ucfirst($_POST['ref_fname']);?>,</h3>I appreciate your submission.
								</div>
								
								<?php
							}?>

						</div>
					</div>
					<?php
				}
				?>
			</div>
		</article><!-- #post -->

		<?php // comments_template(); ?>
	</div><!-- #content -->

	<?php do_action( 'jobify_loop_after' ); ?>
</div><!-- #primary -->


<?php get_footer(); ?>