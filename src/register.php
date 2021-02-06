<?php
namespace immobilien_redaktion_2020;

add_action('admin_post_nopriv_frontend_register', function () {

    global $FormSession;

    if (!wp_verify_nonce($_POST['frontend_register'], 'frontend_register')) {
        $FormSession->addToErrorBag('register_error', 'nonce')->redirect();
    }

    if (sanitize_text_field($_POST['agb']) != 'on') {
        $FormSession->addToErrorBag('register_error', 'agb')->redirect();
    }

    $gender = sanitize_text_field($_POST['register_gender']);
    $firstname = sanitize_text_field($_POST['first_name']);
    $lastname = sanitize_text_field($_POST['last_name']);
    $email = sanitize_email($_POST['register_email']);
    $password = sanitize_text_field($_POST['password']);

    if (get_user_by('email', $email)) {
        $FormSession->addToErrorBag('register_error', 'user_exists')->redirect();
    }

    if (strlen($password) < 8) {
        $FormSession->addToErrorBag('register_error', 'password_length')->redirect();
    }

    $user = wp_create_user(trim($firstname . ' ' . $lastname . ' ' . uniqid()), $password, $email);

    if (is_wp_error($user)) {
        $FormSession->addToErrorBag('register_error', 'register_error')->redirect();
    }

    wp_update_user([
        'ID'           => $user,
        'display_name' => trim($firstname . ' ' . $lastname),
        'first_name'   => $firstname,
        'last_name'    => $lastname,
    ]);
    update_field('field_5fb6bc5f82e62', $gender, 'user_' . $user);

    $user = get_user_by('ID', $user);

    $user->add_role('registered');
    $user->remove_role('subscriber');

    global $wpdb;
    $table = 'wp_user_activation_token';

    $wpdb->delete($table, ['email' => $user->data->user_email]);
    $token = wp_generate_uuid4();

    $wpdb->insert($table, [
        'user_id'    => $user->ID,
        'email'      => $user->data->user_email,
        'token'      => $token,
        'redirect'   => $_POST['redirect'],
        'created_at' => \Carbon\Carbon::now()->format('d.m.Y H:i:s'),
    ],
        ['%d', '%s', '%s', '%s']);



    $sent = (new CampaignMonitor())->transactional(
        'confirm_email_address',
        $user,
        ['link' => add_query_arg(['token' => $token, 'redirect' => $_POST['redirect']], get_field('field_601bbffe28967', 'option'))]
    );


    if ($sent) {
        $FormSession->set('register_sent_success', 'register_sent_success')->redirect();
    } else {
        $FormSession->addToErrorBag('register_error', 'not_sent')->redirect();
    }

});