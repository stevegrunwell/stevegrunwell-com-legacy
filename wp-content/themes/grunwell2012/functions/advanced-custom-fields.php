<?php
/**
 * Register our Advanced Custom Fields configuration
 * This file can be generated through the admin area: Custom Fields > Settings > Export Field Groups to PHP
 *
 * @package WordPress
 * @subpackage grunwell2012
 * @author Steve Grunwell <steve@stevegrunwell.com>
 */

/**
 * Activate Add-ons
 * Here you can enter your activation codes to unlock Add-ons to use in your theme.
 * Since all activation codes are multi-site licenses, you are allowed to include your key in premium themes.
 * Use the commented out code to update the database with your activation code.
 * You may place this code inside an IF statement that only runs on theme activation.
 */

// if(!get_option('acf_repeater_ac')) update_option('acf_repeater_ac', "xxxx-xxxx-xxxx-xxxx");
// if(!get_option('acf_options_page_ac')) update_option('acf_options_page_ac', "xxxx-xxxx-xxxx-xxxx");
// if(!get_option('acf_flexible_content_ac')) update_option('acf_flexible_content_ac', "xxxx-xxxx-xxxx-xxxx");
// if(!get_option('acf_gallery_ac')) update_option('acf_gallery_ac', "xxxx-xxxx-xxxx-xxxx");


/**
 * Register field groups
 * The register_field_group function accepts 1 array which holds the relevant data to register a field group
 * You may edit the array as you see fit. However, this may result in errors if the array is not compatible with ACF
 * This code must run every time the functions.php file is read
 */

