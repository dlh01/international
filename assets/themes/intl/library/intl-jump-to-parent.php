<?php
/**
 * Jump to the parent Location of the Location we're viewing
 */
function intl_jump_to_parent() {
  // Get all Term data from the database for the Location term we're currently viewing
  $thislocation = get_term_by( 'name', single_cat_title( '', false ), 'location' ); 

  // Get an array of IDs for each ancestor of the Location we're viewing, from lowest to highest
  $ancestors = get_ancestors( $thislocation->term_id, 'location' );

  // Get the link of the first term in the $ancestors array, which is the direct parent of the Location we're viewing
  $ancestor_link = get_term_link( $ancestors[0], 'location' );

  // Get the name of that link
  $ancestor_term = get_term_by( 'id', $ancestors[0], 'location' );

  // Display a link to that term
  echo '<li><a href="' . $ancestor_link . '">' . $ancestor_term->name . '</a></li>';
}
?>
