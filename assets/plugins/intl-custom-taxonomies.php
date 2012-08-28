<?php
/*
Plugin name: INTL Custom Taxonomies
Description: Contains code for creating IRJR's custom taxonomies
Version: 0.1
Author: David Herrera
*/

add_action('init', 'create_resource_taxonomies', 0);
function create_resource_taxonomies() {
    // Add new taxonomies for locations and resources, make them hierarchical
    $location_labels = array(
        'name' => _x( 'Locations', 'taxonomy general name' ),
        'singular_name' => _x( 'Location', 'taxonomy singular name' ),
        'add_new_item' => __( 'Add new Location' ),
        'menu_name' => __( 'Locations' ),
    );

    register_taxonomy('location', 'post', array(
        'hierarchical' => true,
        'labels' => $location_labels,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => true,
    ));

     $resource_labels = array(
        'name' => _x( 'Resource Types', 'taxonomy general name' ),
        'singular_name' => _x( 'Resource Type', 'taxonomy singular name' ),
        'add_new_item' => __( 'Add new Resource Type' ),
        'menu_name' => __( 'Resource Types' ),
    );

    register_taxonomy('resource-type', 'post', array(
        'hierarchical' => true,
        'labels' => $resource_labels,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => true,
    ));
    
    /* Create Custom Taxonomy for resource language */
    $language_labels = array(
      'name' => _x( 'Resource Languages', 'taxonomy general name' ),
      'singular_name' => _x( 'Resource Language', 'taxonomy singular name' ),
      'add_new_item' => __( 'Add new' ),
      'menu_name' => __( 'Resource Languages' ),
    );

    register_taxonomy('resource-language', 'post', array(
      'hierarchical' => true,
      'labels' => $resource_labels,
      'show_ui' => true,
      'query_var' => true,
      'rewrite' => true,
    ));

    /* Create Custom Taxonomy for faith */
    $faith_labels = array(
      'name' => _x( 'Faiths', 'taxonomy general name' ),
      'singular_name' => _x( 'Faith', 'taxonomy singular name' ),
      'add_new_item' => __( 'Add new' ),
      'menu_name' => __( 'Faiths' ),
    );

    register_taxonomy('faith', 'post', array(
      'hierarchical' => true,
      'labels' => $faith_labels,
      'show_ui' => true,
      'query_var' => true,
      'rewrite' => true,
    ));
}

?>