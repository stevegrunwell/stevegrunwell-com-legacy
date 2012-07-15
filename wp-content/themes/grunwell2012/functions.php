<?php
/**
 * Theme functions
 * @package WordPress
 * @subpackage grunwell2012
 * @author Steve Grunwell <steve@stevegrunwell.com>
 */

include_once dirname( __FILE__ ) . '/simple-twitter-timeline/twitter.class.php';

/**
 * Register scripts and styles
 * @uses wp_register_script()
 * @uses wp_register_style()
 */
function grunwell_register_scripts_styles() {
  # Styles
  wp_register_style( 'site-styles', get_bloginfo( 'template_url' ) . '/css/base.css', null, null, 'all' );

  # Scripts
  wp_register_script( 'site-scripts', get_bloginfo( 'template_url' ) . '/js/main.js', array('jquery', 'jquery-placeholder'), '', true );

  # Third-party

  // jQuery Placeholder - https://github.com/mathiasbynens/jquery-placeholder
  wp_register_script( 'jquery-placeholder', get_bloginfo( 'template_url' ) . '/js/jquery.placeholder.min.js', array('jquery'), '1.8.7', true );

  // jQuery Flexslider - http://www.woothemes.com/flexslider/
  wp_register_script( 'jquery-flexslider', get_bloginfo( 'template_url' ) . '/js/jquery.flexslider.min.js', array('jquery'), '1.8', true );

  // Modernizr
  wp_register_script( 'modernizr', get_bloginfo( 'template_url' ) . '/js/modernizr.min.js', null, '2.5.3', false );
}
add_action( 'init', 'grunwell_register_scripts_styles' );

/**
* Creates the "Portfolio" (grunwell_portfolio) custom post type
* @return void
* @uses register_post_type()
*/
function grunwell_create_portfolio_post_type() {
  $args = array(
    'can_export' => true,
    'has_archive' => false,
    'hierarchical' => false,
    'labels' => array(
      'name' => 'Portfolio',
      'singular_name' => 'Portfolio piece',
      'add_new' => 'Add new',
      'all_items' => 'All entries',
      'add_new_item' => 'New entry',
      'edit_item' => 'Edit entry',
      'new_item' => 'New entry',
      'view_item' => 'View entry',
      'search_items' => 'Search portfolio',
      'not_found' => 'No portfolio entries found',
      'not_found_in_trash' => 'No portfolio entries found in trash',
      'parent_item_colon' => 'Portfolio',
      'menu_name' => 'Portfolio'
    ),
    'menu_icon' => null,
    'public' => true,
    'rewrite' => array(
      'slug' => 'portfolio',
      'with_front' => false
    ),
    'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
    'taxonomies' => array('post_tag')
  );
  register_post_type( 'grunwell_portfolio', $args );
  return;
}
add_action( 'init', 'grunwell_create_portfolio_post_type' );

/**
 * Array filter callback to remove 'current_page_parent' and 'current_page_ancestor' CSS classes from menu items
 * @param str $class A single CSS class
 * @return bool True if $class is not in $filter, false otherwise
 */
function grunwell_remove_active_nav_classes( $class ) {
  $filter = array('current_page_item', 'current_page_parent', 'current_page_ancestor');
  return ! in_array( $class, $filter );
}

/**
 * Don't highlight "Blog" in the primary navigation when we're looking at grunwell_portfolio pages
 * @global $post
 * @param array $classes CSS classes to be applied to $item
 * @param object $item The WordPress menu item
 * @uses grunwell_remove_active_nav_classes()
 * @uses get_post_type()
 * @uses get_the_ID()
 * @see http://modal.us/blog/2011/04/28/single-custom-posts-can-highlight-nav-and-sub-nav-links-really/
 */
function grunwell_repair_nav_classes( $classes, $item ) {
  global $post;
  if ( get_post_type() === 'grunwell_portfolio' ) {
    if ( in_array( 'grunwell_portfolio', $classes ) ) {
      $classes[] = ( $item->ID == get_the_ID() ? 'current_page_parent' : 'current_page_ancestor' );
    } else { // Make sure nobody else has it
      $classes = array_filter( $classes, 'grunwell_remove_active_nav_classes' );
    }
  }
  return $classes;
}
add_action( 'nav_menu_css_class', 'grunwell_repair_nav_classes', 10, 2 );

/**
 * Register custom WordPress menu positions
 * @return void
 * @uses register_nav_menus()
 */
