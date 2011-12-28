<?php
/**
 * Default loop
 * @package WordPress
 * @subpackage grunwell2012
 * @author Steve Grunwell <steve@stevegrunwell.com>
 */
?>

<?php if( !have_posts() ): ?>

  <div class="post">
    <h1>No posts found</h1>
    <p>There were no posts that matched your search criteria.</p>
    <?php get_search_form(); ?>
  </div>

<?php else: ?>

  <?php while( have_posts() ): the_post(); ?>

  <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <h2 class="post-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
    <div class="entry-meta">
      <?php grunwell_the_date(); ?>
    </div>

    <?php the_excerpt(); ?>

    <div class="entry-utility">
      <?php comments_template('', true); ?>
    </div>
  </article><!--// #post-<?php the_ID(); ?>-->

  <?php endwhile; ?>

<?php endif; ?>

