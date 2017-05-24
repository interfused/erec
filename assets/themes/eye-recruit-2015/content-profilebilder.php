<?php
/**
 * The default template for displaying content. Used for profile bilder layout and popups.
 *
 * @package Jobify
 * @since Jobify 1.0
 */
?>
<style type="text/css">

</style>
<?php
if ( is_user_logged_in() ) {
	$site_url = site_url();
	echo wp_redirect( $site_url );
}

?>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/inc/js/bootstrap.min.js"></script>
<script src="<?php echo get_stylesheet_directory_uri();  ?>/inc/js/jquery.validate.min.js"></script>

<script type="text/javascript">
window.onhashchange = function() {
	showCurrentStep();
}

function showCurrentStep() {
	var currentid = atob(window.location.hash.substr(1));
	var currentform = jQuery( ".active form").attr('id');
	var form = jQuery( "#"+currentform);
		form.validate();
		if(form.valid()){
			if(currentid){
				jQuery(".profilestep").removeClass("active");
				jQuery("#profilesteps"+currentid).removeClass("inactive");
				jQuery("#profilesteps"+currentid).addClass("active");
				jQuery("html, body").animate({ scrollTop: 0 }, 600);
			}
			
		}
	}
	jQuery(document).ready(function(){
		jQuery("#profilesteps4331").addClass("active");
		//jQuery("#profilesteps4331").addClass("inactive");
		showCurrentStep();

		jQuery('body').addClass('profile-builder-page');

		var rec_id = "<?php echo $_REQUEST['rec']; ?>";

		if ( rec_id == '' ) {
			window.location = '<?php echo site_url(); ?>';
			return false;
		}

		
		jQuery(".continue_step").on('click',function() { 


			var currentform = jQuery( ".active form").attr('id');
			var form = jQuery( "#"+currentform);
			form.validate();
			if(!form.valid()){
				
				return false;
			}

			if ( rec_id == '' ) {
				window.location = '<?php echo site_url(); ?>';
				return false;
			}

			var _this = jQuery(this);

			var form_id = jQuery(this).closest('form').attr('id');

			/*.......Step1........*/
			var AGREE_TO_RESPOND = jQuery("input[name='AGREE_TO_RESPOND']:checked").val();


			/*.......Step2........*/
			var SYSTEM_AND_PROCE = jQuery("input[name='SYSTEM_AND_PROCE']:checked").val();

			/*.......Step3........*/
			var BEST_INDUSTRY = jQuery("input[name='BEST_INDUSTRY']:checked").val();
			
			/*.......Step4........*/
			var HIGHEST_EDUCATION = jQuery("input[name='HIGHEST_EDUCATION']:checked").val();
			var hi_edu_arr = ['Associates Degree', 'Bachelors Degree', 'Masters Degree', 'Doctorate Degree / PhD.']; 
			if  ( jQuery.inArray( HIGHEST_EDUCATION, hi_edu_arr ) != -1 ) {

				if ( jQuery('#profilebuder4342').hasClass('thisValid') ) {
					var AREA_OF_STUDY = jQuery("input[name='AREA_OF_STUDY']").val();
					var SCHOOL_NAME = jQuery("input[name='SCHOOL_NAME']").val();
					var STUDY_YEAR = jQuery("input[name='STUDY_YEAR']").val();
					var STUDY_MAJOR = jQuery("input[name='STUDY_MAJOR']:checked").val();
				}
				else{
					var AREA_OF_STUDY = '';
					var SCHOOL_NAME   = '';
					var STUDY_YEAR 	  = '';
					var STUDY_MAJOR   = '';
				}
			}
			else{
				var AREA_OF_STUDY = '';
				var SCHOOL_NAME   = '';
				var STUDY_YEAR 	  = '';
				var STUDY_MAJOR   = '';
			}
			
			/*.......Step5........*/
			var opporunity = [];
			jQuery("input[name='TYPE_OF_OPPORTUNITY[]']:checked").each(function() {
		        opporunity.push( jQuery(this).val() );
		    });
			//var opporunity = jQuery("input[name='TYPE_OF_OPPORTUNITY']:checked").val();

			var TYPE_OF_OPPORTUNITY = opporunity;
			var JOB_SEARCH_RADIUS = jQuery("input[name='JOB_SEARCH_RADIUS']:checked").val();

			/*.......Step6........*/
			var US_ELIGIBLE = jQuery("input[name='US_ELIGIBLE']:checked").val();
			var SECURITY_CLEAR_YN = jQuery("input[name='SECURITY_CLEAR_YN']:checked").val();
			var OVER_18_YN = jQuery("input[name='OVER_18_YN']:checked"). val();

			/*.......Step7........*/
			var INDUSTRY_YEARS = jQuery("select[name='INDUSTRY_YEARS']").val();
			var COMPENSATION_CURRENT = jQuery("select[name='COMPENSATION_CURRENT']").val();
			var COMPENSATION_DESIRED = jQuery("select[name='COMPENSATION_DESIRED']").val();
			
			var POSSES_DRIVER_LICENS = jQuery("input[name='POSSES_DRIVER_LICENS']:checked").val();
			var DRIVER_STATE = jQuery("select[name='DRIVER_STATE']").val();
			var RELIABLE_TRANSPORT = jQuery("input[name='RELIABLE_TRANSPORT']:checked").val();

			/*.......Step8........*/
			var FIELD_LICENSE_STATUS = jQuery("input[name='FIELD_LICENSE_STATUS']:checked").val();

			if ( jQuery('#profilebuder4346').hasClass('thisValid') ) { 

				var li_state = [];
				jQuery("input[name='FIELD_LICENSE_STATE[]']:checked").each(function() {
			        li_state.push( jQuery(this).val() );
			    });

				var FIELD_LICENSE_STATE = li_state;
			}
			else{
				var FIELD_LICENSE_STATE = '';
			}


			/*.......Step9........*/

			var list_languages_mandarin = jQuery("input[name='list_languages_mandarin']:checked").val();
			var list_languages_vietnamese = jQuery("input[name='list_languages_vietnamese']:checked").val();
			var list_languages_english = jQuery("input[name='list_languages_english']:checked").val();
			var list_languages_javanese = jQuery("input[name='list_languages_javanese']:checked").val();
			var list_languages_spanish = jQuery("input[name='list_languages_spanish']:checked").val();
			var list_languages_tamil = jQuery("input[name='list_languages_tamil']:checked").val();

			var list_languages_hindi = jQuery("input[name='list_languages_hindi']:checked").val();
			var list_languages_Korean = jQuery("input[name='list_languages_Korean']:checked").val();
			var list_languages_russian = jQuery("input[name='list_languages_russian']:checked").val();
			var list_languages_turkish = jQuery("input[name='list_languages_turkish']:checked").val();
			var list_languages_arabic = jQuery("input[name='list_languages_arabic']:checked").val();
			var list_languages_telugu = jQuery("input[name='list_languages_telugu']:checked").val();

			var list_languages_portuguese = jQuery("input[name='list_languages_portuguese']:checked").val();
			var list_languages_marathi = jQuery("input[name='list_languages_marathi']:checked").val();
			var list_languages_bengali = jQuery("input[name='list_languages_bengali']:checked").val();
			var list_languages_italian = jQuery("input[name='list_languages_italian']:checked").val();
			var list_languages_french = jQuery("input[name='list_languages_french']:checked").val();
			var list_languages_thai = jQuery("input[name='list_languages_thai']:checked").val();

			var list_languages_malay = jQuery("input[name='list_languages_malay']:checked").val();
			var list_languages_burmese = jQuery("input[name='list_languages_burmese']:checked").val();
			var list_languages_german = jQuery("input[name='list_languages_german']:checked").val();
			var list_languages_cantonese = jQuery("input[name='list_languages_cantonese']:checked").val();
			var list_languages_japanese = jQuery("input[name='list_languages_japanese']:checked").val();
			var list_languages_kannada = jQuery("input[name='list_languages_kannada']:checked").val();

			var list_languages_farsi = jQuery("input[name='list_languages_farsi']:checked").val();
			var list_languages_gujarati = jQuery("input[name='list_languages_gujarati']:checked").val();
			var list_languages_urdu = jQuery("input[name='list_languages_urdu']:checked").val();
			var list_languages_polish = jQuery("input[name='list_languages_polish']:checked").val();
			var list_languages_punjabi = jQuery("input[name='list_languages_punjabi']:checked").val();
			var list_languages_wu = jQuery("input[name='list_languages_wu']:checked").val();

			var list_languages_other = jQuery("input[name='list_languages_other']:checked").val();
			var list_languages_text = jQuery("input[name='list_languages_text']").val();


			var mandarin_rating =  jQuery("input[name='mandarin_rating']").val();
			var vietnamese_rating =  jQuery("input[name='vietnamese_rating']").val();
			var english_rating =  jQuery("input[name='english_rating']").val();
			var javanese_rating =  jQuery("input[name='javanese_rating']").val();
			var spanish_rating =  jQuery("input[name='spanish_rating']").val();
			var tamil_rating =  jQuery("input[name='tamil_rating']").val();

			var hindi_rating =  jQuery("input[name='hindi_rating']").val();
			var Korean_rating =  jQuery("input[name='Korean_rating']").val();
			var russian_rating =  jQuery("input[name='russian_rating']").val();
			var turkish_rating =  jQuery("input[name='turkish_rating']").val();
			var arabic_rating =  jQuery("input[name='arabic_rating']").val();
			var telugu_rating =  jQuery("input[name='telugu_rating']").val();

			var portuguese_rating =  jQuery("input[name='portuguese_rating']").val();
			var marathi_rating =  jQuery("input[name='marathi_rating']").val();
			var bengali_rating =  jQuery("input[name='bengali_rating']").val();
			var italian_rating =  jQuery("input[name='italian_rating']").val();
			var french_rating =  jQuery("input[name='french_rating']").val();
			var thai_rating =  jQuery("input[name='thai_rating']").val();

			var malay_rating =  jQuery("input[name='malay_rating']").val();
			var burmese_rating =  jQuery("input[name='burmese_rating']").val();
			var german_rating =  jQuery("input[name='german_rating']").val();
			var cantonese_rating =  jQuery("input[name='cantonese_rating']").val();
			var japanese_rating =  jQuery("input[name='japanese_rating']").val();
			var kannada_rating =  jQuery("input[name='kannada_rating']").val();

			var farsi_rating =  jQuery("input[name='farsi_rating']").val();
			var gujarati_rating =  jQuery("input[name='gujarati_rating']").val();
			var urdu_rating =  jQuery("input[name='urdu_rating']").val();
			var polish_rating =  jQuery("input[name='polish_rating']").val();
			var punjabi_rating =  jQuery("input[name='punjabi_rating']").val();
			var wu_rating =  jQuery("input[name='wu_rating']").val();
			var other_rating =  jQuery("input[name='other_rating']").val();





			/*.......Step10........*/
			var work_sitiuation = [];
			jQuery("input[name='CUR_WORK_SITUATION[]']:checked").each(function() {
		        work_sitiuation.push( jQuery(this).val() );
		    });
			var CUR_WORK_SITUATION = work_sitiuation;

			/*.......Step11........*/
			var US_ARMED_FORCES = jQuery("input[name='US_ARMED_FORCES']:checked").val();
			var US_ARMED_FORCES_OPTION = jQuery("input[name='US_ARMED_FORCES_OPTION']:checked").val();

			var LOCAL_LAW_FORCE_YN = jQuery("input[name='LOCAL_LAW_FORCE_YN']:checked").val();

			/*.......Step12........*/
			var FEDERAL_NVESTIGATIV = jQuery("input[name='FEDERAL_NVESTIGATIV']:checked").val();

			if ( jQuery('#profilebuder4351').hasClass('thisValid') ) {
				var us_law_force = jQuery("input[name='US_LAW_ENFORCE_STATU']:checked").val();
				if ( us_law_force == 'OTHER' ) {
					var US_LAW_ENFORCE_STATU = us_law_force;
					var US_LAW_ENFORCE_OTHER = jQuery("input[name='US_LAW_ENFORCE_STATU_OTHER']").val();
				}
				else {
					var US_LAW_ENFORCE_STATU = us_law_force;
					var US_LAW_ENFORCE_OTHER = '';
				}
			}
			else{
				var US_LAW_ENFORCE_STATU = '';
				var US_LAW_ENFORCE_OTHER = '';
			}

			/*.......Step13........*/
			var MAJOR_METROPOLITAN = jQuery("select[name='MAJOR_METROPOLITAN']").val();
			var MAJOR_METROPOLITAN_O = jQuery('input[name="MAJOR_METROPOLITAN_O"]').val();

			/*.......Step15........*/
			var rfn = [];
			jQuery("input[name='fname[]']").each(function() {
		        rfn.push( jQuery(this).val() );
		    });
		    var rfname = rfn;


		    var rfe = [];
			jQuery("input[name='user_email[]']").each(function() {
		        rfe.push( jQuery(this).val() );
		    });
		    var rfemail = rfe;

		    if ( form_id == 'profilebuder4353') {

		        var fd = new FormData();
		        var files_data = jQuery('#resume');

		        if ( jQuery('input[name="CURRENT_RESUME"]').val() != '') {

			        jQuery('#profilebuder4353 .continue_step').html('File uploading. Please wait...').attr('disabled');

		        	
			        jQuery.each(jQuery(files_data), function(i, obj) {
			            jQuery.each(obj.files,function(j,file){
			                fd.append('files[' + j + ']', file);
			            })
			        });
			       
			        fd.append('action', 'cvf_upload_files');  
			        fd.append('user_id', rec_id);  

			        jQuery('.cust_error_invalid').remove();
			        jQuery.ajax({
			            type: 'POST',
			            url: '<?php echo admin_url("admin-ajax.php"); ?>',
			            data: fd,
			            contentType: false,
			            processData: false,
			            success: function(response){

			            	jQuery('#profilebuder4353 .continue_step').removeAttr('disabled').html('<i class="fa fa-angle-double-left"></i>  Continue  <i class="fa fa-angle-double-right"></i>');
			            	
			            	if ( response == 'Allow only pdf and doc file format.'  || response == 'File size is too large!' ) {
			            		jQuery('<span class="text-primary cust_error_invalid">'+response+'</span>').insertAfter('input[name="CURRENT_RESUME"]');
			            		return false;
			            	}
			            	else{
				            	var currentid 		= _this.data("current");
								var nextid 			= _this.data("next");
								window.location.hash = btoa(nextid);
								return false;
			            	}
			            }
			        });
			    }
			    else{
			    	var currentid 		= _this.data("current");
					var nextid 			= _this.data("next");
					window.location.hash = btoa(nextid);
					return false;
			    }
		    }
		    else if(form_id == 'profilebuder4347'){

		    	if ( jQuery("input[name='list_languages_other']").is(':checked') ) {
		    		jQuery('#list_languages_text-error').remove();
		    		if ( list_languages_text == '' ) {
						jQuery('<label id="list_languages_text-error" class="error lang_error" for="list_languages_text">Please enter an other language.</label>').insertAfter('#profilebuder4347 ul');
		    			return false;
		    		}
		    		else{
		    			jQuery('#list_languages_text-error').remove();
		    		}
		    	}

		    	var currentid 		= _this.data("current");
				var nextid 			= _this.data("next");
				window.location.hash = btoa(nextid);

				jQuery.ajax({
					type: 'POST',
					url: '<?php echo admin_url( "admin-ajax.php"); ?>',
					data: {
						action: 'jobseeker_profile_data_lang',
						'user_id': rec_id,
						'form_id': form_id,
						'list_languages_mandarin': list_languages_mandarin,
						'list_languages_vietnamese': list_languages_vietnamese,
						'list_languages_english': list_languages_english,
						'list_languages_javanese': list_languages_javanese,
						'list_languages_spanish': list_languages_spanish,
						'list_languages_tamil': list_languages_tamil,
						'list_languages_hindi': list_languages_hindi,
						'list_languages_Korean': list_languages_Korean,
						'list_languages_russian': list_languages_russian,
						'list_languages_turkish': list_languages_turkish,
						'list_languages_arabic': list_languages_arabic,
						'list_languages_telugu': list_languages_telugu,
						'list_languages_portuguese': list_languages_portuguese,
						'list_languages_marathi': list_languages_marathi,
						'list_languages_bengali': list_languages_bengali,
						'list_languages_italian': list_languages_italian,
						'list_languages_french': list_languages_french,
						'list_languages_thai': list_languages_thai,
						'list_languages_malay': list_languages_malay,
						'list_languages_burmese': list_languages_burmese,
						'list_languages_german': list_languages_german,
						'list_languages_cantonese': list_languages_cantonese,
						'list_languages_japanese': list_languages_japanese,
						'list_languages_kannada': list_languages_kannada,
						'list_languages_farsi': list_languages_farsi,
						'list_languages_gujarati': list_languages_gujarati,
						'list_languages_urdu': list_languages_urdu,
						'list_languages_polish': list_languages_polish,
						'list_languages_punjabi': list_languages_punjabi,
						'list_languages_wu': list_languages_wu,
						'list_languages_other': list_languages_other,
						'list_languages_text': list_languages_text,
						'mandarin_rating': mandarin_rating,
						'vietnamese_rating': vietnamese_rating,
						'english_rating': english_rating,
						'javanese_rating': javanese_rating,
						'spanish_rating': spanish_rating,
						'tamil_rating': tamil_rating,
						'hindi_rating': hindi_rating,
						'Korean_rating': Korean_rating,
						'russian_rating': russian_rating,
						'turkish_rating': turkish_rating,
						'arabic_rating': arabic_rating,
						'telugu_rating': telugu_rating,
						'portuguese_rating': portuguese_rating,
						'marathi_rating': marathi_rating,
						'bengali_rating': bengali_rating,
						'italian_rating': italian_rating,
						'french_rating': french_rating,
						'thai_rating': thai_rating,
						'malay_rating': malay_rating,
						'burmese_rating': burmese_rating,
						'german_rating': german_rating,
						'cantonese_rating': cantonese_rating,
						'japanese_rating': japanese_rating,
						'kannada_rating': kannada_rating,
						'farsi_rating': farsi_rating,
						'gujarati_rating': gujarati_rating,
						'urdu_rating': urdu_rating,
						'polish_rating': polish_rating,
						'punjabi_rating': punjabi_rating,
						'wu_rating': wu_rating,
						'other_rating': other_rating,
					},
					success: function(res){
						//alert(res);
					}
				});
		    }

		    else{

		    	if ( form_id == 'profilebuder4349' ) {

		    		jQuery('.usfor_error').remove();
		    		if ( ( US_ARMED_FORCES == 'Yes') && ( !jQuery('input[name="US_ARMED_FORCES_OPTION"]').is(':checked') ) ) {
						jQuery('#fours .indent').append('<label id="US_ARMED_FORCES_OPTION-error" class="error usfor_error" for="US_ARMED_FORCES_OPTION">Please select at least one.</label>');; //.insertAfter('#fours');
		    			return false;
		    		}
		    		else{
		    			jQuery('.usfor_error').remove();
		    		}
		    	}

		    	if ( form_id == 'profilebuder4352' ) {

		    		jQuery('.other_metro_error').remove();
		    		if ( ( MAJOR_METROPOLITAN == 'Other') && ( MAJOR_METROPOLITAN_O == '' ) ) {
						jQuery('#othe_metropo_city .indent').append('<label id="MAJOR_METROPOLITAN_O-error" class="error other_metro_error" for="MAJOR_METROPOLITAN_O">Please enter an other metropolitan city name.</label>');; //.insertAfter('#fours');
		    			return false;
		    		}
		    		else{
		    			jQuery('.other_metro_error').remove();
		    		}
		    	}
                
		    	var currentid 		= _this.data("current");
				var nextid 			= _this.data("next");
			    if(AGREE_TO_RESPOND=="No"){
            	 jQuery("#AGREE_TO_RESPOND").modal('show');
                }
                else{
				window.location.hash = btoa(nextid);
			    }

				if (form_id == 'profilebuder4357') {
					_this.text('Please Wait...').attr('disabled', 'disabled');
				}


				jQuery.ajax({
					type: 'POST',
					url: '<?php echo admin_url( "admin-ajax.php"); ?>',
					data: {
						action: 'jobseeker_profile_data',
						'user_id': rec_id,
						'form_id': form_id,
						'AGREE_TO_RESPOND': AGREE_TO_RESPOND,
						'SYSTEM_AND_PROCE': SYSTEM_AND_PROCE,
						'BEST_INDUSTRY': BEST_INDUSTRY,
						'HIGHEST_EDUCATION': HIGHEST_EDUCATION,
						'AREA_OF_STUDY': AREA_OF_STUDY,
						'SCHOOL_NAME': SCHOOL_NAME,
						'STUDY_YEAR': STUDY_YEAR,
						'STUDY_MAJOR': STUDY_MAJOR,
						'TYPE_OF_OPPORTUNITY': TYPE_OF_OPPORTUNITY,
						'JOB_SEARCH_RADIUS': JOB_SEARCH_RADIUS,
						'US_ELIGIBLE': US_ELIGIBLE,
						'SECURITY_CLEAR_YN': SECURITY_CLEAR_YN,
						'OVER_18_YN': OVER_18_YN,
						'INDUSTRY_YEARS':INDUSTRY_YEARS,
						'COMPENSATION_CURRENT':COMPENSATION_CURRENT,
						'COMPENSATION_DESIRED':COMPENSATION_DESIRED,
						'POSSES_DRIVER_LICENS': POSSES_DRIVER_LICENS,
						'DRIVER_STATE': DRIVER_STATE,
						'RELIABLE_TRANSPORT': RELIABLE_TRANSPORT,
						'FIELD_LICENSE_STATUS': FIELD_LICENSE_STATUS,
						'FIELD_LICENSE_STATE': FIELD_LICENSE_STATE,
						'CUR_WORK_SITUATION': CUR_WORK_SITUATION,
						'US_ARMED_FORCES': US_ARMED_FORCES,
						'US_ARMED_FORCES_OPTION': US_ARMED_FORCES_OPTION,
						'LOCAL_LAW_FORCE_YN': LOCAL_LAW_FORCE_YN,
						'FEDERAL_NVESTIGATIV': FEDERAL_NVESTIGATIV,
						'US_LAW_ENFORCE_STATU': US_LAW_ENFORCE_STATU,
						'US_LAW_ENFORCE_OTHER': US_LAW_ENFORCE_OTHER,
						'MAJOR_METROPOLITAN': MAJOR_METROPOLITAN,
						'MAJOR_METROPOLITAN_O': MAJOR_METROPOLITAN_O,
						'rfname': rfname,
						'rfemail': rfemail,
					},
					success: function(res){
						if ( res == 'mail send' ) {
							_this.text('Thank you for Choosing EyeRecruit!').attr('disabled', 'disabled');
							window.location = '<?php echo site_url("/job-seekers/dashboard/"); ?>';
						}
					}
				});
			}	
		
		});


		jQuery('#associates_degree').click(function(){
			jQuery('.accociatesdegree .study_error').remove();
			if (jQuery(this).attr("checked") == "checked") {
	            jQuery('#accociatesdegreeModal').modal('show');

	            jQuery('#accociatesdegreeModal label[for="AREA_OF_STUDY"]').text(jQuery(this).val());
	            
	            if( jQuery('#profilebuder4342').attr('chd') != 'associates_degree' ) { 
	            	jQuery('.accociatesdegree form')[0].reset();
		            jQuery('input[name="STUDY_MAJOR"]:checked').each(function(){
					      jQuery(this).attr('checked', false);  
					});
		        }
	            jQuery('#profilebuder4342').attr('chd', 'associates_degree');
	      	}
		});

		jQuery('#bachelors_degree').click(function(){
			jQuery('.accociatesdegree .study_error').remove();	
			if (jQuery(this).attr("checked") == "checked") {
	            jQuery('#accociatesdegreeModal').modal('show');
	            jQuery('#accociatesdegreeModal label[for="AREA_OF_STUDY"]').text(jQuery(this).val());
	            if( jQuery('#profilebuder4342').attr('chd') != 'bachelors_degree' ) { 
	            	jQuery('.accociatesdegree form')[0].reset();
		            jQuery('input[name="STUDY_MAJOR"]:checked').each(function(){
					      jQuery(this).attr('checked', false);  
					});
		        }
	            jQuery('#profilebuder4342').attr('chd', 'bachelors_degree');
	      	}
		});

		jQuery('#masters_degree').click(function(){
			jQuery('.accociatesdegree .study_error').remove();	
			if (jQuery(this).attr("checked") == "checked") {
	            jQuery('#accociatesdegreeModal').modal('show');
	            jQuery('#accociatesdegreeModal label[for="AREA_OF_STUDY"]').text(jQuery(this).val());
	            if( jQuery('#profilebuder4342').attr('chd') != 'masters_degree' ) { 
	            	jQuery('.accociatesdegree form')[0].reset();
		            jQuery('input[name="STUDY_MAJOR"]:checked').each(function(){
					      jQuery(this).attr('checked', false);  
					});
		        }
	            jQuery('#profilebuder4342').attr('chd', 'masters_degree');
	      	}
		});

		jQuery('#doctorate').click(function(){	
			jQuery('.accociatesdegree .study_error').remove();
			if (jQuery(this).attr("checked") == "checked") {
	            jQuery('#accociatesdegreeModal').modal('show');
	            jQuery('#accociatesdegreeModal label[for="AREA_OF_STUDY"]').text(jQuery(this).val());
	            if( jQuery('#profilebuder4342').attr('chd') != 'doctorate' ) { 
	            	jQuery('.accociatesdegree form')[0].reset();
		            jQuery('input[name="STUDY_MAJOR"]:checked').each(function(){
					      jQuery(this).attr('checked', false);  
					});
		        }
	            jQuery('#profilebuder4342').attr('chd', 'doctorate');
	      	}
		});

		jQuery('#yes_law_enforcement_agency').click(function(){	
			if (jQuery(this).attr("checked") == "checked") {
	            jQuery('#Investigative').modal('show');
	      	}
		});

		jQuery('#selectall').on('click', function() {
			jQuery('input[name=radio_employment_situation]').attr('checked', true);
		});

		jQuery('#yes_retired').click(function(){	
			if (jQuery(this).attr("checked") == "checked") {
	            jQuery('#fours').show();
	      	}
		});

		jQuery('#retired').click(function(){	
			if (jQuery(this).attr("checked") == "checked") {
	            jQuery('#fours').hide();
	            jQuery('.usfor_error').remove();
	            jQuery('input[name="US_ARMED_FORCES_OPTION"]:checked').each(function(){
				    jQuery(this).attr('checked', false);  
				});
	      	}
		});

	});
