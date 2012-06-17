<?php
/**
 * Search result template
 * @package WordPress
 * @subpackage grunwell2012
 * @author Steve Grunwell <steve@stevegrunwell.com>
 */

get_header(); ?>

<div class="primary" role="main">

  <?php get_template_part( 'loop', 'search' ); ?>

</div><!-- // .primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
