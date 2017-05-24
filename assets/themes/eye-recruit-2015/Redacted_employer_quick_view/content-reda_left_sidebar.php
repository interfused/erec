<?php
/**
* The default template for displaying content. Used for Last Monthly Survey
* @package Jobify
* @since Jobify 1.0
*/
?>
<?php 
$user_id = $_REQUEST['recruitID'];
//$user_id  = 165;
?>
<div class="sidebar">

                            	<div class="light_box snap_shot ata_glance">
									<div class="sidebar_title">
										<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/ata_glance.jpg" class="title_icon">
										<h4>At a Glance</h4>
									</div>
									<ul>
										<li><span>Candidate Search Status :</span>Actively looking for the right opportunity</li>
										<li><span>Industory Sector :</span>Investigations</li>
										<li><span>Years of industry Experience :</span>Over 15 years</li>
										<li><span>Highest level of Education :</span>Masters Degree</li>
										<li><span>Current Career Level :</span>Executive</li>
										<li><span>Current Income Range :</span>$150,000 - $250,000 Annually</li>
										<li>
											<div class="glance_icons">
                                                <a href="javascript:void(0);" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" data-placement="top" data-container="body" data-content=""><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/clearance_icon.png"></a>
                                                <div class="mypopover">
                                                    <a href="#" class="close_popover">x</a>
                                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/clearance_icon.png">
                                                    <h4>Disclaimer</h4>
                                                    <div class="clearfix"></div>
                                                    <small>Information has not been confirmed or deemed accurate by EyeRecruit, Inc. to be factual.</small>
                                                </div>
                                            </div>
											<span>Desired Income Range :</span><ins class="text-primary">Confidential</ins></li>
										<li><span>Date Available to Start :</span>2 weeks from acceptance</li>
										<li><span>Willingness to Relocate :</span>Yes, for the right opportunity</li>
										<li><span>Job Search Radius :</span>Under 25 miles</li>
										<li><span>Spoken Language(s) :</span>English, Spanish</li>
										<li><span>Written Language(s) :</span>English, Spanish</li>
										<li>
                                            <div class="glance_icons">
                                                <a href="javascript:void(0);" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" data-placement="top" data-container="body" data-content=""><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/military_service_icon.png"></a>
                                                <div class="mypopover">
                                                    <a href="#" class="close_popover">x</a>
                                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/military_service_icon.png">
                                                    <h4>Disclaimer</h4>
                                                    <div class="clearfix"></div>
                                                    <small>Information has not been confirmed or deemed accurate by EyeRecruit, Inc. to be factual.</small>
                                                </div>
                                            </div>
                                            <span>Military Service :</span>Yes, Marines</li>
										<li>
                                            <div class="glance_icons">
                                                <a href="javascript:void(0);" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" data-placement="top" data-container="body" data-content=""><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/enforcement_icon.jpg"></a>
                                                <div class="mypopover">
                                                    <a href="#" class="close_popover">x</a>
                                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/enforcement_icon.jpg">
                                                    <h4>Disclaimer</h4>
                                                    <div class="clearfix"></div>
                                                    <small>Information has not been confirmed or deemed accurate by EyeRecruit, Inc. to be factual.</small>
                                                </div>
                                            </div>
                                            <span>Law Enforcement Service :</span>Yes, Police Officer</li>
										<li>
                                            <div class="glance_icons">
                                                <a href="javascript:void(0);" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" data-placement="top" data-container="body" data-content=""><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/federal_shield.jpg"></a>
                                                <div class="mypopover">
                                                    <a href="#" class="close_popover">x</a>
                                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/federal_shield.jpg">
                                                    <h4>Disclaimer</h4>
                                                    <div class="clearfix"></div>
                                                    <small>Information has not been confirmed or deemed accurate by EyeRecruit, Inc. to be factual.</small>
                                                </div>
                                            </div>
                                            <span>Federal Agency Service :</span>Yes, Department of Homeland Security</li>
										<li><span>Highest Clearance Level :</span><ins class="text-primary">Confidential</ins></li>
									</ul>						
								</div>
								<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/rightside_ad.jpg" class="img-responsive">
								<div class="light_box awarded_badges">
									<div class="sidebar_title">
										<h4>Awarded Badges</h4>
									</div>
									<div class="text-center">
										<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/awarded_badge1.jpg" class="img-responsive">
										<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/awarded_badge2.jpg" class="img-responsive">
										<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/awarded_badge3.jpg" class="img-responsive">
										<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/awarded_badge4.jpg" class="img-responsive">
									</div>						
								</div>
	<!-- <div class="light_box at_glance">
		<div class="sidebar_title">
			<span class="title_icon qview_icon"></span>
			<h4><a href="<?php // echo site_url();  ?>/tips/tips-424/">Quick View</a></h4>
		</div>
		<ul>
			<li>
				<strong>Referred By :</strong>
				<p>
					<?php  
					$REF_SRC = get_cimyFieldValue($user_id,'REF_SRC'); 
					// echo (($REF_SRC)) ? $REF_SRC : 'N/A';
					?>
				</p>
			</li>
			<li>
				<strong>Current work situation? :</strong>
				<p>
					<?php  
					$CUR_WORK = get_cimyFieldValue($user_id,'CUR_WORK_SITUATION'); 
					// echo (($CUR_WORK)) ? $CUR_WORK : 'N/A';
					?>
				</p>
			</li>
			<li>
				<strong>Active Military or Law Enforcement :</strong>
				<p>
					<?php  
					$FEDERAL_NVESTIGATIV = get_cimyFieldValue($user_id,'FEDERAL_NVESTIGATIV');
					// echo (($FEDERAL_NVESTIGATIV)) ? $FEDERAL_NVESTIGATIV : 'N/A'; 
					?>
				</p>
			</li>
			<li>
				<strong>What type of work are you looking for :</strong>
				<p>
					<?php  
					$TYPE_OF_OPPORTUNITY = get_cimyFieldValue($user_id,'TYPE_OF_OPPORTUNITY'); 
					// echo (($TYPE_OF_OPPORTUNITY)) ? $TYPE_OF_OPPORTUNITY : 'N/A';
					?>
				</p>
			</li>
		</ul>
		<ul>
			<li>
				<strong>Over 18? : </strong>
				<span>
				<?php 
				$OVER_18_YN = get_cimyFieldValue($user_id,'OVER_18_YN'); 
				// echo (($OVER_18_YN)) ? $OVER_18_YN : 'N/A' ;
				?>
				</span>
			</li>
			<li>
				<strong>Currently employed? : </strong>
				<span>
				<?php 
				$CURR_EMPLOYED_YN = get_cimyFieldValue($user_id,'CURR_EMPLOYED_YN'); 
				// echo (($CURR_EMPLOYED_YN)) ? $CURR_EMPLOYED_YN : 'N/A' ;
				?>
				</span>
			</li>
			<li>
				<strong>Areas of experience : </strong>
				<span>
				<?php 
				$BEST_INDUSTRY = get_cimyFieldValue($user_id,'BEST_INDUSTRY'); 
				// echo (($BEST_INDUSTRY)) ? $BEST_INDUSTRY : 'N/A' ;
				?>
				</span>
			</li>
			<li>
				<strong>Active DL State : </strong>
				<span>
				<?php 
				$DRIVER_STATE = get_cimyFieldValue($user_id,'DRIVER_STATE'); 
				// echo (($DRIVER_STATE)) ? $DRIVER_STATE : 'N/A' ;
				?>
				</span>
			</li>
			<li>
				<strong>State(s) :  </strong>
				<span>
				<?php 
				$FIELD_LICENSE_STATE = get_cimyFieldValue($user_id,'FIELD_LICENSE_STATE'); 
				// echo (($FIELD_LICENSE_STATE)) ? $FIELD_LICENSE_STATE : 'N/A' ;
				?>
				</span>
			</li>
			<li>
				<strong>Armed Forces : </strong>
				<span>
				<?php 
				$US_ARMED_FORCES_OPTI = get_cimyFieldValue($user_id,'US_ARMED_FORCES_OPTI'); 
				// echo (($US_ARMED_FORCES_OPTI)) ? $US_ARMED_FORCES_OPTI : 'N/A' ;
				?>
				</span>
			</li>
			<li>
				<strong>Date available : </strong>
				<span>
				<?php 
				$WORK_DATE_AVAILABLE = get_cimyFieldValue($user_id,'WORK_DATE_AVAILABLE'); 
				// echo (($WORK_DATE_AVAILABLE)) ? $WORK_DATE_AVAILABLE : 'N/A' ;
				?>
				</span>
			</li>
			<li>
				<strong>Career level : </strong>
				<span>
				<?php 
				$CURR_CAREER_LVL = get_cimyFieldValue($user_id,'CURR_CAREER_LVL'); 
				// echo (($CURR_CAREER_LVL)) ? $CURR_CAREER_LVL : 'N/A' ;
				?>
				</span>
			</li>
			<li>
				<strong>Transportation : </strong>
				<span>
				<?php 
				$RELOCATION_YN = get_cimyFieldValue($user_id,'RELOCATION_YN'); 
				// echo (($RELOCATION_YN)) ? $RELOCATION_YN : 'N/A' ;
				?>
				</span>
			</li>
			<li>
				<strong>Professional License(s) : </strong>
				<span>
				<?php 
				$POSSES_DRIVER_LICENS = get_cimyFieldValue($user_id,'POSSES_DRIVER_LICENS'); 
				// echo (($POSSES_DRIVER_LICENS)) ? $POSSES_DRIVER_LICENS : 'N/A' ;
				?>
				</span>
			</li>
			<li>
				<strong>Security clearance : </strong>
				<span>
				<?php 
				$SECURITY_CLEAR_YN = get_cimyFieldValue($user_id,'SECURITY_CLEAR_YN'); 
				// echo (($SECURITY_CLEAR_YN)) ? $SECURITY_CLEAR_YN : 'N/A' ;
				?>
				</span>
			</li>
		</ul>
	</div> -->
	
</div>