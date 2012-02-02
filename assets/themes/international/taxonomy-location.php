<?php


get_header(); ?>
	<?php 
    $layout = pw_theme_option('layout_option');
	if(is_singular()) {
		$fullwidth = get_post_meta($post->ID, 'pw_single_layout', true);
    	if($fullwidth==2) $layout = "maincontent";
    }
    $layout = explode(",", $layout);
    $i = 1;
    foreach($layout as $elem) {
    	pw_get_element($elem, "el".$i);
    	$i++;
    }
    ?>
<?php get_footer(); ?>
<h4>taxonomy.php</h4>
