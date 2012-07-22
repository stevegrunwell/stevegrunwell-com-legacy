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

  <?php get_template_part( 'loop', 'index' ); ?>

</div><!-- // #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
