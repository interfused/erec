jQuery(document).ready(function(){
//alert('login page');
	var loginMsgTmp=jQuery("#login_message_normal");
	if(loginMsgTmp.length){
		jQuery("#loginform").prepend(loginMsgTmp);
		jQuery(".op-login-form-1").remove();
	}
});