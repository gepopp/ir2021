<?php

namespace immobilien_redaktion_2020;

/**
 * Enqueue scripts and styles
 */
add_action( 'wp_enqueue_scripts', function() {


    wp_dequeue_style( 'wp-block-library' );
    wp_dequeue_style( 'wp-block-library-theme' );
    wp_dequeue_style( 'wc-block-style' ); // Remove WooCommerce block CSS
    wp_dequeue_script('jquery');


	$min_ext = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

	// JS
	wp_enqueue_script(
		'immobilien_redaktion_2020_js',
		immobilien_redaktion_2020_URL . "/dist/main{$min_ext}.js",
		[],
		immobilien_redaktion_2020_VERSION,
		true
	);

	if(is_page_template('pagetemplate-login-register.php')){
        wp_enqueue_script(
            'immobilien_redaktion_2020_js_login',
            immobilien_redaktion_2020_URL . "/dist/login{$min_ext}.js",
            [],
            immobilien_redaktion_2020_VERSION,
            true
        );
    }


	if(is_author()){
        wp_enqueue_script(
            'immobilien_redaktion_2020_js_author',
            immobilien_redaktion_2020_URL . "/dist/author{$min_ext}.js",
            [],
            immobilien_redaktion_2020_VERSION,
            true
        );
    }


	if(is_single() || is_singular()){
        wp_enqueue_script(
            'immobilien_redaktion_2020_js_single',
            immobilien_redaktion_2020_URL . "/dist/single{$min_ext}.js",
            [],
            immobilien_redaktion_2020_VERSION,
            true
        );

        if(get_post_format() == 'video'){
            wp_enqueue_script(
                'immobilien_redaktion_2020_js_single_video',
                immobilien_redaktion_2020_URL . "/dist/singlevideo{$min_ext}.js",
                [],
                immobilien_redaktion_2020_VERSION,
                true
            );
        }

    }

    if(is_category()){
        wp_enqueue_script(
            'immobilien_redaktion_2020_js_category',
            immobilien_redaktion_2020_URL . "/dist/category{$min_ext}.js",
            [],
            immobilien_redaktion_2020_VERSION,
            true
        );
    }

    if(is_page_template('pagetemplate-profil.php')){
        wp_enqueue_script(
            'immobilien_redaktion_2020_js_profil',
            immobilien_redaktion_2020_URL . "/dist/profile{$min_ext}.js",
            [],
            immobilien_redaktion_2020_VERSION,
            true
        );
    }

    if(is_page_template('pagetemplate-sehen.php')){
        wp_enqueue_script(
            'immobilien_redaktion_2020_js_sehen',
            immobilien_redaktion_2020_URL . "/dist/sehen{$min_ext}.js",
            [],
            immobilien_redaktion_2020_VERSION,
            true
        );
    }

    if(is_page_template('pagetemplate-diskutieren.php')){
        wp_enqueue_script(
            'immobilien_redaktion_2020_js_diskutieren',
            immobilien_redaktion_2020_URL . "/dist/diskutieren{$min_ext}.js",
            [],
            immobilien_redaktion_2020_VERSION,
            true
        );
    }



	// CSS
	wp_enqueue_style(
		'immobilien_redaktion_2020_css',
		immobilien_redaktion_2020_URL . "/dist/main{$min_ext}.css",
		[],
		immobilien_redaktion_2020_VERSION,
		''
	);

} );