<?php
/**
 * Basic page template
 * @package WordPress
 * @subpackage grunwell2012
 * @author Steve Grunwell <steve@stevegrunwell.com>
 */

get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

  <article id="post-<?php the_ID(); ?>" <?php post_class( 'primary' ); ?> role="main">
    <h1 class="post-title"><?php grunwell_custom_field( 'alternate_headline', $post->ID, get_the_title() ); ?></h1>
    <?php the_content(); ?>
  </article><!--// #post-<?php the_ID(); ?>-->

<?php endwhile; ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
