<?php
/**
 * Toolbox functions and definitions
 *
 * Sets up the theme and provides some helper functions. Some helper functions
 * are used in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook. The hook can be removed by using remove_action() or
 * remove_filter() and you can attach your own function to the hook.
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 * @package WordPress
 * @subpackage Toolbox
 * @since Toolbox 0.1
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 640; /* pixels */

if ( ! function_exists( 'toolbox_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override toolbox_setup() in a child theme, add your own toolbox_setup to your child theme's
 * functions.php file.
 */
function toolbox_setup() {
	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on toolbox, use a find and replace
	 * to change 'toolbox' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'toolbox', get_template_directory() . '/languages' );

	$locale = get_locale();
	$locale_file = get_template_directory() . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'toolbox' ),
	) );

	/**
	 * Add support for the Aside and Gallery Post Formats
	 */
	add_theme_support( 'post-formats', array( 'aside', 'image', 'gallery' ) );
}
endif; // toolbox_setup

/**
 * Tell WordPress to run toolbox_setup() when the 'after_setup_theme' hook is run.
 */
add_action( 'after_setup_theme', 'toolbox_setup' );

/**
 * Set a default theme color array for WP.com.
 */
$themecolors = array(
	'bg' => 'ffffff',
	'border' => 'eeeeee',
	'text' => '444444',
);

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 */
function toolbox_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'toolbox_page_menu_args' );

if ( ! function_exists( 'toolbox_content_nav' ) ):
/**
 * Display navigation to next/previous pages when applicable
 *
 * @since Toolbox 1.2
 */
function toolbox_content_nav( $nav_id ) {
	global $wp_query;

	?>
	<nav id="<?php echo $nav_id; ?>">
		<h1 class="assistive-text section-heading visuallyhidden"><?php _e( 'Post navigation', 'toolbox' ); ?></h1>

	<?php if ( is_single() ) : // navigation links for single posts ?>

		<?php previous_post_link( '<div class="nav-previous">%link</div>', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'toolbox' ) . '</span> %title' ); ?>
		<?php next_post_link( '<div class="nav-next">%link</div>', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'toolbox' ) . '</span>' ); ?>

	<?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive, and search pages ?>

		<?php if ( get_next_posts_link() ) : ?>
		<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'toolbox' ) ); ?></div>
		<?php endif; ?>

		<?php if ( get_previous_posts_link() ) : ?>
		<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'toolbox' ) ); ?></div>
		<?php endif; ?>

	<?php endif; ?>

	</nav><!-- #<?php echo $nav_id; ?> -->
	<?php
}
endif; // toolbox_content_nav


