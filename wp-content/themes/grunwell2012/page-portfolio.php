<?php
/**
 * Template for /portfolio/
 * @package WordPress
 * @subpackage grunwell2012
 * @author Steve Grunwell <steve@stevegrunwell.com>
 */

get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

  <div class="primary" role="main">
    <h1 class="post-title"><?php grunwell_custom_field( 'alternate_headline', $post->ID, get_the_title() ); ?></h1>

    <?php the_content(); ?>

    <?php
      $args = array(
        'orderby' => 'menu_order',
        'order' => 'asc',
        'post_type' => 'grunwell_portfolio'
      );
    ?>
  <?php foreach ( get_posts( $args ) as $post ): setup_postdata( $post ); ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
      <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
      <?php if ( has_post_thumbnail() ) : ?>
        <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'portfolio-thumb', array( 'class' => 'alignright' ) ); ?></a>
      <?php endif; ?>
      <?php the_excerpt(); ?>
      <?php echo get_the_tag_list( '<p>Tags: ', ', ', '</p>' ); ?>
    </article><!-- #post-<?php the_ID(); ?> -->

  <?php endforeach; ?>

  </div><!-- .primary -->

<?php endwhile; ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
