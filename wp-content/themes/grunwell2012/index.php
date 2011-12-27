<?php
/**
 * Generic template file
 * @package WordPress
 * @subpackage grunwell2012
 * @author Steve Grunwell <steve@stevegrunwell.com>
 */

get_header(); ?>

<div class="primary" role="main">
  <h1>This is a &lt;h1&gt; element</h1>

  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam odio purus, pretium adipiscing rutrum eu, ornare a ligula. Quisque lacinia neque eu leo rutrum egestas. Nullam dignissim mi vitae quam congue nec pulvinar ligula consectetur. Donec nec mauris vel metus interdum facilisis eget vitae turpis. Nunc consequat sollicitudin porta. Aliquam erat volutpat. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.</p>

  <h2>And this is a h2. It’s smaller than a h1</h2>
  <p>Suspendisse iaculis laoreet elit vel ullamcorper. Aenean odio est, dapibus eget suscipit eget, euismod et nunc. Quisque eleifend, lorem vitae dictum volutpat, lorem urna hendrerit turpis, sit amet auctor diam lorem vel velit. Etiam iaculis varius justo a suscipit. Maecenas vel ipsum fringilla massa aliquet tincidunt. Morbi sed dolor et augue blandit ultrices sit amet vitae justo. Lorem ipsum dolor sit amet, consectetur adipiscing elit. In hac habitasse platea dictumst.</p>

  <p><small>Suspendisse consectetur turpis eget lacus laoreet ullamcorper. Vestibulum accumsan tempor gravida. Aliquam pharetra congue tortor, vel malesuada purus lacinia ut. Donec vitae diam et sem pretium sagittis. Curabitur consequat velit eget nisl mattis pharetra.</small></p>

  <h3>Here comes the h3 tag!</h3>
  <p>Phasellus feugiat enim id nulla consectetur vitae luctus magna posuere. Pellentesque et augue elit, in malesuada nunc. Vestibulum sed enim nunc, at sagittis felis. Aenean ac velit id nunc sollicitudin dapibus quis quis arcu. Aliquam et ipsum rutrum dui placerat sodales sed non elit.</p>

  <p>Suspendisse consectetur turpis eget lacus laoreet ullamcorper. Vestibulum accumsan tempor gravida. Aliquam pharetra congue tortor, vel malesuada purus lacinia ut. Donec vitae diam et sem pretium sagittis. Curabitur consequat velit eget nisl mattis pharetra.</p>

  <h4>H4 and below stop using Gotham:</h4>
  <p>Phasellus feugiat enim id nulla consectetur vitae luctus magna posuere. Pellentesque et augue elit, in malesuada nunc. Vestibulum sed enim nunc, at sagittis felis. Aenean ac velit id nunc sollicitudin dapibus quis quis arcu. Aliquam et ipsum rutrum dui placerat sodales sed non elit.</p>

  <h5>H5 - Lorem ipsum sit dolor</h5>
  <p>Suspendisse consectetur turpis eget lacus laoreet ullamcorper. Vestibulum accumsan tempor gravida. Aliquam pharetra congue tortor, vel malesuada purus lacinia ut. Donec vitae diam et sem pretium sagittis. Curabitur consequat velit eget nisl mattis pharetra.</p>

  <h6>H6 - Really just a bold line</h6>
  <p>Suspendisse consectetur turpis eget lacus laoreet ullamcorper. Vestibulum accumsan tempor gravida. Aliquam pharetra congue tortor, vel malesuada purus lacinia ut. Donec vitae diam et sem pretium sagittis. Curabitur consequat velit eget nisl mattis pharetra.</p>
  <?php //get_template_part('loop', 'index'); ?>

</div><!-- // #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
