<?php
/**
 * The Footer widget areas.
 *
 * @package WordPress
 */
?>

<?php
	/* The footer widget area is triggered if any of the areas
	 * have widgets. So let's check that first.
	 *
	 * If none of the sidebars have widgets, then let's bail early.
	 */
	if (   ! is_active_sidebar( 'footer-1'  )
		&& ! is_active_sidebar( 'footer-2' )
		&& ! is_active_sidebar( 'footer-3'  )
    && ! is_active_sidebar( 'footer-4' )
	)
		return;
	// If we get this far, we have widgets. Let do this.
?>
<div id="supplementary">
	<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
	<div id="first" class="widget-area" role="complementary">
		<?php dynamic_sidebar( 'footer-1' ); ?>
	</div><!-- #first .widget-area -->
	<?php endif; ?>

	<?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
	<div id="second" class="widget-area" role="complementary">
		<?php dynamic_sidebar( 'footer-2' ); ?>
	</div><!-- #second .widget-area -->
	<?php endif; ?>

  <?php
    // Only display these widgets on the home page
    if ( is_home() ) {
  ?>
    <?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
    <div id="third" class="widget-area" role="complementary">
      <?php dynamic_sidebar( 'footer-3' ); ?>
    </div><!-- #third .widget-area -->
    <?php endif; ?>

    <?php if ( is_active_sidebar( 'footer-4' ) ) : ?>
    <div id="fourth" class="widget-area" role="complementary">
      <?php dynamic_sidebar( 'footer-4' ); ?>
    </div><!-- #third .widget-area -->
    <?php endif; ?>
  <?php } ?>

    <div style="clear:both;"></div><!--clearfix-->
</div><!-- #supplementary -->
