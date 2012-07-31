<?php
function intl_list_comma_separated_resource_types() {
  /**
   * Display a link to the archive page of each Resource Type term
   */

  /* Get an array of data for each term in the Resource Type taxonomy */
  $resourceterms = get_terms( 'resource-type' );
  /**
   * Count the total number of terms returned. We use this number to ensure
   * that a comma isn't displayed after the last term
   */
  $numberofresourceterms = count( $resourceterms );
  /**
   * Declare our counter variable; start at 1, not 0, because
   * $numberofresourceterms starts at 1
   */
  $i = 1;
  foreach ( $resourceterms as $term ) {
    echo '<a href="/resources/resource-type/' . $term->slug . '" title="' . sprintf(__('View all post filed under %s', 'twentyeleven'), $term->name) . '">' . $term->name . '</a>';
    /**
     * Display a comma after each link only if $i is not equal to the total
     * number of terms as counted in $numberofresourceterms. If they are equal
     * then we know we're at the last item in the array
     */
    if ( $numberofresourceterms != $i ) {
      echo ", ";
    }
    $i++;
  }
}
