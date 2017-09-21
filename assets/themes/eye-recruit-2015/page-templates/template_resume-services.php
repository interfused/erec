 <?php
/**
 * Template Name: Seeker Resume Services
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Jobify
 * @since Jobify 1.0
 */

get_header(); ?>

<link rel='stylesheet' id='custom-dashboard-css'  href='<?php echo site_url(); ?>/assets/themes/eye-recruit-2015/dashboard.css?ver=4.5.3' type='text/css' media='all' />

<?php while ( have_posts() ) : the_post(); ?>

	<header class="page-header">
		<h1 class="page-title"><?php the_title(); ?></h1>
	</header>

	<?php
	global $wpdb;
	$userid = get_current_user_id();
	$tablename = $wpdb->prefix.'fullstripe_payments';
	$formtable = $wpdb->prefix . "fullstripe_payment_forms";
	$paymentForms = $wpdb->get_results("SELECT * FROM $formtable WHERE servicetype = 'Resume Services'");
	
	$serTypeArr = array();
	foreach ($paymentForms as $value) {
		$serTypeArr[] = $value->name;
	}

	$getpreoption = $wpdb->get_row("SELECT * FROM $tablename WHERE formname IN ('".implode("','",$serTypeArr)."') AND userid = '".$userid."' order by paymentID desc limit 1"); //WHERE formname IN $optionarr
	$getpreoptionname =  ( !empty($getpreoption->formname) )? $getpreoption->formname : '';

	function getoptionurl($getpreoptionname, $url){
		$basurl = site_url().'/job-seekers/resume-support-service-checkout/?serviceType='.$url;
		return ($getpreoptionname == $url)? 'javascript:void(0);' : $basurl;
	}

	$options = get_option('fullstripe_options_f');
	$currencySymbol = MM_WPFSF::get_currency_symbol_for($options['currency']);
	?>

	<div id="primary" class="content-area">
		<div id="content" role="main">
			<section class="resume_services">
				<div class="container">
					<?php echo get_the_content(); ?>
					<div class="row">
						<?php
						$count = 1;
						foreach ($paymentForms as $value) { ?>
							<div class="col-sm-4">
								<div class="pricing-table-widget <?php echo ($getpreoptionname == $value->name)? 'sprice_active':''; ?>">
								<?php echo (($count == 2)) ? '<span class="popular_badge">Most Popular</span>' : ''; ?>
									<div class="text-center iconArea">
										<h4 class="pricing-table-widget-title"><?php echo $value->formTitle; ?></h4>
										<h5>
										<?php 
										echo $currencySymbol;
										if ($value->customAmount == 0){ 
		                                echo '<big>'.sprintf('%0.2f', $value->amount / 100.0).'</big>'; 
		                            	}
										echo (($count == 1)) ? '<br><strong>limited time!</strong>' : ''; 
										$count++;
		                                ?>
									</h5>
									</div>
									<div class="pricing-table-widget-description">
									<?php echo str_replace('\"', '', $value->formcontent);  ?>
									<a class="btn btn-success" href="<?php echo getoptionurl($getpreoptionname, $value->name); ?>"><?php echo ($getpreoptionname == $value->name)? 'SELECTED':'SELECT OPTION'; ?></a>
									</div>
								</div>
							</div>
						<?php } ?>
					</div>
					<?php if(true){ ?>
					<h3>So, how do we get started?</h3>
					<p>It's simple. You select a service above and we will provide you with a <strong>free resume critique</strong> from one our our resume consultants. The critique will provide you with an honest, direct assessment of your current resume. This will also give us a clear understanding of exactly how much support you are going to need.</p>
					<p>We then tailor your needs to match your level of experience and specific requirements or we can continue by selecting one of our prepared Resume options.</p>
				
					<?php } ?>
				</div>
			</section>
				
		</div><!-- #content -->
	</div><!-- #primary -->
<?php endwhile; ?>
<?php get_footer('preferences'); ?>