<?php

/**
 * Register ACF Blocks
 */
function ow_init() {
	register_block_type( __DIR__ . '/blocks/ow-accordion' );
	register_block_type( __DIR__ . '/blocks/ow-accordion-panel' );
}
add_action( 'init', 'ow_init' );