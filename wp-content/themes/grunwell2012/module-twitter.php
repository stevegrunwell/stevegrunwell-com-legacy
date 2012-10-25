<?php
/**
 * Twitter sidebar module
 * @package WordPress
 * @subpackage grunwell2012
 * @author Steve Grunwell <steve@stevegrunwell.com>
 */
?>

<?php if ( $tweets = grunwell_get_tweets() ) : ?>

  <div id="twitter-module" class="module">
    <h2>Latest Tweets</h2>
    <p>Follow me: <a href="https://twitter.com/#!/stevegrunwell" title="Follow @SteveGrunwell on Twitter" rel="external">@stevegrunwell</a></p>

    <ul class="tweets">
    <?php foreach ( $tweets as $tweet ) : $time = strtotime( $tweet['created_at'] ); ?>
      <li class="tweet">
        <?php printf( "%s\n<time datetime=\"%s\" title=\"%s\">%s ago</time>", $tweet['text'], date( 'Y-m-d H:i:s', $time ), date( 'M jS, Y @ g:ia', $time ), human_time_diff( $time, time() ) ); ?>
      </li>
    <?php endforeach; ?>
    </ul>
  </div><!-- #twitter-module -->

<?php endif; ?>