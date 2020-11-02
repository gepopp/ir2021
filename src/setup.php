<?php

namespace immobilien_redaktion_2020;

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


add_action('init', function () {

    if (!wp_next_scheduled('get_views_from_analytics')) {
        wp_schedule_event(time(), 'hourly', 'get_views_from_analytics');
    }

});

add_action( 'get_views_from_analytics', function()
{
    $query = new \WP_Query([
        'post_type'           => 'post',
        'post_status'         => 'publish',
        'ignore_sticky_posts' => true,
        'posts_per_page'      => -1,
    ]);
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();

            update_field('field_5f9ff32f68d04', get_page_views(get_the_ID()));

        }
    }
});