</script>
<script type="text/javascript">
    jQuery(document).ready( function(){

    	jQuery('#userdetail_add_more').attr('count', 1);
    	
        jQuery('.userdetail_add_more').live('click', function(){

            var ln_no = jQuery(this).attr('count');

            var count = parseInt(ln_no)+1;

            jQuery("#userdetail_all_fields").append('<div class="edit-main-dv" id="userdetail_pr_'+count+'" ><div class="form-group"><label for="userdetail" class="col-sm-3 control-label">Name</label><div class="col-sm-9"><input type="text" name="fname[]" id="fname_'+count+'" class="regular-text code form-control"></div></div><div class="form-group"><label for="userdetail" class="col-sm-3 control-label">Email</label><div class="col-sm-9"><input type="text" name="user_email[]" id="user_email_'+count+'" class="regular-text code form-control"></div></div><span class="remove_edu btn btn-default btn-sm" id="remove_edu_'+count+'" rel="'+count+'">remove</span></div>');

            jQuery(this).attr('count', count);
        });


        jQuery('.remove_edu').live('click', function(){
            var rel = jQuery(this).attr('rel');
            jQuery('#userdetail_pr_'+rel).remove();
            jQuery('#remove_edu_'+rel).remove();
        });



        for (var j = 2; j <= jQuery('#userdetail_add_more').attr('count'); j++) {

            if ( jQuery('#user_email_'+j).val() == '' && jQuery('#fname_'+j).val() == '' ) {

                jQuery('#userdetail_pr_'+j).remove();
            }
            
        };

    });

