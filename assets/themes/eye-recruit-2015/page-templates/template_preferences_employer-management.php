<?php
/**
 * Template Name: Preferences employer-management page
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Jobify
 * @since Jobify 1.0
 */

get_header(); 

$current_user_id = get_current_user_id();

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
						<h3>Employer Management</h3>
						<span><strong>Recruit ID</strong> : <?php echo $current_user_id;?></span>
					</div>
					<div id="inv_frn_n_coll">
						<div class="search_bar">
							<!-- <div class="pull-right">
								<a href="#">Change View</a>
								<div class="input-group">
							      <input type="text" class="form-control" placeholder="Search">
							      <span class="input-group-btn">
							        <button class="btn" type="button"><i class="fa fa-search" aria-hidden="true"></i></button>
							      </span>
							    </div>
							</div> -->
							<p>These are the <span>6</span> employers.</p>
							<div class="clearfix"></div>
						</div>
						<div class="network_list indent employer_management_page">
							<div class="row">
								<div class="col-sm-6">
									<article class="blocked_active">
										<div class="blocked_activeimg"></div>
										<div class="article_content">
											<h4>Barkley Security</h4>
											<div class="text_red">Guard Services - Investigations - Consulting - Training</div>
											<!-- <ul>
												<li><span>Location : </span>Miami, FL.</li>
												<li><span>Saved Date : </span>August 16th 2016</li>
											</ul> -->
											<div class="employer_manageimg">
												<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/employer1.jpg" class="img-responsive">
												<span>Headquarters:</span>
												<span>Kennesaw GA.</span>
												<span class="label label-success">Openings</span>
												<hr>
												<p><strong>Saved on:</strong> 12/21/2016</p>
											</div>
											<div class="left_content">
												<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
											</div>
										</div>
										<div class="clearfix"></div>
										<div class="article_footer">
											<a href="#">Visit profile</a>
											<div class="checkbox"><label><input class="delete_anchor" data-toggle="confirmation" buttonid="<?php echo $ref_name_key; ?>" type="checkbox"> <span>Remove</span> </label></div>
											<div class="checkbox"><label><input class="delete_anchor" data-toggle="confirmation" buttonid="<?php echo $ref_name_key; ?>" type="checkbox"> <span>Block</span> </label></div>
										</div>
									</article>
								</div>
								<div class="col-sm-6">
									<article>
										<div class="blocked_activeimg"></div>
										<div class="article_content">
											<h4>Elite Investigations Ltd.</h4>
											<div class="text_red">Guard Services - Investigations - Consulting - Training</div>
										<div class="employer_manageimg">
											<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/employer2.jpg" class="img-responsive">
											<span>Headquarters:</span>
											<span>Kennesaw GA.</span>
											<span class="label label-success">Openings</span>
											<hr>
											<p><strong>Saved on:</strong> 12/21/2016</p>
										</div>
											<!-- <ul>
												<li><span>Location : </span>Lauderdale, FL.</li>
												<li><span>Saved Date : </span>September 2th 2016</li>
											</ul> -->
											<div class="left_content">
												<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
											</div>
										</div>
										<div class="clearfix"></div>
										<div class="article_footer">
											<a href="#">Visit profile</a>
											<div class="checkbox"><label><input class="delete_anchor" data-toggle="confirmation" buttonid="<?php echo $ref_name_key; ?>" type="checkbox"> <span>Remove</span> </label></div>
											<div class="checkbox"><label><input class="delete_anchor" data-toggle="confirmation" buttonid="<?php echo $ref_name_key; ?>" type="checkbox"> <span>Block</span> </label></div>
										</div>
									</article>
								</div>
								<div class="col-sm-6">
									<article>
										<div class="blocked_activeimg"></div>
										<div class="article_content">
											<h4>Miami Protection</h4>
											<div class="text_red">Guard Services - Investigations - Consulting - Training</div>
												<div class="employer_manageimg">
													<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/employer3.jpg" class="img-responsive">
													<span>Headquarters:</span>
													<span>Kennesaw GA.</span>
													<span class="label label-success">Openings</span>
													<hr>
													<p><strong>Saved on:</strong> 12/21/2016</p>
												</div>
											<!-- <ul>
												<li><span>Location : </span>Miami, FL.</li>
												<li><span>Saved Date : </span>August 7th 2016</li>
											</ul> -->
											<!-- <div class="left_content">
												<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
											</div> -->
											<div class="left_content">
												<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
											</div>
										</div>
										<div class="clearfix"></div>
										<div class="article_footer">
											<a href="#">Visit profile</a>
											<div class="checkbox"><label><input class="delete_anchor" data-toggle="confirmation" buttonid="<?php echo $ref_name_key; ?>" type="checkbox"> <span>Remove</span> </label></div>
											<div class="checkbox"><label><input class="delete_anchor" data-toggle="confirmation" buttonid="<?php echo $ref_name_key; ?>" type="checkbox"> <span>Block</span> </label></div>
										</div>
									</article>
								</div>
								<div class="col-sm-6">
									<article>
										<div class="blocked_activeimg"></div>
										<div class="article_content">
											<h4>U. S. Security Associates</h4>
											<div class="text_red">Guard Services - Investigations - Consulting - Training</div>
												<div class="employer_manageimg">
													<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/employer4.jpg" class="img-responsive">
													<span>Headquarters:</span>
													<span>Kennesaw GA.</span>
													<span class="label label-notify">Be Notified</span>
													<hr>
													<p><strong>Saved on:</strong> 12/21/2016</p>
												</div>
											<!-- <ul>
												<li><span>Location : </span>Lauderdale, FL.</li>
												<li><span>Saved Date : </span>September 10th 2016</li>
											</ul> -->
											<div class="left_content">
												<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
											</div>
										</div>
										<div class="clearfix"></div>
										<div class="article_footer">
											<a href="#">Visit profile</a>
											<div class="checkbox"><label><input class="delete_anchor" data-toggle="confirmation" buttonid="<?php echo $ref_name_key; ?>" type="checkbox"> <span>Remove</span> </label></div>
											<div class="checkbox"><label><input class="delete_anchor" data-toggle="confirmation" buttonid="<?php echo $ref_name_key; ?>" type="checkbox"> <span>Block</span> </label></div>
										</div>
									</article>
								</div>
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