<?php

namespace immobilien_redaktion_2020;

use Carbon\Carbon;

/**
 * Set up theme defaults and registers support for various WordPress features.
 *
 * @author Freeshifter LLC
 * @since  1.0.0
 */
add_action( "after_switch_theme", function(){

    global $wpdb;

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

    $sql = "CREATE TABLE IF NOT EXISTS wp_user_activation_token
    (
        id INT UNSIGNED NOT NULL AUTO_INCREMENT,
        user_id INT NOT NULL,
        email VARCHAR(255) NOT NULL,
        token VARCHAR(255) NOT NULL,
        created_at TIMESTAMP NOT NULL,
        PRIMARY KEY  (id)
    );";

    dbDelta( $sql );

});




add_action('after_setup_theme', function () {

    // Add default posts and comments RSS feed links to head.
    add_theme_support('automatic-feed-links');

    // Let WordPress manage the document title.
    add_theme_support('title-tag');

    // Enable support for Post Thumbnails on posts and pages.
    add_theme_support('post-thumbnails');

    // This theme uses wp_nav_menu() in one location.
    register_nav_menus([
        'primary' => __('Primary Menu', 'immobilien-redaktion-2020'),
        'footer'  => __('Footer Menu', 'immobilien-redaktion-2020'),
    ]);

    // Switch default core markup for search form, comment form, and comments to output valid HTML5.
    add_theme_support('html5', [
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ]);


    add_image_size('custom-thumbnail', 800, 600, true);
    add_image_size('featured', 800, 450, true);
    add_image_size('featured_small', 300, (300 / 16) * 9, true);
    add_image_size('author_small', 48, 48, true);
    add_image_size('horizontal_box', 370, 265, true);
    add_image_size('article', 600, 450, true);
    add_image_size('portrait', 300);
    add_image_size('xs', 100, 100, true);

    add_theme_support('post-formats', ['video', 'gallery']);
});


add_role( 'registered', 'Registriert', [] );

add_action( 'admin_init', function() {
    global $wp_roles; // global class wp-includes/capabilities.php
    $wp_roles->remove_cap( 'subscriber', 'read' );
    $wp_roles->remove_cap( 'subscriber', 'edit_dashboard' );
});

add_filter( 'show_admin_bar', function (){
    if ( ! current_user_can( 'manage_options' ) ) {
        show_admin_bar( false );
    }
});


add_filter('single_template', function ($single_template) {


    if (has_category('video')) {
        $single_template = get_stylesheet_directory() . '/single-post-video.php';
    }
    return $single_template;

}, PHP_INT_MAX, 2);


add_filter('manage_posts_columns', 'immobilien_redaktion_2020\add_views_column');
add_action('manage_posts_custom_column', 'immobilien_redaktion_2020\manage_attachment_tag_column', 10, 2);

function add_views_column($posts_columns)
{

    // Delete an existing column
    unset($posts_columns['comments']);

    // Add a new column
    $posts_columns['views'] = 'Views';

    return $posts_columns;
}

function manage_attachment_tag_column($column_name, $id)
{
    switch ($column_name) {
        case 'views':

            echo get_field('field_5f9ff32f68d04', $id);

            break;
        default:
            break;
    }

}
add_filter( 'manage_edit-post_sortable_columns', 'immobilien_redaktion_2020\my_sortable_views_column' );
function my_sortable_views_column( $columns ) {

    $columns['views'] = 'views';

 // To make a column 'un-sortable' remove it from the array
    unset($columns['date']);


    wp_die(var_dump($columns));

    return $columns;
}

add_action( 'pre_get_posts', function( $query ) {
    if( ! is_admin() )
        return;

    $orderby = $query->get( 'orderby');

    if( 'views' == $orderby ) {
        $query->set('meta_key','analytics_views');
        $query->set('orderby','meta_value_num');
    }
});


add_action('after_setup_theme', 'immobilien_redaktion_2020\remove_admin_bar');

function remove_admin_bar() {
    if (!current_user_can('administrator') && !is_admin()) {
        show_admin_bar(false);
    }
}