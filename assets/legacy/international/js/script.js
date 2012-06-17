/* Author:

*/


jQuery(document).ready(function(){
	
	// Run Matt Kersley's jQuery Responsive menu plugin (see plugins.js)
	if (jQuery.fn.mobileMenu) {
		/* jQuery('#menu-primary-navigation').mobileMenu({
			switchWidth: 768,                   // width (in px to switch at)
			topOptionText: 'Choose a page',     // first option text
			indentString: '&nbsp;&nbsp;&nbsp;'  // string for indenting nested items
		}); */
    jQuery('#browse-locations').mobileMenu({
			switchWidth: 768,                   // width (in px to switch at)
			topOptionText: 'Jump to a Location',     // first option text
			indentString: '&nbsp;&nbsp;&nbsp;'  // string for indenting nested items
    });
    jQuery('#browse-types').mobileMenu({
			switchWidth: 768,                   // width (in px to switch at)
			topOptionText: 'Jump to a Resource Type',     // first option text
			indentString: '&nbsp;&nbsp;&nbsp;'  // string for indenting nested items
    });
    jQuery('.widget_taxonomy ul').mobileMenu({
			switchWidth: 768,                   // width (in px to switch at)
			topOptionText: 'Jump to...',     // first option text
			indentString: '&nbsp;&nbsp;&nbsp;'  // string for indenting nested items
    });
	}

	// Run Mathias Bynens jQuery placeholder plugin (see plugins.js)
	if (jQuery.fn.placeholder) {
		jQuery('input, textarea').placeholder();		
	}
});
