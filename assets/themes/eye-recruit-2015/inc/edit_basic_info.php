<?php
class wpb_widget extends WP_Widget {

	function __construct() {
		parent::__construct(
			'wpb_widget', 
			__('Tips', 'wpb_widget_domain'), 
			array( 'description' => __( 'Seeker Basic info Tips Section', 'wpb_widget_domain' ), ) 
		);
	}

	public function widget( $args, $instance ) {
		$tipID = apply_filters( 'widget_title', $instance['title'] );
		
		echo $args['before_widget'];
		if ( ! empty( $tipID ) ){
			$tipData = get_post($tipID);
			$link = get_the_permalink($tipID);
			echo "<h3><a href='".$link."'>".$tipData->post_title."</a></h3>";

			if ( !empty($tipData->post_content) ) {
				custom_char_length($tipData->post_content, 200, $link);
			}
			else{
				echo "Data not found.";
			}
		}
		else{
			echo "Data not found.";
		}
		echo $args['after_widget'];
	}
			 
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$selecttip = $instance[ 'title' ];
		}
		else {
			$selecttip = '';
		}

		$args = array('post_type' => 'tips', 'post_status' => 'publish');
		$the_query = new WP_Query( $args ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Select Tip:' ); ?></label> 
			<?php if ( $the_query->have_posts() ) { ?>
				<select class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" >
					<option value="">Select</option>
					<?php while ( $the_query->have_posts() ) { $the_query->the_post(); ?>
						<option value="<?php echo get_the_ID(); ?>" <?php if(get_the_ID()== $selecttip){ echo "selected"; } ?> ><?php echo get_the_title(); ?></option>
					<?php } ?>
				</select><?php
				wp_reset_postdata();
			} else {
				echo "No Tips Found";
			} ?>
		</p>
		<?php 
	}
		
	// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		return $instance;
	}
}

function wpb_load_widget() {
	register_widget( 'wpb_widget' );
}
add_action( 'widgets_init', 'wpb_load_widget' );


/*..............AjAx Update jobseeker basic ProFile FiELDS..................*/
add_action('wp_ajax_edit_basic_info', 'edit_basic_info');
add_action('wp_ajax_nopriv_edit_basic_info', 'edit_basic_info');

function edit_basic_info() {

	global $wpdb;
	$user_id = get_current_user_id();

	if ( !empty( $user_id ) ) {
		
		set_cimyFieldValue($user_id, 'SYSTEM_AND_PROCE', $_POST['SYSTEM_AND_PROCE'] );
		set_cimyFieldValue($user_id, 'BEST_INDUSTRY', $_POST['BEST_INDUSTRY'] );
		set_cimyFieldValue($user_id, 'CLEARANCE_LEVEL', $_POST['CLEARANCE_LEVEL'] );
		set_cimyFieldValue($user_id, 'CLEARANCE_STATUS', $_POST['CLEARANCE_STATUS'] );
		


		set_cimyFieldValue($user_id, 'HIGHEST_EDUCATION', $_POST['HIGHEST_EDUCATION'] );
		set_cimyFieldValue($user_id, 'AREA_OF_STUDY', $_POST['AREA_OF_STUDY'] );
		set_cimyFieldValue($user_id, 'SCHOOL_NAME', $_POST['SCHOOL_NAME'] );
		set_cimyFieldValue($user_id, 'STUDY_YEAR', $_POST['STUDY_YEAR'] );
		set_cimyFieldValue($user_id, 'STUDY_MAJOR', $_POST['STUDY_MAJOR'] );
		set_cimyFieldValue($user_id, 'TYPE_OF_OPPORTUNITY', implode(',', $_POST['TYPE_OF_OPPORTUNITY'] ) );
		//set_cimyFieldValue($user_id, 'TYPE_OF_OPPORTUNITY', $_POST['TYPE_OF_OPPORTUNITY'] );

		set_cimyFieldValue($user_id, 'JOB_SEARCH_RADIUS', $_POST['JOB_SEARCH_RADIUS'] );
		set_cimyFieldValue($user_id, 'US_ELIGIBLE', $_POST['US_ELIGIBLE'] );
		set_cimyFieldValue($user_id, 'SECURITY_CLEAR_YN', $_POST['SECURITY_CLEAR_YN'] );
		set_cimyFieldValue($user_id, 'OVER_18_YN', $_POST['OVER_18_YN'] );

		set_cimyFieldValue($user_id, 'POSSES_DRIVER_LICENS', $_POST['POSSES_DRIVER_LICENS'] );
		set_cimyFieldValue($user_id, 'DRIVER_STATE', $_POST['DRIVER_STATE'] );
		set_cimyFieldValue($user_id, 'RELIABLE_TRANSPORT', $_POST['RELIABLE_TRANSPORT'] );
		set_cimyFieldValue($user_id, 'CURR_EMPLOYED_YN', $_POST['CURR_EMPLOYED_YN'] ); 
		set_cimyFieldValue($user_id, 'NAME_OF_COMP', $_POST['NAME_OF_COMP'] );
		set_cimyFieldValue($user_id, 'WORK_DATE_AVAILABLE', $_POST['WORK_DATE_AVAILABLE'] );

		set_cimyFieldValue($user_id, 'INDUSTRY_YEARS', $_POST['INDUSTRY_YEARS'] );
		set_cimyFieldValue($user_id, 'CURR_CAREER_LVL', $_POST['CURR_CAREER_LVL'] );
		set_cimyFieldValue($user_id, 'REF_SRC', implode(', ', $_POST['REF_SRC'] ) );
		set_cimyFieldValue($user_id, 'RELOCATION_YN', $_POST['RELOCATION_YN'] );


		set_cimyFieldValue($user_id, 'COMPENSATION_CURRENT', $_POST['COMPENSATION_CURRENT'] );
		set_cimyFieldValue($user_id, 'COMPENSATION_ACC', $_POST['COMPENSATION_ACC'] );
		
		set_cimyFieldValue($user_id, 'COMPENSATION_DESIRED', $_POST['COMPENSATION_DESIRED'] );
		set_cimyFieldValue($user_id, 'COMP_DESIRED_ACC', $_POST['COMP_DESIRED_ACC'] );
		
		set_cimyFieldValue($user_id, 'FIELD_LICENSE_STATUS', $_POST['FIELD_LICENSE_STATUS'] );
		set_cimyFieldValue($user_id, 'FIELD_LICENSE_STATE', implode(', ', $_POST['FIELD_LICENSE_STATE']) );

		update_usermeta( $user_id, 'list_languages_mandarin', $_POST['list_languages_mandarin'] );
		update_usermeta( $user_id, 'list_languages_vietnamese', $_POST['list_languages_vietnamese'] );
		update_usermeta( $user_id, 'list_languages_english', $_POST['list_languages_english'] );
		update_usermeta( $user_id, 'list_languages_javanese', $_POST['list_languages_javanese'] );
		update_usermeta( $user_id, 'list_languages_spanish', $_POST['list_languages_spanish'] );
		update_usermeta( $user_id, 'list_languages_tamil', $_POST['list_languages_tamil'] );

		update_usermeta( $user_id, 'list_languages_hindi', $_POST['list_languages_hindi'] );
		update_usermeta( $user_id, 'list_languages_Korean', $_POST['list_languages_Korean'] );
		update_usermeta( $user_id, 'list_languages_russian', $_POST['list_languages_russian'] );
		update_usermeta( $user_id, 'list_languages_turkish', $_POST['list_languages_turkish'] );
		update_usermeta( $user_id, 'list_languages_arabic', $_POST['list_languages_arabic'] );
		update_usermeta( $user_id, 'list_languages_telugu', $_POST['list_languages_telugu'] );

		update_usermeta( $user_id, 'list_languages_portuguese', $_POST['list_languages_portuguese'] );
		update_usermeta( $user_id, 'list_languages_marathi', $_POST['list_languages_marathi'] );
		update_usermeta( $user_id, 'list_languages_bengali', $_POST['list_languages_bengali'] );
		update_usermeta( $user_id, 'list_languages_italian', $_POST['list_languages_italian'] );
		update_usermeta( $user_id, 'list_languages_french', $_POST['list_languages_french'] );
		update_usermeta( $user_id, 'list_languages_thai', $_POST['list_languages_thai'] );

		update_usermeta( $user_id, 'list_languages_malay', $_POST['list_languages_malay'] );
		update_usermeta( $user_id, 'list_languages_burmese', $_POST['list_languages_burmese'] );
		update_usermeta( $user_id, 'list_languages_german', $_POST['list_languages_german'] );
		update_usermeta( $user_id, 'list_languages_cantonese', $_POST['list_languages_cantonese'] );
		update_usermeta( $user_id, 'list_languages_japanese', $_POST['list_languages_japanese'] );
		update_usermeta( $user_id, 'list_languages_kannada', $_POST['list_languages_kannada'] );

		update_usermeta( $user_id, 'list_languages_farsi', $_POST['list_languages_farsi'] );
		update_usermeta( $user_id, 'list_languages_gujarati', $_POST['list_languages_gujarati'] );
		update_usermeta( $user_id, 'list_languages_urdu', $_POST['list_languages_urdu'] );
		update_usermeta( $user_id, 'list_languages_polish', $_POST['list_languages_polish'] );
		update_usermeta( $user_id, 'list_languages_punjabi', $_POST['list_languages_punjabi'] );
		update_usermeta( $user_id, 'list_languages_wu', $_POST['list_languages_wu'] );

		update_usermeta( $user_id, 'list_languages_other', $_POST['list_languages_other'] );
		update_usermeta( $user_id, 'list_languages_text', $_POST['list_languages_text'] );


		/*Save Rating*/

		update_usermeta( $user_id, 'mandarin_rating', $_POST['mandarin_rating'] );
		update_usermeta( $user_id, 'vietnamese_rating', $_POST['vietnamese_rating'] );
		update_usermeta( $user_id, 'english_rating', $_POST['english_rating'] );
		update_usermeta( $user_id, 'javanese_rating', $_POST['javanese_rating'] );
		update_usermeta( $user_id, 'spanish_rating', $_POST['spanish_rating'] );
		update_usermeta( $user_id, 'tamil_rating', $_POST['tamil_rating'] );

		update_usermeta( $user_id, 'hindi_rating', $_POST['hindi_rating'] );
		update_usermeta( $user_id, 'Korean_rating', $_POST['Korean_rating'] );
		update_usermeta( $user_id, 'russian_rating', $_POST['russian_rating'] );
		update_usermeta( $user_id, 'turkish_rating', $_POST['turkish_rating'] );
		update_usermeta( $user_id, 'arabic_rating', $_POST['arabic_rating'] );
		update_usermeta( $user_id, 'telugu_rating', $_POST['telugu_rating'] );

		update_usermeta( $user_id, 'portuguese_rating', $_POST['portuguese_rating'] );
		update_usermeta( $user_id, 'marathi_rating', $_POST['marathi_rating'] );
		update_usermeta( $user_id, 'bengali_rating', $_POST['bengali_rating'] );
		update_usermeta( $user_id, 'italian_rating', $_POST['italian_rating'] );
		update_usermeta( $user_id, 'french_rating', $_POST['french_rating'] );
		update_usermeta( $user_id, 'thai_rating', $_POST['thai_rating'] );

		update_usermeta( $user_id, 'malay_rating', $_POST['malay_rating'] );
		update_usermeta( $user_id, 'burmese_rating', $_POST['burmese_rating'] );
		update_usermeta( $user_id, 'german_rating', $_POST['german_rating'] );
		update_usermeta( $user_id, 'cantonese_rating', $_POST['cantonese_rating'] );
		update_usermeta( $user_id, 'japanese_rating', $_POST['japanese_rating'] );
		update_usermeta( $user_id, 'kannada_rating', $_POST['kannada_rating'] );

		update_usermeta( $user_id, 'farsi_rating', $_POST['farsi_rating'] );
		update_usermeta( $user_id, 'gujarati_rating', $_POST['gujarati_rating'] );
		update_usermeta( $user_id, 'urdu_rating', $_POST['urdu_rating'] );
		update_usermeta( $user_id, 'polish_rating', $_POST['polish_rating'] );
		update_usermeta( $user_id, 'punjabi_rating', $_POST['punjabi_rating'] );
		update_usermeta( $user_id, 'wu_rating', $_POST['wu_rating'] );

		update_usermeta( $user_id, 'other_rating', $_POST['other_rating'] );


		set_cimyFieldValue($user_id, 'LANGUAGES_WRITTEN', implode(', ', $_POST['LANGUAGES_WRITTEN'] ) );
		set_cimyFieldValue($user_id, 'LANGUAGES_WRITTEN_OT', $_POST['LANGUAGES_WRITTEN_OT'] );

		set_cimyFieldValue($user_id, 'CUR_WORK_SITUATION', implode(',', $_POST['CUR_WORK_SITUATION'] ) );

		set_cimyFieldValue($user_id, 'US_ARMED_FORCES', $_POST['US_ARMED_FORCES'] );
		set_cimyFieldValue($user_id, 'US_ARMED_FORCES_OPTI', $_POST['US_ARMED_FORCES_OPTION'] );
		set_cimyFieldValue($user_id, 'LOCAL_LAW_FORCE_YN', $_POST['LOCAL_LAW_FORCE_YN'] );
		set_cimyFieldValue($user_id, 'FEDERAL_NVESTIGATIV', $_POST['FEDERAL_NVESTIGATIV'] );
		set_cimyFieldValue($user_id, 'US_LAW_ENFORCE_STATU', $_POST['US_LAW_ENFORCE_STATU'] );
		set_cimyFieldValue($user_id, 'US_LAW_ENFORCE_OTHER', $_POST['US_LAW_ENFORCE_OTHER'] );

		set_cimyFieldValue($user_id, 'MAJOR_METROPOLITAN', $_POST['MAJOR_METROPOLITAN'] );
		set_cimyFieldValue($user_id, 'MAJOR_METROPOLITAN_O', $_POST['MAJOR_METROPOLITAN_O'] );
		set_cimyFieldValue($user_id, 'SEEKER_ZIP_CODE', $_POST['SEEKER_ZIP_CODE'] );

		$wpdb->insert(
			$wpdb->prefix.'user_activity_log',
			array(
				'user_id'  => $user_id,
				'action'   => 'UpdateBasicInfo',
				'datetime' => time(),
				'meta'     => 'Modified Preferences > basic info'
			),
			array( '%d', '%s', '%s', '%s' )
		);

		/*$wpdb->delete(
			$wpdb->prefix.'user_activity_log',
			array(
				'user_id'  => $user_id
			),
			array( '%d')
		);*/
	}

}


