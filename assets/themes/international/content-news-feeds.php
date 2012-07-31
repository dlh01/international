<?php
/**
 * The template used for displaying feed content in news-feeds.php
 */
?>

<?php
/**
 * Display an RSS feed using the core RSS widget
 * and data from Advanced Custom Fields
 */

/* Get each Repeater row from Advanced Custom fields */
$rows = get_field('the_feeds');

/* If there are rows, proceed */
if ( $rows ) {
  /**
   * For each row of the Repeater field
   */
  foreach ( $rows as $row ) {
    /* Store the instance arguments from the Repeater field in a variable */
    $instance_arguments = array(
      'title' => $row['the_feed_title'],
      'url' => $row['the_feed_url'],
      'items' => 5,
      'show_author' => false,
      'show_date' => true,
    );
    /* Store the widget arguments in a variable */
    $widget_arguments = array(
      /* Wrap the widget title in an h3, not the default h2 */
      'before_title' => '<h2 class="widgettitle">',
      'after_title' => '</h2>',
    );
    /* Wrap the widget instance in a <section> */
    echo '<section>';
    /* Create a new widget instance and use the variables above for instance and widget arguments */
    the_widget( 'WP_Widget_RSS', $instance_arguments, $widget_arguments );
    /* Close the widget <section> */
    echo '</section>';
  }
}
?> 
