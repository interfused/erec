<?php
/**
 * Template Name: Invited Friends N Colleagues Listing
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Jobify
 * @since Jobify 1.0
 */
get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

	<header class="page-header">
		<h1 class="page-title"><?php the_title(); ?></h1>
	</header>

<?php endwhile; ?>

<section class="preferences" id="inv_frn_n_coll">
	<div class="container">
		<div class="row">
			<?php
			$current_user_id = get_current_user_id(); 
			$referenced_name = get_user_meta($current_user_id , 'rfname', true);
			$exploded_referenced_name = explode(',', $referenced_name);
			$referenced_email = get_user_meta($current_user_id , 'rfemail', true);
			$exploded_referenced_email = explode(',', $referenced_email); 
			if( !empty($referenced_name) && !empty($referenced_email) ) { ?>
				<div class="col-md-3">
					<div><h2>Username</h2></div>
					<?php
						foreach($exploded_referenced_name as $ref_name_key => $ref_name) {?>
							<div class="freID<?php echo $ref_name_key; ?>" ><?php echo $ref_name; ?></div><?php 
						}
					?>
				</div>	
				<div class="col-md-3">
					<div><h2>Email</h2></div>
					<?php 
						foreach ($exploded_referenced_email as $ref_email_key => $ref_email) { ?>
							<div class="freID<?php echo $ref_email_key; ?>" ><?php echo $ref_email; ?></div><?php
						}
					?>		
				</div>
				<div class="col-md-3">
					<div><h2>Existing User</h2></div>
					<?php 
						
						foreach ($exploded_referenced_email as $key => $ref_email) { ?>
							<div class="freID<?php echo $key; ?>" >
								<?php 
									if(email_exists($ref_email)){
										echo "Already Joined";
									}else{
										echo "Not Joined";
									}
								?>	
							</div><?php 
						}
					?>
				</div>
				<div class="col-md-3">
					<div><h2>Action</h2></div>
					<?php 
						foreach($exploded_referenced_name as $key => $value) {?>
							<div class="delete_container freID<?php echo $key; ?>" ><a class="delete_anchor" href="#" buttonid="<?php echo $key; ?>">Delete</a></div>
							<?php 
						}
					 ?>	
				</div>
			<?php } ?>		
		</div>
		<div style="text-align:center"><span id="del_msg"></span></div>
	</div>
</section>

<script type="text/javascript">
	jQuery(document).ready(function(){
		jQuery("#inv_frn_n_coll").on('click', '.delete_anchor', function(){
			friend_n_coll_id = jQuery(this).attr('buttonid');
			jQuery.ajax({
				type : 'POST',
				url : '<?php echo admin_url('admin-ajax.php'); ?>',
				data : {
					action : 'delete_name_email',
					current_user_id : '<?php echo $current_user_id; ?>',
					friend_n_coll_id : friend_n_coll_id
				},
				success : function(r) {
				    jQuery('.preferences').html(r);
				}
			});
		});
	});
</script>

<?php get_footer('preferences'); ?>