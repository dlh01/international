<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Toolbox
 * @since Toolbox 0.1
 */

get_header(); ?>

		<?php if ( is_active_sidebar( 'home-top' ) ) : ?>
		<section id="home-top" class="widget-area" role="complementary">
			<?php dynamic_sidebar( 'home-top' ); ?>
		</section><!-- #home-top .widget-area -->
		<?php endif; ?>

		<div id="primary">
			<div id="content" role="main">

			<?php if ( have_posts() ) : ?>

      <div class=left>
              <section id=search>
                <?php the_widget( 'Location_Search' ); ?>
              </section><!-- #search -->

              <section id=browse>
                <h1 class=section-title>Browse By Resource Type</h1>
                <ul>
                <?php wp_list_categories( 'title_li=&taxonomy=resource-type' ); ?>
                </ul>
              </section>

               <section id="latest">
                    <h1 class="section-title">Newest Entry</h1>
                    <?php
                        global $post;
                        $args = array(
                          'posts_per_page' => 6,
                          'order' => 'DESC',
                        );
					// Our new query for the Recent Posts section.
					$recent = new WP_Query( $args );

					// The first Recent post is displayed normally
					if ( $recent->have_posts() ) : $recent->the_post();

						// Set $more to 0 in order to only get the first part of the post.
						global $more;
						$more = 0;

						get_template_part( 'content', 'home' );

            echo '<h2>Other New Entries</h2>';

						echo '<ul class="other-recent-posts">';

					endif;
           
					// For all other recent posts, just display the title and comment status.
					while ( $recent->have_posts() ) : $recent->the_post(); ?>

						<li class="entry-title">
							<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'twentyeleven' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
						</li>

					<?php
					endwhile;

					// If we had some posts, close the <ul>
					if ( $recent->post_count > 0 )
						echo '</ul>';

                        // $myposts = get_posts( $args );
                        // foreach( $myposts as $post ) :	setup_postdata($post);
                        //     get_template_part( 'content', 'home' );	
                        // endforeach; 
                    ?>
                </section><!-- #latest -->
      </div><!-- .left -->

                 <section id="map">
                    <h1 class="section-title">See Resources By Continent</h1>
                    <?php // Display continents map; stored in functions.php ?>
                    <?php display_continents_map(); ?>
                    <div style="clear:both;"></div>
                </section><!-- #map -->

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

			</div><!-- #content -->
    <div style="clear:both;"></div>
		</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
