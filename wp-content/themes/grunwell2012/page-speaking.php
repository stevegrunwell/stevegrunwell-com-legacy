<?php
/**
 * Template for /speaking/
 * @package WordPress
 * @subpackage grunwell2012
 * @author Steve Grunwell <steve@stevegrunwell.com>
 */

$args = array(
  'numberposts' => -1,
  'post_type' => 'grunwell_talk',
  'order' => 'ASC',
  'orderby' => 'meta_value_num',
  'meta_query' => array(
    array(
      'key' => 'event_date',
      'value' => date( 'Y-m-d H:i:s' ),
      'compare' => '>=',
      'type' => 'DATE'
    )
  )
);
$upcoming = new WP_Query( $args );

$args['order'] = 'DESC';
$args['meta_query']['0']['compare'] = '<';
$previous = new WP_Query( $args );

get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

  <div class="primary" role="main">
    <h1 class="post-title"><?php grunwell_custom_field( 'alternate_headline', $post->ID, get_the_title() ); ?></h1>

    <?php the_content(); ?>

  <?php if ( $upcoming->have_posts() ) : ?>
    <h2><?php _e( 'Upcoming talks', 'grunwell-2012' ); ?></h2>
    <ul class="post-list upcoming">
    <?php while ( $upcoming->have_posts() ) : $upcoming->the_post(); ?>

      <?php get_template_part( 'loop', 'grunwell_talk' ); ?>

    <?php endwhile; ?>
    </ul><!-- .upcoming.post-list -->
  <?php endif; ?>

  <?php if ( $previous->have_posts() ) : ?>
    <h2><?php _e( 'Previous talks', 'grunwell-2012' ); ?></h2>
    <ul class="post-list upcoming">
    <?php while ( $previous->have_posts() ) : $previous->the_post(); ?>

      <?php get_template_part( 'loop', 'grunwell_talk' ); ?>

    <?php endwhile; ?>
    </ul><!-- .upcoming.post-list -->
  <?php endif; ?>

  <?php wp_reset_postdata(); ?>

  </div><!-- .primary -->

<?php endwhile; ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>