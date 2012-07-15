<?php
/**
 * Default loop
 * @package WordPress
 * @subpackage grunwell2012
 * @author Steve Grunwell <steve@stevegrunwell.com>
 */
?>

<?php while ( have_posts() ): the_post(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <h2 class="post-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
  <?php if ( is_single() ) : ?>
  <div class="entry-meta">
    <?php the_date(); ?>
  </div>
  <?php endif; ?>

  <?php the_excerpt(); ?>

  <div class="entry-utility">
    <?php comments_template( '', true ); ?>
  </div>
</article><!--// #post-<?php the_ID(); ?>-->

<?php endwhile; ?>
