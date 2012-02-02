<?php
/*
 * Add, remove, or otherwise modify Presswork hooks in this file
 * They will not work in functions.php or functionality.php
 * @link http://support.presswork.me/discussion/comment/196#Comment_196
 */


/*
 * Taxonomy archives: global
 */

// Hook the action removal into template_direct not init
// @link: http://themeshaper.com/forums/topic/conditionally-removing-thematic_access#post-10463
add_action( 'template_redirect', 'intl_remove_functions', 0 );
function intl_remove_functions() {
    // Remove pw_posts from taxonomy archives
    if ( is_tax() ) {
        remove_action( 'pw_archive_post_middle', 'pw_posts' );
    }
}

/*
 * Taxonomy archives: top
 */
add_action( 'pw_archive_top', 'intl_archive_top' );
function intl_archive_top() {
    if ( is_tax() ) { ?>
        <header>
            <h1 class="catheader"><?php single_cat_title(); ?></h1>
        </header>
    <?php
    }
}

/*
 * Display the child taxonomy terms for the current taxonomy archive page
 *
 * If we are on a taxonomy archive page, such as "Europe", this will display links
 * to the resource pages for its sub-taxonomies (e.g. "Scandanavia")
 *
 * @location Taxonomy archives: post
 */
add_action( 'pw_archive_post_top', 'intl_archive_middle' );
function intl_archive_middle() {
    /*
    // if this is a taxonomy page
    if ( is_tax() ) {
        // if this is displaying a taxonomy from 'locations'
        if ( is_tax( 'location' ) ) {
            // get the taxonomy id
            $a = get_term_by( 'name', get_query_var( 'location' ), 'location' );
            $b = $a->term_id;
            // set variables for the list_categories function call
            $taxonomy = 'location';
            $child_of = "'" . $b . "'";
            echo '<p><a href="#">Show all</a> or select location below</p>';
        }
        if ( is_tax( 'resource-type' ) ) {
            // get the taxonomy id
            $a = get_term_by( 'name', get_query_var( 'resource-type' ), 'resource-type' );
            $b = $a->term_id;
            // set variables for the list_categories function call
            $taxonomy = 'resource-type';
            $child_of = $b;
        }
        wp_list_categories( array (
            'taxonomy'  => $taxonomy,
            'child_of'  => $child_of
        ));
    }
     */
}

add_action( 'pw_archive_post_middle', 'intl_archive_post_middle' );
function intl_archive_post_middle() {
?>
<?php
}









/*
 * Single posts: top
 */
add_action( 'pw_single_post_top', 'intl_single_post_top' );
function intl_single_post_top() {
    ?>
 	<header>
		<?php if(is_single()) echo '<hgroup>'; ?>
            <?php if ( get_field( 'logo' ) != "" ) { ?><div class="logo"><img src="<?php the_field( 'logo' ); ?>" /></div><?php } ?>

            <h1 class="posttitle"><?php the_title(); ?></h1>
			<?php if(is_single()) { ?>
			<h2 class="meta">
                <ul>
                    <?php 
                    _e("<li>Posted: ", "presswork"); the_time(get_option('date_format')); _e("</li>");
                    _e("<li>Updated: ", "presswork"); the_modified_date(get_option('date_format')); _e("</li>");
                    _e("<li><a href='#'>Suggest an update</a></li>");
                    ?>
                </ul>
			</h2>
			<?php } ?>
		<?php if(is_single()) echo '</hgroup>'; ?>
    </header>
    <?php
}


/*
 * Single posts: middle
 */
remove_action( 'pw_single_post_middle', 'pw_single_post' );
add_action( 'pw_single_post_middle', 'intl_single_post' );
function intl_single_post() {
	echo pw_function_handle(__FUNCTION__);
	?>
    <div class="storycontent">
        <?php the_content( __( 'Read more &rarr;', "presswork" ) ); ?>
        <?php
            $resource_fields = array(
                'Source' => get_field( 'source' ),
                'URL' => get_field( 'url' ),
                'Publication' => get_field( 'publication' ),
                'Date published' => get_field( 'date_published' ),
                'Last updated' => get_field( 'last_updated' ),
                'Contact information' => get_field( 'contact_information' ),
            );
        ?>
            <div class="advcustfld">
            <?php foreach ( $resource_fields as $key => $item ) {
                if ( $item != "" ) {
                    $x = '<h2>' . $key . '</h2>';
                    $x .= '<p>' . $item . '</p>';
                    echo $x;
                }
            } ?>
            </div>
    </div>
    <footer>
	    <?php
	   	the_tags('<p class="tags"><small>'.__('Tags', "presswork").': ', ', ', '</small></p>');
		wp_link_pages(array('before' => '<p><strong>'.__('Pages', "presswork").':</strong> ', 'after' => '</p>', 'next_or_number' => 'number'));
		edit_post_link(__('(edit)', "presswork"), '<p class="clear">', '</p>');
		?>
	</footer>
	<?php
}

/*
 * Single posts: bottom
 */
remove_action('pw_single_bottom', 'pw_authorbox'); // no author profile box

?>
