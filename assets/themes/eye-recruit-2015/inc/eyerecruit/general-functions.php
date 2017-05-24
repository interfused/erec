<?php
function allowViewFor($roles_arr){
			///CHECK AN ARRAY OF ROLES AND ALLOW VIEW
	/* USAGE allowViewFor(array('administrator','employer',recruiter'))  ; */
				global $curr_user;
				for($i=0;$i<count($roles_arr);$i++){
					if(in_array($roles_arr[$i], $curr_user->roles)){
						return true;
						break;
					}
				}
				
				return false;
			}
/////////////
			

?>