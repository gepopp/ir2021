<?php

namespace immobilien_redaktion_2020;

use Carbon\Carbon;

/**
 * Set up theme defaults and registers support for various WordPress features.
 *
 * @author Freeshifter LLC
 * @since  1.0.0
 */
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

    add_image_size('author_extra_small', 24, 24, true);
    add_image_size('author_small', 48, 48, true);
    add_image_size('author_large', 96, 96, true);


    add_image_size('horizontal_box', 370, 265, true);
    add_image_size('article', 600, 450, true);
    add_image_size('article-portrait', 250, 333, true);
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

    $allowed = ['update_profile', 'subscribe_immolive', 'resend_activation', 'frontent_logout', 'update_profile_image'];
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


add_filter('manage_users_columns', function($column)
{
    $column['registration_date'] = 'Registriert am';
    return $column;
});


add_filter('manage_users_custom_column', function($val, $column_name, $user_id)
{
    switch ($column_name) {
        case 'registration_date' :
            $udata = get_userdata($user_id);
            return $udata->user_registered;
        default:
    }
    return $val;
}, 10, 3);


add_filter( 'manage_users_sortable_columns', function( $columns ) {
    return wp_parse_args( array( 'registration_date' => 'registered' ), $columns );
});

add_action('restrict_manage_users', function () {

    ob_start();
    ?>
    <div id="export" style="display: inline-block">
        <span class="button" style="margin-left: 10px" id="export-users">Exportieren</span>
    </div>
    <script>
        jQuery(document).ready(function ($) {
            $('#export-users').on('click', function () {
                $('#export-users').text('lade...');
                $.post(ajaxurl, {action: "export-users"}, function (rsp) {
                    var elem = $('#export').html('<a href="' + rsp + '" target="_blank">Download</a>');
                }).fail(function () {
                    $('#export-users').text('fehlgeschlagen');
                });
            });
        })

    </script>
    <?php
    echo ob_get_clean();

});