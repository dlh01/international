<?php
/**
 * The template for displaying Taxonomy Archive pages.
 *
 */

get_header(); ?>

        <section id="primary">
            <div id="content" role="main">

            <?php if ( have_posts() ) : ?>

                <header class="page-header">
                <h1 class="page-title"><?php
printf( __( 'Taxonomy Archives: %s', 'toolbox' ), '<span>' . single_cat_title( '', false ) . '</span>' );
?></h1>

<?php
$category_description = category_description();
if ( ! empty( $category_description ) )
    echo apply_filters( 'category_archive_meta', '<div class="taxonomy-archive-meta">' . $category_description . '</div>' );
?>
                </header>

                <?php // toolbox_content_nav( 'nav-above' ); ?>

<?php echo '<section id=breadcrumbs><h1>You Are Here</h1>'; echo 'Locations: '; if(function_exists('bcn_display')) { bcn_display(); }; echo '</section>' ?>

<?php
/*
 * Sort posts by Resource Type
 *
 *
 * We will display each post that has this Location taxonomy sorted by Resource 
 * Type. So we get the Resource Types terms to cycle through, then begin 
 * cycling through the terms. We generate a new Query for each Resource Type 
 * using 'tax_query', display the name of the Type as a heading, then loop 
 * through the posts while calling content-taxonomy.php to control their 
 * display.
 *
 * @link http://codex.wordpress.org/Class_Reference/WP_Query#Category_Parameters
 * @since 1.0
 */


echo '<h1 class=taxarchives>Available Resources</h1>';

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
        'posts_per_page' => -1,
    );
    $the_query = new WP_Query( $args );
    if ( $the_query->have_posts() ) :
        echo '<section id="taxarchive-' . $type->name . '" class="taxarchive">'; // group each list of resources in a <section>
        echo '<h2>' . $type->name . '</h2>';
        echo '<ul>';
        while ( $the_query->have_posts() ) : $the_query->the_post();
            get_template_part( 'content', 'taxonomy' );
        endwhile;
        echo '</ul>';
        echo '</section>';
    endif;
}
wp_reset_postdata();

?>
            <?php else : ?>

                <article id="post-0" class="post no-results not-found">
                    <header class="entry-header">
                        <h1 class="entry-title"><?php _e( 'Nothing Found', 'toolbox' ); ?></h1>
                    </header><!-- .entry-header -->

                    <div class="entry-content">
                        <p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'toolbox' ); ?></p>
                        <?php get_search_form(); ?>
                    </div><!-- .entry-content -->
                </article><!-- #post-0 -->

            <?php endif; ?>

<?php
$category_obj = get_term_by( 'slug', get_query_var( 'location' ), 'location' );
if ( $category_obj ) {
  /*
   * Test for child taxonomies to filter by
   *
   * Get the child with wp_list_categories, but don't echo the result
   * Put the result into the var 'filters'
   * If the result would be "no categories", do nothing
   * Otherwise, proceed normally and echo the child taxonomies in $filters
   */
  $filters = wp_list_categories( array(
      'orderby'       => 'name',
      'taxonomy'      => 'location',
      'child_of'      => $category_obj->term_id,
      'title_li'      => '',
      'hierarchical'  => true,
      'echo'          => 0
  ));
  if ( $filters == "<li>No categories</li>" ) {
  } else {
    echo '<section id="filter">';
    echo '<h1>More In This Location</h1>';
    echo '<ul>';
    echo $filters;
    echo '</ul>';
    echo '</section>';
  }
}
?> 


            </div><!-- #content -->
        </section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