/*..............AjAx Update jobseeker basic ProFile FiELDS..................*/
add_action('wp_ajax_editContactInfo', 'editContactInfo');
add_action('wp_ajax_nopriv_editContactInfo', 'editContactInfo');

function editContactInfo() {
	global $wpdb;
	$return = array();
	if ( isset( $_POST['fname'] ) && isset( $_POST['lname'] ) && isset( $_POST['uemail'] ) && isset( $_POST['contno'] ) ) {
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$uemail = $_POST['uemail'];
		$contno = $_POST['contno'];
		$suemail = $_POST['suemail'];
		$bestTr = $_POST['bestTr'];
		$user_id = get_current_user_id();

		$saveEmail = wp_update_user( array( 'ID' => $user_id, 'user_email' => $uemail ) );

		if ( is_wp_error( $saveEmail ) ) {
			$return['status'] = 'exist';
			die(json_encode($return));
		}
		else{
			update_user_meta($user_id, 'first_name', $fname);
			update_user_meta($user_id, 'last_name', $lname);
			update_user_meta($user_id, 'cell_phone', $contno);
			update_user_meta($user_id, 'sec_email', $suemail);
			set_cimyFieldValue($user_id, 'JOB_SEARCH_RADIUS', $bestTr);

			$wpdb->insert(
				$wpdb->prefix.'user_activity_log',
				array(
					'user_id'  => $user_id,
					'action'   => 'NameAndContactInfo',
					'datetime' => time(),
					'meta'     => 'Modified Preferences > name and contact info'
				),
				array( '%d', '%s', '%s', '%s' )
			);

			$return['status'] = 'success';
			die(json_encode($return));
		}
	}
	else{
		$return['status'] = 'fail';
		die(json_encode($return));
	}

}


function my_avatar_filter() {
	// Remove from show_user_profile hook
	remove_action('show_user_profile', array('wp_user_avatar', 'wpua_action_show_user_profile'));
	remove_action('show_user_profile', array('wp_user_avatar', 'wpua_media_upload_scripts'));

	// Remove from edit_user_profile hook
	remove_action('edit_user_profile', array('wp_user_avatar', 'wpua_action_show_user_profile'));
	remove_action('edit_user_profile', array('wp_user_avatar', 'wpua_media_upload_scripts'));

	// Add to edit_user_avatar hook
	add_action('edit_user_avatar', array('wp_user_avatar', 'wpua_action_show_user_profile'));
	add_action('edit_user_avatar', array('wp_user_avatar', 'wpua_media_upload_scripts'));
}

// Loads only outside of administration panel
if(!is_admin()) {
	add_action('init','my_avatar_filter');
}


/*..............AjAx Update jobseeker Security Question ProFile FiELDS..................*/
add_action('wp_ajax_addRemoveSecQuestion', 'addRemoveSecQuestion');
add_action('wp_ajax_nopriv_addRemoveSecQuestion', 'addRemoveSecQuestion');

function addRemoveSecQuestion() {
	$user_id = get_current_user_id();
	$msg = array();
	if ( isset($_POST['actType']) && isset($_POST['ques']) && isset($_POST['ans']) && !empty($_POST['ques']) && !empty($_POST['ans']) ) {
		$ques     = $_POST['ques'];
		$ans    = $_POST['ans'];
		$quesCon  = $_POST['quesCon'];

		set_cimyFieldValue($user_id, 'YOUR_SECURITY', $ques);
		set_cimyFieldValue($user_id, 'YOUR_ANSWER', $ans);
		set_cimyFieldValue($user_id, 'YOUR_ANSWER_CON', $quesCon);

		global $wpdb;
		$wpdb->insert(
			$wpdb->prefix.'user_activity_log',
			array(
				'user_id'  => $user_id,
				'action'   => 'changeSecurityquestion',
				'datetime' => time(),
				'meta'     => 'Modified Preferences > Change security question'
			),
			array( '%d', '%s', '%s', '%s' )
		);

		$msg['status'] = 'success';
		die( json_encode($msg) );
	}
	else{
		$ques = ( empty($_POST['ques']) )? 'quesEmpty' :'';
		$ans = ( empty($_POST['ans']) )? 'ansEmpty' :'';
		$msg['ques'] =  $ques;
		$msg['ans'] = $ans;
		die( json_encode($msg) );
	} 
}

