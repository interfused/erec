<?php 
/* ajax result to invite friends and colleages */
add_action('wp_ajax_employer_basic_information_saved', 'employer_basic_information_saved');
add_action('wp_ajax_nopriv_employer_basic_information_saved', 'employer_basic_information_saved');

function employer_basic_information_saved(){
	$current_user_id = get_current_user_id();
	if(isset($_POST)){

		$EMP_YR_POS_IN_ORGN = $_POST['EMP_YR_POS_IN_ORGN'];
		$EMP_YR_POS_IN_ORGN = implode(',', $EMP_YR_POS_IN_ORGN);
		set_cimyFieldValue($current_user_id, 'EMP_YR_POS_IN_ORGN', $EMP_YR_POS_IN_ORGN);
		

		$EMP_NO_EMP_ON_TEAM = $_POST['EMP_NO_EMP_ON_TEAM'];
		set_cimyFieldValue($current_user_id, 'EMP_NO_EMP_ON_TEAM', $EMP_NO_EMP_ON_TEAM);

		$EMP_EXPERIENCE = $_POST['EMP_EXPERIENCE'];
		set_cimyFieldValue($current_user_id, 'EMP_EXPERIENCE', $EMP_EXPERIENCE);
		
		$EMP_AREA_TO_B_SEARCH = $_POST['EMP_AREA_TO_B_SEARCH'];
		set_cimyFieldValue($current_user_id, 'EMP_AREA_TO_B_SEARCH', $EMP_AREA_TO_B_SEARCH);

		$EMP_STATES_OF_US = $_POST['EMP_STATES_OF_US'];
		set_cimyFieldValue($current_user_id, 'EMP_STATES_OF_US', $EMP_STATES_OF_US);
		
		$EMP_INDUS_REF_SRVICE = $_POST['EMP_INDUS_REF_SRVICE'];
		$EMP_INDUS_REF_SRVICE = implode(',', $EMP_INDUS_REF_SRVICE);
		set_cimyFieldValue($current_user_id, 'EMP_INDUS_REF_SRVICE', $EMP_INDUS_REF_SRVICE);
		

		$EMP_CMPNY_LIS_INFO = $_POST['EMP_CMPNY_LIS_INFO'];
		set_cimyFieldValue($current_user_id, 'EMP_CMPNY_LIS_INFO', $EMP_CMPNY_LIS_INFO);
		
		$EMP_WUD_RELOC_SUGGES = $_POST['EMP_WUD_RELOC_SUGGES'];
		set_cimyFieldValue($current_user_id, 'EMP_WUD_RELOC_SUGGES', $EMP_WUD_RELOC_SUGGES);

		$EMP_CPY_REL_INCN_DES = $_POST['EMP_CPY_REL_INCN_DES'];
		set_cimyFieldValue($current_user_id, 'EMP_CPY_REL_INCN_DES', $EMP_CPY_REL_INCN_DES);

		$EMP_CPY_REL_INCN = $_POST['EMP_CPY_REL_INCN'];
		set_cimyFieldValue($current_user_id, 'EMP_CPY_REL_INCN', $EMP_CPY_REL_INCN);

		$EMP_CMNY_ALLOC_ANUAL = $_POST['EMP_CMNY_ALLOC_ANUAL'];
		set_cimyFieldValue($current_user_id, 'EMP_CMNY_ALLOC_ANUAL', $EMP_CMNY_ALLOC_ANUAL);

		$EMP_CMNY_ALLOC_UNON = $_POST['EMP_CMNY_ALLOC_UNON'];
		set_cimyFieldValue($current_user_id, 'EMP_CMNY_ALLOC_UNON', $EMP_CMNY_ALLOC_UNON);

		$EMP_OFER_SIGNING_BON = $_POST['EMP_OFER_SIGNING_BON'];
		set_cimyFieldValue($current_user_id, 'EMP_OFER_SIGNING_BON', $EMP_OFER_SIGNING_BON);

		$EMP_CPNY_SIG_BON_DES = $_POST['EMP_CPNY_SIG_BON_DES'];
		set_cimyFieldValue($current_user_id, 'EMP_CPNY_SIG_BON_DES', $EMP_CPNY_SIG_BON_DES);

		$EMP_CPNY_SIG_BON = $_POST['EMP_CPNY_SIG_BON'];
		set_cimyFieldValue($current_user_id, 'EMP_CPNY_SIG_BON', $EMP_CPNY_SIG_BON);

		$EMP_ORG_UNQ_FR_EMP_D = $_POST['EMP_ORG_UNQ_FR_EMP_D'];
		set_cimyFieldValue($current_user_id, 'EMP_ORG_UNQ_FR_EMP_D', $EMP_ORG_UNQ_FR_EMP_D);

		$EMP_ORG_UNQ_FR_EMP = $_POST['EMP_ORG_UNQ_FR_EMP'];
		set_cimyFieldValue($current_user_id, 'EMP_ORG_UNQ_FR_EMP', $EMP_ORG_UNQ_FR_EMP);

		$EMP_TEAM_IN_MULTILOC = $_POST['EMP_TEAM_IN_MULTILOC'];
		set_cimyFieldValue($current_user_id, 'EMP_TEAM_IN_MULTILOC', $EMP_TEAM_IN_MULTILOC);

		$EMP_OFFICES_IN_STATE = $_POST['EMP_OFFICES_IN_STATE'];
		$EMP_OFFICES_IN_STATE = implode(',', $EMP_OFFICES_IN_STATE);
		set_cimyFieldValue($current_user_id, 'EMP_OFFICES_IN_STATE', $EMP_OFFICES_IN_STATE);

		$EMP_HAV_TEAM_IN_MULT = $_POST['EMP_HAV_TEAM_IN_MULT'];
		set_cimyFieldValue($current_user_id, 'EMP_HAV_TEAM_IN_MULT', $EMP_HAV_TEAM_IN_MULT);

		$EMP_JOB_POSTNG_METH = $_POST['EMP_JOB_POSTNG_METH'];
		$EMP_JOB_POSTNG_METH = implode(',', $EMP_JOB_POSTNG_METH);
		set_cimyFieldValue($current_user_id, 'EMP_JOB_POSTNG_METH', $EMP_JOB_POSTNG_METH);

		$EMP_R_INTRNSIP_AVBL = $_POST['EMP_R_INTRNSIP_AVBL'];
		set_cimyFieldValue($current_user_id, 'EMP_R_INTRNSIP_AVBL', $EMP_R_INTRNSIP_AVBL);

		$EMP_UNI_PRG_INT_LOC = $_POST['EMP_UNI_PRG_INT_LOC'];
		set_cimyFieldValue($current_user_id, 'EMP_UNI_PRG_INT_LOC', $EMP_UNI_PRG_INT_LOC);

		$EMP_WHAT_IS_MOR_IMP = $_POST['EMP_WHAT_IS_MOR_IMP'];
		set_cimyFieldValue($current_user_id, 'EMP_WHAT_IS_MOR_IMP', $EMP_WHAT_IS_MOR_IMP);

		$EMP_ANUAL_EXP_ON_VEN = $_POST['EMP_ANUAL_EXP_ON_VEN'];
		set_cimyFieldValue($current_user_id, 'EMP_ANUAL_EXP_ON_VEN', $EMP_ANUAL_EXP_ON_VEN);

		$EMP_ANUAL_EXP_VEN = $_POST['EMP_ANUAL_EXP_VEN'];
		set_cimyFieldValue($current_user_id, 'EMP_ANUAL_EXP_VEN', $EMP_ANUAL_EXP_VEN);

		$EMP_CNY_SPND_ON_JOB = $_POST['EMP_CNY_SPND_ON_JOB'];
		set_cimyFieldValue($current_user_id, 'EMP_CNY_SPND_ON_JOB', $EMP_CNY_SPND_ON_JOB);

		$EMP_INTRNT_JOB_BOARD = $_POST['EMP_INTRNT_JOB_BOARD'];
		set_cimyFieldValue($current_user_id, 'EMP_INTRNT_JOB_BOARD', $EMP_INTRNT_JOB_BOARD);

		$EMP_PPR_BSE_BULL_BOA = $_POST['EMP_PPR_BSE_BULL_BOA'];
		set_cimyFieldValue($current_user_id, 'EMP_PPR_BSE_BULL_BOA', $EMP_PPR_BSE_BULL_BOA);

		$EMP_KIOSKS_DESC = $_POST['EMP_KIOSKS_DESC'];
		set_cimyFieldValue($current_user_id, 'EMP_KIOSKS_DESC', $EMP_KIOSKS_DESC);

		$EMP_HOW_MNY_RES_DESC = $_POST['EMP_HOW_MNY_RES_DESC'];
		set_cimyFieldValue($current_user_id, 'EMP_HOW_MNY_RES_DESC', $EMP_HOW_MNY_RES_DESC);

		$EMP_HOW_MNY_RES = $_POST['EMP_HOW_MNY_RES'];
		set_cimyFieldValue($current_user_id, 'EMP_HOW_MNY_RES', $EMP_HOW_MNY_RES);

		$EMP_HOW_MNY_FUL_TM_D = $_POST['EMP_HOW_MNY_FUL_TM_D'];
		set_cimyFieldValue($current_user_id, 'EMP_HOW_MNY_FUL_TM_D', $EMP_HOW_MNY_FUL_TM_D);

		$EMP_HOW_MNY_FUL_TM = $_POST['EMP_HOW_MNY_FUL_TM'];
		set_cimyFieldValue($current_user_id, 'EMP_HOW_MNY_FUL_TM', $EMP_HOW_MNY_FUL_TM);

		$EMP_WHT_AVG_BURD_DES = $_POST['EMP_WHT_AVG_BURD_DES'];
		set_cimyFieldValue($current_user_id, 'EMP_WHT_AVG_BURD_DES', $EMP_WHT_AVG_BURD_DES);

		$EMP_WHT_AVG_BURD = $_POST['EMP_WHT_AVG_BURD'];
		set_cimyFieldValue($current_user_id, 'EMP_WHT_AVG_BURD', $EMP_WHT_AVG_BURD);

		$EMP_PER_RES_RVD = $_POST['EMP_PER_RES_RVD'];
		set_cimyFieldValue($current_user_id, 'EMP_PER_RES_RVD', $EMP_PER_RES_RVD);

		$EMP_UNSOLICITED_MAIL = $_POST['EMP_UNSOLICITED_MAIL'];
		set_cimyFieldValue($current_user_id, 'EMP_UNSOLICITED_MAIL', $EMP_UNSOLICITED_MAIL);

		$EMP_REQ_PRINT_ADDS = $_POST['EMP_REQ_PRINT_ADDS'];
		set_cimyFieldValue($current_user_id, 'EMP_REQ_PRINT_ADDS', $EMP_REQ_PRINT_ADDS);

		$EMP_OUT_STAFF_FIRMS = $_POST['EMP_OUT_STAFF_FIRMS'];
		set_cimyFieldValue($current_user_id, 'EMP_OUT_STAFF_FIRMS', $EMP_OUT_STAFF_FIRMS);

		$EMP_JOB_FAIRS_SELECT = $_POST['EMP_JOB_FAIRS_SELECT'];
		set_cimyFieldValue($current_user_id, 'EMP_JOB_FAIRS_SELECT', $EMP_JOB_FAIRS_SELECT);

		$EMP_CAMPUS_RECRUIT = $_POST['EMP_CAMPUS_RECRUIT'];
		set_cimyFieldValue($current_user_id, 'EMP_CAMPUS_RECRUIT', $EMP_CAMPUS_RECRUIT);

		$EMP_INT_AD_N_POST_BO = $_POST['EMP_INT_AD_N_POST_BO'];
		set_cimyFieldValue($current_user_id, 'EMP_INT_AD_N_POST_BO', $EMP_INT_AD_N_POST_BO);

		$EMP_EMPLOYE_REFERRAL = $_POST['EMP_EMPLOYE_REFERRAL'];
		set_cimyFieldValue($current_user_id, 'EMP_EMPLOYE_REFERRAL', $EMP_EMPLOYE_REFERRAL);

		$EMP_OF_THE_RES_RVD = $_POST['EMP_OF_THE_RES_RVD'];
		set_cimyFieldValue($current_user_id, 'EMP_OF_THE_RES_RVD', $EMP_OF_THE_RES_RVD);

		$EMP_PPR_FORM_FAX = $_POST['EMP_PPR_FORM_FAX'];
		set_cimyFieldValue($current_user_id, 'EMP_PPR_FORM_FAX', $EMP_PPR_FORM_FAX);

		$EMP_THRU_ONLINE_APPS = $_POST['EMP_THRU_ONLINE_APPS'];
		set_cimyFieldValue($current_user_id, 'EMP_THRU_ONLINE_APPS', $EMP_THRU_ONLINE_APPS);

		$EMP_THRU_CORP_EMAIL = $_POST['EMP_THRU_CORP_EMAIL'];
		set_cimyFieldValue($current_user_id, 'EMP_THRU_CORP_EMAIL', $EMP_THRU_CORP_EMAIL);

		$EMP_MAGZNS_PERIODIC = $_POST['EMP_MAGZNS_PERIODIC'];
		set_cimyFieldValue($current_user_id, 'EMP_MAGZNS_PERIODIC', $EMP_MAGZNS_PERIODIC);

		$company_name = $_POST['company_name'];
		update_user_meta($current_user_id, 'company', $company_name);

		$EMP_CNY_ACPT_INT_CAN = $_POST['EMP_CNY_ACPT_INT_CAN'];
		set_cimyFieldValue($current_user_id, 'EMP_CNY_ACPT_INT_CAN', $EMP_CNY_ACPT_INT_CAN);

		$EMP_INT_WHT_ANL_CT_D = $_POST['EMP_INT_WHT_ANL_CT_D'];
		set_cimyFieldValue($current_user_id, 'EMP_INT_WHT_ANL_CT_D', $EMP_INT_WHT_ANL_CT_D);

		$EMP_INT_WHT_ANL_CT = $_POST['EMP_INT_WHT_ANL_CT'];
		set_cimyFieldValue($current_user_id, 'EMP_INT_WHT_ANL_CT', $EMP_INT_WHT_ANL_CT);

		$EMP_HOW_HEAR_ABT_EYE = $_POST['EMP_HOW_HEAR_ABT_EYE'];
		$EMP_HOW_HEAR_ABT_EYE_db_value = get_cimyFieldValue($current_user_id, 'EMP_HOW_HEAR_ABT_EYE');
		$EMP_HOW_HEAR_ABT_EYE = implode(',', $EMP_HOW_HEAR_ABT_EYE);	
		set_cimyFieldValue($current_user_id, 'EMP_HOW_HEAR_ABT_EYE', $EMP_HOW_HEAR_ABT_EYE);
		

		$EMP_WHT_RES_IF_ANY = $_POST['EMP_WHT_RES_IF_ANY'];
		set_cimyFieldValue($current_user_id, 'EMP_WHT_RES_IF_ANY', $EMP_WHT_RES_IF_ANY);

		$EMP_HW_HR_ABT_EYE_D = $_POST['EMP_HW_HR_ABT_EYE_D'];
		set_cimyFieldValue($current_user_id, 'EMP_HW_HR_ABT_EYE_D', $EMP_HW_HR_ABT_EYE_D);
	}
	die();
}