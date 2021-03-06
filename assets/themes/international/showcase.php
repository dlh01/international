<?php
/**
 * Template Name: Showcase Template
 * Description: A Page Template that showcases Sticky Posts, Asides, and Blog Posts
 *
 * The showcase template in Twenty Eleven consists of a featured posts section using sticky posts,
 * another recent posts area (with the latest post shown in full and the rest as a list)
 * and a left sidebar holding aside posts.
 *
 * We are creating two queries to fetch the proper posts and a custom widget for the sidebar.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

// Enqueue showcase script for the slider
wp_enqueue_script( 'twentyeleven-showcase', get_template_directory_uri() . '/js/showcase.js', array( 'jquery' ), '2011-04-28' );

get_header(); ?>

		<div id="primary" class="showcase">
			<div id="content" role="main">

				<?php while ( have_posts() ) : the_post(); ?>

				<?php
					/**
					 * We are using a heading by rendering the_content
					 * If we have content for this page, let's display it.
					 */
					if ( '' != get_the_content() )
						get_template_part( 'content', 'intro' );
				?>

				<?php endwhile; ?>

        <div class="featured-posts featured-posts-permanent">
          <h1 class="showcase-heading">Search for a Location</h1>
          <section class="featured-post featured-post-permanent">
            <section class="section locations">
              <div class="ui-widget">
                <form role="search" method="get" class="searchform" action="<?php echo home_url( '/' ); ?>">
                  <div>
                    <label for="tags-front-page" class="assistive-text screen-reader-text" for="s">Jump to:</label>
                    <input class="tags field" id="tags-front-page" type="text" value="" name="s" id="s" placeholder='Try "Ireland" or "Zambia"' />
                    <input type="hidden" name="searchform" value="location" /> 
                    <input type="submit" id="searchsubmit" value="Go" />
                  </div>
                </form>
              </div><!-- ui-widget -->
            </section>
            <section class="section browsing-option">
              <h1>Jump to a continent</h1>
              <ul>
                <?php
                  /**
                   * Display a link to the archive page of each Location term
                   * that's an immediate child of the "Global" term.
                   */
                  $globalterm = get_term_by( 'slug', 'global', 'location' );
                  $globalterm_id = $globalterm->term_id;
                  // Exclude Antarctica
                  $antarctica = get_term_by( 'slug', 'antarctica', 'location' );
                  $antarctica_id = $antarctica->term_id;
                  wp_list_categories( array(
                    'taxonomy' => 'location',
                    'child_of' => $globalterm_id,
                    'depth' => 1,
                    'title_li' => '',
                    'exclude' => $antarctica_id,
                  ));
                ?>
              </ul>
            </section>
            <section class="section browsing-option">
                <h1>Browse by Resource Type</h1>
                <?php /* intl_list_comma_separated_resource_types(); */ ?>
                <ul>
                <?php
                  wp_list_categories ( array(
                    'taxonomy' => 'resource-type',
                    'depth' => 1,
                    'title_li' => '',
                  ));
                ?>
                </ul> 
            </section>
<!--
            <section class="section browsing-option">
              <?php
                /**
                 * Get arrays of data for the alphabetic and geographic page
                 *
                 * Echo the GUID of these pages in the paragraph below
                 *
                 * @link http://codex.wordpress.org/Function_Reference/get_page_by_title
                 */
                $alphabeticpage = get_page_by_title( 'Browse locations alphabetically' );
                $geographicpage = get_page_by_title( 'Browse locations geographically' );
              ?>
              <p>View all Locations <a href="<?php echo $alphabeticpage->guid; ?>">alphabetically</a> or <a href="<?php echo $geographicpage->guid; ?>">geographically</a>.</p>
            </section>
