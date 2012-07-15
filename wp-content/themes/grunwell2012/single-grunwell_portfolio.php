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

<div class="secondary" role="complementary">

<?php if ( $content = grunwell_get_custom_field( 'sidebar_content', null, false ) ) : ?>

  <?php echo $content; ?>

<?php else : ?>

  <?php if ( $dates = grunwell_get_custom_field( 'dates', null, false ) ) : ?>
    <h2>Dates</h2>
    <p><?php echo $dates; ?></p>
  <?php endif; ?>

  <?php if ( $client_name = grunwell_get_custom_field( 'client_name', null, false ) ) : ?>
    <h2>Client</h2>
    <?php echo grunwell_format_client_data( $client_name, grunwell_get_custom_field( 'client_city' ), grunwell_get_custom_field( 'client_url' ) ); ?>
  <?php endif; ?>

  <?php if ( $agency_name = grunwell_get_custom_field( 'agency_name', null, false ) ) : ?>
    <h2>Agency</h2>
    <?php echo grunwell_format_client_data( $client_name, grunwell_get_custom_field( 'agency_city' ), grunwell_get_custom_field( 'agency_url' ) ); ?>
  <?php endif; ?>

<?php endif; ?>

  <?php echo get_the_tag_list( '<h2>Tags</h2><p>', ', ', '</p>' ); ?>

</div><!-- .secondary -->

<?php get_footer(); ?>
