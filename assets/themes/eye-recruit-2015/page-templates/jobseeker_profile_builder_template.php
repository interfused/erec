<?php
/**
 *Template Name: Seeker profile builder
 *
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

	<?php  
/*
TO EDIT:
add/modify appropriate question in wordpress dashboard under "Seeker Steps"
edit content-profilebuilder.php to allow for question to be populated accordingly
*/
?>
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
				'terms' => 481
				)
			),
		"posts_per_page"=>25
		);
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
			$next_postid = $tmp->ID;
			
			//code for next post id 
			//$tmp = get_next_post();
			$tmp = get_adjacent_post( true, '', false, 'profile-category' );
			$previous_postid = $tmp->ID;
			
			switch($post_id){
				case 7055:
					//$next_postid = 7056;
				break;
				case 7056:
					//$next_postid = 7057;
				break;
				case 7071:
					$next_postid = '';
				break;
			}
			if($i < 2){
				$class = 'active';
			}else{
				$class ='inactive';
			}
			?>
			<div id="profilesteps<?php echo $post_id; ?>" class="profilestep <?php echo $class; ?>">
				<form id="profilebuder<?php echo $post_id; ?>" method="post" action="" enctype="multipart/form-data" >
					<figure class="custom-figure">
						<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/EyeRecruit_Avitar.png" alt="eyerecruit" width="150">
					</figure>
					<div class="profilestep_inner">
						<?php  the_content();?>
						<div class="text-center">
							<?php  echo get_post_meta($post_id,'wpcf-extra-button',true); ?>
							<button type="button" class="continue_step step-btn " id="nextstep" data-pre="<?php echo $previous_postid; ?>" data-next="<?php echo $next_postid; ?>" data-steps="<?php echo get_post_meta($post->ID,'wpcf-steps-url',true); ?>" data-current="<?php echo $post_id; ?>">
								<i class="fa fa-angle-double-left"></i> 
								<?php  echo get_post_meta($post_id,'wpcf-continue-button-label',true); ?> 
								<i class="fa fa-angle-double-right"></i>
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
<?php get_template_part( 'content', 'profilebuilder' ); ?>



<script type="text/javascript">
jQuery(document).ready( function() {

	jQuery('input[name="list_languages_text"]').hide();
	jQuery('.list_lang_checkbox').on('click', function() {

		var _this = jQuery(this);
		var this_id   = _this.attr('id');

		if( _this.is(':checked') ){
			_this.closest('li div.checkbox').append('<div class="rate_now '+this_id+'_rating"><h5>Rate Now</h5><div class="rate_now_stars"><input type="hidden" name="'+this_id+'_rating" value="" ><i class="fa fa-star-o" lang="'+this_id+'_rating" no="1" rtno="'+this_id+'_rating_1" rat="Beginner"></i><i class="fa fa-star-o" lang="'+this_id+'_rating" no="2" rtno="'+this_id+'_rating_2" rat="Intermediate"></i><i class="fa fa-star-o" lang="'+this_id+'_rating" no="3" rtno="'+this_id+'_rating_3" rat="Expert"></i><i class="fa fa-star-o" lang="'+this_id+'_rating" no="4" rtno="'+this_id+'_rating_4" rat="Competent"></i><i class="fa fa-star-o" lang="'+this_id+'_rating" no="5" rtno="'+this_id+'_rating_5" rat="Advanced"></i></div></div>');
			
			if ( _this.val() == 'OTHER' ) {
				jQuery('input[name="list_languages_text"]').show();
			}
		}
		else{
			jQuery('.'+this_id+'_rating').remove();
			if ( _this.val() == 'OTHER' ) {
				jQuery('input[name="list_languages_text"]').hide().val('');
				jQuery('#list_languages_text-error').remove();
			}
		}
	});

jQuery('.rate_now_stars i').live('click', function() {
	var rate = jQuery(this).attr('rat');
	var lang = jQuery(this).attr('lang');
	var no = jQuery(this).attr('no');
	jQuery('input[name="'+lang+'"]').val(rate);


	for (var i = 1; i <= no; i++) {
		jQuery('i[rtno="'+lang+'_'+i+'"]').css('color', '#a12641');
		jQuery('i[rtno="'+lang+'_'+i+'"]').addClass('fa-star');
		jQuery('i[rtno="'+lang+'_'+i+'"]').removeClass('fa-star-o');
	}

	if ( no < 5 ) {
		for (var i = parseInt(no)+1; i <= 5; i++) {
			jQuery('i[rtno="'+lang+'_'+i+'"]').removeAttr('style');
			jQuery('i[rtno="'+lang+'_'+i+'"]').addClass('fa-star-o');
			jQuery('i[rtno="'+lang+'_'+i+'"]').removeClass('fa-star');
		}
	}

});
});
</script>

<?php wp_footer(); ?>