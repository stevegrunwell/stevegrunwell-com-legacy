<?php
/**
 * Theme header
 * @package WordPress
 * @subpackage grunwell2012
 * @author Steve Grunwell <steve@stevegrunwell.com>
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title><?php wp_title( '' ); ?></title>
<?php
  wp_enqueue_style( 'site-styles' );
  wp_enqueue_script( 'modernizr' );
  wp_enqueue_script( 'site-scripts' );
  wp_head();
?>
</head>

<body <?php body_class(); ?>>
  <div id="wrapper">
    <header role="banner">
      <a href="#content" class="screen-reader-text">Skip to main content</a>
      <?php echo get_search_form(); ?>

      <?php
        $args = array(
          'container' => false,
          'depth' => 1,
          'menu' => 'social-networks',
          'menu_class' => 'social'
        );
        wp_nav_menu( $args );
      ?>

      <?php echo grunwell_sitelogo(); ?>

      <nav id="primary-nav" role="navigation">
        <?php
          $args = array(
            'container' => false,
            'menu' => 'primary-nav'
          );
          wp_nav_menu( $args );
        ?>
      </nav>
    </header>

    <div id="content">
