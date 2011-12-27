<?php
/**
 * Basic page template
 * @package WordPress
 * @subpackage grunwell2012
 * @author Steve Grunwell <steve@stevegrunwell.com>
 */

?>

<div class="secondary" role="complementary">
  
  <div id="twitter-module" class="module">
    <h3>Latest Tweets</h3>
    <p>Follow me: <a href="#">@stevegrunwell</a></p>

    <ul class="tweets">
    <?php for( $i=0; $i<3; $i++ ): ?>

      <li class="tweet">
        This is an example Tweet. It was pulled in from my public timeline
        <small>1 day ago</small>
      </li>

    <?php endfor; ?>
    </ul>
  </div><!-- // twitter module -->

</div><!-- // .secondary -->