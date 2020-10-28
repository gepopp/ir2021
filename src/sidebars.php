<?php

namespace immobilien_redaktion_2020;

/**
 * Register widget area.
 */
add_action( 'widgets_init', function () {

	register_sidebar( [
		'name'          => esc_html( 'Sidebar' ),
		'id'            => 'sidebar',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	] );

} );