if(function_exists("register_field_group"))
{
  register_field_group(array (
    'id' => '5036db6657a2d',
    'title' => 'Agency Information',
    'fields' =>
    array (
      0 =>
      array (
        'key' => 'field_50030495c59b8',
        'label' => 'Name',
        'name' => 'agency_name',
        'type' => 'text',
        'instructions' => '',
        'required' => '0',
        'default_value' => '',
        'formatting' => 'html',
        'order_no' => '0',
      ),
      1 =>
      array (
        'key' => 'field_50030495c5d01',
        'label' => 'City',
        'name' => 'agency_city',
        'type' => 'text',
        'instructions' => '',
        'required' => '0',
        'default_value' => '',
        'formatting' => 'none',
        'order_no' => '1',
      ),
      2 =>
      array (
        'key' => 'field_50030495c5fe9',
        'label' => 'Website',
        'name' => 'agency_url',
        'type' => 'text',
        'instructions' => '',
        'required' => '0',
        'default_value' => '',
        'formatting' => 'none',
        'order_no' => '2',
      ),
    ),
    'location' =>
    array (
      'rules' =>
      array (
        0 =>
        array (
          'param' => 'post_type',
          'operator' => '==',
          'value' => 'grunwell_portfolio',
          'order_no' => '0',
        ),
      ),
      'allorany' => 'all',
    ),
    'options' =>
    array (
      'position' => 'side',
      'layout' => 'default',
      'hide_on_screen' =>
      array (
      ),
    ),
    'menu_order' => 14,
  ));
  register_field_group(array (
    'id' => '5036db6657def',
    'title' => 'Client Information',
    'fields' =>
    array (
      0 =>
      array (
        'key' => 'field_4fc052ed59de5',
        'label' => 'Name',
        'name' => 'client_name',
        'type' => 'text',
        'instructions' => '',
        'required' => '0',
        'default_value' => '',
        'formatting' => 'none',
        'order_no' => '0',
      ),
      1 =>
      array (
        'key' => 'field_4fc052ed5a10d',
        'label' => 'City',
        'name' => 'client_city',
        'type' => 'text',
        'instructions' => '',
        'required' => '0',
        'default_value' => '',
        'formatting' => 'none',
        'order_no' => '1',
      ),
      2 =>
      array (
        'key' => 'field_4fc052ed5acd0',
        'label' => 'Website',
        'name' => 'client_url',
        'type' => 'text',
        'instructions' => '',
        'required' => '0',
        'default_value' => '',
        'formatting' => 'none',
        'order_no' => '2',
      ),
    ),
    'location' =>
    array (
      'rules' =>
      array (
        0 =>
        array (
          'param' => 'post_type',
          'operator' => '==',
          'value' => 'grunwell_portfolio',
          'order_no' => '0',
        ),
      ),
      'allorany' => 'all',
    ),
    'options' =>
    array (
      'position' => 'side',
      'layout' => 'default',
      'hide_on_screen' =>
      array (
        0 => 'discussion',
        1 => 'comments',
        2 => 'author',
      ),
    ),
    'menu_order' => 14,
  ));
  register_field_group(array (
    'id' => '5036db6658279',
    'title' => 'Page Settings',
    'fields' =>
    array (
      0 =>
      array (
        'key' => 'field_4efcc8722c97c',
        'label' => 'Alternate Headline',
        'name' => 'alternate_headline',
        'type' => 'text',
        'default_value' => '',
        'formatting' => 'html',
        'instructions' => 'Text to use in place of the page title for the h1 content',
        'order_no' => '0',
      ),
    ),
    'location' =>
    array (
      'rules' =>
      array (
        0 =>
        array (
          'param' => 'post_type',
          'operator' => '==',
          'value' => 'page',
          'order_no' => '0',
        ),
      ),
      'allorany' => 'all',
    ),
    'options' =>
    array (
      'position' => 'normal',
      'layout' => 'default',
      'hide_on_screen' =>
      array (
      ),
    ),
    'menu_order' => 14,
  ));
  register_field_group(array (
    'id' => '5036db6658509',
    'title' => 'Portfolio Attributes',
    'fields' =>
    array (
      0 =>
      array (
        'key' => 'field_4fc052468856b',
        'label' => 'Dates',
        'name' => 'project_dates',
        'type' => 'text',
        'instructions' => '',
        'required' => '0',
        'default_value' => '',
        'formatting' => 'html',
        'order_no' => '0',
      ),
    ),
    'location' =>
    array (
      'rules' =>
      array (
        0 =>
        array (
          'param' => 'post_type',
          'operator' => '==',
          'value' => 'grunwell_portfolio',
          'order_no' => '0',
        ),
      ),
      'allorany' => 'all',
    ),
    'options' =>
    array (
      'position' => 'side',
      'layout' => 'default',
      'hide_on_screen' =>
      array (
        0 => 'custom_fields',
        1 => 'discussion',
        2 => 'author',
      ),
    ),
    'menu_order' => 14,
  ));
  register_field_group(array (
    'id' => '5036db665890e',
    'title' => 'Portfolio Screenshots',
    'fields' =>
    array (
      0 =>
      array (
        'key' => 'field_4fde19d802563',
        'label' => 'Screenshots',
        'name' => 'slides',
        'type' => 'repeater',
        'instructions' => '',
        'required' => '0',
        'sub_fields' =>
        array (
          0 =>
          array (
            'label' => 'Image',
            'name' => 'image',
            'type' => 'image',
            'save_format' => 'id',
            'preview_size' => 'medium',
            'key' => 'field_4fde1a3e1957f',
            'order_no' => '0',
          ),
          1 =>
          array (
            'label' => 'Caption',
            'name' => 'caption',
            'type' => 'text',
            'default_value' => '',
            'formatting' => 'html',
            'key' => 'field_4fde1a3e19599',
            'order_no' => '1',
          ),
        ),
        'row_limit' => '',
        'layout' => 'table',
        'button_label' => 'Add Screenshot',
        'order_no' => '0',
      ),
    ),
    'location' =>
    array (
      'rules' =>
      array (
        0 =>
        array (
          'param' => 'post_type',
          'operator' => '==',
          'value' => 'grunwell_portfolio',
          'order_no' => '0',
        ),
      ),
      'allorany' => 'all',
    ),
    'options' =>
    array (
      'position' => 'normal',
      'layout' => 'default',
      'hide_on_screen' =>
      array (
      ),
    ),
    'menu_order' => 14,
  ));
  register_field_group(array (
    'id' => '5036db6658b8c',
    'title' => 'Sidebar',
    'fields' =>
    array (
      0 =>
      array (
        'label' => 'Sidebar Content',
        'name' => 'sidebar_content',
        'type' => 'wysiwyg',
        'instructions' => '',
        'required' => '0',
        'toolbar' => 'full',
        'media_upload' => 'yes',
        'key' => 'field_4fc3e3885e61f',
        'order_no' => '0',
      ),
    ),
    'location' =>
    array (
      'rules' =>
      array (
        0 =>
        array (
          'param' => 'post_type',
          'operator' => '==',
          'value' => 'grunwell_portfolio',
          'order_no' => '0',
        ),
      ),
      'allorany' => 'all',
    ),
    'options' =>
    array (
      'position' => 'normal',
      'layout' => 'default',
      'hide_on_screen' =>
      array (
        1 => 'discussion',
        5 => 'author',
      ),
    ),
    'menu_order' => 14,
  ));
}

?>