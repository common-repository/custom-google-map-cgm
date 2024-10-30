<?php
function setup_cgm_custom_post() {
    $labels = array(
    'name' => _x('CGM', 'post type general name', 'your_text_domain'),
    'singular_name' => _x('Custom Google Map', 'post type singular name', 'your_text_domain'),
    'add_new' => _x('Add New', 'cgm', 'your_text_domain'),
    'add_new_item' => __('Add New CGM', 'your_text_domain'),
    'edit_item' => __('Edit CGM', 'your_text_domain'),
    'new_item' => __('New CGM', 'your_text_domain'),
    'all_items' => __('All Google Maps', 'your_text_domain'),
    'view_item' => __('View Google Map', 'your_text_domain'),
    'search_items' => __('Search Google Map', 'your_text_domain'),
    'not_found' =>  __('No Custom Google Maps Found', 'your_text_domain'),
    'not_found_in_trash' => __('No Custom Google Maps Found in Trash', 'your_text_domain'), 
    'parent_item_colon' => '',
    'menu_name' => __('CGM Maps', 'your_text_domain')

  );


  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'show_in_menu' => true, 
    'query_var' => true,
    'has_archive' => false,
    'menu_icon' => 'dashicons-location-alt',
    'rewrite' => array( 'slug' => _x( 'cgm_custom_map', 'URL slug', 'your_text_domain' ) ),
    'capability_type' => 'post',
    'menu_position' => null,
    'supports' => array( 'title', 'thumbnail')
  ); 
  register_post_type('cgm_custom_map', $args);
   	
   	// Flush rewrite rules to get permalinks to work
   	flush_rewrite_rules();
 
  }

add_action('init', 'setup_cgm_custom_post');