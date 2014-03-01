<?php
/**
 * Theme header
 * @package WordPress
 * @subpackage grunwell2012
 * @author Steve Grunwell <steve@stevegrunwell.com>
 */
?><!DOCTYPE html>
<!--[if IE 8 ]><html class="no-js ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html class="no-js" <?php language_attributes(); ?>><!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title><?php wp_title( '' ); ?></title>
<link rel="profile" href="http://microformats.org/profile/hcard" />
<link rel="profile" href="http://microformats.org/profile/hcalendar" />
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <div id="wrapper">
    <header role="banner">
      <a href="#content" class="screen-reader-text">Skip to main content</a>

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
