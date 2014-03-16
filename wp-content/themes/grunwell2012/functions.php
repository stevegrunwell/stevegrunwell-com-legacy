<?php
/**
 * Theme functions
 * @package WordPress
 * @subpackage grunwell2012
 * @author Steve Grunwell <steve@stevegrunwell.com>
 */

require_once dirname( __FILE__ ) . '/functions/advanced-custom-fields.php';

/**
 * Register scripts and styles
 * @uses grunwell_get_current_git_commit()
 * @uses wp_register_script()
 * @uses wp_register_style()
 */
function grunwell_register_scripts_styles() {
  global $wp_styles;
  $hash = grunwell_get_current_git_commit( 8 );

  # Styles
  wp_register_style( 'site-styles', get_bloginfo( 'template_url' ) . '/css/style.css', null, $hash, 'all' );
  wp_register_style( 'ie8-fixes', get_bloginfo('template_url') . '/css/ie8.css', array( 'site-styles' ), $hash, 'all' );
  $wp_styles->add_data( 'ie8-fixes', 'conditional', 'lte IE 8' );

  # Scripts
  wp_register_script( 'site-scripts', get_bloginfo( 'template_url' ) . '/js/main.js', array( 'jquery', 'jquery-flexslider', 'jquery-placeholder' ), $hash, true );

  # Third-party

  // jQuery Placeholder - https://github.com/mathiasbynens/jquery-placeholder
  wp_register_script( 'jquery-placeholder', get_bloginfo( 'template_url' ) . '/js/jquery.placeholder.min.js', array( 'jquery' ), '1.8.7', true );

  // jQuery Fancybox
  wp_register_style( 'jquery-fancybox', get_bloginfo( 'template_url' ) . '/css/jquery.fancybox.css', null, '2.0.6', 'screen' );
  wp_register_script( 'jquery-fancybox', get_bloginfo( 'template_url' ) . '/js/jquery.fancybox.pack.js', array( 'jquery' ), '2.0.6', true );

  // jQuery Flexslider - http://www.woothemes.com/flexslider/
  wp_register_script( 'jquery-flexslider', get_bloginfo( 'template_url' ) . '/js/jquery.flexslider.min.js', array( 'jquery' ), '1.8', true );

  // Modernizr
  wp_register_script( 'modernizr', get_bloginfo( 'template_url' ) . '/js/modernizr.min.js', null, '2.6.1', false );

  if ( ! is_admin() && ! is_login_page() ) {
    wp_enqueue_style( 'site-styles' );
    wp_enqueue_style( 'ie8-fixes' );
    wp_enqueue_script( 'modernizr' );
    wp_enqueue_script( 'site-scripts' );
  }
}
add_action( 'init', 'grunwell_register_scripts_styles' );

/** Enable post thumbnails */
add_theme_support( 'post-thumbnails' );

/** Page excerpts */
add_post_type_support( 'page', 'excerpt' );

add_image_size( 'portfolio-slider', 640, 400, true );
add_image_size( 'portfolio-thumb', 320, 200, true );

/**
 * Include grunwell_portfolio and grunwell_talk posts in tag archives
 * @param object $query The WP_Query object
 * @return object
 * @see http://wordpress.org/support/topic/custom-post-type-tagscategories-archive-page#post-1569857
 */
function grunwell_query_post_type( $query ) {
  if ( is_category() || is_tag() ) {
    if ( ! $post_type = get_query_var( 'post_type' ) ) {
      $post_type = array( 'post', 'page', 'nav_menu_item', 'grunwell_portfolio', 'grunwell_talk' );
    }
    $query->set( 'post_type', $post_type );
  }
  return $query;
}
add_filter( 'pre_get_posts', 'grunwell_query_post_type' );

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
  $post_type = get_post_type();
  if ( in_array( $post_type, array( 'grunwell_portfolio', 'grunwell_talk' ) ) ) {
    if ( in_array( $post_type, $classes ) ) {
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
 * Remove the protocol and server name from a URL, making a relative link
 * @param str $url - The URL to make relative
 * @return str
 */
function grunwell_make_relative_link( $url ) {
  return preg_replace( sprintf( '/http(s)?:\/\/%s\//i', $_SERVER['SERVER_NAME'] ), '/', $url );
}
add_filter( 'the_permalink', 'grunwell_make_relative_link' );
add_filter( 'wp_get_attachment_url', 'grunwell_make_relative_link' );

/** Remove some of the items in <head> that we don't need/want */
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );

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
  return sprintf( '<%s id="site-logo"><a href="%s" rel="home"><img src="%s/img/site-logo.svg" alt="%s" /></a></%s>', $tag, home_url( '/' ), get_bloginfo( 'template_url' ), esc_attr( get_bloginfo( 'template_url' ) ), $tag );
}

