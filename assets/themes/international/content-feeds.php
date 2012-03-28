<?php
/**
 * The template used for displaying feed content in feeds.php
 *
 * @package WordPress
 * @subpackage Toolbox
 * @since Toolbox 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

  <?php the_widget('WP_Widget_RSS', array(
    'url' => 'http://www.nytimes.com/services/xml/rss/nyt/HomePage.xml'
  )); ?> 


 <?php the_widget('WP_Widget_Archives'); ?> 


</article><!-- #post-<?php the_ID(); ?> -->
