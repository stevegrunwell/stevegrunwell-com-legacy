<?php
/**
 * Comments template
 * @package WordPress
 * @subpackage grunwell2012
 * @author Steve Grunwell <steve@stevegrunwell.com>
 */
?>

  <div id="comments">
<?php if ( post_password_required() ) : ?>

    <p>This post is password protected. A password is required to view comments.</p>
  </div><!-- // #comments -->
  <?php return; ?>

<?php endif; ?>

<?php if ( have_comments() ) : ?>

    <h3><?php echo grunwell_string_plurals( 'No comments', 'One comment', '%d comments', get_comments_number() ); ?> on "<?php the_title(); ?>"</h3>
    <ol class="comments">
      <?php wp_list_comments( array( 'callback' => 'grunwell_comment' ) ); ?>
    </ol>

<?php else : // No comments ?>

  <?php if ( ! comments_open() ) : ?>

    <p>Comments are closed.</p>

  <?php endif; ?>

<?php endif; ?>

  <?php comment_form(); ?>

  </div><!-- // #comments -->