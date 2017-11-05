<?php
/**
 * Template Name: demo job search job
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

	<div id="primary" class="content-area">
		<div id="content" role="main">
			<section class="jobsearch_map">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/seeker_map.jpg" class="img-responsive">
				<div class="container">
					<div class="jobsearch_bar">
						<form class="form">
							<div class="search_fields">
								<div class="row">
									<div class="col-sm-4">
										<div class="form-group">
											<input type="text" class="form-control" placeholder="Keyword">
										</div>
									</div>
									<div class="col-sm-4">
										<div class="form-group has-feedback">
										    <select class="form-control">
											  <option>Location</option>
											  <option>United States</option>
											</select>
											<span class="fa fa-angle-down form-control-feedback" aria-hidden="true"></span>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="form-group has-feedback">
										    <select class="form-control">
										    	<option class="level-0" value="">Category</option>
												<option class="level-0" value="353">Information Technology</option>
												<option class="level-0" value="92">Investigations</option>
												<option class="level-0" value="354">Investigative Journalism</option>
												<option class="level-0" value="366">Loss Prevention</option>
												<option class="level-0" value="308">Marketing &amp; Sales</option>
												<option class="level-0" value="307">Operations Management</option>
												<option class="level-0" value="306">Risk Management</option>
												<option class="level-0" value="34">Security</option>
												<option class="level-0" value="309">Support Staff</option>
												<option class="level-0" value="112">Surveillance</option>
											</select>
											<span class="fa fa-angle-down form-control-feedback" aria-hidden="true"></span>
										</div>
									</div>
								</div>
								<a href="#" class="btn btn-primary">Submit</a>
							</div>
						</form>
						<div class="text-right"><a href="#">Advance Search</a></div>
					</div>
					<div class="text-center"><a href="#" class="btn btn-success">Create a Job Alert</a></div>
				</div>
			</section>
			<section class="dashboard_sec">
				<div class="container">
					<div class="row">
						<div class="col-lg-6 col-md-12 col-lg-push-3 col-md-push-0">
							<div class="section_title">
								<h3>Featured</h3>
								<span class="text-warning"><i class="fa fa-rss" aria-hidden="true"></i> RSS</span>
							</div>
							<div class="jobsearch_results featured_jobs">
								<div class="jobsearch_list">
									<div class="thumbnail">
										<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/speciallogo.jpg" class="img-responsive">
									</div>
									<div class="post_btns">
										<h6>Posted on Oct 2 2016</h6>
										<a href="#" class="btn btn-default btn-sm">Follow</a>
										<span class="label label-success">Full Time</span>
										<a href="#" class="btn btn-default btn-sm">Save Job</a>
										<a href="#" class="btn btn-default btn-sm">Forward</a>
									</div>
									<div class="searchresult_cont">
										<h3>SECURITY OFFICER – Bilingual (English/Spanish)</h3>
										<span><a href="www.eyerecruit.com">eyerecruit.com</a></span>
										<span>Ft Lauderdale, Miami</span>
										<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
										<a href="#" class="btn btn-primary btn-sm">View More <i class="fa fa-angle-double-right"></i></a>
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="jobsearch_list">
									<div class="thumbnail">
										<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/speciallogo.jpg" class="img-responsive">
									</div>
									<div class="post_btns">
										<h6>Posted on Oct 2 2016</h6>
										<a href="#" class="btn btn-default btn-sm">Follow</a>
										<span class="label label-warning">Part Time</span>
										<a href="#" class="btn btn-default btn-sm">Save Job</a>
										<a href="#" class="btn btn-default btn-sm">Forward</a>
									</div>
									<div class="searchresult_cont">
										<h3>SECURITY OFFICER – Bilingual (English/Spanish)</h3>
										<span><a href="www.eyerecruit.com">eyerecruit.com</a></span>
										<span>Ft Lauderdale, Miami</span>
										<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
										<a href="#" class="btn btn-primary btn-sm">View More <i class="fa fa-angle-double-right"></i></a>
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="jobsearch_list">
									<div class="thumbnail">
										<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/speciallogo.jpg" class="img-responsive">
									</div>
									<div class="post_btns">
										<h6>Posted on Oct 2 2016</h6>
										<a href="#" class="btn btn-default btn-sm">Follow</a>
										<span class="label label-info">Contract - Long</span>
										<a href="#" class="btn btn-default btn-sm">Save Job</a>
										<a href="#" class="btn btn-default btn-sm">Forward</a>
									</div>
									<div class="searchresult_cont">
										<h3>SECURITY OFFICER – Bilingual (English/Spanish)</h3>
										<span><a href="www.eyerecruit.com">eyerecruit.com</a></span>
										<span>Ft Lauderdale, Miami</span>
										<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
										<a href="#" class="btn btn-primary btn-sm">View More <i class="fa fa-angle-double-right"></i></a>
									</div>
									<div class="clearfix"></div>
								</div>
							</div>

							<div class="section_title">
								<h3>Letest Job Postings</h3>
								<div class="dropdown pull-right">
								  <span>Relevance - <strong>Sept. 12th 2016</strong></span>
								  <a class="dropdown-toggle" href="javascript-void(0)" id="LetestJobdrop" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
								    <i class="fa fa-angle-down" aria-hidden="true"></i>
								  </a>
								  <ul class="dropdown-menu" aria-labelledby="LetestJobdrop">
								    <li><a href="#">Sept. 13th 2016</a></li>
								    <li><a href="#">Sept. 14th 2016</a></li>
								    <li><a href="#">Sept. 15th 2016</a></li>
								    <li><a href="#">Sept. 16th 2016</a></li>
								  </ul>
								</div>
							</div>
							<div class="jobsearch_results">
								<div class="jobsearch_list">
									<div class="thumbnail">
										<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/speciallogo.jpg" class="img-responsive">
									</div>
									<div class="post_btns">
										<h6>Posted on Oct 2 2016</h6>
										<a href="#" class="btn btn-default btn-sm">Follow</a>
										<span class="label label-blue">Full Time</span>
										<a href="#" class="btn btn-default btn-sm">Save Job</a>
										<a href="#" class="btn btn-default btn-sm">Forward</a>
									</div>
									<div class="searchresult_cont">
										<h3>SECURITY OFFICER – Bilingual (English/Spanish)</h3>
										<span><a href="www.eyerecruit.com">eyerecruit.com</a></span>
										<span>Ft Lauderdale, Miami</span>
										<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
										<a href="#" class="btn btn-primary btn-sm">View More <i class="fa fa-angle-double-right"></i></a>
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="jobsearch_list">
									<div class="thumbnail">
										<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/speciallogo.jpg" class="img-responsive">
									</div>
									<div class="post_btns">
										<h6>Posted on Oct 2 2016</h6>
										<a href="#" class="btn btn-default btn-sm">Follow</a>
										<span class="label label-magento">Internship</span>
										<a href="#" class="btn btn-default btn-sm">Save Job</a>
										<a href="#" class="btn btn-default btn-sm">Forward</a>
									</div>
									<div class="searchresult_cont">
										<h3>SECURITY OFFICER – Bilingual (English/Spanish)</h3>
										<span><a href="www.eyerecruit.com">eyerecruit.com</a></span>
										<span>Ft Lauderdale, Miami</span>
										<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
										<a href="#" class="btn btn-primary btn-sm">View More <i class="fa fa-angle-double-right"></i></a>
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="jobsearch_list">
									<div class="thumbnail">
										<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/speciallogo.jpg" class="img-responsive">
									</div>
									<div class="post_btns">
										<h6>Posted on Oct 2 2016</h6>
										<a href="#" class="btn btn-default btn-sm">Follow</a>
										<span class="label label-success">Contract - Short</span>
										<a href="#" class="btn btn-default btn-sm">Save Job</a>
										<a href="#" class="btn btn-default btn-sm">Forward</a>
									</div>
									<div class="searchresult_cont">
										<h3>SECURITY OFFICER – Bilingual (English/Spanish)</h3>
										<span><a href="www.eyerecruit.com">eyerecruit.com</a></span>
										<span>Ft Lauderdale, Miami</span>
										<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
										<a href="#" class="btn btn-primary btn-sm">View More <i class="fa fa-angle-double-right"></i></a>
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="jobsearch_list">
									<div class="thumbnail">
										<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/speciallogo.jpg" class="img-responsive">
									</div>
									<div class="post_btns">
										<h6>Posted on Oct 2 2016</h6>
										<a href="#" class="btn btn-default btn-sm">Follow</a>
										<span class="label label-success">Full Time</span>
										<a href="#" class="btn btn-default btn-sm">Save Job</a>
										<a href="#" class="btn btn-default btn-sm">Forward</a>
									</div>
									<div class="searchresult_cont">
										<h3>SECURITY OFFICER – Bilingual (English/Spanish)</h3>
										<span><a href="www.eyerecruit.com">eyerecruit.com</a></span>
										<span>Ft Lauderdale, Miami</span>
										<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
										<a href="#" class="btn btn-primary btn-sm">View More <i class="fa fa-angle-double-right"></i></a>
									</div>
									<div class="clearfix"></div>
								</div>
							</div>
						</div>
						<div class="col-lg-3 col-md-6 col-lg-pull-6 col-md-pull-0">
							<form class="quick_search">
								<div class="form-group">
								  	<input type="text" class="form-control" aria-describedby="basic-addon1">
									<button type="submit"><i class="fa fa-search"></i></button>
								</div>
							</form>
							<div class="light_box quick_links">
								<div class="sidebar_title">
									<h4>Category</h4>
								</div>
								<ul>
									<li><a href="#">Security</a></li>
									<li><a href="#">Investigations</a></li>
									<li><a href="#">Loss Prevention</a></li>
									<li><a href="#">Surveillance</a></li>
									<li><a href="#">Information Technology</a></li>
									<li><a href="#">Investigative Journalist</a></li>
									<li><a href="#">Manager</a></li>
									<li><a href="#">Supervisor</a></li>
									<li><a href="#">Administration</a></li>
									<li><a href="#">Clerical</a></li>
									<li><a href="#">Marketing</a></li>
									<li><a href="#">Sales</a></li>
								</ul>
							</div>
							
							<div class="light_box quick_links">
								<div class="sidebar_title">
									<h4>Sales</h4>
								</div>
								<ul class="by_type">
									<li><a href="#">Full Time <span class="bg-success"></span></a></li>
									<li><a href="#">Part Time <span class="bg-info"></span></a></li>
									<li><a href="#">Contract - Short <span class="bg-warning"></span></a></li>
									<li><a href="#">Contract - Long <span class="bg-blue"></span></a></li>
									<li><a href="#">Intrnship <span class="bg-magento"></span></a></li>
									<li><a href="#">All Available Advancements</a></li>
								</ul>
							</div>
							
							<div class="light_box quick_links">
								<div class="sidebar_title">
									<h4>Compensation</h4>
								</div>
								<ul>
									<li><a href="#">Under $40,000</a></li>
									<li><a href="#">$40,001 - $50,000</a></li>
									<li><a href="#">$50,001 - $60,000</a></li>
									<li><a href="#">$60,001 - $70,000</a></li>
									<li><a href="#">$70,001 - $80,000</a></li>
									<li><a href="#">$80,001 - $90,000</a></li>
									<li><a href="#">$90,001 - $100,000</a></li>
									<li><a href="#">$100,001 - $125,000</a></li>
									<li><a href="#">$125,001 - $150,000</a></li>
									<li><a href="#">$150,001 - $250,000</a></li>
									<li><a href="#">Over $500,000 annually</a></li>
								</ul>
							</div>

						</div>
						<div class="col-lg-3 col-md-6 col-lg-pull-0 col-md-pull-0">
							<div class="sidebar right_sidebar">

								<div class="light_box recruiter_box welcome_box">
									<h3>Welcome Guest! </h3>
									<div class="form-group">
										<p>Member Sign In</p>
										<a href="#" class="btn btn-primary">Login</a>
									</div>
									<hr>
									<div class="form-group">
										<p>Like to Post Your Resume?</p>
										<a href="#" class="btn btn-default">Register Free</a>
									</div>
								</div>
								<div class="feature_ad">
									<h3>POST 10 JOBS FREE!</h3>
									<span>$<big>10</big>/<br>day</span>
									<a href="#" class="btn btn-default btn-lg">Refer <strong>Now</strong></a>
								</div>
								<div class="light_box tips">
									<div class="sidebar_title">
										<h4>Why employers use us ?</h4>
									</div>
									<p>EyeRecruit.com is one of the most popular job sites for professionals within the Security, Investigation, Surveillance and Risk Management Profession. We were founded by industy insiders and have based our Business practices on very specific and non-negotiable principles. If you have not done so already, we invite you to investgate for yourself what all the buzz is about. We are more than just a Job Board. We are a home for quality Job Seekers. With a litle help from technology and guidance from Industry Recruiters, we are achieving career synergy in ways never imagined.</p>
								</div>
								<div class="light_box our_blogs">
									<div class="sidebar_title">
										<h4>From Our Blog</h4>
									</div>
									<div id="blog_carousal" class="carousel slide" data-ride="carousel">
									  <!-- Indicators -->
									  <ol class="carousel-indicators">
									    <li data-target="#blog_carousal" data-slide-to="0" class="active"></li>
									    <li data-target="#blog_carousal" data-slide-to="1"></li>
									    <li data-target="#blog_carousal" data-slide-to="2"></li>
									  </ol>

									  <!-- Wrapper for slides -->
									  <div class="carousel-inner" role="listbox">
									    <div class="item active">
									      <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/blogslider_img.jpg" alt="blog">
									      <div class="carousel-caption">
									        <h4>How to Write A Good Resume</h4>
									        <p>Tips by John Doe on Sept 23, 2015</p>
									      </div>
									    </div>
									    <div class="item">
									      <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/blogslider_img.jpg" alt="blog">
									      <div class="carousel-caption">
									        <h4>How to Write A Good Resume</h4>
									        <p>Tips by John Doe on Sept 23, 2015</p>
									      </div>
									    </div>
									    <div class="item">
									      <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/blogslider_img.jpg" alt="blog">
									      <div class="carousel-caption">
									        <h4>How to Write A Good Resume</h4>
									        <p>Tips by John Doe on Sept 23, 2015</p>
									      </div>
									    </div>
									  </div>

									  <!-- Controls -->
									  <a class="left carousel-control" href="#blog_carousal" role="button" data-slide="prev">
									    <span class="fa fa-angle-left" aria-hidden="true"></span>
									    <span class="sr-only">Previous</span>
									  </a>
									  <a class="right carousel-control" href="#blog_carousal" role="button" data-slide="next">
									    <span class="fa fa-angle-right" aria-hidden="true"></span>
									    <span class="sr-only">Next</span>
									  </a>
									</div>
								</div>
								<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/ad1.jpg" alt="advertise" class="img-responsive">
							</div>
						</div>
					</div>
				</div>
			</section>
				<?php //comments_template(); ?>
		</div><!-- #content -->

		<?php do_action( 'jobify_loop_after' ); ?>
	</div><!-- #primary -->

	<?php endwhile; ?>

<?php get_footer('assessment'); ?>