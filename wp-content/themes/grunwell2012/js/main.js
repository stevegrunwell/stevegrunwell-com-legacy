/**
 * Site scripting
 * @package WordPress
 * @subpackage grunwell2012
 * @author Steve Grunwell <steve@stevegrunwell.com>
 */

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

  /* Collapse #primary-nav into a <select> menu for smaller screens */
  $('#primary-nav').append(navToSelectMenu('#primary-nav'));
  $('#primary-nav').on('change', 'select', function(){
    window.location = $(this).find('option:selected').val();
  });

  /** Add placeholder support for older browsers */
  if( $.fn.placeholder ){
    jQuery('#wrapper').find( 'input, textarea' ).placeholder();
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
      $('#content').find( 'a[rel="lightbox"], a.lightbox' ).fancybox({
        nextEffect: 'fade',
        prevEffect: 'fade'
      });
    }
  }

});