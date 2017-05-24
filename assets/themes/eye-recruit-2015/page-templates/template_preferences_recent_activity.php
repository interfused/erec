<?php
/**
 * Template Name: Preferences Recent Activity page
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

	<section class="preferences">
		<div class="container">
			<div class="row">
				<div class="col-md-3">
				<?php get_template_part( 'seeker_dasboard_templates/content', 'preferences_sidemenu' ); ?>
				</div>
				<div class="col-md-9 sidemenu_border">
					<div class="section_title">
						<h3>Activity Logs</h3>
						<?php $current_user_id = get_current_user_id(); ?>
						<span><strong>Recruit ID</strong> : <?php echo $current_user_id ?></span>
					</div>
					<form class="renewalform">
						<div class="sidebar_title cont_title">
								<h4>All Activity Logs</h4>
						</div>
						<div class="table-responsive indent">
							<?php 
							$my_query = $wpdb->get_results( "SELECT * FROM eyecuwp_user_activity_log WHERE user_id='".$current_user_id."'" );
							$count = count($my_query);
							if($count>0){
								?>
								<table class="table table-bordered">
									<tbody class="paginat">
										<?php 
											$myrows = $wpdb->get_results( "SELECT * FROM eyecuwp_user_activity_log WHERE user_id='".$current_user_id."' ORDER BY ID DESC LIMIT 0,10" );
											$current_time = current_time( 'timestamp' );
											foreach ($myrows as $key) {
										?>
											<tr>
												<td><?php echo $key->meta; ?></td>
												<td class="text-right"><?php echo date('g.iA \o\n j M, Y', $key->datetime); ?></td>
											</tr>
										<?php
											}
										?>
									</tbody>
								</table>
								<?php
								if($count>10){ ?>
									<div class="text-center">
										<button type="button" class="btn btn-default page-class" id="prev" count="<?php echo $count; ?>" style="display:none" offset="0">Previous</button>
										<button type="button" class="btn btn-default page-class" id="next" count="<?php echo $count; ?>" offset="0">Next</button>
									</div>
									<?php 
								}
							}
							else{
								echo "No results found";
							} ?>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>

<?php endwhile; ?>
<script type="text/javascript">
	jQuery(document).ready(function(){
		jQuery(".page-class").on('click', function(){
			var _this = jQuery(this);
			var offset = _this.attr('offset');
			var count = _this.attr('count');
			var button_id = _this.attr('id');
			if(button_id=='prev'){
				offset = parseInt(offset)-10;
			}else{
				offset = parseInt(offset)+10;
			}
			jQuery.ajax({
				type:'POST',
				url:'<?php echo site_url("/wp-admin/admin-ajax.php")?>',
				data:{
					action:'paginate_preferences_recent_activity',
					offset:offset
				},
				success: function(r){
					if(r){
						jQuery(".indent .paginat").html(r);
						jQuery("#prev").attr("offset", offset);
						jQuery("#next").attr("offset", offset);
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
						alert("error");
					}
				}
			});
		});
	});
</script>
<?php get_footer('preferences'); ?>
