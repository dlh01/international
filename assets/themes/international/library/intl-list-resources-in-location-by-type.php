<?php
/**
 * Show the most recent three resources for a given Location term, separated by Resource Type
 *
 * Link to the full list of resources for each Location and Resource Type combination
 */
function intl_list_resources_in_location_by_type() {
  $location_query_var = get_query_var( 'location' );
  $resource_type_terms = get_terms( 'resource-type' );
  foreach ( $resource_type_terms as $type ) {
    $args = array(
      'tax_query' => array(
        array(
          'taxonomy'  => 'location',
          'field'     => 'slug',
          'terms'     => $location_query_var,
          'include_children'  => false,
        ),
        array(
          'taxonomy'  => 'resource-type',
          'field'     => 'slug',
          'terms'     => $type,
        )
      ),
      'posts_per_page' => 3,
    );
    $the_query = new WP_Query( $args );
    if ( $the_query->have_posts() ) :
      echo '<section class="location-by-type ' . $type->slug . '">'; // group each list of resources in a <section>
        echo '<h1 class="location-by-type--heading"><a href="' . esc_url( home_url( '/?resource-type=' . $type->slug . '&location=' . $location_query_var  ) ) . '">' . $type->name . '</a></h1>';
        while ( $the_query->have_posts() ) : $the_query->the_post();
          get_template_part( 'archive', 'location' );
        endwhile;

        /**
         * Show the link to more posts only if the query returned three posts
         *
         * In other words, if there are only one or two posts in this resource
         * type, then there's no need to link to a separate page because 
         * they're already showing
         */
        if ( $the_query->post_count == 3 ) :
          echo '<footer class="entry-meta location-by-type--footer"><a href="' . esc_url( home_url( '/?resource-type=' . $type->slug . '&location=' . $location_query_var  ) ) . '">View all resources about ' . single_cat_title( '', false ) .' under ' . $type->name . ' &rarr;</a></footer>';
        endif;

      echo '</section>';
    endif;
  }
  wp_reset_postdata();
}
?>