/**
 * Get the admin's gravatar and use it as the site's favicon
 * @param str $email The email address to use for the gravatar
 * @uses get_option()
 */
function grunwell_gravatar_as_favicon( $email=false ) {
  if ( ! $email ) {
    $email = get_option( 'admin_email' );
  }
  printf( '<link href="//www.gravatar.com/avatar/%s?s=16" rel="shortcut icon" />' . PHP_EOL, md5( strtolower( trim( $email ) ) ) );
}
add_action( 'wp_head', 'grunwell_gravatar_as_favicon' );

/**
 * Use the admin email's gravatar as the apple-touch-icon meta tag
 * @param str $email The email address to use for the gravatar
 * @uses get_option()
 */
function grunwell_gravatar_as_apple_touch_icon( $email=false ) {
  if ( ! $email ) {
    $email = get_option( 'admin_email' );
  }
  printf( '<link href="//www.gravatar.com/avatar/%s?s=144" rel="apple-touch-icon" />' . PHP_EOL, md5( strtolower( trim( $email ) ) ) );
}
add_action( 'wp_head', 'grunwell_gravatar_as_apple_touch_icon' );

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
add_filter( 'the_content', 'grunwell_superscript_dates' );

/**
 * Get a custom field stored in the Advanced Custom Fields plugin
 * By running it through this function, we ensure that we don't die if the plugin is uninstalled/disabled (and thus the function is undefined)
 * @global $post
 * @param str $key The key to look for
 * @param mixed $id The post ID (int|str, defaults to $post->ID)
 * @param mixed $default What to return if there's nothing
 * @return mixed (dependent upon $echo)
 * @uses get_field()
 */
