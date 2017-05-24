<?php
/**
 * Template Name: Preferences recruiter-management page
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Jobify
 * @since Jobify 1.0
 */

get_header();

if ( is_user_logged_in() ) {
	$current_user_id = get_current_user_id();
	$date = get_userdata($current_user_id);
	$uname = $date->first_name;
} else{
	$current_user_id = '';
	$uname = '';
}
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
						<h3>Recruiter Management</h3>
						<span><strong>Recruit ID</strong> : <?php echo $current_user_id;?></span>
					</div>

	        		<!-- <div class="row">
			        	<div class="col-sm-6 col-sm-push-6">
			        		<img src="<?php //echo get_stylesheet_directory_uri(); ?>/images/cirstopher.jpg" class="img-responsive">
			        	</div>
			        	<div class="col-sm-6 col-sm-pull-6 sendamail">
			        		<p>Hello <span><?php //echo $uname; ?></span>,</p>
			        		<p>My name is <span>Christopher Bauer</span> and I am proud to offer you my assistance. I have been a member of the <span>Security</span>, <span>Investigation</span> & <span>Risk Management</span> industry since <span>1993</span>.</p>
			        		<p>I have experience in <span>not only the field conducting Investigations, Servelliance and Security Services, but I also have many years in supervisory, management and executive</span> roles that will be of assistance to you in your career.</p>
			        		<p>As a recruiter I will be able to offer guidance and feedback on an individualized, but most importantly, I can search out, forward or provide introduction when the right oppportunity presents itself.</p>
			        		<p><img src="<?php //echo get_stylesheet_directory_uri(); ?>/images/cirstopher_sign.jpg" class="img-responsive"></p>
			        		<div class="text-center"><a href="javascript:void(0);" class="btn btn-primary btn-sm">Schedule a Call</a>
			        		<a href="javascript:void(0);" class="btn btn-default btn-sm">Ask a Question</a>
			        		<a href="javascript:void(0);" class="btn btn-default btn-sm">Introduce Me</a></div>
			        	</div>
			        </div> -->

					
					
					<div id="inv_frn_n_coll">
						<div class="search_bar">
						<!-- 	<div class="pull-right">
								<a href="#">Change View</a>
								<div class="input-group">
							      <input type="text" class="form-control" placeholder="Search">
							      <span class="input-group-btn">
							        <button class="btn" type="button"><i class="fa fa-search" aria-hidden="true"></i></button>
							      </span>
							    </div>
							</div> -->
							<p>These are the <span>6</span> recruiters.</p>
							<div class="clearfix"></div>
						</div>
						<div class="network_list indent recruitermanagement">
							<div class="row">
								<div class="col-sm-6">
									<article>
										<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/user5.jpg" class="img-responsive">
										<div class="article_content">
											<h4>Hello! <br>My Name is <br>Julia</h4>
											<ul>
												<li><span>Sector : </span>General Security</li>
												<li><span>Email : </span>Miami, FL.</li>
												<li><span>Status : </span>6 years</li>
											</ul>
											<span class="article_signature">Julia</span>
											<p><strong>Sector : </strong>General Security</p>
										</div>
										<div class="clearfix"></div>
										<div class="article_footer">
											<a href="javascript:void(0);">View Profile</a>
											<div class="checkbox"><label><input class="delete_anchor" data-toggle="confirmation" buttonid="<?php echo $ref_name_key; ?>" type="checkbox"> <span>Remove</span> </label></div>
										</div>
									</article>
								</div>
								<div class="col-sm-6">
									<article>
										<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/user4.jpg" class="img-responsive">
										<div class="article_content">
											<h4>Hello! <br>My Name is <br>John Doe</h4>
											<ul>
												<li><span>Sector : </span>General Security</li>
												<li><span>Email : </span>Miami, FL.</li>
												<li><span>Status : </span>6 years</li>
											</ul>
											<span class="article_signature">John Doe</span>
											<p><strong>Sector : </strong>General Security</p>
										</div>
										<div class="clearfix"></div>
										<div class="article_footer">
											<a href="javascript:void(0);">View Profile</a>
											<div class="checkbox"><label><input class="delete_anchor" data-toggle="confirmation" buttonid="<?php echo $ref_name_key; ?>" type="checkbox"> <span>Remove</span> </label></div>
										</div>
									</article>
								</div>
								<div class="col-sm-6">
									<article>
										<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/user6.jpg" class="img-responsive">
										<div class="article_content">
											<h4>Hello! <br>My Name is <br>Beckham Roy</h4>
											<ul>
												<li><span>Sector : </span>General Security</li>
												<li><span>Email : </span>Miami, FL.</li>
												<li><span>Status : </span>6 years</li>
											</ul>
											<span class="article_signature">Beckham Roy</span>
											<p><strong>Sector : </strong>General Security</p>
										</div>
										<div class="clearfix"></div>
										<div class="article_footer">
											<a href="javascript:void(0);">View Profile</a>
											<div class="checkbox"><label><input class="delete_anchor" data-toggle="confirmation" buttonid="<?php echo $ref_name_key; ?>" type="checkbox"> <span>Remove</span> </label></div>
										</div>
									</article>
								</div>
								<div class="col-sm-6">
									<article>
										<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/user2.jpg" class="img-responsive">
										<div class="article_content">
											<h4>Hello! <br>My Name is <br>Sophia Langer</h4>
											<ul>
												<li><span>Sector : </span>General Security</li>
												<li><span>Email : </span>Miami, FL.</li>
												<li><span>Status : </span>6 years</li>
											</ul>
											<span class="article_signature">Sophia Langer</span>
											<p><strong>Sector : </strong>General Security</p>
										</div>
										<div class="clearfix"></div>
										<div class="article_footer">
											<a href="javascript:void(0);">View Profile</a>
											<div class="checkbox"><label><input class="delete_anchor" data-toggle="confirmation" buttonid="<?php echo $ref_name_key; ?>" type="checkbox"> <span>Remove</span> </label></div>
										</div>
									</article>
								</div>
								<div class="col-sm-6">
									<article class="blocked">
										<div class="block_btn">
											<a href="javascript:void(0);" class="btn btn-primary">Unblock</a>
										</div>
										<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/user1.jpg" class="img-responsive">
										<div class="article_content">
											<h4>Hello! <br>My Name is <br>Adem Warner</h4>
											<ul>
												<li><span>Sector : </span>General Security</li>
												<li><span>Email : </span>Miami, FL.</li>
												<li><span>Status : </span>6 years</li>
											</ul>
											<span class="article_signature">Adem Warner</span>
											<p><strong>Sector : </strong>General Security</p>
										</div>
										<div class="clearfix"></div>
										<div class="article_footer">
											<a href="javascript:void(0);">View Profile</a>
											<div class="checkbox"><label><input class="delete_anchor" data-toggle="confirmation" buttonid="<?php echo $ref_name_key; ?>" type="checkbox"> <span>Remove</span> </label></div>
										</div>
									</article>
								</div>
								<div class="col-sm-6">
									<article class="blocked">
										<div class="block_btn">
											<a href="javascript:void(0);" class="btn btn-primary">Unblock</a>
										</div>
										<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/user3.jpg" class="img-responsive">
										<div class="article_content">
											<h4>Hello! <br>My Name is <br>Micheal Smith</h4>
											<ul>
												<li><span>Sector : </span>General Security</li>
												<li><span>Email : </span>Miami, FL.</li>
												<li><span>Status : </span>6 years</li>
											</ul>
											<span class="article_signature">Micheal Smith</span>
											<p><strong>Sector : </strong>General Security</p>
										</div>
										<div class="clearfix"></div>
										<div class="article_footer">
											<a href="javascript:void(0);">View Profile</a>
											<div class="checkbox"><label><input class="delete_anchor" data-toggle="confirmation" buttonid="<?php echo $ref_name_key; ?>" type="checkbox"> <span>Remove</span> </label></div>
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