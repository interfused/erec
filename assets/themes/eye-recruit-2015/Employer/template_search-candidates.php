<?php
/**
 * Template Name: Employers jobseeker search page
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Jobify
 * @since Jobify 1.0
 */


get_header(); 

?>
	<?php while ( have_posts() ) : the_post(); ?>

	<header class="page-header">
		<h1 class="page-title"><?php //the_title(); ?>Dive in the talent Pool</h1>
	</header>
	<div class="filter_loader loader inner-loader" id="loaders" ></div>
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
									  <input type="checkbox" id="industrysearch1"  name="BEST_INDUSTRY[]" value="Security"> <span>Security</span>
									</label>
									<label class="checkbox-inline">
									  <input type="checkbox" id="industrysearch2"  name="BEST_INDUSTRY[]" value="Investigation"> <span>Investigations</span>
									</label>
									<label class="checkbox-inline">
									  <input type="checkbox" id="industrysearch3"  name="BEST_INDUSTRY[]" value="Surveillance"> <span>Surveillance</span>
									</label>
									<label class="checkbox-inline">
									  <input type="checkbox" id="industrysearch4"  name="BEST_INDUSTRY[]" value="Loss Prevention"> <span>Loss Prevention</span>
									</label>
									<label class="checkbox-inline">
									  <input type="checkbox" id="industrysearch5"  name="BEST_INDUSTRY[]" value="Risk Management"> <span>Risk Management</span>
									</label>
									<label class="checkbox-inline">
									  <input type="checkbox" id="industrysearch6"  name="BEST_INDUSTRY[]" value="Information Technology"> <span>Information Technology</span>
									</label>
									<label class="checkbox-inline">
									  <input type="checkbox" id="industrysearch7"  name="BEST_INDUSTRY[]" value="Investigative Journalist"> <span>Investigative Journalism</span>
									</label>
									<label class="checkbox-inline">
									  <input type="checkbox" id="industrysearch8"  name="BEST_INDUSTRY[]" value="Operations Management"> <span>Operations Management</span>
									</label>
									<label class="checkbox-inline">
									  <input type="checkbox" id="industrysearch9"  name="BEST_INDUSTRY[]" value="Marketing & Sales"> <span>Marketing & Sales</span>
									</label>
									<label class="checkbox-inline">
									  <input type="checkbox" id="industrysearch10" name="BEST_INDUSTRY[]"  value="Support Staff"> <span>Support Staff</span>
									</label>
									<label class="checkbox-inline">
									  <input type="checkbox" id="industrysearch11" name="BEST_INDUSTRYAll"  value="All"> <span>Search All Sector</span>
									</label>
								</div>
							</div>
							<div class="col-md-5">
								<h3>In what zip code would you like to search?</h3>
								<div class="form-group">
									<div class="input-group">
										<input class="form-control" name="SEEKER_ZIP_CODE" id="SEEKER_ZIP_CODE" type="text">
										<span class="input-group-btn">
										<button class="btn btn-primary" id="buttonZipCode" type="button"><i class="fa fa-search"></i></button>
										</span>
									</div>
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
								<span class="text-warning"><a href="javascript:void(0);" id="getrss" > <i class="fa fa-rss" aria-hidden="true"></i> RSS</a> </span>
							</div>

							<div class="search_bar">
								<?php 
									$WP_User_Query_Args = array();

									$profi_visi = get_cimyFieldValue(false, 'PROFILE_VISIBILITY');
									$excludeID = array();
									foreach ($profi_visi as $value) {
										$fieldvalue = cimy_uef_sanitize_content($value['VALUE']);
										if ( ($fieldvalue == 'Open') || ($fieldvalue == 'Private') ) {
											$excludeID[] = $value['user_id'];
											
										}
									}
									$WP_User_Query_Args['exclude'] = $excludeID;
									$WP_User_Query_Args['role'] = 'candidate';
									$WP_User_Query_Args['fields'] = 'all';
									$WP_User_Query_Args['order'] = 'DESC';
									$user_query = new WP_User_Query( $WP_User_Query_Args);
									$queryTotal = $user_query->get_total();
								?>
								<p>Your query has located : <span id="countMyBookmarks" count="3"><?php  echo $queryTotal; ?> results </span></p>
								<hr class="clearfix" />
							</div>
							<div id="seekerListing"  class="employer_search job_listings">
								<div class="job_listing">
									<?php   
									$themeurl = get_stylesheet_directory_uri();
									$authors = $user_query->get_results();

									$totalUserCount = 0;
									$totalPageCount = 0;
									echo "<div class='page_stap view_page_stap0'>";
									if (!empty($authors)) {
										foreach ($authors as $author){
									    	$author_info = get_userdata($author->ID); 
									    	$totalPer = job_seeker_profile_com_status($author->ID);
									    	$allwoPhoto = get_cimyFieldValue($author->ID, 'PNA_PHOTOGRAPH'); 
									    	if ( $totalUserCount % 10 == 0) { $totalPageCount++;  ?>
									    		</div><div class='page_stap view_page_stap<?php echo $totalPageCount ?>' <?php echo (($totalPageCount != 1)) ? 'style="display:none;"' : ''; ?> >
									    	<?php } ?>
									    	<div class="jobsearch_list">
												<span class="back_check"><img src="<?php echo $themeurl; ?>/img/backcheck.jpg"></span>
												<div class="thumbnail">
													<?php
														if (  ($allwoPhoto != 'No') ) {
															echo do_shortcode('[ica_avatar uid="'.$author_info->ID.'"]');
														}else{
															?>
															<img src="<?php echo $themeurl; ?>/img/employer_default.jpg" class="img-responsive">
															<?php
														}
													?>
												</div>
												<div class="post_btns">
													<div class="postbtns_inner">
														<div class="c100 p<?php echo $totalPer; ?> small">
										                    <span><?php echo $totalPer; ?>%<small>Overall</small></span>
										                    <div class="slice">
										                        <div class="bar"></div>
										                        <div class="fill"></div>
										                    </div>
										                </div>
														<a class="btn btn-primary btn-sm" target="_blank" href="<?php echo site_url(); ?>/job-seekers/quick-view/?recruiterid=<?php echo $author_info->ID; ?>">See Quick View</a>				
														
														<?php
															$employer_id =  get_current_user_id();
															$userdata = get_userdata($employer_id);

															if( in_array('administrator', $userdata->roles) ){	
																$Reurl = '/employers/redacted-recruiter-quick-view/';
															}
															else{
																$Reurl = '/job-seekers/redacted-employer-quick-view/';
															}
														?>

														<a href="<?php echo site_url().$Reurl; ?>?recruitID=<?php echo $author_info->ID; ?>" class="btn btn-default btn-sm">View Full Profile</a>
														<div class="checkbox">
														  <label>
														    <input type="checkbox" value=""><span>Compare</span>
														  </label>
														</div>
													</div>
												</div>
												<div class="searchresult_cont">
													<h3><a href="<?php echo site_url(); ?>/job-seekers/quick-view/?recruiterid=<?php echo $author_info->ID; ?>" target="_blank"><?php echo $author_info->first_name . ' ' . $author_info->last_name; ?></a></h3>
													<span>Recruiter ID. : <?php echo $author_info->ID;  ?></span>
													<hr class="clearfix" />
													<h3><a href="javascript:void(0);"><?php  echo get_cimyFieldValue($author_info->ID,'BEST_INDUSTRY'); ?></a></h3>
													<span><?php  echo get_cimyFieldValue($author_info->ID,'INDUSTRY_YEARS'); ?></span>
													<span><?php  echo get_cimyFieldValue($author_info->ID,'MAJOR_METROPOLITAN'); ?></span>
													<p class="text-right"><a href="javascript:void(0);" class="link">Delete</a><a href="javascript:void(0);" class="link">Remove</a><a href="javascript:void(0);" class="link">Block</a></p>
												</div>
												<div class="clearfix"></div>
											</div>   
										    <?php    
										    $totalUserCount++;
									    }  
									}
									else{
									    echo 'No candidate found';
									}
								    echo "</div>";
									?>
								</div>
								<div class="clearfix gap-md"></div>
								<?php if ( $queryTotal > 10  ) { ?>
						    		<div class="paginationDiv text-center">
										<?php
										$pageno = ceil($queryTotal/10);
										for ($i=1; $i<=$pageno; $i++) { ?>
											<a href="javascript:void(0);" data-step="<?php echo $i; ?>" class="view_this_step <?php echo (($i == 1)) ? 'active' : ''; ?>"><?php echo $i; ?></a>
										<?php } ?>
						    		</div>
								<?php } ?>
							</div>
						</div>
						<div class="col-lg-3 col-md-6 col-lg-pull-6 col-md-pull-0">
							<?php get_template_part('seeker_search_sidebar/content', 'search_left_sidebar'); ?>
						</div>
						<div class="col-lg-3 col-md-6">
							<?php get_template_part('seeker_search_sidebar/content', 'search_right_sidebar'); ?>
						</div>
					</div>
				</div>
			</section>
		</div><!-- #content -->

		<?php do_action( 'jobify_loop_after' ); ?>
	</div><!-- #primary -->

	<?php endwhile; ?>

