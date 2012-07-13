jQuery(document).ready(function($) {

	if ($.support.fixedPosition) {

		$adminMenuWrap = $('#adminmenuwrap');	
		bodyMinWidth = parseInt($(document.body).css('min-width'));

		fam_position_admin_menu();

		$(window).resize(function() {
			fam_position_admin_menu();
		}).scroll(function() {
			fam_position_admin_menu();
		});

		$('#collapse-menu', $adminMenuWrap).click(function() {
			setTimeout(fam_position_admin_menu, 20); // executed after after click() callbacks in WP's common.js
		});

	}

});

function fam_position_admin_menu() {

	// float if the viewport is taller than the admin menu && if the viewport is wider than the min-width of the <body>
	// to float the menu only if it's collapsed add: jQuery('body').hasClass('folded')
	if (jQuery(window).height() > $adminMenuWrap.outerHeight(true) && jQuery(window).width() > bodyMinWidth) {
		if (!$adminMenuWrap.hasClass('floating')) {
			$adminMenuWrap.addClass('floating');
		}
	} else if ($adminMenuWrap.hasClass('floating')) {
		$adminMenuWrap.removeClass('floating');
	}

}