</script>

<script type="text/javascript">
	jQuery(document).ready( function() {

		function validEmail(v) {
		    var r = new RegExp("[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?");
		    return (v.match(r) == null) ? false : true;
		}

		function numericOnly(v) {
		    var r = new RegExp('[^0-9]','g');
		    return (v.match(r) == null) ? false : true;
		}


		jQuery( "#profilebuder4356" ).on('keyup', 'input[name="fname[]"]', function() {
			var name_val = jQuery(this).val();
			var name_id = jQuery(this).attr('id');
			jQuery('#'+name_id+'-error').remove();

			if ( name_val == '' ) {
				jQuery('<label id="'+name_id+'-error" class="error send_mail_error" for="'+name_id+'">Please enter an name.</label>').insertAfter(this);
			}
			else{
				jQuery('#'+name_id+'-error').remove();
			}

		});

		jQuery( "#profilebuder4356" ).on('keyup', 'input[name="user_email[]"]', function() {
			var email_val = jQuery(this).val();
			var email_id = jQuery(this).attr('id');
			jQuery('#'+email_id+'-error').remove();

			if ( email_val == '' ) {
				jQuery('<label id="'+email_id+'-error" class="error send_mail_error" for="'+email_id+'">Please enter an email.</label>').insertAfter(this);
			}
			else if ( !validEmail(email_val) ) {
				jQuery('<label id="'+email_id+'-error" class="error send_mail_error" for="'+email_id+'">Please enter an valid email.</label>').insertAfter(this);
			} 
			else{
				jQuery('#'+email_id+'-error').remove();
			}
		});


		jQuery('#send_mail_to_fr').on('click', function() {

			jQuery('.error').remove();

			jQuery('input[name="fname[]"]').each( function() {

				var name_val = jQuery(this).val();
				var name_id = jQuery(this).attr('id');

				if ( name_val == '' ) {
					jQuery('<label id="'+name_id+'-error" class="error send_mail_error" for="'+name_id+'">Please enter an name.</label>').insertAfter(this);
				}
			});

			jQuery('input[name="user_email[]"]').each( function() {

				var email_val = jQuery(this).val();
				var email_id = jQuery(this).attr('id');

				if ( email_val == '' ) {
					jQuery('<label id="'+email_id+'-error" class="error send_mail_error" for="'+email_id+'">Please enter an email.</label>').insertAfter(this);
				}
				else if ( !validEmail(email_val) ) {
					jQuery('<label id="'+email_id+'-error" class="error send_mail_error" for="'+email_id+'">Please enter an valid email.</label>').insertAfter(this);
				}  
			});

			if ( jQuery('.error').hasClass('send_mail_error') ) {

				var errorDiv = jQuery('.send_mail_error').first().offset().top - 300;
				jQuery(window).scrollTop(errorDiv);
			}
			else{

				// <i class="fa fa-angle-double-left"></i> Next <i class="fa fa-angle-double-right"></i>
				jQuery('#profilebuder4356 .continue_step').attr('disabled', 'disabled').html('Mail Sending. Please wait...');

				var fname = [];
				jQuery('input[name="fname[]"]').each( function() {
					fname.push(jQuery(this).val());
				});

				var femail = [];
				jQuery('input[name="user_email[]"]').each( function(index) {
					femail.push( jQuery(this).val() );
				}); 

				jQuery.ajax({
					type: 'POST',
					url: '<?php echo admin_url( "admin-ajax.php"); ?>',
					data: {
						action: 'send_mail_to_fr',
						fname: fname,
						femail: femail
					},
					success: function(res){
						//alert(res);
						jQuery('#profilebuder4356 .continue_step').removeAttr('disabled').html('<i class="fa fa-angle-double-left"></i> Next <i class="fa fa-angle-double-right"></i>');

					}
				});
			}
		});


		/*...................education level validation.....................*/
		
		jQuery(".study_major_option_msg div.radio label").click(function(){
			var majorText=jQuery(this).text();
			console.log('majorText; '+majorText);
			jQuery(this).closest('.modal-body').find('input[name=AREA_OF_STUDY]').val(majorText);
			});

		jQuery( ".accociatesdegree" ).on('keyup', 'input[name="AREA_OF_STUDY"]', function() {
			
			jQuery('#AREA_OF_STUDY-error').remove();
			var area_val = jQuery('input[name="AREA_OF_STUDY"]').val();
			if ( area_val == '' ) {
				jQuery('#profilebuder4342').removeClass('thisValid');
				jQuery('<label id="AREA_OF_STUDY-error" class="error study_error" for="AREA_OF_STUDY">Please enter an area of study.</label>').insertAfter('input[name="AREA_OF_STUDY"]');
			}
			else{
				jQuery('#AREA_OF_STUDY-error').remove();
			}
		});

		jQuery( ".accociatesdegree" ).on('keyup', 'input[name="SCHOOL_NAME"]', function() {
			
			jQuery('#SCHOOL_NAME-error').remove();
			var sch_val = jQuery('input[name="SCHOOL_NAME"]').val();
			if ( sch_val == '' ) {
				jQuery('#profilebuder4342').removeClass('thisValid');
				jQuery('<label id="SCHOOL_NAME-error" class="error study_error" for="SCHOOL_NAME">Please enter a school name.</label>').insertAfter('input[name="SCHOOL_NAME"]');
			}
			else{
				jQuery('#SCHOOL_NAME-error').remove();
			}
		});

		jQuery( ".accociatesdegree" ).on('keyup', 'input[name="STUDY_YEAR"]', function() {
			jQuery('#STUDY_YEAR-error').remove();
			var year = jQuery('input[name="STUDY_YEAR"]').val();
			if ( year == '' ) {
				jQuery('#profilebuder4342').removeClass('thisValid');
				jQuery('<label id="STUDY_YEAR-error" class="error study_error" for="STUDY_YEAR">Please enter your year of graduation.</label>').insertAfter('input[name="STUDY_YEAR"]');
			}
			else if ( numericOnly( jQuery('input[name="STUDY_YEAR"]').val() ) ) {
				jQuery('#profilebuder4342').removeClass('thisValid');
				jQuery('<label id="STUDY_YEAR-error" class="error study_error" for="STUDY_YEAR">Please enter only numeric values (0-9).</label>').insertAfter('input[name="STUDY_YEAR"]');
			}
			else{
				jQuery('#STUDY_YEAR-error').remove();
			}
		});

		jQuery('.accociatesdegree').on('click', 'input[name="STUDY_MAJOR"]', function() {
			jQuery('#STUDY_MAJOR-error').remove();
		});


		jQuery('.edu_level_save').on('click', function() {

			jQuery('.error').remove();

			var area_val = jQuery('input[name="AREA_OF_STUDY"]').val();
			/*if ( area_val == '' ) {
				jQuery('<label id="AREA_OF_STUDY-error" class="error study_error" for="AREA_OF_STUDY">Please enter an area of study.</label>').insertAfter('input[name="AREA_OF_STUDY"]');
			}*/

			var sch_val = jQuery('input[name="SCHOOL_NAME"]').val();
			if ( sch_val == '' ) {
				jQuery('<label id="SCHOOL_NAME-error" class="error study_error" for="SCHOOL_NAME">Please enter a school name.</label>').insertAfter('input[name="SCHOOL_NAME"]');
			}

			var year = jQuery('input[name="STUDY_YEAR"]').val();
			if ( year == '' ) {
				jQuery('<label id="STUDY_YEAR-error" class="error study_error" for="STUDY_YEAR">Please enter your year of graduation.</label>').insertAfter('input[name="STUDY_YEAR"]');
			}
			else if ( numericOnly( jQuery('input[name="STUDY_YEAR"]').val() ) ) {
				jQuery('<label id="STUDY_YEAR-error" class="error study_error" for="STUDY_YEAR">Please enter only numeric values (0-9).</label>').insertAfter('input[name="STUDY_YEAR"]');
			}

			var major = jQuery('input[name="STUDY_MAJOR"]');
			if ( !major.is(":checked") ) {
				jQuery('<label id="STUDY_MAJOR-error" class="error study_error" for="STUDY_MAJOR">Please select at least one.</label>').insertBefore('.study_major_option_msg');
			}

			if ( jQuery('.error').hasClass('study_error') ) {
				jQuery('#profilebuder4342').removeClass('thisValid');
				return false;
			}
			else{
				jQuery('#profilebuder4342').addClass('thisValid');
			}
		});


		/*............Federal Investigative or Law Enforcement Agency Validation............*/

		jQuery('.law_enforcement_list').on('click', 'input[name="US_LAW_ENFORCE_STATU"]', function() {
			jQuery('#US_LAW_ENFORCE_STATU-error').remove();
		});



		jQuery( ".law_enforcement_list" ).on('keyup', 'input[name="US_LAW_ENFORCE_STATU_OTHER"]', function() {
			
			jQuery('#US_LAW_ENFORCE_STATU_OTHER-error').remove();
			var sch_val = jQuery('input[name="US_LAW_ENFORCE_STATU_OTHER"]').val();
			if ( sch_val == '' ) {
				jQuery('#profilebuder4351').removeClass('thisValid');
				jQuery('<label id="US_LAW_ENFORCE_STATU_OTHER-error" class="error study_error" for="US_LAW_ENFORCE_STATU_OTHER">Please enter an other agency name.</label>').insertAfter('input[name="US_LAW_ENFORCE_STATU_OTHER"]');
			}
			else{
				jQuery('#US_LAW_ENFORCE_STATU_OTHER-error').remove();
			}
		});

		jQuery('input[name="US_LAW_ENFORCE_STATU_OTHER"]').hide();

		jQuery('.law_enforcement_list input[name="US_LAW_ENFORCE_STATU"]').on('click', function() {

			var _this = jQuery(this);
			
				if ( jQuery('input[name="US_LAW_ENFORCE_STATU"]:checked').val() == 'OTHER' ) {
					jQuery('input[name="US_LAW_ENFORCE_STATU_OTHER"]').show();
				}
				else{
					jQuery('input[name="US_LAW_ENFORCE_STATU_OTHER"]').hide().val('');
					jQuery('#US_LAW_ENFORCE_STATU_OTHER-error').remove();
				}
		});

		jQuery('.us_law_status_save').on('click', function() {
			jQuery('.error').remove();
			var law = jQuery('input[name="US_LAW_ENFORCE_STATU"]');
			if ( !law.is(":checked") ) {
				jQuery('<label id="US_LAW_ENFORCE_STATU-error" class="error law_error" for="US_LAW_ENFORCE_STATU"><br>Please select at least one.</label>').insertAfter('.law_status_close_button');
			}

			var law_val = jQuery('input[name="US_LAW_ENFORCE_STATU"]:checked').val();
			if ( law_val == 'OTHER' ) {
				var other_law_val = jQuery('input[name="US_LAW_ENFORCE_STATU_OTHER"]').val();
				if ( other_law_val == '' ) {
					jQuery('<label id="US_LAW_ENFORCE_STATU_OTHER-error" class="error law_error" for="US_LAW_ENFORCE_STATU_OTHER">Please enter an other agency name.</label>').insertAfter('input[name="US_LAW_ENFORCE_STATU_OTHER"]');
				}
			}

			if ( jQuery('.error').hasClass('law_error') ) {
				jQuery('#profilebuder4351').removeClass('thisValid');
				return false;
			}
			else{
				jQuery('#profilebuder4351').addClass('thisValid');
			}
		});


		jQuery('#law_enforcement_agency').click(function(){	
		    jQuery('input[name="US_LAW_ENFORCE_STATU"]').attr('checked', false);  
		    jQuery('input[name="US_LAW_ENFORCE_STATU_OTHER"]').hide();
			jQuery('input[name="US_LAW_ENFORCE_STATU_OTHER"]').val('');
			jQuery('#profilebuder4351').addClass('thisValid')
		});

		jQuery('#Investigative').on('hidden.bs.modal', function (e) {
			jQuery('#US_LAW_ENFORCE_STATU-error').remove();
			jQuery('#US_LAW_ENFORCE_STATU_OTHER-error').remove();

			if( !jQuery('input[name="US_LAW_ENFORCE_STATU"]').is(':checked') ){
				jQuery('#profilebuder4351').removeClass('thisValid');
			}
		});




		jQuery('#profilebuder4345 .clearfix').hide();
		jQuery('#profilebuder4345 .state').hide();

		jQuery('input[name="POSSES_DRIVER_LICENS"]').on('click', function() {
			var dr_li = jQuery('input[name="POSSES_DRIVER_LICENS"]:checked').val();
			if ( dr_li == 'Yes' ) {
				jQuery('#profilebuder4345 .clearfix').show();
				jQuery('#profilebuder4345 .state').show();
			}
			else{
				jQuery('#profilebuder4345 .clearfix').hide();
				jQuery('#profilebuder4345 .state').hide();
			}
		});

		jQuery('input[name="US_ARMED_FORCES_OPTION"]').on('click', function() {
			jQuery('.usfor_error').remove();
		});


		jQuery('input[name="FIELD_LICENSE_STATUS"]').click( function(){
			jQuery('#FIELD_LICENSE_STATE-error').remove();
			if ( jQuery('input[name="FIELD_LICENSE_STATUS"]:checked').val() == "Yes") {
				jQuery('#Licenceholder').modal('show');
	      	}
	      	else{

	      		jQuery('input[name="FIELD_LICENSE_STATE[]"]:checked').each(function(){
			      	jQuery(this).attr('checked', false);  
				});
	      	}
		});

		
		/*..............license_holder Validation..........................*/

		jQuery('.license_holder_save').on('click', function() {
			jQuery('#FIELD_LICENSE_STATE-error').remove();
			var law = jQuery('input[name="FIELD_LICENSE_STATE[]"]');
			if ( !law.is(":checked") ) {
				jQuery('<label id="FIELD_LICENSE_STATE-error" class="error state_error" for="FIELD_LICENSE_STATE"><br>Please select at least one.</label>').insertAfter('.license_holder_close_button');
			}

			if ( jQuery('.error').hasClass('state_error') ) {
				jQuery('#profilebuder4346').removeClass('thisValid');
				return false;
			}
			else{
				jQuery('#profilebuder4346').addClass('thisValid');
			}
		});


		jQuery('#Licenceholder').on('hidden.bs.modal', function (e) {
			jQuery('#FIELD_LICENSE_STATE-error').remove();

			if( !jQuery('input[name="FIELD_LICENSE_STATE[]"]').is(':checked') ){
				jQuery('#profilebuder4346').removeClass('thisValid');
			}
		});


		/*............Other Metropolitan City Validation...............*/

		jQuery('select[name="MAJOR_METROPOLITAN"]').on('change', function() {
			var city = jQuery(this).val();
			if ( city == 'Other') {
				jQuery('<div id="othe_metropo_city"><p><strong>Other closest major metropolitan city.</strong></p><div class="row metro_city"><div class="col-md-6"><div class="indent"><input type="text" value="" name="MAJOR_METROPOLITAN_O"></div></div></div></div>').insertAfter('.metro_city');
			}
			else{
				jQuery('#othe_metropo_city').remove();
			}
		});


		/*...............Upload profile photo js..............*/

		jQuery('button[data-current="4355"]').html('<i class="fa fa-angle-double-left"></i> Skip <i class="fa fa-angle-double-right"></i>');
		jQuery('<button id="uploading_pro_pic" class="step-btn" type="button"><i class="fa fa-angle-double-left"></i> Upload a photo <i class="fa fa-angle-double-right"></i></button>').insertBefore('button[data-current="4355"]');

		jQuery('#uploading_pro_pic').on('click', function() {
			jQuery('#ProfilePic').modal('show');
		});

		jQuery('.choose_image').each( function() {
			var df_av = jQuery('input[name="default_avtr"]').val();
			jQuery(this).attr('src', df_av);
		});


		jQuery('.custom_update').on('click', function() {
			jQuery('.profile_pic_error').remove();
			if ( jQuery(this).hasClass('validTrue') ) {
				jQuery('button[data-current="4355"]').trigger('click');
			}
			else{
				jQuery('#ProfilePic .modal-header').append('<label class="error profile_pic_error">Please add a professional photo.</label>');
				return false;
			}
		});
	});
 