-->

            <section class="section browsing-option">
              <h1>Browse by language</h1>
              <ul>
              <?php
                wp_list_categories( array(
                  'taxonomy' => 'resource-language',
                  'depth' => 1,
                  'title_li' => '',
                ));
              ?>
              </ul>
            </section>

          </section>
        </div>

				<?php
					/**
					 * Begin the featured posts section.
					 *
					 * See if we have any sticky posts and use them to create our featured posts.
					 * We limit the featured posts at ten.
					 */
					$sticky = get_option( 'sticky_posts' );

					// Proceed only if sticky posts exist.
					if ( ! empty( $sticky ) ) :

					$featured_args = array(
						'post__in' => $sticky,
						'post_status' => 'publish',
						'posts_per_page' => 10,
						'no_found_rows' => true,
					);

					// The Featured Posts query.
					$featured = new WP_Query( $featured_args );

					// Proceed only if published posts exist
					if ( $featured->have_posts() ) :

					/**
					 * We will need to count featured posts starting from zero
					 * to create the slider navigation.
					 */
					$counter_slider = 0;

					?>

				<div class="featured-posts">
					<h1 class="showcase-heading"><?php _e( 'Featured Post', 'twentyeleven' ); ?></h1>

				<?php
					// Let's roll.
					while ( $featured->have_posts() ) : $featured->the_post();

					// Increase the counter.
					$counter_slider++;

					/**
					 * We're going to add a class to our featured post for featured images
					 * by default it'll have the feature-text class.
					 */
					$feature_class = 'feature-text';

					if ( has_post_thumbnail() ) {
						// ... but if it has a featured image let's add some class
						$feature_class = 'feature-image small';

						// Hang on. Let's check this here image out.
						$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), array( HEADER_IMAGE_WIDTH, HEADER_IMAGE_WIDTH ) );

						// Is it bigger than or equal to our header?
						if ( $image[1] >= HEADER_IMAGE_WIDTH ) {
							// If bigger, let's add a BIGGER class. It's EXTRA classy now.
							$feature_class = 'feature-image large';
						}
					}
					?>

					<section class="featured-post <?php echo $feature_class; ?>" id="featured-post-<?php echo $counter_slider; ?>">

						<?php
							/**
							 * If the thumbnail is as big as the header image
							 * make it a large featured post, otherwise render it small
							 */
							if ( has_post_thumbnail() ) {
								if ( $image[1] >= HEADER_IMAGE_WIDTH )
									$thumbnail_size = 'large-feature';
								else
									$thumbnail_size = 'small-feature';
								?>
								<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'twentyeleven' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_post_thumbnail( $thumbnail_size ); ?></a>
								<?php
							}
						?>
						<?php get_template_part( 'content', 'featured' ); ?>
					</section>
				<?php endwhile;	?>

				<?php
					// Show slider only if we have more than one featured post.
					if ( $featured->post_count > 1 ) :
				?>
				<nav class="feature-slider">
					<ul>
					<?php

						// Reset the counter so that we end up with matching elements
				    	$counter_slider = 0;

						// Begin from zero
				    	rewind_posts();

						// Let's roll again.
				    	while ( $featured->have_posts() ) : $featured->the_post();
				    		$counter_slider++;
							if ( 1 == $counter_slider )
								$class = 'class="active"';
							else
								$class = '';
				    	?>
						<li><a href="#featured-post-<?php echo $counter_slider; ?>" title="<?php printf( esc_attr__( 'Featuring: %s', 'twentyeleven' ), the_title_attribute( 'echo=0' ) ); ?>" <?php echo $class; ?>></a></li>
					<?php endwhile;	?>
					</ul>
				</nav>
				<?php endif; // End check for more than one sticky post. ?>
				</div><!-- .featured-posts -->
				<?php endif; // End check for published posts. ?>
				<?php endif; // End check for sticky posts. ?>

				<section class="recent-posts">
					<h1 class="showcase-heading"><?php _e( 'Recent Entries', 'twentyeleven' ); ?></h1>

					<?php

					// Display our recent posts, showing full content for the very latest, ignoring Aside posts.
					$recent_args = array(
						'order' => 'DESC',
						'post__not_in' => get_option( 'sticky_posts' ),
						'tax_query' => array(
							array(
								'taxonomy' => 'post_format',
								'terms' => array( 'post-format-aside', 'post-format-link', 'post-format-quote', 'post-format-status' ),
								'field' => 'slug',
								'operator' => 'NOT IN',
							),
						),
						'no_found_rows' => true,
					);

					// Our new query for the Recent Posts section.
					$recent = new WP_Query( $recent_args );

					// The first Recent post is displayed normally
					if ( $recent->have_posts() ) : $recent->the_post();

						// Set $more to 0 in order to only get the first part of the post.
						global $more;
						$more = 0;

						get_template_part( 'archive', 'location' );

						echo '<ol class="other-recent-posts">';

					endif;

					// For all other recent posts, just display the title and comment status.
					while ( $recent->have_posts() ) : $recent->the_post(); ?>

						<li class="entry-title">
							<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'twentyeleven' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
							<span class="comments-link">
								<?php comments_popup_link( '<span class="leave-reply">' . __( 'Leave a reply', 'twentyeleven' ) . '</span>', __( '<b>1</b> Reply', 'twentyeleven' ), __( '<b>%</b> Replies', 'twentyeleven' ) ); ?>
							</span>
						</li>

					<?php
					endwhile;

					// If we had some posts, close the <ol>
					if ( $recent->post_count > 0 )
						echo '</ol>';
					?>
				</section><!-- .recent-posts -->

				<div class="widget-area" role="complementary">
					<?php if ( ! dynamic_sidebar( 'sidebar-2' ) ) : ?>

						<?php
						the_widget( 'Twenty_Eleven_Ephemera_Widget', '', array( 'before_title' => '<h3 class="widget-title">', 'after_title' => '</h3>' ) );
						?>

					<?php endif; // end sidebar widget area ?>
				</div><!-- .widget-area -->

			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_footer(); ?>
