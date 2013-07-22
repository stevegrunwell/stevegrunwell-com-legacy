<?php
/**
 * A single grunwell_talk
 * @package WordPress
 * @subpackage grunwell2012
 * @author Steve Grunwell <steve@stevegrunwell.com>
 */

$fields = array( 'event_date', 'event_name', 'event_url', 'venue' );
foreach ( $fields as $field ) {
  $$field = grunwell_get_custom_field( $field, null, false );
}

get_header(); ?>

<div class="vevent">

  <?php while ( have_posts() ) : the_post(); ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class( 'primary' ); ?> role="main">
      <h1 class="post-title summary"><?php the_title(); ?></h1>

      <?php the_content(); ?>

    </article><!--// #post-<?php the_ID(); ?>-->

  <?php endwhile; ?>

  <div class="secondary" role="complementary">
    <h2><?php _e( 'Details', 'grunwell-2012' ); ?></h2>

  <?php
    $details = '';

    if ( $event_date ) {
      $date = strtotime( $event_date );
      $details = sprintf( '<time class="dtstart event-date" title="%s">%s</time> ', date( 'c', $date ), date( 'F j, Y', $date ) );
    }

    if ( $event_name ) {
      if ( $event_url ) {
        $details .= sprintf( '<a href="%s" class="event-name url" rel="external">%s</a>', $event_url, $event_name );
      } else {
        $details .= sprintf( '<span class="event-name">%s</span>', $event );
      }
    }

    if ( $venue ) {
      $details .= sprintf( '<span class="location">%s</span>', $venue );
    }

    if ( $details ) {
      printf( '<p>%s</p>', $details );
    }
  ?>

    <p class="screen-reader-text"><a href="<?php echo get_permalink(); ?>" class="url" rel="permalink">Permalink to this talk</a></p>

    <?php echo get_the_tag_list( '<h2>Tags</h2><p>', ', ', '</p>' ); ?>

  </div><!-- .secondary -->

</div><!-- .vevent -->

<?php get_footer(); ?>
