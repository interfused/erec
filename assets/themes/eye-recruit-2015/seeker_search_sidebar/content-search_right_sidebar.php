<?php
/**
* The default template for displaying content. Used for Last Monthly Survey
* @package Jobify
* @since Jobify 1.0
*/

$pageID = get_the_ID();
?>
<div class="sidebar right_sidebar">
	<div class="light_box tips">
		<div class="sidebar_title">
			<span class="title_icon tips_icon"></span>
			<h4><a href="javascript:void(0);">Search Tips</a></h4>
		</div>
		<p>The tips will be something to catch the users eye and get them to think about something or to take an action and do something. This will also be something that is done from the admin Dashboard side.</p>
	</div>
	<div class="light_box quick_links areas_represented">
		<div class="sidebar_title">
			<h4>Top Areas Represented</h4>
		</div>
	
		<ul class="quick_links_cat shortByCount">
		<?php
		$countli = 0;
		$majorM_Arr = array('New York','Los Angeles','Chicago','Houston','Philadelphia','Phoenix','San Antonio','San Diego','Dallas','San Jose','Austin','Jacksonville','San Francisco','Indianapolis','Columbus','Fort Worth','Charlotte','Seattle','Denver','El Paso','Detroit','Washington','Boston','Memphis','Nashville','Portland','Oklahoma City','Las Vegas','Baltimore','Louisville','Milwaukee','Albuquerque','Tucson','Fresno','Sacramento','Kansas City','Long Beach','Mesa','Atlanta','Colorado Springs','Virginia Beach','Raleigh','Omaha','Miami','Oakland','Minneapolis','Tulsa','Wichita','New Orleans','Arlington','Cleveland','Bakersfield','Tampa','Aurora','Honolulu','Anaheim','Santa Ana','Corpus Christi','Riverside','St. Louis','Lexington','Stockton','Pittsburgh','Saint Paul','Anchorage','Cincinnati','Henderson','Greensboro','Plano','Newark','Toledo','Lincoln','Orlando','Chula Vista','Jersey City','Chandler','Fort Wayne','Buffalo','Durham','St. Petersburg','Irvine','Laredo','Lubbock','Madison','Gilbert','Norfolk','Reno','Winston–Salem','Glendale','Hialeah','Garland','Scottsdale','Irving','Chesapeake','North Las Vegas','Fremont','Baton Rouge','Richmond','Boise','San Bernardino','Spokane','Birmingham','Modesto','Des Moines','Rochester','Tacoma','Fontana','Oxnard','Moreno Valley','Fayetteville','Huntington Beach','Yonkers','Montgomery','Amarillo','Little Rock','Akron','Shreveport','Augusta','Grand Rapids','Mobile','Salt Lake City','Huntsville','Tallahassee','Grand Prairie','Overland Park','Knoxville','Worcester','Brownsville','Newport News','Santa Clarita','Port St. Lucie','Providence','Fort Lauderdale','Chattanooga','Tempe','Oceanside','Garden Grove','Rancho Cucamonga','Cape Coral','Santa Rosa','Vancouver','Sioux Falls','Peoria','Ontario','Jackson','Elk Grove','Springfield','Pembroke Pines','Salem','Corona','Eugene','McKinney','Fort Collins','Lancaster','Cary','Palmdale','Hayward','Salinas','Frisco','Pasadena','Macon','Alexandria','Pomona','Lakewood','Sunnyvale','Escondido','Hollywood','Clarksville','Torrance','Rockford','Joliet','Paterson','Bridgeport','Naperville','Savannah','Mesquite','Syracuse','Orange','Fullerton','Killeen','Dayton','McAllen','Bellevue','Miramar','Hampton','West Valley City','Warren','Olathe','Columbia','Thornton','Carrollton','Midland','Charleston','Waco','Sterling Heights','Denton','Cedar Rapids','New Haven','Roseville','Gainesville','Visalia','Coral Springs','Thousand Oaks','Elizabeth','Stamford','Concord','Surprise','Lafayette','Topeka','Kent','Simi Valley','Santa Clara','Murfreesboro','Hartford','Athens','Victorville','Abilene','Vallejo','Berkeley','Norman','Allentown','Evansville','Odessa','Fargo','Beaumont','Independence','Ann Arbor','El Monte','Round Rock','Wilmington','Arvada','Provo','Lansing','Downey','Carlsbad','Costa Mesa','Miami Gardens','Westminster','Clearwater','Fairfield','Elgin','Temecula','West Jordan','Inglewood','Richardson','Lowell','Gresham','Antioch','Cambridge','High Point','Billings','Manchester','Murrieta','Centennial','Ventura','Pueblo','Pearland','Waterbury','West Covina','North Charleston','Everett','College Station','Palm Bay','Pompano Beach','Boulder','Norwalk','West Palm Beach','Broken Arrow','Daly City','Sandy Springs','Burbank','Green Bay','Santa Maria','Wichita Falls','Lakeland','Clovis','Lewisville','Tyler','El Cajon','San Mateo','Rialto','Edison','Davenport','Hillsboro','Woodbridge','Las Cruces','South Bend','Vista','Greeley','Davie','San Angelo','Jurupa Valley','Renton','Other');
		foreach ($majorM_Arr as $value) {
			$metrocity = get_cimyFieldValue(false, 'MAJOR_METROPOLITAN', $value);
			$getcount = count($metrocity);
			$includeID = array();
			foreach ($metrocity as $userId) {
				$userdata = get_userdata($userId['user_id']);
				if ( in_array('candidate', $userdata->roles) ) {
					$includeID[] = $userId['user_id'];
				}
			}

			$profi_visi = get_cimyFieldValue(false, 'PROFILE_VISIBILITY');
			$excludeID = array();
			foreach ($profi_visi as $excludeuser) {
				$fieldvalue = cimy_uef_sanitize_content($excludeuser['VALUE']);
				if ( ($fieldvalue == 'Open') || ($fieldvalue == 'Private') ) {
					$excludeID[] = $excludeuser['user_id'];
				}
			}

			$countUserID = count( array_diff($includeID, $excludeID) );

			if ( $countUserID > 0 ) {
				echo '<li class="shortcount" count="'.$countUserID.'" metaValue="'.$value.'"><a href="javascript:void(0);">'.$value.' <span>'.$countUserID.'</span></a></li>';
			}
		}
		?>
		</ul>
        
        <div class="text-right seeMoreArea" style="display:none;">
          <a href="javascript:void(0);" class="link pull-left aSeePreArea" count="0" style="display:none;"><i class="fa fa-angle-double-left"></i> <em>See Pre</em> <i class="fa fa-angle-double-right"></i></a>
          <a href="javascript:void(0);" class="link linknext" count="1"><i class="fa fa-angle-double-left"></i> <em>See More</em> <i class="fa fa-angle-double-right"></i></a>
       	  <div class="clearfix"></div>
        </div>
        
	    
		<script type="text/javascript">
			jQuery('.shortByCount').find('.shortcount').sort(function(a, b) {
			    return +jQuery(b).attr('count') - +jQuery(a).attr('count');
			}).appendTo(jQuery('.shortByCount'));

			var ct = 1;
			jQuery('.shortByCount .shortcount').each( function() {
				jQuery(this).attr('countli', ct);
				if ( ct > 5 ) {
					jQuery('.seeMoreArea').show();
					jQuery('.seeMoreArea .linknext').addClass('aSeeMoreArea');
					jQuery(this).addClass('hidethis');
				}
				else{
					jQuery(this).addClass('showthis');
				}
				ct++;
			});
			jQuery('.hidethis').hide();

			jQuery('.seeMoreArea').on('click', '.aSeeMoreArea', function() {
				var lilength = jQuery('.shortByCount  li').length;
				var count = jQuery(this).attr('count');
				jQuery('.aSeePreArea').attr('count', count).show();
				count++;
				var nextli = parseInt(count)*5;
				var lastshowli = jQuery( ".shortByCount li.showthis:last" ).attr('countli');
				jQuery('.shortByCount li.showthis').removeClass('showthis').addClass('hidethis');
				for (var i = parseInt(lastshowli)+1; i <= nextli; i++) {
					jQuery('.shortByCount li[countli="'+i+'"]').removeClass('hidethis').addClass('showthis');
				};
				jQuery('.hidethis').hide();
				jQuery('.showthis').show();
				if ( nextli >= lilength ) {
					jQuery('.aSeeMoreArea').hide();
				}
				jQuery(this).attr('count', count);	
			});

			jQuery('.seeMoreArea').on('click', '.aSeePreArea', function() {
				
				var lilength = jQuery('.shortByCount  li').length;
				var count = jQuery(this).attr('count');
				var lastshowli = jQuery( ".aSeeMoreArea" ).attr('count');
				jQuery('.aSeeMoreArea').attr('count', count).show();
				count--;
				var preli = lastshowli*5-5;
				jQuery('.shortByCount li.showthis').removeClass('showthis').addClass('hidethis');
				for (var i = parseInt(preli); i >= preli-4; i--) {
					jQuery('.shortByCount li[countli="'+i+'"]').removeClass('hidethis').addClass('showthis');
				};
				jQuery('.hidethis').hide();
				jQuery('.showthis').show();
				if ( count <= 0 ) {
					jQuery('.aSeePreArea').hide();
				}
				jQuery(this).attr('count', count);	
			});
		</script>

	</div>
	<div class="light_box lastviewed_bx">
		<div class="sidebar_title" id="quickCategory">
			<h4>Last Viewed</h4>
		</div>
			<?php
				global $wpdb;
				$employer_id =  get_current_user_id();
				$view_result =  $wpdb->get_results(" SELECT * FROM eyecuwp_last_view WHERE emp_id = $employer_id ORDER BY date_time DESC");
				
				$includeUserID = array();
				foreach ($view_result as $value) {
					$includeUserID[] = $value->can_id;
				}
				

				$profi_visi = get_cimyFieldValue(false, 'PROFILE_VISIBILITY');
				$excludeID = array();
				foreach ($profi_visi as $value) {
					$fieldvalue = cimy_uef_sanitize_content($value['VALUE']);
					if ( ($fieldvalue == 'Open') || ($fieldvalue == 'Private') ) {
						$excludeID[] = $value['user_id'];
						
					}
				}
				
				$includeUserID = array_diff($includeUserID, $excludeID);

				$WP_User_Query_Args['include'] = $includeUserID;
				$WP_User_Query_Args['role'] = 'candidate';
				$WP_User_Query_Args['fields'] = 'all';
				$WP_User_Query_Args['orderby'] = 'meta_value_num';
				$WP_User_Query_Args['meta_key'] = 'lastviewdbyemp';
				$WP_User_Query_Args['order'] = 'DESC';
				$WP_User_Query_Args['number'] = 2;
				$user_query = new WP_User_Query( $WP_User_Query_Args);

				$authors = $user_query->get_results();
				
				if(!empty($authors) && !empty($view_result)){
					foreach ($authors as  $value) {
						$can_id = $value->ID;
						$can_info = get_userdata($can_id);
						$totalPer = job_seeker_profile_com_status($can_id);
						$industries_years = get_cimyFieldValue($can_id,'INDUSTRY_YEARS');
						$MAJOR_METROPOLITAN = get_cimyFieldValue($can_id,'MAJOR_METROPOLITAN');
						$best_industries = get_cimyFieldValue($can_id,'BEST_INDUSTRY');
						$allwoPhoto = get_cimyFieldValue($can_id, 'PNA_PHOTOGRAPH'); 
						?>
						<div class="jobsearch_list">
							<div class="viewed_left">
								<div class="thumbnail">
									<?php 
									if ( (has_wp_user_avatar($can_id)) && ($allwoPhoto != 'No') ) {
										echo get_wp_user_avatar($can_id); 
									}else{
										?>
										<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/employer_default.jpg">
										<?php
									} ?>
								</div>
								<span class="back_check"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/backcheck.jpg"></span>
								<div class="c100 p<?php echo $totalPer; ?> small">
				                    <span><?php echo $totalPer; ?>%<small>Overall</small></span>
				                    <div class="slice">
				                        <div class="bar"></div>
				                        <div class="fill"></div>
				                    </div>
				                </div>
							</div>
							<div class="viewed_cont">
								<div class="searchresult_cont">
									<?php if ( !empty($can_info->first_name) || !empty($can_info->last_name) ) { ?>
										<h3><a href="<?php echo site_url(); ?>/job-seekers/quick-view/?recruiterid=<?php echo $can_id; ?>" target="_blank"><?php echo $can_info->first_name .' '.$can_info->last_name;  ?></a></h3>
									<?php } ?>
									<span>Recruiter ID. : <?php echo $can_id; ?></span>
									<hr class="clearfix" />
									<h3><?php echo ($best_industries)? '<a href="javascript:void(0);">'.$best_industries.'</a>' : '' ;?></h3>
									<span><?php echo ($MAJOR_METROPOLITAN)? $MAJOR_METROPOLITAN : '' ;?></span>
									<span><?php echo ($industries_years)? $industries_years : '' ;?></span>
									<p><a href="javascript:void(0);" class="link">Delete</a><a href="#" class="link">Remove</a><a href="#" class="link">Block</a></p>
									<hr class="clearfix" />
								</div>
								<div class="postbtns_inner">
									<a class="btn btn-primary btn-sm" href="<?php echo site_url().'/job-seekers/quick-view/?recruiterid='.$can_id; ?>" target="_blank">See Quick View</a>				
									
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
									<a href="<?php echo site_url().$Reurl; ?>?recruitID=<?php echo $can_id; ?>" class="btn btn-default btn-sm">View Full Profile</a>

									<div class="checkbox">
									  <label>
									    <input type="checkbox" value=""><span>Compare</span>
									  </label>
									</div>
								</div>
							</div>
							<div class="clearfix"></div>
						</div>
						<?php
					} ?>
					<div class="text-right">
			          <a href="<?php echo site_url().'/employers/latest-view/'; ?>" class="link"><i class="fa fa-angle-double-left"></i> <em>Show All</em> <i class="fa fa-angle-double-right"></i></a>
			        </div><?php
				}
				else{
					echo "<h4 class='text-center'>There is no latest view.</h4>";
				}
			?>
	</div>
	<?php 
	/*$add = get_post_meta($pageID, 'right_side_ad', true);
	echo do_shortcode($add);*/
	?>
	<?php
	if(is_active_sidebar('ad_search_candidate_page')){
		dynamic_sidebar('ad_search_candidate_page');
	}
	?>

	<!-- <div class="codeneric_ultimate_ads_manager_ad_wrapper" data-js="false" data-id="4559">
		<div style="text-align:center;" data-reactid=".1">
			<a class="codeneric_uam_link" target="_blank" href="https://www.google.co.in" title="" data-reactid=".1.0">
				<img class="codeneric_uam_image" src="<?php //echo get_stylesheet_directory_uri(); ?>/img/ad1.jpg" data-reactid=".1.0.0">
			</a>
		</div>
	</div> -->
    <div class="light_box recruiter_box">
		<h3>Your Recruiter</h3>
		<div class="thumbnail"><img src="<?php echo site_url();  ?>/assets/uploads/2016/09/recruiter.jpg" class="img-responsive">
			<p>How can I be of service?</p>
		</div>
		<h5>Christopher R. Bauer</h5>
		<a href="javascript:void(0);" data-target="#sendamail" data-toggle="modal">Contact Now</a>
	</div>
</div>