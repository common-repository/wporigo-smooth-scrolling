/* 
 * Wporigo Smooth Scrolling custom JS file
 * @package      WPOrigo Smooth Scrolling
 * @author       Elod Horvath
 * @copyright    2014-... Elod Horvath
 * @since        1.0
*/


/*************************************************
 Smooth scrolling
*************************************************/
if(!Modernizr.touch){

	var $window = jQuery( window );
	var scrollTime = 1;
	var scrollDistance = parseInt( wporigo_ssp_vars.wporigo_ssp_scrolldistance );

	$window.on( "mousewheel DOMMouseScroll", function( event ){

		event.preventDefault();	

		var delta = event.originalEvent.wheelDelta/120 || -event.originalEvent.detail/3;
		var scrollTop = $window.scrollTop();
		var finalScroll = scrollTop - parseInt( delta*scrollDistance );

		TweenMax.to( $window, scrollTime, {
			scrollTo : { y: finalScroll, autoKill:true },
				ease: Power1.easeOut,
				overwrite: 5							
		} );

	} );

}
