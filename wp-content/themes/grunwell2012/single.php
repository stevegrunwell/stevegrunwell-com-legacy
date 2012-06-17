<?php
/**
 * Basic page template
 * @package WordPress
 * @subpackage grunwell2012
 * @author Steve Grunwell <steve@stevegrunwell.com>
 */

wp_enqueue_style( 'syntax-highlighter-default' );
the_post();
get_header(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'primary' ); ?> role="main">

  <h1 class="post-title"><?php the_title(); ?></h1>
  <div class="entry-meta">
    Posted <?php the_date(); ?>
  </div>

  <?php the_content(); ?>

  <div class="entry-utility">
    <?php comments_template( '', true ); ?>
  </div>

</article><!--// #post-<?php the_ID(); ?>-->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
