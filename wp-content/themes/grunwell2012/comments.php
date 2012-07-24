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

  <?php
    $args = array(
      'fields' => array(
        'author' => sprintf( '<p><label for="comment-author" class="required">Your name</label> <input id="comment-author" name="author" type="text" class="required" value="%s" /></p>', esc_attr( $commenter['comment_author'] ) ),
        'email' => sprintf( '<p><label for="comment-email" class="required">Email address</label> <input id="comment-email" name="email" type="email" class="required" value="%s" /></p>', esc_attr( $commenter['comment_author_email'] ) ),
        'url' => sprintf( '<p><label for="comment-url">Website</label> <input id="comment-url" name="url" type="url" value="%s" placeholder="http://example.com" /></p>', esc_attr( $commenter['comment_author_url'] ) )
      ),
      'comment_field' => sprintf( '<p><label for="comment-comment" class="required">Your comment</label> <textarea name="comment" id="comment-comment" class="required" rows="8" cols="45"></textarea></p>' ),
      'comment_notes_after' => ''
    );
    comment_form( $args );
  ?>

  </div><!-- // #comments -->