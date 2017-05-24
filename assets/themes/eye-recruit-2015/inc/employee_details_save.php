<?php 
/* ajax result to invite friends and colleages */
add_action('wp_ajax_employee_profile_builder_ques_saved', 'employee_profile_builder_ques_saved');
add_action('wp_ajax_nopriv_employee_profile_builder_ques_saved', 'employee_profile_builder_ques_saved');

function employee_profile_builder_ques_saved(){
	$current_user_id = multi_base64_decode($_REQUEST['rec']);
	if(isset($_POST['EMP_YR_POS_IN_ORGN']) && !empty($_POST['EMP_YR_POS_IN_ORGN'])){
		$EMP_YR_POS_IN_ORGN = implode(",", $_POST['EMP_YR_POS_IN_ORGN']);
		set_cimyFieldValue($current_user_id, 'EMP_YR_POS_IN_ORGN', $EMP_YR_POS_IN_ORGN);
	}
	if(isset($_POST['EMP_NO_EMP_ON_TEAM']) && !empty($_POST['EMP_NO_EMP_ON_TEAM'])){
		$EMP_NO_EMP_ON_TEAM = $_POST['EMP_NO_EMP_ON_TEAM'];
		set_cimyFieldValue($current_user_id, 'EMP_NO_EMP_ON_TEAM', $EMP_NO_EMP_ON_TEAM);
	}
	if(isset($_POST['EMP_AREA_TO_B_SEARCH']) && !empty($_POST['EMP_AREA_TO_B_SEARCH'])){
		$EMP_AREA_TO_B_SEARCH = $_POST['EMP_AREA_TO_B_SEARCH'];
		set_cimyFieldValue($current_user_id, 'EMP_AREA_TO_B_SEARCH', $EMP_AREA_TO_B_SEARCH);
	}
	if(isset($_POST['EMP_STATES_OF_US']) && !empty($_POST['EMP_STATES_OF_US'])){
		$EMP_STATES_OF_US = $_POST['EMP_STATES_OF_US'];
		set_cimyFieldValue($current_user_id, 'EMP_STATES_OF_US', $EMP_STATES_OF_US);
	}
	if(isset($_POST['EMP_INDUS_REF_SRVICE']) && !empty($_POST['EMP_INDUS_REF_SRVICE'])){
		$EMP_INDUS_REF_SRVICE = implode(",", $_POST['EMP_INDUS_REF_SRVICE']);
		set_cimyFieldValue($current_user_id, 'EMP_INDUS_REF_SRVICE', $EMP_INDUS_REF_SRVICE);
	}
	if(isset($_POST['EMP_CMPNY_LIS_INFO']) && !empty($_POST['EMP_CMPNY_LIS_INFO'])){
		$EMP_CMPNY_LIS_INFO = $_POST['EMP_CMPNY_LIS_INFO'];
		set_cimyFieldValue($current_user_id, 'EMP_CMPNY_LIS_INFO', $EMP_CMPNY_LIS_INFO);
	}
	if(isset($_POST['EMP_WUD_RELOC_SUGGES']) && !empty($_POST['EMP_WUD_RELOC_SUGGES'])){
		$EMP_WUD_RELOC_SUGGES = $_POST['EMP_WUD_RELOC_SUGGES'];
		set_cimyFieldValue($current_user_id, 'EMP_WUD_RELOC_SUGGES', $EMP_WUD_RELOC_SUGGES);
	}
	if(isset($_POST['EMP_CPY_REL_INCN_DES']) && !empty($_POST['EMP_CPY_REL_INCN_DES'])){
		$EMP_CPY_REL_INCN_DES = $_POST['EMP_CPY_REL_INCN_DES'];
		set_cimyFieldValue($current_user_id, 'EMP_CPY_REL_INCN_DES', $EMP_CPY_REL_INCN_DES);
	}
	if(isset($_POST['EMP_CPY_REL_INCN']) && !empty($_POST['EMP_CPY_REL_INCN'])){
		$EMP_CPY_REL_INCN = $_POST['EMP_CPY_REL_INCN'];
		set_cimyFieldValue($current_user_id, 'EMP_CPY_REL_INCN', $EMP_CPY_REL_INCN);
	}
	if(isset($_POST['EMP_CMNY_ALLOC_ANUAL']) && !empty($_POST['EMP_CMNY_ALLOC_ANUAL'])){
		$EMP_CMNY_ALLOC_ANUAL = $_POST['EMP_CMNY_ALLOC_ANUAL'];
		set_cimyFieldValue($current_user_id, 'EMP_CMNY_ALLOC_ANUAL', $EMP_CMNY_ALLOC_ANUAL);
	}
	if(isset($_POST['EMP_CMNY_ALLOC_UNON']) && !empty($_POST['EMP_CMNY_ALLOC_UNON'])){
		$EMP_CMNY_ALLOC_UNON = $_POST['EMP_CMNY_ALLOC_UNON'];
		set_cimyFieldValue($current_user_id, 'EMP_CMNY_ALLOC_UNON', $EMP_CMNY_ALLOC_UNON);
	}
	if(isset($_POST['EMP_OFER_SIGNING_BON']) && !empty($_POST['EMP_OFER_SIGNING_BON'])){
		$EMP_OFER_SIGNING_BON = $_POST['EMP_OFER_SIGNING_BON'];
		set_cimyFieldValue($current_user_id, 'EMP_OFER_SIGNING_BON', $EMP_OFER_SIGNING_BON);
	}
	if(isset($_POST['EMP_CPNY_SIG_BON_DES']) && !empty($_POST['EMP_CPNY_SIG_BON_DES'])){
		$EMP_CPNY_SIG_BON_DES = $_POST['EMP_CPNY_SIG_BON_DES'];
		set_cimyFieldValue($current_user_id, 'EMP_CPNY_SIG_BON_DES', $EMP_CPNY_SIG_BON_DES);
	}
	if(isset($_POST['EMP_CPNY_SIG_BON']) && !empty($_POST['EMP_CPNY_SIG_BON'])){
		$EMP_CPNY_SIG_BON = $_POST['EMP_CPNY_SIG_BON'];
		set_cimyFieldValue($current_user_id, 'EMP_CPNY_SIG_BON', $EMP_CPNY_SIG_BON);
	}
	if(isset($_POST['EMP_ORG_UNQ_FR_EMP_D']) && !empty($_POST['EMP_ORG_UNQ_FR_EMP_D'])){
		$EMP_ORG_UNQ_FR_EMP_D = $_POST['EMP_ORG_UNQ_FR_EMP_D'];
		set_cimyFieldValue($current_user_id, 'EMP_ORG_UNQ_FR_EMP_D', $EMP_ORG_UNQ_FR_EMP_D);
	}
	if(isset($_POST['EMP_ORG_UNQ_FR_EMP']) && !empty($_POST['EMP_ORG_UNQ_FR_EMP'])){
		$EMP_ORG_UNQ_FR_EMP = $_POST['EMP_ORG_UNQ_FR_EMP'];
		set_cimyFieldValue($current_user_id, 'EMP_ORG_UNQ_FR_EMP', $EMP_ORG_UNQ_FR_EMP);
	}
	if(isset($_POST['EMP_TEAM_IN_MULTILOC']) && !empty($_POST['EMP_TEAM_IN_MULTILOC'])){
		$EMP_TEAM_IN_MULTILOC = $_POST['EMP_TEAM_IN_MULTILOC'];
		set_cimyFieldValue($current_user_id, 'EMP_TEAM_IN_MULTILOC', $EMP_TEAM_IN_MULTILOC);
	}
	if(isset($_POST['EMP_OFFICES_IN_STATE']) && !empty($_POST['EMP_OFFICES_IN_STATE'])){
		$EMP_OFFICES_IN_STATE = implode(',', $_POST['EMP_OFFICES_IN_STATE']);
		set_cimyFieldValue($current_user_id, 'EMP_OFFICES_IN_STATE', $EMP_OFFICES_IN_STATE);
	}
	if(isset($_POST['EMP_HAV_TEAM_IN_MULT']) && !empty($_POST['EMP_HAV_TEAM_IN_MULT'])){
		$EMP_HAV_TEAM_IN_MULT = $_POST['EMP_HAV_TEAM_IN_MULT'];
		set_cimyFieldValue($current_user_id, 'EMP_HAV_TEAM_IN_MULT', $EMP_HAV_TEAM_IN_MULT);
	}
	if(isset($_POST['EMP_JOB_POSTNG_METH']) && !empty($_POST['EMP_JOB_POSTNG_METH'])){
		$EMP_JOB_POSTNG_METH = implode(',', $_POST['EMP_JOB_POSTNG_METH']);
		set_cimyFieldValue($current_user_id, 'EMP_JOB_POSTNG_METH', $EMP_JOB_POSTNG_METH);
	}
	if(isset($_POST['EMP_R_INTRNSIP_AVBL']) && !empty($_POST['EMP_R_INTRNSIP_AVBL'])){
		$EMP_R_INTRNSIP_AVBL = $_POST['EMP_R_INTRNSIP_AVBL'];
		set_cimyFieldValue($current_user_id, 'EMP_R_INTRNSIP_AVBL', $EMP_R_INTRNSIP_AVBL);
	}
	if(isset($_POST['EMP_UNI_PRG_INT_LOC']) && !empty($_POST['EMP_UNI_PRG_INT_LOC'])){
		$EMP_UNI_PRG_INT_LOC = $_POST['EMP_UNI_PRG_INT_LOC'];
		set_cimyFieldValue($current_user_id, 'EMP_UNI_PRG_INT_LOC', $EMP_UNI_PRG_INT_LOC);
	}
	if(isset($_POST['EMP_WHAT_IS_MOR_IMP']) && !empty($_POST['EMP_WHAT_IS_MOR_IMP'])){
		$EMP_WHAT_IS_MOR_IMP = $_POST['EMP_WHAT_IS_MOR_IMP'];
		set_cimyFieldValue($current_user_id, 'EMP_WHAT_IS_MOR_IMP', $EMP_WHAT_IS_MOR_IMP);
	}
	if(isset($_POST['EMP_ANUAL_EXP_ON_VEN']) && !empty($_POST['EMP_ANUAL_EXP_ON_VEN'])){
		$EMP_ANUAL_EXP_ON_VEN = $_POST['EMP_ANUAL_EXP_ON_VEN'];
		set_cimyFieldValue($current_user_id, 'EMP_ANUAL_EXP_ON_VEN', $EMP_ANUAL_EXP_ON_VEN);
	}
	if(isset($_POST['EMP_ANUAL_EXP_VEN']) && !empty($_POST['EMP_ANUAL_EXP_VEN'])){
		$EMP_ANUAL_EXP_VEN = $_POST['EMP_ANUAL_EXP_VEN'];
		set_cimyFieldValue($current_user_id, 'EMP_ANUAL_EXP_VEN', $EMP_ANUAL_EXP_VEN);
	}
	if(isset($_POST['EMP_CNY_SPND_ON_JOB']) && !empty($_POST['EMP_CNY_SPND_ON_JOB'])){
		$EMP_CNY_SPND_ON_JOB = $_POST['EMP_CNY_SPND_ON_JOB'];
		set_cimyFieldValue($current_user_id, 'EMP_CNY_SPND_ON_JOB', $EMP_CNY_SPND_ON_JOB);
	}
	if(isset($_POST['EMP_INTRNT_JOB_BOARD']) && !empty($_POST['EMP_INTRNT_JOB_BOARD'])){
		$EMP_INTRNT_JOB_BOARD = $_POST['EMP_INTRNT_JOB_BOARD'];
		set_cimyFieldValue($current_user_id, 'EMP_INTRNT_JOB_BOARD', $EMP_INTRNT_JOB_BOARD);
	}
	if(isset($_POST['EMP_PPR_BSE_BULL_BOA']) && !empty($_POST['EMP_PPR_BSE_BULL_BOA'])){
		$EMP_PPR_BSE_BULL_BOA = $_POST['EMP_PPR_BSE_BULL_BOA'];
		set_cimyFieldValue($current_user_id, 'EMP_PPR_BSE_BULL_BOA', $EMP_PPR_BSE_BULL_BOA);
	}
	if(isset($_POST['EMP_KIOSKS_DESC']) && !empty($_POST['EMP_KIOSKS_DESC'])){
		$EMP_KIOSKS_DESC = $_POST['EMP_KIOSKS_DESC'];
		set_cimyFieldValue($current_user_id, 'EMP_KIOSKS_DESC', $EMP_KIOSKS_DESC);
	} 
	if(isset($_POST['EMP_HOW_MNY_RES_DESC']) && !empty($_POST['EMP_HOW_MNY_RES_DESC'])){
		$EMP_HOW_MNY_RES_DESC = $_POST['EMP_HOW_MNY_RES_DESC'];
		set_cimyFieldValue($current_user_id, 'EMP_HOW_MNY_RES_DESC', $EMP_HOW_MNY_RES_DESC);
	}
	if(isset($_POST['EMP_HOW_MNY_RES']) && !empty($_POST['EMP_HOW_MNY_RES'])){
		$EMP_HOW_MNY_RES = $_POST['EMP_HOW_MNY_RES'];
		set_cimyFieldValue($current_user_id, 'EMP_HOW_MNY_RES', $EMP_HOW_MNY_RES);
	}
	if(isset($_POST['EMP_HOW_MNY_FUL_TM_D']) && !empty($_POST['EMP_HOW_MNY_FUL_TM_D'])){
		$EMP_HOW_MNY_FUL_TM_D = $_POST['EMP_HOW_MNY_FUL_TM_D'];
		set_cimyFieldValue($current_user_id, 'EMP_HOW_MNY_FUL_TM_D', $EMP_HOW_MNY_FUL_TM_D);
	}
	if(isset($_POST['EMP_HOW_MNY_FUL_TM']) && !empty($_POST['EMP_HOW_MNY_FUL_TM'])){
		$EMP_HOW_MNY_FUL_TM = $_POST['EMP_HOW_MNY_FUL_TM'];
		set_cimyFieldValue($current_user_id, 'EMP_HOW_MNY_FUL_TM', $EMP_HOW_MNY_FUL_TM);
	}
	if(isset($_POST['EMP_WHT_AVG_BURD_DES']) && !empty($_POST['EMP_WHT_AVG_BURD_DES'])){
		$EMP_WHT_AVG_BURD_DES = $_POST['EMP_WHT_AVG_BURD_DES'];
		set_cimyFieldValue($current_user_id, 'EMP_WHT_AVG_BURD_DES', $EMP_WHT_AVG_BURD_DES);
	}
	if(isset($_POST['EMP_WHT_AVG_BURD']) && !empty($_POST['EMP_WHT_AVG_BURD'])){
		$EMP_WHT_AVG_BURD = $_POST['EMP_WHT_AVG_BURD'];
		set_cimyFieldValue($current_user_id, 'EMP_WHT_AVG_BURD', $EMP_WHT_AVG_BURD);
	}
	if(isset($_POST['EMP_PER_RES_RVD']) && !empty($_POST['EMP_PER_RES_RVD'])){
		$EMP_PER_RES_RVD = $_POST['EMP_PER_RES_RVD'];
		set_cimyFieldValue($current_user_id, 'EMP_PER_RES_RVD', $EMP_PER_RES_RVD);
	}
	if(isset($_POST['EMP_UNSOLICITED_MAIL']) && !empty($_POST['EMP_UNSOLICITED_MAIL'])){
		$EMP_UNSOLICITED_MAIL = $_POST['EMP_UNSOLICITED_MAIL'];
		set_cimyFieldValue($current_user_id, 'EMP_UNSOLICITED_MAIL', $EMP_UNSOLICITED_MAIL);
	}
	if(isset($_POST['EMP_REQ_PRINT_ADDS']) && !empty($_POST['EMP_REQ_PRINT_ADDS'])){
		$EMP_REQ_PRINT_ADDS = $_POST['EMP_REQ_PRINT_ADDS'];
		set_cimyFieldValue($current_user_id, 'EMP_REQ_PRINT_ADDS', $EMP_REQ_PRINT_ADDS);
	}
	if(isset($_POST['EMP_OUT_STAFF_FIRMS']) && !empty($_POST['EMP_OUT_STAFF_FIRMS'])){
		$EMP_OUT_STAFF_FIRMS = $_POST['EMP_OUT_STAFF_FIRMS'];
		set_cimyFieldValue($current_user_id, 'EMP_OUT_STAFF_FIRMS', $EMP_OUT_STAFF_FIRMS);
	}
	if(isset($_POST['EMP_JOB_FAIRS_SELECT']) && !empty($_POST['EMP_JOB_FAIRS_SELECT'])){
		$EMP_JOB_FAIRS_SELECT = $_POST['EMP_JOB_FAIRS_SELECT'];
		set_cimyFieldValue($current_user_id, 'EMP_JOB_FAIRS_SELECT', $EMP_JOB_FAIRS_SELECT);
	}
	if(isset($_POST['EMP_CAMPUS_RECRUIT']) && !empty($_POST['EMP_CAMPUS_RECRUIT'])){
		$EMP_CAMPUS_RECRUIT = $_POST['EMP_CAMPUS_RECRUIT'];
		set_cimyFieldValue($current_user_id, 'EMP_CAMPUS_RECRUIT', $EMP_CAMPUS_RECRUIT);
	}
	if(isset($_POST['EMP_INT_AD_N_POST_BO']) && !empty($_POST['EMP_INT_AD_N_POST_BO'])){
		$EMP_INT_AD_N_POST_BO = $_POST['EMP_INT_AD_N_POST_BO'];
		set_cimyFieldValue($current_user_id, 'EMP_INT_AD_N_POST_BO', $EMP_INT_AD_N_POST_BO);
	}
	if(isset($_POST['EMP_EMPLOYE_REFERRAL']) && !empty($_POST['EMP_EMPLOYE_REFERRAL'])){
		$EMP_EMPLOYE_REFERRAL = $_POST['EMP_EMPLOYE_REFERRAL'];
		set_cimyFieldValue($current_user_id, 'EMP_EMPLOYE_REFERRAL', $EMP_EMPLOYE_REFERRAL);
	}
	if(isset($_POST['EMP_OF_THE_RES_RVD']) && !empty($_POST['EMP_OF_THE_RES_RVD'])){
		$EMP_OF_THE_RES_RVD = $_POST['EMP_OF_THE_RES_RVD'];
		set_cimyFieldValue($current_user_id, 'EMP_OF_THE_RES_RVD', $EMP_OF_THE_RES_RVD);
	}
	if(isset($_POST['EMP_PPR_FORM_FAX']) && !empty($_POST['EMP_PPR_FORM_FAX'])){
		$EMP_PPR_FORM_FAX = $_POST['EMP_PPR_FORM_FAX'];
		set_cimyFieldValue($current_user_id, 'EMP_PPR_FORM_FAX', $EMP_PPR_FORM_FAX);
	}
	if(isset($_POST['EMP_THRU_ONLINE_APPS']) && !empty($_POST['EMP_THRU_ONLINE_APPS'])){
		$EMP_THRU_ONLINE_APPS = $_POST['EMP_THRU_ONLINE_APPS'];
		set_cimyFieldValue($current_user_id, 'EMP_THRU_ONLINE_APPS', $EMP_THRU_ONLINE_APPS);
	}
	if(isset($_POST['EMP_THRU_CORP_EMAIL']) && !empty($_POST['EMP_THRU_CORP_EMAIL'])){
		$EMP_THRU_CORP_EMAIL = $_POST['EMP_THRU_CORP_EMAIL'];
		set_cimyFieldValue($current_user_id, 'EMP_THRU_CORP_EMAIL', $EMP_THRU_CORP_EMAIL);
	}
	if(isset($_POST['EMP_MAGZNS_PERIODIC']) && !empty($_POST['EMP_MAGZNS_PERIODIC'])){
		$EMP_MAGZNS_PERIODIC = $_POST['EMP_MAGZNS_PERIODIC'];
		set_cimyFieldValue($current_user_id, 'EMP_MAGZNS_PERIODIC', $EMP_MAGZNS_PERIODIC);
	}
	if(isset($_POST['EMP_CNY_ACPT_INT_CAN']) && !empty($_POST['EMP_CNY_ACPT_INT_CAN'])){
		$EMP_CNY_ACPT_INT_CAN = $_POST['EMP_CNY_ACPT_INT_CAN'];
		set_cimyFieldValue($current_user_id, 'EMP_CNY_ACPT_INT_CAN', $EMP_CNY_ACPT_INT_CAN);
	}
	if(isset($_POST['EMP_INT_WHT_ANL_CT_D']) && !empty($_POST['EMP_INT_WHT_ANL_CT_D'])){
		$EMP_INT_WHT_ANL_CT_D = $_POST['EMP_INT_WHT_ANL_CT_D'];
		set_cimyFieldValue($current_user_id, 'EMP_INT_WHT_ANL_CT_D', $EMP_INT_WHT_ANL_CT_D);
	}
	if(isset($_POST['EMP_INT_WHT_ANL_CT']) && !empty($_POST['EMP_INT_WHT_ANL_CT'])){
		$EMP_INT_WHT_ANL_CT = $_POST['EMP_INT_WHT_ANL_CT'];
		set_cimyFieldValue($current_user_id, 'EMP_INT_WHT_ANL_CT', $EMP_INT_WHT_ANL_CT);
	}
	if(isset($_POST['EMP_HOW_HEAR_ABT_EYE']) && !empty($_POST['EMP_HOW_HEAR_ABT_EYE'])){
		$EMP_HOW_HEAR_ABT_EYE = implode(',', $_POST['EMP_HOW_HEAR_ABT_EYE']);
		set_cimyFieldValue($current_user_id, 'EMP_HOW_HEAR_ABT_EYE', $EMP_HOW_HEAR_ABT_EYE);
	}
	if(isset($_POST['EMP_WHT_RES_IF_ANY']) && !empty($_POST['EMP_WHT_RES_IF_ANY'])){
		$EMP_WHT_RES_IF_ANY = $_POST['EMP_WHT_RES_IF_ANY'];
		set_cimyFieldValue($current_user_id, 'EMP_WHT_RES_IF_ANY', $EMP_WHT_RES_IF_ANY);
	}
	if(isset($_POST['EMP_HW_HR_ABT_EYE_D']) && !empty($_POST['EMP_HW_HR_ABT_EYE_D'])){
		$EMP_HW_HR_ABT_EYE_D = $_POST['EMP_HW_HR_ABT_EYE_D'];
		set_cimyFieldValue($current_user_id, 'EMP_HW_HR_ABT_EYE_D', $EMP_HW_HR_ABT_EYE_D);
	}
	echo get_cimyFieldValue($current_user_id, 'EMP_YR_POS_IN_ORGN');
	echo get_cimyFieldValue($current_user_id, 'EMP_NO_EMP_ON_TEAM');
	echo get_cimyFieldValue($current_user_id, 'EMP_AREA_TO_B_SEARCH');
	echo get_cimyFieldValue($current_user_id, 'EMP_STATES_OF_US');
	echo get_cimyFieldValue($current_user_id, 'EMP_INDUS_REF_SRVICE');
	echo get_cimyFieldValue($current_user_id, 'EMP_CMPNY_LIS_INFO');
	echo get_cimyFieldValue($current_user_id, 'EMP_WUD_RELOC_SUGGES');
	echo get_cimyFieldValue($current_user_id, 'EMP_CPY_REL_INCN_DES');
	echo get_cimyFieldValue($current_user_id, 'EMP_CPY_REL_INCN');
	echo get_cimyFieldValue($current_user_id, 'EMP_CMNY_ALLOC_ANUAL');
	echo get_cimyFieldValue($current_user_id, 'EMP_CMNY_ALLOC_UNON');
	echo get_cimyFieldValue($current_user_id, 'EMP_OFER_SIGNING_BON');
	echo get_cimyFieldValue($current_user_id, 'EMP_CPNY_SIG_BON_DES');
	echo get_cimyFieldValue($current_user_id, 'EMP_CPNY_SIG_BON');
	echo get_cimyFieldValue($current_user_id, 'EMP_ORG_UNQ_FR_EMP_D');
	echo get_cimyFieldValue($current_user_id, 'EMP_ORG_UNQ_FR_EMP');
	echo get_cimyFieldValue($current_user_id, 'EMP_TEAM_IN_MULTILOC');
	echo get_cimyFieldValue($current_user_id, 'EMP_OFFICES_IN_STATE');
	echo get_cimyFieldValue($current_user_id, 'EMP_HAV_TEAM_IN_MULT');
	echo get_cimyFieldValue($current_user_id, 'EMP_JOB_POSTNG_METH');
	echo get_cimyFieldValue($current_user_id, 'EMP_R_INTRNSIP_AVBL');
	echo get_cimyFieldValue($current_user_id, 'EMP_UNI_PRG_INT_LOC');
	echo get_cimyFieldValue($current_user_id, 'EMP_WHAT_IS_MOR_IMP');
	echo get_cimyFieldValue($current_user_id, 'EMP_ANUAL_EXP_ON_VEN');
	echo get_cimyFieldValue($current_user_id, 'EMP_ANUAL_EXP_VEN');
	echo get_cimyFieldValue($current_user_id, 'EMP_CNY_SPND_ON_JOB');
	echo get_cimyFieldValue($current_user_id, 'EMP_INTRNT_JOB_BOARD');
	echo get_cimyFieldValue($current_user_id, 'EMP_PPR_BSE_BULL_BOA');
	echo get_cimyFieldValue($current_user_id, 'EMP_KIOSKS_DESC');
	echo get_cimyFieldValue($current_user_id, 'EMP_HOW_MNY_RES_DESC');
	echo get_cimyFieldValue($current_user_id, 'EMP_HOW_MNY_RES');
	echo get_cimyFieldValue($current_user_id, 'EMP_HOW_MNY_FUL_TM_D');
	echo get_cimyFieldValue($current_user_id, 'EMP_HOW_MNY_FUL_TM');
	echo get_cimyFieldValue($current_user_id, 'EMP_WHT_AVG_BURD_DES');
	echo get_cimyFieldValue($current_user_id, 'EMP_WHT_AVG_BURD');
	echo get_cimyFieldValue($current_user_id, 'EMP_PER_RES_RVD');
	echo get_cimyFieldValue($current_user_id, 'EMP_UNSOLICITED_MAIL');
	echo get_cimyFieldValue($current_user_id, 'EMP_REQ_PRINT_ADDS');
	echo get_cimyFieldValue($current_user_id, 'EMP_OUT_STAFF_FIRMS');
	echo get_cimyFieldValue($current_user_id, 'EMP_JOB_FAIRS_SELECT');
	echo get_cimyFieldValue($current_user_id, 'EMP_CAMPUS_RECRUIT');
	echo get_cimyFieldValue($current_user_id, 'EMP_INT_AD_N_POST_BO');
	echo get_cimyFieldValue($current_user_id, 'EMP_EMPLOYE_REFERRAL');
	echo get_cimyFieldValue($current_user_id, 'EMP_OF_THE_RES_RVD');
	echo get_cimyFieldValue($current_user_id, 'EMP_PPR_FORM_FAX');
	echo get_cimyFieldValue($current_user_id, 'EMP_THRU_ONLINE_APPS');
	echo get_cimyFieldValue($current_user_id, 'EMP_THRU_CORP_EMAIL');
	echo get_cimyFieldValue($current_user_id, 'EMP_MAGZNS_PERIODIC');
	echo get_cimyFieldValue($current_user_id, 'EMP_CNY_ACPT_INT_CAN');
	echo get_cimyFieldValue($current_user_id, 'EMP_INT_WHT_ANL_CT_D');
	echo get_cimyFieldValue($current_user_id, 'EMP_INT_WHT_ANL_CT');
	echo get_cimyFieldValue($current_user_id, 'EMP_HOW_HEAR_ABT_EYE');
	echo get_cimyFieldValue($current_user_id, 'EMP_WHT_RES_IF_ANY');
	echo get_cimyFieldValue($current_user_id, 'EMP_HW_HR_ABT_EYE_D');
die();
}


