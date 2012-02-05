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
<meta charset="<?php bloginfo('charset'); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<title><?php echo grunwell_page_title('|'); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_url'); ?>" />
<?php
  wp_enqueue_script('site-scripts');
  wp_head();
?>
</head>

<body <?php body_class(); ?>>
  <div id="wrapper">
    <header>
      <?php echo get_search_form(); ?>
      <?php echo grunwell_sitelogo('<a href="' . home_url('/') . '" rel="home">' . get_bloginfo('name') . '</a>'); ?>

      <?php
        $args = array(
          'container' => 'nav',
          'container_id' => 'primary-nav',
          'menu' => 'primary-nav'
        );
        wp_nav_menu($args);
      ?>
    </header>

    <div id="content">
