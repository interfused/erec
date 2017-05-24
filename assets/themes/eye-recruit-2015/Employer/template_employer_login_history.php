<?php
/**
 * Template Name: Employer Login History page
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Jobify
 * @since Jobify 1.0
 */

get_header(); 
global $wpdb;
?>

<link rel='stylesheet' id='custom-dashboard-css'  href='<?php echo site_url();  ?>/assets/themes/eye-recruit-2015/dashboard.css?ver=4.5.3' type='text/css' media='all' />

	<?php while ( have_posts() ) : the_post(); ?>

	<header class="page-header">
		<h1 class="page-title"><?php the_title(); ?></h1>
	</header>

	<section class="preferences">
		<div class="container">
			<div class="row">
				<div class="col-md-3">
					<?php get_template_part( 'Employer/content', 'emp_preferences_sidemenu' ); ?>
				</div>
				<div class="col-md-9 sidemenu_border">
					<div class="section_title">
						<h3>Access & Security</h3>
						<?php $current_user_id = get_current_user_id(); ?>
						<span><strong>Recruit ID</strong> : <?php echo $current_user_id; ?></span>
					</div>
					<form class="renewalform">
						<div class="sidebar_title cont_title">
								<h4>Complete Login History</h4>
						</div>
						<div class="table-responsive indent">
							<?php
								$my_query 	= $wpdb->get_results( "SELECT * FROM eyecuwp_user_login_history WHERE user_id = '".$current_user_id."'" );
								$count 		= count( $my_query ); 
								if($count>0){
							?>
									<table class="table table-bordered">
										<thead>
											<tr>
												<th>Browser / Device</th>
												<th>Location</th>
												<th>IP Address</th>
												<th>Recent Activity</th>
											</tr>
										</thead>
										<tbody class="paginat">
											<?php 
												$myrows = $wpdb->get_results( "SELECT * FROM eyecuwp_user_login_history WHERE user_id = '".$current_user_id."' ORDER BY ID DESC LIMIT 0,10" );
												$current_time = current_time( 'timestamp' );
												foreach ($myrows as $key) { ?>
													<tr>
														<td><strong><?php echo $key->browser; ?> </strong><?php echo $key->device; ?></td>
														<td><?php echo $key->location; ?></td>
														<td><?php echo $key->ip_address; ?></td>
														<td><?php echo esc_html(human_time_diff(mysql2date('U', $key->login_date), $current_time)) . ' ago'; ?></td>
													</tr>
											<?php } ?>
										</tbody>
									</table><?php 
									if($count>10){ ?>
										<div class="text-center">
											<button type="button" class="btn btn-default page-class" id="prev" count="<?php echo $count; ?>" style="display:none" offset="0">Previous</button>
											<button type="button" class="btn btn-default page-class" id="next" count="<?php echo $count; ?>" offset="0">Next</button>
										</div>
										<?php
									}
								}else{
									echo "No results found";
								}
							?>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>

<?php endwhile; ?>
<script type="text/javascript">

	jQuery(document).ready(function() {
		jQuery(".page-class").on('click', function(){
			var _this = jQuery(this);
			var offset = _this.attr('offset');
			var count = _this.attr('count');
			count = parseInt(count);
			if(_this.attr('id') == 'prev'){
				var offset = parseInt(offset)-10;	
			}
			if(_this.attr('id') == 'next'){
				var offset = parseInt(offset)+10;
			}
			jQuery.ajax({
				type:'POST',
				url:'<?php echo site_url('/wp-admin/admin-ajax.php/'); ?>',
				data: {
					action: 'pag_prefer_log_hstry',
					offset: offset
				},
				success: function(r){
					if(r){
						jQuery('.indent .paginat').html(r);
						jQuery('#prev').attr('offset', offset);
						jQuery('#next').attr('offset', offset);
						if(offset>=10){
							jQuery('#prev').show();
						}else{
							jQuery('#prev').hide();
						}
						if(offset<=(count-10)){
							jQuery('#next').show();
						}else{
							jQuery('#next').hide();
						}
						if(count<offset){
							jQuery('#prev').hide();
							jQuery('#next').hide();
						}
					}else{
						alert('error');
					}
				}
			});
		});
	});

</script>
<?php get_footer('preferences'); ?>