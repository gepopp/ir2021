<?php

namespace immobilien_redaktion_2020;

use Carbon\Carbon;


function activate_user($token)
{

    global $FormSession;

    if ($token == '') return;

    global $wpdb;

    $email = $wpdb->get_var('SELECT email FROM wp_user_activation_token WHERE token = "' . $token . '"');
    $wpdb->delete('wp_user_activation_token', ['token' => $token]);
    $token_user = get_user_by('email', $email);

    if (!$token_user) {
        $FormSession->addToErrorBag('login_errror', 'token_expired');
        return;
    }

    if (!in_array('subscriber', $token_user->roles)) {

        $token_user->add_role('subscriber');
        $token_user->remove_role('registered');

        $sent = (new CampaignMonitor())->transactional('registration_activated', $token_user);
        $updated = (new CampaignMonitor())->updateUser($token_user);
        $FormSession->set('token_success', 'account_acitvated');
        return;
    }

    $FormSession->addToErrorBag('login_errror', 'token_expired');
    return;
}

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

add_action('wp_ajax_set_reading_reminder', 'immobilien_redaktion_2020\set_reading_reminder');
//add_action('wp_ajax_nopriv_set_reading_reminder', 'immobilien_redaktion_2020\set_reading_reminder');

function set_reading_reminder()
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

}

add_action('wp_ajax_set_user_bookmark', 'immobilien_redaktion_2020\set_user_bookmark');

function set_user_bookmark()
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

}

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

add_action('admin_post_nopriv_resend_activation', function () {

    global $FormSession;

    $email = sanitize_email($_POST['email']);
    $user = get_user_by('email', $email);

    if(!$user){
        $FormSession->addToErrorBag('resend_activation', 'email_not_found')->redirect();
    }

    if(in_array('subscriber', $user->roles)){
        $FormSession->set('token_success', 'account_acitvated')->redirect(get_field('field_601bbffe28967', 'option'));

    }

    global $wpdb;
    $table = 'wp_user_activation_token';

    $wpdb->delete($table, ['email' => $email ]);

    $token = wp_generate_uuid4();

    $wpdb->insert($table, [
        'user_id'    => $user->ID,
        'email'      => $user->data->user_email,
        'token'      => $token,
        'created_at' => \Carbon\Carbon::now()->format('d.m.Y H:i:s'),
    ],
        ['%d', '%s', '%s', '%s']);

    (new CampaignMonitor())->transactional('confirm_email_address', $user, ['link' => add_query_arg(['token' => $token], get_field('field_601bbffe28967', 'option'))]);

    $FormSession->set('resend_activation', 'register_sent_success')->redirect();

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

