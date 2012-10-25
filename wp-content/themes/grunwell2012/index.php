<?php
/**
 * Generic template file
 * @package WordPress
 * @subpackage grunwell2012
 * @author Steve Grunwell <steve@stevegrunwell.com>
 */

get_header(); ?>

<div class="primary" role="main">

  <h1>Latest blog posts</h1>

  <?php while ( have_posts() ) : the_post(); ?>

    <?php get_template_part( 'loop', 'index' ); ?>

  <?php endwhile; ?>

  <?php grunwell_pagination(); ?>

</div><!-- // #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
