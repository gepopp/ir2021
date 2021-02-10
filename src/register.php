<?php
namespace immobilien_redaktion_2020;

use Carbon\Carbon;

add_action('admin_post_nopriv_frontend_register', function () {

    global $FormSession;

    $gender = sanitize_text_field($_POST['register_gender']);
    $firstname = sanitize_text_field($_POST['first_name']);
    $lastname = sanitize_text_field($_POST['last_name']);
    $email = sanitize_email($_POST['register_email']);
    $password = sanitize_text_field($_POST['password']);

    if (!wp_verify_nonce($_POST['frontend_register'], 'frontend_register')) {
        $FormSession->addToErrorBag('register_error', 'nonce')->redirect();
    }

    if (get_user_by('email', $email)) {
        $FormSession->addToErrorBag('register_error', 'user_exists')->redirect();
    }

    if (sanitize_text_field($_POST['agb']) != 'on') {
        $FormSession->addToErrorBag('register_error', 'agb')->redirect();
    }

    if (strlen($password) < 8) {
        $FormSession->addToErrorBag('register_error', 'password_length')->redirect();
    }

    $user_id = wp_create_user(trim($firstname . ' ' . $lastname . ' ' . uniqid()), $password, $email);
    if (is_wp_error($user_id)) {
        $FormSession->addToErrorBag('register_error', 'register_error')->redirect();
    }

    wp_update_user([
        'ID'           => $user_id,
        'display_name' => trim($firstname . ' ' . $lastname),
        'first_name'   => $firstname,
        'last_name'    => $lastname,
    ]);
    update_field('field_5fb6bc5f82e62', $gender, 'user_' . $user_id);

    $user = get_user_by('ID', $user_id);
    $user->add_role('registered');
    $user->remove_role('subscriber');

    $token = wp_generate_uuid4();

    $redirect = sanitize_text_field($_POST['redirect']) ?? '';

    global $wpdb;
    $table = 'wp_user_activation_token';

    $wpdb->insert($table, [
        'user_id'    => $user->ID,
        'email'      => $user->data->user_email,
        'token'      => $token,
        'redirect'   => $redirect,
    ],
        ['%d', '%s', '%s', '%s']);

    $sent = (new CampaignMonitor())->transactional(
        'confirm_email_address',
        $user,
        ['link' => add_query_arg(['token' => $token, 'redirect' => $redirect], get_field('field_601bbffe28967', 'option'))]
    );

    if ($sent) {
        $FormSession->set('register_sent_success', 'register_sent_success')->redirect();
    } else {
        $FormSession->addToErrorBag('register_error', 'not_sent')->redirect();
    }
});

add_action('admin_post_nopriv_resend_activation', function () {

    global $FormSession;

    $email = sanitize_email($_POST['email']);
    $user = get_user_by('email', $email);

    if(!wp_verify_nonce($_POST['resend_activation'], 'resend_activation')){
        $FormSession->addToErrorBag('resend_activation', 'nonce')->redirect();
    }

    if(!$user){
        $FormSession->addToErrorBag('resend_activation', 'email_not_found')->redirect();
    }

    if(in_array('subscriber', $user->roles)){
        $FormSession->set('token_success', 'account_acitvated')->redirect(get_field('field_601bbffe28967', 'option'));
    }

    if(sentUserActivationToken($user)){
        $FormSession->set('resend_activation', 'register_sent_success')->redirect();
    }else{
        $FormSession->addToErrorBag('resend_activation', 'not_sent')->redirect();
    }

});

function activate_user($token)
{
    global $FormSession;

    if ($token == '') return;
    global $wpdb;

    $table = 'wp_user_activation_token';

    $email = $wpdb->get_var('SELECT email FROM ' . $table . ' WHERE token = "' . $token . '"');

    echo wp_die( var_dump($email) );

    $token_user = get_user_by('email', $email);

    if (!$token_user) {
        $FormSession->addToErrorBag('login_errror', 'token_expired');
        return;
    }

    if (!in_array('subscriber', $token_user->roles)) {

        $token_user->add_role('subscriber');
        $token_user->remove_role('registered');

        $cm = new CampaignMonitor();
        $cm->transactional('registration_activated', $token_user);
        $cm->updateUser($token_user);
        $FormSession->set('token_success', 'account_acitvated');
        return;
    }
    $FormSession->addToErrorBag('login_errror', 'token_expired');
    return;
}

function sentUserActivationToken(\WP_User $user){
    global $wpdb;
    $table = 'wp_user_activation_token';

//    $last_token = $wpdb->get_var(sprintf('SELECT created_at FROM %s WHERE email = "%s" ORDER BY created_at DESC LIMIT 1', $table, $user->user_email));
//
//    if($last_token && Carbon::now()->diffInMinutes(Carbon::parse($last_token)) < 5){
//        return false;
//    }

//    $wpdb->delete($table, ['email' => $user->data->user_email]);
    $token = wp_generate_uuid4();

    $redirect = sanitize_text_field($_POST['redirect']) ?? '';

    $wpdb->insert($table, [
        'user_id'    => $user->ID,
        'email'      => $user->data->user_email,
        'token'      => $token,
        'redirect'   => $redirect,
        ],
        ['%d', '%s', '%s', '%s']);

    return (new CampaignMonitor())->transactional(
        'confirm_email_address',
        $user,
        ['link' => add_query_arg(['token' => $token, 'redirect' => $redirect], get_field('field_601bbffe28967', 'option'))]
    );
}
