jQuery(document).ready(function($){
	$('div.er-admin-tabbed-wrapper > .er_admin_tabs > li:nth-of-type(1) a').addClass('active');
	$('div.er-admin-tabbed-wrapper > .er_admin_tabbed_content:gt(0)').hide();
});

jQuery(".er_admin_tabs > li a").click(function(e){
	e.preventDefault();
	jQuery(".er_admin_tabs > li a").removeClass('active');
	jQuery(this).addClass('active');
	var activeTabDivEl = jQuery(this).data('term-target'); 
	var parentEl = jQuery(this).closest(".er-admin-tabbed-wrapper");
	parentEl.find('.er_admin_tabbed_content').hide();
	parentEl.find("#" + activeTabDivEl ).show();
});