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
		jQuery("#profilebuder7077").addClass("active");
		currentid = '7077';
		window.location.hash = btoa(currentid);
		showCurrentStep();
		jQuery('body').addClass('profile-builder-page');
		var rec_id = "<?php echo $_REQUEST['rec']; ?>";
		if ( rec_id == '' ) {
			window.location = '<?php echo site_url(); ?>';
			return false;
		}


		//file code starts here(step 6)
		jQuery("#upload").on('click', function(){
			if ( jQuery('input[name="EMP_CMPNY_LIS_FILE"]').val() != '') {
				var fd = new FormData();
				var files_data = jQuery('.EMP_CMPNY_LIS_FILE');
				jQuery('#profilebuder7082 .continue_step').html('File uploading. Please wait...').attr('disabled');

				jQuery.each(jQuery(files_data), function(i, obj) {
		            jQuery.each(obj.files,function(j,file){
		                fd.append('files[' + j + ']', file);
		            })
		        });

				fd.append('action', 'emp_profile_upload_files');  
			    //fd.append('user_id', rec_id);
			    jQuery.ajax({
		            type: 'POST',
		            url: '<?php echo admin_url("admin-ajax.php"); ?>',
		            data: fd,
		            contentType: false,
		            processData: false,
		            success: function(response){

		            	jQuery('#profilebuder7082 .continue_step').removeAttr('disabled').html('<i class="fa fa-angle-double-left"></i>  Continue  <i class="fa fa-angle-double-right"></i>');
		            	
		            	if ( response == 'Allow only pdf and doc file format.'  || response == 'File size is too large!' ) {
		            		jQuery('<span class="text-primary cust_error_invalid">'+response+'</span>').insertAfter('input[name="EMP_CMPNY_LIS_FILE"]');
		            		return false;
		            	}
		            }
		        });
			}
		});
		//file code ends here

		
		jQuery(".continue_step").on('click',function() {
			
			//step 2
			var EMP_YR_POS_IN_ORGN=[];
			jQuery('input[name="EMP_YR_POS_IN_ORGN[]"]:checked').each(function(i){
				EMP_YR_POS_IN_ORGN.push(jQuery(this).val());
			});

			//step 3
			var EMP_NO_EMP_ON_TEAM = jQuery('input[name="EMP_NO_EMP_ON_TEAM"]:checked').val();

			//step 4
			var EMP_AREA_TO_B_SEARCH = jQuery('input[name="EMP_AREA_TO_B_SEARCH"]:checked').val();
			var EMP_STATES_OF_US = jQuery('select[name="EMP_STATES_OF_US"]').val();

			//step 5
			var EMP_INDUS_REF_SRVICE=[];
			jQuery('input[name="EMP_INDUS_REF_SRVICE[]"]:checked').each(function(){
				EMP_INDUS_REF_SRVICE.push(jQuery(this).val());
			});

			//step 6
			var EMP_CMPNY_LIS_INFO = jQuery('textarea[name="EMP_CMPNY_LIS_INFO"]').val();

			//step 7
			var EMP_WUD_RELOC_SUGGES = jQuery('input[name="EMP_WUD_RELOC_SUGGES"]:checked').val();
			var EMP_CPY_REL_INCN_DES = jQuery('textarea[name="EMP_CPY_REL_INCN_DES"]').val();
			var EMP_CPY_REL_INCN = jQuery('input[name="EMP_CPY_REL_INCN"]:checked').val();
			var EMP_CMNY_ALLOC_ANUAL = jQuery('textarea[name="EMP_CMNY_ALLOC_ANUAL"]').val();
			var EMP_CMNY_ALLOC_UNON = jQuery('input[name="EMP_CMNY_ALLOC_UNON"]:checked').val();

			//step 8
			var EMP_OFER_SIGNING_BON = jQuery('input[name="EMP_OFER_SIGNING_BON"]:checked').val();
			var EMP_CPNY_SIG_BON_DES = jQuery('textarea[name="EMP_CPNY_SIG_BON_DES"]').val();
			var EMP_CPNY_SIG_BON = jQuery('input[name="EMP_CPNY_SIG_BON"]:checked').val();			
			var EMP_ORG_UNQ_FR_EMP_D = jQuery('textarea[name="EMP_ORG_UNQ_FR_EMP_D"]').val();
			var EMP_ORG_UNQ_FR_EMP = jQuery('input[name="EMP_ORG_UNQ_FR_EMP"]:checked').val();

			//step 9
			var EMP_TEAM_IN_MULTILOC = jQuery('input[name="EMP_TEAM_IN_MULTILOC"]:checked').val();
			var EMP_OFFICES_IN_STATE=[];
			jQuery('input[name="EMP_OFFICES_IN_STATE[]"]:checked').each(function(i){
				EMP_OFFICES_IN_STATE.push(jQuery(this).val());
			});
			var EMP_HAV_TEAM_IN_MULT = jQuery('input[name="EMP_HAV_TEAM_IN_MULT"]:checked').val();
			var EMP_JOB_POSTNG_METH=[];
			jQuery('input[name="EMP_JOB_POSTNG_METH[]"]:checked').each(function(i){
				EMP_JOB_POSTNG_METH.push(jQuery(this).val());
			});

			//step 10
			var EMP_R_INTRNSIP_AVBL = jQuery('input[name="EMP_R_INTRNSIP_AVBL"]:checked').val();
			var EMP_UNI_PRG_INT_LOC = jQuery('textarea[name="EMP_UNI_PRG_INT_LOC"]').val();

			//step 11
			var EMP_WHAT_IS_MOR_IMP = jQuery('input[name="EMP_WHAT_IS_MOR_IMP"]:checked').val();

			//step 12
			var EMP_ANUAL_EXP_ON_VEN = jQuery('textarea[name="EMP_ANUAL_EXP_ON_VEN"]').val();
			var EMP_ANUAL_EXP_VEN = jQuery('input[name="EMP_ANUAL_EXP_VEN"]:checked').val();

			//step 13
			var EMP_CNY_SPND_ON_JOB = jQuery('input[name="EMP_CNY_SPND_ON_JOB"]:checked').val();
			var EMP_INTRNT_JOB_BOARD = jQuery('textarea[name="EMP_INTRNT_JOB_BOARD"]').val();
			var EMP_PPR_BSE_BULL_BOA = jQuery('textarea[name="EMP_PPR_BSE_BULL_BOA"]').val();
			var EMP_KIOSKS_DESC = jQuery('textarea[name="EMP_KIOSKS_DESC"]').val();

			//step 14
			var EMP_HOW_MNY_RES_DESC = jQuery('textarea[name="EMP_HOW_MNY_RES_DESC"]').val();
			var EMP_HOW_MNY_RES = jQuery('input[name="EMP_HOW_MNY_RES"]:checked').val();

			//step 15
			var EMP_HOW_MNY_FUL_TM_D = jQuery('textarea[name="EMP_HOW_MNY_FUL_TM_D"]').val();
			var EMP_HOW_MNY_FUL_TM = jQuery('input[name="EMP_HOW_MNY_FUL_TM"]:checked').val();

			//step 16
			var EMP_WHT_AVG_BURD_DES = jQuery('textarea[name="EMP_WHT_AVG_BURD_DES"]').val();
			var EMP_WHT_AVG_BURD = jQuery('input[name="EMP_WHT_AVG_BURD"]:checked').val();

			//step 17
			var EMP_PER_RES_RVD = jQuery('input[name="EMP_PER_RES_RVD"]:checked').val();
			var EMP_UNSOLICITED_MAIL = jQuery('textarea[name="EMP_UNSOLICITED_MAIL"]').val();
			var EMP_REQ_PRINT_ADDS = jQuery('textarea[name="EMP_REQ_PRINT_ADDS"]').val();
			var EMP_OUT_STAFF_FIRMS = jQuery('textarea[name="EMP_OUT_STAFF_FIRMS"]').val();
			var EMP_JOB_FAIRS_SELECT = jQuery('textarea[name="EMP_JOB_FAIRS_SELECT"]').val();
			var EMP_CAMPUS_RECRUIT = jQuery('textarea[name="EMP_CAMPUS_RECRUIT"]').val();
			var EMP_INT_AD_N_POST_BO = jQuery('textarea[name="EMP_INT_AD_N_POST_BO"]').val();
			var EMP_EMPLOYE_REFERRAL = jQuery('textarea[name="EMP_EMPLOYE_REFERRAL"]').val();

			//step 18
			var EMP_OF_THE_RES_RVD = jQuery('input[name="EMP_OF_THE_RES_RVD"]:checked').val();
			var EMP_PPR_FORM_FAX = jQuery('textarea[name="EMP_PPR_FORM_FAX"]').val();
			var EMP_THRU_ONLINE_APPS = jQuery('textarea[name="EMP_THRU_ONLINE_APPS"]').val();
			var EMP_THRU_CORP_EMAIL = jQuery('textarea[name="EMP_THRU_CORP_EMAIL"]').val();
			var EMP_MAGZNS_PERIODIC = jQuery('textarea[name="EMP_MAGZNS_PERIODIC"]').val();

			//step 19
			var EMP_CNY_ACPT_INT_CAN = jQuery('input[name="EMP_CNY_ACPT_INT_CAN"]:checked').val();
			var EMP_INT_WHT_ANL_CT_D = jQuery('textarea[name="EMP_INT_WHT_ANL_CT_D"]').val();
			var EMP_INT_WHT_ANL_CT = jQuery('input[name="EMP_INT_WHT_ANL_CT"]:checked').val();

			//step 21
			var EMP_HOW_HEAR_ABT_EYE=[];
			jQuery('input[name="EMP_HOW_HEAR_ABT_EYE[]"]:checked').each(function(i){
				EMP_HOW_HEAR_ABT_EYE.push(jQuery(this).val());
			});
			var EMP_HW_HR_ABT_EYE_D = jQuery('input[name="EMP_HW_HR_ABT_EYE_D"]').val();

			//step 22
			var EMP_WHT_RES_IF_ANY = jQuery('textarea[name="EMP_WHT_RES_IF_ANY"]').val();

			jQuery.ajax({
				url:'<?php echo admin_url("admin-ajax.php"); ?>',
				method:'POST',
				data:{
					action:'employee_profile_builder_ques_saved',
					//rec_id: rec_id,
					EMP_YR_POS_IN_ORGN : EMP_YR_POS_IN_ORGN,
					EMP_NO_EMP_ON_TEAM : EMP_NO_EMP_ON_TEAM,
					EMP_AREA_TO_B_SEARCH : EMP_AREA_TO_B_SEARCH,
					EMP_STATES_OF_US : EMP_STATES_OF_US,
					EMP_INDUS_REF_SRVICE : EMP_INDUS_REF_SRVICE,
					EMP_CMPNY_LIS_INFO : EMP_CMPNY_LIS_INFO,
					EMP_WUD_RELOC_SUGGES : EMP_WUD_RELOC_SUGGES,
					EMP_CPY_REL_INCN_DES : EMP_CPY_REL_INCN_DES,
					EMP_CPY_REL_INCN : EMP_CPY_REL_INCN,
					EMP_CMNY_ALLOC_ANUAL : EMP_CMNY_ALLOC_ANUAL,
					EMP_CMNY_ALLOC_UNON : EMP_CMNY_ALLOC_UNON,
					EMP_OFER_SIGNING_BON : EMP_OFER_SIGNING_BON,
					EMP_CPNY_SIG_BON_DES : EMP_CPNY_SIG_BON_DES,
					EMP_CPNY_SIG_BON : EMP_CPNY_SIG_BON,
					EMP_ORG_UNQ_FR_EMP_D : EMP_ORG_UNQ_FR_EMP_D,
					EMP_ORG_UNQ_FR_EMP : EMP_ORG_UNQ_FR_EMP,
					EMP_TEAM_IN_MULTILOC : EMP_TEAM_IN_MULTILOC,
					EMP_OFFICES_IN_STATE : EMP_OFFICES_IN_STATE,
					EMP_HAV_TEAM_IN_MULT : EMP_HAV_TEAM_IN_MULT,
					EMP_JOB_POSTNG_METH : EMP_JOB_POSTNG_METH,
					EMP_R_INTRNSIP_AVBL : EMP_R_INTRNSIP_AVBL,
					EMP_UNI_PRG_INT_LOC : EMP_UNI_PRG_INT_LOC,
					EMP_WHAT_IS_MOR_IMP : EMP_WHAT_IS_MOR_IMP,
					EMP_ANUAL_EXP_ON_VEN : EMP_ANUAL_EXP_ON_VEN,
					EMP_ANUAL_EXP_VEN : EMP_ANUAL_EXP_VEN,
					EMP_CNY_SPND_ON_JOB : EMP_CNY_SPND_ON_JOB,
					EMP_INTRNT_JOB_BOARD : EMP_INTRNT_JOB_BOARD,
					EMP_PPR_BSE_BULL_BOA : EMP_PPR_BSE_BULL_BOA,
					EMP_KIOSKS_DESC : EMP_KIOSKS_DESC,
					EMP_HOW_MNY_RES_DESC : EMP_HOW_MNY_RES_DESC,
					EMP_HOW_MNY_RES : EMP_HOW_MNY_RES,
					EMP_HOW_MNY_FUL_TM_D : EMP_HOW_MNY_FUL_TM_D,
					EMP_HOW_MNY_FUL_TM : EMP_HOW_MNY_FUL_TM,
					EMP_WHT_AVG_BURD_DES : EMP_WHT_AVG_BURD_DES,
					EMP_WHT_AVG_BURD : EMP_WHT_AVG_BURD,
					EMP_PER_RES_RVD : EMP_PER_RES_RVD,
					EMP_UNSOLICITED_MAIL : EMP_UNSOLICITED_MAIL,
					EMP_REQ_PRINT_ADDS : EMP_REQ_PRINT_ADDS,
					EMP_OUT_STAFF_FIRMS : EMP_OUT_STAFF_FIRMS,
					EMP_JOB_FAIRS_SELECT : EMP_JOB_FAIRS_SELECT,
					EMP_CAMPUS_RECRUIT : EMP_CAMPUS_RECRUIT,
					EMP_INT_AD_N_POST_BO : EMP_INT_AD_N_POST_BO,
					EMP_EMPLOYE_REFERRAL : EMP_EMPLOYE_REFERRAL,
					EMP_OF_THE_RES_RVD : EMP_OF_THE_RES_RVD,
					EMP_PPR_FORM_FAX : EMP_PPR_FORM_FAX,
					EMP_THRU_ONLINE_APPS : EMP_THRU_ONLINE_APPS,
					EMP_THRU_CORP_EMAIL : EMP_THRU_CORP_EMAIL,
					EMP_MAGZNS_PERIODIC : EMP_MAGZNS_PERIODIC,
					EMP_CNY_ACPT_INT_CAN : EMP_CNY_ACPT_INT_CAN,
					EMP_INT_WHT_ANL_CT_D : EMP_INT_WHT_ANL_CT_D,
					EMP_INT_WHT_ANL_CT : EMP_INT_WHT_ANL_CT,
					EMP_HOW_HEAR_ABT_EYE : EMP_HOW_HEAR_ABT_EYE,
					EMP_WHT_RES_IF_ANY : EMP_WHT_RES_IF_ANY,
					EMP_HW_HR_ABT_EYE_D : EMP_HW_HR_ABT_EYE_D
				},
				success:function(r){	
				}
			});
			
			if(jQuery(this).attr('data-current')==7098){
				var _this = jQuery(this);
				_this.text('Please Wait...')
				_this.attr('disabled', 'disabled');
				jQuery.ajax({
					url:'<?php echo admin_url("admin-ajax.php"); ?>',
					method:'POST',
					data:{
						action:'employee_login_after_ques_saved',
						rec_id:rec_id
					},
					success: function(r){
						_this.text('Thank you for Choosing EyeRecruit!')
						_this.attr('disabled', 'disabled');
						window.location = "<?php echo site_url('/employer-dashboard/'); ?>";
					}
				});
			}

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
			var currentid 		= _this.data("current");
			var nextid 			= _this.data("next");
			window.location.hash = btoa(nextid);
		});
});
</script>