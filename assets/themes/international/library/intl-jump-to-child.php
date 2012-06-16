<?php
/**
 * Jump to the child Locations of the Location we're currently viewing
 */

function intl_jump_to_child() {
  // Get all Term data from the database for the Location term we're currently viewing
  $thislocation = get_term_by( 'name', single_cat_title( '', false ), 'location' ); 

  // Show the child terms of the Term we're currently viewing using the term_id gathered above
  wp_list_categories( array(
    'taxonomy' => 'location',
    'title_li' => '',
    'child_of' => $thislocation->term_id,
    'depth' => 1,
    'show_option_none' => __( 'None' ),
  ));
}
?>
