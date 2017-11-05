<?php
/**
* The default template for displaying content. Used for Last Monthly Survey
* @package Jobify
* @since Jobify 1.0
*/
?>
<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/css/bootstrap-select.min.css">
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/bootstrap-select.min.js"></script>
<div class="sidebar sk_search_side">
	<div class="light_box sk_searches">

		<div class="sksearches_bx">
			<div class="form-group has-feedback">
			    <label for="country_select">Saved Searches</label>
			    <select class="form-control selectpicker" name="saved_searches" data-live-search="true">
				  <option value="">Please Select</option>
				  <option value="">Security</option>
				  <option value="">Investigations</option>
				  <option value="">Active in past 365 days</option>
				  <option value="">Distance</option>
				</select>
				<span class="fa fa-angle-down form-control-feedback" aria-hidden="true"></span>
			</div>
			<a href="javascript:void(0);" class="link">Save Search</a> <a href="javascript:void(0);" class="link pull-right">Clear All</a>
		</div>

		<hr class="clearfix" />
		<div class="sksearches_bx">
			<div class="form-group has-feedback">
			    <label for="country_select">Keyword Search</label>
			    <div class="input-group">
			      <input type="text" name="keyword_search" class="form-control" placeholder="Keyword Search">
			      <span class="input-group-btn">
			        <button class="btn btn-primary" id="buttonKeyword" type="button"><i class="fa fa-search"></i></button>
			      </span>
			    </div>
			</div>
			<p>Keywords search terms bound within profiles.</p>
			<a href="javascript:void(0);" class="link pull-right" id="search_link">Clear Search</a>
		</div>

		<div class="clearfix"></div>
	</div>

	<div class="advance_searchbx light_box" id="advance_searchbx">
		<div class="sidebar_title">
			<h4>Advanced Search Options</h4>
		</div>

		<div class="form">
			<div class="form-group has-feedback">
			    <label for="search_region">Location</label>
			    <?php
				$majorM_Arr = array('New York','Los Angeles','Chicago','Houston','Philadelphia','Phoenix','San Antonio','San Diego','Dallas','San Jose','Austin','Jacksonville','San Francisco','Indianapolis','Columbus','Fort Worth','Charlotte','Seattle','Denver','El Paso','Detroit','Washington','Boston','Memphis','Nashville','Portland','Oklahoma City','Las Vegas','Baltimore','Louisville','Milwaukee','Albuquerque','Tucson','Fresno','Sacramento','Kansas City','Long Beach','Mesa','Atlanta','Colorado Springs','Virginia Beach','Raleigh','Omaha','Miami','Oakland','Minneapolis','Tulsa','Wichita','New Orleans','Arlington','Cleveland','Bakersfield','Tampa','Aurora','Honolulu','Anaheim','Santa Ana','Corpus Christi','Riverside','St. Louis','Lexington','Stockton','Pittsburgh','Saint Paul','Anchorage','Cincinnati','Henderson','Greensboro','Plano','Newark','Toledo','Lincoln','Orlando','Chula Vista','Jersey City','Chandler','Fort Wayne','Buffalo','Durham','St. Petersburg','Irvine','Laredo','Lubbock','Madison','Gilbert','Norfolk','Reno','Winston–Salem','Glendale','Hialeah','Garland','Scottsdale','Irving','Chesapeake','North Las Vegas','Fremont','Baton Rouge','Richmond','Boise','San Bernardino','Spokane','Birmingham','Modesto','Des Moines','Rochester','Tacoma','Fontana','Oxnard','Moreno Valley','Fayetteville','Huntington Beach','Yonkers','Montgomery','Amarillo','Little Rock','Akron','Shreveport','Augusta','Grand Rapids','Mobile','Salt Lake City','Huntsville','Tallahassee','Grand Prairie','Overland Park','Knoxville','Worcester','Brownsville','Newport News','Santa Clarita','Port St. Lucie','Providence','Fort Lauderdale','Chattanooga','Tempe','Oceanside','Garden Grove','Rancho Cucamonga','Cape Coral','Santa Rosa','Vancouver','Sioux Falls','Peoria','Ontario','Jackson','Elk Grove','Springfield','Pembroke Pines','Salem','Corona','Eugene','McKinney','Fort Collins','Lancaster','Cary','Palmdale','Hayward','Salinas','Frisco','Pasadena','Macon','Alexandria','Pomona','Lakewood','Sunnyvale','Escondido','Hollywood','Clarksville','Torrance','Rockford','Joliet','Paterson','Bridgeport','Naperville','Savannah','Mesquite','Syracuse','Orange','Fullerton','Killeen','Dayton','McAllen','Bellevue','Miramar','Hampton','West Valley City','Warren','Olathe','Columbia','Thornton','Carrollton','Midland','Charleston','Waco','Sterling Heights','Denton','Cedar Rapids','New Haven','Roseville','Gainesville','Visalia','Coral Springs','Thousand Oaks','Elizabeth','Stamford','Concord','Surprise','Lafayette','Topeka','Kent','Simi Valley','Santa Clara','Murfreesboro','Hartford','Athens','Victorville','Abilene','Vallejo','Berkeley','Norman','Allentown','Evansville','Odessa','Fargo','Beaumont','Independence','Ann Arbor','El Monte','Round Rock','Wilmington','Arvada','Provo','Lansing','Downey','Carlsbad','Costa Mesa','Miami Gardens','Westminster','Clearwater','Fairfield','Elgin','Temecula','West Jordan','Inglewood','Richardson','Lowell','Gresham','Antioch','Cambridge','High Point','Billings','Manchester','Murrieta','Centennial','Ventura','Pueblo','Pearland','Waterbury','West Covina','North Charleston','Everett','College Station','Palm Bay','Pompano Beach','Boulder','Norwalk','West Palm Beach','Broken Arrow','Daly City','Sandy Springs','Burbank','Green Bay','Santa Maria','Wichita Falls','Lakeland','Clovis','Lewisville','Tyler','El Cajon','San Mateo','Rialto','Edison','Davenport','Hillsboro','Woodbridge','Las Cruces','South Bend','Vista','Greeley','Davie','San Angelo','Jurupa Valley','Renton','Other');
			    ?>
		    	<select class="form-control employee-seeker-filter filterValid selectpicker" name="search_region" id="MAJOR_METROPOLITAN" data-live-search="true">
					<option value="">Any Location</option>
					<?php foreach ($majorM_Arr as $value) { ?>
						<option value="<?php echo $value; ?>" ><?php echo $value; ?></option> 
					<?php } ?>
				</select>
				<span class="fa fa-angle-down form-control-feedback" aria-hidden="true"></span>
			   <!--  <input name="search_region" type="text" class="form-control" id="location_input" placeholder="Location"> -->
			</div>

			<div class="form-group has-feedback">
			    <label for="distance_region">Distance</label>
			    <select class="form-control employee-seeker-filter filterValid selectpicker" data-live-search="true" name="distance_region" id="JOB_SEARCH_RADIUS">
				  <option value="">Anywhere</option>
				  <option value="Under 10 miles">Under 10 miles</option>
				  <option value="Under 25 miles">Under 25 miles</option>
				  <option value="Under 50 miles">Under 50 miles</option>
				  <option value="Over 50 miles">Over 50 miles</option>
				</select>
				<span class="fa fa-angle-down form-control-feedback" aria-hidden="true"></span>
			</div>

			<div class="form-group has-feedback">
			    <label for="country_select">Minimum Education Level:</label>
			    <select class="form-control employee-seeker-filter filterValid selectpicker" data-live-search="true" name="education_level" id="HIGHEST_EDUCATION">
				  	<option value="">All Levels</option>
					<option value="Some High School Coursework">Some High School Coursework</option>
					<option value="High school or equivalent">High school or equivalent</option>
					<option value="Certification">Certification</option>
					<option value="Vocational">Vocational</option>
					<option value="Some College Coursework completed">Some College Coursework completed</option>
					<option value="Associates Degree">Associates Degree</option>
					<option value="Bachelors Degree">Bachelors Degree</option>
					<option value="Masters Degree">Masters Degree</option>
					<option value="Doctorate Degree / PhD.">Doctorate Degree / PhD.</option>
				</select>
				<span class="fa fa-angle-down form-control-feedback" aria-hidden="true"></span>
			</div>

			<div class="form-group has-feedback">
			    <label for="country_select">Minimum Career Level:</label>
				<select class="form-control employee-seeker-filter filterValid selectpicker" data-live-search="true" name="CURR_CAREER_LVL" id="CURR_CAREER_LVL">
					<option value="">All Levels</option>
					<option value="Student (High School)">Student (High School)</option> 															
					<option value="Student (College)">Student (College)</option> 															
					<option value="Entry Level">Entry Level</option> 															
					<option value="Experienced (Non-Manager)">Experienced (Non-Manager)</option> 
					<option value="Managerial">Managerial</option> 															
					<option value="Executive">Executive</option> 														
					<option value="Senior Executive">Senior Executive</option> 													
				</select>
				<span class="fa fa-angle-down form-control-feedback" aria-hidden="true"></span>
			</div>

			<div class="form-group has-feedback">
			    <label for="country_select">Minimum Experience Level:</label>
				<select class="form-control employee-seeker-filter filterValid selectpicker" data-live-search="true" name="INDUSTRY_YEARS" id="INDUSTRY_YEARS">
					<option value="">All Levels</option>
					<option value="Less than two years">Less than two years</option> 															
					<option value="Two to four years">Two to four years</option> 															
					<option value="Four to six years">Four to six years</option> 															
					<option value="Six to ten years">Six to ten years</option> 															
					<option value="Ten to fifteen years">Ten to fifteen years</option> 															<option value="Over fifteen years">Over fifteen years</option> 													
				</select>
				<span class="fa fa-angle-down form-control-feedback" aria-hidden="true"></span>
			</div>

			<div class="form-group has-feedback">
			    <label for="country_select">Spoken Language:</label>
			    <?php $lisLArr = array('mandarin' => 'Mandarin','vietnamese' => 'Vietnamese','english' => 'English','javanese' => 'Javanese','spanish' => 'Spanish','tamil' => 'Tamil','hindi' => 'Hindi','Korean' => 'Korean','russian' => 'Russian','turkish' => 'Turkish','arabic' => 'Arabic','telugu' => 'Telugu','portuguese' => 'Portuguese','marathi' => 'Marathi','bengali' => 'Bengali','italian' => 'Italian','french' => 'French','thai' => 'Thai','malay' => 'Malay, Indonesian','burmese' => 'Burmese','german' => 'German','cantonese' => 'Cantonese','japanese' => 'Japanese','kannada' => 'Kannada','farsi' => 'Farsi (Persian)','gujarati' => 'Gujarati','urdu' => 'Urdu','polish' => 'Polish','punjabi' => 'Punjabi','wu' => 'Wu','other' => 'OTHER'); ?>
			    <select class="form-control employee-seeker-filter filterValid selectpicker" data-live-search="true" name="list_languages" id="list_languages">
				  <option value="">All Languages</option>
	    		  <?php foreach ($lisLArr as $key => $value) {  
				 		echo "<option value='".$key."'>".$value."</option>";
				   } ?>
				</select>
				<span class="fa fa-angle-down form-control-feedback" aria-hidden="true"></span>
			</div>

			<div class="form-group has-feedback">
			    <label for="country_select">Resume Last Updated:</label>
			    <select class="form-control selectpicker" data-live-search="true" id="all_updates">
				  <option value="">All Updates</option>
				  <option value="">10/10/2016</option>
				  <option value="">10/15/2016</option>
				  <option value="">10/20/2016</option>
				</select>
				<span class="fa fa-angle-down form-control-feedback" aria-hidden="true"></span>
			</div>

			<div class="form-group has-feedback">
			    <label for="country_select">Opportunity Type:</label>
			    <?php 
				$TO_OppArr = array('Permanent Full Time Employee','Part Time Employee','Short Term Contract','Long-term Contract','All available advancements');
				?>
			    <select class="form-control employee-seeker-filter filterValid selectpicker" data-live-search="true" name="TYPE_OF_OPPORTUNITY" id="TYPE_OF_OPPORTUNITY">
				  	<option value="">All Available</option>
				  	<option class="level-0" value="Permanent Full Time Employee">Full Time</option>
					<option class="level-0" value="Part Time Employee">Part Time</option>
					<option class="level-0" value="Long-term Contract">Contract-Long Term</option>
					<option class="level-0" value="Short Term Contract">Contract-Short Term</option>
					<option class="level-0" value="All available advancements">All available advancements</option>
					<?php /*foreach ($TO_OppArr as $value) { 
						echo '<option value="'.$value.'">'.$value.'</option>';
					}*/ ?>
				</select>
				<span class="fa fa-angle-down form-control-feedback" aria-hidden="true"></span>
			</div>

			<div class="form-group has-feedback">
			    <label for="country_select">Work Authorization:</label>
			    <select class="form-control employee-seeker-filter filterValid selectpicker" data-live-search="true" name="US_ELIGIBLE" id="US_ELIGIBLE">
				  <option value="">All Authorization</option>
				  <option value="Yes">Yes</option>
				  <option value="No">No</option>
				</select>
				<span class="fa fa-angle-down form-control-feedback" aria-hidden="true"></span>
			</div>

			<div class="form-group has-feedback">
			    <label for="country_select">Profile Activity:</label>
			    <select class="form-control selectpicker" data-live-search="true" id="profile_activity">
				  <option value="">Past 365 days</option>
				  <option value="">Past 730 days</option>
				</select>
				<span class="fa fa-angle-down form-control-feedback" aria-hidden="true"></span>
			</div>

			<div class="form-group has-feedback">
			    <label for="country_select">Country:</label>
			    <select class="form-control selectpicker" data-live-search="true" id="country">
				  <option value="">All Country</option>
				  <option value="United States">United States</option>
				</select>
				<span class="fa fa-angle-down form-control-feedback" aria-hidden="true"></span>
			</div>

			<div class="form-group has-feedback">
			    <label for="country_select">Compensation Level:</label>
			    <?php
				$c_Des_Arr = array('Under $40k','$40,001 - $50,000','$50,001 - $60,000','$60,001 - $70,000','$70,001 - $80,000','$80,001 - $90,000','$90,001 - $100,000','$100,001 – $125,000','$125,001 – $150,000','$150,001 - $250,000','$250,001 - $500,000','Over $500k');
				?>
			    <select class="form-control employee-seeker-filter filterValid selectpicker" data-live-search="true" name="COMPENSATION_DESIRED" id="COMPENSATION_DESIRED">
				  <option value="">All Levels</option>
				  <?php
				  foreach ($c_Des_Arr as $value) {
				  	echo "<option value='".$value."'>".$value."</option>";
				  }
				  ?>
				</select>
				<span class="fa fa-angle-down form-control-feedback" aria-hidden="true"></span>
			</div>

			<div class="form-group has-feedback">
			    <label for="country_select">Armed Services Experience:</label>
			    <select class="form-control employee-seeker-filter filterValid selectpicker" data-live-search="true" name="US_ARMED_FORCES_OPTION" id="US_ARMED_FORCES_OPTION">
				  	<option value="">Any Experience</option>
				    <option value="Army">Army</option>
					<option value="Navy">Navy</option>
					<option value="Marine Corps">Marine Corps</option>
					<option value="Air Force">Air Force</option>
					<option value="Coast Guard">Coast Guard</option>
					<option value="National Guard">National Guard</option>
					<option value="Air National Guard">Air National Guard</option>
					<option value="Other">Other</option>
				</select>
				<span class="fa fa-angle-down form-control-feedback" aria-hidden="true"></span>
			</div>

			<div class="form-group has-feedback">
			    <label for="country_select">Federal Agency/Law Entercement Exp:</label>
			    <?php
				$uSleArr = array('Central Intelligence Agency (CIA)','Department of Agriculture (USDA)','United States Forest Service Office of Law Enforcement and Investigations','Office of Inspector General (USDA-OIG)','Department of Commerce (USDOC)','National Oceanic and Atmospheric Administration (NOAA)','Office of Export Enforcement (OEE)','Department of Health and Human Services (HHS)','Food and Drug Administration (FDA)','FDA Office of Criminal Investigations (OCI)','Office of Inspector General (HHS-OIG)','Department of Education (ED)','Office of Inspector General (ED-OIG)','Department of Homeland Security (DHS)','Coast Guard Investigative Service (CGIS)','Citizenship and Immigration Services (CIS)','Immigration and Customs Enforcement / Homeland Security Investigations (ICE/HSI)','Customs and Border Protection (CBP)','United States Secret Service (USSS)','Transportation Security Administration (TSA)','Federal Protective Service (FPS)','Office of Inspector General (DHS-OIG)','Department of the Interior (DOI)','Bureau of Land Management (BLM)','United States Fish and Wildlife Service (USFWS)','United States Park Police (USPP)','National Park Service (NPS)','Bureau of Indian Affairs Police (BIA)','Office of Inspector General (DOI-OIG)','United States Department of Labor (DOL-OIG) – ','Office of Labor Racketeering and Fraud Investigations','Department of Defense (DOD)','Defense Intelligence Agency (DIA)','National Security Agency (NSA)','Defense Security Service (DSS) – non-law enforcement','United States Army Criminal Investigation Command (USACIDC)','United States Army Counterintelligence (Army CI)','Pentagon Force Protection Agency (PFPA)','Naval Criminal Investigative Service (NCIS)','United States Marine Corps Criminal Investigation Division (Marine CID Agent)','Air Force Office of Special Investigations (AFOSI)','Office of Inspector General (DOD-OIG)','Defense Criminal Investigative Service (DCIS)','United States Office of Personnel Management','Federal Investigative Services Division (OPM-FISD)','Office of Inspector General (OPM-OIG)','Department of Justice (DOJ)','Bureau of Alcohol/ Tobacco/ Firearms and Explosives (ATF)','Drug Enforcement Administration (DEA)','Federal Bureau of Investigation (FBI)','United States Marshals Service (USMS)','Office of Inspector General (DOJ-OIG)','Federal Bureau of Prisons (BOP)','Department of State','U.S. Diplomatic Security Service (DSS) (FS-2501)','Office of Inspector General (DOS-OIG)','Department of Transportation (DOT)','Office of Inspector General for the Department of Transportation (DOT-OIG)','Federal Motor Carrier Safety Administration (FMCSA)','Federal Aviation Administration (FAA)','Department of the Treasury','IRS Criminal Investigation Division (IRS-CID)','Alcohol and Tobacco Tax and Trade Bureau (TTB)','United States Mint Police','Bureau of Engraving and Printing Police','Federal Reserve Board Police','Treasury Inspector General for Tax Administration (TIGTA)','Postal Service (USPS)','United States Postal Inspection Service (USPIS – not an Inspector General)','Office of Inspector General (USPS-OIG)','United States Environmental Protection Agency (EPA)','Criminal Investigation Division','Office of Inspector General (EPA-OIG)','OTHER');
			    ?>
			    <select class="form-control employee-seeker-filter filterValid selectpicker" data-live-search="true" name="US_LAW_ENFORCE_STATU" id="US_LAW_ENFORCE_STATU">
				  	<option value="">Any Experience</option>
					<?php foreach ($uSleArr as $value) {
				  		echo '<option value="'.$value.'">'.$value.'</option>';
				  	} ?>
				</select>
				<span class="fa fa-angle-down form-control-feedback" aria-hidden="true"></span>
			</div>

			<div class="form-group has-feedback">
			    <label for="country_select">Security Clearance:</label>
			    <select class="form-control employee-seeker-filter filterValid selectpicker" data-live-search="true" name="CLEARANCE_LEVEL" id="CLEARANCE_LEVEL">
				  <option value="">Any Clearance</option>
				  <option value="Confidential">Confidential</option>
				  <option value="Secret">Secret</option>
				  <option value="Top Secret">Top Secret</option>
				  <!-- <option value="Top Secret/SCI">Top Secret/SCI</option> -->
				  <option value="Intel Agency(NSA /CIA/FBI/etc)">Intel Agency(NSA /CIA/FBI/etc)</option>
				  <option value="Information available on request only">Information available on request only</option>
				</select>
				<span class="fa fa-angle-down form-control-feedback" aria-hidden="true"></span>
			</div>

			<div class="text-center">
				<button type="submit" class="btn btn-primary btn-sm" id="reset_filter">Reset Filters</button>
			</div>
		</div>						
	</div>
</div>