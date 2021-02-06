<?php

namespace immobilien_redaktion_2020;

use Carbon\Carbon;

/**
 * Set up theme defaults and registers support for various WordPress features.
 *
 * @author Freeshifter LLC
 * @since  1.0.0
 */

add_action( 'init', function(){
    add_rewrite_rule(
        'fb-login/([0-9]+)/?$',
        'index.php?pagename=fb-login&state=$matches[1]',
        'top' );
});



add_action('template_redirect', function (){


    if(is_tag('immolive')){
        wp_safe_redirect(home_url('diskutieren'));
    }


    if( (
        is_page_template('pagetemplate-login-register.php') ||
        is_page_template('pagetemplate-login.php') ||
        is_page_template('pagetemplate-resend-activation.php') ||
        is_page_template('pagetemplate-register.php') )
        && is_user_logged_in()){
        wp_safe_redirect(get_field('field_601bc4580a4fc', 'option'));
    }

    if( (is_page_template('pagetemplate-passwort-vergessen.php') || is_page_template('pagetemplate-passwort-reset.php')) && is_user_logged_in()){
        wp_safe_redirect(get_field('field_601bc4580a4fc', 'option'));
    }

    if(is_page_template('pagetemplate-profil.php') && !is_user_logged_in()){
        wp_safe_redirect(get_field('field_601bbffe28967', 'option'));
    }

});


add_action('wp_logout', function(){
    wp_redirect( home_url() );
    exit();
});


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


    $sql = "CREATE TABLE IF NOT EXISTS wp_user_pending_email
    (
        id INT UNSIGNED NOT NULL AUTO_INCREMENT,
        user_id INT NOT NULL,
        new_email VARCHAR(255) NOT NULL,
        pin VARCHAR(255) NOT NULL,
        created_at TIMESTAMP NOT NULL,
        PRIMARY KEY  (id)
    );";

    dbDelta( $sql );

    $sql = "CREATE TABLE IF NOT EXISTS wp_reading_log
    (
        id INT UNSIGNED NOT NULL AUTO_INCREMENT,
        user_id INT NOT NULL,
        post_id INT NOT NULL,
        permalink VARCHAR(255) NOT NULL,
        scroll_depth INT NULL,
        created_at TIMESTAMP NOT NULL,
        PRIMARY KEY  (id)
    );";

    dbDelta( $sql );


    $sql = "CREATE TABLE IF NOT EXISTS wp_user_bookmarks
    (
        id INT UNSIGNED NOT NULL AUTO_INCREMENT,
        user_id INT NOT NULL,
        post_id INT NOT NULL,
        permalink VARCHAR(255) NOT NULL,
        created_at TIMESTAMP NOT NULL,
        PRIMARY KEY  (id),
        UNIQUE (user_id, post_id)
    );";

    dbDelta( $sql );

    $sql = "CREATE TABLE IF NOT EXISTS wp_user_read_later
    (
        id INT UNSIGNED NOT NULL AUTO_INCREMENT,
        user_id INT NOT NULL,
        post_id INT NOT NULL,
        permalink VARCHAR(255) NOT NULL,
        created_at TIMESTAMP NOT NULL,
        remind_at DATETIME NOT NULL,
        PRIMARY KEY  (id),
        UNIQUE (user_id, post_id)
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
    $wp_roles->remove_cap( 'registered', 'read' );
    $wp_roles->remove_cap( 'subscriber', 'edit_dashboard' );
    $wp_roles->remove_cap( 'registered', 'edit_dashboard' );

});

add_action( 'init', function (){

    global $FormSession;
    $FormSession = FormSession::session();

    global $wp_query;

    $allowed = ['update_profile', 'subscribe_immolive', 'resend_activation'];
    $action = $_REQUEST['action'] ?? '';

    if(is_admin() && !wp_doing_ajax() && !in_array($action, $allowed)){
        $user = wp_get_current_user();
        if(in_array('registered', $user->roles) || in_array('subscriber', $user->roles)){

            $wp_query->set_404();
            status_header( 404 );
            get_template_part( 404 );
            exit();
        }
    }
});



add_filter( 'show_admin_bar', function (){
    if ( ! current_user_can( 'administrator' ) ) {
       return false;
    }
    return true;
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

 // To make a column 'un-sortable' remove it from the array
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

// Define path and URL to the ACF plugin.
define( 'MY_ACF_PATH', get_stylesheet_directory() . '/advanced-custom-fields-pro/' );
define( 'MY_ACF_URL', get_stylesheet_directory_uri() . '/advanced-custom-fields-pro/' );

// Include the ACF plugin.
include_once( MY_ACF_PATH . 'acf.php' );

// Customize the url setting to fix incorrect asset URLs.
add_filter('acf/settings/url', 'immobilien_redaktion_2020\my_acf_settings_url');
function my_acf_settings_url( $url ) {
    return MY_ACF_URL;
}

// (Optional) Hide the ACF admin menu item.
add_filter('acf/settings/show_admin', 'immobilien_redaktion_2020\my_acf_settings_show_admin');
function my_acf_settings_show_admin( $show_admin ) {

    if(defined('SCRIPT_DEBUG') && SCRIPT_DEBUG){
        return true;
    }
    return false;
}



