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

  <?php if ( $tag_description = tag_description() ) : ?>
  <dl>
    <dt class="screen-reader-text"><?php single_tag_title( '', true ); ?></dt>
    <dd><?php echo $tag_description; ?></dd>
  </dl>
  <?php endif; ?>

  <?php get_template_part( 'loop', 'index' ); ?>

</div><!-- // #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
