<?php
/*
Plugin Name: Location Search Widgets
Version: 0.1
Author: David Herrera
Description: This plugin creates a reusable widget that allows users to search for (not in) a Location taxonomy type. It borrows redirect code from Mark Jaquith's Nice Search plugin and RedRokk's Empty Widget plugin.
*/


/**
 * Create Location Search Widgets
 *
 * This is a Search widget that uses a custom search form. The search form 
 * allows the user to search for (not in) a Location taxonomy term.
 *
 * 1. Enqueue jQuery UI script and style
 * 2. jQuery script to generate autocomplete tags
 * 3. Create Location Search widget
 * 4. Redirect searches to a taxonomy archive
 */

/* 1. Enqueue jQuery UI */
add_action( 'wp_enqueue_scripts', 'intl_enqueue_jquery_ui' );
function intl_enqueue_jquery_ui() {
  wp_enqueue_script( 'jquery-ui-autocomplete' );
}

/* 2. jQuery script to generate autocomplete tags */
add_action( 'wp_footer', 'intl_print_locations', 200 );
function intl_print_locations() { ?>
<script>
  jQuery(function() {
    var availableTags = [
      <?php
        $categories = get_categories( 'taxonomy=location' );
        foreach ($categories as $category) {
          echo '{label: "' . $category->name . '", value: "' . $category->slug . '"}, ';
        }
      ?>
    ];
    jQuery( ".tags" ).autocomplete({
      source: availableTags
  });
  });
</script>
<?php }


/* 3. Create Location Search widget */
/**
 * @package RedRokk
 * @version 1.0.0
 * 
 * Plugin Name: Empty Widget
 * Description: Single Widget Class handles all of the widget responsibility, all that you need to do is create the html. Just use Find/Replace on the Location_Search keyword to rebrand this class for your needs.
 * Author: RedRokk Interactive Media
 * Version: 1.0.0
 * Author URI: http://www.redrokk.com
 */

/**
 * Protection 
 * 
 * This string of code will prevent hacks from accessing the file directly.
 */
defined('ABSPATH') or die("Cannot access pages directly.");

/**
 * Initializing 
 * 
 * The directory separator is different between linux and microsoft servers.
 * Thankfully php sets the DIRECTORY_SEPARATOR constant so that we know what
 * to use.
 */
defined("DS") or define("DS", DIRECTORY_SEPARATOR);

/**
 * Actions and Filters
 * 
 * Register any and all actions here. Nothing should actually be called 
 * directly, the entire system will be based on these actions and hooks.
 */
add_action( 'widgets_init', create_function( '', 'register_widget("Location_Search");' ) );

/**
 * 
 * @author Senior Software Programmer @ RedRokk : Jonathon Byrd
 * 
 */
class Location_Search extends WP_Widget
{
	/**
	 * Widget settings
	 * 
	 * Simply use the following field examples to create the WordPress Widget options that
	 * will display to administrators. These options can then be found in the $params 
	 * variable within the widget method.
	 * 
	 */
	protected $widget = array(
		// this description will display within the administrative widgets area
		// when a user is deciding which widget to use.
    'title' => 'Location Search Widget',
		'description' => '',
    'classname' => 'widget_search',
		
		// determines whether or not to use the sidebar _before and _after html
		'do_wrapper' => true, 
		
		// string : if you set a filename here, it will be loaded as the view
		// when using a file the following array will be given to the file :
		// array('widget'=>array(),'params'=>array(),'sidebar'=>array(),
		// alternatively, you can return an html string here that will be used
		'view' => false,
		
		'fields' => array(
			// You should always offer a widget title
			array(
				'name' => 'Title',
				'desc' => 'Location search widget',
				'id' => 'title',
				'type' => 'text',
				'std' => 'Find A Location'
			),
		)
	);
	
	/**
	 * Widget HTML
	 * 
	 * If you want to have an all inclusive single widget file, you can do so by
	 * dumping your css styles with base_encoded images along with all of your 
	 * html string, right into this method.
	 *
	 * @param array $widget
	 * @param array $params
	 * @param array $sidebar
	 */
	function html($widget, $params, $sidebar)
	{
		?>
<h1 class="widget-title">Find A Location</h1>
<div class="ui-widget">
  <form role="search" method="get" class="searchform" action="<?php echo home_url( '/' ); ?>">
    <div><label for="tags-<?php echo $widget['number']; ?>" class="assistive-text" for="s">Jump to:</label>
          <input class="tags" id="tags-<?php echo $widget['number']; ?>" type="text" value="" name="s" id="s" />
          <input type="hidden" name="searchform" value="location" /> 
          <input type="submit" id="searchsubmit" value="Go" />
      </div>
  </form>
</div><!-- ui-widget -->
		<?php 
	}
	
	/**
	 * Constructor
	 * 
	 * Registers the widget details with the parent class, based off of the options
	 * that were defined within the widget property. This method does not need to be
	 * changed.
	 */
	function Location_Search()
	{
		//Initializing
		$classname = str_replace('_',' ', get_class($this));
		
		// widget actual processes
		parent::WP_Widget( 
			$id = (isset($this->widget['description'])?$this->widget['description']:$classname), 
			$name = (isset($this->widget['name'])?$this->widget['name']:$classname), 
			$options = array( 'description'=>$this->widget['description'] )
		);
	}
	