/*..............AjAx Update jobseeker Remove Security Question ProFile FiELDS..................*/
add_action('wp_ajax_quesRemoveSecQuestion', 'quesRemoveSecQuestion');
add_action('wp_ajax_nopriv_quesRemoveSecQuestion', 'quesRemoveSecQuestion');

function quesRemoveSecQuestion() {
	$user_id = get_current_user_id();
	set_cimyFieldValue($user_id, 'YOUR_SECURITY', '');
	set_cimyFieldValue($user_id, 'YOUR_ANSWER', '');
	set_cimyFieldValue($user_id, 'YOUR_ANSWER_CON', '');
	die();
}



/*..............AjAx Add Job seeker Resume..................*/
add_action('wp_ajax_cvf_upload_resumefiles', 'cvf_upload_resumefiles');
add_action('wp_ajax_nopriv_cvf_upload_resumefiles', 'cvf_upload_resumefiles');

function cvf_upload_resumefiles(){
	if ( !is_user_logged_in() ) {
		printf( __('%s'), '<label class="error">Something wrong!. Please try again.</label>' );
		die();
	}
	$user_id = get_current_user_id();
	global $wpdb;
		$valid_formats = array("pdf", "doc", "docx");
		$max_file_size = 3000000;
		$wp_upload_dir = wp_upload_dir();
		$path = $wp_upload_dir['basedir'].'/resume/';
		if (!file_exists( $path.date('Y/m/d') ) ) {
			mkdir($path.date('Y/m/d'), 0777, true);
	}
	$path = $path.date('Y/m/d').'/';

		if( $_SERVER['REQUEST_METHOD'] == "POST" ){
			foreach ( $_FILES['files']['name'] as $f => $name ) {
				$actual_name = pathinfo($name, PATHINFO_FILENAME);
			$original_name = $actual_name;
			$extension = pathinfo($name, PATHINFO_EXTENSION);
				if ( $_FILES['files']['error'][$f] == 0 ) {
						if ( $_FILES['files']['size'][$f] > $max_file_size ) {
								$upload_message[] = '<label class="error">File is too large!.</label>';
								continue;
						} elseif( ! in_array( strtolower( $extension ), $valid_formats ) ){
								$upload_message[] = '<label class="error">File is not a valid format. Allow only pdf, doc, and docx format.</label>';
								continue;
						} 
						else{
					$i = 1;
					while( file_exists($path.$actual_name.".".$extension) )
					{           
							$actual_name = $original_name.$i;
							$name = $actual_name.".".$extension;
							$i++;
					}
						$basename = basename($name);
							if( move_uploaded_file( $_FILES["files"]["tmp_name"][$f], $path.$basename ) ) {
									$filefullpath = $wp_upload_dir['baseurl'].'/resume/'.date('Y/m/d').'/'.$basename;
									$file = '/resume/'.date('Y/m/d').'/'.$basename;


									$reargs = array(
							'author__in' => array($user_id),
							'post_type'   => 'resume',
							'post_status' => 'publish'
						);
						$the_query = new WP_Query( $reargs );
						if ( ($the_query->have_posts()) || ($countfile > 0) ) {
							
							$wpdb->insert(
										$wpdb->prefix.'jobseeker_resume',
										array(
											'user_id' => $user_id,
									'datetime' => time(),
									'filefullpath' => $filefullpath,
									'file' => $file,
									'access' => 'Restrict Access',
									'other' => $actual_name,
									'docType' => 'resume'
										),
										array('%d','%s','%s','%s','%s', '%s', '%s')
									);
							wp_reset_postdata();
						} 
						else {
							$wpdb->insert(
										$wpdb->prefix.'jobseeker_resume',
										array(
											'user_id' => $user_id,
									'datetime' => time(),
									'filefullpath' => $filefullpath,
									'file' => $file,
									'access' => 'Restrict Access',
									'other' => $actual_name,
									'docType' => 'resume'
										),
										array('%d','%s','%s','%s','%s', '%s', '%s')
									);

									$fileid = $wpdb->insert_id;
									$userdata = get_userdata($user_id);
							$candidate_name = $userdata->first_name.' '.$userdata->last_name;
									$data = array(
								'post_title'     => $candidate_name,
								'post_type'      => 'resume',
								'comment_status' => 'closed',
								'post_password'  => '',
								'post_author'    => $user_id,
								'post_status' => 'publish'
							);

							$resume_id = wp_insert_post( $data );
							update_post_meta($resume_id, '_resume_file', $filefullpath);
							update_post_meta($resume_id, '_candidate_name', $candidate_name);
							update_post_meta($resume_id, 'resumefileid', $fileid);
						}

						$wpdb->insert(
							$wpdb->prefix.'user_activity_log',
							array(
								'user_id'  => $user_id,
								'action'   => 'resume',
								'datetime' => time(),
								'meta'     => 'Navigation > Upload a resume ( '.$basename.' )'
							),
							array( '%d', '%s', '%s', '%s' )
						);

								$upload_message[] = '<p class="success">Successfully added.</p>';
							}
				}
			}
		}
	}

	if ( isset( $upload_message ) ) :
				foreach ( $upload_message as $msg ){       
						printf( __('%s'), $msg );
				}
		endif;
		die();
}

/*..............AjAx Delete resume..................*/
add_action('wp_ajax_removeJobseekerResume', 'removeJobseekerResume');
add_action('wp_ajax_nopriv_removeJobseekerResume', 'removeJobseekerResume');

function removeJobseekerResume() {
	$user_id = get_current_user_id();
	global $wpdb;
	if ( isset($_POST['docId']) && !empty($_POST['docId']) ) {

		$path = wp_upload_dir();
		$file = $path['basedir'];
		$tableName = $wpdb->prefix.'jobseeker_resume';
		$getfilepath = $wpdb->get_row("SELECT * FROM $tableName WHERE id = '".$_POST['docId']."' ");
		$fileName = $getfilepath->file;
		$docType = $getfilepath->docType;
		$fileNameArr = explode('/', $fileName);
		$basename = end($fileNameArr);

		if ( isset($_POST['removedoctype']) && !empty($_POST['removedoctype']) ) {

			$reargs = array(
				'author__in' => array($user_id),
				'post_type'   => 'resume',
				'post_status' => 'publish'
			);

			$the_query = new WP_Query( $reargs );

			$resumefileid = array();
			$postid = array();
			if ( $the_query->have_posts() ) {
				while ( $the_query->have_posts() ) {
					$the_query->the_post();
					$resumefileid[] = get_post_meta(get_the_ID(), 'resumefileid', true);
					$postid[] = get_the_ID();
				}
				wp_reset_postdata();
			} else {
				$resumefileid = '';
			}

			$getfiekdid = ( !empty($resumefileid) )? $resumefileid : array();
			$getpostid = ( !empty($postid) )? $postid : array();

			if ( $docType == 'cover_letters' ) {
				$docType = 'cover letter';
			}
			elseif( $docType == 'background_doc' ) {
				$docType = 'background doc';
			}
			else{
				$docType = $docType;
			}
			
			
			if( in_array($_POST['docId'], $getfiekdid) ){
				foreach ($getpostid as  $value) {
					wp_delete_post($value);
				}
				!unlink($file.$fileName);
				$wpdb->delete( 
					$tableName,
					array( 'id' => $_POST['docId'] ),
					array( '%d' )
				);

				$wpdb->insert(
					$wpdb->prefix.'user_activity_log',
					array(
						'user_id'  => $user_id,
						'action'   => 'removeResume',
						'datetime' => time(),
						'meta'     => 'Navigation > Delete a '.$docType.' that use for <b>Job Apply</b> ( '.$basename.' )'
					),
					array( '%d', '%s', '%s', '%s' )
				);
			}
			else{
				!unlink($file.$fileName);
				$wpdb->delete( 
					$tableName,
					array( 'id' => $_POST['docId'] ),
					array( '%d' )
				);

				$wpdb->insert(
					$wpdb->prefix.'user_activity_log',
					array(
						'user_id'  => $user_id,
						'action'   => 'removeResume',
						'datetime' => time(),
						'meta'     => 'Navigation > Delete a '.$docType.' ( '.$basename.' )'
					),
					array( '%d', '%s', '%s', '%s' )
				);
			}
		}
		else{
			!unlink($file.$fileName);
			$wpdb->delete( 
				$tableName,
				array( 'id' => $_POST['docId'] ),
				array( '%d' )
			);
			$wpdb->insert(
				$wpdb->prefix.'user_activity_log',
				array(
					'user_id'  => $user_id,
					'action'   => 'removeResume',
					'datetime' => time(),
					'meta'     => 'Navigation > Delete a '.$docType.' ( '.$basename.' )'
				),
				array( '%d', '%s', '%s', '%s' )
			);
		}
		echo "success"; 
	}
	die();
}

