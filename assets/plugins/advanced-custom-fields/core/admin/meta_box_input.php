<?php

// vars
$fields = isset($args['args']['fields']) ? $args['args']['fields'] : false ;	
$options = isset($args['args']['options']) ? $args['args']['options'] : false;
$show = isset($args['args']['show']) ? $args['args']['show'] : "false";

// defaults
if(!$options)
{
	$options = array(
		'layout'	=>	'default'
	);
}
$post_id = $post ? $post->ID : 999999999;
	
if($fields)
{
	echo '<input type="hidden" name="save_input" value="true" />';
	echo '<div class="options" data-layout="' . $options['layout'] . '" data-show="' . $show . '" style="display:none"></div>';
	
	if($show == "false")
	{
		// don't create fields
		echo '<div class="acf-replace-with-fields"><div class="acf-loading"></div></div>';
	}
	else
	{
		$this->render_fields_for_input($fields, $post_id);
	}
}
	
?>