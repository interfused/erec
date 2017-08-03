<?php

add_action('wp_ajax_ica_handle_initial_upload', 'ica_handle_initial_upload');
add_action('wp_ajax_nopriv_ica_handle_initial_upload', 'ica_handle_initial_upload');
function ica_handle_initial_upload(){
	global $wpdb;
    $valid_formats = array("jpg", "png");
    $max_file_size = 4000000;
    $wp_upload_dir = wp_upload_dir();
    $path = $wp_upload_dir['basedir'].'/ifused_avatar_temp/';
    if (!file_exists( $path.date('Y/m/d') ) ) {
	    mkdir($path.date('Y/m/d'), 0777, true);
	}
	$path = $path.date('Y/m/d').'/';

    if( $_SERVER['REQUEST_METHOD'] == "POST" ){

    	
    	$postid = $_POST['postid'];

    	$postdata = get_post($postid);
    	$author_id = $postdata->post_author;
    	$authordata = get_userdata($author_id);
    	$author_name = $authordata->first_name.' '.$authordata->last_name;
    	$author_email = $authordata->user_email;
    	

    	foreach ( $_FILES['files']['name'] as $f => $name ) {
    		$actual_name = pathinfo($name, PATHINFO_FILENAME);
			$original_name = $actual_name;
			$extension = pathinfo($name, PATHINFO_EXTENSION);
		    if ( $_FILES['files']['error'][$f] == 0 ) {
		        if ( $_FILES['files']['size'][$f] > $max_file_size ) {
		            $upload_message[] = 'File is too large!.';
		            continue;
		        } elseif( ! in_array( strtolower( $extension ), $valid_formats ) ){
		            $upload_message[] = 'File is not a valid format. Allow only jpg or png.';
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