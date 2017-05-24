<?php
/*
Plugin Name: Eyerecruit User Profile 
Author:      Eyerecruit Team
Description: This plugin is used to create custom dashboard page for eyerecruit.
*/

add_action('admin_menu', 'my_plugin_menu');
function my_plugin_menu() {
	add_menu_page('Eyerecruit Custom User Profile', 'Eyerecruit User Profile', 'read', 'eyerecruit_user_profile', 'eyerecruit_user_profile');
}

function eyerecruit_user_profile() {

	if ( isset( $_REQUEST['user'] ) ) {

		$user_id = $_REQUEST['user'];

		$userdata = get_userdata($user_id);

		if ( $userdata === false ) { ?>
			<div class="wrap">
				
	   			<h3 style="text-align:center;">User Does Not Exist.</h3>
	   			<?php
	   			/*$args = array(
	   				'role__in' => array('candidate')
	   			);
	   			$users = get_users($args);
	   			echo "<pre>";
	   			print_r($users);
	   			echo "</pre>";*/
	   			?>
			</div>
	   		<?php
		}
		else{

			$name = $userdata->display_name;
			$email = $userdata->user_email;
			$AGREE_TO_RESPOND 			= get_cimyFieldValue($user_id, 'AGREE_TO_RESPOND');
			$AGREE_TO_RESPOND 			= ( !empty( $AGREE_TO_RESPOND ) ) ? $AGREE_TO_RESPOND : 'none';

			$SYSTEM_AND_PROCE 			= get_cimyFieldValue($user_id, 'SYSTEM_AND_PROCE');
			$SYSTEM_AND_PROCE 			= ( !empty( $SYSTEM_AND_PROCE ) ) ? $SYSTEM_AND_PROCE : 'none';

			$BEST_INDUSTRY 				= get_cimyFieldValue($user_id, 'BEST_INDUSTRY');
			$BEST_INDUSTRY 				= ( !empty( $BEST_INDUSTRY ) ) ? $BEST_INDUSTRY : 'none';


			$HIGHEST_EDUCATION 			= get_cimyFieldValue($user_id, 'HIGHEST_EDUCATION');
			if( !empty( $HIGHEST_EDUCATION ) ) {
				$other_option = array('Associates Degree', 'Bachelors Degree', 'Masters Degree', 'Doctorate Degree / PhD.');
				if ( in_array($HIGHEST_EDUCATION, $other_option) ) {
					
					$AREA_OF_STUDY 				= get_cimyFieldValue($user_id, 'AREA_OF_STUDY');
					$AREA_OF_STUDY 				= ( !empty( $AREA_OF_STUDY ) ) ? $AREA_OF_STUDY : 'none';

					$SCHOOL_NAME 				= get_cimyFieldValue($user_id, 'SCHOOL_NAME');
					$SCHOOL_NAME 				= ( !empty( $SCHOOL_NAME ) ) ? $SCHOOL_NAME : 'none';

					$STUDY_YEAR 			    = get_cimyFieldValue($user_id, 'STUDY_YEAR');
					$STUDY_YEAR 				= ( !empty( $STUDY_YEAR ) ) ? $STUDY_YEAR : 'none';

					$STUDY_MAJOR 			    = get_cimyFieldValue($user_id, 'STUDY_MAJOR');
					$STUDY_MAJOR 				= ( !empty( $STUDY_MAJOR ) ) ? $STUDY_MAJOR : 'none';

					$HIGHEST_EDUCATION = $HIGHEST_EDUCATION.'<br>Area of study : '.$AREA_OF_STUDY.'<br>School Name : '.$SCHOOL_NAME.'<br>Year : '.$STUDY_YEAR.'<br>Major : '.$STUDY_MAJOR;
					
				}
				else{
					$HIGHEST_EDUCATION = $HIGHEST_EDUCATION;
				}
			}
			else{
				$HIGHEST_EDUCATION = 'none';
			}

			
			$TYPE_OF_OPPORTUNITY 		= get_cimyFieldValue($user_id, 'TYPE_OF_OPPORTUNITY');
			$TYPE_OF_OPPORTUNITY 		= ( !empty( $TYPE_OF_OPPORTUNITY ) ) ? $TYPE_OF_OPPORTUNITY : 'none';

			$JOB_SEARCH_RADIUS 			= get_cimyFieldValue($user_id, 'JOB_SEARCH_RADIUS');
			$JOB_SEARCH_RADIUS 			= ( !empty( $JOB_SEARCH_RADIUS ) ) ? $JOB_SEARCH_RADIUS : 'none';

			$US_ELIGIBLE 			    = get_cimyFieldValue($user_id, 'US_ELIGIBLE');
			$US_ELIGIBLE 				= ( !empty( $US_ELIGIBLE ) ) ? $US_ELIGIBLE : 'none';

			$SECURITY_CLEAR_YN 			= get_cimyFieldValue($user_id, 'SECURITY_CLEAR_YN');
			$SECURITY_CLEAR_YN 			= ( !empty( $SECURITY_CLEAR_YN ) ) ? $SECURITY_CLEAR_YN : 'none';

			$OVER_18_YN 			    = get_cimyFieldValue($user_id, 'OVER_18_YN');
			$OVER_18_YN 				= ( !empty( $OVER_18_YN ) ) ? $OVER_18_YN : 'none';

			$POSSES_DRIVER_LICENS 		= get_cimyFieldValue($user_id, 'POSSES_DRIVER_LICENS');
			$POSSES_DRIVER_LICENS 		= ( !empty( $POSSES_DRIVER_LICENS ) ) ? $POSSES_DRIVER_LICENS : 'none';

			$DRIVER_STATE 			    = get_cimyFieldValue($user_id, 'DRIVER_STATE');
			$DRIVER_STATE 				= ( !empty( $DRIVER_STATE ) ) ? $DRIVER_STATE : 'none';

			$RELIABLE_TRANSPORT 		= get_cimyFieldValue($user_id, 'RELIABLE_TRANSPORT');
			$RELIABLE_TRANSPORT 		= ( !empty( $RELIABLE_TRANSPORT ) ) ? $RELIABLE_TRANSPORT : 'none';

			$FIELD_LICENSE_STATUS 		= get_cimyFieldValue($user_id, 'FIELD_LICENSE_STATUS');
			$FIELD_LICENSE_STATUS 		= ( !empty( $FIELD_LICENSE_STATUS ) ) ? $FIELD_LICENSE_STATUS : 'none';

			$FIELD_LICENSE_STATE 		= get_cimyFieldValue($user_id, 'FIELD_LICENSE_STATE');
			$FIELD_LICENSE_STATE 		= ( !empty( $FIELD_LICENSE_STATE ) ) ? $FIELD_LICENSE_STATE : 'none';


			
			
			/*.........Languages..........*/

			$language_array = array('mandarin','vietnamese','english','javanese','spanish','tamil','hindi','Korean','russian','turkish','arabic','telugu','portuguese','marathi','bengali','italian','french','thai','malay','burmese','german','cantonese','japanese','kannada','farsi','gujarati','urdu','polish','punjabi','wu','other');

			foreach ($language_array as $lang) {
				
				$list_language = get_user_meta( $user_id, 'list_languages_'.$lang, true );
				$rating = get_user_meta( $user_id, $lang.'_rating', true );

				if ( !empty( $list_language ) ) {

					if ( !empty( $rating ) ) {
						
						if ( $list_language == 'OTHER' ) {
							$list_languages_text = get_user_meta( $user_id, 'list_languages_text', true );
							$list_languages[] = $list_language.' : '. $list_languages_text .' ( '.$rating.' ) ';
						}
						else{
							$list_languages[] = $list_language.' ( '.$rating.' ) ';
						}
					}
					else{
						if ( $list_language == 'OTHER' ) {
							$list_languages_text = get_user_meta( $user_id, 'list_languages_text', true );
							$list_languages[] = $list_language.' : '. $list_languages_text;
						}
						else{
							$list_languages[] = $list_language;
						}
					}
				}
			}

			if ( !empty($list_languages) ) {
				
				$LANGUAGES_SPOKEN = implode('<br>', $list_languages);
			}
			else{
				$LANGUAGES_SPOKEN = 'none';
			}



			$CUR_WORK_SITUATION 		= get_cimyFieldValue($user_id, 'CUR_WORK_SITUATION');
			$CUR_WORK_SITUATION 		= ( !empty( $CUR_WORK_SITUATION ) ) ? $CUR_WORK_SITUATION : 'none';

			$US_ARMED_FORCES 			= get_cimyFieldValue($user_id, 'US_ARMED_FORCES');
			if ( !empty( $US_ARMED_FORCES ) ) {
				if ( $US_ARMED_FORCES == 'Yes' ) {
					
					$US_ARMED_FORCES_OPTION 			= get_cimyFieldValue($user_id, 'US_ARMED_FORCES_OPTI');
					if ( !empty( $US_ARMED_FORCES_OPTION ) ) {

						$US_ARMED_FORCES 		= $US_ARMED_FORCES.' ( '.$US_ARMED_FORCES_OPTION.' ) ';
					}
					else{
						$US_ARMED_FORCES 		= $US_ARMED_FORCES;
					}
				}
				else{
					$US_ARMED_FORCES 		= $US_ARMED_FORCES;
				}
			}
			else{

				$US_ARMED_FORCES 		= 'none';
			}

			$LOCAL_LAW_FORCE_YN 		= get_cimyFieldValue($user_id, 'LOCAL_LAW_FORCE_YN');
			$LOCAL_LAW_FORCE_YN 		= ( !empty( $LOCAL_LAW_FORCE_YN ) ) ? $LOCAL_LAW_FORCE_YN : 'none';

			$FEDERAL_NVESTIGATIV 		= get_cimyFieldValue($user_id, 'FEDERAL_NVESTIGATIV');

			if ( !empty( $FEDERAL_NVESTIGATIV ) ) {
				
				if ( $FEDERAL_NVESTIGATIV == 'Yes' ) {
				
					$US_LAW_ENFORCE_STATU 		= get_cimyFieldValue($user_id, 'US_LAW_ENFORCE_STATU');

					if ( !empty( $US_LAW_ENFORCE_STATU ) ) {

						if ( $US_LAW_ENFORCE_STATU == 'OTHER' ) {
							$US_LAW_ENFORCE_OTHER 		= get_cimyFieldValue($user_id, 'US_LAW_ENFORCE_OTHER');
							if ( !empty( $US_LAW_ENFORCE_OTHER ) ) {
								$US_LAW_ENFORCE_STATU = $US_LAW_ENFORCE_STATU.' ( '.$US_LAW_ENFORCE_OTHER. ' ) ';
							}
							else{

								$US_LAW_ENFORCE_STATU = $US_LAW_ENFORCE_STATU;
							}

						}
					}
					else{
						$US_LAW_ENFORCE_STATU = 'none';
					}

					$FEDERAL_NVESTIGATIV = $US_LAW_ENFORCE_STATU;
				}
				else{
					$FEDERAL_NVESTIGATIV = $FEDERAL_NVESTIGATIV;
				}
			}
			else{
				 $FEDERAL_NVESTIGATIV = 'none';
			}

			$MAJOR_METROPOLITAN 		= get_cimyFieldValue($user_id, 'MAJOR_METROPOLITAN');
			$MAJOR_METROPOLITAN 		= ( !empty( $MAJOR_METROPOLITAN ) ) ? $MAJOR_METROPOLITAN : 'none';

			$CURRENT_RESUME 		= get_cimyFieldValue($user_id, 'CURRENT_RESUME');
			$CURRENT_RESUME 		= ( !empty( $CURRENT_RESUME ) ) ? '<a href="'.$CURRENT_RESUME.'">Resume</a>' : 'none';


			$rfname = get_user_meta($user_id, 'rfname');
			$rfemail =  get_user_meta($user_id, 'rfemail');
			
			if( !empty( $rfname ) && isset( $rfname[0] ) ) {

				$rfname_arr = $rfname[0];
				$rfemail_arr = $rfemail[0];

				$emp_rfname = array_filter($rfname_arr );
				$emp_rfemail = array_filter($rfemail_arr );
				
				if ( !empty($emp_rfname) || !empty($emp_rfemail) ) {


					$count_rf = count($rfname_arr);

					for ($i=0; $i < $count_rf; $i++) { 
						
						if ( !empty($rfname_arr[$i]) && !empty($rfemail_arr[$i]) ) {
							$rfc_arr[] = $rfname_arr[$i].' ( '. $rfemail_arr[$i] .' )';
						}
					}

					$rfc = implode( '<br>', $rfc_arr);

				}
				else{
					$rfc = 'none';
				}
			}
			else{
				$rfc = 'none';
			}


			
			$approve = site_url('/wp-admin/users.php?page=new-user-approve-admin&user='.$user_id.'&status=approve&_wpnonce=5a32097b5a');

			$reject = site_url('/wp-admin/users.php?page=new-user-approve-admin&user='.$user_id.'&status=deny&_wpnonce=5a32097b5a');
			
			echo

			'<table style="border-top: 1px solid #cccccc; border-left: 1px solid #cccccc;" border="0" width="95%" cellspacing="0" cellpadding="10" align="center" data-mce-style="border-top: 1px solid #cccccc; border-left: 1px solid #cccccc;" class="mce-item-table" data-mce-selected="1">
				<thead><h1 style="text-align:center;">Eyerecruit User Profile Information</h1></thead>
				<tbody>
					
					<tr>
						<th style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;" align="left" bgcolor="#eeeeee" width="150" data-mce-style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;">
							Name
						</th>
						<td style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;" align="left" bgcolor="#ffffff" data-mce-style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;">
							'.$name.'
						</td>
					</tr>

					<tr>
						<th style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;" align="left" bgcolor="#eeeeee" width="150" data-mce-style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;">
							Email
						</th>
						<td style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;" align="left" bgcolor="#ffffff" data-mce-style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;">
							<a href="mailto:'.$email.'">'.$email.'</a>
						</td>
					</tr>

					<tr>
						<th style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;" align="left" bgcolor="#eeeeee" width="150" data-mce-style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;">
							Agree to respond to the questions
						</th>
						<td style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;" align="left" bgcolor="#ffffff" data-mce-style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;">
							'.$AGREE_TO_RESPOND.'
						</td>
					</tr>

					<tr>
						<th style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;" align="left" bgcolor="#eeeeee" width="150" data-mce-style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;">
							Currently actively or passively looking for a job or career change
						</th>
						<td style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;" align="left" bgcolor="#ffffff" data-mce-style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;">
							'.$SYSTEM_AND_PROCE.'
						</td>
					</tr>

					<tr>
						<th style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;" align="left" bgcolor="#eeeeee" width="150" data-mce-style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;">
							Industry that best reflects your work experience
						</th>
						<td style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;" align="left" bgcolor="#ffffff" data-mce-style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;">
							'.$BEST_INDUSTRY.'
						</td>
					</tr>

					<tr>
						<th style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;" align="left" bgcolor="#eeeeee" width="150" data-mce-style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;">
							Highest level of education
						</th>
						<td style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;" align="left" bgcolor="#ffffff" data-mce-style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;">
							'.$HIGHEST_EDUCATION.'
						</td>
					</tr>

					<tr>
						<th style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;" align="left" bgcolor="#eeeeee" width="150" data-mce-style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;">
							Type of opportunity
						</th>
						<td style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;" align="left" bgcolor="#ffffff" data-mce-style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;">
							'.$TYPE_OF_OPPORTUNITY.'
						</td>
					</tr>

					<tr>
						<th style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;" align="left" bgcolor="#eeeeee" width="150" data-mce-style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;">
							Desired Working Radius
						</th>
						<td style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;" align="left" bgcolor="#ffffff" data-mce-style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;">
							'.$JOB_SEARCH_RADIUS.'
						</td>
					</tr>

					<tr>
						<th style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;" align="left" bgcolor="#eeeeee" width="150" data-mce-style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;">
							Eligible and legally authorized to work in the United States
						</th>
						<td style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;" align="left" bgcolor="#ffffff" data-mce-style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;">
							'.$US_ELIGIBLE.'
						</td>
					</tr>

					<tr>
						<th style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;" align="left" bgcolor="#eeeeee" width="150" data-mce-style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;">
							Security Clearance
						</th>
						<td style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;" align="left" bgcolor="#ffffff" data-mce-style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;">
							'.$SECURITY_CLEAR_YN.'
						</td>
					</tr>

					<tr>
						<th style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;" align="left" bgcolor="#eeeeee" width="150" data-mce-style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;">
							18 Years of age or older
						</th>
						<td style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;" align="left" bgcolor="#ffffff" data-mce-style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;">
							'.$OVER_18_YN.'
						</td>
					</tr>

					<tr>
						<th style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;" align="left" bgcolor="#eeeeee" width="150" data-mce-style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;">
							Possess a valid State issued Drivers License
						</th>
						<td style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;" align="left" bgcolor="#ffffff" data-mce-style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;">
							'.$POSSES_DRIVER_LICENS.'
						</td>
					</tr>

					<tr>
						<th style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;" align="left" bgcolor="#eeeeee" width="150" data-mce-style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;">
							State issued
						</th>
						<td style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;" align="left" bgcolor="#ffffff" data-mce-style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;">
							'.$DRIVER_STATE.'
						</td>
					</tr>

					<tr>
						<th style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;" align="left" bgcolor="#eeeeee" width="150" data-mce-style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;">
							Reliable transportation for local travel
						</th>
						<td style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;" align="left" bgcolor="#ffffff" data-mce-style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;">
							'.$RELIABLE_TRANSPORT.'
						</td>
					</tr>

					<tr>
						<th style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;" align="left" bgcolor="#eeeeee" width="150" data-mce-style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;">
							Currently licensed in the field of Investigation or Security
						</th>
						<td style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;" align="left" bgcolor="#ffffff" data-mce-style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;">
							'.$FIELD_LICENSE_STATUS.'
						</td>
					</tr>

					<tr>
						<th style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;" align="left" bgcolor="#eeeeee" width="150" data-mce-style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;">
							From which State(s)
						</th>
						<td style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;" align="left" bgcolor="#ffffff" data-mce-style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;">
							'.$FIELD_LICENSE_STATE.'
						</td>
					</tr>

					<tr>
						<th style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;" align="left" bgcolor="#eeeeee" width="150" data-mce-style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;">
							Languages and proficiency level
						</th>
						<td style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;" align="left" bgcolor="#ffffff" data-mce-style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;">
							'.$LANGUAGES_SPOKEN.'
						</td>
					</tr>

					<tr>
						<th style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;" align="left" bgcolor="#eeeeee" width="150" data-mce-style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;">
							Current employment situation
						</th>
						<td style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;" align="left" bgcolor="#ffffff" data-mce-style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;">
							'.$CUR_WORK_SITUATION.'
						</td>
					</tr>

					<tr>
						<th style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;" align="left" bgcolor="#eeeeee" width="150" data-mce-style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;">
							Active or Retired United States Armed Forces
						</th>
						<td style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;" align="left" bgcolor="#ffffff" data-mce-style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;">
							'.$US_ARMED_FORCES.'
						</td>
					</tr>

					<tr>
						<th style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;" align="left" bgcolor="#eeeeee" width="150" data-mce-style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;">
							Active State of Local Law Enforcement
						</th>
						<td style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;" align="left" bgcolor="#ffffff" data-mce-style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;">
							'.$LOCAL_LAW_FORCE_YN.'
						</td>
					</tr>

					<tr>
						<th style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;" align="left" bgcolor="#eeeeee" width="150" data-mce-style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;">
							Employed by a Federal Investigative or Law Enforcement Agency
						</th>
						<td style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;" align="left" bgcolor="#ffffff" data-mce-style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;">
							'.$FEDERAL_NVESTIGATIV.'
						</td>
					</tr>

					<tr>
						<th style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;" align="left" bgcolor="#eeeeee" width="150" data-mce-style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;">
							Closest major metropolitan city 
						</th>
						<td style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;" align="left" bgcolor="#ffffff" data-mce-style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;">
							'.$MAJOR_METROPOLITAN.'
						</td>
					</tr>

					<tr>
						<th style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;" align="left" bgcolor="#eeeeee" width="150" data-mce-style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;">
							Resume
						</th>
						<td style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;" align="left" bgcolor="#ffffff" data-mce-style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;">
							'.$CURRENT_RESUME.'
						</td>
					</tr>

					<tr>
						<th style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;" align="left" bgcolor="#eeeeee" width="150" data-mce-style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;">
							Recommend Friends & Colleagues
						</th>
						<td style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;" align="left" bgcolor="#ffffff" data-mce-style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;">
							'.$rfc.'
						</td>
					</tr>
					<tr>
						<th style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;" align="left" bgcolor="#eeeeee" width="150" data-mce-style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;">
							Action
						</th>
						<td style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;" align="left" bgcolor="#ffffff" data-mce-style="border-bottom: 1px solid #cccccc; border-right: 1px solid #cccccc; font-size: 14px; font-family: Arial, sans-serif; color: #343434; line-height: 20px;">
							<a href="'.$approve.'">Accept</a> OR <a href="'.$reject.'">Reject</a>
						</td>
					</tr>
				</tbody>
			</table>';
		}
	}
	else{?>
		<div class="wrap">
   			<h3 style="text-align:center;">User Does Not Exist.</h3>
		</div>
   		<?php

	}
}






