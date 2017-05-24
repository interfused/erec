function GetURLParameter(sParam) {
 var sPageURL = window.location.search.substring(1);
	    var sURLVariables = sPageURL.split('&');
	    for (var i = 0; i < sURLVariables.length; i++)
	    {
	        var sParameterName = sURLVariables[i].split('=');
	        if (sParameterName[0] == sParam)
	        {
	            return sParameterName[1];
	        }
	    }
	
}

jQuery(document).ready(function(){
	jQuery('[data-toggle="tooltip"]').tooltip();
	jQuery('[data-toggle="popover"]').popover();
	jQuery(".modal-dialog").addClass('vertical-align-center');
    jQuery(".modal-dialog.vertical-align-center").wrap('<div class="vertical-alignment-helper"></div>');
})