/*..............AjAx Update Resume Aceess..................*/
add_action('wp_ajax_accessJobseekerResume', 'accessJobseekerResume');
add_action('wp_ajax_nopriv_accessJobseekerResume', 'accessJobseekerResume');

function accessJobseekerResume() {
	$user_id = get_current_user_id();
	global $wpdb;
	if ( isset($_POST['docId']) ) {
		$tableName = $wpdb->prefix.'jobseeker_resume';
		
		$getfilepath = $wpdb->get_row("SELECT * FROM $tableName WHERE id = '".$_POST['docId']."' ");
		$fileName = $getfilepath->file;
		$fileNameArr = explode('/', $fileName);
		$basename = end($fileNameArr);
		$access = $getfilepath->access;
		$docType = $getfilepath->docType;

		$wpdb->update( 
			$tableName,
			array( 'access' => $_POST['thisVal'] ),
			array( 'id' => $_POST['docId'] ),
			array( '%s' ),
			array( '%d' )
		);

		// $doctype = array('resume', 'cover_letters', 'education', 'certificate', 'honors', 'background_doc', 'license');

		if ( $docType == 'cover_letters' ) {
			$docType = 'cover letter';
		}
		elseif( $docType == 'background_doc' ) {
			$docType = 'background doc';
		}
		else{
			$docType = $docType;
		}
		
		$wpdb->insert(
			$wpdb->prefix.'user_activity_log',
			array(
				'user_id'  => $user_id,
				'action'   => 'changePer',
				'datetime' => time(),
				'meta'     => 'Navigation > change permission for '.$docType.'( '.$basename.' ) from '.$access.'  to  '.$_POST['thisVal']
			),
			array( '%d', '%s', '%s', '%s' )
		);

		echo "success";
	}
	die();
}



/*..............AjAx Add Job seeker Educatio Doc..................*/
add_action('wp_ajax_cvf_upload_educationfiles', 'cvf_upload_educationfiles');
add_action('wp_ajax_nopriv_cvf_upload_educationfiles', 'cvf_upload_educationfiles');

function cvf_upload_educationfiles(){
	if ( !is_user_logged_in() ) {
		printf( __('%s'), '<label class="error">Something wrong!. Please try again.</label>' );
		die();
	}
	$user_id = get_current_user_id();
	global $wpdb;
		$valid_formats = array("pdf", "jpg", "jpeg", "png");
		$max_file_size = 3000000;
		$wp_upload_dir = wp_upload_dir();
		$path = $wp_upload_dir['basedir'].'/resume/';
		if (!file_exists( $path.date('Y/m/d') ) ) {
			mkdir($path.date('Y/m/d'), 0777, true);
	}
	$path = $path.date('Y/m/d').'/';

		if( $_SERVER['REQUEST_METHOD'] == "POST" ){
			foreach ( $_FILES['files']['name'] as $f => $name ) {
				$actual_name = pathinfo($name, PATHINFO_FILENAME);
			$original_name = $actual_name;
			$extension = pathinfo($name, PATHINFO_EXTENSION);
				if ( $_FILES['files']['error'][$f] == 0 ) {
						if ( $_FILES['files']['size'][$f] > $max_file_size ) {
								$upload_message[] = '<label class="error">File is too large!.</label>';
								continue;
						} elseif( ! in_array( strtolower( $extension ), $valid_formats ) ){
								$upload_message[] = '<label class="error">File is not a valid format. Allow only pdf, jpg, jpeg and png format.</label>';
								continue;
						} 
						else{
					$i = 1;
					while( file_exists($path.$actual_name.".".$extension) )
					{           
							$actual_name = $original_name.$i;
							$name = $actual_name.".".$extension;
							$i++;
					}
						$basename = basename($name);
							if( move_uploaded_file( $_FILES["files"]["tmp_name"][$f], $path.$basename ) ) {
									$filefullpath = $wp_upload_dir['baseurl'].'/resume/'.date('Y/m/d').'/'.$basename;
									$file = '/resume/'.date('Y/m/d').'/'.$basename;
								$wpdb->insert(
									$wpdb->prefix.'jobseeker_resume',
									array(
										'user_id' => $user_id,
								'datetime' => time(),
								'filefullpath' => $filefullpath,
								'file' => $file,
								'access' => 'Restrict Access',
								'other' => $actual_name,
								'docType' => 'education'
									),
									array('%d','%s','%s','%s','%s', '%s', '%s')
								);

								$wpdb->insert(
							$wpdb->prefix.'user_activity_log',
							array(
								'user_id'  => $user_id,
								'action'   => 'education',
								'datetime' => time(),
								'meta'     => 'Navigation > Upload a education document ( '.$basename.' )'
							),
							array( '%d', '%s', '%s', '%s' )
						);
								
								$upload_message[] = '<p class="success">Successfully added.</p>';
							}
				}
			}
		}
	}

	if ( isset( $upload_message ) ) :
				foreach ( $upload_message as $msg ){       
						printf( __('%s'), $msg );
				}
		endif;
		die();
}



/*..............AjAx Add Job seeker Educatio Doc..................*/
add_action('wp_ajax_cvf_upload_certificatesfiles', 'cvf_upload_certificatesfiles');
add_action('wp_ajax_nopriv_cvf_upload_certificatesfiles', 'cvf_upload_certificatesfiles');

function cvf_upload_certificatesfiles(){
	if ( !is_user_logged_in() ) {
		printf( __('%s'), '<label class="error">Something wrong!. Please try again.</label>' );
		die();
	}
	$user_id = get_current_user_id();
	global $wpdb;
		$valid_formats = array("pdf", "jpg", "jpeg", "png");
		$max_file_size = 3000000;
		$wp_upload_dir = wp_upload_dir();
		$path = $wp_upload_dir['basedir'].'/resume/';
		if (!file_exists( $path.date('Y/m/d') ) ) {
			mkdir($path.date('Y/m/d'), 0777, true);
	}
	$path = $path.date('Y/m/d').'/';

		if( $_SERVER['REQUEST_METHOD'] == "POST" ){
			foreach ( $_FILES['files']['name'] as $f => $name ) {
				$actual_name = pathinfo($name, PATHINFO_FILENAME);
			$original_name = $actual_name;
			$extension = pathinfo($name, PATHINFO_EXTENSION);
				if ( $_FILES['files']['error'][$f] == 0 ) {
						if ( $_FILES['files']['size'][$f] > $max_file_size ) {
								$upload_message[] = '<label class="error">File is too large!.</label>';
								continue;
						} elseif( ! in_array( strtolower( $extension ), $valid_formats ) ){
								$upload_message[] = '<label class="error">File is not a valid format. Allow only pdf, jpg, jpeg and png format.</label>';
								continue;
						} 
						else{
					$i = 1;
					while( file_exists($path.$actual_name.".".$extension) )
					{           
							$actual_name = $original_name.$i;
							$name = $actual_name.".".$extension;
							$i++;
					}
						$basename = basename($name);
							if( move_uploaded_file( $_FILES["files"]["tmp_name"][$f], $path.$basename ) ) {
									$filefullpath = $wp_upload_dir['baseurl'].'/resume/'.date('Y/m/d').'/'.$basename;
									$file = '/resume/'.date('Y/m/d').'/'.$basename;
								$wpdb->insert(
									$wpdb->prefix.'jobseeker_resume',
									array(
										'user_id' => $user_id,
								'datetime' => time(),
								'filefullpath' => $filefullpath,
								'file' => $file,
								'access' => 'Restrict Access',
								'other' => $actual_name,
								'docType' => 'certificate'
									),
									array('%d','%s','%s','%s','%s', '%s', '%s')
								);

								$wpdb->insert(
							$wpdb->prefix.'user_activity_log',
							array(
								'user_id'  => $user_id,
								'action'   => 'certificate',
								'datetime' => time(),
								'meta'     => 'Navigation > Upload a certificate ( '.$basename.' )'
							),
							array( '%d', '%s', '%s', '%s' )
						);
								
								$upload_message[] = '<p class="success">Successfully added.</p>';
							}
				}
			}
		}
	}

	if ( isset( $upload_message ) ) :
				foreach ( $upload_message as $msg ){       
						printf( __('%s'), $msg );
				}
		endif;
		die();
}


/*..............AjAx Add Job seeker License Doc..................*/
add_action('wp_ajax_cvf_upload_licensesfiles', 'cvf_upload_licensesfiles');
add_action('wp_ajax_nopriv_cvf_upload_licensesfiles', 'cvf_upload_licensesfiles');

