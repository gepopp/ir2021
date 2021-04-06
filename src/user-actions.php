<?php

namespace immobilien_redaktion_2020;

use Carbon\Carbon;


add_action('admin_post_update_profile_image', function (){

    // WordPress environment
    require( dirname(__FILE__) . '/../../../../wp-load.php' );

    $wordpress_upload_dir = wp_upload_dir();
    $i=1;

    $profilepicture = $_FILES['profile_picture'];


    $new_file_path = $wordpress_upload_dir['path'] . '/' . $profilepicture['name'];
    $new_file_mime = mime_content_type( $profilepicture['tmp_name'] );

    global $FormSession;

    if( empty( $profilepicture ) )
        $FormSession->set('profile_image_error', 'profile_image_mime')->redirect();

    if( $profilepicture['error'] )
        $FormSession->set('profile_image_error', 'profile_image_mime')->redirect();

    if( $profilepicture['size'] > 2097152 )
        $FormSession->set('profile_image_error', 'profile_image_size')->redirect();

    if( !in_array( $new_file_mime, ['image/jpeg', 'image/jpg', 'image/png'] ) )
        $FormSession->set('profile_image_error', 'profile_image_mime')->redirect();

    while( file_exists( $new_file_path ) ) {
        $i++;
        $new_file_path = $wordpress_upload_dir['path'] . '/' . $i . '_' . $profilepicture['name'];
    }

// looks like everything is OK
    if( move_uploaded_file( $profilepicture['tmp_name'], $new_file_path ) ) {


        $upload_id = wp_insert_attachment( array(
            'guid'           => $new_file_path,
            'post_mime_type' => $new_file_mime,
            'post_title'     => preg_replace( '/\.[^.]+$/', '', $profilepicture['name'] ),
            'post_content'   => '',
            'post_status'    => 'inherit'
        ), $new_file_path );

        // wp_generate_attachment_metadata() won't work if you do not include this file
        require_once( ABSPATH . 'wp-admin/includes/image.php' );

        // Generate and save the attachment metas into the database
        wp_update_attachment_metadata( $upload_id, wp_generate_attachment_metadata( $upload_id, $new_file_path ) );

       update_field('field_5ded37c474589', $upload_id, 'user_' . get_current_user_id());

        $FormSession->set('profile_image_updated', 'profile_image_saved')->redirect();

    }
});


add_action('wp_ajax_update_reminder_date', function () {

    global $wpdb;

    if (get_current_user_id() == $wpdb->get_var(sprintf('SELECT user_id FROM wp_user_read_later WHERE id= %s', $_POST['id']))) {
        $update = $wpdb->update('wp_user_read_later', ['remind_at' => Carbon::now()->addDays($_POST['days'] + 1)->format('Y-m-d H:i:s')], ['id' => $_POST['id']]);
    }

    if ($update ?? false) {

        $log = $wpdb->get_row(sprintf('SELECT * FROM wp_user_read_later WHERE id = %s', $_POST['id']));

        \Carbon\Carbon::setLocale('de');
        wp_die(json_encode([
            'remind_at' => $log->remind_at,
            'time'      => ucfirst(\Carbon\Carbon::parse($log->remind_at)->diffForHumans()),
        ]));

    } else {
        wp_die(false, 400);
    }


});

add_action('wp_ajax_set_reading_reminder', function()
{

    $post = sanitize_text_field($_POST['id']);
    $user = wp_get_current_user();

    global $wpdb;

    $wpdb->show_errors = false;

    $insert = $wpdb->insert('wp_user_read_later', [
        'user_id'   => $user->ID,
        'post_id'   => $post,
        'permalink' => get_the_permalink($post),
        'remind_at' => Carbon::now()->addDays(4)->format('Y-m-d H:i:s'),
    ], ['%d', '%d', '%s', '%s']);

    if (!$insert) {
        wp_die('', 401);
    } else {
        wp_die('');

    }
});

add_action('wp_ajax_set_user_bookmark', function()
{

    $post = sanitize_text_field($_POST['id']);
    $user = wp_get_current_user();

    global $wpdb;

    $wpdb->show_errors = false;

    $insert = $wpdb->insert('wp_user_bookmarks', [
        'user_id'   => $user->ID,
        'post_id'   => $post,
        'permalink' => get_the_permalink($post),
    ], ['%d', '%d', '%s']);

    if (!$insert) {
        wp_die('', 401);
    } else {
        wp_die('');

    }

});

add_action('wp_ajax_remove_user_bookmark', function () {

    $bookmark_id = sanitize_text_field($_POST['id']);
    $user = wp_get_current_user();

    global $wpdb;
    $bookmark_user_id = $wpdb->get_var(sprintf('SELECT user_id FROM wp_user_bookmarks WHERE id = %d', $bookmark_id));
    if ($user->ID == $bookmark_user_id) {
        $del = $wpdb->delete('wp_user_bookmarks', ['id' => $bookmark_id]);
    }

    if (!is_wp_error($del)) {
        wp_die('');
    } else {
        wp_die('', 400);
    }

});

add_action('admin_post_update_profile', function () {

    global $FormSession;

    if (!wp_verify_nonce($_POST['frontend_register'], 'frontend_register')) {
        $FormSession->addToErrorBag('profile_error', 'nonce')->redirect();
    }

    $user = wp_get_current_user();
    $gender = sanitize_text_field($_POST['register_gender']);
    $firstname = sanitize_text_field($_POST['fist_name']);
    $lastname = sanitize_text_field($_POST['last_name']);

    update_user_meta($user->ID, 'first_name', $firstname);
    update_user_meta($user->ID, 'last_name', $lastname);
    wp_update_user(['ID' => $user->ID, 'display_name' => trim($firstname . ' ' . $lastname)]);

    update_field('field_5fb6bc5f82e62', $gender, 'user_' . $user->ID);

    $FormSession->set('profile_updated', 'profile_updated')->redirect();
});

add_action('admin_post_frontent_logout', function (){
   wp_logout();
   wp_safe_redirect(home_url());
});