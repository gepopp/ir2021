<?php

namespace immobilien_redaktion_2020;

/**
 * Enqueue scripts and styles
 */
add_action( 'wp_enqueue_scripts', function() {

	$min_ext = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

	// JS
	wp_enqueue_script(
		'immobilien_redaktion_2020_js',
		immobilien_redaktion_2020_URL . "/dist/main{$min_ext}.js",
		[],
		immobilien_redaktion_2020_VERSION,
		true
	);

	// CSS
	wp_enqueue_style(
		'immobilien_redaktion_2020_css',
		immobilien_redaktion_2020_URL . "/dist/main{$min_ext}.css",
		[],
		immobilien_redaktion_2020_VERSION,
		''
	);

} );