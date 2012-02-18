<?php
/**
 * Loop for the search results template
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

  <h1>Search results for "<?php the_search_query(); ?>"</h1>

  <?php while( have_posts() ): the_post(); ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
      <h2 class="post-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>

      <?php the_excerpt(); ?>

    </article><!--// #post-<?php the_ID(); ?>-->

  <?php endwhile; ?>

<?php endif; ?>