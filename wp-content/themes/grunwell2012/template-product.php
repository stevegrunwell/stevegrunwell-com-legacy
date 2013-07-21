<?php
/**
 * Template Name: Product Page
 *
 * Used for a product or plugin
 *
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

<?php if ( $sidebar_content = grunwell_get_custom_field( 'sidebar_content', null, false ) ) : ?>

<div class="secondary" role="complementary">

  <?php echo $sidebar_content; ?>

</div><!-- .secondary -->

<?php endif; ?>

<?php get_footer(); ?>