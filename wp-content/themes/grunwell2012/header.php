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
<?php
  wp_enqueue_style( 'site-styles' );
  wp_enqueue_style( 'ie8-fixes' );
  wp_enqueue_script( 'modernizr' );
  wp_enqueue_script( 'site-scripts' );
  wp_head();
?>
<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-9214996-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>
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