function cvf_upload_licensesfiles(){
	if ( !is_user_logged_in() ) {
		printf( __('%s'), '<label class="error">Something wrong!. Please try again.</label>' );
		die();
	}
	$user_id = get_current_user_id();
	global $wpdb;
		$valid_formats = array("pdf", "jpg", "jpeg", "png");
		$max_file_size = 3000000;
		$wp_upload_dir = wp_upload_dir();
		$path = $wp_upload_dir['basedir'].'/resume/';
		if (!file_exists( $path.date('Y/m/d') ) ) {
			mkdir($path.date('Y/m/d'), 0777, true);
	}
	$path = $path.date('Y/m/d').'/';

		if( $_SERVER['REQUEST_METHOD'] == "POST" ){
			foreach ( $_FILES['files']['name'] as $f => $name ) {
				$actual_name = pathinfo($name, PATHINFO_FILENAME);
			$original_name = $actual_name;
			$extension = pathinfo($name, PATHINFO_EXTENSION);
				if ( $_FILES['files']['error'][$f] == 0 ) {
						if ( $_FILES['files']['size'][$f] > $max_file_size ) {
								$upload_message[] = '<label class="error">File is too large!.</label>';
								continue;
						} elseif( ! in_array( strtolower( $extension ), $valid_formats ) ){
								$upload_message[] = '<label class="error">File is not a valid format. Allow only pdf, jpg, jpeg and png format.</label>';
								continue;
						} 
						else{
					$i = 1;
					while( file_exists($path.$actual_name.".".$extension) )
					{           
							$actual_name = $original_name.$i;
							$name = $actual_name.".".$extension;
							$i++;
					}
						$basename = basename($name);
							if( move_uploaded_file( $_FILES["files"]["tmp_name"][$f], $path.$basename ) ) {
									$filefullpath = $wp_upload_dir['baseurl'].'/resume/'.date('Y/m/d').'/'.$basename;
									$file = '/resume/'.date('Y/m/d').'/'.$basename;
								$wpdb->insert(
									$wpdb->prefix.'jobseeker_resume',
									array(
										'user_id' => $user_id,
								'datetime' => time(),
								'filefullpath' => $filefullpath,
								'file' => $file,
								'access' => 'Restrict Access',
								'other' => $actual_name,
								'docType' => 'license'
									),
									array('%d','%s','%s','%s','%s', '%s', '%s')
								);

								$wpdb->insert(
							$wpdb->prefix.'user_activity_log',
							array(
								'user_id'  => $user_id,
								'action'   => 'license',
								'datetime' => time(),
								'meta'     => 'Navigation > Upload a license ( '.$basename.' )'
							),
							array( '%d', '%s', '%s', '%s' )
						);
								
								$upload_message[] = '<p class="success">Successfully added.</p>';
							}
				}
			}
		}
	}

	if ( isset( $upload_message ) ) :
				foreach ( $upload_message as $msg ){       
						printf( __('%s'), $msg );
				}
		endif;
		die();
}



/*..............AjAx Add Job seeker License Doc..................*/
add_action('wp_ajax_cvf_upload_honorsfiles', 'cvf_upload_honorsfiles');
add_action('wp_ajax_nopriv_cvf_upload_honorsfiles', 'cvf_upload_honorsfiles');

function cvf_upload_honorsfiles(){
	if ( !is_user_logged_in() ) {
		printf( __('%s'), '<label class="error">Something wrong!. Please try again.</label>' );
		die();
	}
	$user_id = get_current_user_id();
	global $wpdb;
		$valid_formats = array("pdf", "jpg", "jpeg", "png");
		$max_file_size = 3000000;
		$wp_upload_dir = wp_upload_dir();
		$path = $wp_upload_dir['basedir'].'/resume/';
		if (!file_exists( $path.date('Y/m/d') ) ) {
			mkdir($path.date('Y/m/d'), 0777, true);
	}
	$path = $path.date('Y/m/d').'/';

		if( $_SERVER['REQUEST_METHOD'] == "POST" ){
			foreach ( $_FILES['files']['name'] as $f => $name ) {
				$actual_name = pathinfo($name, PATHINFO_FILENAME);
			$original_name = $actual_name;
			$extension = pathinfo($name, PATHINFO_EXTENSION);
				if ( $_FILES['files']['error'][$f] == 0 ) {
						if ( $_FILES['files']['size'][$f] > $max_file_size ) {
								$upload_message[] = '<label class="error">File is too large!.</label>';
								continue;
						} elseif( ! in_array( strtolower( $extension ), $valid_formats ) ){
								$upload_message[] = '<label class="error">File is not a valid format. Allow only pdf, jpg, jpeg and png format.</label>';
								continue;
						} 
						else{
					$i = 1;
					while( file_exists($path.$actual_name.".".$extension) )
					{           
							$actual_name = $original_name.$i;
							$name = $actual_name.".".$extension;
							$i++;
					}
						$basename = basename($name);
							if( move_uploaded_file( $_FILES["files"]["tmp_name"][$f], $path.$basename ) ) {
									$filefullpath = $wp_upload_dir['baseurl'].'/resume/'.date('Y/m/d').'/'.$basename;
									$file = '/resume/'.date('Y/m/d').'/'.$basename;
								$wpdb->insert(
									$wpdb->prefix.'jobseeker_resume',
									array(
										'user_id' => $user_id,
								'datetime' => time(),
								'filefullpath' => $filefullpath,
								'file' => $file,
								'access' => 'Restrict Access',
								'other' => $actual_name,
								'docType' => 'honors'
									),
									array('%d','%s','%s','%s','%s', '%s', '%s')
								);

								$wpdb->insert(
							$wpdb->prefix.'user_activity_log',
							array(
								'user_id'  => $user_id,
								'action'   => 'honors',
								'datetime' => time(),
								'meta'     => 'Navigation > Upload a honors and awards document ( '.$basename.' )'
							),
							array( '%d', '%s', '%s', '%s' )
						);
								
								$upload_message[] = '<p class="success">Successfully added.</p>';
							}
				}
			}
		}
	}

	if ( isset( $upload_message ) ) :
				foreach ( $upload_message as $msg ){       
						printf( __('%s'), $msg );
				}
		endif;
		die();
}


/*..............AjAx Add Job seeker Cover letter Doc..................*/
add_action('wp_ajax_cvf_upload_coverlettersfiles', 'cvf_upload_coverlettersfiles');
add_action('wp_ajax_nopriv_cvf_upload_coverlettersfiles', 'cvf_upload_coverlettersfiles');

function cvf_upload_coverlettersfiles(){
	if ( !is_user_logged_in() ) {
		printf( __('%s'), '<label class="error">Something wrong!. Please try again.</label>' );
		die();
	}
	$user_id = get_current_user_id();
	global $wpdb;
		$valid_formats = array("pdf", "jpg", "jpeg", "png");
		$max_file_size = 3000000;
		$wp_upload_dir = wp_upload_dir();
		$path = $wp_upload_dir['basedir'].'/resume/';
		if (!file_exists( $path.date('Y/m/d') ) ) {
			mkdir($path.date('Y/m/d'), 0777, true);
	}
	$path = $path.date('Y/m/d').'/';

		if( $_SERVER['REQUEST_METHOD'] == "POST" ){
			foreach ( $_FILES['files']['name'] as $f => $name ) {
				$actual_name = pathinfo($name, PATHINFO_FILENAME);
			$original_name = $actual_name;
			$extension = pathinfo($name, PATHINFO_EXTENSION);
				if ( $_FILES['files']['error'][$f] == 0 ) {
						if ( $_FILES['files']['size'][$f] > $max_file_size ) {
								$upload_message[] = '<label class="error">File is too large!.</label>';
								continue;
						} elseif( ! in_array( strtolower( $extension ), $valid_formats ) ){
								$upload_message[] = '<label class="error">File is not a valid format. Allow only pdf, jpg, jpeg and png format.</label>';
								continue;
						} 
						else{
					$i = 1;
					while( file_exists($path.$actual_name.".".$extension) )
					{           
							$actual_name = $original_name.$i;
							$name = $actual_name.".".$extension;
							$i++;
					}
						$basename = basename($name);
							if( move_uploaded_file( $_FILES["files"]["tmp_name"][$f], $path.$basename ) ) {
									$filefullpath = $wp_upload_dir['baseurl'].'/resume/'.date('Y/m/d').'/'.$basename;
									$file = '/resume/'.date('Y/m/d').'/'.$basename;
								$wpdb->insert(
									$wpdb->prefix.'jobseeker_resume',
									array(
										'user_id' => $user_id,
								'datetime' => time(),
								'filefullpath' => $filefullpath,
								'file' => $file,
								'access' => 'Restrict Access',
								'other' => $actual_name,
								'docType' => 'cover_letters'
									),
									array('%d','%s','%s','%s','%s', '%s', '%s')
								);

								$wpdb->insert(
							$wpdb->prefix.'user_activity_log',
							array(
								'user_id'  => $user_id,
								'action'   => 'cover_letters',
								'datetime' => time(),
								'meta'     => 'Navigation > Upload a cover letter ( '.$basename.' )'
							),
							array( '%d', '%s', '%s', '%s' )
						);
								
								$upload_message[] = '<p class="success">Successfully added.</p>';
							}
				}
			}
		}
	}

	if ( isset( $upload_message ) ) :
				foreach ( $upload_message as $msg ){       
						printf( __('%s'), $msg );
				}
		endif;
		die();
}


/*..............AjAx Add Job seeker Background Doc..................*/
add_action('wp_ajax_cvf_upload_backgroundfiles', 'cvf_upload_backgroundfiles');
add_action('wp_ajax_nopriv_cvf_upload_backgroundfiles', 'cvf_upload_backgroundfiles');

