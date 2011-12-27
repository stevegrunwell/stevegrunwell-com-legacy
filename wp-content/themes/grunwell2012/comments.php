<?php
/**
 * Comments template
 * @package WordPress
 * @subpackage grunwell2012
 * @author Steve Grunwell <steve@stevegrunwell.com>
 */
?>

  <div id="comments">
<?php if( post_password_required() ): ?>

    <p>This post is password protected. A password is required to view comments.</p>
  </div><!-- // #comments -->
  <?php return; ?>

<?php endif; ?>

<?php if( have_comments() ): ?>

    <h3><?php echo _n('One comment', '%1 comments', get_comments_number()); ?></h3>
    <ol class="comments">
      <?php wp_list_comments(); ?>
    </ol>

  <?php if( get_comment_pages_count() > 1 && get_option('page_comments') ): ?>

    <?php paginate_comments_link(); ?>

  <?php endif; ?>

<?php else: // No comments ?>

  <?php if( !comments_open() ): ?>

    <p>Comments are closed.</p>

  <?php endif; ?>

<?php endif; ?>

  <?php comment_form(); ?>

  </div><!-- // #comments -->