function grunwell_custom_menus() {
  register_nav_menus(
    array(
      'primary-nav' => 'Primary Navigation',
      'social-networks' => 'Social Networks'
    )
  );
  return;
}
add_action( 'init', 'grunwell_custom_menus' );

/**
 * Remove admin menus we don't need (Links)
 * @global $menu
 * @return void
 */
function grunwell_remove_menus() {
  global $menu;
  $restricted = array(__('Links'));
  end( $menu );
  while ( prev( $menu ) ){
    $value = explode( ' ', $menu[key( $menu )]['0'] );
    if ( in_array( ( $value['0'] != null ? $value['0'] : '' ) , $restricted ) ) {
      unset( $menu[key( $menu )] );
    }
  }
  return;
}
add_action( 'admin_menu', 'grunwell_remove_menus' );

/**
 * Get the tag for #site-logo
 * Will use a <h1> on the front page and <div> on the others
 * @return str
 * @uses esc_attr()
 * @uses get_bloginfo()
 * @uses home_url()
 * @uses is_front_page()
 */
function grunwell_sitelogo() {
  $tag = ( is_front_page() ? 'h1' : 'div' );
  return sprintf( '<%s id="site-logo" role="banner"><a href="%s" rel="home"><img src="%s/img/site-logo.svg" alt="%s" /></a></%s>', $tag, home_url( '/' ), get_bloginfo( 'template_url' ), esc_attr( get_bloginfo( 'template_url' ) ), $tag );
}

/**
 * Wrap "st" and "th" in <sup> (useful for dates)
 * @param $str The string to search/filter
 * @return str
 */
function grunwell_superscript_dates( $str ) {
  if ( preg_match_all( '/\d(st|nd|rd|th)/i', $str, $matches ) ) {
    foreach ( $matches['0'] as $k=>$v ) {
      $replacement = str_replace( $matches['1'][$k], sprintf( '<sup>%s</sup>', $matches['1'][$k] ), $v );
      $str = str_replace( $v, $replacement, $str );
    }
  }
  return $str;
}
add_filter( 'get_the_date', 'grunwell_superscript_dates' );

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
function grunwell_get_custom_field( $key, $id=false, $default='' ) {
  global $post;
  $key = trim( filter_var( $key, FILTER_SANITIZE_STRING ) );
  $result = '';

  if ( function_exists( 'get_field' ) ) {
    if ( intval( $id ) > 0 ){
      $result = get_field( $key, intval( $id ) );
    } elseif ( isset( $post->ID ) ) {
      $result = get_field( $key );
    }

    if ( $result == '' ) {
      $result = $default;
    }
  } else { // get_field() is undefined, most likely due to the plugin being inactive
    $result = $default;
  }
  return $result;
}

/** Shortcut for echo grunwell_get_custom_field() */
function grunwell_custom_field( $key, $id=false, $default='' ) {
  echo grunwell_get_custom_field( $key, $id, $default );
  return;
}

/**
 * Get Tweets using the SimpleTwitterTimeline class
 * @return array
 * @uses SimpleTwitterTimeline::get_timeline()
 */
function grunwell_get_tweets() {
  $tweets = array();
  if ( class_exists( 'SimpleTwitterTimeline' ) ) {
    $args = array(
      'exclude_replies' => false,
      'limit' => 3,
      'parse_links' => true,
      'use_cache' => true,
      'cache_path' => dirname( __FILE__ )
    );
    $twitter = new SimpleTwitterTimeline( 'stevegrunwell', $args );
    $tweets = $twitter->get_timeline();
  }
  return $tweets;
}

/**
 * Format client/agency information for the portfolio detail page
 * If a valid URL is provided, the client's name will be a link
 * @param str $name The client/agency name. If no name is provided, an empty string will be returned
 * @param str $city The client/agency city
 * @param str $url The client/agency website
 * @return str
 */
function grunwell_format_client_data( $name, $city, $url ) {
  if ( $name ) {
    $return = ( $url && filter_var( $url, FILTER_VALIDATE_URL ) ? sprintf( '<a href="%s" class="company" rel="external">%s</a>', $url, $name ) : sprintf( '<span class="company">%s</span> ', $name ) );
    if ( $city ) {
      $return .= sprintf( '<span class="city">%s</span>', $city );
    }
  }
  return ( $name ? sprintf( '<p>%s</p>', trim( $return ) ) : '' );
}

?>