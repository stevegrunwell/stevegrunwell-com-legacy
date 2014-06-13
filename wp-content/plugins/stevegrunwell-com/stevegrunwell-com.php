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

    add_filter( 'rewrite_rules_array', array( &$this, 'add_rewrite_rules' ) );
    add_filter( 'post_type_link', array( &$this, 'filter_post_type_link' ), 10, 2 );
  }

  /**
   * Tell WordPress how to interpret our speaking/ URL structure
   *
   * @param array $rules Existing rewrite rules
   * @return array
   */
  public function add_rewrite_rules( $rules ) {
    $new = array();
    $new['speaking/feed/?$'] = 'index.php?post_type=grunwell_talk&feed=rss2';
    $new['speaking/([^/]+)/?$'] = 'index.php?grunwell_talk=$matches[1]';

    return array_merge( $new, $rules ); // Ensure our rules come first
  }

  /**
   * Handle the '%grunwell_talk%' URL placeholder
   *
   * @param str $link The link to the post
   * @param WP_Post object $post The post object
   * @return str
   */
  public function filter_post_type_link( $link, $post ) {
    if ( $post->post_type == 'grunwell_talk' ) {
      if ( $cats = get_the_terms( $post->ID, 'grunwell_talk' ) ) {
        $link = str_replace( '%grunwell_talk%', $post->post_name, $link );
      }
    }
    return $link;
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
      'menu_icon' => 'dashicons-desktop',
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
      'feeds' => true,
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
      'menu_icon' => 'dashicons-megaphone',
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