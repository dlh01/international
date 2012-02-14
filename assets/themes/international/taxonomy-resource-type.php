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
printf( __( 'Archives: %s', 'toolbox' ), '<span>' . single_cat_title( '', false ) . '</span>' );
?></h1>

<?php
$category_description = category_description();
if ( ! empty( $category_description ) )
    echo apply_filters( 'category_archive_meta', '<div class="taxonomy-archive-meta">' . $category_description . '</div>' );
?>
                </header>

                <?php // toolbox_content_nav( 'nav-above' ); ?>

<?php echo '<section id=breadcrumbs><h1>You are here</h1>'; if(function_exists('bcn_display')) { bcn_display(); }; echo '</section>' ?>

<?php
/*
 * Sort posts by Location
 *
 *
 * We will display each post that has this Resource Type taxonomy sorted by 
 * Location. So we get the Location terms to cycle through, then begin cycling 
 * through the terms. We generate a new Query for each Location using 
 * 'tax_query', display the name of the Location as a heading, then loop 
 * through the posts while calling content-taxonomy.php to control their 
 * display.
 *
 * @link http://codex.wordpress.org/Class_Reference/WP_Query#Category_Parameters
 * @since 1.0
 */

echo '<h1 class=taxarchives>Available resources</h1>';

$resource_type_query_var = get_query_var( 'resource-type' );

/*
 * Get only continent-level location terms
 *
 * If, given a particular Resource Type, we showed the resources under each 
 * Location on the site, the page would be unbearably long. So we show only 
 * continent-level Locations (Europe, North America, etc.). We do this by 
 * passing two arguments to get_terms, which retrieves the Locations:
 *
 * 'child_of' => '36' gets only children of the 'Global' Location (whose id=36)
 * 'parent' => '36' gets only direct children of the 'Global' Location, i.e. continents
 *
 * Note that the 'Global' location has an id=36 on the live site and id=50 on dev
 */ 
$location_type_terms = get_terms( 'location', array(
  'child_of'  => '36',
  'parent'    => '36'
)); // 'parent=0' returns only top-level terms

foreach ( $location_type_terms as $type ) {
    $args = array(
        'tax_query' => array(
            array(
                'taxonomy'  => 'resource-type',
                'field'     => 'slug',
                'terms'     => $resource_type_query_var,
                'include_children'  => false,
            ),
            array(
                'taxonomy'  => 'location',
                'field'     => 'slug',
                'terms'     => $type,
                'hierarchical' => true,
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
/**
 * Show an instance of the Search-By-Location widget
 */
    the_widget( 'Location_Search' );
?> 


            </div><!-- #content -->
        </section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
