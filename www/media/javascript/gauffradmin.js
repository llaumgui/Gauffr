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

	$('.moreInfoToolTip').tooltip({
	    track: true,
	    delay: 0,
	    showURL: false,
	    showBody: " - ",
	});
});





/* ________________________________________________________ jQuery extensions */

/**
 * Go to on change
 */
$.fn.gauffrGoOnChange = function () {
	var urlVars = getUrlVars();

	return this.each( function() {
		$(this).change( function() {
			// Put or override get variable
			urlVars[this.name] = this.value;
			urlVars['offset'] = 0; // Reset offset

			urlVarsString = '?';
			$.each( urlVars, function( name, value) {
				urlVarsString = urlVarsString + name + "=" + value + "&";
			});
			window.location = window.location.pathname + urlVarsString;
		});
	});
};





/* _________________________________________________________ jQuery functions */
/**
 * Read a page's GET URL variables and return them as an associative array.
 */
function getUrlVars() {
    var vars = {}, hash;
    if ( window.location.href.indexOf('?') > 0 )
    {
    	var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    	for(var i = 0; i < hashes.length; i++) {
    		if( hashes[i].indexOf('=') > 0 )
			{
    			hash = hashes[i].split('=');
    			vars[hash[0]] = hash[1];
			}
    	}
    }
    return vars;
}