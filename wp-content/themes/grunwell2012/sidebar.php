<?php
/**
 * Basic page sidebar
 * @package WordPress
 * @subpackage grunwell2012
 * @author Steve Grunwell <steve@stevegrunwell.com>
 */
?>

<div class="secondary" role="complementary">

  <div id="twitter-module" class="module">
    <h2>Latest Tweets</h2>
    <p>Follow me: <a href="https://twitter.com/#!/stevegrunwell" title="Follow @SteveGrunwell on Twitter" rel="external">@stevegrunwell</a></p>

    <ul class="tweets">
    <?php foreach( grunwell_get_tweets() as $tweet ): ?>

      <li class="tweet">
        <?php echo $tweet['text']; ?>
        <time><?php echo date('M jS @ g:ia', strtotime($tweet['created_at'])); ?></time>
      </li>

    <?php endforeach; ?>
    </ul>
  </div><!-- #twitter-module -->

</div><!-- .secondary -->