if ( ! function_exists( 'toolbox_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own toolbox_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Toolbox 0.4
 */
function toolbox_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'toolbox' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'toolbox' ), ' ' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<header>

				<div class="comment-author vcard">
					<?php printf( __( '%s', 'toolbox' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
				</div><!-- .comment-author .vcard -->

        <div class="comment-meta commentmetadata">
          <a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><time pubdate datetime="<?php comment_time( 'c' ); ?>">
          <?php
            /* translators: 1: date, 2: time */
            printf( __( '%1$s at %2$s', 'toolbox' ), get_comment_date(), get_comment_time() ); ?>
          </time></a>
          <?php edit_comment_link( __( '(Edit)', 'toolbox' ), ' ' );
          ?>
        </div><!-- .comment-meta .commentmetadata -->

				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em><?php _e( 'Your comment is awaiting moderation.', 'toolbox' ); ?></em>
					<br />
				<?php endif; ?>

			</header>

			<div class="comment-content"><?php comment_text(); ?></div>

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</article><!-- #comment-## -->

	<?php
			break;
	endswitch;
}
endif; // ends check for toolbox_comment()

if ( ! function_exists( 'toolbox_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 * Create your own toolbox_posted_on to override in a child theme
 *
 * @since Toolbox 1.2
 */
function toolbox_posted_on() {
	printf( __( '<span class="sep">Posted on </span><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a><span class="byline"> <span class="sep"> by </span> <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>', 'toolbox' ),
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'toolbox' ), get_the_author() ) ),
		esc_html( get_the_author() )
	);
}
endif;

/**
 * Adds custom classes to the array of body classes.
 *
 * @since Toolbox 1.2
 */
function toolbox_body_classes( $classes ) {
	// Adds a class of single-author to blogs with only 1 published author
	if ( ! is_multi_author() ) {
		$classes[] = 'single-author';
	}

	return $classes;
}
add_filter( 'body_class', 'toolbox_body_classes' );

/**
 * Returns true if a blog has more than 1 category
 *
 * @since Toolbox 1.2
 */
function toolbox_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {
		// Create an array of all the categories that are attached to posts
		$all_the_cool_cats = get_categories( array(
			'hide_empty' => 1,
		) );

		// Count the number of categories that are attached to the posts
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'all_the_cool_cats', $all_the_cool_cats );
	}

	if ( '1' != $all_the_cool_cats ) {
		// This blog has more than 1 category so toolbox_categorized_blog should return true
		return true;
	} else {
		// This blog has only 1 category so toolbox_categorized_blog should return false
		return false;
	}
}

/**
 * Flush out the transients used in toolbox_categorized_blog
 *
 * @since Toolbox 1.2
 */
function toolbox_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'all_the_cool_cats' );
}
add_action( 'edit_category', 'toolbox_category_transient_flusher' );
add_action( 'save_post', 'toolbox_category_transient_flusher' );

/**
 * Filter in a link to a content ID attribute for the next/previous image links on image attachment pages
 */
function toolbox_enhanced_image_navigation( $url ) {
	global $post;

	if ( wp_attachment_is_image( $post->ID ) )
		$url = $url . '#main';

	return $url;
}
add_filter( 'attachment_link', 'toolbox_enhanced_image_navigation' );

/**
 * Allow images (and any HTML) in Category Descriptions
 *
 * @link http://wordpress.org/support/topic/add-thumbnail-image-to-category-description#post-983766
 */
remove_filter('pre_term_description', 'wp_filter_kses');

/**
 * Create header-above widget
 */
