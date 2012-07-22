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

/**
 * Create a select menu from a series of links, using the links' href attributes as the option value attribute
 * @param mixed links A selector or jQuery object containing the links
 * @return jQuery object
 */
function navToSelectMenu(links){
  "use strict";
  var select = jQuery('<select />');

  jQuery('<option />', {
    text: 'Go to...',
    value: ''
  }).appendTo(select);

  jQuery(links).find('a').each(function(){
    var self = jQuery(this);
    jQuery('<option />', {
      selected: ( self.parent('li').hasClass('current_page_parent') ? 'selected' : false ),
      text: self.text(),
      value: self.attr('href')
    }).appendTo(select);
  });
  return select;
}

jQuery(function($){

  /** If .secondary is taller than .primary while 770px < window size < 1060px .secondary runs out of #content */
  setContentHeight();
  $(window).resize(setContentHeight);

  /* Collapse #primary-nav into a <select> menu for smaller screens */
  $('#primary-nav').append(navToSelectMenu('#primary-nav'));
  $('#primary-nav').on('change', 'select', function(){
    window.location = $(this).find('option:selected').val();
  });

  /** Add placeholder support for older browsers */
  if( $.fn.placeholder ){
    jQuery('#wrapper').find( 'input, textarea' ).placeholder();
  }

  /** jQuery validator */
  if ( $.fn.validate ) {
    $.validator.addClassRules( 'wpcf7-validates-as-required', { required: true } );
    $.validator.addClassRules( 'wpcf7-validates-as-email', { email: true } );
    $('#content').find( 'form.wpcf7-form' ).validate();
  }

  /** jQuery Flexslider */
  if ( $.fn.flexslider ) {
    $('#content').find( '.flexslider' ).flexslider({
      controlNav: true,
      directionNav: false,
      pauseOnHover: true,
      start: function(e) {
        e.find('.slides').removeClass('loading');
      }
    });
  }

  /** jQuery Fancybox */
  if ( $.fn.fancybox ) {
    // Only use Fancybox if our window is at least 480px wide - lightboxes on small screens are awful
    if ( $( window ).width() > 480 ) {
      $('#content').find( 'a[rel="lightbox"]' ).fancybox({
        nextEffect: 'fade',
        prevEffect: 'fade'
      });
    }
  }

});