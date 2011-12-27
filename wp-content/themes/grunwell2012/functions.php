<?php
/**
 * Theme functions
 * @package WordPress
 * @subpackage grunwell2012
 * @author Steve Grunwell <steve@stevegrunwell.com>
 */

/**
 * Assemble the page's <title> attribute
 * @param str $sep The string separator to use
 * @return str
 */
function grunwell_page_title($sep='|'){
  if( is_front_page() ):
    return get_bloginfo('name') . " $sep " . get_bloginfo('description', 'display');
  else:
    return wp_title($sep, false, 'right') . get_bloginfo('name');
  endif;
}

/**
 * Get the tag for #site-logo
 * Will use a <h1> on the front page and <div> on the others
 * @param mixed $content Text, image, or other content to wrap in the tag. If $content is false, simply return the tag
 * @return str
 */
function grunwell_sitelogo($content=false){
  $tag = ( is_front_page() ? 'h1' : 'div' );
  return ( $content ? sprintf('<%s id="site-logo">%s</%s>', $tag, $content, $tag) : $tag );
}
?>