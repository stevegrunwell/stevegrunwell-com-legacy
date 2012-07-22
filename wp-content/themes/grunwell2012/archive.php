<?php
/**
 * Generic template file
 * @package WordPress
 * @subpackage grunwell2012
 * @author Steve Grunwell <steve@stevegrunwell.com>
 */

get_header(); ?>

<div class="primary" role="main">

<?php if ( is_day() ) : ?>
  <?php printf( '<h1>Blog posts from <span>%s</span></h1>', get_the_date( 'F jS, Y' ) ); ?>
<?php elseif ( is_month() ) : ?>
  <?php printf( '<h1>Blog posts from <span>%s</span></h1>', get_the_date( 'F Y' ) ); ?>
<?php elseif ( is_year() ) : ?>
  <?php printf( '<h1>Blog posts from <span>%s</span></h1>', get_the_date( 'Y' ) ); ?>
<?php else : ?>
  <h1>Blog archive</h1>
<?php endif; ?>

  <?php get_template_part( 'loop', 'archive' ); ?>

</div><!-- // #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
