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
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title><?php wp_title(''); ?></title>
<?php
  wp_enqueue_style('site-styles');
  wp_enqueue_script('site-scripts');
  wp_head();
?>
</head>

<body <?php body_class(); ?>>
  <div id="wrapper">
    <header>
      <a href="#content" class="screen-reader-text">Skip to main content</a>
      <?php echo get_search_form(); ?>
      <ul class="social">
        <li><a href="#" class="twitter" title="Twitter">Twitter</a></li>
        <li><a href="#" class="github" title="Github">Github</a></li>
        <li><a href="#" class="facebook" title="Facebook">Facebook</a></li>
        <li><a href="#" class="googleplus" title="Google+">Google<abbr title="plus">+</abbr></a></li>
        <li><a href="#" class="flickr" title="Flickr">Flickr</a></li>
        <li><a href="#" class="linkedin" title="LinkedIn">LinkedIn</a></li>
      </ul>
      <?php echo grunwell_sitelogo(); ?>

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
