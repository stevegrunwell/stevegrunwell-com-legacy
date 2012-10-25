<?php
/**
 * Basic page template
 * @package WordPress
 * @subpackage grunwell2012
 * @author Steve Grunwell <steve@stevegrunwell.com>
 */

wp_enqueue_style( 'syntax-highlighter-default' );
the_post();
get_header(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'primary' ); ?> role="main">

  <?php get_template_part( 'loop', 'single' ); ?>

</article><!--// #post-<?php the_ID(); ?>-->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
