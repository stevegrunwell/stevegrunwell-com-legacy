<?php
/**
 * Default loop
 * @package WordPress
 * @subpackage grunwell2012
 * @author Steve Grunwell <steve@stevegrunwell.com>
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php if ( is_single() ) : ?>

  <h1 class="post-title"><?php the_title(); ?></h1>
  <div class="entry-meta">
    Posted <?php the_date(); ?>
  </div>

  <?php the_content(); ?>

  <?php echo get_the_tag_list( '<p class="post-tags"><strong>Tags:</strong> ', ', ', '</p>' ); ?>

  <div class="entry-utility">
    <?php comments_template( '', true ); ?>
  </div>

<?php else : ?>

  <h2 class="post-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
  <?php the_excerpt(); ?>

<?php endif; ?>
</article><!--// #post-<?php the_ID(); ?>-->
