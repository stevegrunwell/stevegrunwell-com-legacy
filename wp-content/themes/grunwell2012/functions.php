<?php
/**
 * Theme functions
 * @package WordPress
 * @subpackage grunwell2012
 * @author Steve Grunwell <steve@stevegrunwell.com>
 */

/**
* Creates the "Portfolio" custom post type
* @return void
*/
function grunwell_create_portfolio_post_type() {
  $args = array(
    'labels' => array(
      'name' => 'Portfolio',
      'singular_name' => 'Portfolio piece'
    ),
    'public' => true,
    'has_archive' => true,
    'rewrite' => array(
      'slug' => 'portfolio',
      'with_front' => false
    )
  );
  register_post_type('grunwell_portfolio', $args);
  return;
}
add_action('init', 'grunwell_create_portfolio_post_type');

function grunwell_custom_menus(){
  register_nav_menus(
    array('primary-nav' => 'Primary Navigation')
  );
  return;
}
add_action('init', 'grunwell_custom_menus');

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
  $content = preg_replace('/\s+(\S+)$/', sprintf('<span class="last">%s</span>', '${1}'), trim($content));
  return ( $content ? sprintf('<%s id="site-logo">%s</%s>', $tag, $content, $tag) : $tag );
}

/**
 * Get the formatted date string for the post and output it wrapped in the HTML5 <time> element
 * When used within the loop the $date parameter is unnecessary
 * @global $post
 * @param str $date The date to format
 * @param bool $inc_time Include the post time? (default: true)
 * @param str $class CSS classes to apply to the <time> element
 * @return str
 */
function grunwell_get_the_date($date='', $inc_time=true, $class=''){
  global $post;
  $gmt = false;
  $format = 'F jS, Y' . ( $inc_time ? ' \a\\t g:ia' : '' );

  if( strtolower($date) <= 0 ){
    if( isset($post->post_date, $post->post_date_gmt) && strtotime($post->post_date) > 0 ){ // Use global $post object
      $date = $post->post_date;
      $gmt = strtotime($post->post_date_gmt);
    } else { // Use current time
      $date = date('Y-m-d H:i:s');
    }
  }
  $date = strtotime($date);

  if( !$gmt ){
    $offset = floatval(get_bloginfo('gmt_offset'));
    $gmt = $date + ($offset*60*60);
  }

  if( $class != '' ){
    $class = sprintf(' class="%s"', $class);
  }

  $return = sprintf('<time datetime="%s"%s>%s</time>', date('c', $gmt), $class, date($format, $date));
  return apply_filters('grunwell_get_the_date', $return);
}

/** Shortcut for echo grunwell_the_date() */
function grunwell_the_date($date='', $inc_time=true, $class=''){
  echo grunwell_get_the_date($date, $inc_time, $class);
  return;
}

/**
 * Wrap "st" and "th" in <sup> (useful for dates)
 * @param $str The string to search/filter
 * @return str
 */
function grunwell_superscript_dates($str){
  if( preg_match_all('/\d(st|nd|rd|th)/i', $str, $matches) ){
    foreach( $matches['0'] as $k=>$v ){
      $replacement = str_replace($matches['1'][$k], sprintf('<sup>%s</sup>', $matches['1'][$k]), $v);
      $str = str_replace($v, $replacement, $str);
    }
  }
  return $str;
}
add_filter('grunwell_get_the_date', 'grunwell_superscript_dates');

/**
 * Get a custom field stored in the Advanced Custom Fields plugin
 * By running it through this function, we ensure that we don't die if the plugin is uninstalled/disabled (and thus the function is undefined)
 * @global $post
 * @param str $key The key to look for
 * @param int $id The post ID
 * @param mixed $default What to return if there's nothing
 * @return mixed (dependent upon $echo)
 * @uses get_field()
 */
function grunwell_get_custom_field($key, $id=false, $default=''){
  global $post;
  $key = trim(filter_var($key, FILTER_SANITIZE_STRING));
  $result = '';

  if( function_exists('get_field') ){
    if( intval($id) > 0 ){
      $result = get_field($key, intval($id));
    } else if( isset($post->ID) ){
      $result = get_field($key);
    }

    if( $result == '' ){
      $result = $default;
    }
  } else { // get_field() is undefined, most likely due to the plugin being inactive
    $result = $default;
  }
  return $result;
}

/** Shortcut for echo grunwell_get_custom_field() */
function grunwell_custom_field($key, $id=false, $default=''){
  echo grunwell_get_custom_field($key, $id, $default);
  return;
}

?>