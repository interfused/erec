<?php
/**
 * Template Name: Navigation Career Opportunities page
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Jobify
 * @since Jobify 1.0
 */

get_header(); ?>

<?php $userID = get_current_user_id(); ?>
<link rel='stylesheet' id='custom-dashboard-css'  href='<?php echo site_url(); ?>/assets/themes/eye-recruit-2015/dashboard.css?ver=4.5.3' type='text/css' media='all' />

	<?php while ( have_posts() ) : the_post(); ?>

	<header class="page-header">
		<h1 class="page-title"><?php the_title(); ?></h1>
	</header>

	<div id="primary" class="content-area">
		<div id="content" class="container" role="main">
			<section class="navigations">
				<div class="section_title">
					<h3>Career opportunities</h3>
					<span><strong>Recruit ID</strong> : <?php echo $userID; ?></span>
				</div>

				<div class="row">
					<div class="col-md-9">
						<ol class="breadcrumb">
						  <li><a href="<?php echo site_url().'/job-seekers/dashboard/'; ?>">Home</a></li>
						  <li class="active">Career opportunities</li>
						</ol>
					</div>
				</div>
				
				<div class="row ">
					<div class="col-md-9">
						<div class=" help_center help_today">
						
						<div class="sidebar_title cont_title">
							<h4>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</h4>
						</div>
						<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged</p>
						<div class=" row">
							<div class="col-sm-4">
								<div class="well">
									<h5>Lorem Ipsum </h5>
									<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
									<a href="jascript:void(0);" data-target="#aboutproblem" data-toggle="modal" id="submitbPobe" ticketid="azuZbqMV" class="btn btn-default">Lorem Ipsum </a>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="well">
									<h5>Lorem Ipsum </h5>
									<p>BLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. </p>
									<a href="#" class="btn btn-default">Lorem Ipsum </a>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="well">
									<h5>Lorem Ipsum </h5>
									<p>BLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. </p>
									<a href="#" class="btn btn-default">Lorem Ipsum </a>
								</div>
							</div>
						</div>

							<div class=" row">
							<div class="col-sm-4">
								<div class="well">
									<h5>Lorem Ipsum </h5>
									<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. </p>
									<a href="jascript:void(0);" class="btn btn-default">Lorem Ipsum</a>
								</div>
							</div>

							<div class="col-sm-4">
								<div class="well">
									<h5>Lorem Ipsum </h5>
									<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
									<a href="jascript:void(0);" data-target="#aboutproblem" data-toggle="modal" id="submitbPobe" ticketid="azuZbqMV" class="btn btn-default">Lorem Ipsum </a>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="well">
									<h5>Lorem Ipsum </h5>
									<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. </p>
									<a href="jascript:void(0);" class="btn btn-default">Lorem Ipsum </a>
								</div>
							</div>
						</div>



					</div>
					</div>

					<div class="col-md-3">
						<?php $pageID = get_the_ID(); ?>
						<div class="special_box navi_thumbnail">
							<h5>You're almost there!</h5>
							<?php $yat = get_post_meta($pageID, 'youre_almost_there', true); ?>
							<p><?php //echo (($yat))? $yat : 'Data not found.' ?>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
						</div>

						<div class="special_box navi_thumbnail">
							<h5>What happens next?</h5>
							<?php $whn = get_post_meta($pageID, 'what_happens_next', true); ?>
							<p><?php //echo (($whn))? $whn : 'Data not found.' ?>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
						</div>

						<div class="special_box navi_thumbnail">
							<h5>The goal is simple:</h5>
							<?php $tgis = get_post_meta($pageID, 'the_goal_is_simple', true); ?>
							<p><?php //echo (($tgis))? $tgis : 'Data not found.' ?>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
						</div>
					</div>
				</div>
			</section>
				
		</div><!-- #content -->
		
		<?//php do_action( 'jobify_loop_after' ); ?>
	</div><!-- #primary -->

	<?php endwhile; ?>
<?php get_footer('preferences'); ?>