<?php get_footer('assessment'); ?>

<script type="text/javascript">
	jQuery(document).ready( function() {

		jQuery('.view_page_stap0').remove();

		setTimeout(function(){
			jQuery('#loaders').hide();
			jQuery('html, body').animate({
		        scrollTop: jQuery('.section_title').offset().top - 300
		    }, 500);
		},1500);

		jQuery('#seekerListing').on('click', '.view_this_step', function() {
			var _this = jQuery(this);
			if ( jQuery(this).hasClass('active') ) {
				return false;
			}
			jQuery('#loaders').show();
			setTimeout(function(){
				var step = _this.data('step');
				jQuery('.view_this_step').removeClass('active');
				_this.addClass('active');
				jQuery('#loaders').hide();
				jQuery('.page_stap').hide();
				jQuery('.view_page_stap'+step).show();
				jQuery('html, body').animate({
			        scrollTop: jQuery('.view_page_stap'+step).offset().top - 200
			    }, 500);
			},1500);
		});

		jQuery('.shortByCount').on('click', '.shortcount', function() {
			var _this = jQuery(this);
			jQuery('#loaders').show();
			jQuery('.shortcount').removeClass('active');
			_this.addClass('active');
			jQuery("#advance_searchbx select, #SEEKER_ZIP_CODE, input[name='keyword_search']").val('');
			jQuery('.selectpicker').selectpicker('refresh');
			jQuery('input[name="BEST_INDUSTRY[]"] , input[name="BEST_INDUSTRYAll"]').prop('checked', false);
			var metaval = jQuery(this).attr('metaValue');
			jQuery.ajax({
				type: 'POST',
				url: '<?php echo admin_url("admin-ajax.php"); ?>',
				data: {
					action: 'employee_seeker_filter_ajax', //Action in seeker_search_sidebar/searchAjaxaction.php
					metaval: metaval,
				},
				success: function(res){
					jQuery('#seekerListing').html(res);
					jQuery('#countMyBookmarks').html( jQuery('#getjobseekerlist').attr('totaluser')+' Results' );
					jQuery('#loaders').hide();
					jQuery('html, body').animate({
				        scrollTop: jQuery('.section_title').offset().top - 200
				    }, 500);
				}
			});
		});

		jQuery("#search_link").on('click',function(){
			jQuery("input[name='keyword_search']").val('');
			jQuery('#MAJOR_METROPOLITAN').trigger('change');
		});

		jQuery("#reset_filter").on('click',function(){
			var SEEKER_ZIP_CODE = jQuery('#SEEKER_ZIP_CODE').val();
			var BEST_INDUSTRY = [];
			jQuery('input[name="BEST_INDUSTRY[]"]:checked').each( function() {
				BEST_INDUSTRY.push( jQuery(this).val() );
			});
			if ( (SEEKER_ZIP_CODE == '') || (BEST_INDUSTRY == '') ) {
				jQuery('#warningPopup').modal('show');
				return false;
			}
			else{
				jQuery('#advance_searchbx select').val('');
				jQuery('.selectpicker').selectpicker('refresh');
				jQuery('#MAJOR_METROPOLITAN').trigger('change');	
			}
		});

		jQuery('input[name="BEST_INDUSTRYAll"]').on('click', function(){
			if ( jQuery(this).is(':checked') ) {
				jQuery('input[name="BEST_INDUSTRY[]"]').prop('checked', true);
			}
			else{
				jQuery('input[name="BEST_INDUSTRY[]"]').prop('checked', false);
			}
			jQuery('#loaders').show();
		});

		jQuery('input[name="BEST_INDUSTRY[]"]').on('click', function(){
			if ( jQuery('input[name="BEST_INDUSTRY[]"]:checked').length == jQuery('input[name="BEST_INDUSTRY[]"]').length) {
				jQuery('input[name="BEST_INDUSTRYAll"]').prop('checked', true);
			}
			else{
				jQuery('input[name="BEST_INDUSTRYAll"]').prop('checked', false);
			}
			jQuery('#loaders').show();
		});


		jQuery('.filterValid').change( function() {
			var SEEKER_ZIP_CODE = jQuery('#SEEKER_ZIP_CODE').val();
			var BEST_INDUSTRY = [];
			jQuery('input[name="BEST_INDUSTRY[]"]:checked').each( function() {
				BEST_INDUSTRY.push( jQuery(this).val() );
			});
			if ( (SEEKER_ZIP_CODE == '') || (BEST_INDUSTRY == '') ) {
				jQuery('#warningPopup').modal('show');
			}
			return false;	
		});
		
		jQuery('#buttonKeyword').on('click', function() {
			jQuery('#MAJOR_METROPOLITAN').trigger('change');
		});

		jQuery('#buttonZipCode').on('click', function() {
			jQuery('input[name="BEST_INDUSTRYAll"]').trigger('change');
			jQuery('#loaders').show();
		});


		jQuery('.employee-seeker-filter, #MAJOR_METROPOLITAN, input[name="BEST_INDUSTRY[]"], input[name="BEST_INDUSTRYAll"]').change( function() {
			var SEEKER_ZIP_CODE = jQuery('#SEEKER_ZIP_CODE').val();
			var BEST_INDUSTRY = [];
			jQuery('input[name="BEST_INDUSTRY[]"]:checked').each( function() {
				BEST_INDUSTRY.push( jQuery(this).val() );
			});

			if ( (SEEKER_ZIP_CODE == '') || (BEST_INDUSTRY == '') ) {
				jQuery('input[name="keyword_search"], select').val("");
				jQuery('.selectpicker').selectpicker('refresh');
				var keyword_search, MAJOR_METROPOLITAN, JOB_SEARCH_RADIUS, HIGHEST_EDUCATION, CURR_CAREER_LVL, INDUSTRY_YEARS, list_languages, TYPE_OF_OPPORTUNITY, COMPENSATION_DESIRED, US_ARMED_FORCES_OPTION, US_LAW_ENFORCE_STATU, CLEARANCE_LEVEL, US_ELIGIBLE = "";
			}
			else{
				jQuery('#loaders').show();
				var keyword_search = jQuery('input[name="keyword_search"]').val();
				var MAJOR_METROPOLITAN = jQuery('#MAJOR_METROPOLITAN').val();
				var JOB_SEARCH_RADIUS = jQuery('#JOB_SEARCH_RADIUS').val();
				var HIGHEST_EDUCATION = jQuery('#HIGHEST_EDUCATION').val();
				var CURR_CAREER_LVL = jQuery('#CURR_CAREER_LVL').val();
				var INDUSTRY_YEARS = jQuery('#INDUSTRY_YEARS').val();
				var list_languages = jQuery('#list_languages').val();
				var TYPE_OF_OPPORTUNITY = jQuery('#TYPE_OF_OPPORTUNITY').val();
				var COMPENSATION_DESIRED = jQuery('#COMPENSATION_DESIRED').val();
				var US_ARMED_FORCES_OPTION = jQuery('#US_ARMED_FORCES_OPTION').val();
				var US_LAW_ENFORCE_STATU = jQuery('#US_LAW_ENFORCE_STATU').val();
				var CLEARANCE_LEVEL = jQuery('#CLEARANCE_LEVEL').val();
				var US_ELIGIBLE = jQuery('#US_ELIGIBLE').val();
			}

			jQuery.ajax({
				type: 'POST',
				url: '<?php echo admin_url("admin-ajax.php"); ?>',
				data: {
					action: 'employee_seeker_filter_ajax', //Action in seeker_search_sidebar/searchAjaxaction.php
					keyword_search: keyword_search,
					SEEKER_ZIP_CODE: SEEKER_ZIP_CODE,
					BEST_INDUSTRY: BEST_INDUSTRY,
					MAJOR_METROPOLITAN: MAJOR_METROPOLITAN,
					JOB_SEARCH_RADIUS: JOB_SEARCH_RADIUS,
					HIGHEST_EDUCATION: HIGHEST_EDUCATION,
					CURR_CAREER_LVL: CURR_CAREER_LVL,
					INDUSTRY_YEARS: INDUSTRY_YEARS,
					list_languages: list_languages,
					TYPE_OF_OPPORTUNITY: TYPE_OF_OPPORTUNITY,
					COMPENSATION_DESIRED: COMPENSATION_DESIRED,
					US_ARMED_FORCES_OPTION: US_ARMED_FORCES_OPTION,
					US_LAW_ENFORCE_STATU: US_LAW_ENFORCE_STATU,
					CLEARANCE_LEVEL: CLEARANCE_LEVEL,
					US_ELIGIBLE: US_ELIGIBLE,
				},
				success: function(res){
					jQuery('.shortByCount li').removeClass('active');
					jQuery('#seekerListing').html(res);
					jQuery('#countMyBookmarks').html( jQuery('#getjobseekerlist').attr('totaluser')+' Results' );
					jQuery('#loaders').hide();
					jQuery('html, body').animate({
				        scrollTop: jQuery('.section_title').offset().top - 200
				    }, 500);
				}
			});
		});
	});

	jQuery(window).load(function() {
		jQuery('input[type="text"], select').val("");
		jQuery('input[type="checkbox"]').prop('checked', false);
	});
</script>

<div class="modal fade" id="warningPopup" tabindex="-1" role="dialog" aria-labelledby="warningPopupLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content default-form">
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <img src="<?php echo site_url();  ?>/assets/uploads/2016/04/EyeRecruit.com-logo_3-2.jpg" class="popup_logo">
        <h3>Hold up!</h3>
        <div class="clearfix"></div>
        <form class="text-center">
        	<p class="">Before we can begin to help you narrow your search, we need to know the Industry Sector we need to search and the area by Zip Code. Let’s start there. </p>
        	<button class="btn btn-sm btn-primary" data-dismiss="modal" aria-label="Close" >Close</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade sendamail" id="sendamail" tabindex="-1" role="dialog" aria-labelledby="sendamailLabel">
  <?php echo recrutier_contact_now(); ?>
</div> 