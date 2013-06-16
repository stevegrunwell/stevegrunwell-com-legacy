<?php
/**
 * Twitter sidebar module
 * @package WordPress
 * @subpackage grunwell2012
 * @author Steve Grunwell <steve@stevegrunwell.com>
 */
?>

  <div id="twitter-module" class="module">
    <h2>Latest Tweets</h2>
    <p>Follow me: <a href="https://twitter.com/#!/stevegrunwell" title="Follow @SteveGrunwell on Twitter" rel="external">@stevegrunwell</a></p>

    <ul class="tweets">
      <?php display_tweets(); ?>
    </ul>
  </div><!-- #twitter-module -->