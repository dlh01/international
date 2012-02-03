<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package WordPress
 * @subpackage Toolbox
 * @since Toolbox 0.1
 */
?>
		<div id="secondary" class="widget-area" role="complementary">
		</div><!-- #secondary .widget-area -->

		<?php if ( is_active_sidebar( 'sidebar-2' ) ) : ?>
		<div id="tertiary" class="widget-area" role="complementary">
			<?php dynamic_sidebar( 'sidebar-2' ); ?>
		</div><!-- #tertiary .widget-area -->
		<?php endif; ?>

    <?php if ( ! is_home() ) : ?>
    <div id="quartary" class="widget-area" role="complementary">
      <?php dynamic_sidebar( 'sidebar-3' ); ?>
    </div><!-- #quartary .widget-area -->
    <?php endif; ?>
