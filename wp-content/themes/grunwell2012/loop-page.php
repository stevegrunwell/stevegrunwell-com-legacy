<?php
/**
 * Loop for a single page
 * @package WordPress
 * @subpackage grunwell2012
 * @author Steve Grunwell <steve@stevegrunwell.com>
 */
?>

<?php while( have_posts() ): the_post(); ?>

  <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <h1 class="post-title"><?php grunwell_custom_field('alternate_headline', $post->ID, get_the_title()); ?></h1>

    <?php the_content(); ?>

  </article><!--// #post-<?php the_ID(); ?>-->

<?php endwhile; ?>

