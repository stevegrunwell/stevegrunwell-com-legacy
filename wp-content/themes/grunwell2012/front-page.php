<?php
/**
 * Basic page template
 * @package WordPress
 * @subpackage grunwell2012
 * @author Steve Grunwell <steve@stevegrunwell.com>
 */

get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

  <div id="post-<?php the_ID(); ?>" <?php post_class( 'primary' ); ?> role="main">
    <?php the_content(); ?>

    <h2>Latest Blog Posts</h2>
    <?php foreach ( get_posts( array( 'numberposts' => 3, 'post_status' => 'publish' ) ) as $post ) : setup_postdata( $post ); ?>

      <h3 class="post-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
      <?php the_excerpt(); ?>

    <?php endforeach; ?>
    <?php wp_reset_postdata(); ?>
  </div><!--// #post-<?php the_ID(); ?>-->

<?php endwhile; ?>

<?php get_sidebar( 'front' ); ?>
<?php get_footer(); ?>
