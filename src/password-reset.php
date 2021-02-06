<?php

use immobilien_redaktion_2020\CampaignMonitor;

add_action('admin_post_nopriv_new_password', function () {

    global $FormSession;

    if (!wp_verify_nonce(sanitize_text_field($_POST['new_password']), 'new_password')) {
        $FormSession->addToErrorBag('frontend_reset_password', 'nonce')->redirect();
    }

    global $wpdb;
    $user = get_user_by('email', sanitize_email($_POST['email']));

    if (!$user) {
        $FormSession->addToErrorBag('frontend_reset_password', 'register_error')->redirect();
    }

    if (!in_array('subscriber', $user->roles)) {
        $user->add_role('subscriber');
        $user->remove_role('registered');
    }

    wp_set_password(sanitize_text_field($_POST['pw']), $user->ID);

    $FormSession->set('token_success', 'password_changed')->redirect(get_field('field_601bbffe28967', 'option'));

});

add_action('admin_post_nopriv_frontend_reset_password', function () {

    global $FormSession;

    if (!wp_verify_nonce(sanitize_text_field($_POST['reset_password']), 'reset_password')) {
        $FormSession->addToErrorBag('passwort_reset_error', 'nonce')->redirect();
    }

    $user = get_user_by('email', sanitize_email($_POST['email']));

    if (!$user) {
        $FormSession->addToErrorBag('passwort_reset_error', 'email_not_found')->redirect();
    }

    global $wpdb;
    $table = 'wp_user_activation_token';

    $wpdb->delete($table, ['email' => $user->data->user_email]);

    $token = wp_generate_uuid4();

    $wpdb->insert($table, [
        'user_id'    => $user->ID,
        'email'      => $user->data->user_email,
        'token'      => $token,
        'created_at' => \Carbon\Carbon::now()->format('d.m.Y H:i:s'),
    ],
        ['%d', '%s', '%s', '%s']);

    $sent = (new CampaignMonitor())->transactional('reset_password', $user, ['link' => add_query_arg(['token' => $token], get_field('field_601e5b029887d', 'option'))]);

    if ($sent) {
        $FormSession->set('passwort_reset', 'reset_success')->redirect();
    } else {
        $FormSession->addToErrorBag('passwort_reset_error', 'register_error')->redirect();
    }

});