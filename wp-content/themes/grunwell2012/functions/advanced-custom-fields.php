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
 *  Register Field Groups
 *
 *  The register_field_group function accepts 1 array which holds the relevant data to register a field group
 *  You may edit the array as you see fit. However, this may result in errors if the array is not compatible with ACF
 */

if(function_exists("register_field_group"))
{
  register_field_group(array (
    'id' => 'acf_presentation-details',
    'title' => 'Presentation details',
    'fields' => array (
      array (
        'key' => 'field_51e3807ddd27e',
        'label' => 'Presentation date',
        'name' => 'event_date',
        'type' => 'text',
        'instructions' => 'YYYY-MM-DD HH:MM:SS timestamp in UTC',
        'default_value' => '',
        'formatting' => 'html',
      ),
      array (
        'key' => 'field_51e380c5dd27f',
        'label' => 'Event name',
        'name' => 'event_name',
        'type' => 'text',
        'default_value' => '',
        'formatting' => 'html',
      ),
      array (
        'key' => 'field_51e380efdd280',
        'label' => 'Event URL',
        'name' => 'event_url',
        'type' => 'text',
        'default_value' => '',
        'formatting' => 'none',
      ),
      array (
        'key' => 'field_51e380fcdd281',
        'label' => 'Venue',
        'name' => 'venue',
        'type' => 'textarea',
        'default_value' => '',
        'formatting' => 'br',
      ),
    ),
    'location' => array (
      array (
        array (
          'param' => 'post_type',
          'operator' => '==',
          'value' => 'grunwell_talk',
          'order_no' => 0,
          'group_no' => 0,
        ),
      ),
    ),
    'options' => array (
      'position' => 'side',
      'layout' => 'default',
      'hide_on_screen' => array (
      ),
    ),
    'menu_order' => 0,
  ));
  register_field_group(array (
    'id' => 'acf_agency-information',
    'title' => 'Agency Information',
    'fields' => array (
      array (
        'key' => 'field_50030495c59b8',
        'label' => 'Name',
        'name' => 'agency_name',
        'type' => 'text',
        'default_value' => '',
        'formatting' => 'html',
      ),
      array (
        'key' => 'field_50030495c5d01',
        'label' => 'City',
        'name' => 'agency_city',
        'type' => 'text',
        'default_value' => '',
        'formatting' => 'none',
      ),
      array (
        'key' => 'field_50030495c5fe9',
        'label' => 'Website',
        'name' => 'agency_url',
        'type' => 'text',
        'default_value' => '',
        'formatting' => 'none',
      ),
    ),
    'location' => array (
      array (
        array (
          'param' => 'post_type',
          'operator' => '==',
          'value' => 'grunwell_portfolio',
          'order_no' => '0',
          'group_no' => 0,
        ),
      ),
    ),
    'options' => array (
      'position' => 'side',
      'layout' => 'default',
      'hide_on_screen' => array (
      ),
    ),
    'menu_order' => 22,
  ));
  register_field_group(array (
    'id' => 'acf_client-information',
    'title' => 'Client Information',
    'fields' => array (
      array (
        'key' => 'field_4fc052ed59de5',
        'label' => 'Name',
        'name' => 'client_name',
        'type' => 'text',
        'default_value' => '',
        'formatting' => 'none',
      ),
      array (
        'key' => 'field_4fc052ed5a10d',
        'label' => 'City',
        'name' => 'client_city',
        'type' => 'text',
        'default_value' => '',
        'formatting' => 'none',
      ),
      array (
        'key' => 'field_4fc052ed5acd0',
        'label' => 'Website',
        'name' => 'client_url',
        'type' => 'text',
        'default_value' => '',
        'formatting' => 'none',
      ),
    ),
    'location' => array (
      array (
        array (
          'param' => 'post_type',
          'operator' => '==',
          'value' => 'grunwell_portfolio',
          'order_no' => '0',
          'group_no' => 0,
        ),
      ),
    ),
    'options' => array (
      'position' => 'side',
      'layout' => 'default',
      'hide_on_screen' => array (
        0 => 'discussion',
        1 => 'comments',
        2 => 'author',
      ),
    ),
    'menu_order' => 22,
  ));
  register_field_group(array (
    'id' => 'acf_page-settings',
    'title' => 'Page Settings',
    'fields' => array (
      array (
        'key' => 'field_4efcc8722c97c',
        'label' => 'Alternate Headline',
        'name' => 'alternate_headline',
        'type' => 'text',
        'instructions' => 'Text to use in place of the page title for the h1 content',
        'default_value' => '',
        'formatting' => 'html',
      ),
    ),
    'location' => array (
      array (
        array (
          'param' => 'post_type',
          'operator' => '==',
          'value' => 'page',
          'order_no' => '0',
          'group_no' => 0,
        ),
      ),
    ),
    'options' => array (
      'position' => 'normal',
      'layout' => 'default',
      'hide_on_screen' => array (
      ),
    ),
    'menu_order' => 22,
  ));
  register_field_group(array (
    'id' => 'acf_portfolio-attributes',
    'title' => 'Portfolio Attributes',
    'fields' => array (
      array (
        'key' => 'field_4fc052468856b',
        'label' => 'Dates',
        'name' => 'project_dates',
        'type' => 'text',
        'default_value' => '',
        'formatting' => 'html',
      ),
    ),
    'location' => array (
      array (
        array (
          'param' => 'post_type',
          'operator' => '==',
          'value' => 'grunwell_portfolio',
          'order_no' => '0',
          'group_no' => 0,
        ),
      ),
    ),
    'options' => array (
      'position' => 'side',
      'layout' => 'default',
      'hide_on_screen' => array (
        0 => 'custom_fields',
        1 => 'discussion',
        2 => 'author',
      ),
    ),
    'menu_order' => 22,
  ));
  register_field_group(array (
    'id' => 'acf_portfolio-screenshots',
    'title' => 'Portfolio Screenshots',
    'fields' => array (
      array (
        'key' => 'field_4fde19d802563',
        'label' => 'Screenshots',
        'name' => 'slides',
        'type' => 'repeater',
        'sub_fields' => array (
          array (
            'key' => 'field_4fde1a3e1957f',
            'label' => 'Image',
            'name' => 'image',
            'type' => 'image',
            'save_format' => 'id',
            'preview_size' => 'medium',
            'library' => 'all',
          ),
          array (
            'key' => 'field_4fde1a3e19599',
            'label' => 'Caption',
            'name' => 'caption',
            'type' => 'text',
            'default_value' => '',
            'formatting' => 'html',
          ),
        ),
        'row_limit' => '',
        'layout' => 'table',
        'button_label' => 'Add Screenshot',
      ),
    ),
    'location' => array (
      array (
        array (
          'param' => 'post_type',
          'operator' => '==',
          'value' => 'grunwell_portfolio',
          'order_no' => '0',
          'group_no' => 0,
        ),
      ),
    ),
    'options' => array (
      'position' => 'normal',
      'layout' => 'default',
      'hide_on_screen' => array (
      ),
    ),
    'menu_order' => 22,
  ));
  register_field_group(array (
    'id' => 'acf_product-sidebar',
    'title' => 'Product Sidebar',
    'fields' => array (
      array (
        'key' => 'field_4fc3e3885e61f',
        'label' => 'Sidebar Content',
        'name' => 'sidebar_content',
        'type' => 'wysiwyg',
        'toolbar' => 'full',
        'media_upload' => 'yes',
        'default_value' => '',
      ),
    ),
    'location' => array (
      array (
        array (
          'param' => 'page_template',
          'operator' => '==',
          'value' => 'template-product.php',
          'order_no' => 0,
          'group_no' => 0,
        ),
      ),
    ),
    'options' => array (
      'position' => 'normal',
      'layout' => 'default',
      'hide_on_screen' => array (
        0 => 'discussion',
        1 => 'author',
      ),
    ),
    'menu_order' => 22,
  ));
}