<?php
/**
 * The template for displaying most Taxonomy Archive pages.
 *
 * Archives for Resource Types are handled in taxonomy-resource-type.php
 */

get_header(); ?>

		<section id="primary">
			<div id="content" role="main">

			<?php if ( have_posts() ) : ?>

				<header class="page-header">
					<h1 class="page-title"><?php
            if (is_tax('resource-language')) {
              printf( __( 'Language: %s', 'twentyeleven' ), '<span>' . single_cat_title( '', false ) . '</span>' );
            } else {
              printf( __( 'Archives: %s', 'twentyeleven' ), '<span>' . single_cat_title( '', false ) . '</span>' );
            }
					?></h1>

					<?php
						$category_description = category_description();
						if ( ! empty( $category_description ) )
							echo apply_filters( 'category_archive_meta', '<div class="category-archive-meta">' . $category_description . '</div>' );
					?>
				</header>

				<?php intl_resources_nav( 'nav-above' ); ?>

        <?php
        /**
         * Determine how to display the current taxonomy archive using the query string
         */

        // If the query is looking for both a resource type and a location, then use the normal loop
        if ( get_query_var( 'location' ) && get_query_var( 'resource-type' ) ) :
          /* Start the Loop */
          while ( have_posts() ) : the_post();
          get_template_part( 'archive', 'location' ); 
          endwhile;
          // Place nav-below inside the conditional, not below the conditionals, because it makes more sense before rather than after the link back to the Location archive
          intl_resources_nav( 'nav-below' );
          // Display a link back to the full Location archive
          echo '<footer class="entry-meta back-to-location"><a href="' . get_term_link( get_query_var( 'location' ), 'location' ) . '">&larr; View all resources for ' . single_cat_title( '', false ) . '</a></footer>';

        // If the query is looking for just a location, then hijack the loop and
        // run the separate, multiple instances of WP_Query
        elseif ( get_query_var( 'location' ) ) :
          intl_list_resources_in_location_by_type();

        // Otherwise, run the loop normally and use the archive-location.php view.
        // This would need to be changed if there are other types of posts that could display
        else:
          while ( have_posts() ) : the_post();
          get_template_part( 'archive', 'location' ); 
          endwhile;
          intl_resources_nav( 'nav-below' );
        endif;
        ?>

			<?php else : ?>

				<article id="post-0" class="post no-results not-found">
					<header class="entry-header">
						<h1 class="entry-title"><?php _e( 'Nothing Found', 'twentyeleven' ); ?></h1>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'twentyeleven' ); ?></p>
						<?php get_search_form(); ?>
					</div><!-- .entry-content -->
				</article><!-- #post-0 -->

			<?php endif; ?>

			</div><!-- #content -->
		</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
