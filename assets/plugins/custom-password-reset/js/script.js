var is_ajax = false;
var ajaxurl = ajax_url.ajaxurl;
jQuery( document ).ready( function( $ ){
 	jQuery("#custom_pass_reset_form").validate({ // initialize the plugin
    rules: {
      user_login: {
        required: true,
      }
    },
    messages: {
      user_login: {
        required: "Username or E-mail is required",
      }
    },
    submitHandler: function(form){
     jQuery('#loaders').show();
     jQuery('#pass-submit').attr('disabled','disabled');
     jQuery('.invalid_user_login, .valid_user_login, .user_stats_pending, .user_stats_denied').remove();
     var user_login = jQuery('#user_login').val();
     jQuery.ajax({
      url: '/wp-admin/admin-ajax.php',
      type: 'POST',
      dataType: 'json',
      data: {
       action: 'custom_password_reset1',
       'user_login': user_login
     },
     success: function(r){
       jQuery('#loaders').hide();
       if (r.status == 'error') {
        jQuery('<label class="invalid_user_login error">Invalid username or e-mail.</label>').insertAfter('#user_login')
        jQuery('#pass-submit').removeAttr('disabled');
      }
      else if(r.status == 'success'){
        swal({
						  // imageUrl: img,
						  type: 'success',
						  title: "Password Reset Email Sent",
						  html: true,
						  text: "An email has been sent to your email address, "+r.user_email+" . <br> Follow the directions in the email to reset your password. <div class='password-popup-main'>Reset Password</div>",
						  confirmButtonClass: "btn-default btn-sm",
						  confirmButtonText: "Done",
						  closeOnConfirm: true,
						  customClass: 'password_alert'
						},
						function(isConfirm) {
							if (isConfirm) {
								window.location = r.url;
							} 
						});


						/*jQuery('<label class="valid_user_login success">Check your e-mail for the confirmation link.</label>').insertAfter('#user_login')
						setTimeout( function() {
							window.location = r.url;
						},2000);*/
jQuery('#pass-submit').removeAttr('disabled');
}
else if (r.status == 'pending') {
  jQuery('<label class="user_stats_pending error">User status is pending.</label>').insertAfter('#user_login')
  jQuery('#pass-submit').removeAttr('disabled');
}
else if (r.status == 'denied') {
  jQuery('<label class="user_stats_denied error">User status is denied.</label>').insertAfter('#user_login')
  jQuery('#pass-submit').removeAttr('disabled');
}
}
});
}

});




	jQuery("#cus_resetpassform").validate({ // initialize the plugin
    rules: {
     pass1: {
       required: true,
       minlength: 6
     },
     pass2: {
       required: true,
       equalTo: '#pass1',
       minlength: 6
     }
   },
   messages: {
     pass1:{
       required: "Enter the password.",
       minlength: "Password should be minimum 6 characters."

     }, 
     pass2:{
       required: "Enter the confirm password.",
       equalTo: "Password and confirm password do not match.",
       minlength: "Confirm Password should be minimum 6 characters."
     }
   },
   submitHandler: function(form){
     jQuery('#loaders').show();
     jQuery('#chag-pass-submit').attr('disabled','disabled');
     var pass = jQuery('#pass1').val();
     var user_login = jQuery('#user_login').val();
     jQuery.ajax({
      url: '/wp-admin/admin-ajax.php',
      method: 'POST',
      dataType: 'json',
      data: {
       action: 'change_password',
       pass: pass,
       user_login: user_login
     },
     success: function(r){
       jQuery('#loaders').hide();
       if (r.status == 'error') {
        jQuery('<label class="invalid_user_login error">Something wrong.</label>').insertAfter('#chag-pass-submit')
        jQuery('#chag-pass-submit').removeAttr('disabled');
      }
      else if(r.status == 'success'){
        jQuery('<label class="valid_user_login success">Your password successfully changed.</label>').insertAfter('#pass2')
        setTimeout( function() {
         window.location = r.url;
       },2000);
        jQuery('#chag-pass-submit').removeAttr('disabled');
      }
    }
  });
   }

 });
});
