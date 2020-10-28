<?php
/**
 * This file adds functions and actions for classes.
 *
 * @author Freeshifter LLC
 * @since 1.0.0
 */

namespace immobilien_redaktion_2020;

add_filter( 'body_class', function( $classes ) {

	if ( is_singular( ['post', 'page'] ) ) {
		$classes[] = 'singular';
	}

	if ( is_front_page() ) {
		$classes[] = 'front-page';
	}

	return $classes;

});