</script>

<div class="modal fade" id="accociatesdegreeModal" tabindex="-1" role="dialog" aria-labelledby="accociatesdegreeModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
       <div class="accociatesdegree">
			<form class="form-horizontal" method="post">
			  <div class="form-group">
			    <label for="AREA_OF_STUDY" class="col-sm-4 control-label">Area of study:</label>
			    <div class="col-sm-8">
			      <input type="hidden" name="AREA_OF_STUDY" class="form-control" id="">
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="SCHOOL_NAME" class="col-sm-4 control-label">School Name:</label>
			    <div class="col-sm-8">
			      <input type="text" name="SCHOOL_NAME" class="form-control" id="">
			    </div>
			  </div>
              
			  <div class="form-group">
			    <label for="STUDY_YEAR" class="col-sm-4 control-label">Year of Graduation:</label>
			    <div class="col-sm-8">
			      <input type="text" name="STUDY_YEAR" class="form-control" id="">
			    </div>
			  </div>
 
			</form> 

			<p><strong>Major :</strong></p> 
			<div class="indent study_major_option_msg">
				<ul class="radio-group radio-group-1-2 study_major_option">
					<li><div class="radio"><label> <input type="radio" name="STUDY_MAJOR" id="" value="Criminal Justice">  Criminal Justice</label></div></li>
					<li><div class="radio"><label> <input type="radio" name="STUDY_MAJOR" id="" value="History"> History </label></div></li>
					<li><div class="radio"><label> <input type="radio" name="STUDY_MAJOR" id="" value="Criminology"> Criminology </label></div></li>
					<li><div class="radio"><label> <input type="radio" name="STUDY_MAJOR" id="" value="Philosophy"> Philosophy </label></div></li>
					<li><div class="radio"><label> <input type="radio" name="STUDY_MAJOR" id="" value="Law Enforcement"> Law Enforcement </label></div></li>
					<li><div class="radio"><label> <input type="radio" name="STUDY_MAJOR" id="" value="Business">  Business </label></div></li>
					<li><div class="radio"><label> <input type="radio" name="STUDY_MAJOR" id="" value="Forensics"> Forensics </label></div></li>
					<li><div class="radio"><label> <input type="radio" name="STUDY_MAJOR" id="" value="Communication"> Communication </label></div></li>
					<li><div class="radio"><label> <input type="radio" name="STUDY_MAJOR" id="" value="Journalism"> Journalism </label></div></li>
					<li><div class="radio"><label> <input type="radio" name="STUDY_MAJOR" id="" value="Economics"> Economics </label></div></li>
					<li><div class="radio"><label> <input type="radio" name="STUDY_MAJOR" id="" value="Chemistry"> Chemistry </label></div></li>
					<li><div class="radio"><label> <input type="radio" name="STUDY_MAJOR" id="" value="International Studies"> International Studies </label></div></li>
					<li><div class="radio"><label> <input type="radio" name="STUDY_MAJOR" id="" value="Computer Science">  Computer Science</label></div></li>
					<li><div class="radio"><label> <input type="radio" name="STUDY_MAJOR" id="" value="Political Science">  Political Science</label></div></li>
					<li><div class="radio"><label> <input type="radio" name="STUDY_MAJOR" id="" value="Mathematics">  Mathematics</label></div></li>
					<li><div class="radio"><label> <input type="radio" name="STUDY_MAJOR" id="" value="Sociology">    Sociology  </label></div></li>
					<li><div class="radio"><label> <input type="radio" name="STUDY_MAJOR" id="" value="Physics">    Physics  </label></div></li>
					<li><div class="radio"><label> <input type="radio" name="STUDY_MAJOR" id="" value="Law">    Law  </label></div></li>
					<li><div class="radio"><label> <input type="radio" name="STUDY_MAJOR" id="" value="Psychology">    Psychology  </label></div></li>
					 <li>
						<div class="radio"><label> <input type="radio" name="STUDY_MAJOR" id="" value="Other">    Other  </label></div>
						<input type="text" name="OTHER_STUDY" value="">
					</li> 
				</ul>
			</div>

			<div class="clearfix"></div>

		</div>
      </div>
      <div class="modal-footer text-center">
      <!--   <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
        <button type="button" class="btn btn-primary edu_level_save" data-dismiss="modal" >Save and close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="phdersdegreeModal" tabindex="-1" role="dialog" aria-labelledby="phdersdegreeModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
       <div class="accociatesdegree">
			<form class="form-horizontal" method="post">
			  <div class="form-group">
			    <label for="AREA_OF_STUDY" class="col-sm-4 control-label">Area of study:</label>
			    <div class="col-sm-8">
			      <input type="text" name="AREA_OF_STUDY" class="form-control" id="">
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="SCHOOL_NAME" class="col-sm-4 control-label">School Name:</label>
			    <div class="col-sm-8">
			      <input type="text" name="SCHOOL_NAME" class="form-control" id="">
			    </div>
			  </div>
			   <div class="form-group">
			    <label for="STUDY_YEAR" class="col-sm-4 control-label">Year:</label>
			    <div class="col-sm-8">
			      <input type="text" name="STUDY_YEAR" class="form-control" id="">
			    </div>
			  </div>

			</form>  
			<p><strong>Major :</strong></p> 
			<div class="indent study_major_option_msg">
				<ul class="radio-group radio-group-1-2 study_major_option">
					<li><div class="radio"><label> <input type="radio" name="STUDY_MAJOR" id="" value="Criminal Justice">  Criminal Justice</label></div></li>
					<li><div class="radio"><label> <input type="radio" name="STUDY_MAJOR" id="" value="History"> History </label></div></li>
					<li><div class="radio"><label> <input type="radio" name="STUDY_MAJOR" id="" value="Criminology"> Criminology </label></div></li>
					<li><div class="radio"><label> <input type="radio" name="STUDY_MAJOR" id="" value="Law Enforcement"> Law Enforcement </label></div></li>
					<li><div class="radio"><label> <input type="radio" name="STUDY_MAJOR" id="" value="Business">  Business </label></div></li>
					<li><div class="radio"><label> <input type="radio" name="STUDY_MAJOR" id="" value="Forensics"> Forensics </label></div></li>
					<li><div class="radio"><label> <input type="radio" name="STUDY_MAJOR" id="" value="Communication"> Communication </label></div></li>
					<li><div class="radio"><label> <input type="radio" name="STUDY_MAJOR" id="" value="Journalism"> Journalism </label></div></li>
					<li><div class="radio"><label> <input type="radio" name="STUDY_MAJOR" id="" value="Economics"> Economics </label></div></li>
					<li><div class="radio"><label> <input type="radio" name="STUDY_MAJOR" id="" value="Chemistry"> Chemistry </label></div></li>
					<li><div class="radio"><label> <input type="radio" name="STUDY_MAJOR" id="" value="International Studies"> International Studies </label></div></li>
					<li><div class="radio"><label> <input type="radio" name="STUDY_MAJOR" id="" value="Computer Science">  Computer Science</label></div></li>
					<li><div class="radio"><label> <input type="radio" name="STUDY_MAJOR" id="" value="Political Science">  Political Science</label></div></li>
					<li><div class="radio"><label> <input type="radio" name="STUDY_MAJOR" id="" value="Mathematics">  Mathematics</label></div></li>
					<li><div class="radio"><label> <input type="radio" name="STUDY_MAJOR" id="" value="Sociology">    Sociology  </label></div></li>
					<li><div class="radio"><label> <input type="radio" name="STUDY_MAJOR" id="" value="Physics">    Physics  </label></div></li>
				</ul>
			</div>
		<div class="clearfix"></div>
		</div>
      </div>
      <div class="modal-footer text-center">
        <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
        <button type="button" class="btn btn-primary edu_level_save" data-dismiss="modal" >Save and close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="BachelorsModal" tabindex="-1" role="dialog" aria-labelledby="BachelorsModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
       <div class="accociatesdegree">
			<form class="form-horizontal" method="post">
			  <div class="form-group">
			    <label for="AREA_OF_STUDY" class="col-sm-4 control-label">Area of study:</label>
			    <div class="col-sm-8">
			      <input type="text" name="AREA_OF_STUDY" class="form-control" id="">
			    </div>
			  </div>
			   <div class="form-group">
			    <label for="SCHOOL_NAME" class="col-sm-4 control-label">School Name:</label>
			    <div class="col-sm-8">
			      <input type="text" name="SCHOOL_NAME" class="form-control" id="">
			    </div>
			  </div>
			   <div class="form-group">
			    <label for="STUDY_YEAR" class="col-sm-4 control-label">Year:</label>
			    <div class="col-sm-8">
			      <input type="text" name="STUDY_YEAR" class="form-control" id="">
			    </div>
			  </div>

			</form>  
			<p><strong>Major :</strong></p> 
			<div class="indent study_major_option_msg">
				<ul class="radio-group radio-group-1-2 study_major_option">
					<li><div class="radio"><label> <input type="radio" name="STUDY_MAJOR" id="" value="Criminal Justice">  Criminal Justice</label></div></li>
					<li><div class="radio"><label> <input type="radio" name="STUDY_MAJOR" id="" value="History"> History </label></div></li>
					<li><div class="radio"><label> <input type="radio" name="STUDY_MAJOR" id="" value="Criminology"> Criminology </label></div></li>
					<li><div class="radio"><label> <input type="radio" name="STUDY_MAJOR" id="" value="Law Enforcement"> Law Enforcement </label></div></li>
					<li><div class="radio"><label> <input type="radio" name="STUDY_MAJOR" id="" value="Business">  Business </label></div></li>
					<li><div class="radio"><label> <input type="radio" name="STUDY_MAJOR" id="" value="Forensics"> Forensics </label></div></li>
					<li><div class="radio"><label> <input type="radio" name="STUDY_MAJOR" id="" value="Communication"> Communication </label></div></li>
					<li><div class="radio"><label> <input type="radio" name="STUDY_MAJOR" id="" value="Journalism"> Journalism </label></div></li>
					<li><div class="radio"><label> <input type="radio" name="STUDY_MAJOR" id="" value="Economics"> Economics </label></div></li>
					<li><div class="radio"><label> <input type="radio" name="STUDY_MAJOR" id="" value="Chemistry"> Chemistry </label></div></li>
					<li><div class="radio"><label> <input type="radio" name="STUDY_MAJOR" id="" value="International Studies"> International Studies </label></div></li>
					<li><div class="radio"><label> <input type="radio" name="STUDY_MAJOR" id="" value="Computer Science">  Computer Science</label></div></li>
					<li><div class="radio"><label> <input type="radio" name="STUDY_MAJOR" id="" value="Political Science">  Political Science</label></div></li>
					<li><div class="radio"><label> <input type="radio" name="STUDY_MAJOR" id="" value="Mathematics">  Mathematics</label></div></li>
					<li><div class="radio"><label> <input type="radio" name="STUDY_MAJOR" id="" value="Sociology">    Sociology  </label></div></li>
					<li><div class="radio"><label> <input type="radio" name="STUDY_MAJOR" id="" value="Physics">    Physics  </label></div></li>
				</ul>
			</div>
		<div class="clearfix"></div>
		</div>
      </div>
      <div class="modal-footer text-center">
        <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
        <button type="button" class="btn btn-primary edu_level_save" data-dismiss="modal" >Save and close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="mstersdegreeModal" tabindex="-1" role="dialog" aria-labelledby="mstersdegreeModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
       <div class="accociatesdegree">
			<form class="form-horizontal" mothed="post">
			  <div class="form-group">
			    <label for="AREA_OF_STUDY" class="col-sm-4 control-label">Area of study:</label>
			    <div class="col-sm-8">
			      <input type="text" name="AREA_OF_STUDY" class="form-control" id="">
			    </div>
			  </div>
			   <div class="form-group">
			    <label for="SCHOOL_NAME" class="col-sm-4 control-label">School Name:</label>
			    <div class="col-sm-8">
			      <input type="text" name="SCHOOL_NAME" class="form-control" id="">
			    </div>
			  </div>
			   <div class="form-group">
			    <label for="STUDY_YEAR" class="col-sm-4 control-label">Year:</label>
			    <div class="col-sm-8">
			      <input type="text" name="STUDY_YEAR" class="form-control" id="">
			    </div>
			  </div>

			</form>  
			<p><strong>Major :</strong></p> 
			<div class="indent study_major_option_msg">
				<ul class="radio-group radio-group-1-2 study_major_option">
					<li><div class="radio"><label> <input type="radio" name="STUDY_MAJOR" id="" value="Criminal Justice">  Criminal Justice</label></div></li>
					<li><div class="radio"><label> <input type="radio" name="STUDY_MAJOR" id="" value="History"> History </label></div></li>
					<li><div class="radio"><label> <input type="radio" name="STUDY_MAJOR" id="" value="Criminology"> Criminology </label></div></li>
					<li><div class="radio"><label> <input type="radio" name="STUDY_MAJOR" id="" value="Law Enforcement"> Law Enforcement </label></div></li>
					<li><div class="radio"><label> <input type="radio" name="STUDY_MAJOR" id="" value="Business">  Business </label></div></li>
					<li><div class="radio"><label> <input type="radio" name="STUDY_MAJOR" id="" value="Forensics"> Forensics </label></div></li>
					<li><div class="radio"><label> <input type="radio" name="STUDY_MAJOR" id="" value="Communication"> Communication </label></div></li>
					<li><div class="radio"><label> <input type="radio" name="STUDY_MAJOR" id="" value="Journalism"> Journalism </label></div></li>
					<li><div class="radio"><label> <input type="radio" name="STUDY_MAJOR" id="" value="Economics"> Economics </label></div></li>
					<li><div class="radio"><label> <input type="radio" name="STUDY_MAJOR" id="" value="Chemistry"> Chemistry </label></div></li>
					<li><div class="radio"><label> <input type="radio" name="STUDY_MAJOR" id="" value="International Studies"> International Studies </label></div></li>
					<li><div class="radio"><label> <input type="radio" name="STUDY_MAJOR" id="" value="Computer Science">  Computer Science</label></div></li>
					<li><div class="radio"><label> <input type="radio" name="STUDY_MAJOR" id="" value="Political Science">  Political Science</label></div></li>
					<li><div class="radio"><label> <input type="radio" name="STUDY_MAJOR" id="" value="Mathematics">  Mathematics</label></div></li>
					<li><div class="radio"><label> <input type="radio" name="STUDY_MAJOR" id="" value="Sociology">    Sociology  </label></div></li>
					<li><div class="radio"><label> <input type="radio" name="STUDY_MAJOR" id="" value="Physics">    Physics  </label></div></li>
				</ul>
			</div>
		<div class="clearfix"></div>
		</div>
      </div>
      <div class="modal-footer text-center">
        <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
        <button type="button" class="btn btn-primary edu_level_save" data-dismiss="modal" >Save and close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="Investigative" tabindex="-1" role="dialog" aria-labelledby="InvestigativeModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close law_status_close_button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body vscroll">

		<div class="indent">
			<div class="law_enforcement_list">
				<div class="radio"><label><input id="" name="US_LAW_ENFORCE_STATU" type="radio" value="Central Intelligence Agency (CIA) Office of Inspector General of the CIA" /> Central Intelligence Agency (CIA) Office of Inspector General of the CIA</label></div>
				<div class="radio"><label><input id="" name="US_LAW_ENFORCE_STATU" type="radio" value="Department of Agriculture (USDA)" /> Department of Agriculture (USDA)</label></div>
				<div class="radio"><label><input id="" name="US_LAW_ENFORCE_STATU" type="radio" value="United States Forest Service Office of Law Enforcement and Investigations" /> United States Forest Service Office of Law Enforcement and Investigations</label></div>
				<div class="radio"><label><input id="" name="US_LAW_ENFORCE_STATU" type="radio" value="Office of Inspector General (USDA-OIG)" /> Office of Inspector General (USDA-OIG)</label></div>
				<div class="radio"><label><input id="" name="US_LAW_ENFORCE_STATU" type="radio" value="Department of Commerce (USDOC)" /> Department of Commerce (USDOC)</label></div>
				<div class="radio"><label><input id="" name="US_LAW_ENFORCE_STATU" type="radio" value="National Oceanic and Atmospheric Administration (NOAA)" /> National Oceanic and Atmospheric Administration (NOAA)</label></div>
				<div class="radio"><label><input id="" name="US_LAW_ENFORCE_STATU" type="radio" value="Office of Export Enforcement (OEE)" /> Office of Export Enforcement (OEE)</label></div>
				<div class="radio"><label><input id="" name="US_LAW_ENFORCE_STATU" type="radio" value="Department of Health and Human Services (HHS)" /> Department of Health and Human Services (HHS)</label></div>
				<div class="radio"><label><input id="" name="US_LAW_ENFORCE_STATU" type="radio" value="Internal Revenue Service (IRS)" /> Internal Revenue Service (IRS)</label></div>
				<div class="radio"><label><input id="" name="US_LAW_ENFORCE_STATU" type="radio" value="Food and Drug Administration (FDA)" /> Food and Drug Administration (FDA)</label></div>
				<div class="radio"><label><input id="" name="US_LAW_ENFORCE_STATU" type="radio" value="FDA Office of Criminal Investigations (OCI)" /> FDA Office of Criminal Investigations (OCI)</label></div>
				<div class="radio"><label><input id="" name="US_LAW_ENFORCE_STATU" type="radio" value="Office of Inspector General (HHS-OIG)" /> Office of Inspector General (HHS-OIG)</label></div>
				<div class="radio"><label><input id="" name="US_LAW_ENFORCE_STATU" type="radio" value="Defense Advanced Research Agency (DARPA)" /> Defense Advanced Research Agency (DARPA)</label></div>
				<div class="radio"><label><input id="" name="US_LAW_ENFORCE_STATU" type="radio" value="Department of Education (ED)" /> Department of Education (ED)</label></div>
				<div class="radio"><label><input id="" name="US_LAW_ENFORCE_STATU" type="radio" value="Office of Inspector General (ED-OIG)" /> Office of Inspector General (ED-OIG)</label></div>
				<div class="radio"><label><input id="" name="US_LAW_ENFORCE_STATU" type="radio" value="Department of Homeland Security (DHS)" /> Department of Homeland Security (DHS)</label></div>
				<div class="radio"><label><input id="" name="US_LAW_ENFORCE_STATU" type="radio" value="Coast Guard Investigative Service (CGIS)" /> Coast Guard Investigative Service (CGIS)</label></div>
				<div class="radio"><label><input id="" name="US_LAW_ENFORCE_STATU" type="radio" value="Citizenship and Immigration Services (CIS)" /> Citizenship and Immigration Services (CIS)</label></div>
				<div class="radio"><label><input id="" name="US_LAW_ENFORCE_STATU" type="radio" value="Immigration and Customs Enforcement / Homeland Security Investigations (ICE/HSI)" /> Immigration and Customs Enforcement / Homeland Security Investigations (ICE/HSI)</label></div>
				<div class="radio"><label><input id="" name="US_LAW_ENFORCE_STATU" type="radio" value="Customs and Border Protection (CBP)" /> Customs and Border Protection (CBP)</label></div>
				<div class="radio"><label><input id="" name="US_LAW_ENFORCE_STATU" type="radio" value="United States Secret Service (USSS)" /> United States Secret Service (USSS)</label></div>
				<div class="radio"><label><input id="" name="US_LAW_ENFORCE_STATU" type="radio" value="Transportation Security Administration (TSA)" /> Transportation Security Administration (TSA)</label></div>
				<div class="radio"><label><input id="" name="US_LAW_ENFORCE_STATU" type="radio" value="Federal Protective Service (FPS)" /> Federal Protective Service (FPS)</label></div>
				<div class="radio"><label><input id="" name="US_LAW_ENFORCE_STATU" type="radio" value="Office of Inspector General (DHS-OIG)" /> Office of Inspector General (DHS-OIG)</label></div>
				<div class="radio"><label><input id="" name="US_LAW_ENFORCE_STATU" type="radio" value="Department of the Interior (DOI)" /> Department of the Interior (DOI)</label></div>
				<div class="radio"><label><input id="" name="US_LAW_ENFORCE_STATU" type="radio" value="Bureau of Land Management (BLM)" /> Bureau of Land Management (BLM)</label></div>
				<div class="radio"><label><input id="" name="US_LAW_ENFORCE_STATU" type="radio" value="United States Fish and Wildlife Service (USFWS)" /> United States Fish and Wildlife Service (USFWS)</label></div>
				<div class="radio"><label><input id="" name="US_LAW_ENFORCE_STATU" type="radio" value="United States Park Police (USPP)" /> United States Park Police (USPP)</label></div>
				<div class="radio"><label><input id="" name="US_LAW_ENFORCE_STATU" type="radio" value="National Park Service (NPS)" /> National Park Service (NPS)</label></div>
				<div class="radio"><label><input id="" name="US_LAW_ENFORCE_STATU" type="radio" value="Bureau of Indian Affairs Police (BIA)" /> Bureau of Indian Affairs Police (BIA)</label></div>
				<div class="radio"><label><input id="" name="US_LAW_ENFORCE_STATU" type="radio" value="Office of Inspector General (DOI-OIG)" /> Office of Inspector General (DOI-OIG)</label></div>
				<div class="radio"><label><input id="" name="US_LAW_ENFORCE_STATU" type="radio" value="United States Department of Labor (DOL-OIG)" /> United States Department of Labor (DOL-OIG)</label></div>
				<div class="radio"><label><input id="" name="US_LAW_ENFORCE_STATU" type="radio" value="Office of Labor Racketeering and Fraud Investigations Department of Defense (DOD)" /> Office of Labor Racketeering and Fraud Investigations Department of Defense (DOD)</label></div>
				<div class="radio"><label><input id="" name="US_LAW_ENFORCE_STATU" type="radio" value="Defense Intelligence Agency (DIA)" /> Defense Intelligence Agency (DIA)</label></div>
				<div class="radio"><label><input id="" name="US_LAW_ENFORCE_STATU" type="radio" value="National Security Agency (NSA)" /> National Security Agency (NSA)</label></div>
				<div class="radio"><label><input id="" name="US_LAW_ENFORCE_STATU" type="radio" value="Defense Security Service (DSS) – Non-law enforcement" /> Defense Security Service (DSS) – Non-law enforcement</label></div>
				<div class="radio"><label><input id="" name="US_LAW_ENFORCE_STATU" type="radio" value="United States Army Criminal Investigation Command (USACIDC)" /> United States Army Criminal Investigation Command (USACIDC)</label></div>
				<div class="radio"><label><input id="" name="US_LAW_ENFORCE_STATU" type="radio" value="United States Army Counterintelligence (Army CI)" /> United States Army Counterintelligence (Army CI)</label></div>
				<div class="radio"><label><input id="" name="US_LAW_ENFORCE_STATU" type="radio" value="Pentagon Force Protection Agency (PFPA)" /> Pentagon Force Protection Agency (PFPA)</label></div>
				<div class="radio"><label><input id="" name="US_LAW_ENFORCE_STATU" type="radio" value="Naval Criminal Investigative Service (NCIS)" /> Naval Criminal Investigative Service (NCIS)</label></div>
				<div class="radio"><label><input id="" name="US_LAW_ENFORCE_STATU" type="radio" value="United States Marine Corps Criminal Investigation Division (Marine CID Agent)" /> United States Marine Corps Criminal Investigation Division (Marine CID Agent)</label></div>
				<div class="radio"><label><input id="" name="US_LAW_ENFORCE_STATU" type="radio" value="Air Force Office of Special Investigations (AFOSI)" /> Air Force Office of Special Investigations (AFOSI)</label></div>
				<div class="radio"><label><input id="" name="US_LAW_ENFORCE_STATU" type="radio" value="Office of Inspector General (DOD-OIG)" /> Office of Inspector General (DOD-OIG)</label></div>
				<div class="radio"><label><input id="" name="US_LAW_ENFORCE_STATU" type="radio" value="Defense Criminal Investigative Service (DCIS)" /> Defense Criminal Investigative Service (DCIS)</label></div>
				<div class="radio"><label><input id="" name="US_LAW_ENFORCE_STATU" type="radio" value="United States Office of Personnel Management (OPM)" /> United States Office of Personnel Management (OPM)</label></div>
				<div class="radio"><label><input id="" name="US_LAW_ENFORCE_STATU" type="radio" value="Federal Investigative Services Division (OPM-FISD)" /> Federal Investigative Services Division (OPM-FISD)</label></div>
				<div class="radio"><label><input id="" name="US_LAW_ENFORCE_STATU" type="radio" value="Office of Inspector General (OPM-OIG)" /> Office of Inspector General (OPM-OIG)</label></div>
				<div class="radio"><label><input id="" name="US_LAW_ENFORCE_STATU" type="radio" value="Department of Justice (DOJ)" /> Department of Justice (DOJ)</label></div>
				<div class="radio"><label><input id="" name="US_LAW_ENFORCE_STATU" type="radio" value="Bureau of Alcohol, Tobacco, Firearms and Explosives (ATF)" /> Bureau of Alcohol, Tobacco, Firearms and Explosives (ATF)</label></div>
				<div class="radio"><label><input id="" name="US_LAW_ENFORCE_STATU" type="radio" value="Drug Enforcement Administration (DEA" /> Drug Enforcement Administration (DEA)</label></div>
				<div class="radio"><label><input id="" name="US_LAW_ENFORCE_STATU" type="radio" value="Federal Bureau of Investigation (FBI)" /> Federal Bureau of Investigation (FBI)</label></div>
				<div class="radio"><label><input id="" name="US_LAW_ENFORCE_STATU" type="radio" value="United States Marshals Service (USMS)" /> United States Marshals Service (USMS)</label></div>
				<div class="radio"><label><input id="" name="US_LAW_ENFORCE_STATU" type="radio" value="Office of Inspector General (DOJ-OIG)" /> Office of Inspector General (DOJ-OIG)</label></div>
				<div class="radio"><label><input id="" name="US_LAW_ENFORCE_STATU" type="radio" value="Federal Bureau of Prisons (BOP)" /> Federal Bureau of Prisons (BOP)</label></div>
				<div class="radio"><label><input id="" name="US_LAW_ENFORCE_STATU" type="radio" value="Department of State" /> Department of State</label></div>
				<div class="radio"><label><input id="" name="US_LAW_ENFORCE_STATU" type="radio" value="U.S. Diplomatic Security Service (DSS) (FS-2501)" /> U.S. Diplomatic Security Service (DSS) (FS-2501)</label></div>
				<div class="radio"><label><input id="" name="US_LAW_ENFORCE_STATU" type="radio" value="Office of Inspector General (DOS-OIG)" /> Office of Inspector General (DOS-OIG)</label></div>
				<div class="radio"><label><input id="" name="US_LAW_ENFORCE_STATU" type="radio" value="Department of Transportation (DOT)" /> Department of Transportation (DOT)</label></div>
				<div class="radio"><label><input id="" name="US_LAW_ENFORCE_STATU" type="radio" value="Office of Inspector General for the Department of Transportation (DOT-OIG)" /> Office of Inspector General for the Department of Transportation (DOT-OIG)</label></div>
				<div class="radio"><label><input id="" name="US_LAW_ENFORCE_STATU" type="radio" value="Federal Motor Carrier Safety Administration (FMCSA)" /> Federal Motor Carrier Safety Administration (FMCSA)</label></div>
				<div class="radio"><label><input id="" name="US_LAW_ENFORCE_STATU" type="radio" value="Federal Aviation Administration (FAA)" /> Federal Aviation Administration (FAA)</label></div>
				<div class="radio"><label><input id="" name="US_LAW_ENFORCE_STATU" type="radio" value="Department of the Treasury" /> Department of the Treasury</label></div>
				<div class="radio"><label><input id="" name="US_LAW_ENFORCE_STATU" type="radio" value="IRS Criminal Investigation Division (IRS-CID)" /> IRS Criminal Investigation Division (IRS-CID)</label></div>
				<div class="radio"><label><input id="" name="US_LAW_ENFORCE_STATU" type="radio" value="Alcohol and Tobacco Tax and Trade Bureau (TTB)" /> Alcohol and Tobacco Tax and Trade Bureau (TTB)</label></div>
				<div class="radio"><label><input id="" name="US_LAW_ENFORCE_STATU" type="radio" value="United States Mint Police" /> United States Mint Police</label></div>
				<div class="radio"><label><input id="" name="US_LAW_ENFORCE_STATU" type="radio" value="Bureau of Engraving and Printing Police" /> Bureau of Engraving and Printing Police</label></div>
				<div class="radio"><label><input id="" name="US_LAW_ENFORCE_STATU" type="radio" value="Federal Reserve Board Police" /> Federal Reserve Board Police</label></div>
				<div class="radio"><label><input id="" name="US_LAW_ENFORCE_STATU" type="radio" value="Treasury Inspector General for Tax Administration (TIGTA)" /> Treasury Inspector General for Tax Administration (TIGTA)</label></div>
				<div class="radio"><label><input id="" name="US_LAW_ENFORCE_STATU" type="radio" value="Department of State" /> Department of State</label></div>
				<div class="radio"><label><input id="" name="US_LAW_ENFORCE_STATU" type="radio" value="U.S. Diplomatic Security Service (DSS) (FS-2501)" /> U.S. Diplomatic Security Service (DSS) (FS-2501)</label></div>
				<div class="radio"><label><input id="" name="US_LAW_ENFORCE_STATU" type="radio" value="Office of Inspector General (DOS-OIG)" /> Office of Inspector General (DOS-OIG)</label></div>
				<div class="radio"><label><input id="" name="US_LAW_ENFORCE_STATU" type="radio" value="Department of Transportation (DOT)" /> Department of Transportation (DOT)</label></div>
				<div class="radio"><label><input id="" name="US_LAW_ENFORCE_STATU" type="radio" value="Postal Service (USPS)" /> Postal Service (USPS)</label></div>
				<div class="radio"><label><input id="" name="US_LAW_ENFORCE_STATU" type="radio" value="United States Postal Inspection Service (USPIS – not an Inspector General)" /> United States Postal Inspection Service (USPIS – not an Inspector General)</label></div>
				<div class="radio"><label><input id="" name="US_LAW_ENFORCE_STATU" type="radio" value="Office of Inspector General (USPS-OIG)" /> Office of Inspector General (USPS-OIG)</label></div>
				<div class="radio"><label><input id="" name="US_LAW_ENFORCE_STATU" type="radio" value="United States Environmental Protection Agency (EPA) Criminal Investigation Division" /> United States Environmental Protection Agency (EPA) Criminal Investigation Division</label></div>
				<div class="radio"><label><input id="" name="US_LAW_ENFORCE_STATU" type="radio" value="Department of Natural Resources (DNR)" /> Department of Natural Resources (DNR)</label></div>
				<div class="radio"><label><input id="" name="US_LAW_ENFORCE_STATU" type="radio" value="Federal Emergency Management Agency (FEMA)" /> Federal Emergency Management Agency (FEMA)</label></div>
				<div class="radio"><label><input id="" name="US_LAW_ENFORCE_STATU" type="radio" value="Office of Inspector General (EPA-OIG)" /> Office of Inspector General (EPA-OIG)</label></div>
				<div class="radio"><label><input id="" name="US_LAW_ENFORCE_STATU" type="radio" value="OTHER" /> OTHER</label> <span class="form-inline"> &nbsp; <input type="text" class="form-control" name="US_LAW_ENFORCE_STATU_OTHER" /></span></div>
			</div>
	  	</div>
  	  </div>
      <div class="modal-footer text-center">
        <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
        <button type="button" class="btn btn-primary us_law_status_save" data-dismiss="modal">Save and close</button>
      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="Licenceholder" tabindex="-1" role="dialog" aria-labelledby="LicenceholderModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close license_holder_close_button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body vscroll">

		<div class="indent">
			<div class="form-group license_holder">
			<p><strong>From which State(s) are your currently a license holder?</strong></p>
			<div class="indent">
			<ul class="radio-group radio-group-1-3">
			<li>
			<div class="checkbox"><label><input id="alabama" name="FIELD_LICENSE_STATE[]" type="checkbox" value="Alaska">Alaska</label></div>
			</li>
			<li>
			<div class="checkbox"><label><input id="louisiana" name="FIELD_LICENSE_STATE[]" type="checkbox" value="Alabama">Alabama</label></div>
			</li>
			<li>
			<div class="checkbox"><label><input id="ohio" name="FIELD_LICENSE_STATE[]" type="checkbox" value="Arkansas">Arkansas</label></div>
			</li>
			<li>
			<div class="checkbox"><label><input id="alaska" name="FIELD_LICENSE_STATE[]" type="checkbox" value="Arizona">Arizona</label></div>
			</li>
			<li>
			<div class="checkbox"><label><input id="maine" name="FIELD_LICENSE_STATE[]" type="checkbox" value="California">California</label></div>
			</li>
			<li>
			<div class="checkbox"><label><input id="oklahoma" name="FIELD_LICENSE_STATE[]" type="checkbox" value="Colorado">Colorado</label></div>
			</li>
			<li>
			<div class="checkbox"><label><input id="arizona" name="FIELD_LICENSE_STATE[]" type="checkbox" value="Connecticut">Connecticut</label></div>
			</li>
			<li>
			<div class="checkbox"><label><input id="maryland" name="FIELD_LICENSE_STATE[]" type="checkbox" value="District of Columbia">District of Columbia</label></div>
			</li>
			<li>
			<div class="checkbox"><label><input id="oregon" name="FIELD_LICENSE_STATE[]" type="checkbox" value="Delaware">Delaware</label></div>
			</li>
			<li>
			<div class="checkbox"><label><input id="arkansas" name="FIELD_LICENSE_STATE[]" type="checkbox" value="Florida">Florida</label></div>
			</li>
			<li>
			<div class="checkbox"><label><input id="massachusetts" name="FIELD_LICENSE_STATE[]" type="checkbox" value="Georgia">Georgia</label></div>
			</li>
			<li>
			<div class="checkbox"><label><input id="pennsylvania" name="FIELD_LICENSE_STATE[]" type="checkbox" value="Hawaii">Hawaii</label></div>
			</li>
			<li>
			<div class="checkbox"><label><input id="california" name="FIELD_LICENSE_STATE[]" type="checkbox" value="Iowa">Iowa</label></div>
			</li>
			<li>
			<div class="checkbox"><label><input id="michigan" name="FIELD_LICENSE_STATE[]" type="checkbox" value="Idaho">Idaho</label></div>
			</li>
			<li>
			<div class="checkbox"><label><input id="rhode_island" name="FIELD_LICENSE_STATE[]" type="checkbox" value="Illinois">Illinois</label></div>
			</li>
			<li>
			<div class="checkbox"><label><input id="colorado" name="FIELD_LICENSE_STATE[]" type="checkbox" value="Indiana">Indiana</label></div>
			</li>
			<li>
			<div class="checkbox"><label><input id="minnesota" name="FIELD_LICENSE_STATE[]" type="checkbox" value="Kansas">Kansas</label></div>
			</li>
			<li>
			<div class="checkbox"><label><input id="south_carolina" name="FIELD_LICENSE_STATE[]" type="checkbox" value="Kentucky">Kentucky</label></div>
			</li>
			<li>
			<div class="checkbox"><label><input id="connecticut" name="FIELD_LICENSE_STATE[]" type="checkbox" value="Louisiana">Louisiana</label></div>
			</li>
			<li>
			<div class="checkbox"><label><input id="mississippi" name="FIELD_LICENSE_STATE[]" type="checkbox" value="Massachusetts">Massachusetts</label></div>
			</li>
			<li>
			<div class="checkbox"><label><input id="south_dakota" name="FIELD_LICENSE_STATE[]" type="checkbox" value="Maryland">Maryland</label></div>
			</li>
			<li>
			<div class="checkbox"><label><input id="delaware" name="FIELD_LICENSE_STATE[]" type="checkbox" value="Maine">Maine</label></div>
			</li>
			<li>
			<div class="checkbox"><label><input id="missouri" name="FIELD_LICENSE_STATE[]" type="checkbox" value="Michigan">Michigan</label></div>
			</li>
			<li>
			<div class="checkbox"><label><input id="tennessee" name="FIELD_LICENSE_STATE[]" type="checkbox" value="Minnesota">Minnesota</label></div>
			</li>
			<li>
			<div class="checkbox"><label><input id="florida" name="FIELD_LICENSE_STATE[]" type="checkbox" value="Missouri">Missouri</label></div>
			</li>
			<li>
			<div class="checkbox"><label><input id="montana" name="FIELD_LICENSE_STATE[]" type="checkbox" value="Mississippi">Mississippi</label></div>
			</li>
			<li>
			<div class="checkbox"><label><input id="texas" name="FIELD_LICENSE_STATE[]" type="checkbox" value="Montana">Montana</label></div>
			</li>
			<li>
			<div class="checkbox"><label><input id="georgia" name="FIELD_LICENSE_STATE[]" type="checkbox" value="North Carolina">North Carolina</label></div>
			</li>
			<li>
			<div class="checkbox"><label><input id="nebraska" name="FIELD_LICENSE_STATE[]" type="checkbox" value="North Dakota">North Dakota</label></div>
			</li>
			<li>
			<div class="checkbox"><label><input id="utah" name="FIELD_LICENSE_STATE[]" type="checkbox" value="Nebraska">Nebraska</label></div>
			</li>
			<li>
			<div class="checkbox"><label><input id="hawaii" name="FIELD_LICENSE_STATE[]" type="checkbox" value="New Hampshire">New Hampshire</label></div>
			</li>
			<li>
			<div class="checkbox"><label><input id="nevada" name="FIELD_LICENSE_STATE[]" type="checkbox" value="New Jersey">New Jersey</label></div>
			</li>
			<li>
			<div class="checkbox"><label><input id="vermont" name="FIELD_LICENSE_STATE[]" type="checkbox" value="New Mexico">New Mexico</label></div>
			</li>
			<li>
			<div class="checkbox"><label><input id="idaho" name="FIELD_LICENSE_STATE[]" type="checkbox" value="Nevada">Nevada</label></div>
			</li>
			<li>
			<div class="checkbox"><label><input id="hampshire" name="FIELD_LICENSE_STATE[]" type="checkbox" value="New York">New_York</label></div>
			</li>
			<li>
			<div class="checkbox"><label><input id="virginia" name="FIELD_LICENSE_STATE[]" type="checkbox" value="Ohio">Ohio</label></div>
			</li>
			<li>
			<div class="checkbox"><label><input id="illinois" name="FIELD_LICENSE_STATE[]" type="checkbox" value="Oklahoma">Oklahoma</label></div>
			</li>
			<li>
			<div class="checkbox"><label><input id="jersey" name="FIELD_LICENSE_STATE[]" type="checkbox" value="Oregon">Oregon</label></div>
			</li>
			<li>
			<div class="checkbox"><label><input id="washington" name="FIELD_LICENSE_STATE[]" type="checkbox" value="Pennsylvania">Pennsylvania</label></div>
			</li>
			<li>
			<div class="checkbox"><label><input id="iowa" name="FIELD_LICENSE_STATE[]" type="checkbox" value="Rhode Island">Rhode Island</label></div>
			</li>
			<li>
			<div class="checkbox"><label><input id="York" name="FIELD_LICENSE_STATE[]" type="checkbox" value="South Carolina">South Carolina</label></div>
			</li>
			<li>
			<div class="checkbox"><label><input id="virginia" name="FIELD_LICENSE_STATE[]" type="checkbox" value="South Dakota">South Dakota</label></div>
			</li>
			<li>
			<div class="checkbox"><label><input id="kansas" name="FIELD_LICENSE_STATE[]" type="checkbox" value="Tennessee">Tennessee</label></div>
			</li>
			<li>
			<div class="checkbox"><label><input id="carolina" name="FIELD_LICENSE_STATE[]" type="checkbox" value="Texas">Texas</label></div>
			</li>
			<li>
			<div class="checkbox"><label><input id="wisconsin" name="FIELD_LICENSE_STATE[]" type="checkbox" value="Utah">Utah</label></div>
			</li>
			<li>
			<div class="checkbox"><label><input id="kentucky" name="FIELD_LICENSE_STATE[]" type="checkbox" value="Virginia">Virginia</label></div>
			</li>
			<li>
			<div class="checkbox"><label><input id="dakota" name="FIELD_LICENSE_STATE[]" type="checkbox" value="Vermont">Vermont</label></div>
			</li>
			<li>
			<div class="checkbox"><label><input id="dakota" name="FIELD_LICENSE_STATE[]" type="checkbox" value="Washington">Washington</label></div>
			</li>
			<li>
			<div class="checkbox"><label><input id="wyoming" name="FIELD_LICENSE_STATE[]" type="checkbox" value="Wisconsin">Wisconsin</label></div>
			</li>
			<li>
			<div class="checkbox"><label><input id="wyoming" name="FIELD_LICENSE_STATE[]" type="checkbox" value="West Virginia">West Virginia</label></div>
			</li>
			<li>
			<div class="checkbox"><label><input id="wyoming" name="FIELD_LICENSE_STATE[]" type="checkbox" value="Wyoming">Wyoming</label></div>
			</li>
			</ul>
			</div>
			</div>
	  	</div>
  	  </div>
      <div class="modal-footer text-center">
        <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
        <button type="button" class="btn btn-primary license_holder_save" data-dismiss="modal">Save and close</button>
      </div>
    </div>
  </div>
