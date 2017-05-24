var is_ajax = false;
var ajaxurl = siteurl.ajaxurl;

// Method for name field
jQuery(function($){
    jQuery.validator.addMethod("lettersonly", function(value, element) {
        if(jQuery.trim(value).length == 0){
          return false;
        }
        return this.optional(element) || /^[a-zA-Z.\s]+$/i.test(value);
    }, "Only alphabetical characters");
 });
// Method for email address
jQuery(function(){
    jQuery.validator.addMethod("emailrequired", function(value, element) {
        if(jQuery.trim(value).length == 0){
          return false;
        }
        return this.optional(element) || /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/i.test(value);
    }, "Please enter a valid email address"); 
    });


jQuery(document).ready(function(){

	jQuery.validator.addMethod("loginRegex", function(value, element) {
        return this.optional(element) || /^[0-9\-\s]+$/i.test(value);
    }, "Must contain only numbers or dashes. ex. ###-###-####");


    // The function you currently have
	jQuery('#cell_phone, #office_phone, input[name="tel-493"], input[name="tel-729"]').keypress(function (e) {
		var thisID = jQuery(this).attr('name');
		var allowedChars = new RegExp("^[0-9\-]+|[\b]+$"); /*^[0-9._]+|[\b]+$*/
		var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
		if (allowedChars.test(str)) {
			return true;
		}
		swal({
		  type: 'error',
		  title: "Error!",
		  html: true,
		  text: "Allow only numbers(0-9) and dashes(-). Ex. 999-999-9999",
		  confirmButtonClass: "btn-primary btn-sm phonevalidation",
		});
		jQuery('#'+thisID+'-error').hide();
		e.preventDefault();
		return false;
	}).keyup(function() {
		var forbiddenChars = new RegExp("[^0-9\-]", 'g');
		if (forbiddenChars.test(jQuery(this).val())) {
			jQuery(this).val(jQuery(this).val().replace(forbiddenChars, ''));
		}
	});

	
	jQuery("#jobseekerlogin").validate({ 
	    rules: {
	        username: {
	           required: true
	    },
	        password: {
	           required: true
	        }
	    },
	    messages: {
	      log: {
	           required: "This field is required"
	       },
	      pwd: {
	      	required: "This field is required"
	      }
	    },
	    submitHandler: function (form) {
	    	jQuery('#loaders').show();
		   //	jQuery('#wp_submitseeker').attr('disabled','disabled');
		  // e.preventDefault();
		   jQuery.ajax({
	            type: 'POST',
	            dataType: 'json',
	            url: ajaxurl+'/wp-admin/admin-ajax.php',
	            data: {
	                'action': 'login_user', //calls wp_ajax_nopriv_ajaxlogin
	                'email': jQuery('#username').val(), 
	                'password': jQuery('#password').val(), 
	                'remember': jQuery('#remember').is(":checked"), 
	                'security': jQuery('#security').val(),
	                'redirectUrl': jQuery('#redirect_to').val()
	            },
	            success: function(data){
	            	//alert(data.loggedin);
	                if (data.loggedin == true){
	                	//jQuery('#loaders').hide();
	                    document.location.href = data.redirect;
	                }else{
	                	jQuery('#loaders').hide();
	                	jQuery('#error_message').show();
	                	jQuery('#error_message').html(data.message);
	                }
	            }
	        });
		}

	});
/*
	jQuery("#employerlogin").validate({ 
	    rules: {
	        empusername: {
	           required: true
	    },
	        emppassword: {
	           required: true
	        }
	    },
	    messages: {
	      empusername: {
	           required: "This field is required"
	       },
	      emppassword: {
	      	required: "This field is required"
	      }
	    },
	    submitHandler: function (form) {
	    	jQuery('#loaders').show();
		   //jQuery('#wp_submitemployer').attr('disabled','disabled');
		  // e.preventDefault();
		   jQuery.ajax({
	            type: 'POST',
	            dataType: 'json',
	            url: ajaxurl+'/wp-admin/admin-ajax.php',
	            data: {
	                'action': 'login_user', //calls wp_ajax_nopriv_ajaxlogin
	                'email': jQuery('#empusername').val(), 
	                'password': jQuery('#emppassword').val(),
	                'remember': jQuery('#empremember').is(":checked"), 
	                'security': jQuery('#empsecurity').val() },
	            success: function(data){
	                if (data.loggedin == true){
	                    document.location.href =data.redirect;
	                }else{
	            		jQuery('#loaders').hide();
	                	jQuery('#error_message').show();
						jQuery('#error_message').html(data.message);
	                }
	            }
	        });
		}

	});



	jQuery("#recruiterlogin").validate({ 
	    rules: {
	        recusername: {
	           required: true
	    },
	        recpassword: {
	           required: true
	        }
	    },
	    messages: {
	      recusername: {
	           required: "This field is required"
	       },
	      recpassword: {
	      	required: "This field is required"
	      }
	    },
	    submitHandler: function (form) {
		  // jQuery('#wp_submitrecruiter').attr('disabled','disabled');
		  jQuery('#loaders').show();
		  // e.preventDefault();
		   jQuery.ajax({
	            type: 'POST',
	            dataType: 'json',
	            url: ajaxurl+'/wp-admin/admin-ajax.php',
	            data: {
	                'action': 'login_user', //calls wp_ajax_nopriv_ajaxlogin
	                'email': jQuery('#recusername').val(), 
	                'password': jQuery('#recpassword').val(),
	                'remember': jQuery('#recremember').is(":checked"),
	                'security': jQuery('#recsecurity').val() },
	            success: function(data){
	                if (data.loggedin == true){
	                    document.location.href = data.redirect;
	                }else{
	            		jQuery('#loaders').hide();
	                	jQuery('#error_message').show();
						jQuery('#error_message').html(data.message);
	                }
	            }
	        });
		}

	});
*/

	// Employer registration form
	jQuery("#employersform").validate({ 
	    rules: {
	        firstname: {
	           required: true,
	           //lettersonly:true
	         
	        },
	        lastname: {
	           required: true,
	           //lettersonly:true
	        },
	        user_email: {
	           required: true,
	           emailrequired:true
	        },
	        office_phone: {
	           //number:true,
	           minlength: 12,
	           maxlength: 14,
	        },
	        cell_phone: {
	           required: true,
	           //number:true,
	           minlength: 12,
	           maxlength: 14,
	        },
	    },
	    messages: {
	      firstname: {
	           required: "First name  is required",
	           //lettersonly:"Enter valid first name"
	       },
	      lastname: {
	      	required:"Last name is required",
	      	//lettersonly: "Enter valid last name"
	      },
	      user_email:{
	      	required:"Email address is required",
	      	emailrequired:"Enter valid email address"
	      },
	      office_phone:{
	      	//number:"Enter valid office phone number",
	      	minlength: "Enter minimum 10 digits office phone number",
            maxlength: "Enter valid office phone number",
	      },
	      cell_phone:{
	      	required:"Phone number is required",
	      	//number:"Enter valid phone number",
	      	minlength: "Enter valid phone number",
            maxlength: "Enter valid phone number",
	      }
	    },submitHandler: function (form) {
	    	var encoded_mail = btoa(jQuery('#user_email').val());
		   //jQuery('#employer_submit').attr('disabled','disabled');
		   jQuery('#loaders').show();
		  // e.preventDefault();
		   jQuery.ajax({
	            type: 'POST',
	            dataType: 'json',
	            url: ajaxurl+'/wp-admin/admin-ajax.php',
	            data: {
	                'action': 'employers_user', //calls wp_ajax_nopriv_ajaxlogin
	                'fname': jQuery('#firstname').val(), 
	                'lname': jQuery('#lastname').val(),
	                'email': jQuery('#user_email').val(),
	                'company': jQuery('#company_name').val(),
	                'office_phone': jQuery('#office_phone').val(),
	                'ext': jQuery('#ext').val(),
	                'cell_phone': jQuery('#cell_phone').val() },
	            success: function(data){
	            	//jQuery('form#login_form p.status').text(data.message);
					if (data.createuser == true){
	                	document.location.href = ajaxurl+'/employers/successful-registration/?se='+encoded_mail+'&sm=1';
	                }else{
	            		jQuery('#loaders').hide();
	                	jQuery('#error_message').show();
	                	jQuery('#error_message').html(data.message);
	                }
	            }
	        });
		}
	});               


	// Validation for job_seeker
	jQuery("#registerforms").validate({ 
	    rules: {
	        firstname: {
	           required: true,
	           //lettersonly:true
	         
	        },
	        lastname: {
	           required: true,
	           //lettersonly:true
	        },
	        user_email: {
	           required: true,
	           emailrequired:true
	        },
	        cell_phone: {
	           required: true,
	           //number:true,
	           minlength: 12,
	           maxlength: 14,
	           // loginRegex: true
	        },
	    },
	    messages: {
	      firstname: {
	           required: "First name  is required",
	           //lettersonly:"Enter valid first name"
	       },
	      lastname: {
	      	required:"Last name is required",
	      	//lettersonly: "Enter valid last name"
	      },
	      user_email:{
	      	required:"Email address is required",
	      	emailrequired:"Enter valid email address"
	      },
	      cell_phone:{
	      	required:"Phone number is required",
	      	//number:"Enter valid phone number",
	      	minlength: "Enter valid phone number",
            maxlength: "Enter valid phone number",
	      }
	    },
	    submitHandler: function (form) {
	    	var encoded_mail = btoa(jQuery('#user_email').val());
		 // jQuery('#jobseeker_submit').attr('disabled','disabled');
		  jQuery('#loaders').show();
		  // e.preventDefault();
		   jQuery.ajax({
	            type: 'POST',
	            dataType: 'json',
	            url: ajaxurl+'/wp-admin/admin-ajax.php',
	            data: {
	                'action': 'seeker_user', //calls wp_ajax_nopriv_ajaxlogin
	                'fname': jQuery('#firstname').val(), 
	                'lname': jQuery('#lastname').val(),
	                'email': jQuery('#user_email').val(),
	                'cell_phone': jQuery('#cell_phone').val() },
	            success: function(data){
	            	//jQuery('form#login_form p.status').text(data.message);
					if (data.createuser == true){
	                	document.location.href =  ajaxurl+'/job-seekers/successful-registration/?se='+encoded_mail+'&sm=1';
	                }else{
	            		jQuery('#loaders').hide();
	                	jQuery('#error_message').show();
	                	jQuery('#error_message').text(data.message);
	                }
	          		
	            }
	        });
		}
	});

	//For contact form 7
    jQuery("#contact_now_to_recruiter").validate({
        rules: {
            your_name: {
				required: true,
				//lettersonly: true,
				minlength: 3                         
            },
            your_email: {
				required: true,
				email: true  
            },
            your_subject: {
				required: true,
				//lettersonly: true
            },
            your_message: {
				required: true,
				//lettersonly: true
            }
        },            
        messages: {
            your_name: {
				required: "Please enter your name",
				//lettersonly: "Please type letters only",
				minlength: "Please type at least 3 letters"                         
            },
            your_email: {
				required: "Plese enter your email address",
				email: "Please type a valid email address"
         	},
         	your_subject: {
				required: "Please enter the conserned subject",
				//lettersonly: "Please type letters only"
            },
            your_message: {
				required: "Please enter your message",
				//lettersonly: "Please type letters only"
         	} 
    	}
	});

	//For contact form 7
    jQuery("#tell_us_ur_stry").validate({
        rules: {
            your_message: {
                required: true,
                //lettersonly: true
            }
             
         },            
        messages: {
            your_message: {
                required: "Please enter your story",
                //lettersonly: "Please type letters only"
         	}
             
    	}
	});

	jQuery("#tell_us_ur_stry .tell-us-your-story .user_name").hide();
	jQuery("#tell_us_ur_stry .tell-us-your-story .user_mail").hide();


	//For contact form 7
    jQuery("#tell_us_abt_prblm").validate({
        rules: {
            select_problem_type: {
                required: true                 
            },
            other_problem: {
                required: true                 
            },
            description: {
                required: true,
                //lettersonly: true  
            },
            impact: {
                required: true
            }
             
         },            
        messages: {
            select_problem_type: {
                required: "Please select an problem type"                      
            },
            other_problem: {
                required: "Please enter your problem"                      
            },
            description: {
                required: "Plese enter the description here",
                //lettersonly: "Please type letters only"
         	},
            impact: {
                required: "Please select an impact"
         	}
             
    	}
	});

	jQuery("#tell_us_abt_prblm .create-a-trouble-ticket .user_name").hide();
	jQuery("#tell_us_abt_prblm .create-a-trouble-ticket .user_mail").hide();
	

	//For contact form 7
    jQuery("#give_us_ur_feedback").validate({
        rules: {
            how_doing: {
            		required: true                                         
            },
            your_like: {
                    required: true,
                   // lettersonly: true     
            },
            what_improved: {
                    required: true,
                   // lettersonly: true
            },
            how_services_better: {
                    required: true,
                   // lettersonly: true                           
            },
            good_value_for_cost: {
                    required: true     
            },
            recommend_us: {
                    required: true    
            },
            like_contacted: {
                    required: true                            
            },
            how_accomplish_goal: {
                    required: true,
                    //lettersonly: true     
            }  
         },            
        messages: {
            how_doing: {
                    required: "Please select any option"                             
            },
            your_like: {
                    required: "Plese enter the description here",
                    //lettersonly: "Please type letters only"     
            },
            what_improved: {
                    required: "Plese enter the description here",
                    //lettersonly: "Please type letters only"    
            },
            how_services_better: {
                    required: "Plese enter the description here",
                    //lettersonly: "Please type letters only"                             
            },
            good_value_for_cost: {
                    required: "Please select any option"      
            },
            recommend_us: {
                    required: "Please select any option"     
            },
            like_contacted: {
                    required: "Please select any option"                              
            },
            how_accomplish_goal: {
                    required: "Plese enter the description here",
                    //lettersonly: "Please type letters only"   
            } 
             
    	}
	});
	jQuery("#give_us_ur_feedback .got-feedback .user_name").hide();
	jQuery("#give_us_ur_feedback .got-feedback .user_mail").hide();


	//For contact form 7
    jQuery("#visit_the_help_center_id").validate({
        rules: {
            to_email_address: {
                         required: true,
                         email: true                 
            },
            subject: {
                         required: true,
                         //lettersonly: true  
            },
            comments: {
                         required: true,
                         //lettersonly: true
            }
             
         },            
        messages: {
            to_email_address: {
                         required: "Plese enter your email address",
                         email: "Please type a valid email address"                      
            },
            subject: {
                         required: "Plese enter the subject here",
                         //lettersonly: "Please type letters only"
         	},
            comments: {
                         required: "Plese enter the comments here",
                         //lettersonly: "Please type letters only"
         	}
             
    	}
	});

	jQuery("#visit_the_help_center_id .help .user_name").hide();
	jQuery("#visit_the_help_center_id .help .user_mail").hide();

	//For reset password form
    /*jQuery("#change_pass_form_id").validate({
        rules: {
            old_passwd: {
                         required: true,
                         minlength: 4,
                         maxlength: 20                
            },
            new_passwd: {
                         required: true,
                         minlength: 4,
                         maxlength: 20  
            },
            confirm_passwd: {
                         required: true,
                         minlength: 4,
                         maxlength: 20
            }
             
         },            
        messages: {
            old_passwd: {
                         required: "Plese enter the old password",
                         minlength: "Please type at least 4 letters",
                         maxlength: "Please type at most 20 letters"                     
            },
            new_passwd: {
                         required: "Plese enter the new password",
                         minlength: "Please type at least 4 letters",
                         maxlength: "Please type at most 20 letters"
         	},
            confirm_passwd: {
                         required: "Plese enter the confirm password",
                         minlength: "Please type at least 4 letters",
                         maxlength: "Please type at most 20 letters"
         	}
             
    	},
		submitHandler: function(form) {
		    jQuery(form).ajaxSubmit();
		}

	});*/


	jQuery("#wpcf7-f3944-p1882-o1 form").validate({
	    rules: {
	        'your-name': {
				required: true,        
	        },
	        'your-email': {
				required: true,
				email: true  
	        },
	        'tel-493': {
				required: true,
				minlength: 12,
				maxlength: 14,
	        },
	    },            
	    messages: {
	        'your-name': {
				required: "Please enter your name.",                 
	        },
	        'your-email': {
				required: "Plese enter your email address.",
				email: "Please type a valid email address."
	     	},
	     	'tel-493': {
				required: "Please enter yout cell phone no.",
				minlength: "Oops, there's a problem! Try using a dash to separate the area code and the number sequences.",
            	maxlength: "Oops, there's a problem! Try using a dash to separate the area code and the number sequences.",
	        }
		}
	});


	jQuery(".EMP_AREA_TO_B_SEARCH").on('click', function(){
		if(jQuery(this).val()=="United States"){ 
			jQuery("#EMP_STATES_OF_US_CONTAINER").removeClass("hide");
		}else{
			jQuery("#EMP_STATES_OF_US_CONTAINER").addClass("hide");
			jQuery('select[name="EMP_STATES_OF_US"]').val('');
		}
	});

	jQuery(".EMP_WUD_RELOC_SUGGES").on('click', function(){
		if(jQuery(this).val()=="Yes"){ 
			jQuery(".relocation_related_ques").removeClass("hide");
		}else{
			jQuery(".relocation_related_ques").addClass("hide");
			jQuery('textarea[name="EMP_CPY_REL_INCN_DES"]').val('');
			jQuery('input[name="EMP_CPY_REL_INCN"]').prop('checked', false);
			jQuery('textarea[name="EMP_CMNY_ALLOC_ANUAL"]').val('');
			jQuery('input[name="EMP_CMNY_ALLOC_UNON"]').prop('checked', false);
		}
	});

	jQuery(".EMP_OFER_SIGNING_BON").on('click', function(){
		if(jQuery(this).val()=="Yes"){ 
			jQuery(".signing_bonuses_ques").removeClass("hide");
		}else{
			jQuery(".signing_bonuses_ques").addClass("hide");
			jQuery('textarea[name="EMP_CPNY_SIG_BON_DES"]').val('');
			jQuery('input[name="EMP_CPNY_SIG_BON"]').prop('checked', false);
		}
	});

	jQuery(".EMP_TEAM_IN_MULTILOC").on('click', function(){
		if(jQuery(this).val()=="Yes"){ 
			jQuery(".team_in_multilocations_ques").removeClass("hide");
		}else{
			jQuery(".team_in_multilocations_ques").addClass("hide");
			jQuery(".location_have_multi_decisions_ques").addClass("hide");
			jQuery('input[name="EMP_OFFICES_IN_STATE[]"]').each(function(){
				jQuery(this).prop('checked', false);
			});
			jQuery('input[name="EMP_HAV_TEAM_IN_MULT"]').prop('checked', false);
		}
	});

	jQuery(".EMP_HAV_TEAM_IN_MULT").on('click', function(){
		if(jQuery(this).val()=="Yes"){ 
			jQuery(".location_have_multi_decisions_ques").removeClass("hide");
		}else{
			jQuery(".location_have_multi_decisions_ques").addClass("hide");
			jQuery('input[name="EMP_JOB_POSTNG_METH[]"]').prop('checked', false);
		}
	});

	jQuery(".EMP_R_INTRNSIP_AVBL").on('click', function(){
		if(jQuery(this).val()=="Yes"){ 
			jQuery(".internships_in_compny_ques").removeClass("hide");
		}else{
			jQuery(".internships_in_compny_ques").addClass("hide");
			jQuery('textarea[name="EMP_UNI_PRG_INT_LOC"]').val('');
		}
	});

	jQuery(".EMP_CNY_ACPT_INT_CAN").on('click', function(){
		if(jQuery(this).val()=="Yes"){ 
			jQuery(".seek_candidates_ques").removeClass("hide");
		}else{
			jQuery(".seek_candidates_ques").addClass("hide");
			jQuery('textarea[name="EMP_INT_WHT_ANL_CT_D"]').val('');
			jQuery('input[name="EMP_INT_WHT_ANL_CT"]').prop('checked', false);
		}
	});

	jQuery(".EMP_CNY_SPND_ON_JOB").on('click', function(){
		if(jQuery(this).val()=="Internet job boards"){ 
			jQuery("#EMP_INTRNT_JOB_BOARD").removeClass("hide");
		}else{
			jQuery("#EMP_INTRNT_JOB_BOARD").addClass("hide");
			jQuery("#EMP_INTRNT_JOB_BOARD").val("");
		}
		if(jQuery(this).val()=="Paper-based bulletin boards"){ 
			jQuery("#EMP_PPR_BSE_BULL_BOA").removeClass("hide");
		}else{
			jQuery("#EMP_PPR_BSE_BULL_BOA").addClass("hide");
			jQuery("#EMP_PPR_BSE_BULL_BOA").val("");
		}
		if(jQuery(this).val()=="Kiosks"){ 
			jQuery("#EMP_KIOSKS_DESC").removeClass("hide");
		}else{
			jQuery("#EMP_KIOSKS_DESC").addClass("hide");
			jQuery("#EMP_KIOSKS_DESC").val("");
		}
	});

	jQuery(".EMP_PER_RES_RVD").on('click', function(){
		if(jQuery(this).attr('id')=="total_resumes1"){ 
			jQuery("#EMP_UNSOLICITED_MAIL").removeClass("hide");
		}else{
			jQuery("#EMP_UNSOLICITED_MAIL").addClass("hide");
			jQuery("#EMP_UNSOLICITED_MAIL").val("");
		}
		if(jQuery(this).attr('id')=="total_resumes2"){ 
			jQuery("#EMP_REQ_PRINT_ADDS").removeClass("hide");
		}else{
			jQuery("#EMP_REQ_PRINT_ADDS").addClass("hide");
			jQuery("#EMP_REQ_PRINT_ADDS").val("");
		}
		if(jQuery(this).attr('id')=="total_resumes3"){ 
			jQuery("#EMP_OUT_STAFF_FIRMS").removeClass("hide");
		}else{
			jQuery("#EMP_OUT_STAFF_FIRMS").addClass("hide");
			jQuery("#EMP_OUT_STAFF_FIRMS").val("");
		}
		if(jQuery(this).attr('id')=="total_resumes4"){ 
			jQuery("#EMP_JOB_FAIRS_SELECT").removeClass("hide");
		}else{
			jQuery("#EMP_JOB_FAIRS_SELECT").addClass("hide");
			jQuery("#EMP_JOB_FAIRS_SELECT").val("");
		}
		if(jQuery(this).attr('id')=="total_resumes5"){ 
			jQuery("#EMP_CAMPUS_RECRUIT").removeClass("hide");
		}else{
			jQuery("#EMP_CAMPUS_RECRUIT").addClass("hide");
			jQuery("#EMP_CAMPUS_RECRUIT").val("");
		}
		if(jQuery(this).attr('id')=="total_resumes6"){ 
			jQuery("#EMP_INT_AD_N_POST_BO").removeClass("hide");
		}else{
			jQuery("#EMP_INT_AD_N_POST_BO").addClass("hide");
			jQuery("#EMP_INT_AD_N_POST_BO").val("");
		}
		if(jQuery(this).attr('id')=="total_resumes7"){ 
			jQuery("#EMP_EMPLOYE_REFERRAL").removeClass("hide");
		}else{
			jQuery("#EMP_EMPLOYE_REFERRAL").addClass("hide");
			jQuery("#EMP_EMPLOYE_REFERRAL").val("");
		}
	});
		
	jQuery(".EMP_OF_THE_RES_RVD").on('click', function(){
		if(jQuery(this).attr('id')=="resumes_recieved1"){ 
			jQuery("#EMP_PPR_FORM_FAX").removeClass("hide");
		}else{
			jQuery("#EMP_PPR_FORM_FAX").addClass("hide");
			jQuery("#EMP_PPR_FORM_FAX").val("");
		}
		if(jQuery(this).attr('id')=="resumes_recieved2"){ 
			jQuery("#EMP_THRU_ONLINE_APPS").removeClass("hide");
		}else{
			jQuery("#EMP_THRU_ONLINE_APPS").addClass("hide");
			jQuery("#EMP_THRU_ONLINE_APPS").val("");
		}
		if(jQuery(this).attr('id')=="resumes_recieved3"){ 
			jQuery("#EMP_THRU_CORP_EMAIL").removeClass("hide");
		}else{
			jQuery("#EMP_THRU_CORP_EMAIL").addClass("hide");
			jQuery("#EMP_THRU_CORP_EMAIL").val("");
		}
		if(jQuery(this).attr('id')=="resumes_recieved4"){ 
			jQuery("#EMP_MAGZNS_PERIODIC").removeClass("hide");
		}else{
			jQuery("#EMP_MAGZNS_PERIODIC").addClass("hide");
			jQuery("#EMP_MAGZNS_PERIODIC").val("");
		}
	});

	jQuery(".EMP_HOW_HEAR_ABT_EYE").on('click', function(){
		if(jQuery(this).attr('id')=="how_abt_eyerecruit_other"){ 
			if(jQuery("#how_abt_eyerecruit_other").is(":checked")){
				jQuery("#EMP_HW_HR_ABT_EYE_D").removeClass("hide");
			}else{
				jQuery("#EMP_HW_HR_ABT_EYE_D").addClass("hide");
				jQuery('input[name="EMP_HOW_HEAR_ABT_EYE[]"]:checked').each(function(i){
					jQuery(this).prop('checked', false);	
				});
			}
		}
	});


	jQuery(".industry_reflects_sevices_href").on('click', function(){
		if(jQuery(".EMP_INDUS_REF_SRVICE").is(":checked")){
			jQuery(".EMP_INDUS_REF_SRVICE").prop("checked", false);
		}else{
			jQuery(".EMP_INDUS_REF_SRVICE").prop("checked", true);	
		}
	});
	
});

