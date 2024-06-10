<?php

/**
 * Register ACF Blocks
 */
function ow_init() {
	register_block_type( __DIR__ . '/blocks/ow-accordion' );
	register_block_type( __DIR__ . '/blocks/ow-accordion-panel' );
}
add_action( 'init', 'ow_init' );

/**
 * Enqueue files
 */
function ow_styles() {
	
	if ( has_block('acf/ow-accordion') ) {
		wp_register_script( 
			'ow-accordion-block', 
			get_template_directory_uri() . '/blocks/ow-accordion/block.js', 
			array('acf')
		);

		wp_enqueue_script('ow-accordion-block');
	}
}
add_action( 'wp_enqueue_scripts', 'ow_styles' );