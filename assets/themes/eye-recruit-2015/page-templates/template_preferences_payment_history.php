<?php
/**
 * Template Name: Preferences Transaction history History page
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
				<?php get_template_part( 'seeker_dasboard_templates/content', 'preferences_sidemenu' ); ?>
				</div>
				<div class="col-md-9 sidemenu_border">
					<div class="section_title">
						<h3>RENEWALS & BILLING</h3>
						<?php $current_user_id = get_current_user_id(); ?>
						<span><strong>Recruit ID</strong> : <?php echo $current_user_id; ?></span>
					</div>
					<form class="renewalform">
						<div class="sidebar_title cont_title">
							<h4>Complete Transaction history & Receipts</h4>
						</div>
						<div class="table-responsive indent">
							<?php
							$tablename = $wpdb->prefix.'pmpro_membership_orders';
					  		$my_query = $wpdb->get_results("SELECT * FROM $tablename WHERE user_id = '".$current_user->ID."' ORDER BY id DESC");
							$count = count( $my_query ); 
							if($count>0){ ?>
								<table class="table table-bordered">
									<thead>
										<tr>
											<th class="text-center">Date</th>
											<th class="text-center">Receipt id</th>
											<th class="text-center">Credit card</th>
											<th class="text-center">Description</th>
											<th class="text-right">Total</th>
										</tr>
									</thead>
									<tbody class="paginat">
										<?php 
											$myrows = $wpdb->get_results("SELECT * FROM $tablename WHERE user_id = '".$current_user->ID."' ORDER BY id DESC");
											$current_time = current_time( 'timestamp' );
											foreach ($myrows as $value) { 
												$date = date('m/d/Y', strtotime($value->timestamp) );
												$price = $value->subtotal;
												$accno = $value->accountnumber;
												$recID = $value->code;
												$uID = $value->user_id;
												$uData = get_userdata($uID);
												$uName = $uData->first_name.' '.$uData->last_name;
												$uEmail = $uData->user_email;
												?>
												<tr>
													<td class="text-center"><?php echo $date; ?></td>
													<?php /*<td class="text-center"><?php if(!empty($recID)){ ?><a href="<?php echo site_url().'/membership-invoice/?invoice='.$recID; ?>" target="_blank"><?php echo $recID; ?></a><?php } else{ echo "--"; } ?></td> */ ?>
													<td class="text-center"><?php echo (($recID))? $recID :'--'; ?></td>
													<td class="text-center"><?php echo (($accno))? $accno :'--'; ?></td>
													<td class="text-center">Order <?php echo (($recID))? '#'.$recID :''; ?>, <?php echo (($uName))? $uName :''; ?> <?php echo (($uEmail))? '('.$uEmail.')' :''; ?></td>
													<td class="text-right"><?php echo pmpro_formatPrice($price); ?></td>
												</tr>
										<?php } ?>
									</tbody>
								</table><?php 
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
<?php get_footer('preferences'); ?>