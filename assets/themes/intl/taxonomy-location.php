<?php
/**
 * The template for displaying Location Archive pages.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

get_header(); ?>

		<section id="primary">
			<div id="content" role="main">

			<?php if ( have_posts() ) : ?>

				<header class="page-header">
					<h1 class="page-title"><?php
						printf( __( 'Location Archives: %s', 'twentyeleven' ), '<span>' . single_cat_title( '', false ) . '</span>' );
					?></h1>

					<?php
						$category_description = category_description();
						if ( ! empty( $category_description ) )
							echo apply_filters( 'category_archive_meta', '<div class="category-archive-meta">' . $category_description . '</div>' );
					?>
				</header>

				<?php twentyeleven_content_nav( 'nav-above' ); ?>

        <?php
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
            echo '<section>'; // group each list of resources in a <section>
              echo '<h1>' . $type->name . '</h1>';
                while ( $the_query->have_posts() ) : $the_query->the_post();
                  get_template_part( 'archive', 'location' );
                endwhile;
            echo '<footer class="entry-meta"><a href="' . esc_url( home_url( '/?resource-type=' . $type->slug . '&location=' . $location_query_var  ) ) . '"</a>View all resources under ' . $type->name . '</a></footer>';
            echo '</section>';
          endif;
        }
        wp_reset_postdata();
        ?>

				<?php twentyeleven_content_nav( 'nav-below' ); ?>

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
