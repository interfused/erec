<?php
/**
* The default template for displaying content. Used for Last Monthly Survey
* @package Jobify
* @since Jobify 1.0
*/
?>
<?php 
$user_id = $_REQUEST['recruitID'];

$language_array = array('mandarin','vietnamese','english','javanese','spanish','tamil','hindi','Korean','russian','turkish','arabic','telugu','portuguese','marathi','bengali','italian','french','thai','malay','burmese','german','cantonese','japanese','kannada','farsi','gujarati','urdu','polish','punjabi','wu','other');

foreach ($language_array as $lang) {
	
	$list_language = get_user_meta( $user_id, 'list_languages_'.$lang, true );
	if ( !empty( $list_language ) ) {
		if ( $list_language == 'OTHER' ) {
			$list_languages_text = get_user_meta( $user_id, 'list_languages_text', true );
			$list_languages[] = $list_languages_text;
		}
		else{
			$list_languages[] = $list_language;
		}
	}	
}

if ( !empty($list_languages) ) {
	
	$LANGUAGES_SPOKEN = implode(', ', $list_languages);
}
else{
	$LANGUAGES_SPOKEN = 'none';
}


//$user_id  = 165;
?>
<div class="sidebar">
	<h3 class="report_title_bug"><span>Report a Bug</span></h3>
	<div class="light_box at_glance">
		<div class="sidebar_title">
			<img class="title_icon" src="<?php  echo site_url(); ?>/assets/themes/eye-recruit-2015/img/ata_glance.jpg">
			<h4><a href="<?php echo site_url();  ?>/tips/tips-424/">At a Glance</a></h4>
		</div>
		<ul>
			<li><strong>Candidate Search Status : </strong> <p>
				<?php  
					$Status = get_cimyFieldValue($user_id,'SYSTEM_AND_PROCE'); 
					echo (($Status)) ? $Status : 'N/A';
				?></p>
			</li>
			<li><strong>Industry Sectore : </strong> <p>
				<?php  
					$Sectore = get_cimyFieldValue($user_id,'BEST_INDUSTRY'); 
					echo (($Sectore)) ? $Sectore : 'N/A';
				?>

			</p></li>
			<li><strong>Years of Industry Experience :</strong><p>
				<?php  
					$Experience = get_cimyFieldValue($user_id,'INDUSTRY_YEARS'); 
					echo ((trim($Experience))) ? $Experience : 'N/A';
				?></p></li>
			<li><strong>Highest level of Education : </strong> <p>
				<?php  
					$Education = get_cimyFieldValue($user_id,'HIGHEST_EDUCATION'); 
					echo ((trim($Education))) ? $Education : 'N/A';
				?>
			</p></li>
			<li><strong>Current Career Level : </strong> <p>
				<?php  
					$Career = get_cimyFieldValue($user_id,'CURR_CAREER_LVL'); 
					echo (($Career)) ? $Career : 'N/A';
				?>
				</p></li>
			<li><strong>Current Income Range : </strong> <p><?php  
					$Income = get_cimyFieldValue($user_id,'COMPENSATION_DESIRED'); 
					echo (($Income)) ? $Income : 'N/A';
				?> Annually</p></li>
			<li><strong>Desired Income Range : </strong> <p><?php  
					$Desired = get_cimyFieldValue($user_id,'COMPENSATION_DESIRED'); 
					echo (($Desired)) ? $Desired : 'N/A';
				?> Annually</p></li>
			<li><strong>Date Available to Start : </strong> <p><?php  
					$Available = get_cimyFieldValue($user_id,'WORK_DATE_AVAILABLE'); 
					echo (($Available)) ? $Available : 'N/A';
				?></p></li>
			<li><strong>Willingness to Relocate : </strong> <p>
				<?php  
					$Willingness = get_cimyFieldValue($user_id,'RELOCATION_YN'); 
					echo (($Willingness)) ? $Willingness : 'N/A';
				?>, for the right opportunity</p></li>

			<li><strong>Job Search Radius :</strong> <p>
				<?php  
					$Willingness = get_cimyFieldValue($user_id,'JOB_SEARCH_RADIUS'); 
					echo (($Willingness)) ? $Willingness : 'N/A';
				?>
				</p></li>
			<li><strong>Spoken Language(s) :</strong> <p>
				<?php echo  $LANGUAGES_SPOKEN; ?>
				</p></li>
			<li><strong>Written Language(s) :</strong> <p><?php echo  $LANGUAGES_SPOKEN; ?></p></li>
			<li>
	            <div class="glance_icons">
	                <a href="javascript:void(0);" data-toggle="popover" data-trigger="focus" data-placement="top" data-container="body" data-content="" data-original-title="" title=""><img src="/assets/themes/eye-recruit-2015/img/military_service_icon.png"></a>
	                <div class="mypopover">
	                    <a href="#" class="close_popover">x</a>
	                    <img src="<?php  echo site_url(); ?>/assets/themes/eye-recruit-2015/img/military_service_icon.png">
	                    <h4>Disclaimer</h4>
	                    <div class="clearfix"></div>
	                    <small>Information has not been confirmed or deemed accurate by EyeRecruit, Inc. to be factual.</small>
	                </div>
	            </div>
	            <strong>Military Service :</strong><p><?php  
					$Military = get_cimyFieldValue($user_id,'US_ARMED_FORCES_OPTION'); 
					echo (($Military)) ? $Military : 'N/A';
				?></p>
	        </li>
	        <li>
	            <div class="glance_icons">
	                <a href="javascript:void(0);" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" data-placement="top" data-container="body" data-content="" data-original-title="" title=""><img src="/assets/themes/eye-recruit-2015/img/enforcement_icon.jpg"></a>
	                <div class="mypopover">
	                    <a href="#" class="close_popover">x</a>
	                    <img src="<?php  echo site_url(); ?>/assets/themes/eye-recruit-2015/img/enforcement_icon.jpg">
	                    <h4>Disclaimer</h4>
	                    <div class="clearfix"></div>
	                    <small>Information has not been confirmed or deemed accurate by EyeRecruit, Inc. to be factual.</small>
	                </div>
	            </div>
	            <strong>Law Enforcement Service :</strong><p><?php  
					$Enforcement = get_cimyFieldValue($user_id,'LOCAL_LAW_FORCE_YN'); 
					echo (($Enforcement)) ? $Enforcement : 'N/A';
				?></p>
	        </li>
	        <li>
                <strong>Federal Agency Service :</strong>
                <p><?php  
					$Homeland = get_cimyFieldValue($user_id,'HIGHEST_EDUCATION'); 
					echo (($Homeland)) ? $Homeland : 'N/A';
				?></p>
            </li>
            <li><strong>Highest Clearance Level :</strong><p>
            	<?php 
				$employer = get_cimyFieldValue($user_id,'CLEARANCE_LEVEL'); 
				echo (($employer)) ? $employer : 'N/A' ;
				?>
            </p>
            </li>
			<li>
				<strong>Current employer : </strong>
				<p><?php 
				$employer = get_cimyFieldValue($user_id,'CURR_EMPLOYED_YN'); 
				echo (($employer)) ? $employer : 'N/A' ;
				?></p>
			</li>
			<li><strong>Current Employment Situation :</strong> <p><?php  
					$Situation = get_cimyFieldValue($user_id,'CUR_WORK_SITUATION'); 
					echo (($Situation)) ? $Situation : 'N/A';
				?></p></li>
			<li><strong>Authorized to work in US :</strong><p><?php  
					$Authorized = get_cimyFieldValue($user_id,'US_ELIGIBLE'); 
					echo (($Authorized)) ? $Authorized : 'N/A';
				?>, I am Authorized.</p></li>
			<li><strong>University(s) Attended :</strong> <p>N/A</p></li>
			<li><strong>Desired Opportunity :</strong> <p><?php  
					$Desired = get_cimyFieldValue($user_id,'TYPE_OF_OPPORTUNITY'); 
					echo (($Desired)) ? $Desired : 'N/A';
				?></p></li>
			<li><strong>Current Spotlight Status :</strong> <p>Active</p></li>
			<li><strong>Valid State Drivers License :</strong> <p><?php  
					$Drivers = get_cimyFieldValue($user_id,'POSSES_DRIVER_LICENS'); 
					echo (($Drivers)) ? $Drivers : 'N/A';
					//DRIVER_STATE
				?></p></li>
			<li><strong>Current Membership Level ;</strong> <p>

				<?php  if(is_user_logged_in() && function_exists('pmpro_hasMembershipLevel') && pmpro_hasMembershipLevel())
						{
							global $current_user;
							$current_user->membership_level = pmpro_getMembershipLevelForUser($user_id);
							$membershipLevel = $current_user->membership_level->name;
						}
						else{
							$membershipLevel = 'Not Available';
						}

						echo $membershipLevel;
				?>

			</p></li>
			
		</ul>
	</div>
</div>