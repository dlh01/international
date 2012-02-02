<?php
/*
Plugin name: Core Functions
Description: Contains required functions for the international resources website. Don't deactivate it!
Version: 0.1
Author: David Herrera
*/



/*
 * Remove WP meta generator
 */
remove_action( 'wp_head', 'wp_generator' );



/*
 * Create custom taxonomies
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
   
}



/*
 * Re-order the meta boxes on the post page
 * via http://wordpress.stackexchange.com/questions/1390/set-default-admin-screen-options-metabox-order
 */
// first remove the metaboxes we want to reorder
// we have to remove these from two different actions
add_action( 'admin_menu', 'reorder_meta_boxes' );
function reorder_meta_boxes() {
    remove_meta_box( 'formatdiv', 'post', 'core' );
    //remove_meta_box( 'categorydiv', 'post', 'core' );
    //remove_meta_box( 'tagsdiv-post_tag', 'post', 'core' );
}
add_action( 'do_meta_boxes', 'remove_featuredimage_box' );
function remove_featuredimage_box() {
    remove_meta_box( 'postimagediv', 'post', 'side' );
}

?>
