<?php
/**
 * Tag archive template
 * @package WordPress
 * @subpackage grunwell2012
 * @author Steve Grunwell <steve@stevegrunwell.com>
 */

get_header(); ?>

<div class="primary" role="main">

  <h1>Posts tagged "<?php single_tag_title( '', true ); ?>"</h1>

  <?php get_template_part( 'loop', 'index' ); ?>

</div><!-- // #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
