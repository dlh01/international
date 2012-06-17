jQuery(document).ready(function($) {

	$adminmenuwrap = $('#adminmenuwrap'); // declare globally for performance

	if ($.support.fixedPosition) {

		fam_position_admin_menu();

		$(window).resize(function() {
			fam_position_admin_menu();
		}).scroll(function() {
			fam_position_admin_menu();
		});

	}

});

function fam_position_admin_menu() {

	// is the viewport taller than the admin menu? (optional: only float the collapsed menu)
	if (jQuery(window).height() > $adminmenuwrap.outerHeight(true) /* && jQuery('body').hasClass('folded') */) {
		if (!$adminmenuwrap.hasClass('floating')) {
			$adminmenuwrap.addClass('floating'); // only set class, if it's not set yet
		}
	} else if ($adminmenuwrap.hasClass('floating')) {
		$adminmenuwrap.removeClass('floating'); // only remove class, if it's set
	}

}