function cvf_upload_backgroundfiles(){
	if ( !is_user_logged_in() ) {
		printf( __('%s'), '<label class="error">Something wrong!. Please try again.</label>' );
		die();
	}
	$user_id = get_current_user_id();
	global $wpdb;
		$valid_formats = array("pdf", "jpg", "jpeg", "png","doc","docx");
		$max_file_size = 3000000;
		$wp_upload_dir = wp_upload_dir();
		$path = $wp_upload_dir['basedir'].'/resume/';
		// $path = $wp_upload_dir['basedir'].'/docs-background/';
		if (!file_exists( $path.date('Y/m/d') ) ) {
			mkdir($path.date('Y/m/d'), 0777, true);
	}
	$path = $path.date('Y/m/d').'/';

		if( $_SERVER['REQUEST_METHOD'] == "POST" ){
			foreach ( $_FILES['files']['name'] as $f => $name ) {
				$actual_name = pathinfo($name, PATHINFO_FILENAME);
			$original_name = $actual_name;
			$extension = pathinfo($name, PATHINFO_EXTENSION);
				if ( $_FILES['files']['error'][$f] == 0 ) {
						if ( $_FILES['files']['size'][$f] > $max_file_size ) {
								$upload_message[] = '<label class="error">File is too large!.</label>';
								continue;
						} elseif( ! in_array( strtolower( $extension ), $valid_formats ) ){
								$upload_message[] = '<label class="error">File is not a valid format. Allow only pdf, jpg, jpeg, png, doc, and docx format.</label>';
								continue;
						} 
						else{
					$i = 1;
					while( file_exists($path.$actual_name.".".$extension) )
					{           
							$actual_name = $original_name.$i;
							$name = $actual_name.".".$extension;
							$i++;
					}
						$basename = basename($name);
							if( move_uploaded_file( $_FILES["files"]["tmp_name"][$f], $path.$basename ) ) {
									$filefullpath = $wp_upload_dir['baseurl'].'/resume/'.date('Y/m/d').'/'.$basename;
									$file = '/resume/'.date('Y/m/d').'/'.$basename;
								$wpdb->insert(
									$wpdb->prefix.'jobseeker_resume',
									array(
										'user_id' => $user_id,
								'datetime' => time(),
								'filefullpath' => $filefullpath,
								'file' => $file,
								'access' => 'Restrict Access',
								'other' => $actual_name,
								'docType' => 'background_doc'
									),
									array('%d','%s','%s','%s','%s', '%s', '%s')
								);

						$wpdb->insert(
							$wpdb->prefix.'user_activity_log',
							array(
								'user_id'  => $user_id,
								'action'   => 'background_doc',
								'datetime' => time(),
								'meta'     => 'Navigation > Upload a background document ( '.$basename.' )'
							),
							array( '%d', '%s', '%s', '%s' )
						);
								
								$upload_message[] = '<p class="success">Successfully added.</p>';
							}
				}
			}
		}
	}

	if ( isset( $upload_message ) ) :
				foreach ( $upload_message as $msg ){       
						printf( __('%s'), $msg );
				}
		endif;
		die();
}


/*..............AjAx Remove saved job..................*/
add_action('wp_ajax_removeSavedJob', 'removeSavedJob');
add_action('wp_ajax_nopriv_removeSavedJob', 'removeSavedJob');

function removeSavedJob() {
	$return = array();
	if ( is_user_logged_in() ) {
		if ( isset( $_POST['id'] ) ) {
			$id = $_POST['id'];

			$postid = wp_get_post_parent_id($id);
			if ( wp_delete_post($id) ) {

				global $wpdb;
				$getpost = get_post($postid);
				$postTitle = $getpost->post_title;
				$posturl = get_the_permalink($postid);

				$user_id = get_current_user_id();
				$wpdb->insert(
					$wpdb->prefix.'user_activity_log',
					array(
						'user_id'  => $user_id,
						'action'   => 'removeappliedjob',
						'datetime' => time(),
						'meta'     => 'Remove applied job <a href="'.$posturl.'" target="_blank" >'.$postTitle.'</a>'
					),
					array( '%d', '%s', '%s', '%s' )
						);

				$return['status'] = 'success';
				die(json_encode($return));
			}
			else{
				$return['status'] = 'fail';
				die(json_encode($return));
			}
		}
		else{
			$return['status'] = 'fail';
			die(json_encode($return));
		}
	}
	else{
		$return['status'] = 'fail';
		die(json_encode($return));
	}
	$return['status'] = 'fail';
	die(json_encode($return));
}


/*..............AjAx Remove saved bookmarks..................*/
add_action('wp_ajax_removeMyBookmrks', 'removeMyBookmrks');
add_action('wp_ajax_nopriv_removeMyBookmrks', 'removeMyBookmrks');

function removeMyBookmrks() {
	$return = array();
	if ( is_user_logged_in() ) {
		if ( isset( $_POST['id'] ) ) {
			$id = $_POST['id'];

			global $wpdb;
			$tableName = 'eyecuwp_job_manager_bookmarks';
			$selectdata = $wpdb->get_row("SELECT * FROM $tableName WHERE id = '".$id."' ");
			$postid = $selectdata->post_id;
			if ( $wpdb->delete($tableName, array( 'id' => $id ), array('%d') ) ) {
				
				$getpost = get_post($postid);
				$postTitle = $getpost->post_title;
				$posturl = get_the_permalink($postid);

				$user_id = get_current_user_id();
				$wpdb->insert(
					$wpdb->prefix.'user_activity_log',
					array(
						'user_id'  => $user_id,
						'action'   => 'removeRefe',
						'datetime' => time(),
						'meta'     => 'Remove saved job <a href="'.$posturl.'" target="_blank" >'.$postTitle.'</a>'
					),
					array( '%d', '%s', '%s', '%s' )
						);  

						$return['status'] = 'success';
				die(json_encode($return));
			}
			else{
				$return['status'] = 'fail';
				die(json_encode($return));
			}
		}
		else{
			$return['status'] = 'fail';
			die(json_encode($return));
		}
	}
	else{
		$return['status'] = 'fail';
		die(json_encode($return));
	}
	$return['status'] = 'fail';
	die(json_encode($return));
}



/*..............AjAx Add alert..................*/
add_action('wp_ajax_saveAlertforJobs', 'saveAlertforJobs');
add_action('wp_ajax_nopriv_saveAlertforJobs', 'saveAlertforJobs');

function saveAlertforJobs() {
	$return = array();
	if ( isset($_POST) ) {
		parse_str($_POST['getdata'], $searcharray);

		$alert_name      = ( !empty($searcharray['alert_name']) ) ? sanitize_text_field( $searcharray['alert_name'] ) : '';
		$alert_keyword   = ( !empty($searcharray['alert_keyword']) ) ? sanitize_text_field( $searcharray['alert_keyword'] ) : '';
		$alert_location  = ( !empty($searcharray['alert_location']) ) ? sanitize_text_field( $searcharray['alert_location'] ) : '';
		$alert_frequency = ( !empty($searcharray['alert_frequency']) ) ? sanitize_text_field( $searcharray['alert_frequency'] ) : '';

		$alert_data = array(
			'post_title'     => $alert_name,
			'post_status'    => 'publish',
			'post_type'      => 'job_alert',
			'comment_status' => 'closed',
			'post_author'    => get_current_user_id()
		);

		$alert_id = wp_insert_post( $alert_data );
		
		if ( taxonomy_exists( 'job_listing_category' ) ) {
			$alert_cats = isset( $searcharray['alert_cats'] ) ? array_map( 'absint', $searcharray['alert_cats'] ) : '';
			wp_set_object_terms( $alert_id, $alert_cats, 'job_listing_category' );
		}

		if ( taxonomy_exists( 'job_listing_region' ) ) {
			$alert_regions = isset( $searcharray['alert_regions'] ) ? array_map( 'absint', $searcharray['alert_regions'] ) : '';
			wp_set_object_terms( $alert_id, $alert_regions, 'job_listing_region' );
		}

		if ( taxonomy_exists( 'job_listing_tag' ) ) {
			$alert_tags = isset( $searcharray['alert_tags'] ) ? array_map( 'absint', $searcharray['alert_tags'] ) : '';
			wp_set_object_terms( $alert_id, $alert_tags, 'job_listing_tag' );
		}

		$alert_job_type = isset( $searcharray['alert_job_type'] ) ? array_map( 'sanitize_title', $searcharray['alert_job_type'] ) : '';
		wp_set_object_terms( $alert_id, $alert_job_type, 'job_listing_type' );

		update_post_meta( $alert_id, 'alert_frequency', $alert_frequency );
		update_post_meta( $alert_id, 'alert_keyword', $alert_keyword );
		update_post_meta( $alert_id, 'alert_location', $alert_location );

		wp_clear_scheduled_hook( 'job-manager-alert', array( $alert_id ) );

		// Schedule new alert
		$schedules = WP_Job_Manager_Alerts_Notifier::get_alert_schedules();

		if ( ! empty( $schedules[ $alert_frequency ] ) ) {
			$next = strtotime( '+' . $schedules[ $alert_frequency ]['interval'] . ' seconds' );
		} else {
			$next = strtotime( '+1 day' );
		}

		// Create cron
		wp_schedule_event( $next, $alert_frequency, 'job-manager-alert', array( $alert_id ) );
		
		$return['msg'] = 'success';
		die( json_encode($return) );
	}
	else{
		$return['msg'] = 'fail';
		die( json_encode($return) );
	}
}


/*..............AjAx Add Bookmark..................*/
add_action('wp_ajax_saveCustomBookmarks', 'saveCustomBookmarks');
add_action('wp_ajax_nopriv_saveCustomBookmarks', 'saveCustomBookmarks');

