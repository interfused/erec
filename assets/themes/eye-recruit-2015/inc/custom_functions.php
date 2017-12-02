<?php

function forwardNavigationFiles($doctype){ ?>
	<div class="modal fade" id="ForwardDocument" tabindex="-1" role="dialog" aria-labelledby="ForwardDocumentModalLabel">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
			<div class="modal-body vscroll">
				<button type="button" class="close welcome_close_button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<img src="<?php echo site_url();  ?>/assets/uploads/2016/04/EyeRecruit.com-logo_3-2.jpg" class="popup_logo">
				<h3>Forward <?php echo $doctype; ?></h3>
				<div class="">
					<form method="post" action="" class="wpcf7-form text-left" id="forward_doc_form">
		                <h4>Send To</h4>
		                <div class="row">
		                    <div class="col-sm-6">
		                        <div class="form-group">
		                            <label class="control-label">Name <span>*</span></label>
		                            <span class="wpcf7-form-control-wrap firstname-to">
		                                <input type="text" class="form-control" size="40" name="name_to" id="name_to">
		                            </span>
		                        </div>
		                    </div>
		                    
		                    <div class="col-sm-6">
		                        <div class="form-group">
		                            <label class="control-label">Email <span>*</span></label>
		                            <span class="wpcf7-form-control-wrap email-to">
		                                <input type="email" class="form-control" size="40" name="email_to" id="email_to">
		                            </span>
		                        </div>
		                    </div>
		                </div>
		            
		                <div class="form-group">
		                	<label class="control-label">Email Message <span>*</span></label>
		                    <span class="wpcf7-form-control-wrap shareMsg">
		                        <textarea class="form-control" rows="5" cols="20" name="shareMsg" id="shareMsg"></textarea>
		                    </span>
		                </div>
		                
		                <div class="text-center">
		                    <input type="hidden" value="" name="thisdocid" id="thisdocid">
		                    <input type="submit" class="btn btn-primary btn-sm " value="Send" name="forward_doc" id="forward_doc_btn">
		                </div>
		            </form>
				</div>
	  	    </div>
	    </div>
	  </div>
	</div>

	<script type="text/javascript">
		jQuery(document).ready( function() {
			jQuery('.forward_doc').on('click', function() {
				jQuery('#ForwardDocument').modal('show');
				var docid = jQuery(this).attr('docId');
				jQuery('#thisdocid').val(docid);
			});

			jQuery('#forward_doc_form').validate({
				rules: {
					name_to: {
						required: true
					},
					email_to: {
						required: true,
						email: true
					},
					shareMsg: {
						required: true
					}
				},
				messages: {
					name_to: {
						required: "Please enter a name."
					},
					email_to: {
						required: 'Please enter an email address.',
						email: 'Please enter a valid email address.'
					},
					shareMsg: {
						required: 'Please enter your messages.'
					}	
				},
				submitHandler: function(form){
					jQuery('#forward_doc_btn').val('Please Wait...').attr('disabled', 'disabled');
					jQuery.ajax({
						type: 'POST',
						url: '<?php echo admin_url("admin-ajax.php"); ?>',
						dataType: 'json',
						data: {
							action: 'forward_navi_doc', // Action in inc/custom_functions.php
							'formdata': jQuery("#forward_doc_form").serialize()
						},
						success: function(res){
							jQuery('#forward_doc_btn').val('Send').removeAttr('disabled');
							jQuery('#forward_doc_form')[0].reset();
							jQuery('#ForwardDocument').modal('hide');
							swal({
								title: "Success", 
								html: true,
								text: "<span class='text-center'>Successfully sent <?php echo $doctype; ?>.</span>",
								type: "success",
								confirmButtonClass: "btn-primary btn-sm",
							});
						}
					});
				}
			});
		});
	</script>
<?php }


add_action('wp_ajax_forward_navi_doc', 'forward_navi_doc');
add_action('wp_ajax_nopriv_forward_navi_doc', 'forward_navi_doc');
function forward_navi_doc(){
	if ( isset($_POST['formdata']) ) {
		parse_str($_POST['formdata'], $data);
		$to_name = $data['name_to'];
		$email = $data['email_to'];
		$shareMsg = $data['shareMsg'];
		$docid = $data['thisdocid'];

		global $wpdb;
		$tableName = $wpdb->prefix.'jobseeker_resume';
		$select = $wpdb->get_row("SELECT * FROM $tableName WHERE id = '".$docid."' ");	
		$file = $select->file;
		$path = get_home_path().'assets/uploads'.$file;

		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: multipart/mixed; charset=iso-8859-1' . "\r\n";

		$mail_attachment = array($path);   

		$tempArray = get_option('forward_doc');
		
		$docType = array('resume' => 'resume', 'background_doc' => 'background doc', 'honors' => 'honors & award', 'education' => 'education doc', 'cover_letters' => 'cover letter', 'license' => 'license', 'certificate' => 'certificate', 'cover_lettersStatic' => 'cover letter');
		$docType = $docType[$select->docType];
		$userid = get_current_user_id();
		$userData = get_userdata($userid);
		$from_name = $userData->first_name.' '.$userData->last_name;

		$Replaceto = array('[doc_type]', '[from_name]', '[to_name]', '[shareMsg]');
		$Replaceby = array($docType, $from_name, $to_name, $shareMsg);
		
		if ( isset($tempArray['forward_doc_template']) ) {
			$forward_doc_template = $tempArray['forward_doc_template'];
		}
		else{
			$forward_doc_template = '[shareMsg]';
		}
		$message = str_replace($Replaceto, $Replaceby, $forward_doc_template);

		if ( isset($tempArray['forward_doc_subject']) ) {
			$forward_doc_subject = $tempArray['forward_doc_subject'];
		}
		else{
			$forward_doc_subject = 'A [doc_type] forward from your friend [from_name]';
		}
		$subject = str_replace($Replaceto, $Replaceby, $forward_doc_subject);

		wp_mail($email, $subject, $message, $headers, $mail_attachment);
	}
	die();
}



