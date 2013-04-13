<?php

  /*

    Each service has a setting specifying whether it should be used automatically on upload.

    Values are:
      -1  Don't use (until manually enabled via Media > Settings)
      0   Use automatically
      n   Any other number is a Unix timestamp indicating when the service can be used again

  */

  define('WP_SMUSHIT_AUTO_OK', 0);
  define('WP_SMUSHIT_AUTO_NEVER', -1);


  function wp_smushit_register_settings() {
    add_settings_section( 'wp_smushit_settings', 'WP Smush.it', 'wp_smushit_settings_cb', 'media' );
    add_settings_field( 'wp_smushit_smushit_auto', 'Use Smush.it on upload?', 'wp_smushit_render_auto_opts',  'media', 'wp_smushit_settings' );
    add_settings_field( 'wp_smushit_smushit_timeout', 'How many seconds should we wait for a response from Smush.it?', 'wp_smushit_render_timeout_opts', 'media', 'wp_smushit_settings' );
    register_setting( 'media', 'wp_smushit_smushit_auto');
    register_setting( 'media', 'wp_smushit_smushit_timeout');
  }
  add_action('admin_init', 'wp_smushit_register_settings');

  function wp_smushit_settings_cb() {
  }

  function wp_smushit_render_auto_opts() {
    $key = 'wp_smushit_smushit_auto';
    $val = intval( get_option( $key, WP_SMUSHIT_AUTO_OK ) );
    printf( "<select name='%1\$s' id='%1\$s'>",  esc_attr( $key ) );
    echo '<option value=' . WP_SMUSHIT_AUTO_OK . ' ' . selected( WP_SMUSHIT_AUTO_OK, $val ) . '>Automatically process on upload</option>';
    echo '<option value=' . WP_SMUSHIT_AUTO_NEVER . ' ' . selected( WP_SMUSHIT_AUTO_NEVER, $val ) . '>Do not process on upload</option>';

    if ( $val > 0 ) {
      printf( '<option value="%d" selected="selected">Temporarily disabled until %s</option>', $val, date( 'M j, Y \a\t H:i', $val ) );
    }
    echo '</select>';
  }

  function wp_smushit_render_timeout_opts( $key ) {
    $key = 'wp_smushit_smushit_timeout';
    $val = intval( get_option( $key, WP_SMUSHIT_AUTO_OK ) );
    printf( "<input type='text' name='%1\$s' id='%1\$s' value='%2\%d'>",  esc_attr( $key ), intval( get_option( $key, 60 ) ) );
  }

  // default is 6hrs
  function wp_smushit_temporarily_disable( $seconds = 21600) {
    update_option( 'wp_smushit_smushit_auto', time() + $seconds );
  }