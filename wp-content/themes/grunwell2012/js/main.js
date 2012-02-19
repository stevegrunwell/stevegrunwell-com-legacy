/**
 * Site scripting
 * @package WordPress
 * @subpackage grunwell2012
 * @author Steve Grunwell <steve@stevegrunwell.com>
 */

/**
 * Set the height of #content equal to the tallest between .primary and .secondary
 * @return bool
 */
function setContentHeight(){
  var primaryHeight = jQuery('#content').find('.primary').height();
  var secondaryHeight = jQuery('#content').find('.secondary').height();
  var maxHeight = ( primaryHeight > secondaryHeight ? primaryHeight : secondaryHeight );
  if( jQuery('#content').height() < maxHeight ){
    jQuery('#content').height(maxHeight);
    return true;
  } else {
    return false;
  }
}

jQuery(function($){

  /** If .secondary is taller than .primary while 770px < window size < 1060px .secondary runs out of #content */
  setContentHeight();
  $(window).resize(setContentHeight);

  /** Add placeholder support for older browsers */
  if( $.fn.placeholder ){
    jQuery('#content').find('input').placeholder();
  }

});