/*.............. SEEKER APPLICATION FOR JOB WITHOUT LOGIN ..................
applicant is notified with a thank you message.
eye recruit member is notified of applicant interest
original job poster IS NOT notified
*/
add_action('wp_ajax_applyforjobwithoutlogin', 'applyforjobwithoutlogin');
add_action('wp_ajax_nopriv_applyforjobwithoutlogin', 'applyforjobwithoutlogin');
function applyforjobwithoutlogin(){
	global $wpdb;
    $valid_formats = array("pdf", "doc", "docx");
    $max_file_size = 2000000;
    $wp_upload_dir = wp_upload_dir();
    $path = $wp_upload_dir['basedir'].'/resumetemp/';
    if (!file_exists( $path.date('Y/m/d') ) ) {
	    mkdir($path.date('Y/m/d'), 0777, true);
		}
		$path = $path.date('Y/m/d').'/';

    if( $_SERVER['REQUEST_METHOD'] == "POST" ){

    	$from_email = $_POST['uemail'];
    	$from_name = $_POST['uname'];
    	$postid = $_POST['postid'];

    	$postdata = get_post($postid);
    	$author_id = $postdata->post_author;
    	$authordata = get_userdata($author_id);
    	$author_name = $authordata->first_name.' '.$authordata->last_name;
    	$author_email = $authordata->user_email;
    	$job_title = get_the_title($postid);
    	$job_url = get_the_permalink($postid);

    	foreach ( $_FILES['files']['name'] as $f => $name ) {
    		$actual_name = pathinfo($name, PATHINFO_FILENAME);
    		$original_name = $actual_name;
    		$extension = pathinfo($name, PATHINFO_EXTENSION);
    		if ( $_FILES['files']['error'][$f] == 0 ) {
    			if ( $_FILES['files']['size'][$f] > $max_file_size ) {
    				$upload_message[] = 'File is too large!.';
    				continue;
    			} elseif( ! in_array( strtolower( $extension ), $valid_formats ) ){
    				$upload_message[] = 'File is not a valid format. Allow only pdf, doc, docx format.';
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
    					$file = get_home_path().'assets/uploads/resumetemp/'.date('Y/m/d').'/'.$basename;
    					$mail_attachment = array($file);   

    					$headers  = 'MIME-Version: 1.0' . "\r\n";
    					$headers .= 'Content-type: multipart/mixed; charset=iso-8859-1' . "\r\n";

    					$job_apply = get_option('job_apply');

    					$Replaceto = array('[site_url]', '[author_name]', '[job_title]', '[from_name]', '[from_email]', '[job_url]');
    					$Replaceby = array(site_url(), $author_name, $job_title, $from_name, $from_email, $job_url);

    					if ( isset($job_apply['job_apply_template']) ) {
    						$message = str_replace($Replaceto, $Replaceby, $job_apply['job_apply_template']);
    					}
    					else{
    						$message = 'A candidate '.$from_name.' has submitted their application for the position "'.$job_title.'". You can contact them directly at: '.$from_email;
    					}

    					if ( isset($job_apply['job_apply_subject']) ) {

    						$subject = str_replace($Replaceto, $Replaceby, $job_apply['job_apply_subject']);
    					}
    					else{
    						$subject = 'New job application for '.$job_title;
    					}

    					$thank_job_apply = get_option('thank_job_apply');
    					if ( isset($thank_job_apply['thank_job_apply_template']) ) {
    						$thank_message = str_replace($Replaceto, $Replaceby, $thank_job_apply['thank_job_apply_template']);
    					}
    					else{
    						$thank_message = 'A candidate '.$from_name.' has submitted their application for the position "'.$job_title.'". You can contact them directly at: '.$from_email;
    					}

    					if ( isset($thank_job_apply['thank_job_apply_subject']) ) {

    						$thank_subject = str_replace($Replaceto, $Replaceby, $thank_job_apply['thank_job_apply_subject']);
    					}
    					else{
    						$thank_subject = 'Thank you for your application for the position of '.$job_title;
    					}
    					//notify eyerecruit team
    					if( wp_mail('resumes@eyerecruit.com', $subject, $message, $headers, $mail_attachment) ){
    						wp_mail($from_email, $thank_subject, $thank_message, $headers);
    					}

    					$upload_message[] = 'success';
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


function printImage(){ ?>
	<script type="text/javascript">
		function printImage(imagePath) {
		    var width = jQuery(window).width() * 0.9;
		    var height = jQuery(window).height() * 0.9;
		    var content = '<!DOCTYPE html>' + 
		                  '<html>' +
		                  '<head><title></title></head>' +
		                  '<body onload="window.focus(); window.print(); window.close();">' + 
		                  '<img src="' + imagePath + '" style="width: 100%;" />' +
		                  '</body>' +
		                  '</html>';
		    var options = "toolbar=no,location=no,directories=no,menubar=no,scrollbars=yes,width=" + width + ",height=" + height;
		    var printWindow = window.open('', 'print', options);
		    printWindow.document.open();
		    printWindow.document.write(content);
		    printWindow.document.close();
		    printWindow.focus();
		}
	</script>
<?php } ?>