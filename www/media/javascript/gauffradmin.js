/**
 * GauffrAdmin JS functions
 *
 * @copyright Copyright (c) 2009-2011 Guillaume Kulakowski and contributors
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2.0
 */
$(document).ready
(function(){

    // Go to on change
	$('select.goOnChange').gauffrGoOnChange();

	// ToolTip
	$('.moreInfoToolTip').tooltip({
	    track: true,
	    delay: 0,
	    showURL: false,
	    showBody: " - ",
	});

	// TableSorter
    $.tablesorter.defaults.widgets = ['zebra'];
	if ( $("#jspager").length ) {
		$('.sortable')
			.tablesorter()
			.tablesorterPager({
				container: $("#jspager"),
				positionFixed: false,
				size: 25,
			});
	}
	else {
		$('.sortable').tablesorter();
	}

	// fadeOut effect
	$('.fadeout').fadeOut( 5000, function() {
	});

});





/* ________________________________________________________ jQuery extensions */

/**
 * Go to on change
 */
$.fn.gauffrGoOnChange = function () {
	var urlParams = $.url.paramAll();

	return this.each( function() {
		$(this).change( function() {
			// Put or override get variable
			urlParams[this.name] = this.value;
			urlParams['offset'] = 0; // Reset offset
			urlParamsString = '?';

			$.each( urlParams, function( name, value) {
				urlParamsString = urlParamsString + name + "=" + value + "&";
			});
			window.location = window.location.pathname + urlParamsString;
		});
	});
};