function saveCustomBookmarks() {
	$return = array();
	if (isset($_POST)) {
		$WPJM_Updater = new WP_Job_Manager_Bookmarks();
		if ( !$WPJM_Updater->is_bookmarked($_POST['postid']) ){
			global $wpdb;
			$user_id = get_current_user_id();
			$wpdb->insert(
				"{$wpdb->prefix}job_manager_bookmarks",
				array(
					'user_id'       => $user_id,
					'post_id'       => $_POST['postid'],
					'date_created'  => current_time( 'mysql' )
				)
			);

			$getpost = get_post($_POST['postid']);
			$postTitle = $getpost->post_title;
			$posturl = get_the_permalink($_POST['postid']);

			$wpdb->insert(
				$wpdb->prefix.'user_activity_log',
				array(
					'user_id'  => $user_id,
					'action'   => 'removeRefe',
					'datetime' => time(),
					'meta'     => 'Save a job <a href="'.$posturl.'" target="_blank" >'.$postTitle.'</a>'
				),
				array( '%d', '%s', '%s', '%s' )
					);  

			$return['msg'] = 'success';
			die( json_encode($return) );
		}
		else{
			$return['msg'] = 'exist';
			die( json_encode($return) );
		}
	}
	else{
		$return['msg'] = 'fail';
		die( json_encode($return) );
	}
}



// Ajax for forward Job

add_action( 'wp_ajax_forwardThisJob', 'forwardThisJob' );
add_action( 'wp_ajax_nopriv_forwardThisJob', 'forwardThisJob' );
function forwardThisJob(){
	$return = array();
	if ( isset($_POST) ) {
		$to_fname   = $_POST['to_first_name'];
		$to_lname   = $_POST['to_last_name'];
		$to_email   = $_POST['to_email'];
		$form_fname   = $_POST['from_firstname'];
		$form_lname = $_POST['from_lastname'];
		$from_email = $_POST['from_email'];
		$sharemessae  = $_POST['share_message'];
		$jobid    = $_POST['jobid'];
		$post_title = str_replace('Applied', '', get_the_title($jobid) );
		$post_url = get_the_permalink($jobid);

		$get_option_arr       = get_option('forward_job');
		$subject          = str_replace('[from_name]', $form_fname.' '.$form_lname, $get_option_arr['forward_job_subject']);
		$msg              = $get_option_arr['forward_job_template'];

		$shordcode_to_rep   = array('[to_name]', '[post_title]', '[post_url]', '[shareMsg]', '[from_name]');
		$replace_with     = array($to_fname.' '.$to_lname, $post_title, $post_url, $sharemessae, $form_fname.' '.$form_lname );
		$message      = str_replace($shordcode_to_rep, $replace_with, $msg);
				
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		
		if ( wp_mail($to_email, $subject, $message, $headers) ) {

			global $wpdb;
			$getpost = get_post($jobid);
			$postTitle = $getpost->post_title;
			$posturl = get_the_permalink($jobid);

			$user_id = get_current_user_id();
			$wpdb->insert(
				$wpdb->prefix.'user_activity_log',
				array(
					'user_id'  => $user_id,
					'action'   => 'sharejob',
					'datetime' => time(),
					'meta'     => 'Share a job <a href="'.$posturl.'" target="_blank" >'.$postTitle.'</a> With '.$to_fname.' '.$to_lname.'( '.$to_email.' )'
				),
				array( '%d', '%s', '%s', '%s' )
					);

			$return['msg'] = 'success';
			die( json_encode($return) );
		}
		else{
			$return['msg'] = 'fail';
			die( json_encode($return) );
		}
			
	}
	$return['msg'] = 'fail';
	die( json_encode($return) );
}


/*.......Report this JoB.............*/

add_action( 'wp_ajax_saveactivityaftersendreport', 'saveactivityaftersendreport' );
add_action( 'wp_ajax_nopriv_saveactivityaftersendreport', 'saveactivityaftersendreport' );
function saveactivityaftersendreport(){
	if ( isset($_POST) ) {
		global $wpdb;
		$jobid    = $_POST['postid'];
		$getpost = get_post($jobid);
		$postTitle = $getpost->post_title;
		$posturl = get_the_permalink($jobid);

		$user_id = get_current_user_id();
		$wpdb->insert(
			$wpdb->prefix.'user_activity_log',
			array(
				'user_id'  => $user_id,
				'action'   => 'reportjob',
				'datetime' => time(),
				'meta'     => 'Report for job <a href="'.$posturl.'" target="_blank" >'.$postTitle.'</a>'
			),
			array( '%d', '%s', '%s', '%s' )
				);
		die();
	}
	else{
		die();
	}
}


add_action('wp_ajax_setjobapplyresumeAction', 'setjobapplyresumeAction');
add_action('wp_ajax_nopriv_setjobapplyresumeAction', 'setjobapplyresumeAction');

function setjobapplyresumeAction(){
	$return = array();
	if ( isset($_POST) && is_user_logged_in() ) {
		
		if ( !empty($_POST['resumeID']) && !empty($_POST['resumeUrl']) ) {
			$user_id = get_current_user_id();
			$userdata = get_userdata($user_id);
			$candidate_name = $userdata->first_name.' '.$userdata->last_name;
			$filefullpath = $_POST['resumeUrl'];
			$fileid = $_POST['resumeID'];

			$reargs = array(
				'author__in' => array($user_id),
				'post_type'   => 'resume',
				'post_status' => 'publish'
			);

			$the_query = new WP_Query( $reargs );

			if ( $the_query->have_posts() ) {
				while ( $the_query->have_posts() ) {
					$the_query->the_post();
					update_post_meta(get_the_ID(), '_resume_file', $filefullpath);
					update_post_meta(get_the_ID(), '_candidate_name', $candidate_name);
					update_post_meta(get_the_ID(), 'resumefileid', $fileid);
				}
				wp_reset_postdata();
			} else {
				$data = array(
					'post_title'     => $candidate_name,
					'post_type'      => 'resume',
					'comment_status' => 'closed',
					'post_password'  => '',
					'post_author'    => $user_id,
					'post_status' => 'publish'
				);

				$resume_id = wp_insert_post( $data );
				update_post_meta($resume_id, '_resume_file', $filefullpath);
				update_post_meta($resume_id, '_candidate_name', $candidate_name);
				update_post_meta($resume_id, 'resumefileid', $fileid);
			}

			global $wpdb;
			$fileNameArr = explode('/', $filefullpath);
			$basename = end($fileNameArr);
			$wpdb->insert(
				$wpdb->prefix.'user_activity_log',
				array(
					'user_id'  => $user_id,
					'action'   => 'updateResume',
					'datetime' => time(),
					'meta'     => 'Navigation > Update reume for job apply ( '.$basename.' )'
				),
				array( '%d', '%s', '%s', '%s' )
			);

			$return['msg'] = 'success';
			die( json_encode($return) );
		}
		else{
			$return['msg'] = 'fail';
			die( json_encode($return) );
		}
	}
	else{
		$return['msg'] = 'fail';
		die( json_encode($return) );
	}
}


/*..............Edit Currency.....................*/

add_action('wp_ajax_editCustomCurrency', 'editCustomCurrency');
add_action('wp_ajax_nopriv_editCustomCurrency', 'editCustomCurrency');

function editCustomCurrency(){
	$return = array();
	if ( isset($_POST) && is_user_logged_in() ) {
		global $wpdb;
		$user_id = get_current_user_id();
		$precurr = get_user_meta($user_id, 'usercustom_curr', true);
		$changedcurr = $_POST['curr'];
		if ( !empty($precurr ) ) {
			$currmsg = ' from '.$precurr.' to '.$changedcurr;
		} else {
			$currmsg = ' to '.$changedcurr;
		}

		$wpdb->insert(
			$wpdb->prefix.'user_activity_log',
			array(
				'user_id'  => $user_id,
				'action'   => 'changeCurrency',
				'datetime' => time(),
				'meta'     => 'Changed Currency '.$currmsg,
			),
			array( '%d', '%s', '%s', '%s' )
		);

		update_user_meta($user_id, 'usercustom_curr', $_POST['curr']);
		$return['msg'] = 'success';

		die( json_encode($return) );
	}
	else{
		$return['msg'] = 'fail';
		die( json_encode($return) );
	}
}

/*..............Edit credit card and billing information......*/
add_action('wp_ajax_saveCreditAndBillingInfo','saveCreditAndBillingInfo');
add_action('wp_ajax_nopriv_saveCreditAndBillingInfo','saveCreditAndBillingInfo');

