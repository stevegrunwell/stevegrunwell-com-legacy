<?php
/**
 * Plugin Name: SteveGrunwell.com
 * Plugin URI: http://stevegrunwell.com/
 * Description: Site features for http://stevegrunwell.com
 * Version: 1.0
 * Author: Steve Grunwell
 * Author URI: http://stevegrunwell.com
 * License: GPL2
 *
 * @package WordPress
 * @subpackage SteveGrunwell.com
 * @author Steve Grunwell
 */

class SteveGrunwell {

  /**
   * Class constructor
   */
  public function __construct() {
    $this->register_portfolio_cpt();
    $this->register_talk_cpt();
  }

  /**
   * Creates the "Portfolio" (grunwell_portfolio) custom post type
   * @return void
   * @uses register_post_type()
   */
  protected function register_portfolio_cpt() {
    $args = array(
      'can_export' => true,
      'has_archive' => false,
      'hierarchical' => false,
      'labels' => array(
        'name' => __( 'Portfolio', 'stevegrunwell' ),
        'singular_name' => __( 'Portfolio piece', 'stevegrunwell' ),
        'add_new' => __( 'Add new', 'stevegrunwell' ),
        'all_items' => __( 'All entries', 'stevegrunwell' ),
        'add_new_item' => __( 'New entry', 'stevegrunwell' ),
        'edit_item' => __( 'Edit entry', 'stevegrunwell' ),
        'new_item' => __( 'New entry', 'stevegrunwell' ),
        'view_item' => __( 'View entry', 'stevegrunwell' ),
        'search_items' => __( 'Search portfolio', 'stevegrunwell' ),
        'not_found' => __( 'No portfolio entries found', 'stevegrunwell' ),
        'not_found_in_trash' => __( 'No portfolio entries found in trash', 'stevegrunwell' ),
        'parent_item_colon' => __( 'Portfolio', 'stevegrunwell' ),
        'menu_name' => __( 'Portfolio', 'stevegrunwell' )
      ),
      'menu_icon' => null,
      'public' => true,
      'rewrite' => array(
        'slug' => 'portfolio',
        'with_front' => false
      ),
      'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt', 'page-attributes' ),
      'taxonomies' => array( 'post_tag' )
    );
    register_post_type( 'grunwell_portfolio', $args );
    return;
  }

  /**
   * Creates the "Talk" (grunwell_talk) custom post type
   * @return void
   * @uses register_post_type()
   */
  protected function register_talk_cpt() {
    $args = array(
      'can_export' => true,
      'has_archive' => false,
      'hierarchical' => false,
      'labels' => array(
        'name' => __( 'Talks', 'stevegrunwell' ),
        'singular_name' => __( 'Talk', 'stevegrunwell' ),
        'add_new' => __( 'Add new', 'stevegrunwell' ),
        'all_items' => __( 'All talks', 'stevegrunwell' ),
        'add_new_item' => __( 'New talk', 'stevegrunwell' ),
        'edit_item' => __( 'Edit talk', 'stevegrunwell' ),
        'new_item' => __( 'New talk', 'stevegrunwell' ),
        'view_item' => __( 'View talk', 'stevegrunwell' ),
        'search_items' => __( 'Search talks', 'stevegrunwell' ),
        'not_found' => __( 'No talks found', 'stevegrunwell' ),
        'not_found_in_trash' => __( 'No talks found in trash', 'stevegrunwell' ),
        'parent_item_colon' => __( 'Talks', 'stevegrunwell' ),
        'menu_name' => __( 'Talks', 'stevegrunwell' )
      ),
      'menu_icon' => null,
      'public' => true,
      'rewrite' => array(
        'slug' => 'speaking',
        'with_front' => false
      ),
      'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt', 'page-attributes' ),
      'taxonomies' => array( 'post_tag' )
    );
    register_post_type( 'grunwell_talk', $args );
    return;
  }
}

$stevegrunwell;

/**
 * Bootstrap the plugin
 * @global $stevegrunwell
 * @return void
 */
function stevegrunwell_init() {
  global $stevegrunwell;
  $stevegrunwell = new SteveGrunwell;
  return;
}
add_action( 'init', 'stevegrunwell_init' );