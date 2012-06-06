<?php
/**
 * The template for displaying content in the single.php template
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?>

<?php
/**
 * Put all custom fields into variables
 */
$original         = get_field( 'url' );
$author           = get_field( 'author' );
$publication      = get_field( 'publication' );
$organization     = get_field( 'organization' );
$language         = get_field( 'language' );
$contact          = get_field( 'contact' );
$twitter_handle   = get_field( 'twitter' );
$facebook_page    = get_field( 'facebook' );
$socmed           = get_field( 'socmed' );
$date             = get_field( 'date' );
$year             = get_field( 'year' );
$volume           = get_field( 'volume' );
$issue            = get_field( 'issue' );
$page             = get_field( 'page' );
$deadline         = get_field( 'deadline' );
$cost             = get_field( 'cost' );
$url_2            = get_field( 'url_2' );
$url_2_language   = get_field( 'url_2_language' );
$url_3            = get_field( 'url_3' );
$url_3_language   = get_field( 'url_3_language' );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>

		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php twentyeleven_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
    <?php
      // show the original URL prominently
      if ( get_field( 'url' ) ) :
        echo '<p class=original><a href="' . $original . '" target="_blank">View full resource</a></p>';
      endif;
    ?>
    <table class="table table-condensed">
    <tbody>
  <?php
    if ( get_field( 'author' ) ) {
      echo '<tr>';
      echo '<td class=field>Author</td class=field>';
      echo '<td>' . $author . '</td>';
      echo '</tr>';
    }
    if ( get_field( 'publication' ) ) {
      echo '<tr>';
      echo '<td class=field>Publication</td class=field>';
      echo '<td>' . $publication . '</td>';
      echo '</tr>';
    }
    if ( get_field( 'organization' ) ) {
      echo '<tr>';
      echo '<td class=field>Organization</td class=field>';
      echo '<td>' . $organization . '</td>';
      echo '</tr>';
    }
    if ( get_field( 'date' ) ) {
      echo '<tr>';
      echo '<td class=field>Date</td class=field>';
      echo '<td>' . $date . '</td>';
      echo '</tr>';
    }
    if ( get_field( 'year' ) ) {
      echo '<tr>';
      echo '<td class=field>Year</td class=field>';
      echo '<td>' . $year . '</td>';
      echo '</tr>';
    }
    if ( get_field( 'contact' ) ) {
      echo '<tr>';
      echo '<td class=field>Contact Address</td class=field>';
      echo '<td>' . $contact . '</td>';
      echo '</tr>';
    }
    if ( get_field( 'twitter' ) ) {
      echo '<tr>';
      echo '<td class=field>Twitter</td class=field>';
      echo '<td><a href="http://www.twitter.com/' . $twitter_handle . '">@' . $twitter_handle . '</a></td>';
      echo '</tr>';
    }
    if ( get_field( 'facebook' ) ) {
      echo '<tr>';
      echo '<td class=field>Facebook</td class=field>';
      echo '<td><a href="' . $facebook_page . '">' . $facebook_page . '</a></td>';
      echo '</tr>';
    }
    if ( get_field( 'socmed' ) ) {
      echo '<tr>';
      echo '<td class=field>Other Social Media</td class=field>';
      echo '<td>' . $socmed . '</td>';
      echo '</tr>';
    }
    if ( get_field( 'volume' ) ) {
      echo '<tr>';
      echo '<td class=field>Volume</td class=field>';
      echo '<td>' . $volume . '</td>';
      echo '</tr>';
    }
    if ( get_field( 'issue' ) ) {
      echo '<tr>';
      echo '<td class=field>Issue</td class=field>';
      echo '<td>' . $issue . '</td>';
      echo '</tr>';
    }
    if ( get_field( 'page' ) ) {
      echo '<tr>';
      echo '<td class=field>Pages</td class=field>';
      echo '<td>' . $page . '</td>';
      echo '</tr>';
    }
    if ( get_field( 'deadline' ) ) {
      echo '<tr>';
      echo '<td class=field>Application Deadline</td class=field>';
      echo '<td>' . $deadline . '</td>';
      echo '</tr>';
    }
    if ( get_field( 'cost' ) ) {
      echo '<tr>';
      echo '<td class=field>Cost</td class=field>';
      echo '<td>' . $cost . '</td>';
      echo '</tr>';
    }
    if ( get_field( 'language' ) ) {
      echo '<tr>';
      echo '<td class=field>Language</td class=field>';
      echo '<td>' . $language . '</td>';
      echo '</tr>';
    }
    if ( get_field( 'url_2' ) ) {
      echo '<tr>';
      echo '<td class=field>URL 2</td class=field>';
      echo '<td><a href="' . $url_2 . '">' . $url_2 . '</a></td>';
      echo '</tr>';
    }
    if ( get_field( 'url_2_language' ) ) {
      echo '<tr>';
      echo '<td class=field>URL 2 language</td class=field>';
      echo '<td>' . $url_2_language . '</td>';
      echo '</tr>';
    }
    if ( get_field( 'url_3' ) ) {
      echo '<tr>';
      echo '<td class=field>URL 3</td class=field>';
      echo '<td><a href="' . $url_3 . '">' . $url_3 . '</a></td>';
      echo '</tr>';
    }
    if ( get_field( 'url_3_language' ) ) {
      echo '<tr>';
      echo '<td class=field>URL 3 language</td class=field>';
      echo '<td>' . $url_3_language . '</td>';
      echo '</tr>';
    }
  ?>
    </tbody>
    </table>

		<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'twentyeleven' ) . '</span>', 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->

	<footer class="entry-meta">
		<?php
      _e( get_the_term_list( $post->ID, 'location', 'Locations: ', ', ', '. ' ) );
      _e( get_the_term_list( $post->ID, 'resource-type', 'Resource Type: ', ', ', '. ' ) );
      twentyeleven_posted_on(); _e(". ");
      _e("Updated on ", "toolbox"); the_modified_date(get_option('date_format')); _e(". ");
      _e("<a href='/contact'>Suggest an update to this entry</a>. ");
		?>
		<?php edit_post_link( __( 'Edit', 'twentyeleven' ), '<span class="edit-link">', '</span>' ); ?>

		<?php if ( get_the_author_meta( 'description' ) && ( ! function_exists( 'is_multi_author' ) || is_multi_author() ) ) : // If a user has filled out their description and this is a multi-author blog, show a bio on their entries ?>
		<div id="author-info">
			<div id="author-avatar">
				<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'twentyeleven_author_bio_avatar_size', 68 ) ); ?>
			</div><!-- #author-avatar -->
			<div id="author-description">
				<h2><?php printf( __( 'About %s', 'twentyeleven' ), get_the_author() ); ?></h2>
				<?php the_author_meta( 'description' ); ?>
				<div id="author-link">
					<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
						<?php printf( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>', 'twentyeleven' ), get_the_author() ); ?>
					</a>
				</div><!-- #author-link	-->
			</div><!-- #author-description -->
		</div><!-- #entry-author-info -->
		<?php endif; ?>
	</footer><!-- .entry-meta -->
</article><!-- #post-<?php the_ID(); ?> -->
