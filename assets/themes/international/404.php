<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * @subpackage Toolbox
 * @since Toolbox 0.1
 */

get_header(); ?>

	<div id="primary">
		<div id="content" role="main">

			<article id="post-0" class="post error404 not-found">
				<header class="entry-header">
					<h1 class="entry-title"><?php _e( 'Page Not Found', 'toolbox' ); ?></h1>
				</header>

				<div class="entry-content">
          <div class="notfound-box">
            <p><?php _e( 'Sorry, but we couldn&rsquo;t find what you&rsquo;re looking for.', 'toolbox' ); ?></p>
            <?php get_search_form(); ?>
          </div>

          <div class="notfound-box">
            <h2><?php _e( 'Search by Location', 'toolbox' ); ?></h2>
            <p><?php _e( 'Looking for resources from a specific country? Try searching for that country&rsquo;s name below.', 'toolbox' ); ?></p>
            <?php the_widget( 'Location_Search' ); ?>
          </div>

          <div class="notfound-box">
            <h2><?php _e( 'Get In Touch', 'toolbox' ); ?></h2>
            <p><?php _e( 'If you think you reached this page because of a problem with our site, please contact us and we&rsquo;ll sort it out:', 'toolbox' ); ?></p>
            <div><?php echo do_shortcode( '[contact-form-7 id="948" title="Contact Us"]' ); ?></div>
          </div>

				</div><!-- .entry-content -->
			</article><!-- #post-0 -->

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>
