<?php
/**
 * A single portfolio entry
 * @package WordPress
 * @subpackage grunwell2012
 * @author Steve Grunwell <steve@stevegrunwell.com>
 */

get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

  <article id="post-<?php the_ID(); ?>" <?php post_class( 'primary' ); ?> role="main">
    <h1 class="post-title"><?php the_title(); ?></h1>

    <?php the_content(); ?>

  </article><!--// #post-<?php the_ID(); ?>-->

<?php endwhile; ?>

<?php get_sidebar( 'portfolio' ); ?>
<?php get_footer(); ?>
