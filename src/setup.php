<?php

namespace immobilien_redaktion_2020;

use Carbon\Carbon;

/**
 * Set up theme defaults and registers support for various WordPress features.
 *
 * @author Freeshifter LLC
 * @since  1.0.0
 */
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


add_filter('single_template', function ($single_template) {


    if (has_category('video')) {
        $single_template = get_stylesheet_directory() . '/single-post-video.php';
    }
    return $single_template;

}, PHP_INT_MAX, 2);

add_filter( 'cron_schedules', function($schedules ) {
    $schedules['every_minute'] = array(
        'interval'  => 60,
        'display'   => __( 'Every Minute', 'textdomain' )
    );
    return $schedules;
});

add_action('init', function () {

    if (!wp_next_scheduled('get_views_from_analytics')) {
        wp_schedule_event(time(), 'every_minute', 'get_views_from_analytics');
    }

});

add_action('get_views_from_analytics', function () {

    global $wpdb;

    $min = Carbon::now()->format('i') * 100;

    $ids = $wpdb->get_col('SELECT ID FROM wp_posts WHERE post_type = "post" AND post_status = "publish" LIMIT '.$min.', 100 ');

    foreach ($ids as $id) {
        update_field('field_5f9ff32f68d04', get_page_views($id));
    }
});

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

 //   To make a column 'un-sortable' remove it from the array
    unset($columns['date']);

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
