<?php
/**
 * Primary theme footer
 * @package WordPress
 * @subpackage grunwell2012
 * @author Steve Grunwell <steve@stevegrunwell.com>
 */
?>

    </div><!-- // #main -->

    <footer>
      <div id="site-utility">
      <?php echo get_search_form(); ?>
      <?php
        $args = array(
          'container' => false,
          'depth' => 1,
          'menu' => 'social-networks',
          'menu_class' => 'social'
        );
        wp_nav_menu( $args );
      ?>
      </div><!-- #site-utility -->
    </footer>

  </div><!-- // #wrapper -->
<?php wp_footer(); ?>
</body>
</html>