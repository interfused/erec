<?php
/**
 * Template Name: Employers jobseeker search
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Jobify
 * @since Jobify 1.0
 */


get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

	<header class="page-header">
		<h1 class="page-title"><?//php the_title(); ?>Dive in the talent Pool</h1>
	</header>

	<div id="primary" class="content-area">
		<div id="content" role="main">
			<?php //comments_template(); ?>
			<section class="dashboard_sec search_employers">
				<div class="search_process">
					<div class="container">
						<div class="row">
							<div class="col-md-7">
								<h3>What Industry Sector would you like to search?</h3>
								<div class="inlinecheck_group">
									<label class="checkbox-inline">
										<input type="checkbox" id="industrysearch1" value="industrysearch1"> <span>Security</span>
									</label>
									<label class="checkbox-inline">
										<input type="checkbox" id="industrysearch2" value="industrysearch2"> <span>Investigations</span>
									</label>
									<label class="checkbox-inline">
										<input type="checkbox" id="industrysearch3" value="industrysearch3"> <span>Surveillance</span>
									</label>
									<label class="checkbox-inline">
										<input type="checkbox" id="industrysearch4" value="industrysearch4"> <span>Loss Prevention</span>
									</label>
									<label class="checkbox-inline">
										<input type="checkbox" id="industrysearch5" value="industrysearch5"> <span>Risk Management</span>
									</label>
									<label class="checkbox-inline">
										<input type="checkbox" id="industrysearch6" value="industrysearch6"> <span>Information Technology</span>
									</label>
									<label class="checkbox-inline">
										<input type="checkbox" id="industrysearch7" value="industrysearch7"> <span>Investigative Journalism</span>
									</label>
									<label class="checkbox-inline">
										<input type="checkbox" id="industrysearch8" value="industrysearch8"> <span>Operations Management</span>
									</label>
									<label class="checkbox-inline">
										<input type="checkbox" id="industrysearch9" value="industrysearch9"> <span>Marketing & Sales</span>
									</label>
									<label class="checkbox-inline">
										<input type="checkbox" id="industrysearch10" value="industrysearch10"> <span>Support Staff</span>
									</label>
									<label class="checkbox-inline">
										<input type="checkbox" id="industrysearch11" value="industrysearch11"> <span>Search All Sector</span>
									</label>
								</div>
							</div>
							<div class="col-md-5">
								<h3>In what zip code would you like to search?</h3>
								<div class="form-group">
									<input class="form-control" type="text">
								</div>
								<div class="checkbox">
									<label>
										<input type="checkbox" value=""><span>Include condidates willing so replaces</span>
									</label>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="container">
					<div class="row">
						<div class="col-lg-6 col-md-12 col-lg-push-3 col-md-push-0">
							<div class="section_title">
								<h3>Search Results</h3>
								<span class="text-warning"><a href="?feed=job_feed&amp;job_types&amp;search_location&amp;job_categories&amp;search_keywords" id="getrss" target="_blank"> <i class="fa fa-rss" aria-hidden="true"></i> RSS</a> </span>
							</div>
							<div class="search_bar">
								<div class="pull-right">
									<div class="form-inline">
										<div class="form-group has-feedback">
											<label>Sort by :</label>
											<select class="form-control input-sm">
												<option>Best Watch</option>
												<option>Best Watch</option>
											</select>
											<span class="fa fa-angle-down form-control-feedback" aria-hidden="true"></span>
										</div>
										<div class="form-group has-feedback">
											<select class="form-control input-sm">
												<option>12</option>
												<option>24</option>
												<option>48</option>
												<option>All</option>
											</select>
											<span class="fa fa-angle-down form-control-feedback" aria-hidden="true"></span>
										</div>
									</div>
								</div>
								<p>Your query has located : <span id="countMyBookmarks" count="3">1342 results </span></p>
								<hr class="clearfix" />
							</div>
							<div class="job_listings">
								<div class="job_listing">
									<div class="jobsearch_list">
										<span class="back_check"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/backcheck.jpg"></span>
										<div class="thumbnail">
											<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/employer_default.jpg" class="img-responsive">
										</div>
										<div class="post_btns">
											<div class="postbtns_inner">
												<div class="c100 p93 small">
													<span>93%<small>Overall</small></span>
													<div class="slice">
														<div class="bar"></div>
														<div class="fill"></div>
													</div>
												</div>
												<a class="btn btn-primary btn-sm" href="javascript:void(0);">See Quick View</a>				
												<a href="javascript:void(0);" class="btn btn-default btn-sm">View Full Profile</a>
												<div class="checkbox">
													<label>
														<input type="checkbox" value=""><span>Compare</span>
													</label>
												</div>
											</div>
										</div>
										<div class="searchresult_cont">
											<h3><a href="#">Stephen Donner</a></h3>
											<span>Recruiter ID. : 23543</span>
											<hr class="clearfix" />
											<h3><a href="#">Security</a></h3>
											<span>4 Years Experiences</span>
											<span>Las Vegas, Neveda</span>
											<p class="text-right"><a href="#" class="link">Delete</a><a href="#" class="link">Remove</a><a href="#" class="link">Block</a></p>
										</div>
										<div class="clearfix"></div>
									</div>
									<div class="jobsearch_list">
										<span class="back_check"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/backcheck.jpg"></span>
										<div class="thumbnail">
											<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/employer_default.jpg" class="img-responsive">
										</div>
										<div class="post_btns">
											<div class="postbtns_inner">
												<div class="c100 p93 small">
													<span>93%<small>Overall</small></span>
													<div class="slice">
														<div class="bar"></div>
														<div class="fill"></div>
													</div>
												</div>
												<a class="btn btn-primary btn-sm" href="javascript:void(0);">See Quick View</a>				
												<a href="javascript:void(0);" class="btn btn-default btn-sm">View Full Profile</a>
												<div class="checkbox">
													<label>
														<input type="checkbox" value=""><span>Compare</span>
													</label>
												</div>
											</div>
										</div>
										<div class="searchresult_cont">
											<h3><a href="#">Stephen Donner</a></h3>
											<span>Recruiter ID. : 23543</span>
											<hr class="clearfix" />
											<h3><a href="#">Security</a></h3>
											<span>4 Years Experiences</span>
											<span>Las Vegas, Neveda</span>
											<p class="text-right"><a href="#" class="link">Delete</a><a href="#" class="link">Remove</a><a href="#" class="link">Block</a></p>
										</div>
										<div class="clearfix"></div>
									</div>
									<div class="jobsearch_list">
										<span class="back_check"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/backcheck.jpg"></span>
										<div class="thumbnail">
											<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/employer_default.jpg" class="img-responsive">
										</div>
										<div class="post_btns">
											<div class="postbtns_inner">
												<div class="c100 p93 small">
													<span>93%<small>Overall</small></span>
													<div class="slice">
														<div class="bar"></div>
														<div class="fill"></div>
													</div>
												</div>
												<a class="btn btn-primary btn-sm" href="javascript:void(0);">See Quick View</a>				
												<a href="javascript:void(0);" class="btn btn-default btn-sm">View Full Profile</a>
												<div class="checkbox">
													<label>
														<input type="checkbox" value=""><span>Compare</span>
													</label>
												</div>
											</div>
										</div>
										<div class="searchresult_cont">
											<h3><a href="#">Stephen Donner</a></h3>
											<span>Recruiter ID. : 23543</span>
											<hr class="clearfix" />
											<h3><a href="#">Security</a></h3>
											<span>4 Years Experiences</span>
											<span>Las Vegas, Neveda</span>
											<p class="text-right"><a href="#" class="link">Delete</a><a href="#" class="link">Remove</a><a href="#" class="link">Block</a></p>
										</div>
										<div class="clearfix"></div>
									</div>
									<div class="jobsearch_list">
										<span class="back_check"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/backcheck.jpg"></span>
										<div class="thumbnail">
											<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/employer_default.jpg" class="img-responsive">
										</div>
										<div class="post_btns">
											<div class="postbtns_inner">
												<div class="c100 p93 small">
													<span>93%<small>Overall</small></span>
													<div class="slice">
														<div class="bar"></div>
														<div class="fill"></div>
													</div>
												</div>
												<a class="btn btn-primary btn-sm" href="javascript:void(0);">See Quick View</a>				
												<a href="javascript:void(0);" class="btn btn-default btn-sm">View Full Profile</a>
												<div class="checkbox">
													<label>
														<input type="checkbox" value=""><span>Compare</span>
													</label>
												</div>
											</div>
										</div>
										<div class="searchresult_cont">
											<h3><a href="#">Stephen Donner</a></h3>
											<span>Recruiter ID. : 23543</span>
											<hr class="clearfix" />
											<h3><a href="#">Security</a></h3>
											<span>4 Years Experiences</span>
											<span>Las Vegas, Neveda</span>
											<p class="text-right"><a href="#" class="link">Delete</a><a href="#" class="link">Remove</a><a href="#" class="link">Block</a></p>
										</div>
										<div class="clearfix"></div>
									</div>
									<div class="jobsearch_list">
										<span class="back_check"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/backcheck.jpg"></span>
										<div class="thumbnail">
											<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/employer_default.jpg" class="img-responsive">
										</div>
										<div class="post_btns">
											<div class="postbtns_inner">
												<div class="c100 p93 small">
													<span>93%<small>Overall</small></span>
													<div class="slice">
														<div class="bar"></div>
														<div class="fill"></div>
													</div>
												</div>
												<a class="btn btn-primary btn-sm" href="javascript:void(0);">See Quick View</a>				
												<a href="javascript:void(0);" class="btn btn-default btn-sm">View Full Profile</a>
												<div class="checkbox">
													<label>
														<input type="checkbox" value=""><span>Compare</span>
													</label>
												</div>
											</div>
										</div>
										<div class="searchresult_cont">
											<h3><a href="#">Stephen Donner</a></h3>
											<span>Recruiter ID. : 23543</span>
											<hr class="clearfix" />
											<h3><a href="#">Security</a></h3>
											<span>4 Years Experiences</span>
											<span>Las Vegas, Neveda</span>
											<p class="text-right"><a href="#" class="link">Delete</a><a href="#" class="link">Remove</a><a href="#" class="link">Block</a></p>
										</div>
										<div class="clearfix"></div>
									</div>
									<div class="jobsearch_list">
										<span class="back_check"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/backcheck.jpg"></span>
										<div class="thumbnail">
											<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/employer_default.jpg" class="img-responsive">
										</div>
										<div class="post_btns">
											<div class="postbtns_inner">
												<div class="c100 p93 small">
													<span>93%<small>Overall</small></span>
													<div class="slice">
														<div class="bar"></div>
														<div class="fill"></div>
													</div>
												</div>
												<a class="btn btn-primary btn-sm" href="javascript:void(0);">See Quick View</a>				
												<a href="javascript:void(0);" class="btn btn-default btn-sm">View Full Profile</a>
												<div class="checkbox">
													<label>
														<input type="checkbox" value=""><span>Compare</span>
													</label>
												</div>
											</div>
										</div>
										<div class="searchresult_cont">
											<h3><a href="#">Stephen Donner</a></h3>
											<span>Recruiter ID. : 23543</span>
											<hr class="clearfix" />
											<h3><a href="#">Security</a></h3>
											<span>4 Years Experiences</span>
											<span>Las Vegas, Neveda</span>
											<p class="text-right"><a href="#" class="link">Delete</a><a href="#" class="link">Remove</a><a href="#" class="link">Block</a></p>
										</div>
										<div class="clearfix"></div>
									</div>
									<div class="jobsearch_list">
										<span class="back_check"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/backcheck.jpg"></span>
										<div class="thumbnail">
											<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/employer_default.jpg" class="img-responsive">
										</div>
										<div class="post_btns">
											<div class="postbtns_inner">
												<div class="c100 p93 small">
													<span>93%<small>Overall</small></span>
													<div class="slice">
														<div class="bar"></div>
														<div class="fill"></div>
													</div>
												</div>
												<a class="btn btn-primary btn-sm" href="javascript:void(0);">See Quick View</a>				
												<a href="javascript:void(0);" class="btn btn-default btn-sm">View Full Profile</a>
												<div class="checkbox">
													<label>
														<input type="checkbox" value=""><span>Compare</span>
													</label>
												</div>
											</div>
										</div>
										<div class="searchresult_cont">
											<h3><a href="#">Stephen Donner</a></h3>
											<span>Recruiter ID. : 23543</span>
											<hr class="clearfix" />
											<h3><a href="#">Security</a></h3>
											<span>4 Years Experiences</span>
											<span>Las Vegas, Neveda</span>
											<p class="text-right"><a href="#" class="link">Delete</a><a href="#" class="link">Remove</a><a href="#" class="link">Block</a></p>
										</div>
										<div class="clearfix"></div>
									</div>
									<div class="jobsearch_list">
										<span class="back_check"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/backcheck.jpg"></span>
										<div class="thumbnail">
											<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/employer_default.jpg" class="img-responsive">
										</div>
										<div class="post_btns">
											<div class="postbtns_inner">
												<div class="c100 p93 small">
													<span>93%<small>Overall</small></span>
													<div class="slice">
														<div class="bar"></div>
														<div class="fill"></div>
													</div>
												</div>
												<a class="btn btn-primary btn-sm" href="javascript:void(0);">See Quick View</a>				
												<a href="javascript:void(0);" class="btn btn-default btn-sm">View Full Profile</a>
												<div class="checkbox">
													<label>
														<input type="checkbox" value=""><span>Compare</span>
													</label>
												</div>
											</div>
										</div>
										<div class="searchresult_cont">
											<h3><a href="#">Stephen Donner</a></h3>
											<span>Recruiter ID. : 23543</span>
											<hr class="clearfix" />
											<h3><a href="#">Security</a></h3>
											<span>4 Years Experiences</span>
											<span>Las Vegas, Neveda</span>
											<p class="text-right"><a href="#" class="link">Delete</a><a href="#" class="link">Remove</a><a href="#" class="link">Block</a></p>
										</div>
										<div class="clearfix"></div>
									</div>
								</div>
								<div id="jobpaginationDiv" class="paginationDiv text-center"><a class="active" data-page="1" href="javascript:void(0);">1</a><a class="load_more_jobs1" data-page="2" href="javascript:void(0);">2</a><a class="load_more_jobs1" data-page="3" href="javascript:void(0);">3</a><a class="load_more_jobs1" data-page="4" href="javascript:void(0);">4</a></div>
								<div class="search_bar text-left">
									<p>You are viewing : <span>25-48</span></p>
								</div>
							</div>
						</div>
						<div class="col-lg-3 col-md-6 col-lg-pull-6 col-md-pull-0">
							<div class="sidebar">
								<div class="light_box sk_searches">
									<div class="sksearches_bx">
										<div class="form-group has-feedback">
											<label for="country_select">Saved Searches</label>
											<select class="form-control">
												<option>Please Select</option>
												<option>Security</option>
												<option>Investigations</option>
												<option>Active in past 365 days</option>
												<option>Distance</option>
											</select>
											<span class="fa fa-angle-down form-control-feedback" aria-hidden="true"></span>
										</div>
										<a href="#" class="link">Save Search</a> <a href="#" class="link pull-right">Clear All</a>
									</div>
									<hr class="clearfix" />
									<div class="sksearches_bx">
										<div class="form-group has-feedback">
											<label for="country_select">Keyword Search</label>
											<div class="input-group">
												<input type="text" class="form-control" placeholder="Money Laundering">
												<span class="input-group-btn">
													<button class="btn btn-primary" type="button"><i class="fa fa-search"></i></button>
												</span>
											</div>
										</div>
										<p>Keywords search terms bound within profiles.</p>
										<a href="#" class="link pull-right">Clear Search</a>
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="advance_searchbx light_box">
									<div class="sidebar_title">
										<h4>Advanced Search Options</h4>
									</div>

									<div class="form">
										<div class="form-group has-feedback">
											<label for="search_region">Location</label>
											<select class="form-control" name="search_region">
												<option class="level-0" value="">Any Location</option>
												<option value="179">Boca Raton</option>
												<option value="180">Boyton Beach</option>
												<option value="166">Florida</option>
												<option value="167">Ft Lauderdale</option>
												<option value="170">Jacksonville</option>
												<option value="168">Miami / Dade</option>
												<option value="174">Naples</option>
												<option value="172">Orlando</option>
												<option value="173">Palm Beach</option>
												<option value="171">Tallahassee</option>
												<option value="169">Tampa / St. Petersburg</option>
												<option value="27">United States</option>
											</select>
											<span class="fa fa-angle-down form-control-feedback" aria-hidden="true"></span>
											<!--  <input name="search_region" type="text" class="form-control" id="location_input" placeholder="Location"> -->
										</div>
										<div class="form-group has-feedback">
											<label for="distance_region">Distance</label>
											<select class="form-control" name="distance_region">
												<option>Up to 20 Miles</option>
												<option>Up to 50 Miles</option>
												<option>Up to 100 Miles</option>
												<option>Anywhere</option>
											</select>
											<span class="fa fa-angle-down form-control-feedback" aria-hidden="true"></span>
										</div>
										<div class="form-group has-feedback">
											<label for="country_select">Minimum Education Level:</label>
											<select class="form-control">
												<option>All Levels</option>
												<option>Level 1</option>
												<option>Level 2</option>
												<option>Level 3</option>
											</select>
											<span class="fa fa-angle-down form-control-feedback" aria-hidden="true"></span>
										</div>
										<div class="form-group has-feedback">
											<label for="country_select">Minimum Career Level:</label>
											<select class="form-control">
												<option>All Levels</option>
												<option>Level 1</option>
												<option>Level 2</option>
												<option>Level 3</option>
											</select>
											<span class="fa fa-angle-down form-control-feedback" aria-hidden="true"></span>
										</div>
										<div class="form-group has-feedback">
											<label for="country_select">Minimum Experience Level:</label>
											<select class="form-control">
												<option>All Levels</option>
												<option>Level 1</option>
												<option>Level 2</option>
												<option>Level 3</option>
											</select>
											<span class="fa fa-angle-down form-control-feedback" aria-hidden="true"></span>
										</div>
										<div class="form-group has-feedback">
											<label for="country_select">Spoken Language:</label>
											<select class="form-control">
												<option>All Languages</option>
												<option>English US</option>
												<option>English UK</option>
												<option>Spanish</option>
											</select>
											<span class="fa fa-angle-down form-control-feedback" aria-hidden="true"></span>
										</div>
										<div class="form-group has-feedback">
											<label for="country_select">Resume Last Updated:</label>
											<select class="form-control">
												<option>All Updates</option>
												<option>10/10/2016</option>
												<option>10/15/2016</option>
												<option>10/20/2016</option>
											</select>
											<span class="fa fa-angle-down form-control-feedback" aria-hidden="true"></span>
										</div>
										<div class="form-group has-feedback">
											<label for="country_select">Opportunity Type:</label>
											<select class="form-control">
												<option>All Available/Adcancements</option>
												<option>10/10/2016</option>
												<option>10/15/2016</option>
												<option>10/20/2016</option>
											</select>
											<span class="fa fa-angle-down form-control-feedback" aria-hidden="true"></span>
										</div>
										<div class="form-group has-feedback">
											<label for="country_select">Work Authorization:</label>
											<select class="form-control">
												<option>All Authorization</option>
												<option>ABC Security Services</option>
												<option>Miami Security</option>
												<option>E-lite Investigations</option>
											</select>
											<span class="fa fa-angle-down form-control-feedback" aria-hidden="true"></span>
										</div>
										<div class="form-group has-feedback">
											<label for="country_select">Profile Activity:</label>
											<select class="form-control">
												<option>Past 365 days</option>
												<option>Past 730 days</option>
											</select>
											<span class="fa fa-angle-down form-control-feedback" aria-hidden="true"></span>
										</div>
										<div class="form-group has-feedback">
											<label for="country_select">Country:</label>
											<select class="form-control">
												<option>All Country</option>
												<option>United States</option>
											</select>
											<span class="fa fa-angle-down form-control-feedback" aria-hidden="true"></span>
										</div>
										<div class="form-group has-feedback">
											<label for="country_select">Compensation Level:</label>
											<select class="form-control">
												<option>All Levels</option>
												<option>Level 1</option>
												<option>Level 2</option>
												<option>Level 3</option>
											</select>
											<span class="fa fa-angle-down form-control-feedback" aria-hidden="true"></span>
										</div>
										<div class="form-group has-feedback">
											<label for="country_select">Armed Services Experience:</label>
											<select class="form-control">
												<option>Any Experience</option>
												<option>Option 1</option>
												<option>Option 2</option>
												<option>Option 3</option>
											</select>
											<span class="fa fa-angle-down form-control-feedback" aria-hidden="true"></span>
										</div>
										<div class="form-group has-feedback">
											<label for="country_select">Law Entercement Experience:</label>
											<select class="form-control">
												<option>Any Experience</option>
												<option>Option 1</option>
												<option>Option 2</option>
												<option>Option 3</option>
											</select>
											<span class="fa fa-angle-down form-control-feedback" aria-hidden="true"></span>
										</div>
										<div class="form-group has-feedback">
											<label for="country_select">Federal Agency Experience:</label>
											<select class="form-control">
												<option>Any Experience</option>
												<option>Option 1</option>
												<option>Option 2</option>
												<option>Option 3</option>
											</select>
											<span class="fa fa-angle-down form-control-feedback" aria-hidden="true"></span>
										</div>
										<div class="form-group has-feedback">
											<label for="country_select">Security Clearance:</label>
											<select class="form-control">
												<option>Any Clearance</option>
												<option>Option 1</option>
												<option>Option 2</option>
												<option>Option 3</option>
											</select>
											<span class="fa fa-angle-down form-control-feedback" aria-hidden="true"></span>
										</div>
										<div class="text-center">
											<button type="submit" class="btn btn-primary btn-sm">Reset Filters</button>
										</div>
									</div>						
								</div>
							</div>
						</div>
						<div class="col-lg-3 col-md-6">
							<div class="sidebar right_sidebar">
								<div class="light_box tips">
									<div class="sidebar_title">
										<span class="title_icon tips_icon"></span>
										<h4><a href="<?php echo site_url();  ?>/tips/tips-424/">Search Tips</a></h4>
									</div>
									<p>The tips will be something to catch the users eye and get them to think about something or to take an action and do something. This will also be something that is done from the admin Dashboard side.</p>
								</div>
								<div class="light_box quick_links areas_represented">
									<div class="sidebar_title">
										<h4>Top Areas Represented</h4>
									</div>
									<ul class="quick_links_cat">
										<li><a href="#">Miami <span>235</span></a></li>
										<li><a href="#">Fort Lauderdale <span>212</span></a></li>
										<li><a href="#">Doral <span>207</span></a></li>
										<li><a href="#">Palm Beach <span>201</span></a></li>
										<li><a href="#">Tampa Bay <span>195</span></a></li>
										<li><a href="#">Irvine <span>185</span></a></li>
										<li><a href="#">Washington DC <span>177</span></a></li>
										<li><a href="#">New York <span>101</span></a></li>
									</ul>
									<div class="text-right">
										<a href="#" class="link"><i class="fa fa-angle-double-left"></i> <em>See More</em> <i class="fa fa-angle-double-right"></i></a>
									</div>
								</div>
								<div class="light_box lastviewed_bx">
									<div class="sidebar_title" id="quickCategory">
										<h4>Last Viewed</h4>
									</div>
									<div class="jobsearch_list">
										<div class="viewed_left">
											<div class="thumbnail">
												<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/employer_default.jpg" class="img-responsive">
											</div>
											<span class="back_check"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/backcheck.jpg"></span>
											<div class="c100 p93 small">
												<span>93%<small>Overall</small></span>
												<div class="slice">
													<div class="bar"></div>
													<div class="fill"></div>
												</div>
											</div>
										</div>
										<div class="viewed_cont">
											<div class="searchresult_cont">
												<h3><a href="#">Stephen Donner</a></h3>
												<span>Recruiter ID. : 23543</span>
												<hr class="clearfix" />
												<h3><a href="#">Security</a></h3>
												<span>4 Years Experiences</span>
												<span>Las Vegas, Neveda</span>
												<p><a href="#" class="link">Delete</a><a href="#" class="link">Remove</a><a href="#" class="link">Block</a></p>
												<hr class="clearfix" />
											</div>
											<div class="postbtns_inner">
												<a class="btn btn-primary btn-sm" href="javascript:void(0);">See Quick View</a>				
												<a href="javascript:void(0);" class="btn btn-default btn-sm">View Full Profile</a>
												<div class="checkbox">
													<label>
														<input type="checkbox" value=""><span>Compare</span>
													</label>
												</div>
											</div>
										</div>
									</div>
									<div class="jobsearch_list">
										<div class="viewed_left">
											<div class="thumbnail">
												<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/employer_default.jpg" class="img-responsive">
											</div>
											<span class="back_check"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/backcheck.jpg"></span>
											<div class="c100 p93 small">
												<span>93%<small>Overall</small></span>
												<div class="slice">
													<div class="bar"></div>
													<div class="fill"></div>
												</div>
											</div>
										</div>
										<div class="viewed_cont">
											<div class="searchresult_cont">
												<h3><a href="#">Stephen Donner</a></h3>
												<span>Recruiter ID. : 23543</span>
												<hr class="clearfix" />
												<h3><a href="#">Security</a></h3>
												<span>4 Years Experiences</span>
												<span>Las Vegas, Neveda</span>
												<p><a href="#" class="link">Delete</a><a href="#" class="link">Remove</a><a href="#" class="link">Block</a></p>
												<hr class="clearfix" />
											</div>
											<div class="postbtns_inner">
												<a class="btn btn-primary btn-sm" href="javascript:void(0);">See Quick View</a>				
												<a href="javascript:void(0);" class="btn btn-default btn-sm">View Full Profile</a>
												<div class="checkbox">
													<label>
														<input type="checkbox" value=""><span>Compare</span>
													</label>
												</div>
											</div>
										</div>
									</div>
									<div class="text-right">
										<a href="#" class="link"><i class="fa fa-angle-double-left"></i> <em>Show All</em> <i class="fa fa-angle-double-right"></i></a>
									</div>
								</div>

								<?php
								if(is_active_sidebar('ad_search_candidate_page')){
									dynamic_sidebar('ad_search_candidate_page');
								}
								?>
							</div>
								
								<div class="light_box recruiter_box">
									<h3>Your Recruiter</h3>
									<div class="thumbnail"><img src="<?php echo site_url();  ?>/assets/uploads/2016/09/recruiter.jpg" class="img-responsive">
										<p>How can I be of service?</p>
									</div>
									<h5>Christopher R. Bauer</h5>
									<a href="javascript:void(0);" data-target="#sendamail" data-toggle="modal">Contact Now</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div><!-- #content -->

		<?php do_action( 'jobify_loop_after' ); ?>
	</div><!-- #primary -->

<?php endwhile; ?>

<?php get_footer('assessment'); ?>