jQuery(document).ready(function($){
	$('.CFPP_edit_field').click(function(e){
		$(this).parents('.CFPP_field').find('.CFPP_field_form').toggle();
		e.preventDefault();
	});

	$('.CFPP_delete_field').live('click', function(e){
		$(this).parents('.CFPP_field').remove();
		e.preventDefault();
	});

	$('#CFPP_add_new_field').click(function(e){
		$('#CFPP_fields').append( $('#CFPP_new_field_form').html() );
		e.preventDefault();
	});
	
});