function register_header_widget() {
	register_sidebar( array(
		'name' => __( 'Header Above', 'toolbox' ),
		'id' => 'header-above',
    'description' => __( 'A widget area that goes at the very top of the site, above the header', 'toolbox' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
}
add_action( 'init', 'register_header_widget', 110 );

/**
 * Create home.php widget
 */
function register_home_widget() {
	register_sidebar( array(
		'name' => __( 'Home Top', 'toolbox' ),
		'id' => 'home-top',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
}
add_action( 'init', 'register_home_widget', 120 );

/**
 * Create Footer widgets
 */
function register_footer_widgets() {
	register_sidebar( array(
		'name' => __( 'Footer - Narrow', 'toolbox' ),
		'id' => 'footer-1',
		'description' => __( 'A widget area for the site footer. It displays on all pages', 'toolbox' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => __( 'Footer - Wide', 'toolbox' ),
		'id' => 'footer-2',
		'description' => __( 'A widget area for the site footer. It displays on all pages', 'toolbox' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}
add_action( 'init', 'register_footer_widgets', 140 );

/**
 * Add Selectivizr
 *
 * Selectivizr: "Bootstrap CSS3 selector support"
 *
 * @link http://selectivizr.com/
 * @link http://stuffandnonsense.co.uk/projects/320andup/
 */
function add_selectivizr() { ?>
<?php echo "\n"; ?>
<!--[if (lt IE 9) & (!IEMobile)]>
<script src="<?php echo get_template_directory_uri(); ?>/js/libs/selectivizr-min.js"></script>
<![endif]-->
<?php }
add_action( 'wp_head', 'add_selectivizr', 110 );

/**
 * Add Modernizr
 */
function add_modernizr () { ?>
<?php echo "\n"; ?>
<!-- Modernizr -->
<script src="<?php echo get_template_directory_uri(); ?>/js/libs/modernizr-2.0.6.min.js"></script>
<?php }
add_action( 'wp_head', 'add_modernizr', 120 );

/**
 * Link to 320 and up helper JS
 * 
 * Used at least once, in the iOS scale bug fix below
 * @link http://stuffandnonsense.co.uk/projects/320andup/
 */
function add_320_helpers() { ?>
<?php echo "\n\n"; ?>
<script src="<?php echo get_template_directory_uri(); ?>/js/mylibs/helper.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/plugins.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/script.js"></script>
<?php }
add_action( 'wp_footer', 'add_320_helpers', 110 );

/**
 * Add imgsizer.js
 *
 * "Improve IE’s rendering of resizable images"
 * @link http://unstoppablerobotninja.com/entry/fluid-images/
 * @link http://stuffandnonsense.co.uk/projects/320andup/
 */
function add_imgsizer() { ?>
<!--[if (lt IE 9) & (!IEMobile)]>
<script src="<?php echo get_template_directory_uri(); ?>/js/libs/imgsizer.js"></script>
<![endif]-->
<?php }
add_action( 'wp_footer', 'add_imgsizer', 120 );

/*
 * Add iOS scale fix and respond.js support
 *
 * @link http://stuffandnonsense.co.uk/projects/320andup/
 */
function add_320_various() { ?>
<script>
// iOS scale bug fix
MBP.scaleFix();

// Respond.js
yepnope({
	test : Modernizr.mq('(min-width)'),
	nope : ['<?php echo get_template_directory_uri(); ?>/js/libs/respond.min.js']
});
</script>
<?php }
add_action( 'wp_footer', 'add_320_various', 130 );

/**
 * Prints HTML with meta information for the current post-date/time and author.
 * Copies toolbox_posted_on but removes author information
 */
function toolbox_posted_on_without_author() {
	printf( __( '<span class="sep">Posted on </span><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a>', 'toolbox' ),
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);
}

/**
 * Display list of continent with images for home page "map"
 * Called on home.php
 *
 * Display the list of continents for which we have Resources
 * Because this is a one-off function, we can hard-code the URLs
 * Each list item requires a class so we can specify a unique background image
 */
function display_continents_map() { ?>
<ul>
  <li class=africa><a href="/?location=africa">Africa</a></li>
  <li class=asia><a href="/?location=asia">Asia</a></li>
  <li class=europe><a href="/?location=europe">Europe</a></li>
  <li class=oceania><a href="/?location=oceania">Oceania</a></li>
  <li class=n-america><a href="/?location=north-america">North America</a></li>
  <li class=s-america><a href="/?location=south-america">South America</a></li>
</ul>
<p id=credit><a href="/about">Graphics credits</a></p>
<?php }

/**
 * Add copyright information to footer
 */
function display_copyright() {
  echo "Copyright " . date('Y') . " Religion Newswriters Association. ";
}
add_action( 'toolbox_credits', 'display_copyright' );

/**
 * Move CSS to separate files for minification
 */
function enqueue_international_css() {
  wp_enqueue_style(
    'international',
    get_template_directory_uri() . '/international.css',
    '',
    '1.1.1'
  );
}
add_action( 'wp_enqueue_scripts', 'enqueue_international_css' );

/**
 * Enqueue Google Translate widget JS
 */
function enqueue_google_translate_js() {
  wp_enqueue_script(
    'google_translate',
    'http://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit',
    '',
    '',
    'true' /* in_footer */
  );
}
add_action( 'wp_enqueue_scripts', 'enqueue_google_translate_js' );

/**
 * This theme was built with PHP, Semantic HTML, CSS, love, and a Toolbox.
 */
