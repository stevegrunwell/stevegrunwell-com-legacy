<?php
/**
 * Content styles for grunwell_talk posts
 * @package WordPress
 * @subpackage grunwell2012
 * @author Steve Grunwell <steve@stevegrunwell.com>
 */

if ( ! is_single() ) : ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <?php if ( $date = grunwell_get_custom_field( 'event_date', get_the_ID(), false ) ) : ?>
  <h3 class="event-date"><?php echo date( 'F j, Y', strtotime( $date ) ); ?></h3>
  <?php endif; ?>
  <h4 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
  <?php the_excerpt(); ?>
  <?php echo get_the_tag_list( '<p>Tags: ', ', ', '</p>' ); ?>
</article><!--// #post-<?php the_ID(); ?>-->

<?php endif; ?>