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
<title><?php echo grunwell_page_title('|'); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_url'); ?>" />
<?php
  wp_enqueue_script('site-scripts', get_bloginfo('template_url') . '/js/main.js', array('jquery'), '', true);
  wp_head();
?>
</head>

<body <?php body_class(); ?>>
  <div id="wrapper">
    <header>
      <?php echo grunwell_sitelogo('<a href="' . home_url('/') . '" rel="home">' . get_bloginfo('name') . '</a>'); ?>
    </header>

    <div id="content">
