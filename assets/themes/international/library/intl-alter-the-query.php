<?php
/**
 * Alter the variables that are passed to the MySQL query
 *
 * This causes Archive pages for Resource Types taxonomy to
 * return 20 posts, not the default 10
 *
 * http://codex.wordpress.org/Plugin_API/Filter_Reference/request
 */
function alter_the_query( $request ) {
    $dummy_query = new WP_Query();  // the query isn't run if we don't pass any query vars
    $dummy_query->parse_query( $request );

    // this is the actual manipulation; do whatever you need here
    if ( $dummy_query->is_tax( 'resource-type' ) )
        $request['posts_per_page'] = 20;

    return $request;
}
add_filter( 'request', 'alter_the_query' );