function grunwell_get_custom_field( $key, $id=false, $default='' ) {
  global $post;
  $key = trim( filter_var( $key, FILTER_SANITIZE_STRING ) );
  $result = '';

  if ( function_exists( 'get_field' ) ) {
    $result = ( isset( $post->ID ) && ! $id ? get_field( $key ) : get_field( $key, $id ) );

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
 * Get specified $fields from the repeater with slug $key
 * @global $post
 * @param str $key The custom field slug of the repeater
 * @param int $id The post ID (will use global $post if not specified)
 * @param array $fields The sub-fields to retrieve
 * @return array
 * @uses get_custom_field()
 * @uses has_sub_field()
 * @uses get_sub_field()
 */
function grunwell_get_repeater_content( $key, $id=null, $fields=array() ) {
  global $post;
  if ( ! $id ) $id = $post->ID;
  $values = array();

  if ( grunwell_get_custom_field( $key, $id, false ) && function_exists( 'has_sub_field' ) && function_exists( 'get_sub_field' ) ) {
    while ( has_sub_field( $key, $id ) ) {
      $value = array();
      foreach ( $fields as $field ){
        $value[$field] = get_sub_field( $field );
      }
      if( ! empty( $value ) ) {
        $values[] = $value;
      }
    }
  }
  return $values;
}

/**
 * Format a tweet from Display Tweets
 * @param object $tweet
 * @return void
 */
function grunwell_format_tweet( $tweet ) {
  $time = strtotime( $tweet->created_at );
  printf( '<li class="tweet">%s<time datetime="%s" title="%s">%s ago</time></li>', $tweet->text, date( 'Y-m-d H:i:s', $time ), date( 'M jS, Y @ g:ia', $time ), human_time_diff( $time, time() ) );
}
add_action( 'displaytweets_tweet_template', 'grunwell_format_tweet' );

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

/** Don't put the date in post meta descriptions */
add_filter( 'wpseo_show_date_in_snippet_preview', '__return_false' );

/**
 * Return a different label depending on the value of $count
 * Will send the label through sprintf() so we can do things like '%d posts' with $count
 * @param str $none Label when $count = 0
 * @param str $one Label when $count = 1
 * @param str $more Label when $count > 1
 * @param int $count
 * @return str
 */
function grunwell_string_plurals( $none='', $one='', $more='', $count=0 ) {
  $count = intval( $count );
  $label = $more;
  if ( $count <= 0 ) {
    $label = $none;
  } elseif ( $count === 1 ) {
    $label = $one;
  }
  return sprintf( $label, $count );
}

/**
 * Format post comments (heavily based on twentyten_comment)
 * @todo I really don't like mixing HTML and PHP like this...
 */
function grunwell_comment( $comment, $args, $depth ) {
  $GLOBALS['comment'] = $comment;
  if ( $comment->comment_type == '' ) : // We don't care about pingbacks
?>

  <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
    <div id="comment-<?php comment_ID(); ?>" class="comment-content">
      <div class="comment-author vcard">
        <?php echo get_avatar( $comment, 48 ); ?>
        <cite class="fn"><?php comment_author_link(); ?></cite>
        <span class="comment-date" title="<?php printf( '%s at %s', get_comment_date(), get_comment_time() ); ?>"><?php printf( '%s ago',  human_time_diff( get_comment_time( 'U' ), current_time( 'timestamp' ) ) ); ?></span>
      </div>
      <?php if ( ! $comment->comment_approved ) : ?>
        <em class="awaiting-moderation">Your comment is awaiting moderation</em>
      <?php endif; ?>

      <?php comment_text(); ?>

      <div class="utility">
        <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
        <?php edit_comment_link( 'Edit comment', ' <span class="sep">|</span> ' ); ?>
      </div><!-- .utility -->
    </div><!-- #comment-<?php comment_ID(); ?> -->

<?php
  endif;
}

/**
 * Get the hash of the current git HEAD
 * @global GRUNWELL_CURRENT_GIT_COMMIT
 * @param int $length Optionally only return the first $length characters of the hash
 * @return mixed Either the hash or a boolean false
 */
function grunwell_get_current_git_commit( $length=false ) {
  if ( ! defined( 'GRUNWELL_CURRENT_GIT_COMMIT' ) ) {
    $file = ABSPATH . 'REVISION'; // Let Capistrano work for us!
    if ( is_readable( $file ) ) {
      $hash = trim( file_get_contents( $file ) );
    } else {
      $hash = false;
    }
    define( 'GRUNWELL_CURRENT_GIT_COMMIT', $hash );
  }
  return ( $length ? substr( GRUNWELL_CURRENT_GIT_COMMIT, 0, $length ) : GRUNWELL_CURRENT_GIT_COMMIT );
}

/**
 * Add the current git HEAD to the <head> element
 * @uses grunwell_get_current_git_commit()
 */
function grunwell_show_repository_data() {
  if ( $hash = grunwell_get_current_git_commit( 8 ) ) {
    printf( "<!-- This site's source is available at https://github.com/stevegrunwell/stevegrunwell-com - HEAD is currently at %s -->\n", $hash );
  }
}
add_action( 'wp_head', 'grunwell_show_repository_data' );

/**
 * Generate pagination to use on archive-style templates - will echo directly to the page
 * @return void
 * @uses get_next_posts_link()
 * @uses get_previous_posts_link()
 */
function grunwell_pagination() {
  printf( '<ul class="pagination clearfix"><li class="prev">%s</li><li class="next">%s</li></ul>', get_previous_posts_link(), get_next_posts_link() );
  return;
}

/**
 * Check to see if the current page is the login/register page
 * Use this in conjunction with is_admin() to separate the front-end from the back-end of your theme
 * @return bool
 */
if ( ! function_exists( 'is_login_page' ) ) {
  function is_login_page() {
    return in_array( $GLOBALS['pagenow'], array( 'wp-login.php', 'wp-register.php' ) );
  }
}