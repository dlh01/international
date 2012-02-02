<?php
/**
 * @package WordPress
 * @subpackage Toolbox
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <nav id="category-nav">
    <?php if ( in_category( 'Resources' ) ) { ?>
      <h1>Resource</h1>
    <?php } elseif ( in_category( 'Staff Blog' ) ) { ?>
      <h1>Staff Blog</h1>
    <?php } ?>
  </nav>

	<header class="entry-header">
    <?php if ( get_field( 'image' ) ) { ?><img src="<?php the_field( 'image' ); ?>" class="logo" /><?php } ?>
		<h1 class="entry-title"><?php the_title(); ?></h1>

		<div class="entry-meta">
            <ul>
                <?php 
                    _e( get_the_term_list( $post->ID, 'location', '<li>Locations: ', ', ', '</li>' ) );
                    _e( get_the_term_list( $post->ID, 'resource-type', '<li>Resource Type: ', ' ', '</li>' ) );
                    _e("<li>", "toolbox"); toolbox_posted_on(); _e("</li>");
                    _e("<li>Updated on ", "toolbox"); the_modified_date(get_option('date_format')); _e("</li>");
                    _e("<li><a href='#'>Suggest an update to this entry</a></li>");
                ?>
            </ul>
		<?php  ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

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
	<div class="entry-content">

    <section id=description>

      <?php the_content(); ?>
      <?php // show the original URL prominently
        if ( get_field( 'url' ) ) {
          echo '<p class=original><a href="' . $original . '">View original page</a></p>'; }
      ?>
    </section>

  <dl>
<?php
  if ( get_field( 'author' ) ) {
    echo '<dt class=field>Author</dt class=field>';
    echo '<dd>' . $author . '</dd>';
  }
  if ( get_field( 'publication' ) ) {
    echo '<dt class=field>Publication</dt class=field>';
    echo '<dd>' . $publication . '</dd>';
  }
  if ( get_field( 'organization' ) ) {
    echo '<dt class=field>Organization</dt class=field>';
    echo '<dd>' . $organization . '</dd>';
  }
  if ( get_field( 'language' ) ) {
    echo '<dt class=field>Resource language</dt class=field>';
    echo '<dd>' . $language . '</dd>';
  }
  if ( get_field( 'contact' ) ) {
    echo '<dt class=field>Contact Address</dt class=field>';
    echo '<dd>' . $contact . '</dd>';
  }
  if ( get_field( 'twitter' ) ) {
    echo '<dt class=field>Twitter</dt class=field>';
    echo '<dd><a href="http://www.twitter.com/' . $twitter_handle . '">@' . $twitter_handle . '</a></dd>';
  }
  if ( get_field( 'facebook' ) ) {
    echo '<dt class=field>Facebook</dt class=field>';
    echo '<dd><a href="' . $facebook_page . '">' . $facebook_page . '</a></dd>';
  }
  if ( get_field( 'socmed' ) ) {
    echo '<dt class=field>Other Social Media</dt class=field>';
    echo '<dd>' . $socmed . '</dd>';
  }
  if ( get_field( 'date' ) ) {
    echo '<dt class=field>Date</dt class=field>';
    echo '<dd>' . $date . '</dd>';
  }
  if ( get_field( 'year' ) ) {
    echo '<dt class=field>Year</dt class=field>';
    echo '<dd>' . $year . '</dd>';
  }
  if ( get_field( 'volume' ) ) {
    echo '<dt class=field>Volume</dt class=field>';
    echo '<dd>' . $volume . '</dd>';
  }
  if ( get_field( 'issue' ) ) {
    echo '<dt class=field>Issue</dt class=field>';
    echo '<dd>' . $issue . '</dd>';
  }
  if ( get_field( 'page' ) ) {
    echo '<dt class=field>Pages</dt class=field>';
    echo '<dd>' . $pate . '</dd>';
  }
  if ( get_field( 'deadline' ) ) {
    echo '<dt class=field>Application Deadline</dt class=field>';
    echo '<dd>' . $deadline . '</dd>';
  }
  if ( get_field( 'cost' ) ) {
    echo '<dt class=field>Cost</dt class=field>';
    echo '<dd>' . $cost . '</dd>';
  }
  if ( get_field( 'url_2' ) ) {
    echo '<dt class=field>URL 2</dt class=field>';
    echo '<dd><a href="' . $url_2 . '">' . $url_2 . '</a></dd>';
  }
  if ( get_field( 'url_2_language' ) ) {
    echo '<dt class=field>URL 2 language</dt class=field>';
    echo '<dd>' . $url_2_language . '</dd>';
  }
  if ( get_field( 'url_3' ) ) {
    echo '<dt class=field>URL 3</dt class=field>';
    echo '<dd><a href="' . $url_3 . '">' . $url_3 . '</a></dd>';
  }
  if ( get_field( 'url_3_language' ) ) {
    echo '<dt class=field>URL 3 language</dt class=field>';
    echo '<p>' . $url_3_language . '</p>';
  }
?>
  </dl>

		<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'toolbox' ), 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->

	<footer class="entry-meta">
		<?php edit_post_link( __( 'Edit', 'toolbox' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->
</article><!-- #post-<?php the_ID(); ?> -->
