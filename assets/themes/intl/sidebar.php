<?php
/**
 * The Sidebar containing the main widget area.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

$options = twentyeleven_get_theme_options();
$current_layout = $options['theme_layout'];

if ( 'content' != $current_layout ) :
?>
		<div id="secondary" class="widget-area" role="complementary">
      <?php if ( is_tax('location') ) : ?>

        <aside id="children" class="widget">
          <h3 class="widget-title"><?php _e( 'Jump To Child', 'twentyeleven' ); ?></h3>
          <ul>
            <?php intl_jump_to_child(); ?>
          </ul>
        </aside>

        <aside id="children" class="widget">
          <h3 class="widget-title"><?php _e( 'Jump To Parent', 'twentyeleven' ); ?></h3>
          <ul>
            <?php intl_jump_to_parent(); ?>
          </ul>
        </aside>

      <?php endif; ?>

			<?php if ( ! dynamic_sidebar( 'sidebar-1' ) ) : ?>

				<aside id="archives" class="widget">
					<h3 class="widget-title"><?php _e( 'Archives', 'twentyeleven' ); ?></h3>
					<ul>
						<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
					</ul>
				</aside>

				<aside id="meta" class="widget">
					<h3 class="widget-title"><?php _e( 'Meta', 'twentyeleven' ); ?></h3>
					<ul>
						<?php wp_register(); ?>
						<li><?php wp_loginout(); ?></li>
						<?php wp_meta(); ?>
					</ul>
				</aside>

			<?php endif; // end sidebar widget area ?>
		</div><!-- #secondary .widget-area -->
<?php endif; ?>
