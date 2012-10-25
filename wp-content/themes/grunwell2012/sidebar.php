<?php
/**
 * Basic page sidebar
 * @package WordPress
 * @subpackage grunwell2012
 * @author Steve Grunwell <steve@stevegrunwell.com>
 */
?>

<div class="secondary" role="complementary">

<?php $recent_posts = wp_get_recent_posts( array( 'numberposts' => 3, 'post_status' => 'publish' ) ); ?>
<?php if ( ! empty( $recent_posts ) ) : ?>

  <h2>Latest Blog Posts</h2>
  <ul class="recent-posts">
  <?php foreach ( $recent_posts as $recent ) : $time = strtotime( $recent['post_date_gmt'] ); ?>
    <?php printf( '<li><a href="%s">%s</a> <time datetime="%s" title="%s">%s ago</time></li>', get_permalink( $recent['ID'] ), $recent['post_title'], date( 'Y-m-d H:i:s', $time ), date( 'M jS, Y @ g:ia', $time ), human_time_diff( $time, time() ) ); ?>
  <?php endforeach; ?>
  </ul>

<?php endif; ?>

<?php get_template_part( 'module', 'twitter' ); ?>

</div><!-- .secondary -->