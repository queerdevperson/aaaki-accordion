<?php
/**
 * Plugin Name:       Accessible ACF Accordion
 * Requires Plugins:  advanced-custom-fields-pro
 * Description:       Creates an accessible accordion using ACF Pro
 * Requires at least: 6.5
 * Requires PHP:      8.0
 * Version:           1.0
 * Text Domain:       aaaki
 */

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */

 function aaaki_block_init() {
	wp_enqueue_script( 'jquery' );
	
	register_block_type( __DIR__ . '/blocks/aaaki-accordion' );
	register_block_type( __DIR__ . '/blocks/aaaki-accordion-panel' );
}
add_action( 'init', 'aaaki_block_init' );

function aaaki_acf_json_load_point( $paths ) {
	// Remove the original path (optional).
	unset($paths[0]);

	// Append the new path and return it.
	$paths[] = __DIR__ . '/aaaki-acf-fields';

	return $paths;    
}
add_filter( 'acf/settings/load_json', 'aaaki_acf_json_load_point' );

new aaaki_acf_group_save();
  
  class aaaki_acf_group_save {
    
    // list of field group IDs used in my plugin
    private $groups = array(
      'group_661e375d7d542',
      'group_6670b64c04424'
    );
    
    public function __construct() {
      // add fitler before acf saves a group
      add_action('acf/update_field_group', array($this, 'update_field_group'), 1, 1);
    } // end public function __construct
    
    public function update_field_group($group) {
      // called when ACF save the field group to the DB
      if (in_array($group['key'], $this->groups)) {
        // if it is one of my groups then add a filter on the save location
        // high priority to make sure it is not overrridded, I hope
        add_filter('acf/settings/save_json',  array($this, 'override_location'), 9999);
      }
      return $group;
    } // end public function update_field_group
    
    public function override_location($path) {
      // remove this filter so it will not effect other goups
      remove_filter('acf/settings/save_json',  array($this, 'override_location'), 9999);
      // override save path
      $path = __DIR__.'/aaaki-acf-fields';
      return $path;
    } // end public function override_json_location
    
  } // end class aaaki_acf_group_save

?>
