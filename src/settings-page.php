<?php
namespace immobilien_redaktion_2020;

add_action('acf/init', 'immobilien_redaktion_2020\my_acf_op_init');
function my_acf_op_init() {

    // Check function exists.
    if( function_exists('acf_add_options_page') ) {

        // Register options page.
        acf_add_options_page(array(
            'page_title'    => __('Preroll Einstellungen'),
            'menu_title'    => __('Preroll Video Einstellungen'),
            'menu_slug'     => 'preroll-settings',
            'capability'    => 'edit_posts',
            'redirect'      => false
        ));

        acf_add_options_sub_page(array(
            'page_title'  => __('Zoom Einstellungen'),
            'menu_title'  => __('Zoom'),
            'parent_slug' => 'edit.php?post_type=immolive',
        ));

        acf_add_options_page(array(
            'page_title' 	=> 'Theme General Einstellungen',
            'menu_title'	=> 'Theme Einstellungen',
            'menu_slug' 	=> 'theme-general-settings',
            'capability'	=> 'edit_posts',
            'redirect'		=> false
        ));

        acf_add_options_sub_page(array(
            'page_title' 	=> 'Login und Registrierung',
            'menu_title'	=> 'Login/Registrierung',
            'parent_slug'	=> 'theme-general-settings',
        ));
    }
}