</div>




<div class="modal fade" id="ProfilePic" tabindex="-1" role="dialog" aria-labelledby="ProfilePicModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close profile_pic_close_button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body vscroll">

      	<?php echo do_shortcode("[avatar_upload]"); ?>
		
  	  </div>
      <div class="modal-footer text-center">
        <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
        <!-- <button type="button" class="btn btn-primary profile_pic_save" data-dismiss="modal">Save and close</button> -->
        <input type="button" name="submit" id="submit" class="button button-primary custom_update" data-dismiss="modal" value="Save and Countinue">
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="AGREE_TO_RESPOND" tabindex="-1" role="dialog" aria-labelledby="ProfilePicModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close profile_pic_close_button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body vscroll">
      <div class="wpcf7-form text-center">
      <p>We are sorry that you do not agree to be honest.  Without your honesty we do not feel comfortable in establishing a relationship with you, let alone working with you.  Honesty is a prerequisite. We can not provide services to you under any circumstances.</p>
      </div>
		
  	  </div>
      <div class="modal-footer text-center">
      <button type="button" class="continue_step step-btn " data-dismiss="modal"><i class="fa fa-angle-double-left"></i> Proceed <i class="fa fa-angle-double-right"></i></button>
      </div>
    </div>
  </div>
</div>