	/**
	 * Widget View
	 * 
	 * This method determines what view method is being used and gives that view
	 * method the proper parameters to operate. This method does not need to be
	 * changed.
	 *
	 * @param array $sidebar
	 * @param array $params
	 */
	function widget($sidebar, $params)
	{
		//initializing variables
		$this->widget['number'] = $this->number;
		// $title = apply_filters( 'Location_Search_title', $params['title'] );
		$do_wrapper = (!isset($this->widget['do_wrapper']) || $this->widget['do_wrapper']);
		
		if ( $do_wrapper ) 
			echo $sidebar['before_widget'];
		
		//loading a file that is isolated from other variables
		if (file_exists($this->widget['view']))
			$this->getViewFile($widget, $params, $sidebar);
			
		if ($this->widget['view'])
			echo $this->widget['view'];
			
		else $this->html($this->widget, $params, $sidebar);
			
		if ( $do_wrapper ) 
			echo $sidebar['after_widget'];
	}
	
	/**
	 * Get the View file
	 * 
	 * Isolates the view file from the other variables and loads the view file,
	 * giving it the three parameters that are needed. This method does not
	 * need to be changed.
	 *
	 * @param array $widget
	 * @param array $params
	 * @param array $sidebar
	 */
	function getViewFile($widget, $params, $sidebar) {
		require $this->widget['view'];
	}

	/**
	 * Administration Form
	 * 
	 * This method is called from within the wp-admin/widgets area when this
	 * widget is placed into a sidebar. The resulting is a widget options form
	 * that allows the administration to modify how the widget operates.
	 * 
	 * You do not need to adjust this method what-so-ever, it will parse the array
	 * parameters given to it from the protected widget property of this class.
	 *
	 * @param array $instance
	 * @return boolean
	 */
	function form($instance)
	{
		//reasons to fail
		if (empty($this->widget['fields'])) return false;
		
		$defaults = array(
			'id' => '',
			'name' => '',
			'desc' => '',
			'type' => '',
			'options' => '',
			'std' => '',
		);
		
		do_action('Location_Search_before');
		foreach ($this->widget['fields'] as $field)
		{
			//making sure we don't throw strict errors
			$field = wp_parse_args($field, $defaults);

			$meta = false;
			if (isset($field['id']) && array_key_exists($field['id'], $instance))
				@$meta = attribute_escape($instance[$field['id']]);

			if ($field['type'] != 'custom' && $field['type'] != 'metabox') 
			{
				echo '<p><label for="',$this->get_field_id($field['id']),'">';
			}
			if (isset($field['name']) && $field['name']) echo $field['name'],':';

			switch ($field['type'])
			{
				case 'text':
					echo '<input type="text" name="', $this->get_field_name($field['id']), '" id="', $this->get_field_id($field['id']), '" value="', ($meta ? $meta : @$field['std']), '" class="vibe_text" />', 
					'<br/><span class="description">', @$field['desc'], '</span>';
					break;
				case 'textarea':
					echo '<textarea class="vibe_textarea" name="', $this->get_field_name($field['id']), '" id="', $this->get_field_id($field['id']), '" cols="60" rows="4" style="width:97%">', $meta ? $meta : @$field['std'], '</textarea>', 
					'<br/><span class="description">', @$field['desc'], '</span>';
					break;
				case 'select':
					echo '<select class="vibe_select" name="', $this->get_field_name($field['id']), '" id="', $this->get_field_id($field['id']), '">';

					foreach ($field['options'] as $value => $option)
					{
 					   $selected_option = ( $value ) ? $value : $option;
					    echo '<option', ($value ? ' value="' . $value . '"' : ''), ($meta == $selected_option ? ' selected="selected"' : ''), '>', $option, '</option>';
					}

					echo '</select>', 
					'<br/><span class="description">', @$field['desc'], '</span>';
					break;
				case 'radio':
					foreach ($field['options'] as $option)
					{
						echo '<input class="vibe_radio" type="radio" name="', $this->get_field_name($field['id']), '" value="', $option['value'], '"', ($meta == $option['value'] ? ' checked="checked"' : ''), ' />', 
						$option['name'];
					}
					echo '<br/><span class="description">', @$field['desc'], '</span>';
					break;
				case 'checkbox':
					echo '<input type="hidden" name="', $this->get_field_name($field['id']), '" id="', $this->get_field_id($field['id']), '" /> ', 
						 '<input class="vibe_checkbox" type="checkbox" name="', $this->get_field_name($field['id']), '" id="', $this->get_field_id($field['id']), '"', $meta ? ' checked="checked"' : '', ' /> ', 
					'<br/><span class="description">', @$field['desc'], '</span>';
					break;
				case 'custom':
					echo $field['std'];
					break;
			}

			if ($field['type'] != 'custom' && $field['type'] != 'metabox') 
			{
				echo '</label></p>';
			}
		}
		do_action('Location_Search_after');
		return true;
	}

	/**
	 * Update the Administrative parameters
	 * 
	 * This function will merge any posted paramters with that of the saved
	 * parameters. This ensures that the widget options never get lost. This
	 * method does not need to be changed.
	 *
	 * @param array $new_instance
	 * @param array $old_instance
	 * @return array
	 */
	function update($new_instance, $old_instance)
	{
		// processes widget options to be saved
		$instance = wp_parse_args($new_instance, $old_instance);
		return $instance;
	}
}



/* 4. Redirect searches to a taxonomy archive */
add_action( 'template_redirect', 'cws_nice_search_redirect' );
function cws_nice_search_redirect() {
	if ( is_search() && strpos( $_SERVER['REQUEST_URI'], 'searchform=location' ) !== false && strpos( $_SERVER['REQUEST_URI'], '/wp-admin/' ) === false && strpos( $_SERVER['REQUEST_URI'], '/search/' ) === false ) {
		wp_redirect( home_url( '/?location=' . str_replace( array( ' ', '%20' ),  array( '-', '-' ), get_query_var( 's' ) ) ) );
		exit();
	}
}