// ajax for file
add_action('wp_ajax_emp_profile_upload_files', 'emp_profile_upload_files');
add_action('wp_ajax_nopriv_emp_profile_upload_files', 'emp_profile_upload_files');

function emp_profile_upload_files(){
	
	$user_id = multi_base64_decode($_REQUEST['rec']);
	global $wpdb;
    $valid_formats = array("pdf", "jpg", "jpeg", "png");
    $max_file_size = 2000000;
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
		            $upload_message[] = '<p class="error">File is too large!.</p>';
		            continue;
		        } elseif( ! in_array( strtolower( $extension ), $valid_formats ) ){
		            $upload_message[] = '<p class="error">File is not a valid format. Allow only pdf, jpg, jpeg and png format.';
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

			            set_cimyFieldValue($user_id, 'EMP_CMPNY_LIS_FILE', $filefullpath);
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



// ajax for file
add_action('wp_ajax_employee_login_after_ques_saved', 'employee_login_after_ques_saved');
add_action('wp_ajax_nopriv_employee_login_after_ques_saved', 'employee_login_after_ques_saved');

function employee_login_after_ques_saved(){
	if($_POST['rec_id']){
		$user_id = multi_base64_decode($_POST['rec_id']);
		update_user_meta($user_id, 'pw_user_status', 'approved');
		wp_set_current_user($user_id);
    	wp_set_auth_cookie($user_id);
	}
	die();
}


// ajax action for redacted_save_candidate_for_emp
add_action('wp_ajax_redacted_save_candidate_for_emp', 'redacted_save_candidate_for_emp');
add_action('wp_ajax_nopriv_redacted_save_candidate_for_emp', 'redacted_save_candidate_for_emp');

function redacted_save_candidate_for_emp(){
	if($_POST['recruitID']){
		$recruitID = $_POST['recruitID'];
		$user_id = get_current_user_id();
		$getpreval = get_user_meta($user_id, 'saveredactedcandidates', true);
		if ( !empty($getpreval) ) {
			$getprevalArr = explode(',', $getpreval);
			$recruitIDArr = explode(',', $recruitID);
			
			$getnewvalueArr = array_merge($getprevalArr, $recruitIDArr);
			$getnewvalueArrU = array_unique($getnewvalueArr);
			
			$getnewvalue = implode(',', $getnewvalueArrU);
			update_user_meta($user_id, 'saveredactedcandidates', $getnewvalue);
		}
		else{
			update_user_meta($user_id, 'saveredactedcandidates', $recruitID);
		}
	}
	die();
}

/*.........Send Seeker detail,,,,,,,,,,,,,,,,,*/
add_action('wp_ajax_sendSeekerDetailTo', 'sendSeekerDetailTo');
add_action('wp_ajax_nopriv_sendSeekerDetailTo', 'sendSeekerDetailTo');

function sendSeekerDetailTo(){	
	$return = array();
	if ( is_user_logged_in() ) {
		if ( isset($_POST) ) {
			if ( !empty($_POST['fname']) && !empty($_POST['user_email']) && !empty($_POST['can_id'])) {
				$to_name = $_POST['fname'];
				$to_email = $_POST['user_email'];
				$to_msg = $_POST['user_msg'];

				$can_id = $_POST['can_id'];
				$candata = get_userdata($can_id);
				$can_name = $candata->first_name.' '.$candata->last_name;
				$can_email = $candata->user_email;
				$can_url = site_url().'/job-seekers/quick-view/?recruiterid='.$can_id;

				$userID = get_current_user_id();
				$userdata = get_userdata($userID);
				$from_name = $userdata->first_name.' '.$userdata->last_name; 

				$getArr = get_option('forward_seeker_detail');
				if ( isset($getArr['forward_seeker_detail_subject']) ) {
					$subject = $getArr['forward_seeker_detail_subject'];
					$subject = str_replace('[from_name]', $from_name, $subject);
				} else {
					$subject = 'A Candidate recommendation from your friend';
				}

				if ( isset($getArr['forward_seeker_detail_template']) ) {
					$message = $getArr['forward_seeker_detail_template'];
					$shortArr = array('[to_name]', '[shareMsg]', '[can_name]', '[can_email]', '[can_url]', '[from_name]');
					$replWith = array($to_name, $to_msg, $can_name, $can_email, $can_url, $from_name);
					$message = str_replace($shortArr, $replWith, $message); 
				} else{
					$message = '';
				}

				$headers = "MIME-Version: 1.0" . "\r\n";
    			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

				if( wp_mail($to_email, $subject, $message, $headers) ){
					$return['msg'] = 'success';
					die( json_encode($return) );
				} else {
					$return['msg'] = 'error';
					die( json_encode($return) );
				}

			} else {
				$return['msg'] = 'error';
				die( json_encode($return) );
			}
		} else {
			$return['msg'] = 'error';
			die( json_encode($return) );
		}
	} else {
		$return['msg'] = 'not login';
		die( json_encode($return) );
	}
	$return['msg'] = 'error';
	die( json_encode($return) );
}