function saveCreditAndBillingInfo(){
	$return = array();
	if ( isset($_POST) ) {
		$user_id = get_current_user_id();
		$name_on_card = $_POST['name_on_card'];
		$card_number  = $_POST['card_number'];
		$verifi_code  = $_POST['verifi_code']; 
		$billing_address  = $_POST['billing_address'];
		$billing_city  = $_POST['billing_city'];
		$billing_zip  = $_POST['billing_zip'];
		$billing_state  = $_POST['billing_state'];
		$billing_country  = $_POST['billing_country'];

		$meta = array(
			'ccbi_cardname' => $name_on_card,
			'ccbi_cardnumber' => $card_number,
			'ccbi_verifycode' => $verifi_code,
			'ccbi_address'  =>  $billing_address,
			'ccbi_city' => $billing_city,
			'ccbi_zip'  =>  $billing_zip,
			'ccbi_state' => $billing_state,
			'ccbi_country' => $billing_country    
		);
		foreach($meta as $key => $value) {
				update_user_meta( $user_id, $key, $value );
		}

		global $wpdb;
				$wpdb->insert(
					$wpdb->prefix.'user_activity_log',
					array(
						'user_id'  => $user_id,
						'action'   => 'updateCraditcardinfo',
						'datetime' => time(),
						'meta'     => 'Renewals & Billing  > update credit card & billing information'
					),
					array( '%d', '%s', '%s', '%s' )
				);

		$return['msg'] = 'success';
		die( json_encode($return) );
	}
	else{
		$return['msg'] = 'error';
		die( json_encode($return) );
	} 
}



/*..............Edit credit card and billing information......*/
add_action('wp_ajax_cancelMembershipAjaxAction','cancelMembershipAjaxAction');
add_action('wp_ajax_nopriv_cancelMembershipAjaxAction','cancelMembershipAjaxAction');

function cancelMembershipAjaxAction(){
	$return = array();
	if ( isset($_POST['pass']) && is_user_logged_in() ) {
		global $wpdb, $current_user;
		$user_id = get_current_user_id();
		$pass = $_POST['pass'];
		$userpass = $current_user->user_pass;

		if( wp_check_password( $pass, $userpass, $user_id ) ){

			$current_user->membership_level = pmpro_getMembershipLevelForUser($current_user->ID);
			$memID = $current_user->membership_level->ID;
			$tablename = $wpdb->prefix.'pmpro_memberships_users';
			$selectID = $wpdb->get_row("SELECT * FROM $tablename WHERE user_id = '".$user_id."' AND membership_id = '".$memID."' AND status = 'active' ");
			$wpdb->update(
				$tablename,
				array('status' => 'cancelled'),
				array('id' => $selectID->id),
				array('%s'),
				array('%d')
			);
			$startdate = date('Y-m-d H:i:s');
			$wpdb->insert(
							$tablename,
				array(
					'user_id'       => $user_id,
					'membership_id'     => '1',
					'initial_payment'   => '0.00',
					'status'        => 'active',
					'cycle_number'      => '',
					'startdate'         => $startdate
				),
				array(
					'%d','%d','%s', '%s', '%s','%s'
				)
			); 
			//send an email to the member
			$myemail = new PMProEmail();
			$myemail->sendCancelEmail($current_user, $memID);

			//send an email to the admin
			$myemail = new PMProEmail();
			$myemail->sendCancelAdminEmail($current_user, $memID);

			$return['msg'] = 'success';
			die( json_encode($return) );
		}
		else{
			$return['msg'] = "<label class='error'>Password doesn't match</label>";
			die( json_encode($return) );
		}
		
	}
	else{
		$return['msg'] = '<label class="error">Something wrong please try again.</label>';
		die( json_encode($return) );
	} 
}



/*..............delete referral......*/
add_action('wp_ajax_delete_reach_referral','delete_reach_referral');
add_action('wp_ajax_nopriv_delete_reach_referral','delete_reach_referral');

function delete_reach_referral(){
	$return = array();
	if ( isset($_POST['reflid']) && is_user_logged_in() ) {
		global $wpdb, $current_user;
		$user_id = get_current_user_id();
		$reflid = $_POST['reflid'];
		$tablename = $wpdb->prefix.'reach_out_and_ask_for_referral';
		
		$select = $wpdb->get_row("SELECT * FROM $tablename WHERE id = '".$reflid."' AND user_id = '".$user_id."' ");
		if ( !empty($select->id) ) {
			
			$wpdb->delete(
				$tablename,
				array('id' => $reflid),
				array('%d')
			);

			global $wpdb;
			$name = $select->first_name.' '.$select->last_name;
			$remail = (($select->user_email)) ? '( '.$select->user_email.' )' : '';
					$wpdb->insert(
						$wpdb->prefix.'user_activity_log',
						array(
							'user_id'  => $user_id,
							'action'   => 'deleteReachReferral',
							'datetime' => time(),
							'meta'     => 'Remove referral '.$name.$remail
						),
						array( '%d', '%s', '%s', '%s' )
					);

			$return['msg'] = 'success';
			die(json_encode($return));    
		}else{
			$return['msg'] = 'error';
			die(json_encode($return));    
		}
	}
	else{
		$return['msg'] = 'error';
		die(json_encode($return));  
	}
}

add_action('wp_ajax_seekerPricingPlanType', 'seekerPricingPlanType');
add_action('wp_ajax_nopriv_seekerPricingPlanType', 'seekerPricingPlanType');
function seekerPricingPlanType(){
	global $wpdb, $current_user, $pmpro_currency_symbol;
	if ( isset($_POST['plan']) && !empty($_POST['plan']) ) {
		$plan = $_POST['plan']; 
		if ( $plan == 'monthly' ) { $payType = 'Month'; }else{ $payType = 'Year'; }
		$getPmproLevels = pmpro_getAllLevels(false, true);
		$getPmproLevels_prefix = $wpdb->prefix.'pmpro_membership_levels';
		$levelmeta_prefix = $wpdb->prefix.'pmpro_membership_levelmeta';
		$countno = 1;
		foreach ($getPmproLevels as $level) {
			
			$payment_level =  $level->initial_payment;
			$current_plan_payment =   $current_user->membership_level->initial_payment;
			
			/*
				Monthly pricing: Note: this is done to display yearly as a monthly payment which makes numbers look lower
			*/
			if($level->cycle_period=='Year'){
				$displayMonthlyPricing = $level->initial_payment/12;

			}else{
				$displayMonthlyPricing = $level->initial_payment;
			}
			$displayMonthlyPricing = number_format((float)$displayMonthlyPricing, 2, '.', '');

			$levelmeta = $wpdb->get_row( "SELECT * FROM $levelmeta_prefix WHERE pmpro_membership_level_id = '".$level->id."' AND meta_key = 'selectusertype' AND meta_value = 'candidate' " );
			$levelOtherDesc = $wpdb->get_row( "SELECT * FROM $levelmeta_prefix WHERE pmpro_membership_level_id = '".$level->id."' AND meta_key = 'other_desc'" );
			$plan_image = $wpdb->get_row( "SELECT * FROM $levelmeta_prefix WHERE pmpro_membership_level_id = '".$level->id."' AND meta_key = 'plan_image'" );
			$other_text_after_price = $wpdb->get_row( "SELECT * FROM $levelmeta_prefix WHERE pmpro_membership_level_id = '".$level->id."' AND meta_key = 'other_text_after_price'" );
			if ( ((!empty($levelmeta->meta_value)) && ($level->cycle_period == $payType)) || ($level->initial_payment == '0.00')  ) { 
				$leveprice = (($level->initial_payment == '0.00')) ? '<h4><big>Free</big></h4>' : '<h4>'.$pmpro_currency_symbol.'<big> '.$displayMonthlyPricing.'</big><small>/ Month</small></h4>'; 
				//$level->expiration_period
				?>
				<div class="col-md-3 col-sm-6 col-xs-6 devicefull">
					<div class="sprice_col <?php echo (($countno == 3)) ? 'popular_pricing ' : ' '; echo ( (is_user_logged_in()) && ( $current_user->membership_level->ID == $level->id) )? 'sprice_active' : ''; ?> ">
						<?php echo (($countno == 3)) ? '<span class="popular_badge">Most Popular</span>' : ''; ?>
						<h3><?php echo $level->name; ?></h3>
						<div class="spricecol_box">
							<?php if ( !empty($plan_image->meta_value) ) { ?>
								<img src="<?php echo $plan_image->meta_value; ?>" >
							<?php } else { ?>
								<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/seeker_basicicon.jpg" >
							<?php } ?>
							<?php 
							echo $leveprice; 
							//echo str_replace( 'The price for membership is', '', pmpro_getLevelCost($level));
							?>
							<?php echo $other_text_after_price->meta_value;  ?>
						</div>
						<?php echo $levelOtherDesc->meta_value; ?>
						<?php if ( (is_user_logged_in()) && ( $current_user->membership_level->ID == $level->id ) ) { ?>                    
							<a href="javascript:void(0);" class="btn btn-success current-plan">Current Plan</a>
						<?php } else{ 
							$user_id = get_current_user_id();
							$membershipUser = $wpdb->prefix.'memberships_users';
							$checkUserMember = $wpdb->get_var("SELECT COUNT(id) FROM eyecuwp_pmpro_memberships_users WHERE user_id = '".$user_id."' ");
							if ( $checkUserMember <= 0 ) {
								$buttonText = 'Get Started';
							}
							else if($level->initial_payment == '0.00' || $current_plan_payment >= $payment_level ){
								$buttonText = 'Downgrade Plan';
							}
							else{
								$buttonText = 'Upgrade Now';
							}
							?>
							<a href="<?php  echo site_url();  ?>/membership-checkout/?level=<?php echo $level->id; ?>" class="btn btn-success"><?php echo $buttonText; ?></a>
						<?php } ?>
					</div>
				</div> <?php 
				$countno++;
			} 
		} 

	}
	die();
}